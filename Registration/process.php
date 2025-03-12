<?php
/**
 * Student Registration Form Processor
 * This file handles the processing of the multi-step student registration form
 */

// Include database connection
require_once 'db-connection.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define file upload directory
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Define allowed file types and max size
$allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
$max_file_size = 5 * 1024 * 1024; // 5MB

// JSON response function
function sendJsonResponse($success, $message, $data = []) {
    $response = [
        'success' => $success,
        'message' => $message
    ];
    
    if (!empty($data)) {
        $response = array_merge($response, $data);
    }
    
    echo json_encode($response);
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Begin transaction
        beginTransaction($pdo);
        
        // Validate form token (CSRF protection)
        if (empty($_POST['form_token'])) {
            sendJsonResponse(false, 'Invalid form submission.');
        }
        
        // Extract and sanitize student data
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $fatherName = filter_input(INPUT_POST, 'fatherName', FILTER_SANITIZE_STRING);
        $nationalId = filter_input(INPUT_POST, 'nationalId', FILTER_SANITIZE_STRING);
        $passportNumber = filter_input(INPUT_POST, 'passportNumber', FILTER_SANITIZE_STRING);
        $placeOfBirth = filter_input(INPUT_POST, 'placeOfBirth', FILTER_SANITIZE_STRING);
        $dateOfBirth = filter_input(INPUT_POST, 'dateOfBirth', FILTER_SANITIZE_STRING);
        $religion = filter_input(INPUT_POST, 'religion', FILTER_SANITIZE_STRING);
        $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_STRING);
        $academicGrade = filter_input(INPUT_POST, 'academicGrade', FILTER_SANITIZE_NUMBER_INT);
        $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);
        $residentialAddress = filter_input(INPUT_POST, 'residentialAddress', FILTER_SANITIZE_STRING);
        $contactNumber = filter_input(INPUT_POST, 'contactNumber', FILTER_SANITIZE_STRING);
        $emergencyContactName = filter_input(INPUT_POST, 'emergencyContactName', FILTER_SANITIZE_STRING);
        $emergencyContactNumber = filter_input(INPUT_POST, 'emergencyContactNumber', FILTER_SANITIZE_STRING);
        
        // Validate required student fields
        if (
            empty($firstName) || 
            empty($lastName) || 
            empty($fatherName) || 
            empty($placeOfBirth) || 
            empty($dateOfBirth) || 
            empty($religion) || 
            empty($nationality) || 
            empty($academicGrade) || 
            empty($residentialAddress) || 
            empty($contactNumber) || 
            empty($emergencyContactName) || 
            empty($emergencyContactNumber)
        ) {
            sendJsonResponse(false, 'Please fill in all required student information fields.');
        }
        
        // Validate ID (either national ID or passport number is required)
        if (empty($nationalId) && empty($passportNumber)) {
            sendJsonResponse(false, 'Either National ID or Passport Number is required.');
        }
        
        // Handle profile photo upload
        $profilePhotoPath = null;
        if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] === UPLOAD_ERR_OK) {
            $profilePhotoPath = handleFileUpload('profilePhoto', 'profile_photos', 2 * 1024 * 1024);
        }
        
        // Insert student data into database
        $sql = "INSERT INTO students (
                    first_name, last_name, father_name, national_id, passport_number,
                    birthplace, birthdate, religion, nationality, academic_grade,
                    major, residential_address, contact_number, emergency_contact_name,
                    emergency_contact_number, profile_photo_path
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";
        
        executeQuery($pdo, $sql, [
            $firstName, $lastName, $fatherName, $nationalId, $passportNumber,
            $placeOfBirth, $dateOfBirth, $religion, $nationality, $academicGrade,
            $major, $residentialAddress, $contactNumber, $emergencyContactName,
            $emergencyContactNumber, $profilePhotoPath
        ]);
        
        // Get the student ID
        $studentId = getLastInsertId($pdo);
        
        // Process document uploads
        processDocumentUploads($pdo, $studentId);
        
        // Process transportation data
        processTransportationData($pdo, $studentId);
        
        // Process father's information
        processFathersInformation($pdo, $studentId);
        
        // Process mother's information
        processMothersInformation($pdo, $studentId);
        
        // Process final registration data
        processRegistrationData($pdo, $studentId);
        
        // Commit transaction
        commitTransaction($pdo);
        
        // Log successful registration
        logActivity($pdo, 'student_registration', "Student registration completed: $firstName $lastName", $studentId);
        
        // Send success response
        sendJsonResponse(true, 'Registration completed successfully.', ['registration_id' => $studentId]);
        
    } catch (Exception $e) {
        // Rollback transaction
        rollbackTransaction($pdo);
        
        // Log error
        error_log('Registration Error: ' . $e->getMessage(), 0);
        
        // Send error response
        sendJsonResponse(false, 'An error occurred during registration. Please try again.');
    }
} else {
    // If not a POST request, redirect to the form page
    header('Location: index.php');
    exit;
}

