$(document).ready(function() {
    // Generate a unique form token for session tracking
    const formToken = generateUUID();
    $('#form_token').val(formToken);
    
    // Initialize localStorage with form token if not exists
    if (!localStorage.getItem(`form_data_${formToken}`)) {
        localStorage.setItem(`form_data_${formToken}`, JSON.stringify({}));
    }
    
    // Populate countries dropdown
    populateCountries();
    
    // Setup file upload previews
    setupFileUploads();
    
    // Setup form navigation
    setupFormNavigation();
    
    // Setup conditional form fields
    setupConditionalFields();
    
    // Setup validation
    setupValidation();
    
    // Setup language toggle
    setupLanguageToggle();
    
    // Setup ID toggles
    setupIdToggles();
    
    // Restore form data from localStorage if available
    restoreFormData();

    // Auto-save form data on input change
    setupAutoSave();
});

/**
 * Generate a UUID for form token
 */
function generateUUID() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        const r = Math.random() * 16 | 0;
        const v = c === 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

/**
 * Populate countries dropdown
 */
function populateCountries() {
    const countries = [
        "Albania", "Algeria", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", 
        "Bahrain", "Bangladesh", "Belarus", "Belgium", "Bolivia", "Bosnia", "Brazil", "Brunei", 
        "Bulgaria", "Cambodia", "Cameroon", "Canada", "Chile", "China", "Colombia", "Costa Rica", 
        "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Dominican Republic", "Ecuador", 
        "Egypt", "Estonia", "Ethiopia", "Finland", "France", "Georgia", "Germany", "Ghana", "Greece", 
        "Guatemala", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Ireland", 
        "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyzstan", 
        "Latvia", "Lebanon", "Libya", "Lithuania", "Luxembourg", "Malaysia", "Maldives", "Malta", 
        "Mexico", "Moldova", "Mongolia", "Montenegro", "Morocco", "Myanmar", "Nepal", "Netherlands", 
        "New Zealand", "Nicaragua", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", 
        "Palestine", "Panama", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", 
        "Romania", "Russia", "Saudi Arabia", "Senegal", "Serbia", "Singapore", "Slovakia", "Slovenia", 
        "Somalia", "South Africa", "South Korea", "Spain", "Sri Lanka", "Sudan", "Sweden", "Switzerland", 
        "Syria", "Taiwan", "Tanzania", "Thailand", "Tunisia", "Turkmenistan", "Uganda", "Ukraine", 
        "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Venezuela", "Vietnam", "Yemen", 
        "Zambia", "Zimbabwe"
    ];
    
    const nationalitySelects = ['nationality', 'fatherNationality', 'motherNationality'];
    
    nationalitySelects.forEach(selectId => {
        const otherCountriesOptgroup = $(`#${selectId} optgroup[label="Other Countries"]`);
        
        countries.forEach(country => {
            otherCountriesOptgroup.append(`<option value="${country}">${country}</option>`);
        });
    });
}

/**
 * Setup file upload previews
 */
function setupFileUploads() {
    // Profile photo upload preview
    $('#profilePhoto').change(function() {
        const file = this.files[0];
        if (file) {
            if (validateFileSize(file, 2) && validateFileType(file, ['image/jpeg', 'image/png'])) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profilePhotoPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                $('#profilePhotoError').text('');
            } else {
                $('#profilePhotoError').text('Please upload a JPEG or PNG file under 2MB.');
                this.value = '';
            }
        }
    });
    
    // Document uploads
    const documentInputs = ['emiratesId', 'passportDoc', 'nationalIdDoc', 'birthCertificate', 'academicCertificate'];
    
    documentInputs.forEach(inputId => {
        $(`#${inputId}`).change(function() {
            const file = this.files[0];
            if (file) {
                if (validateFileSize(file, 5) && validateFileType(file, ['image/jpeg', 'image/png', 'application/pdf'])) {
                    showFilePreview(inputId, file);
                    $(`#${inputId}Error`).text('');
                } else {
                    $(`#${inputId}Error`).text('Please upload a JPEG, PNG, or PDF file under 5MB.');
                    this.value = '';
                }
            }
        });
    });
    
    // Drag and drop functionality
    $('.upload-zone').each(function() {
        const dropZone = $(this);
        const inputId = dropZone.find('input[type="file"]').attr('id');
        
        dropZone.on('dragover', function(e) {
            e.preventDefault();
            dropZone.addClass('drag-over');
        });
        
        dropZone.on('dragleave', function() {
            dropZone.removeClass('drag-over');
        });
        
        dropZone.on('drop', function(e) {
            e.preventDefault();
            dropZone.removeClass('drag-over');
            
            const file = e.originalEvent.dataTransfer.files[0];
            if (file) {
                const input = document.getElementById(inputId);
                
                // Set the file to the input element
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
                
                // Trigger the change event
                $(input).trigger('change');
            }
        });
        
        dropZone.on('click', function() {
            $(`#${inputId}`).click();
        });
    });
}

/**
 * Validate file size
 */
function validateFileSize(file, maxSizeMB) {
    return file.size <= maxSizeMB * 1024 * 1024;
}

/**
 * Validate file type
 */
function validateFileType(file, allowedTypes) {
    return allowedTypes.includes(file.type);
}

/**
 * Show file preview
 */
