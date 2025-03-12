<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - Salman Farsi School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- اضافه کردن فونت وزیر برای زبان فارسی -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .success-container {
            text-align: center;
            max-width: 800px;
            margin: 50px auto;
            padding: 40px 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .success-icon {
            font-size: 80px;
            color: #27ae60;
            margin-bottom: 20px;
        }
        
        .success-title {
            color: #2c4e9a;
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .success-message {
            color: #555;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .registration-id {
            background-color: #f1f9ff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 30px;
            font-size: 18px;
            color: #2c4e9a;
        }
        
        .registration-id strong {
            font-weight: 600;
            font-size: 22px;
        }
        
        .next-steps {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            text-align: left;
            margin-bottom: 30px;
        }
        
        .next-steps h3 {
            color: #2c4e9a;
            margin-bottom: 15px;
        }
        
        .next-steps ul {
            padding-left: 20px;
        }
        
        .next-steps li {
            margin-bottom: 10px;
        }
        
        .action-buttons {
            margin-top: 30px;
        }
        
        .btn-print {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            margin-right: 15px;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-print i {
            margin-right: 8px;
        }
        
        .btn-home {
            background-color: #2c4e9a;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-home i {
            margin-right: 8px;
        }
        
        .btn-print:hover, .btn-home:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        /* RTL support for Persian */
        body.rtl {
            direction: rtl;
            text-align: right;
            font-family: Vazirmatn, sans-serif;
        }
        
        body.rtl .next-steps {
            text-align: right;
        }
        
        body.rtl .next-steps ul {
            padding-right: 20px;
            padding-left: 0;
        }
        
        body.rtl .btn-print i, 
        body.rtl .btn-home i {
            margin-right: 0;
            margin-left: 8px;
        }
        
        @media print {
            .action-buttons, .language-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="language-toggle">
        <button class="active" data-lang="en">English</button>
        <button data-lang="fa">فارسی</button>
    </div>

    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 class="success-title">Registration Successful!</h1>
        
        <p class="success-message">
            Thank you for registering at Salman Farsi School. Your application has been successfully submitted and is now being reviewed by our administration team.
        </p>
        
        <?php 
        $registration_id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;
        if ($registration_id): 
        ?>
        <div class="registration-id">
            Your Registration ID: <strong><?php echo htmlspecialchars($registration_id); ?></strong>
            <div style="font-size: 14px; margin-top: 5px; color: #666;">
                Please save this ID for future reference
            </div>
        </div>
        <?php endif; ?>
        
        <div class="next-steps">
            <h3>Next Steps:</h3>
            <ul>
                <li>Our administration team will review your application within 3-5 business days.</li>
                <li>You will receive a confirmation email with further instructions.</li>
                <li>Please prepare the original documents for verification when requested.</li>
                <li>If additional information is needed, our team will contact you using the provided contact details.</li>
            </ul>
        </div>
        
        <p>
            If you have any questions, please contact our admissions office at <br>
            <strong>info@ir-salmanfarsi.com</strong> or call <strong>+971 4 298 811 6</strong>.
        </p>
        
        <div class="action-buttons">
            <button class="btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Print Confirmation
            </button>
            
            <a href="../index.php" class="btn-home">
                <i class="fas fa-home"></i> Return to Homepage
            </a>
        </div>
    </div>
    
    <footer class="site-footer">
        <div class="footer-content">
            <p>&copy; 2025 Salman Farsi School. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/translations.js"></script>
    <script>
    $(document).ready(function() {
        // Setup language toggle
        $('.language-toggle button').click(function() {
            const lang = $(this).data('lang');
            
            // Toggle active class
            $('.language-toggle button').removeClass('active');
            $(this).addClass('active');
            
            // Toggle RTL for Persian
            if (lang === 'fa') {
                $('body').addClass('rtl');
            } else {
                $('body').removeClass('rtl');
            }
            
            // Update text content based on selected language
            updateSuccessPageLanguage(lang);
            
            // Save language preference
            localStorage.setItem('preferred_language', lang);
        });
        
        // Set initial language based on saved preference
        const savedLang = localStorage.getItem('preferred_language') || 'en';
        $(`.language-toggle button[data-lang="${savedLang}"]`).click();
        
        // Function to update success page language
        function updateSuccessPageLanguage(lang) {
            if (!translations[lang]) return;
            
            // Update page content
            $('.success-title').text(translations[lang].registration_successful);
            $('.success-message').text(translations[lang].thank_you_message);
            
            // Registration ID section
            const regIdSection = $('.registration-id');
            if (regIdSection.length) {
                const regId = regIdSection.find('strong').text();
                regIdSection.html(translations[lang].registration_id + ' <strong>' + regId + '</strong>' +
                    '<div style="font-size: 14px; margin-top: 5px; color: #666;">' + 
                    translations[lang].save_id_message + '</div>');
            }
            
            // Next steps section
            $('.next-steps h3').text(translations[lang].next_steps);
            $('.next-steps ul').html(
                '<li>' + translations[lang].next_steps_1 + '</li>' +
                '<li>' + translations[lang].next_steps_2 + '</li>' +
                '<li>' + translations[lang].next_steps_3 + '</li>' +
                '<li>' + translations[lang].next_steps_4 + '</li>'
            );
            
            // Contact information
            $('p:contains("If you have any questions")').html(
                translations[lang].contact_message + ' <br>' +
                '<strong>admissions@salmanfarsi.edu</strong> ' + (lang === 'fa' ? 'یا تماس با' : 'or call') + ' <strong>+971-4-123-4567</strong>.'
            );
            
            // Action buttons
            $('.btn-print').html('<i class="fas fa-print"></i> ' + translations[lang].print_confirmation);
            $('.btn-home').html('<i class="fas fa-home"></i> ' + translations[lang].return_home);
            
            // Footer
            $('.footer-content p').text(translations[lang].footer_copyright);
        }
    });
    </script>
</body>
</html>