/**
 * Handle file upload
 * 
 * @param string $fileInputName Name of the file input field
 * @param string $subDirectory Subdirectory within the uploads directory
 * @param int $maxSize Maximum file size in bytes
 * @return string|null Path to the uploaded file or null on failure
 */
function handleFileUpload($fileInputName, $subDirectory, $maxSize = 5242880) {
    global $upload_dir, $allowed_types;
    
    // Check if file was uploaded successfully
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $file = $_FILES[$fileInputName];
    
    // Validate file size
    if ($file['size'] > $maxSize) {
        throw new Exception("File {$file['name']} exceeds the maximum allowed size.");
    }
    
    // Validate file type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $finfo->file($file['tmp_name']);
    
    if (!in_array($fileType, $allowed_types)) {
        throw new Exception("File type {$fileType} is not allowed.");
    }
    
    // Create subdirectory if it doesn't exist
    $targetDir = $upload_dir . $subDirectory . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    // Generate unique filename
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '_' . time() . '.' . $fileExtension;
    $targetPath = $targetDir . $newFileName;
    
    // Move uploaded file to target location
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        throw new Exception("Failed to move uploaded file.");
    }
    
    return $targetPath;
}

/**
 * Process document uploads
 * 
 * @param PDO $pdo PDO instance
 * @param int $studentId Student ID
 */
function processDocumentUploads($pdo, $studentId) {
    // Map input names to document types
    $documentMap = [
        'emiratesId' => 'emirates_id',
        'passportDoc' => 'passport',
        'nationalIdDoc' => 'national_id',
        'birthCertificate' => 'birth_certificate',
        'academicCertificate' => 'academic_certificate'
    ];
    
    foreach ($documentMap as $inputName => $documentType) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $filePath = handleFileUpload($inputName, 'documents');
            
            if ($filePath) {
                $sql = "INSERT INTO documents (student_id, document_type, file_path) VALUES (?, ?, ?)";
                executeQuery($pdo, $sql, [$studentId, $documentType, $filePath]);
            }
        }
    }
}

/**
 * Process transportation data
 * 
 * @param PDO $pdo PDO instance
 * @param int $studentId Student ID
 */
function processTransportationData($pdo, $studentId) {
    $transportationCity = filter_input(INPUT_POST, 'transportationCity', FILTER_SANITIZE_STRING);
    $transportationRoute = filter_input(INPUT_POST, 'transportationRoute', FILTER_SANITIZE_NUMBER_INT);
    $transportationLocation = filter_input(INPUT_POST, 'transportationLocation', FILTER_SANITIZE_STRING);
    
    if (!empty($transportationCity) && !empty($transportationRoute)) {
        $sql = "INSERT INTO transportation (student_id, route_id, location) VALUES (?, ?, ?)";
        executeQuery($pdo, $sql, [$studentId, $transportationRoute, $transportationLocation]);
    }
}

/**
 * Process father's information
 * 
 * @param PDO $pdo PDO instance
 * @param int $studentId Student ID
 */
