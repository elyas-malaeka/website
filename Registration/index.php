<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salman Farsi School - Student Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- اضافه کردن فونت وزیر برای زبان فارسی -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="language-toggle">
        <button class="active" data-lang="en">English</button>
        <button data-lang="fa">فارسی</button>
    </div>

    <div class="container">
        <div class="form-header">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="Salman Farsi School Logo">
            </div>
            <h1 class="title">Student Registration Form</h1>
            <p class="subtitle">Please complete all required fields to register your child at Salman Farsi School</p>
        </div>

        <div class="progress-container">
            <ul class="progress-steps">
                <li class="active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Student Information</div>
                </li>
                <li data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Document Uploads</div>
                </li>
                <li data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Father's Information</div>
                </li>
                <li data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Mother's Information</div>
                </li>
                <li data-step="5">
                    <div class="step-number">5</div>
                    <div class="step-label">Confirmation</div>
                </li>
            </ul>
        </div>

        <form id="registrationForm" action="process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="current_step" id="current_step" value="1">
            <input type="hidden" name="form_token" id="form_token" value="">
            
            <!-- Step 1: Student Information -->
            <div class="form-step" id="step1">
                <div class="form-section">
                    <h2>Student Information</h2>
                    
                    <div class="photo-upload">
                        <div class="photo-preview">
                            <img id="profilePhotoPreview" src="img/profile-placeholder.png" alt="Profile Photo">
                        </div>
                        <div class="upload-controls">
                            <label for="profilePhoto" class="upload-btn">
                                <i class="fas fa-upload"></i> Upload Profile Photo
                            </label>
                            <input type="file" id="profilePhoto" name="profilePhoto" accept="image/jpeg,image/png" required hidden>
                            <p class="file-requirement">JPEG/PNG, max size: 2MB <span class="required">*</span></p>
                            <div class="validation-message" id="profilePhotoError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name <span class="required">*</span></label>
                            <input type="text" id="firstName" name="firstName" class="form-control" required>
                            <div class="validation-message" id="firstNameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name <span class="required">*</span></label>
                            <input type="text" id="lastName" name="lastName" class="form-control" required>
                            <div class="validation-message" id="lastNameError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group id-section">
                            <div class="id-toggle">
                                <label class="toggle-label active" data-target="nationalIdSection">National ID</label>
                                <label class="toggle-label" data-target="passportSection">Passport Number</label>
                            </div>
                            <div class="id-input-section" id="nationalIdSection">
                                <input type="text" id="nationalId" name="nationalId" class="form-control" placeholder="National ID">
                                <div class="validation-message" id="nationalIdError"></div>
                            </div>
                            <div class="id-input-section hidden" id="passportSection">
                                <input type="text" id="passportNumber" name="passportNumber" class="form-control" placeholder="Passport Number">
                                <div class="validation-message" id="passportNumberError"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father's Name <span class="required">*</span></label>
                            <input type="text" id="fatherName" name="fatherName" class="form-control" required>
                            <div class="validation-message" id="fatherNameError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="placeOfBirth">Place of Birth <span class="required">*</span></label>
                            <input type="text" id="placeOfBirth" name="placeOfBirth" class="form-control" required>
                            <div class="validation-message" id="placeOfBirthError"></div>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth <span class="required">*</span></label>
                            <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-control date-picker" required>
                            <div class="validation-message" id="dateOfBirthError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="religion">Religion <span class="required">*</span></label>
                            <select id="religion" name="religion" class="form-control" required>
                                <option value="">Select Religion</option>
                                <option value="Shia Islam">Shia Islam</option>
                                <option value="Sunni Islam">Sunni Islam</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Judaism">Judaism</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="validation-message" id="religionError"></div>
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality <span class="required">*</span></label>
                            <select id="nationality" name="nationality" class="form-control" required>
                                <option value="">Select Nationality</option>
                                <optgroup label="Priority Countries">
                                    <option value="Iran">Iran</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="UAE">UAE</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Iraq">Iraq</option>
                                </optgroup>
                                <optgroup label="Other Countries">
                                    <!-- Other countries will be loaded via JavaScript -->
                                </optgroup>
                            </select>
                            <div class="validation-message" id="nationalityError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="academicGrade">Academic Grade <span class="required">*</span></label>
                            <select id="academicGrade" name="academicGrade" class="form-control" required>
                                <option value="">Select Grade</option>
                                <option value="1">Grade 1</option>
                                <option value="2">Grade 2</option>
                                <option value="3">Grade 3</option>
                                <option value="4">Grade 4</option>
                                <option value="5">Grade 5</option>
                                <option value="6">Grade 6</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                            <div class="validation-message" id="academicGradeError"></div>
                        </div>
                        <div class="form-group major-section hidden">
                            <label for="major">Major <span class="required">*</span></label>
                            <select id="major" name="major" class="form-control">
                                <option value="">Select Major</option>
                                <option value="Technical & Vocational">Technical & Vocational</option>
                                <option value="Mathematics & Physics">Mathematics & Physics</option>
                                <option value="Experimental Sciences">Experimental Sciences</option>
                                <option value="Humanities">Humanities</option>
                            </select>
                            <div class="validation-message" id="majorError"></div>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="residentialAddress">Residential Address <span class="required">*</span></label>
                        <textarea id="residentialAddress" name="residentialAddress" class="form-control" rows="3" required></textarea>
                        <div class="validation-message" id="residentialAddressError"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contactNumber">Primary Contact Number <span class="required">*</span></label>
                            <input type="tel" id="contactNumber" name="contactNumber" class="form-control" required>
                            <div class="validation-message" id="contactNumberError"></div>
                        </div>
                    </div>
                    
                    <h3>Emergency Contact</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="emergencyContactName">Full Name <span class="required">*</span></label>
                            <input type="text" id="emergencyContactName" name="emergencyContactName" class="form-control" required>
                            <div class="validation-message" id="emergencyContactNameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="emergencyContactNumber">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="emergencyContactNumber" name="emergencyContactNumber" class="form-control" required>
                            <div class="validation-message" id="emergencyContactNumberError"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-navigation">
                    <button type="button" class="btn btn-next" data-next="2">Next: Document Uploads <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            
            <!-- Step 2: Document Uploads -->
            <div class="form-step hidden" id="step2">
                <div class="form-section">
                    <h2>Document Uploads</h2>
                    <p class="section-info">Please upload the required documents (JPEG, PNG, PDF - max 5MB per file)</p>
                    
                    <div class="document-upload-container">
                        <div class="upload-item">
                            <div class="upload-label">
                                <i class="fas fa-id-card"></i>
                                <span>Emirates ID <span class="required">*</span></span>
                            </div>
                            <div class="upload-zone" data-document-type="emirates_id">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag & drop your file here or</p>
                                <label for="emiratesId" class="upload-btn-sm">Browse Files</label>
                                <input type="file" id="emiratesId" name="emiratesId" accept="image/jpeg,image/png,application/pdf" required hidden>
                            </div>
                            <div class="file-preview" id="emiratesIdPreview"></div>
                            <div class="validation-message" id="emiratesIdError"></div>
                        </div>
                        
                        <div class="upload-item">
                            <div class="upload-label">
                                <i class="fas fa-passport"></i>
                                <span>Passport Front Page <span class="required">*</span></span>
                            </div>
                            <div class="upload-zone" data-document-type="passport">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag & drop your file here or</p>
                                <label for="passportDoc" class="upload-btn-sm">Browse Files</label>
                                <input type="file" id="passportDoc" name="passportDoc" accept="image/jpeg,image/png,application/pdf" required hidden>
                            </div>
                            <div class="file-preview" id="passportDocPreview"></div>
                            <div class="validation-message" id="passportDocError"></div>
                        </div>
                        
                        <div class="upload-item national-id-doc">
                            <div class="upload-label">
                                <i class="fas fa-id-card"></i>
                                <span>National ID <span class="required">*</span></span>
                            </div>
                            <div class="upload-zone" data-document-type="national_id">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag & drop your file here or</p>
                                <label for="nationalIdDoc" class="upload-btn-sm">Browse Files</label>
                                <input type="file" id="nationalIdDoc" name="nationalIdDoc" accept="image/jpeg,image/png,application/pdf" required hidden>
                            </div>
                            <div class="file-preview" id="nationalIdDocPreview"></div>
                            <div class="validation-message" id="nationalIdDocError"></div>
                        </div>
                        
                        <div class="upload-item birth-certificate">
                            <div class="upload-label">
                                <i class="fas fa-file-alt"></i>
                                <span>Birth Certificate <span class="required">*</span></span>
                            </div>
                            <div class="upload-zone" data-document-type="birth_certificate">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag & drop your file here or</p>
                                <label for="birthCertificate" class="upload-btn-sm">Browse Files</label>
                                <input type="file" id="birthCertificate" name="birthCertificate" accept="image/jpeg,image/png,application/pdf" required hidden>
                            </div>
                            <div class="file-preview" id="birthCertificatePreview"></div>
                            <div class="validation-message" id="birthCertificateError"></div>
                        </div>
                        
                        <div class="upload-item">
                            <div class="upload-label">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Academic Certificate <span class="note">(Only required for first-time registrants)</span></span>
                            </div>
                            <div class="upload-zone" data-document-type="academic_certificate">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag & drop your file here or</p>
                                <label for="academicCertificate" class="upload-btn-sm">Browse Files</label>
                                <input type="file" id="academicCertificate" name="academicCertificate" accept="image/jpeg,image/png,application/pdf" hidden>
                            </div>
                            <div class="file-preview" id="academicCertificatePreview"></div>
                            <div class="validation-message" id="academicCertificateError"></div>
                        </div>
                    </div>
                    
                    <div class="form-group transportation-section">
                        <h3>School Transportation</h3>
                        <p>Select your preferred transportation route</p>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="transportationCity">City</label>
                                <select id="transportationCity" name="transportationCity" class="form-control">
                                    <option value="">Select City</option>
                                    <?php
                                    // Include database connection
                                    require_once 'db-connection.php';
                                    
                                    // Get distinct cities from routes table
                                    $sql = "SELECT DISTINCT city FROM routes ORDER BY city";
                                    $stmt = $pdo->query($sql);
                                    
                                    while ($row = $stmt->fetch()) {
                                        echo '<option value="' . htmlspecialchars($row['city']) . '">' . htmlspecialchars($row['city']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="transportationRoute">Route</label>
                                <select id="transportationRoute" name="transportationRoute" class="form-control" disabled>
                                    <option value="">Select Route</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transportationLocation">Pickup Location</label>
                            <input type="text" id="transportationLocation" name="transportationLocation" class="form-control" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group agreement-checkbox">
                        <label class="checkbox-container">
                            <input type="checkbox" id="schoolPolicies" name="schoolPolicies" required>
                            <span class="checkmark"></span>
                            I acknowledge and agree to the school policies regarding document submissions
                        </label>
                        <div class="validation-message" id="schoolPoliciesError"></div>
                    </div>
                </div>
                
                <div class="form-navigation">
                    <button type="button" class="btn btn-prev" data-prev="1"><i class="fas fa-arrow-left"></i> Previous</button>
                    <button type="button" class="btn btn-next" data-next="3">Next: Father's Information <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            
            <!-- Step 3: Father's Information -->
            <div class="form-step hidden" id="step3">
                <div class="form-section">
                    <h2>Father's Information</h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fatherFullName">Full Name <span class="required">*</span></label>
                            <input type="text" id="fatherFullName" name="fatherFullName" class="form-control" required>
                            <div class="validation-message" id="fatherFullNameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="fatherNationality">Nationality <span class="required">*</span></label>
                            <select id="fatherNationality" name="fatherNationality" class="form-control" required>
                                <option value="">Select Nationality</option>
                                <optgroup label="Priority Countries">
                                    <option value="Iran">Iran</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="UAE">UAE</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Iraq">Iraq</option>
                                </optgroup>
                                <optgroup label="Other Countries">
                                    <!-- Other countries will be loaded via JavaScript -->
                                </optgroup>
                            </select>
                            <div class="validation-message" id="fatherNationalityError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fatherDateOfBirth">Date of Birth <span class="required">*</span></label>
                            <input type="date" id="fatherDateOfBirth" name="fatherDateOfBirth" class="form-control date-picker" required>
                            <div class="validation-message" id="fatherDateOfBirthError"></div>
                        </div>
                        <div class="form-group id-section">
                            <div class="id-toggle">
                                <label class="toggle-label active" data-target="fatherNationalIdSection">National ID</label>
                                <label class="toggle-label" data-target="fatherPassportSection">Passport Number</label>
                            </div>
                            <div class="id-input-section" id="fatherNationalIdSection">
                                <input type="text" id="fatherNationalId" name="fatherNationalId" class="form-control" placeholder="National ID">
                                <div class="validation-message" id="fatherNationalIdError"></div>
                            </div>
                            <div class="id-input-section hidden" id="fatherPassportSection">
                                <input type="text" id="fatherPassportNumber" name="fatherPassportNumber" class="form-control" placeholder="Passport Number">
                                <div class="validation-message" id="fatherPassportNumberError"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fatherEducation">Educational Background <span class="required">*</span></label>
                            <select id="fatherEducation" name="fatherEducation" class="form-control" required>
                                <option value="">Select Education</option>
                                <option value="High School">High School</option>
                                <option value="Bachelor's">Bachelor's</option>
                                <option value="Master's">Master's</option>
                                <option value="PhD">PhD</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="validation-message" id="fatherEducationError"></div>
                        </div>
                        <div class="form-group">
                            <label for="fatherOccupation">Occupation <span class="required">*</span></label>
                            <input type="text" id="fatherOccupation" name="fatherOccupation" class="form-control" required>
                            <div class="validation-message" id="fatherOccupationError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fatherLandline">Landline Number</label>
                            <input type="tel" id="fatherLandline" name="fatherLandline" class="form-control">
                            <div class="validation-message" id="fatherLandlineError"></div>
                        </div>
                        <div class="form-group">
                            <label for="fatherMobile">Mobile Number <span class="required">*</span></label>
                            <input type="tel" id="fatherMobile" name="fatherMobile" class="form-control" required>
                            <div class="validation-message" id="fatherMobileError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fatherWhatsapp">WhatsApp Number</label>
                            <input type="tel" id="fatherWhatsapp" name="fatherWhatsapp" class="form-control">
                            <div class="validation-message" id="fatherWhatsappError"></div>
                        </div>
                        <div class="form-group">
                            <label for="fatherEmail">Email Address <span class="required">*</span></label>
                            <input type="email" id="fatherEmail" name="fatherEmail" class="form-control" required>
                            <div class="validation-message" id="fatherEmailError"></div>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="fatherWorkAddress">Work Address</label>
                        <textarea id="fatherWorkAddress" name="fatherWorkAddress" class="form-control" rows="3"></textarea>
                        <div class="validation-message" id="fatherWorkAddressError"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fatherEmployeeCode">Employee Code (if applicable for school staff)</label>
                            <input type="text" id="fatherEmployeeCode" name="fatherEmployeeCode" class="form-control">
                            <div class="validation-message" id="fatherEmployeeCodeError"></div>
                        </div>
                    </div>
                    
                    <div class="form-group medical-condition">
                        <label>Does the father have any medical conditions that the school should be aware of?</label>
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="fatherMedicalCondition" value="No" checked>
                                <span class="radio-checkmark"></span>
                                No
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="fatherMedicalCondition" value="Yes">
                                <span class="radio-checkmark"></span>
                                Yes
                            </label>
                        </div>
                        <div class="form-group medical-details hidden" id="fatherMedicalDetails">
                            <label for="fatherMedicalConditionDetails">Please specify the medical condition</label>
                            <textarea id="fatherMedicalConditionDetails" name="fatherMedicalConditionDetails" class="form-control" rows="3"></textarea>
                            <div class="validation-message" id="fatherMedicalConditionDetailsError"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-navigation">
                    <button type="button" class="btn btn-prev" data-prev="2"><i class="fas fa-arrow-left"></i> Previous</button>
                    <button type="button" class="btn btn-next" data-next="4">Next: Mother's Information <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            
            <!-- Step 4: Mother's Information -->
            <div class="form-step hidden" id="step4">
                <div class="form-section">
                    <h2>Mother's Information</h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="motherFullName">Full Name <span class="required">*</span></label>
                            <input type="text" id="motherFullName" name="motherFullName" class="form-control" required>
                            <div class="validation-message" id="motherFullNameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="motherNationality">Nationality <span class="required">*</span></label>
                            <select id="motherNationality" name="motherNationality" class="form-control" required>
                                <option value="">Select Nationality</option>
                                <optgroup label="Priority Countries">
                                    <option value="Iran">Iran</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="UAE">UAE</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Iraq">Iraq</option>
                                </optgroup>
                                <optgroup label="Other Countries">
                                    <!-- Other countries will be loaded via JavaScript -->
                                </optgroup>
                            </select>
                            <div class="validation-message" id="motherNationalityError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="motherDateOfBirth">Date of Birth <span class="required">*</span></label>
                            <input type="date" id="motherDateOfBirth" name="motherDateOfBirth" class="form-control date-picker" required>
                            <div class="validation-message" id="motherDateOfBirthError"></div>
                        </div>
                        <div class="form-group id-section">
                            <div class="id-toggle">
                                <label class="toggle-label active" data-target="motherNationalIdSection">National ID</label>
                                <label class="toggle-label" data-target="motherPassportSection">Passport Number</label>
                            </div>
                            <div class="id-input-section" id="motherNationalIdSection">
                                <input type="text" id="motherNationalId" name="motherNationalId" class="form-control" placeholder="National ID">
                                <div class="validation-message" id="motherNationalIdError"></div>
                            </div>
                            <div class="id-input-section hidden" id="motherPassportSection">
                                <input type="text" id="motherPassportNumber" name="motherPassportNumber" class="form-control" placeholder="Passport Number">
                                <div class="validation-message" id="motherPassportNumberError"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="motherEducation">Educational Background <span class="required">*</span></label>
                            <select id="motherEducation" name="motherEducation" class="form-control" required>
                                <option value="">Select Education</option>
                                <option value="High School">High School</option>
                                <option value="Bachelor's">Bachelor's</option>
                                <option value="Master's">Master's</option>
                                <option value="PhD">PhD</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="validation-message" id="motherEducationError"></div>
                        </div>
                        <div class="form-group">
                            <label for="motherOccupation">Occupation <span class="required">*</span></label>
                            <input type="text" id="motherOccupation" name="motherOccupation" class="form-control" required>
                            <div class="validation-message" id="motherOccupationError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="motherLandline">Landline Number</label>
                            <input type="tel" id="motherLandline" name="motherLandline" class="form-control">
                            <div class="validation-message" id="motherLandlineError"></div>
                        </div>
                        <div class="form-group">
                            <label for="motherMobile">Mobile Number <span class="required">*</span></label>
                            <input type="tel" id="motherMobile" name="motherMobile" class="form-control" required>
                            <div class="validation-message" id="motherMobileError"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="motherWhatsapp">WhatsApp Number</label>
                            <input type="tel" id="motherWhatsapp" name="motherWhatsapp" class="form-control">
                            <div class="validation-message" id="motherWhatsappError"></div>
                        </div>
                        <div class="form-group">
                            <label for="motherEmail">Email Address <span class="required">*</span></label>
                            <input type="email" id="motherEmail" name="motherEmail" class="form-control" required>
                            <div class="validation-message" id="motherEmailError"></div>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="motherWorkAddress">Work Address</label>
                        <textarea id="motherWorkAddress" name="motherWorkAddress" class="form-control" rows="3"></textarea>
                        <div class="validation-message" id="motherWorkAddressError"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="motherEmployeeCode">Employee Code (if applicable for school staff)</label>
                            <input type="text" id="motherEmployeeCode" name="motherEmployeeCode" class="form-control">
                            <div class="validation-message" id="motherEmployeeCodeError"></div>
                        </div>
                    </div>
                    
                    <div class="form-group medical-condition">
                        <label>Does the mother have any medical conditions that the school should be aware of?</label>
                        <div class="radio-group">
                            <label class="radio-container">
                                <input type="radio" name="motherMedicalCondition" value="No" checked>
                                <span class="radio-checkmark"></span>
                                No
                            </label>
                            <label class="radio-container">
                                <input type="radio" name="motherMedicalCondition" value="Yes">
                                <span class="radio-checkmark"></span>
                                Yes
                            </label>
                        </div>
                        <div class="form-group medical-details hidden" id="motherMedicalDetails">
                            <label for="motherMedicalConditionDetails">Please specify the medical condition</label>
                            <textarea id="motherMedicalConditionDetails" name="motherMedicalConditionDetails" class="form-control" rows="3"></textarea>
                            <div class="validation-message" id="motherMedicalConditionDetailsError"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-navigation">
                    <button type="button" class="btn btn-prev" data-prev="3"><i class="fas fa-arrow-left"></i> Previous</button>
                    <button type="button" class="btn btn-next" data-next="5">Next: Final Confirmation <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            
            <!-- Step 5: Final Confirmation & Submission -->
            <div class="form-step hidden" id="step5">
                <div class="form-section">
                    <h2>Final Confirmation & Submission</h2>
                    
                    <div class="form-group full-width">
                        <label for="specialNotes">Special Notes / Additional Requests (Optional)</label>
                        <textarea id="specialNotes" name="specialNotes" class="form-control" rows="4"></textarea>
                    </div>
                    
                    <div class="consent-section">
                        <h3>Consent and Agreements</h3>
                        
                        <div class="form-group agreement-checkbox">
                            <label class="checkbox-container">
                                <input type="checkbox" id="disciplinaryRules" name="disciplinaryRules" required>
                                <span class="checkmark"></span>
                                I have carefully read and fully agree to abide by the Salman Farsi School Disciplinary Rules.
                            </label>
                            <div class="validation-message" id="disciplinaryRulesError"></div>
                        </div>
                        
                        <div class="form-group agreement-checkbox">
                            <label class="checkbox-container">
                                <input type="checkbox" id="termsConditions" name="termsConditions" required>
                                <span class="checkmark"></span>
                                I acknowledge and accept the Terms & Conditions of student registration.
                            </label>
                            <div class="validation-message" id="termsConditionsError"></div>
                        </div>
                    </div>
                    
                    <div class="summary-section hidden">
                        <h3>Registration Summary</h3>
                        <div id="registrationSummary"></div>
                    </div>
                </div>
                
                <div class="form-navigation">
                    <button type="button" class="btn btn-prev" data-prev="4"><i class="fas fa-arrow-left"></i> Previous</button>
                    <button type="button" class="btn btn-review">Review Application</button>
                    <button type="submit" class="btn btn-submit hidden">Submit Application</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="modal" id="summaryModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Please Review Your Application</h2>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal-close">Make Changes</button>
                <button type="button" class="btn btn-confirm-submit">Confirm & Submit</button>
            </div>
        </div>
    </div>
    
    <footer class="site-footer">
        <div class="footer-content">
            <p>&copy; 2025 Salman Farsi School. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/translations.js"></script>
    <script src="js/script.js"></script>
</body>
</html>