function showFilePreview(inputId, file) {
    const previewContainer = $(`#${inputId}Preview`);
    previewContainer.empty();
    
    const fileExtension = file.name.split('.').pop().toLowerCase();
    let iconClass = 'fas fa-file';
    
    if (['jpg', 'jpeg'].includes(fileExtension)) {
        iconClass = 'fas fa-file-image file-jpg-icon';
    } else if (fileExtension === 'png') {
        iconClass = 'fas fa-file-image file-png-icon';
    } else if (fileExtension === 'pdf') {
        iconClass = 'fas fa-file-pdf file-pdf-icon';
    }
    
    const fileItem = `
        <div class="file-item">
            <div class="file-item-name">
                <i class="${iconClass}"></i>
                <span>${file.name}</span>
            </div>
            <div class="file-item-actions">
                <i class="fas fa-times remove-file" data-input="${inputId}"></i>
            </div>
        </div>
    `;
    
    previewContainer.append(fileItem);
    
    // Remove file functionality
    $(`.remove-file[data-input="${inputId}"]`).click(function() {
        $(`#${inputId}`).val('');
        previewContainer.empty();
    });
}

/**
 * Setup form navigation
 */
function setupFormNavigation() {
    // Next button click
    $('.btn-next').click(function() {
        const currentStep = parseInt($(this).data('next')) - 1;
        const nextStep = parseInt($(this).data('next'));
        
        if (validateStep(currentStep)) {
            saveFormData();
            goToStep(nextStep);
        }
    });
    
    // Previous button click
    $('.btn-prev').click(function() {
        const prevStep = parseInt($(this).data('prev'));
        saveFormData();
        goToStep(prevStep);
    });
    
    // Step indicator click
    $('.progress-steps li').click(function() {
        const clickedStep = parseInt($(this).data('step'));
        const currentStep = parseInt($('#current_step').val());
        
        // Only allow clicking on completed steps or the next step
        if (clickedStep < currentStep || clickedStep === currentStep) {
            if (validateStep(currentStep - 1) || clickedStep < currentStep) {
                saveFormData();
                goToStep(clickedStep);
            }
        }
    });
    
    // Review button click
    $('.btn-review').click(function() {
        if (validateStep(4)) {
            saveFormData();
            generateSummary();
            $('#summaryModal').css('display', 'block');
        }
    });
    
    // Modal close button
    $('.close-modal, .btn-modal-close').click(function() {
        $('#summaryModal').css('display', 'none');
    });
    
    // Confirm and submit button
    $('.btn-confirm-submit').click(function() {
        $('#summaryModal').css('display', 'none');
        $('.btn-review').addClass('hidden');
        $('.btn-submit').removeClass('hidden');
    });
    
    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function(event) {
        if (event.target === document.getElementById('summaryModal')) {
            $('#summaryModal').css('display', 'none');
        }
    });
    
    // Form submission
    $('#registrationForm').submit(function(e) {
        e.preventDefault();
        
        // Show loading state
        $('.btn-submit').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');
        
        // Convert form to FormData for file uploads
        const formData = new FormData(this);
        
        // AJAX form submission
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    
                    if (result.success) {
                        // Clear form data from localStorage
                        localStorage.removeItem(`form_data_${$('#form_token').val()}`);
                        
                        // Redirect to success page or show success message
                        window.location.href = 'registration-success.php?id=' + result.registration_id;
                    } else {
                        // Show error message
                        alert('Error: ' + result.message);
                        $('.btn-submit').prop('disabled', false).html('Submit Application');
                    }
                } catch (e) {
                    console.error('Invalid JSON response', e);
                    alert('An unexpected error occurred. Please try again.');
                    $('.btn-submit').prop('disabled', false).html('Submit Application');
                }
            },
            error: function() {
                alert('An error occurred while submitting the form. Please try again.');
                $('.btn-submit').prop('disabled', false).html('Submit Application');
            }
        });
    });
}

/**
 * Navigate to a specific step
 */
function goToStep(step) {
    // Hide all steps
    $('.form-step').addClass('hidden');
    
    // Show the target step
    $(`#step${step}`).removeClass('hidden');
    
    // Update the current step value
    $('#current_step').val(step);
    
    // Update the progress indicators
    updateProgressIndicators(step);
    
    // Scroll to top of the form
    $('html, body').animate({
        scrollTop: $('.container').offset().top - 50
    }, 300);
}

/**
 * Update progress indicators
 */
function updateProgressIndicators(currentStep) {
    $('.progress-steps li').removeClass('active completed');
    
    for (let i = 1; i <= 5; i++) {
        if (i < currentStep) {
            $(`.progress-steps li[data-step="${i}"]`).addClass('completed');
        } else if (i === currentStep) {
            $(`.progress-steps li[data-step="${i}"]`).addClass('active');
        }
    }
}

/**
 * Setup conditional form fields
 */
