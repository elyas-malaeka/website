/**
 * Language translations for the student registration form
 * Includes English and Persian translations
 */

const translations = {
    'en': {
        // Form header
        'form_title': 'Student Registration Form',
        'form_subtitle': 'Please complete all required fields to register your child at Salman Farsi School',
        
        // Progress steps
        'step1_label': 'Student Information',
        'step2_label': 'Document Uploads',
        'step3_label': 'Father\'s Information',
        'step4_label': 'Mother\'s Information',
        'step5_label': 'Confirmation',
        
        // Student Information
        'student_info_title': 'Student Information',
        'upload_profile_photo': 'Upload Profile Photo',
        'photo_requirements': 'JPEG/PNG, max size: 2MB',
        'first_name': 'First Name',
        'last_name': 'Last Name',
        'national_id': 'National ID',
        'passport_number': 'Passport Number',
        'father_name': 'Father\'s Name',
        'place_of_birth': 'Place of Birth',
        'date_of_birth': 'Date of Birth',
        'religion': 'Religion',
        'select_religion': 'Select Religion',
        'religion_shia_islam': 'Shia Islam',
        'religion_sunni_islam': 'Sunni Islam',
        'religion_christianity': 'Christianity',
        'religion_judaism': 'Judaism',
        'religion_other': 'Other',
        'nationality': 'Nationality',
        'select_nationality': 'Select Nationality',
        'priority_countries': 'Priority Countries',
        'other_countries': 'Other Countries',
        'academic_grade': 'Academic Grade',
        'select_grade': 'Select Grade',
        'grade': 'Grade',
        'major': 'Major',
        'select_major': 'Select Major',
        'major_technical_vocational': 'Technical & Vocational',
        'major_mathematics_physics': 'Mathematics & Physics',
        'major_experimental_sciences': 'Experimental Sciences',
        'major_humanities': 'Humanities',
        'residential_address': 'Residential Address',
        'contact_number': 'Primary Contact Number',
        'contact_numbers': 'Contact Numbers',
        'emergency_contact': 'Emergency Contact',
        'emergency_contact_name': 'Full Name',
        'emergency_contact_number': 'Phone Number',
        
        // Document Uploads
        'document_uploads_title': 'Document Uploads',
        'document_requirements': 'Please upload the required documents (JPEG, PNG, PDF - max 5MB per file)',
        'emirates_id': 'Emirates ID',
        'passport_front': 'Passport Front Page',
        'national_id_doc': 'National ID',
        'birth_certificate': 'Birth Certificate',
        'academic_certificate': 'Academic Certificate',
        'only_first_time': 'Only required for first-time registrants',
        'drag_drop': 'Drag & drop your file here or',
        'browse_files': 'Browse Files',
        'transportation_title': 'School Transportation',
        'transportation_subtitle': 'Select your preferred transportation route',
        'transportation_city': 'City',
        'select_city': 'Select City',
        'transportation_route': 'Route',
        'select_route': 'Select Route',
        'transportation_location': 'Pickup Location',
        'school_policies_agreement': 'I acknowledge and agree to the school policies regarding document submissions',
        
        // Father's Information
        'fathers_info_title': 'Father\'s Information',
        'full_name': 'Full Name',
        'nationality': 'Nationality',
        'date_of_birth': 'Date of Birth',
        'education': 'Educational Background',
        'select_education': 'Select Education',
        'education_high_school': 'High School',
        'education_bachelors': 'Bachelor\'s',
        'education_masters': 'Master\'s',
        'education_phd': 'PhD',
        'education_other': 'Other',
        'occupation': 'Occupation',
        'landline': 'Landline Number',
        'mobile_number': 'Mobile Number',
        'whatsapp_number': 'WhatsApp Number',
        'email': 'Email Address',
        'work_address': 'Work Address',
        'employee_code': 'Employee Code (if applicable for school staff)',
        'medical_condition_question': 'Does the father have any medical conditions that the school should be aware of?',
        'medical_condition_question_short': 'Medical Condition',
        'medical_condition_details': 'Please specify the medical condition',
        'yes': 'Yes',
        'no': 'No',
        
        // Mother's Information
        'mothers_info_title': 'Mother\'s Information',
        
        // Final Confirmation
        'final_confirmation_title': 'Final Confirmation & Submission',
        'special_notes': 'Special Notes / Additional Requests (Optional)',
        'consent_agreements': 'Consent and Agreements',
        'disciplinary_rules_agreement': 'I have carefully read and fully agree to abide by the Salman Farsi School Disciplinary Rules.',
        'terms_conditions_agreement': 'I acknowledge and accept the Terms & Conditions of student registration.',
        
        // Navigation buttons
        'previous': 'Previous',
        'next': 'Next',
        'next_documents': 'Next: Document Uploads',
        'next_father': 'Next: Father\'s Information',
        'next_mother': 'Next: Mother\'s Information',
        'next_confirmation': 'Next: Final Confirmation',
        'review_application': 'Review Application',
        'submit_application': 'Submit Application',
        
        // Modal
        'review_title': 'Please Review Your Application',
        'make_changes': 'Make Changes',
        'confirm_submit': 'Confirm & Submit',
        
        // Success Page
        'registration_successful': 'Registration Successful!',
        'thank_you_message': 'Thank you for registering at Salman Farsi School. Your application has been successfully submitted and is now being reviewed by our administration team.',
        'registration_id': 'Your Registration ID:',
        'save_id_message': 'Please save this ID for future reference',
        'next_steps': 'Next Steps:',
        'next_steps_1': 'Our administration team will review your application within 3-5 business days.',
        'next_steps_2': 'You will receive a confirmation email with further instructions.',
        'next_steps_3': 'Please prepare the original documents for verification when requested.',
        'next_steps_4': 'If additional information is needed, our team will contact you using the provided contact details.',
        'contact_message': 'If you have any questions, please contact our admissions office at',
        'print_confirmation': 'Print Confirmation',
        'return_home': 'Return to Homepage',
        
        // Footer
        'footer_copyright': '© 2025 Salman Farsi School. All rights reserved.',
        
        // Common
        'required': 'This field is required.',
        'select': 'Select',
        'note': 'note'
    },
    'fa': {
        // Form header
        'form_title': 'فرم ثبت نام دانش آموز',
        'form_subtitle': 'لطفاً تمام فیلدهای مورد نیاز را برای ثبت نام فرزندتان در مدرسه سلمان فارسی تکمیل کنید',
        
        // Progress steps
        'step1_label': 'اطلاعات دانش آموز',
        'step2_label': 'بارگذاری مدارک',
        'step3_label': 'اطلاعات پدر',
        'step4_label': 'اطلاعات مادر',
        'step5_label': 'تأیید نهایی',
        
        // Student Information
        'student_info_title': 'اطلاعات دانش آموز',
        'upload_profile_photo': 'بارگذاری عکس پروفایل',
        'photo_requirements': 'JPEG/PNG، حداکثر حجم: ۲ مگابایت',
        'first_name': 'نام',
        'last_name': 'نام خانوادگی',
        'national_id': 'کد ملی',
        'passport_number': 'شماره پاسپورت',
        'father_name': 'نام پدر',
        'place_of_birth': 'محل تولد',
        'date_of_birth': 'تاریخ تولد',
        'religion': 'دین',
        'select_religion': 'انتخاب دین',
        'religion_shia_islam': 'اسلام شیعه',
        'religion_sunni_islam': 'اسلام سنی',
        'religion_christianity': 'مسیحیت',
        'religion_judaism': 'یهودیت',
        'religion_other': 'سایر',
        'nationality': 'ملیت',
        'select_nationality': 'انتخاب ملیت',
        'priority_countries': 'کشورهای با اولویت',
        'other_countries': 'سایر کشورها',
        'academic_grade': 'پایه تحصیلی',
        'select_grade': 'انتخاب پایه',
        'grade': 'پایه',
        'major': 'رشته تحصیلی',
        'select_major': 'انتخاب رشته',
        'major_technical_vocational': 'فنی و حرفه‌ای',
        'major_mathematics_physics': 'ریاضی فیزیک',
        'major_experimental_sciences': 'علوم تجربی',
        'major_humanities': 'علوم انسانی',
        'residential_address': 'آدرس محل سکونت',
        'contact_number': 'شماره تماس اصلی',
        'contact_numbers': 'شماره‌های تماس',
        'emergency_contact': 'تماس اضطراری',
        'emergency_contact_name': 'نام کامل',
        'emergency_contact_number': 'شماره تماس',
        
        // Document Uploads
        'document_uploads_title': 'بارگذاری مدارک',
        'document_requirements': 'لطفاً مدارک مورد نیاز را بارگذاری کنید (JPEG، PNG، PDF - حداکثر حجم هر فایل ۵ مگابایت)',
        'emirates_id': 'شناسه امارات',
        'passport_front': 'صفحه اول پاسپورت',
        'national_id_doc': 'کارت ملی',
        'birth_certificate': 'شناسنامه',
        'academic_certificate': 'مدرک تحصیلی',
        'only_first_time': 'فقط برای دانش‌آموزانی که برای اولین بار ثبت‌نام می‌کنند',
        'drag_drop': 'فایل خود را اینجا بکشید و رها کنید یا',
        'browse_files': 'انتخاب فایل',
        'transportation_title': 'سرویس ایاب و ذهاب مدرسه',
        'transportation_subtitle': 'مسیر مورد نظر خود را انتخاب کنید',
        'transportation_city': 'شهر',
        'select_city': 'انتخاب شهر',
        'transportation_route': 'مسیر',
        'select_route': 'انتخاب مسیر',
        'transportation_location': 'محل سوار شدن',
        'school_policies_agreement': 'قوانین مدرسه در مورد ارسال مدارک را مطالعه کرده و می‌پذیرم',
        
        // Father's Information
        'fathers_info_title': 'اطلاعات پدر',
        'full_name': 'نام کامل',
        'nationality': 'ملیت',
        'date_of_birth': 'تاریخ تولد',
        'education': 'تحصیلات',
        'select_education': 'انتخاب تحصیلات',
        'education_high_school': 'دیپلم',
        'education_bachelors': 'کارشناسی',
        'education_masters': 'کارشناسی ارشد',
        'education_phd': 'دکترا',
        'education_other': 'سایر',
        'occupation': 'شغل',
        'landline': 'تلفن ثابت',
        'mobile_number': 'تلفن همراه',
        'whatsapp_number': 'شماره واتساپ',
        'email': 'آدرس ایمیل',
        'work_address': 'آدرس محل کار',
        'employee_code': 'کد کارمندی (اگر کارمند مدرسه هستید)',
        'medical_condition_question': 'آیا پدر دارای شرایط پزشکی خاصی است که مدرسه باید از آن مطلع باشد؟',
        'medical_condition_question_short': 'شرایط پزشکی',
        'medical_condition_details': 'لطفاً شرایط پزشکی را توضیح دهید',
        'yes': 'بله',
        'no': 'خیر',
        
        // Mother's Information
        'mothers_info_title': 'اطلاعات مادر',
        
        // Final Confirmation
        'final_confirmation_title': 'تأیید نهایی و ارسال',
        'special_notes': 'یادداشت‌های ویژه / درخواست‌های اضافی (اختیاری)',
        'consent_agreements': 'رضایت‌نامه‌ها و توافق‌نامه‌ها',
        'disciplinary_rules_agreement': 'من قوانین انضباطی مدرسه سلمان فارسی را با دقت مطالعه کرده و کاملاً متعهد به رعایت آنها هستم.',
        'terms_conditions_agreement': 'شرایط و قوانین ثبت نام دانش‌آموز را می‌پذیرم.',
        
        // Navigation buttons
        'previous': 'قبلی',
        'next': 'بعدی',
        'next_documents': 'بعدی: بارگذاری مدارک',
        'next_father': 'بعدی: اطلاعات پدر',
        'next_mother': 'بعدی: اطلاعات مادر',
        'next_confirmation': 'بعدی: تأیید نهایی',
        'review_application': 'بررسی درخواست',
        'submit_application': 'ارسال درخواست',
        
        // Modal
        'review_title': 'لطفاً درخواست خود را بررسی کنید',
        'make_changes': 'ایجاد تغییرات',
        'confirm_submit': 'تأیید و ارسال',
        
        // Success Page
        'registration_successful': 'ثبت نام با موفقیت انجام شد!',
        'thank_you_message': 'از ثبت نام شما در مدرسه سلمان فارسی متشکریم. درخواست شما با موفقیت ارسال شد و اکنون توسط تیم مدیریت ما در حال بررسی است.',
        'registration_id': 'شماره ثبت نام شما:',
        'save_id_message': 'لطفاً این شماره را برای مراجعات بعدی ذخیره کنید',
        'next_steps': 'مراحل بعدی:',
        'next_steps_1': 'تیم مدیریت ما درخواست شما را طی 3 تا 5 روز کاری بررسی خواهد کرد.',
        'next_steps_2': 'یک ایمیل تأییدیه با دستورالعمل‌های بیشتر دریافت خواهید کرد.',
        'next_steps_3': 'لطفاً مدارک اصلی را برای تأیید در زمان درخواست آماده داشته باشید.',
        'next_steps_4': 'در صورت نیاز به اطلاعات بیشتر، تیم ما با استفاده از اطلاعات تماس ارائه شده با شما تماس خواهد گرفت.',
        'contact_message': 'اگر سؤالی دارید، لطفاً با دفتر پذیرش ما تماس بگیرید:',
        'print_confirmation': 'چاپ تأییدیه',
        'return_home': 'بازگشت به صفحه اصلی',
        
        // Footer
        'footer_copyright': '© ۱۴۰۴ مدرسه سلمان فارسی. تمامی حقوق محفوظ است.',
        
        // Common
        'required': 'این فیلد الزامی است.',
        'select': 'انتخاب',
        'note': 'توجه'
    }
};