function processFathersInformation($pdo, $studentId) {
    $fatherFullName = filter_input(INPUT_POST, 'fatherFullName', FILTER_SANITIZE_STRING);
    $fatherNationality = filter_input(INPUT_POST, 'fatherNationality', FILTER_SANITIZE_STRING);
    $fatherDateOfBirth = filter_input(INPUT_POST, 'fatherDateOfBirth', FILTER_SANITIZE_STRING);
    $fatherNationalId = filter_input(INPUT_POST, 'fatherNationalId', FILTER_SANITIZE_STRING);
    $fatherPassportNumber = filter_input(INPUT_POST, 'fatherPassportNumber', FILTER_SANITIZE_STRING);
    $fatherEducation = filter_input(INPUT_POST, 'fatherEducation', FILTER_SANITIZE_STRING);
    $fatherOccupation = filter_input(INPUT_POST, 'fatherOccupation', FILTER_SANITIZE_STRING);
    $fatherLandline = filter_input(INPUT_POST, 'fatherLandline', FILTER_SANITIZE_STRING);
    $fatherMobile = filter_input(INPUT_POST, 'fatherMobile', FILTER_SANITIZE_STRING);
    $fatherWhatsapp = filter_input(INPUT_POST, 'fatherWhatsapp', FILTER_SANITIZE_STRING);
    $fatherEmail = filter_input(INPUT_POST, 'fatherEmail', FILTER_SANITIZE_EMAIL);
    $fatherWorkAddress = filter_input(INPUT_POST, 'fatherWorkAddress', FILTER_SANITIZE_STRING);
    $fatherEmployeeCode = filter_input(INPUT_POST, 'fatherEmployeeCode', FILTER_SANITIZE_STRING);
    $fatherMedicalCondition = filter_input(INPUT_POST, 'fatherMedicalCondition', FILTER_SANITIZE_STRING);
    $fatherMedicalConditionDetails = filter_input(INPUT_POST, 'fatherMedicalConditionDetails', FILTER_SANITIZE_STRING);
    
    // Validate required fields
    if (
        empty($fatherFullName) || 
        empty($fatherNationality) || 
        empty($fatherDateOfBirth) || 
        empty($fatherEducation) || 
        empty($fatherOccupation) || 
        empty($fatherMobile) || 
        empty($fatherEmail)
    ) {
        throw new Exception('Please fill in all required father information fields.');
    }
    
    // Validate ID (either national ID or passport number is required)
    if (empty($fatherNationalId) && empty($fatherPassportNumber)) {
        throw new Exception('Either Father\'s National ID or Passport Number is required.');
    }
    
    // Determine if father has medical condition
    $hasMedicalCondition = ($fatherMedicalCondition === 'Yes');
    
    $sql = "INSERT INTO fathers (
                student_id, full_name, nationality, birthdate, national_id,
                passport_number, education, occupation, landline, mobile_number,
                whatsapp_number, email, work_address, employee_code,
                has_medical_condition, medical_condition_details
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";
    
    executeQuery($pdo, $sql, [
        $studentId, $fatherFullName, $fatherNationality, $fatherDateOfBirth, $fatherNationalId,
        $fatherPassportNumber, $fatherEducation, $fatherOccupation, $fatherLandline, $fatherMobile,
        $fatherWhatsapp, $fatherEmail, $fatherWorkAddress, $fatherEmployeeCode,
        $hasMedicalCondition, $hasMedicalCondition ? $fatherMedicalConditionDetails : null
    ]);
}

/**
 * Process mother's information
 * 
 * @param PDO $pdo PDO instance
 * @param int $studentId Student ID
 */