function setupConditionalFields() {
    // Academic Grade conditional field (Major selection for grades 10-12)
    $('#academicGrade').change(function() {
        const grade = parseInt($(this).val());
        
        if (grade >= 10 && grade <= 12) {
            $('.major-section').removeClass('hidden');
            $('#major').prop('required', true);
        } else {
            $('.major-section').addClass('hidden');
            $('#major').prop('required', false).val('');
        }
    });
    
    // Transportation route selection based on city
    $('#transportationCity').change(function() {
        const city = $(this).val();
        
        if (city) {
            $('#transportationRoute').prop('disabled', false);
            populateTransportationRoutes(city);
        } else {
            $('#transportationRoute').prop('disabled', true).val('');
            $('#transportationLocation').prop('disabled', true).val('');
        }
    });
    
    $('#transportationRoute').change(function() {
        if ($(this).val()) {
            $('#transportationLocation').prop('disabled', false);
        } else {
            $('#transportationLocation').prop('disabled', true).val('');
        }
    });
    
    // Medical condition details for father
    $('input[name="fatherMedicalCondition"]').change(function() {
        if ($(this).val() === 'Yes') {
            $('#fatherMedicalDetails').removeClass('hidden');
            $('#fatherMedicalConditionDetails').prop('required', true);
        } else {
            $('#fatherMedicalDetails').addClass('hidden');
            $('#fatherMedicalConditionDetails').prop('required', false).val('');
        }
    });
    
    // Medical condition details for mother
    $('input[name="motherMedicalCondition"]').change(function() {
        if ($(this).val() === 'Yes') {
            $('#motherMedicalDetails').removeClass('hidden');
            $('#motherMedicalConditionDetails').prop('required', true);
        } else {
            $('#motherMedicalDetails').addClass('hidden');
            $('#motherMedicalConditionDetails').prop('required', false).val('');
        }
    });
    
    // Emirates ID is always required now
    // National ID and Birth Certificate fields visibility based on nationality
    $('#nationality').change(function() {
        if ($(this).val() === 'Iran') {
            $('.national-id-doc, .birth-certificate').removeClass('hidden');
            $('#nationalIdDoc, #birthCertificate').prop('required', true);
        } else {
            $('.national-id-doc, .birth-certificate').addClass('hidden');
            $('#nationalIdDoc, #birthCertificate').prop('required', false);
        }
    });
}

/**
 * Populate transportation routes based on city
 */
function populateTransportationRoutes(city) {
    const routeSelect = $('#transportationRoute');
    routeSelect.empty().append('<option value="">Select Route</option>');

    // AJAX call to get routes from the database
    $.ajax({
        url: 'get-routes.php',
        type: 'POST',
        data: { city: city },
        dataType: 'json',
        success: function(routes) {
            if (routes && routes.length > 0) {
                routes.forEach(route => {
                    routeSelect.append(`<option value="${route.id}">${route.name}</option>`);
                });
            }
        },
        error: function() {
            console.error('Failed to fetch routes');
            
            // Fallback to static routes if AJAX fails
            const staticRoutes = {
                'Sharjah': [
                    { id: 1, name: 'Route 1 - Qafiya, First Al Taawun Roundabout' },
                    { id: 2, name: 'Route 2 - Al Muteena, King Faisal Road' },
                    { id: 3, name: 'Route 3 - Al Majaz' }
                ],
                'Dubai': [
                    { id: 4, name: 'Route 4 - Al Safa, Bur Dubai' }
                ],
                'Ajman': [
                    { id: 5, name: 'Route 5 - Central Ajman locations' }
                ]
            };
            
            if (staticRoutes[city]) {
                staticRoutes[city].forEach(route => {
                    routeSelect.append(`<option value="${route.id}">${route.name}</option>`);
                });
            }
        }
    });
}

/**
 * Setup validation
 */
function setupValidation() {
    // Email validation
    $('#fatherEmail, #motherEmail').blur(function() {
        const email = $(this).val();
        const emailError = $(`#${$(this).attr('id')}Error`);
        
        if (email && !isValidEmail(email)) {
            emailError.text('Please enter a valid email address.');
            $(this).addClass('error');
        } else {
            emailError.text('');
            $(this).removeClass('error');
        }
    });
    
    // Phone number validation
    $('#contactNumber, #emergencyContactNumber, #fatherMobile, #motherMobile').blur(function() {
        const phone = $(this).val();
        const phoneError = $(`#${$(this).attr('id')}Error`);
        
        if (phone && !isValidPhone(phone)) {
            phoneError.text('Please enter a valid phone number.');
            $(this).addClass('error');
        } else {
            phoneError.text('');
            $(this).removeClass('error');
        }
    });
    
    // National ID validation for Iranian nationals
    $('#nationalId, #fatherNationalId, #motherNationalId').blur(function() {
        const nationalId = $(this).val();
        const idError = $(`#${$(this).attr('id')}Error`);
        
        if (nationalId && !isValidIranianNationalId(nationalId)) {
            idError.text('Please enter a valid 10-digit National ID.');
            $(this).addClass('error');
        } else {
            idError.text('');
            $(this).removeClass('error');
        }
    });
}

/**
 * Validate a specific form step
 */
function validateStep(step) {
    let isValid = true;
    
    // Reset all error messages
    $('.validation-message').text('');
    $('.form-control').removeClass('error');
    
    // Specific validation for each step
    switch(step) {
        case 1:
            // Student Information validation
            isValid = validateStudentInfo();
            break;
        case 2:
            // Document uploads validation
            isValid = validateDocuments();
            break;
        case 3:
            // Father's information validation
            isValid = validateParentInfo('father');
            break;
        case 4:
            // Mother's information validation
            isValid = validateParentInfo('mother');
            break;
        case 5:
            // Final confirmation validation
            isValid = validateFinalStep();
            break;
    }
    
    return isValid;
}

/**
 * Validate student information
 */
