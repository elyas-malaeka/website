<?php
/**
 * Contact Us Page - Premium Edition
 * 
 * Extraordinary, high-end contact page for Salman Educational Complex
 * with bilingual support and advanced interactive features.
 * 
 * @package Salman Educational Complex
 * @version 3.0
 */

// Include configuration file
require_once 'includes/config.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo t('contact_us', $lang); ?> | <?php echo $isRtl ? SITE_NAME : SITE_NAME_EN; ?></title>

    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- vendor styles (minimal set to avoid errors) -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    
    <!-- template styles (main CSS) -->
    <link rel="stylesheet" href="assets/css/salman.css" />

    <!-- Contact page specific styles -->
    <style>
        /* Base styles */
        :root {
            --primary-color: #6941C6;
            --primary-light: #9E77ED;
            --primary-dark: #4E36B1;
            --secondary-color: #4E36B1;
            --accent-color: #7F56D9;
            --dark-color: #0F172A;
            --dark-light: #334155;
            --light-color: #F8FAFC;
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --text-light: #E2E8F0;
            --border-radius-sm: 8px;
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --box-shadow-light: 0 8px 20px rgba(0, 0, 0, 0.06);
            --box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            --box-shadow-strong: 0 20px 40px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Fonts for RTL layout */
        <?php if ($isRtl): ?>
        body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, textarea {
            font-family: 'Vazirmatn', sans-serif !important;
        }
        <?php endif; ?>

        /* Preloader fix */
        .preloader {
            display: none !important;
        }

        /* Utilities */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        /* Main styles */
        body {
            background-color: var(--light-color);
            scroll-behavior: smooth;
        }

        /* =============== COSMIC HERO SECTION =============== */
        .cosmic-header {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%);
            position: relative;
            overflow: hidden;
            color: var(--light-color);
            text-align: center;
            padding: 200px 0 180px;
            margin-top: 0;
            direction: <?php echo $isRtl ? 'rtl' : 'ltr'; ?>;
        }
            
        .cosmic-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.8;
        }

        .galaxy-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(126, 90, 247, 0.3) 0%, rgba(63, 55, 201, 0.1) 35%, rgba(9, 9, 45, 0) 70%);
            opacity: 0.6;
            animation: pulse 8s infinite alternate;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            100% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.7; }
        }
            
        .cosmic-star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            animation: twinkle 3s infinite alternate;
        }
            
        @keyframes twinkle {
            0% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
            100% { opacity: 1; transform: scale(1); }
        }

        .shooting-star {
            position: absolute;
            width: 2px;
            height: 80px;
            background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,0.8), rgba(255,255,255,0));
            transform: rotate(45deg);
            animation: shooting 5s linear infinite;
            opacity: 0;
        }
            
        @keyframes shooting {
            0% { 
                transform: rotate(45deg) translateX(0);
                opacity: 0;
            }
            15% {
                opacity: 1;
            }
            30% { 
                transform: rotate(45deg) translateX(400px);
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }
            
        .cosmic-bg::before, 
        .cosmic-bg::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.7) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.5) 1px, transparent 1px);
            background-size: 
                100px 100px,
                150px 150px,
                200px 200px;
            animation: cosmic-rotate 100s linear infinite;
        }
            
        .cosmic-bg::after {
            background-size: 
                120px 120px,
                170px 170px,
                220px 220px;
            animation-duration: 150s;
            animation-direction: reverse;
        }
            
        @keyframes cosmic-rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
            
        .cosmic-planet {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(25px);
            box-shadow: 0 0 60px rgba(126, 90, 247, 0.7);
            animation: float 15s infinite alternate;
        }
            
        .cosmic-planet:nth-child(1) {
            top: -80px;
            left: -100px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, #9E77ED, #6941C6);
            animation-delay: 0s;
        }
            
        .cosmic-planet:nth-child(2) {
            bottom: -100px;
            right: -120px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, #7F56D9, #4E36B1);
            animation-delay: 5s;
        }

        .cosmic-planet:nth-child(3) {
            top: 70%;
            left: 10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, #A779F7, #6741D9);
            animation-delay: 2s;
        }
            
        .cosmic-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,213.3C672,203,768,181,864,186.7C960,192,1056,224,1152,240C1248,256,1344,256,1392,256L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center bottom;
            z-index: 1;
        }
            
        .cosmic-header__content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }
            
        .cosmic-header__title {
            font-size: 52px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            letter-spacing: -0.5px;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out forwards;
        }
            
        .cosmic-header__subtitle {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0;
            color: #E2E8F0;
            line-height: 1.7;
            animation: fadeInUp 1s ease-out 0.2s forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Advanced wave effect */
        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 1;
        }

        .wave-container svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 130px;
        }

        .wave-container .shape-fill {
            fill: #F8FAFC;
        }

        /* =============== CONTACT SECTION STYLES =============== */
        .contact-section {
            position: relative;
            padding: 100px 0;
            overflow: hidden;
            background-color: var(--light-color);
        }

        .contact-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }

        .contact-shape {
            position: absolute;
            opacity: 0.06;
            z-index: -1;
        }

        .contact-shape-1 {
            top: 10%;
            left: 5%;
            width: 350px;
            height: 350px;
            border-radius: 350px;
            background: var(--primary-light);
            animation: moveUpDown 15s ease-in-out infinite alternate;
        }

        .contact-shape-2 {
            top: 50%;
            right: -100px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: var(--primary-dark);
            animation: moveUpDown 20s ease-in-out 5s infinite alternate;
        }

        .contact-shape-3 {
            bottom: 10%;
            left: 15%;
            width: 200px;
            height: 200px;
            background: var(--accent-color);
            border-radius: 40px;
            transform: rotate(30deg);
            animation: rotateShape 30s linear infinite;
        }

        @keyframes moveUpDown {
            0% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-40px) rotate(5deg); }
            100% { transform: translateY(40px) rotate(-5deg); }
        }

        @keyframes rotateShape {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .contact-container {
            position: relative;
            z-index: 1;
        }

        /* Info Card */
        .contact-card {
            background: white;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--box-shadow-strong);
            transition: var(--transition);
            height: 100%;
            transform: translateY(0);
            position: relative;
            z-index: 2;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
            border-radius: var(--border-radius-lg);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow-strong), 0 20px 40px rgba(105, 65, 198, 0.2);
        }

        .contact-card:hover::before {
            opacity: 0.05;
        }

        .contact-form-card {
            background: white;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--box-shadow-strong);
            transition: var(--transition);
            position: relative;
            z-index: 2;
        }

        .contact-form-card:hover {
            box-shadow: var(--box-shadow-strong), 0 25px 50px rgba(105, 65, 198, 0.15);
        }

        .contact-shape-accent {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
        }

        .contact-shape-accent-1 {
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(126, 90, 247, 0.12), rgba(63, 55, 201, 0.06));
        }

        .contact-shape-accent-2 {
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(126, 90, 247, 0.08), rgba(63, 55, 201, 0.04));
        }

        .contact-card-header {
            position: relative;
            overflow: hidden;
            padding: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .contact-card-particle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .particle-1 {
            width: 50px;
            height: 50px;
            top: 20px;
            right: 20px;
        }

        .particle-2 {
            width: 100px;
            height: 100px;
            bottom: -30px;
            left: -30px;
        }

        .particle-3 {
            width: 30px;
            height: 30px;
            top: 60%;
            right: 40%;
        }

        .contact-card-body {
            padding: 40px;
            position: relative;
        }

        .contact-card-title {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            color: white;
            position: relative;
            z-index: 2;
        }

        .contact-card-subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            transition: var(--transition);
            position: relative;
        }

        .contact-info-item::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 0;
            height: 1px;
            background: linear-gradient(to right, var(--primary-light), transparent);
            transition: var(--transition);
        }

        .contact-info-item:hover::after {
            width: 100%;
        }

        .contact-info-item:hover {
            transform: translateX(5px);
        }

        <?php if ($isRtl): ?>
        .contact-info-item::after {
            left: auto;
            right: 0;
            background: linear-gradient(to left, var(--primary-light), transparent);
        }

        .contact-info-item:hover {
            transform: translateX(-5px);
        }
        <?php endif; ?>

        .contact-info-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(158, 119, 237, 0.15), rgba(105, 65, 198, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            margin-right: 20px;
            flex-shrink: 0;
            font-size: 20px;
            transition: var(--transition);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .contact-info-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .contact-info-item:hover .contact-info-icon {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
        }

        .contact-info-item:hover .contact-info-icon::before {
            opacity: 1;
        }

        <?php if ($isRtl): ?>
        .contact-info-icon {
            margin-right: 0;
            margin-left: 20px;
        }
        <?php endif; ?>

        .contact-info-content {
            flex: 1;
        }

        .contact-info-label {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 18px;
            margin-bottom: 6px;
        }

        .contact-info-value {
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1.6;
        }

        .contact-info-value a {
            color: var(--primary-color);
            transition: var(--transition);
            position: relative;
            display: inline-block;
        }

        .contact-info-value a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            transition: var(--transition);
        }

        .contact-info-value a:hover {
            color: var(--secondary-color);
        }

        .contact-info-value a:hover::after {
            width: 100%;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-link {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 18px;
            transition: var(--transition);
            position: relative;
            z-index: 1;
            overflow: hidden;
            box-shadow: var(--box-shadow-light);
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .social-link:hover {
            color: white;
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 15px 25px rgba(105, 65, 198, 0.2);
        }

        .social-link:hover::before {
            opacity: 1;
        }

        /* Form Styles */
        .contact-form {
            padding: 40px;
            position: relative;
        }

        .form-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            font-size: 18px;
            color: var(--text-muted);
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 16px;
            transition: var(--transition);
            padding-left: 10px;
        }

        .form-control {
            width: 100%;
            border-radius: 30px !important;
            padding: 16px 24px !important;
            font-size: 16px !important;
            border: 2px solid #E2E8F0 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            background-color: white !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        textarea.form-control {
            border-radius: 25px !important;
            min-height: 150px !important;
            resize: vertical;
        }

        .form-control:focus {
            outline: none !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 5px 15px rgba(111, 76, 255, 0.1) !important;
            transform: translateY(-2px);
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, rgba(126, 90, 247, 0.2), rgba(63, 55, 201, 0.1)) border-box;
            border: 2px solid transparent !important;
        }

        .form-control::placeholder {
            color: #A0AEC0;
            transition: var(--transition);
        }

        .form-control:focus::placeholder {
            opacity: 0.7;
            transform: translateX(5px);
        }

        .form-error {
            color: #EF4444;
            font-size: 14px;
            margin-top: 5px;
            display: none;
            padding-left: 24px;
        }

        .form-control.is-invalid {
            border-color: #EF4444 !important;
        }

        .form-control.is-invalid + .form-error {
            display: block;
        }

        .submit-button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px !important;
            padding: 16px 36px !important;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 8px 15px rgba(111, 76, 255, 0.2) !important;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }

        .submit-button:hover::before {
            opacity: 1;
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button i {
            transition: transform 0.3s ease;
        }

        .submit-button:hover i {
            transform: translateX(5px);
        }

        <?php if ($isRtl): ?>
        .submit-button:hover i {
            transform: translateX(-5px);
        }
        <?php endif; ?>

        /* Map section styles */
        .map-section {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow-strong);
            margin-top: 100px;
            z-index: 2;
        }

        .map-gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(15, 23, 42, 0.05), transparent);
            pointer-events: none;
            z-index: 1;
        }

        .map-info-card {
            position: absolute;
            top: 40px;
            <?php echo $isRtl ? 'right' : 'left'; ?>: 40px;
            max-width: 380px;
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow-strong);
            z-index: 2;
            transition: var(--transition);
            transform: translateY(0);
        }

        .map-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.1);
        }

        .map-info-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-color);
            letter-spacing: -0.5px;
        }

        .map-info-text {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .map-direction-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .map-direction-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .map-direction-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        .map-direction-btn:hover::before {
            opacity: 1;
        }

        .map-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Modal Styles */
        .contact-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .contact-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .contact-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(5px);
        }

        .contact-modal-container {
            position: relative;
            width: 90%;
            max-width: 500px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10;
            text-align: center;
            overflow: hidden;
        }

        .contact-modal.show .contact-modal-container {
            transform: translateY(0);
        }

        .contact-modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(158, 119, 237, 0.2), rgba(105, 65, 198, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .contact-modal-icon i {
            font-size: 32px;
        }

        .contact-modal-icon.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1));
            color: #10B981;
        }

        .contact-modal-icon.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
            color: #EF4444;
        }

        .contact-modal-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .contact-modal-message {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .contact-modal-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .contact-modal-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
        }

        /* Loading indicator for form */
        .form-loading {
            position: relative;
            pointer-events: none;
        }

        .form-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(2px);
            border-radius: var(--border-radius-lg);
            z-index: 10;
        }

        .form-loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 5px solid rgba(105, 65, 198, 0.2);
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 11;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Animation classes */
        @keyframes float {
            0% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0); }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) forwards;
        }

        .fade-in-delay-1 {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) 0.2s forwards;
        }

        .fade-in-delay-2 {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) 0.4s forwards;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            animation: scaleIn 0.6s cubic-bezier(0.5, 0, 0.1, 1) forwards;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Responsive styles */
        @media (max-width: 1199px) {
            .cosmic-header__title {
                font-size: 44px;
            }

            .contact-card-header,
            .contact-card-body,
            .contact-form {
                padding: 30px;
            }
        }

        @media (max-width: 991px) {
            .cosmic-header {
                padding: 160px 0 140px;
            }
            
            .cosmic-header__title {
                font-size: 38px;
            }
            
            .cosmic-header__subtitle {
                font-size: 18px;
            }

            .map-info-card {
                position: relative;
                top: 0;
                left: 0;
                right: 0;
                max-width: 100%;
                margin-bottom: 20px;
                border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
            }

            .map-section {
                height: auto;
                display: flex;
                flex-direction: column;
            }

            .map-iframe {
                height: 400px;
                border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);
            }

            .contact-section .col-lg-4 {
                margin-bottom: 30px;
            }

            .contact-shape-1,
            .contact-shape-2,
            .contact-shape-3 {
                opacity: 0.03;
            }
        }
            
        @media (max-width: 767px) {
            .cosmic-header {
                padding: 130px 0 110px;
            }
            
            .cosmic-header__title {
                font-size: 32px;
            }
            
            .cosmic-header__subtitle {
                font-size: 16px;
            }
            
            .contact-section {
                padding: 60px 0;
            }

            .form-title {
                font-size: 28px;
            }

            .form-subtitle {
                font-size: 16px;
            }

            .map-iframe {
                height: 300px;
            }

            .contact-card-title {
                font-size: 24px;
            }

            .contact-info-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        /* Animation for numbers (RTL support) */
        .numbers-ltr {
            direction: ltr;
            display: inline-block;
        }
    </style>
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Cosmic Header Section -->
        <section class="cosmic-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with JS -->
            </div>
            
            <div class="container">
                <div class="cosmic-header__content">
                    <h1 class="cosmic-header__title">
                        <?php echo t('contact_us', $lang); ?>
                    </h1>
                    <p class="cosmic-header__subtitle">
                        <?php echo $lang == 'fa' ? 'ما مشتاقانه منتظر شنیدن صدای شما هستیم. با ما در ارتباط باشید.' : 'We\'d love to hear from you. Get in touch with us.'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Enhanced Contact Information Cards Section -->
        <section class="contact-section">
            <div class="contact-shapes">
                <div class="contact-shape contact-shape-1"></div>
                <div class="contact-shape contact-shape-2"></div>
                <div class="contact-shape contact-shape-3"></div>
            </div>
            
            <div class="container contact-container">
                <div class="row">
                    <div class="col-lg-4 fade-in">
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <div class="contact-card-particle particle-1"></div>
                                <div class="contact-card-particle particle-2"></div>
                                <div class="contact-card-particle particle-3"></div>
                                
                                <h3 class="contact-card-title">
                                    <?php echo $lang == 'fa' ? 'اطلاعات تماس' : 'Contact Information'; ?>
                                </h3>
                                <p class="contact-card-subtitle">
                                    <?php echo $lang == 'fa' ? 'راه‌های ارتباطی مجتمع آموزشی سلمان' : 'Ways to reach Salman Educational Complex'; ?>
                                </p>
                            </div>
                            <div class="contact-card-body">
                                <div class="contact-shape-accent contact-shape-accent-1"></div>
                                <div class="contact-shape-accent contact-shape-accent-2"></div>
                                
                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo $lang == 'fa' ? 'آدرس ما' : 'Our Address'; ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <?php echo $lang == 'fa' ? 'دبی - القصیص - القصیص ۱' : 'Al Qusais 1, Al Qusais, Dubai, UAE'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo $lang == 'fa' ? 'تلفن تماس' : 'Phone Number'; ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <a href="tel:+97142988116" class="<?php echo $isRtl ? 'numbers-ltr' : ''; ?>">
                                                <?php echo formatPhone('+97142988116', $lang); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo $lang == 'fa' ? 'ایمیل' : 'Email Address'; ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <a href="mailto:info@ir-salmanfarsi.com">
                                            info@ir-salmanfarsi.com
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo $lang == 'fa' ? 'ساعات کاری' : 'Working Hours'; ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <?php echo $lang == 'fa' ? 'دوشنبه تا پنج‌شنبه: ۷:۰۰ صبح تا ۲:۰۰ بعد از ظهر' : 'Monday to Thursday: 7:00 AM to 2:00 PM'; ?>
                                            <br>
                                            <?php echo $lang == 'fa' ? 'جمعه: ۷:۰۰ صبح تا ۱۲:۰۰ ظهر' : 'Friday: 7:00 AM to 12:00 PM'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="social-links">
                                    <a href="https://www.instagram.com/ir.salmanfarsi/" class="social-link" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="https://www.youtube.com/@salmanfarsiiranianschool73/videos" class="social-link" title="youtube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="https://wa.me/97142988116" class="social-link" title="whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 fade-in-delay-1">
                        <div class="contact-form-card scale-in">
                            <div class="contact-form">
                                <h2 class="form-title">
                                    <?php echo $lang == 'fa' ? 'پیام خود را بنویسید' : 'Send Us a Message'; ?>
                                </h2>
                                <p class="form-subtitle">
                                    <?php echo $lang == 'fa' ? 'با ما در تماس باشید. ما در اسرع وقت به شما پاسخ خواهیم داد.' : 'Get in touch with us. We\'ll respond as soon as possible.'; ?>
                                </p>

                                <form id="contactForm" class="contact-form-validated">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="name" class="form-label">
                                                    <?php echo $lang == 'fa' ? 'نام و نام خانوادگی' : 'Full Name'; ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="name" name="name" class="form-control" 
                                                    placeholder="<?php echo $lang == 'fa' ? 'نام خود را وارد کنید' : 'Enter your name'; ?>" 
                                                    data-error-message="<?php echo $lang == 'fa' ? 'لطفاً نام خود را وارد کنید' : 'Please enter your name'; ?>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="email" class="form-label">
                                                    <?php echo $lang == 'fa' ? 'ایمیل' : 'Email Address'; ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" id="email" name="email" class="form-control" 
                                                    placeholder="<?php echo $lang == 'fa' ? 'ایمیل خود را وارد کنید' : 'Enter your email'; ?>"
                                                    data-error-message="<?php echo $lang == 'fa' ? 'لطفاً یک آدرس ایمیل معتبر وارد کنید' : 'Please enter a valid email address'; ?>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="phone" class="form-label">
                                                    <?php echo $lang == 'fa' ? 'شماره تماس' : 'Phone Number'; ?>
                                                </label>
                                                <input type="tel" id="phone" name="phone" class="form-control" 
                                                    placeholder="<?php echo $lang == 'fa' ? 'شماره تماس خود را وارد کنید' : 'Enter your phone number'; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="subject" class="form-label">
                                                    <?php echo $lang == 'fa' ? 'موضوع' : 'Subject'; ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="subject" name="subject" class="form-control" 
                                                    placeholder="<?php echo $lang == 'fa' ? 'موضوع پیام خود را وارد کنید' : 'Enter message subject'; ?>"
                                                    data-error-message="<?php echo $lang == 'fa' ? 'لطفاً موضوع پیام را وارد کنید' : 'Please enter a subject'; ?>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label for="message" class="form-label">
                                            <?php echo $lang == 'fa' ? 'پیام شما' : 'Your Message'; ?> <span class="text-danger">*</span>
                                        </label>
                                        <textarea id="message" name="message" class="form-control" 
                                            placeholder="<?php echo $lang == 'fa' ? 'پیام خود را بنویسید...' : 'Write your message here...'; ?>"
                                            data-error-message="<?php echo $lang == 'fa' ? 'لطفاً پیام خود را وارد کنید' : 'Please enter your message'; ?>"
                                            required></textarea>
                                    </div>

                                    <button type="submit" class="submit-button">
                                        <?php echo $lang == 'fa' ? 'ارسال پیام' : 'Send Message'; ?>
                                        <i class="fas <?php echo $isRtl ? 'fa-arrow-left' : 'fa-arrow-right'; ?>"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Map Section -->
                <div class="map-section fade-in-delay-2">
                    <div class="map-gradient-overlay"></div>
                    
                    <div class="map-info-card scale-in">
                        <h3 class="map-info-title">
                            <?php echo $lang == 'fa' ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex'; ?>
                        </h3>
                        <p class="map-info-text">
                            <?php echo $lang == 'fa' ? 'مجتمع آموزشی سلمان فارسی در منطقه القصیص دبی واقع شده است. ما مشتاقانه منتظر دیدار شما هستیم.' : 'Salman Farsi Educational Complex is located in Al Qusais area of Dubai. We look forward to welcoming you.'; ?>
                        </p>
                        <a href="https://maps.app.goo.gl/dKBSob8Mv74Ay8QU7" target="_blank" class="map-direction-btn">
                            <i class="fas fa-directions"></i>
                            <?php echo $lang == 'fa' ? 'دریافت مسیر' : 'Get Directions'; ?>
                        </a>
                    </div>
                    
                    <iframe class="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.7044105734994!2d55.3701782!3d25.280527099999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5c5ccc1839a7%3A0x4dc94820fc33cef1!2sSalman%20Farsi%20Iranian%20Boys%20School!5e0!3m2!1sen!2sae!4v1730836760722!5m2!1sen!2sae"></iframe>
            </div>
        </section>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>

        <!-- Contact Modal -->
        <div id="contactModal" class="contact-modal">
            <div class="contact-modal-overlay"></div>
            <div class="contact-modal-container">
                <div id="modalIcon" class="contact-modal-icon success">
                    <i id="modalIconType" class="fas fa-check-circle"></i>
                </div>
                <h3 id="modalTitle" class="contact-modal-title">
                    <?php echo $lang == 'fa' ? 'پیام با موفقیت ارسال شد' : 'Message Sent Successfully'; ?>
                </h3>
                <p id="modalMessage" class="contact-modal-message">
                    <?php echo $lang == 'fa' ? 'پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت.' : 'Your message has been sent successfully. We will contact you soon.'; ?>
                </p>
                <button id="modalClose" class="contact-modal-btn">
                    <?php echo $lang == 'fa' ? 'متوجه شدم' : 'Got it'; ?>
                </button>
            </div>
        </div>
    </div><!-- /.page-wrapper -->

    <!-- Minimal set of scripts to avoid JS errors -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for Contact Page -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide preloader immediately
            document.querySelectorAll('.preloader').forEach(function(el) {
                el.style.display = 'none';
            });
            
            // Create cosmic stars for the header
            createCosmicStars();
            
            // Animate shooting stars
            animateShootingStars();

            // Get form and modal elements
            const contactForm = document.getElementById('contactForm');
            const contactModal = document.getElementById('contactModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalIcon = document.getElementById('modalIcon');
            const modalIconType = document.getElementById('modalIconType');
            const modalClose = document.getElementById('modalClose');
            
            // Set up form submission via AJAX
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Client-side validation
                    if (!validateForm()) {
                        return false;
                    }
                    
                    // Show loading state
                    contactForm.classList.add('form-loading');
                    
                    // Create form data object
                    const formData = new FormData();
                    formData.append('name', document.getElementById('name').value);
                    formData.append('email', document.getElementById('email').value);
                    formData.append('phone', document.getElementById('phone').value);
                    formData.append('subject', document.getElementById('subject').value);
                    formData.append('message', document.getElementById('message').value);
                    
                    // Send XHR request
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'includes/process-contact.php', true);
                    xhr.onload = function() {
    // Remove loading state
    contactForm.classList.remove('form-loading');
    
    if (xhr.status === 200) {
        try {
            console.log("Response:", xhr.responseText); // برای دیباگ
            const data = JSON.parse(xhr.responseText);
            
            // Show appropriate modal
            if (data.status === 'success') {
                showModal(
                    '<?php echo $lang == 'fa' ? 'پیام با موفقیت ارسال شد' : 'Message Sent Successfully'; ?>', 
                    '<?php echo $lang == 'fa' ? 'پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت.' : 'Your message has been sent successfully. We will contact you soon.'; ?>',
                    'success'
                );
                // Reset form on success
                contactForm.reset();
            } else {
                showModal(
                    '<?php echo $lang == 'fa' ? 'خطا در ارسال پیام' : 'Message Sending Failed'; ?>',
                    data.message || '<?php echo $lang == 'fa' ? 'خطایی در ارسال پیام رخ داد. لطفا دوباره تلاش کنید.' : 'An error occurred while sending your message. Please try again.'; ?>',
                    'error'
                );
            }
        } catch (e) {
            console.error('Error parsing response:', e, xhr.responseText);
            showModal(
                '<?php echo $lang == 'fa' ? 'خطای سیستمی' : 'System Error'; ?>',
                '<?php echo $lang == 'fa' ? 'خطای سیستمی رخ داده است. لطفا بعدا دوباره تلاش کنید.' : 'A system error occurred. Please try again later.'; ?>',
                'error'
            );
        }
    } else {
        showModal(
            '<?php echo $lang == 'fa' ? 'خطای سیستمی' : 'System Error'; ?>',
            '<?php echo $lang == 'fa' ? 'خطای سیستمی رخ داده است. لطفا بعدا دوباره تلاش کنید.' : 'A system error occurred. Please try again later.'; ?>',
            'error'
        );
        console.error('XHR Error:', xhr.status);
    }
};
                    xhr.onerror = function() {
                        // Remove loading state
                        contactForm.classList.remove('form-loading');
                        
                        // Show error modal
                        showModal(
                            '<?php echo $lang == 'fa' ? 'خطای اتصال' : 'Connection Error'; ?>',
                            '<?php echo $lang == 'fa' ? 'خطا در ارتباط با سرور. لطفا اتصال اینترنت خود را بررسی کنید و دوباره تلاش کنید.' : 'Error connecting to server. Please check your internet connection and try again.'; ?>',
                            'error'
                        );
                    };
                    xhr.send(formData);
                });
            }
            
            // Function to show modal
            function showModal(title, message, type = 'success') {
                modalTitle.textContent = title;
                modalMessage.textContent = message;
                
                if (type === 'success') {
                    modalIcon.className = 'contact-modal-icon success';
                    modalIconType.className = 'fas fa-check-circle';
                } else {
                    modalIcon.className = 'contact-modal-icon error';
                    modalIconType.className = 'fas fa-exclamation-circle';
                }
                
                contactModal.classList.add('show');
            }
            
            // Close modal when clicking the button or overlay
            if (modalClose) {
                modalClose.addEventListener('click', function() {
                    contactModal.classList.remove('show');
                });
            }
            
            if (contactModal) {
                contactModal.querySelector('.contact-modal-overlay').addEventListener('click', function() {
                    contactModal.classList.remove('show');
                });
            }
            
            // Form validation function
            function validateForm() {
                let isValid = true;
                const requiredFields = contactForm.querySelectorAll('[required]');
                
                // Clear previous errors
                contactForm.querySelectorAll('.is-invalid').forEach(field => {
                    field.classList.remove('is-invalid');
                });
                
                requiredFields.forEach(field => {
                    // Check if field is empty
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                        
                        // Create error message if it doesn't exist
                        let errorElem = field.nextElementSibling;
                        if (!errorElem || !errorElem.classList.contains('form-error')) {
                            errorElem = document.createElement('div');
                            errorElem.className = 'form-error';
                            errorElem.textContent = field.getAttribute('data-error-message') || 
                                '<?php echo $lang == 'fa' ? 'این فیلد الزامی است' : 'This field is required'; ?>';
                            field.parentNode.insertBefore(errorElem, field.nextSibling);
                        }
                    }
                    
                    // Validate email format
                    if (field.type === 'email' && field.value.trim()) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            field.classList.add('is-invalid');
                            isValid = false;
                            
                            // Create error message
                            let errorElem = field.nextElementSibling;
                            if (!errorElem || !errorElem.classList.contains('form-error')) {
                                errorElem = document.createElement('div');
                                errorElem.className = 'form-error';
                                field.parentNode.insertBefore(errorElem, field.nextSibling);
                            }
                            errorElem.textContent = '<?php echo $lang == 'fa' ? 'لطفاً یک آدرس ایمیل معتبر وارد کنید' : 'Please enter a valid email address'; ?>';
                        }
                    }
                    
                    // Remove error when typing
                    field.addEventListener('input', function() {
                        if (field.value.trim()) {
                            field.classList.remove('is-invalid');
                            const errorElem = field.nextElementSibling;
                            if (errorElem && errorElem.classList.contains('form-error')) {
                                errorElem.style.display = 'none';
                            }
                        }
                    });
                });
                
                return isValid;
            }
        });
        
        // Function to create cosmic stars dynamically
        function createCosmicStars() {
            const cosmicBg = document.querySelector('.cosmic-bg');
            if (!cosmicBg) return;
            
            const starsCount = 80;
            
            for (let i = 0; i < starsCount; i++) {
                const star = document.createElement('div');
                star.className = 'cosmic-star';
                
                // Random size between 1-4 pixels
                const size = Math.random() * 3 + 1;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                
                // Random position
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                
                // Random animation duration and delay
                star.style.animationDuration = `${Math.random() * 3 + 1}s`;
                star.style.animationDelay = `${Math.random() * 3}s`;
                
                cosmicBg.appendChild(star);
            }
        }
        
        // Function to animate shooting stars
        function animateShootingStars() {
            const shootingStars = document.querySelectorAll('.shooting-star');
            
            shootingStars.forEach((star, index) => {
                setInterval(() => {
                    // Random top position
                    star.style.top = `${Math.random() * 80}%`;
                    star.style.left = `${Math.random() * 80}%`;
                    
                    // Trigger animation
                    star.style.animation = 'none';
                    setTimeout(() => {
                        star.style.animation = `shooting ${Math.random() * 3 + 3}s linear forwards`;
                    }, 10);
                }, (index + 1) * 5000); // Different intervals for each star
            });
        }
    </script>
</body>
</html>