function processMothersInformation($pdo, $studentId) {
    $motherFullName = filter_input(INPUT_POST, 'motherFullName', FILTER_SANITIZE_STRING);
    $motherNationality = filter_input(INPUT_POST, 'motherNationality', FILTER_SANITIZE_STRING);
    $motherDateOfBirth = filter_input(INPUT_POST, 'motherDateOfBirth', FILTER_SANITIZE_STRING);
    $motherNationalId = filter_input(INPUT_POST, 'motherNationalId', FILTER_SANITIZE_STRING);
    $motherPassportNumber = filter_input(INPUT_POST, 'motherPassportNumber', FILTER_SANITIZE_STRING);
    $motherEducation = filter_input(INPUT_POST, 'motherEducation', FILTER_SANITIZE_STRING);
    $motherOccupation = filter_input(INPUT_POST, 'motherOccupation', FILTER_SANITIZE_STRING);
    $motherLandline = filter_input(INPUT_POST, 'motherLandline', FILTER_SANITIZE_STRING);
    $motherMobile = filter_input(INPUT_POST, 'motherMobile', FILTER_SANITIZE_STRING);
    $motherWhatsapp = filter_input(INPUT_POST, 'motherWhatsapp', FILTER_SANITIZE_STRING);
    $motherEmail = filter_input(INPUT_POST, 'motherEmail', FILTER_SANITIZE_EMAIL);
    $motherWorkAddress = filter_input(INPUT_POST, 'motherWorkAddress', FILTER_SANITIZE_STRING);
    $motherEmployeeCode = filter_input(INPUT_POST, 'motherEmployeeCode', FILTER_SANITIZE_STRING);
    $motherMedicalCondition = filter_input(INPUT_POST, 'motherMedicalCondition', FILTER_SANITIZE_STRING);
    $motherMedicalConditionDetails = filter_input(INPUT_POST, 'motherMedicalConditionDetails', FILTER_SANITIZE_STRING);
    
    // Validate required fields
    if (
        empty($motherFullName) || 
        empty($motherNationality) || 
        empty($motherDateOfBirth) || 
        empty($motherEducation) || 
        empty($motherOccupation) || 
        empty($motherMobile) || 
        empty($motherEmail)
    ) {
        throw new Exception('Please fill in all required mother information fields.');
    }
    
    // Validate ID (either national ID or passport number is required)
    if (empty($motherNationalId) && empty($motherPassportNumber)) {
        throw new Exception('Either Mother\'s National ID or Passport Number is required.');
    }
    
    // Determine if mother has medical condition
    $hasMedicalCondition = ($motherMedicalCondition === 'Yes');
    
    $sql = "INSERT INTO mothers (
                student_id, full_name, nationality, birthdate, national_id,
                passport_number, education, occupation, landline, mobile_number,
                whatsapp_number, email, work_address, employee_code,
                has_medical_condition, medical_condition_details
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";
    
    executeQuery($pdo, $sql, [
        $studentId, $motherFullName, $motherNationality, $motherDateOfBirth, $motherNationalId,
        $motherPassportNumber, $motherEducation, $motherOccupation, $motherLandline, $motherMobile,
        $motherWhatsapp, $motherEmail, $motherWorkAddress, $motherEmployeeCode,
        $hasMedicalCondition, $hasMedicalCondition ? $motherMedicalConditionDetails : null
    ]);
}

/**
 * Process registration data
 * 
 * @param PDO $pdo PDO instance
 * @param int $studentId Student ID
 */
function processRegistrationData($pdo, $studentId) {
    $specialNotes = filter_input(INPUT_POST, 'specialNotes', FILTER_SANITIZE_STRING);
    $disciplinaryRules = filter_input(INPUT_POST, 'disciplinaryRules', FILTER_VALIDATE_BOOLEAN);
    $termsConditions = filter_input(INPUT_POST, 'termsConditions', FILTER_VALIDATE_BOOLEAN);
    
    // Validate agreements
    if (!$disciplinaryRules || !$termsConditions) {
        throw new Exception('You must agree to the Disciplinary Rules and Terms & Conditions.');
    }
    
    $sql = "INSERT INTO registrations (
                student_id, special_notes, disciplinary_rules_agreement,
                terms_conditions_agreement, registration_status
            ) VALUES (
                ?, ?, ?, ?, 'pending'
            )";
    
    executeQuery($pdo, $sql, [
        $studentId, $specialNotes, $disciplinaryRules, $termsConditions
    ]);
}