function validateStudentInfo() {
    let isValid = true;
    
    // Required fields validation
    $('#step1 input[required], #step1 select[required], #step1 textarea[required]').each(function() {
        if (!$(this).val()) {
            $(`#${$(this).attr('id')}Error`).text('This field is required.');
            $(this).addClass('error');
            isValid = false;
        }
    });

    // Profile photo validation (now required)
    if (!$('#profilePhoto').val()) {
        $('#profilePhotoError').text('Profile photo is required.');
        isValid = false;
    }
    
    // National ID or Passport Number validation
    if (!$('#nationalId').val() && !$('#passportNumber').val()) {
        $('#nationalIdError, #passportNumberError').text('Either National ID or Passport Number is required.');
        $('#nationalId, #passportNumber').addClass('error');
        isValid = false;
    }
    
    // Email validation
    const email = $('#email').val();
    if (email && !isValidEmail(email)) {
        $('#emailError').text('Please enter a valid email address.');
        $('#email').addClass('error');
        isValid = false;
    }
    
    // Phone number validation
    const phone = $('#contactNumber').val();
    if (phone && !isValidPhone(phone)) {
        $('#contactNumberError').text('Please enter a valid phone number.');
        $('#contactNumber').addClass('error');
        isValid = false;
    }
    
    const emergencyPhone = $('#emergencyContactNumber').val();
    if (emergencyPhone && !isValidPhone(emergencyPhone)) {
        $('#emergencyContactNumberError').text('Please enter a valid phone number.');
        $('#emergencyContactNumber').addClass('error');
        isValid = false;
    }
    
    // Check if major is selected for grades 10-12
    const grade = parseInt($('#academicGrade').val());
    if (grade >= 10 && grade <= 12 && !$('#major').val()) {
        $('#majorError').text('Please select a major.');
        $('#major').addClass('error');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Validate document uploads
 */
function validateDocuments() {
    let isValid = true;
    
    // Emirates ID is always required
    if (!$('#emiratesId').val()) {
        $('#emiratesIdError').text('Emirates ID is required.');
        isValid = false;
    }
    
    if (!$('#passportDoc').val()) {
        $('#passportDocError').text('Passport Front Page is required.');
        isValid = false;
    }
    
    if ($('#nationality').val() === 'Iran') {
        if (!$('#nationalIdDoc').val()) {
            $('#nationalIdDocError').text('National ID document is required for Iranian nationals.');
            isValid = false;
        }
        
        if (!$('#birthCertificate').val()) {
            $('#birthCertificateError').text('Birth Certificate is required for Iranian nationals.');
            isValid = false;
        }
    }
    
    // Academic Certificate is optional now (only for first-time registrants)
    
    // Check school policies agreement
    if (!$('#schoolPolicies').prop('checked')) {
        $('#schoolPoliciesError').text('You must acknowledge and agree to the school policies.');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Validate parent information
 */
function validateParentInfo(parent) {
    let isValid = true;
    
    // Required fields validation
    $(`#step${parent === 'father' ? 3 : 4} input[required], #step${parent === 'father' ? 3 : 4} select[required], #step${parent === 'father' ? 3 : 4} textarea[required]`).each(function() {
        if (!$(this).val()) {
            $(`#${$(this).attr('id')}Error`).text('This field is required.');
            $(this).addClass('error');
            isValid = false;
        }
    });
    
    // National ID or Passport Number validation
    if (!$(`#${parent}NationalId`).val() && !$(`#${parent}PassportNumber`).val()) {
        $(`#${parent}NationalIdError, #${parent}PassportNumberError`).text('Either National ID or Passport Number is required.');
        $(`#${parent}NationalId, #${parent}PassportNumber`).addClass('error');
        isValid = false;
    }
    
    // Email validation
    const email = $(`#${parent}Email`).val();
    if (email && !isValidEmail(email)) {
        $(`#${parent}EmailError`).text('Please enter a valid email address.');
        $(`#${parent}Email`).addClass('error');
        isValid = false;
    }
    
    // Phone number validation
    const mobile = $(`#${parent}Mobile`).val();
    if (mobile && !isValidPhone(mobile)) {
        $(`#${parent}MobileError`).text('Please enter a valid phone number.');
        $(`#${parent}Mobile`).addClass('error');
        isValid = false;
    }
    
    // Medical condition details if Yes is selected
    if ($(`input[name="${parent}MedicalCondition"]:checked`).val() === 'Yes' && !$(`#${parent}MedicalConditionDetails`).val()) {
        $(`#${parent}MedicalConditionDetailsError`).text('Please provide details about the medical condition.');
        $(`#${parent}MedicalConditionDetails`).addClass('error');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Validate final step
 */
function validateFinalStep() {
    let isValid = true;
    
    // Check agreement checkboxes
    if (!$('#disciplinaryRules').prop('checked')) {
        $('#disciplinaryRulesError').text('You must agree to the Disciplinary Rules.');
        isValid = false;
    }
    
    if (!$('#termsConditions').prop('checked')) {
        $('#termsConditionsError').text('You must accept the Terms & Conditions.');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Setup language toggle
 */
function setupLanguageToggle() {
    $('.language-toggle button').click(function() {
        const lang = $(this).data('lang');
        
        // Toggle active class
        $('.language-toggle button').removeClass('active');
        $(this).addClass('active');
        
        // Toggle RTL for Persian
        if (lang === 'fa') {
            $('body').addClass('rtl fa-font');
        } else {
            $('body').removeClass('rtl fa-font');
        }
        
        // Update text content based on selected language
        updateLanguage(lang);
        
        // Save language preference
        localStorage.setItem('preferred_language', lang);
    });
    
    // Set initial language based on saved preference
    const savedLang = localStorage.getItem('preferred_language') || 'en';
    $(`.language-toggle button[data-lang="${savedLang}"]`).click();
}

/**
 * Update page text content based on selected language
 * 
 * @param {string} lang Language code ('en' or 'fa')
 */
function updateLanguage(lang) {
    if (!translations[lang]) {
        return;
    }
    
    // Form header
    $('.title').text(translations[lang].form_title);
    $('.subtitle').text(translations[lang].form_subtitle);
    
    // Progress steps
    $('.progress-steps li[data-step="1"] .step-label').text(translations[lang].step1_label);
    $('.progress-steps li[data-step="2"] .step-label').text(translations[lang].step2_label);
    $('.progress-steps li[data-step="3"] .step-label').text(translations[lang].step3_label);
    $('.progress-steps li[data-step="4"] .step-label').text(translations[lang].step4_label);
    $('.progress-steps li[data-step="5"] .step-label').text(translations[lang].step5_label);
    
    // Student Information
    $('#step1 h2').text(translations[lang].student_info_title);
    $('.upload-btn').text(translations[lang].upload_profile_photo);
    $('.file-requirement').html(translations[lang].photo_requirements + ' <span class="required">*</span>');
    $('label[for="firstName"]').html(translations[lang].first_name + ' <span class="required">*</span>');
    $('label[for="lastName"]').html(translations[lang].last_name + ' <span class="required">*</span>');
    $('.toggle-label[data-target="nationalIdSection"]').text(translations[lang].national_id);
    $('.toggle-label[data-target="passportSection"]').text(translations[lang].passport_number);
    $('#nationalId').attr('placeholder', translations[lang].national_id);
    $('#passportNumber').attr('placeholder', translations[lang].passport_number);
    $('label[for="fatherName"]').html(translations[lang].father_name + ' <span class="required">*</span>');
    $('label[for="placeOfBirth"]').html(translations[lang].place_of_birth + ' <span class="required">*</span>');
    $('label[for="dateOfBirth"]').html(translations[lang].date_of_birth + ' <span class="required">*</span>');
    $('label[for="religion"]').html(translations[lang].religion + ' <span class="required">*</span>');
    $('#religion option:first').text(translations[lang].select_religion);
    
    // Update religion options
    $('#religion option').each(function() {
        const value = $(this).val();
        if (value && translations[lang][`religion_${value.toLowerCase().replace(' ', '_')}`]) {
            $(this).text(translations[lang][`religion_${value.toLowerCase().replace(' ', '_')}`]);
        }
    });
    
    $('label[for="nationality"]').html(translations[lang].nationality + ' <span class="required">*</span>');
    $('#nationality option:first').text(translations[lang].select_nationality);
    $('#nationality optgroup:first').attr('label', translations[lang].priority_countries);
    $('#nationality optgroup:last').attr('label', translations[lang].other_countries);
    $('label[for="academicGrade"]').html(translations[lang].academic_grade + ' <span class="required">*</span>');
    $('#academicGrade option:first').text(translations[lang].select_grade);
    // Update all grade options
    for (let i = 1; i <= 12; i++) {
        $(`#academicGrade option[value="${i}"]`).text(`${translations[lang].grade} ${i}`);
    }
    $('label[for="major"]').html(translations[lang].major + ' <span class="required">*</span>');
    $('#major option:first').text(translations[lang].select_major);
    
    // Update major options
    $('#major option').each(function() {
        const value = $(this).val();
        if (value && translations[lang][`major_${value.toLowerCase().replace(' & ', '_').replace(' ', '_')}`]) {
            $(this).text(translations[lang][`major_${value.toLowerCase().replace(' & ', '_').replace(' ', '_')}`]);
        }
    });
    
    $('label[for="residentialAddress"]').html(translations[lang].residential_address + ' <span class="required">*</span>');
    $('label[for="contactNumber"]').html(translations[lang].contact_number + ' <span class="required">*</span>');
    $('#step1 h3').text(translations[lang].emergency_contact);
    $('label[for="emergencyContactName"]').html(translations[lang].emergency_contact_name + ' <span class="required">*</span>');
    $('label[for="emergencyContactNumber"]').html(translations[lang].emergency_contact_number + ' <span class="required">*</span>');
    
    // Document Uploads
    $('#step2 h2').text(translations[lang].document_uploads_title);
    $('.section-info').text(translations[lang].document_requirements);
    $('.upload-label:eq(0) span').html(translations[lang].emirates_id + ' <span class="required">*</span>');
    $('.upload-label:eq(1) span').html(translations[lang].passport_front + ' <span class="required">*</span>');
    $('.upload-label:eq(2) span').html(translations[lang].national_id_doc + ' <span class="required">*</span>');
    $('.upload-label:eq(3) span').html(translations[lang].birth_certificate + ' <span class="required">*</span>');
    $('.upload-label:eq(4) span').html(translations[lang].academic_certificate + ' <span class="note">(' + translations[lang].only_first_time + ')</span>');
    $('.upload-zone p').text(translations[lang].drag_drop);
    $('.upload-btn-sm').text(translations[lang].browse_files);
    $('.transportation-section h3').text(translations[lang].transportation_title);
    $('.transportation-section > p').text(translations[lang].transportation_subtitle);
    $('label[for="transportationCity"]').text(translations[lang].transportation_city);
    $('#transportationCity option:first').text(translations[lang].select_city);
    $('label[for="transportationRoute"]').text(translations[lang].transportation_route);
    $('#transportationRoute option:first').text(translations[lang].select_route);
    $('label[for="transportationLocation"]').text(translations[lang].transportation_location);
    $('#step2 .agreement-checkbox label').contents().last()[0].textContent = ' ' + translations[lang].school_policies_agreement;
    
    // Father's Information
    $('#step3 h2').text(translations[lang].fathers_info_title);
    $('label[for="fatherFullName"]').html(translations[lang].full_name + ' <span class="required">*</span>');
    $('label[for="fatherNationality"]').html(translations[lang].nationality + ' <span class="required">*</span>');
    $('#fatherNationality option:first').text(translations[lang].select_nationality);
    $('#fatherNationality optgroup:first').attr('label', translations[lang].priority_countries);
    $('#fatherNationality optgroup:last').attr('label', translations[lang].other_countries);
    $('label[for="fatherDateOfBirth"]').html(translations[lang].date_of_birth + ' <span class="required">*</span>');
    $('#fatherNationalIdSection input').attr('placeholder', translations[lang].national_id);
    $('#fatherPassportSection input').attr('placeholder', translations[lang].passport_number);
    $('label[for="fatherEducation"]').html(translations[lang].education + ' <span class="required">*</span>');
    $('#fatherEducation option:first').text(translations[lang].select_education);
    
    // Update education options
    $('#fatherEducation option, #motherEducation option').each(function() {
        const value = $(this).val();
        if (value && translations[lang][`education_${value.toLowerCase().replace('\'', '').replace(' ', '_')}`]) {
            $(this).text(translations[lang][`education_${value.toLowerCase().replace('\'', '').replace(' ', '_')}`]);
        }
    });
    
    $('label[for="fatherOccupation"]').html(translations[lang].occupation + ' <span class="required">*</span>');
    $('label[for="fatherLandline"]').text(translations[lang].landline);
    $('label[for="fatherMobile"]').html(translations[lang].mobile_number + ' <span class="required">*</span>');
    $('label[for="fatherWhatsapp"]').text(translations[lang].whatsapp_number);
    $('label[for="fatherEmail"]').html(translations[lang].email + ' <span class="required">*</span>');
    $('label[for="fatherWorkAddress"]').text(translations[lang].work_address);
    $('label[for="fatherEmployeeCode"]').text(translations[lang].employee_code);
    $('#step3 .medical-condition > label').text(translations[lang].medical_condition_question);
    $('#step3 .radio-container:first-child').contents().last()[0].textContent = ' ' + translations[lang].no;
    $('#step3 .radio-container:last-child').contents().last()[0].textContent = ' ' + translations[lang].yes;
    $('label[for="fatherMedicalConditionDetails"]').text(translations[lang].medical_condition_details);
    
    // Mother's Information
    $('#step4 h2').text(translations[lang].mothers_info_title);
    $('label[for="motherFullName"]').html(translations[lang].full_name + ' <span class="required">*</span>');
    $('label[for="motherNationality"]').html(translations[lang].nationality + ' <span class="required">*</span>');
    $('#motherNationality option:first').text(translations[lang].select_nationality);
    $('#motherNationality optgroup:first').attr('label', translations[lang].priority_countries);
    $('#motherNationality optgroup:last').attr('label', translations[lang].other_countries);
    $('label[for="motherDateOfBirth"]').html(translations[lang].date_of_birth + ' <span class="required">*</span>');
    $('#motherNationalIdSection input').attr('placeholder', translations[lang].national_id);
    $('#motherPassportSection input').attr('placeholder', translations[lang].passport_number);
    $('label[for="motherEducation"]').html(translations[lang].education + ' <span class="required">*</span>');
    $('#motherEducation option:first').text(translations[lang].select_education);
    $('label[for="motherOccupation"]').html(translations[lang].occupation + ' <span class="required">*</span>');
    $('label[for="motherLandline"]').text(translations[lang].landline);
    $('label[for="motherMobile"]').html(translations[lang].mobile_number + ' <span class="required">*</span>');
    $('label[for="motherWhatsapp"]').text(translations[lang].whatsapp_number);
    $('label[for="motherEmail"]').html(translations[lang].email + ' <span class="required">*</span>');
    $('label[for="motherWorkAddress"]').text(translations[lang].work_address);
    $('label[for="motherEmployeeCode"]').text(translations[lang].employee_code);
    $('#step4 .medical-condition > label').text(translations[lang].medical_condition_question);
    $('#step4 .radio-container:first-child').contents().last()[0].textContent = ' ' + translations[lang].no;
    $('#step4 .radio-container:last-child').contents().last()[0].textContent = ' ' + translations[lang].yes;
    $('label[for="motherMedicalConditionDetails"]').text(translations[lang].medical_condition_details);
    
    // Final Confirmation
    $('#step5 h2').text(translations[lang].final_confirmation_title);
    $('label[for="specialNotes"]').text(translations[lang].special_notes);
    $('#step5 .consent-section h3').text(translations[lang].consent_agreements);
    $('#step5 .checkbox-container:eq(0) span.checkmark').next().text(' ' + translations[lang].disciplinary_rules_agreement);
    $('#step5 .checkbox-container:eq(1) span.checkmark').next().text(' ' + translations[lang].terms_conditions_agreement);
    
    // Navigation buttons
    $('.btn-prev').html(`<i class="fas fa-arrow-left"></i> ${translations[lang].previous}`);
    $('.btn-next[data-next="2"]').html(`${translations[lang].next_documents} <i class="fas fa-arrow-right"></i>`);
    $('.btn-next[data-next="3"]').html(`${translations[lang].next_father} <i class="fas fa-arrow-right"></i>`);
    $('.btn-next[data-next="4"]').html(`${translations[lang].next_mother} <i class="fas fa-arrow-right"></i>`);
    $('.btn-next[data-next="5"]').html(`${translations[lang].next_confirmation} <i class="fas fa-arrow-right"></i>`);
    $('.btn-review').text(translations[lang].review_application);
    $('.btn-submit').text(translations[lang].submit_application);
    
    // Modal
    $('.modal h2').text(translations[lang].review_title);
    $('.btn-modal-close').text(translations[lang].make_changes);
    $('.btn-confirm-submit').text(translations[lang].confirm_submit);
    
    // Footer
    $('.footer-content p').text(translations[lang].footer_copyright);
}

/**
 * Setup ID toggles
 */
function setupIdToggles() {
    // All ID toggles (student, father, mother)
    $('.id-toggle .toggle-label').click(function() {
        const target = $(this).data('target');
        const parent = $(this).closest('.id-section');
        
        // Toggle active class
        parent.find('.toggle-label').removeClass('active');
        $(this).addClass('active');
        
        // Toggle input sections
        parent.find('.id-input-section').addClass('hidden');
        parent.find(`#${target}`).removeClass('hidden');
        
        // Clear the values of hidden inputs
        parent.find('.id-input-section.hidden input').val('');
    });
}

/**
 * Save form data to localStorage
 */
function saveFormData() {
    const formData = {};
    
    // Collect form inputs, selects, and textareas
    $('#registrationForm input:not([type="file"]), #registrationForm select, #registrationForm textarea').each(function() {
        const inputType = $(this).attr('type');
        const name = $(this).attr('name');
        
        if (name) {
            if (inputType === 'radio' || inputType === 'checkbox') {
                if ($(this).prop('checked')) {
                    formData[name] = $(this).val();
                }
            } else {
                formData[name] = $(this).val();
            }
        }
    });
    
    // Save to localStorage
    const formToken = $('#form_token').val();
    localStorage.setItem(`form_data_${formToken}`, JSON.stringify(formData));
}

/**
 * Restore form data from localStorage
 */
function restoreFormData() {
    const formToken = $('#form_token').val();
    const savedData = localStorage.getItem(`form_data_${formToken}`);
    
    if (savedData) {
        const formData = JSON.parse(savedData);
        
        // Populate form inputs, selects, and textareas
        for (const name in formData) {
            const value = formData[name];
            const element = $(`[name="${name}"]`);
            
            if (element.length) {
                const inputType = element.attr('type');
                
                if (inputType === 'radio') {
                    $(`[name="${name}"][value="${value}"]`).prop('checked', true);
                } else if (inputType === 'checkbox') {
                    element.prop('checked', value === 'on' || value === true);
                } else {
                    element.val(value);
                }
                
                // Trigger change event for dependent fields
                element.trigger('change');
            }
        }
        
        // Additional steps for specific fields
        if (formData.current_step) {
            goToStep(parseInt(formData.current_step));
        }
    }
}

/**
 * Setup auto-save
 */
function setupAutoSave() {
    // Save on input change
    $('#registrationForm input, #registrationForm select, #registrationForm textarea').on('change', function() {
        saveFormData();
    });
    
    // Periodic save (every 30 seconds)
    setInterval(function() {
        saveFormData();
    }, 30000);
}

/**
 * Generate summary for final review
 */
function generateSummary() {
    const modalBody = $('.modal-body');
    modalBody.empty();
    
    const currentLang = $('.language-toggle button.active').data('lang');
    
    // Student Information
    const studentInfo = `
        <div class="summary-group">
            <h3>${translations[currentLang].student_info_title}</h3>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].full_name}:</div>
                <div class="summary-value">${$('#firstName').val()} ${$('#lastName').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].father_name}:</div>
                <div class="summary-value">${$('#fatherName').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">ID:</div>
                <div class="summary-value">${$('#nationalId').val() ? `${translations[currentLang].national_id}: ${$('#nationalId').val()}` : `${translations[currentLang].passport_number}: ${$('#passportNumber').val()}`}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].place_of_birth}:</div>
                <div class="summary-value">${$('#placeOfBirth').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].date_of_birth}:</div>
                <div class="summary-value">${$('#dateOfBirth').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].religion}:</div>
                <div class="summary-value">${$('#religion').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].nationality}:</div>
                <div class="summary-value">${$('#nationality').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].academic_grade}:</div>
                <div class="summary-value">${translations[currentLang].grade} ${$('#academicGrade').val()}${$('#major').val() ? ` - ${$('#major').val()}` : ''}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].residential_address}:</div>
                <div class="summary-value">${$('#residentialAddress').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].contact_number}:</div>
                <div class="summary-value">${$('#contactNumber').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].emergency_contact}:</div>
                <div class="summary-value">${$('#emergencyContactName').val()} (${$('#emergencyContactNumber').val()})</div>
            </div>
        </div>
    `;
    
    // Transportation Information
    let transportationInfo = '';
    if ($('#transportationCity').val()) {
        transportationInfo = `
            <div class="summary-group">
                <h3>${translations[currentLang].transportation_title}</h3>
                <div class="summary-item">
                    <div class="summary-label">${translations[currentLang].transportation_city}:</div>
                    <div class="summary-value">${$('#transportationCity').val()}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">${translations[currentLang].transportation_route}:</div>
                    <div class="summary-value">${$('#transportationRoute option:selected').text()}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">${translations[currentLang].transportation_location}:</div>
                    <div class="summary-value">${$('#transportationLocation').val()}</div>
                </div>
            </div>
        `;
    }
    
    // Father's Information
    const fatherInfo = `
        <div class="summary-group">
            <h3>${translations[currentLang].fathers_info_title}</h3>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].full_name}:</div>
                <div class="summary-value">${$('#fatherFullName').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].nationality}:</div>
                <div class="summary-value">${$('#fatherNationality').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].date_of_birth}:</div>
                <div class="summary-value">${$('#fatherDateOfBirth').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">ID:</div>
                <div class="summary-value">${$('#fatherNationalId').val() ? `${translations[currentLang].national_id}: ${$('#fatherNationalId').val()}` : `${translations[currentLang].passport_number}: ${$('#fatherPassportNumber').val()}`}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].education}:</div>
                <div class="summary-value">${$('#fatherEducation').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].occupation}:</div>
                <div class="summary-value">${$('#fatherOccupation').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].contact_numbers}:</div>
                <div class="summary-value">
                    ${translations[currentLang].mobile_number}: ${$('#fatherMobile').val()}<br>
                    ${$('#fatherLandline').val() ? `${translations[currentLang].landline}: ${$('#fatherLandline').val()}<br>` : ''}
                    ${$('#fatherWhatsapp').val() ? `${translations[currentLang].whatsapp_number}: ${$('#fatherWhatsapp').val()}` : ''}
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].email}:</div>
                <div class="summary-value">${$('#fatherEmail').val()}</div>
            </div>
            ${$('#fatherWorkAddress').val() ? `
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].work_address}:</div>
                <div class="summary-value">${$('#fatherWorkAddress').val()}</div>
            </div>
            ` : ''}
            ${$('#fatherEmployeeCode').val() ? `
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].employee_code}:</div>
                <div class="summary-value">${$('#fatherEmployeeCode').val()}</div>
            </div>
            ` : ''}
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].medical_condition_question_short}:</div>
                <div class="summary-value">${$('input[name="fatherMedicalCondition"]:checked').val() === 'Yes' ? 
                    translations[currentLang].yes + ' - ' + $('#fatherMedicalConditionDetails').val() : 
                    translations[currentLang].no}</div>
            </div>
        </div>
    `;
    
    // Mother's Information
    const motherInfo = `
        <div class="summary-group">
            <h3>${translations[currentLang].mothers_info_title}</h3>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].full_name}:</div>
                <div class="summary-value">${$('#motherFullName').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].nationality}:</div>
                <div class="summary-value">${$('#motherNationality').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].date_of_birth}:</div>
                <div class="summary-value">${$('#motherDateOfBirth').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">ID:</div>
                <div class="summary-value">${$('#motherNationalId').val() ? `${translations[currentLang].national_id}: ${$('#motherNationalId').val()}` : `${translations[currentLang].passport_number}: ${$('#motherPassportNumber').val()}`}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].education}:</div>
                <div class="summary-value">${$('#motherEducation').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].occupation}:</div>
                <div class="summary-value">${$('#motherOccupation').val()}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].contact_numbers}:</div>
                <div class="summary-value">
                    ${translations[currentLang].mobile_number}: ${$('#motherMobile').val()}<br>
                    ${$('#motherLandline').val() ? `${translations[currentLang].landline}: ${$('#motherLandline').val()}<br>` : ''}
                    ${$('#motherWhatsapp').val() ? `${translations[currentLang].whatsapp_number}: ${$('#motherWhatsapp').val()}` : ''}
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].email}:</div>
                <div class="summary-value">${$('#motherEmail').val()}</div>
            </div>
            ${$('#motherWorkAddress').val() ? `
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].work_address}:</div>
                <div class="summary-value">${$('#motherWorkAddress').val()}</div>
            </div>
            ` : ''}
            ${$('#motherEmployeeCode').val() ? `
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].employee_code}:</div>
                <div class="summary-value">${$('#motherEmployeeCode').val()}</div>
            </div>
            ` : ''}
            <div class="summary-item">
                <div class="summary-label">${translations[currentLang].medical_condition_question_short}:</div>
                <div class="summary-value">${$('input[name="motherMedicalCondition"]:checked').val() === 'Yes' ? 
                    translations[currentLang].yes + ' - ' + $('#motherMedicalConditionDetails').val() : 
                    translations[currentLang].no}</div>
            </div>
        </div>
    `;
    
    // Additional Notes
    let additionalNotes = '';
    if ($('#specialNotes').val()) {
        additionalNotes = `
            <div class="summary-group">
                <h3>${translations[currentLang].special_notes}</h3>
                <div class="summary-item">
                    <div class="summary-value">${$('#specialNotes').val()}</div>
                </div>
            </div>
        `;
    }
    
    // Append all sections to the modal body
    modalBody.append(studentInfo + transportationInfo + fatherInfo + motherInfo + additionalNotes);
}

/**
 * Email validation
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Phone number validation
 */
function isValidPhone(phone) {
    // Basic international phone format validation
    const phoneRegex = /^\+?[0-9\s\-\(\)]{8,20}$/;
    return phoneRegex.test(phone);
}

/**
 * Iranian National ID validation
 */
function isValidIranianNationalId(nationalId) {
    // Basic 10-digit validation for Iranian National ID
    const idRegex = /^[0-9]{10}$/;
    return idRegex.test(nationalId);
}