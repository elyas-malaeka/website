<?php
/**
 * About Us Page - Improved Version
 * 
 * Clean, responsive presentation of the school's history and values
 * Built with modern animations and interactive elements
 * 
 * @package Salman Educational Complex
 * @version 2.6
 * @author Salman Farsi Web Team
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
    <title><?php echo t('about_us', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.css" />
    <link rel="stylesheet" href="assets/vendors/salman-icons/style.css" />
    <link rel="stylesheet" href="assets/vendors/slick/slick.css">
    <link rel="stylesheet" href="assets/vendors/jquery-flipster-master/jquery.flipster.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css" />

    <!-- Template Styles -->
    <link rel="stylesheet" href="assets/css/salman.css" />

    <style>
        /**
         * About Page Styles
         * ============================================
         * Comprehensive styling for the About Us page
         */
        
        /* Base variables */
        :root {
            --primary-color: #6941C6;
            --secondary-color: #4E36B1;
            --accent-color: #7F56D9;
            --text-color: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --border-radius: 20px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --animation-duration: 0.3s;
        }
        
        /* Font declarations for Persian language support */
        @font-face {
            font-family: 'Vazir';
            src: url('assets/fonts/Vazir.eot');
            src: url('assets/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                url('assets/fonts/Vazir.woff2') format('woff2'),
                url('assets/fonts/Vazir.woff') format('woff'),
                url('assets/fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap; /* Improves text rendering */
        }

        @font-face {
            font-family: 'Vazir';
            src: url('assets/fonts/Vazir-Bold.eot');
            src: url('assets/fonts/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
                url('assets/fonts/Vazir-Bold.woff2') format('woff2'),
                url('assets/fonts/Vazir-Bold.woff') format('woff'),
                url('assets/fonts/Vazir-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap; /* Improves text rendering */
        }

        /* Global text improvements */
        body {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        [dir="rtl"] body {
            font-family: 'Vazir', 'Vazirmatn', sans-serif;
            letter-spacing: 0;
        }
        
        /* ==================
           Header Section
           ================== */
        .about-header {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
            position: relative;
            overflow: hidden;
            color: var(--white);
            text-align: center;
            padding: 180px 0 140px;
            margin-top: 0;
        }
        
        /* Cosmic background effects */
        .cosmic-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.7;
            z-index: 1;
        }
        
        .cosmic-star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            animation: twinkle var(--animation-duration) infinite alternate;
        }
        
        @keyframes twinkle {
            from { opacity: 0.2; }
            to { opacity: 1; }
        }
        
        .cosmic-bg::before, 
        .cosmic-bg::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.5) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
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
            opacity: 0.3;
            filter: blur(20px);
        }
        
        .cosmic-planet:nth-child(1) {
            top: -50px;
            left: -100px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #7F56D9, #4E36B1);
        }
        
        .cosmic-planet:nth-child(2) {
            bottom: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #9E77ED, #6941C6);
        }
        
        /* Wave separator at the bottom of header */
        .about-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,229.3C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center bottom;
            z-index: 2;
        }
        
        /* Header content elements */
        .about-header__content {
            position: relative;
            z-index: 3;
        }
        
        .about-header__title {
            font-family: <?php echo $isRtl ? "'Vazir'" : "'Plus Jakarta Sans'"; ?>, sans-serif;
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 15px;
            color: white;
            animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
        }
        
        .about-header__subtitle {
            font-family: <?php echo $isRtl ? "'Vazir'" : "'Plus Jakarta Sans'"; ?>, sans-serif;
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
            color: white;
            animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
        }
        
        /* ==================
           Animation Effects
           ================== */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideDown {
            from { 
                opacity: 0;
                transform: translateY(-20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes floatEffect {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes rotateIn {
            from {
                transform: rotate(-10deg);
                opacity: 0;
            }
            to {
                transform: rotate(0);
                opacity: 1;
            }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes countUp {
            from { content: "0"; }
            to { content: attr(data-count); }
        }
        
        /* ==================
           Content Sections
           ================== */
        .about-section {
            padding: 80px 0;
            background-color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .about-section.bg-light {
            background-color: var(--bg-light);
        }
        
        /* Video container styles */
        .about-video {
            position: relative;
            margin-bottom: 30px;
        }
        
        .video-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            transform: translateY(0);
            transition: transform 0.5s ease;
        }
        
        .video-container:hover {
            transform: translateY(-10px);
        }
        
        .video-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 aspect ratio */
        }
        
        .school-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
            cursor: pointer;
        }
        
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .play-button {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            color: white;
            cursor: pointer;
            pointer-events: auto;
            animation: pulse 2s infinite;
        }
        
        .play-button i {
            font-size: 30px;
            margin-left: 5px; /* Adjusts for play icon */
        }
        
        .play-button:hover {
            transform: scale(1.1);
            background-color: var(--secondary-color);
            animation: none;
        }
        
        .video-caption {
            padding: 15px;
            background-color: var(--white);
            border-radius: 0 0 15px 15px;
            color: var(--text-color);
            font-weight: 500;
            font-size: 16px;
            text-align: center;
        }
        
        /* Hide overlay when video is playing */
        .video-playing .video-overlay {
            opacity: 0;
            visibility: hidden;
        }
        
        /* About content styles */
/* ✅ استایل جدید برای توضیح کوچک (tagline) */
/* ✅ استایل برای توضیح کوچک (tagline) */
.about-heading__tagline {
    font-size: 14px; /* کمی کوچک‌تر */
    font-weight: 600; /* کمی ضخیم‌تر */
    color: #6c63ff; /* بنفش مشابه نمونه */
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
    display: block;
    text-align: center;
}

/* ✅ استایل برای عنوان اصلی (title) */
.about-heading__title {
    font-size: 32px; /* بزرگ‌تر از tagline */
    font-weight: 800; /* ضخیم‌تر */
    color: #333; /* مشکی */
    text-align: center;
    margin-top: -5px; /* برای نزدیک‌تر شدن به tagline */
    line-height: 1.2;
    font-family: 'Vazirmatn', sans-serif;
    
}


/* ✅ تنظیم برای راست‌چین (RTL) */
[dir="rtl"] .about-heading__tagline,
[dir="rtl"] .about-heading__title {
    text-align: right;
    letter-spacing: 0;
}

        
        /* Fix for RTL text alignment */
        [dir="rtl"] .about-content__text {
            text-align: right;
        }
        
        /* Highlight styles */
        .about-highlight {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            animation: slideInRight 1s both;
        }
        
        .about-highlight i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        [dir="rtl"] .about-highlight i {
            margin-right: 0;
            margin-left: 10px;
        }
        
        /* Campus stats */
        .campus-stat {
            transition: all 0.3s ease;
            animation: fadeIn 1.5s both;
        }
        
        .campus-stat:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        /* ==================
           Features Section
           ================== */
        .features-section {
            padding: 80px 0;
            background-color: var(--bg-light);
            position: relative;
        }
        
        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/patterns/dot-pattern.png');
            opacity: 0.05;
            z-index: 0;
        }
        
        .feature-item {
            padding: 30px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: all 0.5s ease;
            position: relative;
            z-index: 1;
            overflow: hidden;
            height: 100%;
        }
        
        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: var(--primary-color);
            transition: height 0.5s ease;
            z-index: -1;
        }
        
        .feature-item:hover {
            transform: translateY(-15px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .feature-item:hover::before {
            height: 10px;
        }
        
        .feature-item__icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(105, 65, 198, 0.1);
            color: var(--primary-color);
            border-radius: 50%;
            font-size: 30px;
            margin-bottom: 20px;
            transition: all 0.5s ease;
        }
        
        .feature-item:hover .feature-item__icon {
            background-color: var(--primary-color);
            color: var(--white);
            transform: rotateY(360deg);
        }
        
        .feature-item__title {
            font-size: 20px;
            margin-bottom: 15px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }
        
        .feature-item:hover .feature-item__title {
            color: var(--primary-color);
        }
        
        .feature-item__text {
            color: var(--text-light);
            margin-bottom: 0;
            line-height: 1.7;
        }
        
        /* ==================
           Stats Section
           ================== */
        .stats-section {
            padding: 80px 0;
            background-color: var(--primary-color);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/patterns/dot-pattern.png');
            opacity: 0.1;
            animation: fadeIn 2s ease;
        }
        
        .stats-item {
            text-align: center;
            padding: 20px 0;
            position: relative;
            z-index: 1;
        }
        
        .stats-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .stats-item:hover::after {
            width: 80px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        .stats-item__icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: inline-block;
            animation: rotateIn 1s both;
        }
        
        .stats-item__number {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1;
            opacity: 0;
            animation: fadeIn 1s forwards;
            animation-delay: 0.5s;
        }
        
        .stats-item__text {
            font-size: 16px;
            opacity: 0.9;
            animation: slideUp 1s both;
            animation-delay: 0.7s;
        }
        
        /* Counter animation */
        .counter-value {
            display: inline-block;
            position: relative;
        }
        
        /* ==================
           Graduates Section
           ================== */
        .graduate-stat {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .graduate-stat:hover {
            border-color: var(--primary-color);
            background-color: white !important;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        /* ==================
           Team Section
           ================== */
        .team-section {
            padding: 80px 0;
            background-color: var(--white);
            position: relative;
        }
        
        .team-section.bg-light {
            background-color: var(--bg-light);
        }
        
        .team-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: all 0.5s ease;
            background-color: white;
            text-align: center; /* Center content */
        }
        
        .team-item:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .team-item__image {
            position: relative;
            overflow: hidden;
            height: 280px; /* Fixed height for consistency */
        }
        
        .team-item__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .team-item:hover .team-item__image img {
            transform: scale(1.1);
        }
        
        .team-item__content {
            padding: 25px 20px;
            text-align: center;
            background-color: var(--white);
            border-radius: 0 0 15px 15px;
            position: relative;
        }
        
        .team-item__content::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background-color: white;
            rotate: 45deg;
            z-index: -1;
        }
        
        .team-item__title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .team-item__title a {
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .team-item__title a:hover {
            color: var(--primary-color);
        }
        
        .team-item__designation {
            font-size: 14px;
            color: var(--primary-color);
            margin-bottom: 0;
        }
        
        /* CTA Button */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        /* ==================
           Responsive Styles
           ================== */
        @media (max-width: 1199px) {
            .play-button {
                width: 70px;
                height: 70px;
            }
            
            .play-button i {
                font-size: 24px;
            }
        }
        
        @media (max-width: 991px) {
            .about-header {
                padding: 150px 0 120px;
            }
            
            .about-header__title {
                font-size: 32px;
            }
            
            .about-video {
                margin-bottom: 50px;
            }
            
            .campus-stat h3 {
                font-size: 28px !important;
            }
            
            .team-item__image {
                height: 240px;
            }
        }
        
        @media (max-width: 767px) {
            .about-header {
                padding: 120px 0 100px;
            }
            
            .about-header__title {
                font-size: 28px;
            }
            
            .play-button {
                width: 60px;
                height: 60px;
            }
            
            .play-button i {
                font-size: 20px;
            }
            
            .feature-item {
                padding: 25px 20px;
            }
            
            .feature-item__icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            
            .stats-item__number {
                font-size: 30px;
            }
            
            .team-item__image {
                height: 220px;
            }
        }
        
        @media (max-width: 575px) {
            .about-header {
                padding: 100px 0 80px;
            }
            
            .about-header__title {
                font-size: 24px;
            }
            
            .about-content__title {
                font-size: 20px;
            }
            
            .feature-item__title {
                font-size: 18px;
            }
            
            .stats-item__icon {
                font-size: 32px;
            }
            
            .stats-item__number {
                font-size: 26px;
            }
            
            .team-item__image {
                height: 200px;
            }
            
            /* Improve text readability on small screens */
            .about-content__text p {
                font-size: 14px;
                line-height: 1.6;
            }
            
            .feature-item__text {
                font-size: 14px;
            }
        }
        
        /* Fix for RTL on mobile */
        @media (max-width: 767px) {
            [dir="rtl"] .col-md-6 {
                text-align: right;
            }
            
            [dir="rtl"] .about-highlight {
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>
    <div class="page-wrapper">
        <?php include_once 'includes/menu.php'; ?>

        <!-- Header Section with Cosmic Background -->
        <section class="about-header">
            <!-- Cosmic Background Effect -->
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Stars are added dynamically via JavaScript -->
            </div> 
            <div class="container">
                <div class="about-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="about-header__title">
                        <?php echo $lang == 'fa' ? 'درباره مجتمع آموزشی سلمان فارسی' : 'About Salman Farsi Educational Complex'; ?>
                    </h1>
                    <p class="about-header__subtitle">
                    <?php echo $lang == 'fa' ? 'نمادی از تاریخ پرفراز و نشیب تعلیم و تربیت ایرانیان در امارات متحده عربی' : 'A symbol of Iranian education excellence in the United Arab Emirates'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- About Section with Video -->
        <section class="about-section">
            <div class="container">
                <div class="row">
                    <!-- Video Column -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <!-- Interactive Video Player with Custom Controls -->
                        <div class="about-video wow fadeInLeft" data-wow-delay="200ms">
                            <div class="video-container">
                                <div class="video-wrapper">
                                    <video id="schoolVideo" class="school-video" poster="assets/images/resources/video-thumbnail.jpg" preload="metadata">
                                        <source src="assets/videos/school-intro.mp4" type="video/mp4">
                                        <?php echo $lang == 'fa' ? 'مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.' : 'Your browser does not support the video tag.'; ?>
                                    </video>
                                    <div class="video-overlay" id="videoOverlay">
                                        <div class="play-button" id="customPlayButton">
                                            <i class="fas fa-play"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-caption">
                                    <?php echo $lang == 'fa' ? 'مجتمع آموزشی سلمان فارسی - معرفی امکانات و فضای آموزشی' : 'Salman Farsi Educational Complex - Facilities and Campus Tour'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Column -->
                     
                    <div class="col-lg-6">
                        <div class="about-content wow fadeInRight" data-wow-delay="200ms">
                            <p class="about-heading__tagline">
                                <?php echo $lang == 'fa' ? 'تاریخچه ما' : 'Our History'; ?>
                            </p>
                            <h2 class="about-heading__title">
                                <?php echo $lang == 'fa' ? 'مجتمع آموزشی سلمان فارسی، نماد آموزش ایرانی در امارات' : 'Salman Farsi Educational Complex: A Symbol of Iranian Education in UAE'; ?>
                            </h2>
                            <div class="about-content__text">
                                <?php if ($lang == 'fa'): ?>
                                <p>مجتمع آموزشی سلمان فارسی، نمادی از تاریخ پرفراز و نشیب تعلیم و تربیت ایرانیان در امارات متحده عربی، با افتخاراتی کم‌نظیر و میراثی ارزشمند، روایت‌گر مسیری است که با تلاش، تعهد و نوآوری همراه بوده است.</p>
                                
                                <p>آغاز فعالیت مجتمع به سال ۱۳۳۶ برمی‌گردد، زمانی که دبستان ایرانیان دبی به‌عنوان اولین مدرسه ایرانی در امارات، تحت نظارت اداره فرهنگ بنادر جنوب (بوشهر) تأسیس شد. این دبستان مختلط، تا سال تحصیلی ۵۹-۵۸ به همین صورت فعالیت داشت و پس از تفکیک جنسیتی، در سال ۶۰-۶۱ با نام "دبستان شهید رجایی" به مسیر خود ادامه داد.</p>
                                
                                <p>در سال تحصیلی ۵۱-۵۰، مدرسه راهنمایی تحصیلی ابوعلی سینا تأسیس شد و دوره متوسطه مجتمع از سال ۱۳۴۲ آغاز شد. در ادامه، با توسعه مدارس ایرانی در سال تحصیلی ۷۵-۷۴، "مجتمع آموزشی سلمان فارسی" با مدیریت واحد و ساختاری مستقل شکل گرفت.</p>
                                <?php else: ?>
                                <p>The Salman Farsi Educational Complex stands as a beacon of Iranian education in the United Arab Emirates, carrying a legacy of achievement and dedication. This institution narrates a rich history marked by tireless efforts, unwavering commitment, and innovative strides in the field of education.</p>
                                
                                <p>The complex's journey began in 1957, with the establishment of the Iranian Elementary School of Dubai, the first Iranian school in the UAE, operating under the supervision of the Southern Ports Cultural Administration (Bushehr). Initially coeducational, the school transitioned to gender-segregated education in 1979-1980 under the name "Shaheed Rajai Elementary School".</p>
                                
                                <p>In the academic year 1971-1970, Abu Ali Sina Middle School was inaugurated, and the high school program commenced in 1963. With the expansion of Iranian schools, in the academic year 1995-1994, the "Salman Farsi Educational Complex" was formed with unified management and independent governance.</p>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Highlights with Icon -->
                            <div class="about-highlights">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="about-highlight" data-wow-delay="0.3s">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            <?php echo $lang == 'fa' ? 'آموزش با کیفیت بالا' : 'High-Quality Education'; ?>
                                        </div>
                                        <div class="about-highlight" data-wow-delay="0.4s">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            <?php echo $lang == 'fa' ? 'محیطی امن و مطلوب' : 'Safe Learning Environment'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="about-highlight" data-wow-delay="0.5s">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            <?php echo $lang == 'fa' ? 'معلمان مجرب و متعهد' : 'Experienced Faculty'; ?>
                                        </div>
                                        <div class="about-highlight" data-wow-delay="0.6s">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            <?php echo $lang == 'fa' ? 'امکانات آموزشی مدرن' : 'Modern Facilities'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Campus Information Section -->
        <section class="about-section bg-light">
            <div class="container">
                <div class="row">
                    <!-- Content Column -->
                    <div class="col-lg-6 order-lg-1 order-2">
                        <div class="about-content wow fadeInLeft" data-wow-delay="200ms">
                           <p class="about-heading__tagline">
                                <?php echo $lang == 'fa' ? 'موقعیت مجتمع' : 'Campus Location'; ?>
                            </p>
                            <h2 class="about-heading__title">
                                <?php echo $lang == 'fa' ? 'فضایی ایده‌آل برای یادگیری و رشد' : 'An Ideal Environment for Learning & Growth'; ?>
                            </h2>
                            <div class="about-content__text">
                                <?php if ($lang == 'fa'): ?>
                                <p>زمین مجتمع از سوی شیخ محمد بن راشد آل مکتوم، امیر دبی، اهدا شد و هزینه احداث آن با کمک‌های مردمی و درآمدهای سرپرستی تأمین گردید. این مجتمع با زیربنای ۸۰۰۰ مترمربع و در زمینی به وسعت ۳۶۰۰۰ مترمربع احداث شده است.</p>
                                
                                <p>عملیات ساخت از ۱۲ بهمن ۱۳۷۳ آغاز و در مهر ۱۳۷۴ فاز اول با حضور وزیر وقت آموزش و پرورش افتتاح شد.</p>
                                <?php else: ?>
                                <p>The land for the complex was generously donated by Sheikh Mohammed bin Rashid Al Maktoum, the Ruler of Dubai, with construction costs funded through public donations and the Board of Trustees' revenue. The complex spans 36,000 square meters with a built-up area of 8,000 square meters.</p>
                                
                                <p>Construction began on February 1, 1995, and the first phase was inaugurated in October 1995 in the presence of Iran's Minister of Education. The second phase was completed in 2009.</p>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Campus Statistics with Animation -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="campus-stat text-center p-3 bg-white rounded shadow-sm" data-wow-delay="0.3s">
                                        <h3 class="fs-2 text-primary fw-bold count-animation" data-count="8000">0</h3>
                                        <p class="mb-0"><?php echo $lang == 'fa' ? 'متر مربع زیربنا' : 'Square Meters Built-up Area'; ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="campus-stat text-center p-3 bg-white rounded shadow-sm" data-wow-delay="0.5s">
                                        <h3 class="fs-2 text-primary fw-bold count-animation" data-count="36000">0</h3>
                                        <p class="mb-0"><?php echo $lang == 'fa' ? 'متر مربع مساحت زمین' : 'Square Meters of Land'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Column -->
                    <div class="col-lg-6 order-lg-2 order-1 mb-5 mb-lg-0">
                        <div class="about-image wow fadeInRight" data-wow-delay="200ms">
                            <img src="assets/images/resources/campus-1.jpg" alt="Salman Farsi Campus" class="img-fluid rounded shadow">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section with Interactive Cards -->
        <section class="features-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                    <p class="about-heading__tagline">
                            <?php echo $lang == 'fa' ? 'ویژگی‌ها و امکانات مجتمع' : 'Features and Facilities'; ?>
                        </p>
                        <h2 class="about-heading__title">
                            <?php echo $lang == 'fa' ? 'محیطی ایده‌آل برای یادگیری' : 'An Ideal Learning Environment'; ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Feature 1: Modern Classrooms -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="100ms">
                            <div class="feature-item__icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $lang == 'fa' ? 'کلاس‌های مجهز' : 'Modern Classrooms'; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $lang == 'fa' ? 'ساختمان دو طبقه مجتمع شامل ۲۶ کلاس درس مجهز به تخته‌های هوشمند، با محیطی مناسب برای یادگیری بهتر' : '26 classrooms equipped with smartboards, creating an optimal environment for enhanced learning'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Feature 2: Library -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="200ms">
                            <div class="feature-item__icon">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $lang == 'fa' ? 'کتابخانه مجهز' : 'Well-stocked Library'; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $lang == 'fa' ? 'کتابخانه‌ای با ظرفیت ۴۵۰۰ جلد کتاب در زمینه‌های مختلف علمی، ادبی و هنری' : 'A library with a collection of 4,500 books covering various scientific, literary, and artistic subjects'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Feature 3: Science Labs -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="300ms">
                            <div class="feature-item__icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $lang == 'fa' ? 'آزمایشگاه‌های علمی' : 'Science Laboratories'; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $lang == 'fa' ? 'آزمایشگاه‌های مجهز علمی برای مقاطع ابتدایی، راهنمایی و دبیرستان' : 'State-of-the-art science laboratories for elementary, middle, and high school levels'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Feature 4: Computer Labs -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="400ms">
                            <div class="feature-item__icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $lang == 'fa' ? 'کارگاه‌های رایانه' : 'Computer Labs'; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $lang == 'fa' ? 'سه کارگاه رایانه با بیش از ۴۰ دستگاه مجهز برای آموزش مهارت‌های دیجیتال' : 'Three computer labs with over 40 computers, fully equipped for teaching digital skills'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Feature 5: Sports Facilities -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="500ms">
                            <div class="feature-item__icon">
                                <i class="fas fa-futbol"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $lang == 'fa' ? 'امکانات ورزشی' : 'Sports Facilities'; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $lang == 'fa' ? 'زمین‌های ورزشی استاندارد شامل فوتبال، هندبال، والیبال و بسکتبال' : 'Standard sports fields including football, handball, volleyball, and basketball courts'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Feature 6: Multipurpose Hall -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="600ms">
                            <div class="feature-item__icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $lang == 'fa' ? 'سالن چندمنظوره' : 'Multipurpose Hall'; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $lang == 'fa' ? 'سالن بزرگ برای نماز، اجتماعات و امتحانات با امکانات صوتی و تصویری پیشرفته' : 'Large hall for prayers, assemblies, and examinations with advanced audio-visual equipment'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section with Animated Counters -->
        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <!-- Stat 1: Graduates -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item wow fadeInUp" data-wow-delay="100ms">
                            <div class="stats-item__icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="stats-item__number">
                                <span class="counter-value" data-count="5000">0</span>+
                            </div>
                            <div class="stats-item__text">
                                <?php echo $lang == 'fa' ? 'دانش‌آموختگان' : 'Graduates'; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 2: Teachers -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item wow fadeInUp" data-wow-delay="200ms">
                            <div class="stats-item__icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stats-item__number">
                                <span class="counter-value" data-count="100">0</span>+
                            </div>
                            <div class="stats-item__text">
                                <?php echo $lang == 'fa' ? 'معلمان متخصص' : 'Expert Teachers'; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 3: Awards -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item wow fadeInUp" data-wow-delay="300ms">
                            <div class="stats-item__icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stats-item__number">
                                <span class="counter-value" data-count="75">0</span>+
                            </div>
                            <div class="stats-item__text">
                                <?php echo $lang == 'fa' ? 'جوایز و افتخارات' : 'Awards'; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 4: Experience -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item wow fadeInUp" data-wow-delay="400ms">
                            <div class="stats-item__icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stats-item__number">
                                <span class="counter-value" data-count="65">0</span>+
                            </div>
                            <div class="stats-item__text">
                                <?php echo $lang == 'fa' ? 'سال‌های فعالیت' : 'Years of Experience'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Graduates Success Section -->
        <section class="about-section">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Image Column -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="about-image wow fadeInLeft" data-wow-delay="200ms">
                            <img src="assets/images/resources/graduates.jpg" alt="Salman Farsi Graduates" class="img-fluid rounded shadow">
                        </div>
                    </div>
                    
                    <!-- Content Column -->
                    <div class="col-lg-6">
                        <div class="about-content wow fadeInRight" data-wow-delay="200ms">
                            <p class="about-heading__tagline">
                                <?php echo $lang == 'fa' ? 'فارغ‌التحصیلان ما' : 'Our Graduates'; ?>
                            </p>
                            <h2 class="about-heading__title">
                                <?php echo $lang == 'fa' ? 'داستان‌های موفقیت دانش‌آموختگان ما' : 'Success Stories of Our Alumni'; ?>
                            </h2>
                            <div class="about-content__text">
                                <?php if ($lang == 'fa'): ?>
                                <p>هر ساله بیش از ۹۰ درصد دانش‌آموزان پایه دوازدهم این مجتمع فارغ‌التحصیل شده و اکثر آن‌ها در دانشگاه‌های معتبر جهانی مشغول به تحصیل یا وارد بازار کار امارات می‌شوند.</p>
                                
                                <p>فارغ‌التحصیلان ما در رشته‌های مختلف مانند پزشکی، مهندسی، هنر و تجارت موفق بوده‌اند و افتخارات بزرگی را برای جامعه ایرانی به ارمغان آورده‌اند.</p>
                                <?php else: ?>
                                <p>Every year, over 90% of our 12th-grade students graduate, with most progressing to prestigious universities worldwide or entering the UAE workforce.</p>
                                
                                <p>Our alumni have excelled in various fields such as medicine, engineering, arts, and business, bringing great honor to the Iranian community. Their achievements reflect the educational excellence fostered at Salman Farsi Educational Complex.</p>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Graduate Statistics -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="graduate-stat text-center p-3 bg-light rounded">
                                        <h3 class="fs-2 text-primary fw-bold counter-value" data-count="90">0</h3><span class="fs-2 text-primary fw-bold">%+</span>
                                        <p class="mb-0"><?php echo $lang == 'fa' ? 'نرخ قبولی در دانشگاه' : 'University Acceptance Rate'; ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="graduate-stat text-center p-3 bg-light rounded">
                                        <h3 class="fs-2 text-primary fw-bold counter-value" data-count="75">0</h3><span class="fs-2 text-primary fw-bold">%+</span>
                                        <p class="mb-0"><?php echo $lang == 'fa' ? 'اشتغال در مشاغل تخصصی' : 'Professional Employment'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section with Leadership -->
        <section class="team-section bg-light">
            <div class="container">
                <!-- Section Header -->
                <div class="row">
                    <div class="col-md-8 mx-auto text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                         <p class="about-heading__tagline">
                            <?php echo $lang == 'fa' ? 'تیم مدیریت' : 'Leadership Team'; ?>
                        </p>
                        <h2 class="about-heading__title">
                            <?php echo $lang == 'fa' ? 'با مدیران ما آشنا شوید' : 'Meet Our Leadership'; ?>
                        </h2>
                    </div>
                </div>
                
                <!-- Team Members Row -->
                <div class="row">
                    <!-- Team Member 1 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item wow fadeInUp" data-wow-delay="100ms">
                            <div class="team-item__image">
                                <img src="assets/images/Staff/Akhlasi.png" alt="Principal">
                            </div>
                            <div class="team-item__content">
                                <h3 class="team-item__title">
                                    <a href="#"><?php echo $lang == 'fa' ? 'دکتر مجید اخلاصی' : 'Dr. Majid Akhlasi'; ?></a>
                                </h3>
                                <p class="team-item__designation">
                                    <?php echo $lang == 'fa' ? 'مدیر مجتمع' : 'Principal'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Team Member 2 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item wow fadeInUp" data-wow-delay="200ms">
                            <div class="team-item__image">
                                <img src="assets/images/Staff/Dashab.png" alt="Vice Principal">
                            </div>
                            <div class="team-item__content">
                                <h3 class="team-item__title">
                                    <a href="#"><?php echo $lang == 'fa' ? 'خانم نصرت داشاب' : 'Ms. Nosrat Dashab'; ?></a>
                                </h3>
                                <p class="team-item__designation">
                                    <?php echo $lang == 'fa' ? 'معاون آموزشی' : 'Educational Assistant'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Team Member 3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item wow fadeInUp" data-wow-delay="300ms">
                            <div class="team-item__image">
                                <img src="assets/images/Staff/Mohammadi.png" alt="Admin Head">
                            </div>
                            <div class="team-item__content">
                                <h3 class="team-item__title">
                                    <a href="#"><?php echo $lang == 'fa' ? 'آقای محمد رضا محمدی' : 'Mr. Mohammad Reza Mohammadi'; ?></a>
                                </h3>
                                <p class="team-item__designation">
                                    <?php echo $lang == 'fa' ? 'معاون متوسطه دوم' : 'Second secondary assistant'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Team Member 4 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item wow fadeInUp" data-wow-delay="400ms">
                            <div class="team-item__image">
                                <img src="assets/images/Staff/Jafari.png" alt="Academic Coordinator">
                            </div>
                            <div class="team-item__content">
                                <h3 class="team-item__title">
                                    <a href="#"><?php echo $lang == 'fa' ? 'خانم معصومه جعفری' : 'Ms. Masoomeh Jafari'; ?></a>
                                </h3>
                                <p class="team-item__designation">
                                    <?php echo $lang == 'fa' ? 'معاون اجرایی' : 'Deputy Manager'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- View All Staff Button -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="staff.php<?php echo $lang == 'en' ? '' : '?lang=' . $lang; ?>" class="btn btn-primary btn-lg px-4 py-2 wow fadeInUp" data-wow-delay="500ms">
                            <?php echo $lang == 'fa' ? 'مشاهده تمام کادر آموزشی' : 'View All Staff Members'; ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-5" style="background-color: var(--primary-color);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-7">
                        <div class="text-white">
                            <h2 class="mb-3 fw-bold wow fadeInLeft" data-wow-delay="300ms" style="color:#fff;">
                                <?php echo $lang == 'fa' ? 'به خانواده مجتمع آموزشی سلمان فارسی بپیوندید' : 'Join the Salman Farsi Educational Complex Family'; ?>
                            </h2>
                            <p class="mb-0 fs-5 wow fadeInLeft" data-wow-delay="400ms">
                                <?php echo $lang == 'fa' ? 'آینده فرزند خود را با آموزش باکیفیت، محیطی امن و فرهنگی غنی تضمین کنید' : 'Secure your child\'s future with quality education, a safe environment, and rich culture'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 text-md-end text-center mt-4 mt-md-0 wow fadeInRight" data-wow-delay="500ms">
                        <a href="Terms and Conditions for Registration.php<?php echo $lang == 'en' ? '' : '?lang=' . $lang; ?>" class="btn btn-light btn-lg px-4 py-3 fw-bold">
                            <?php echo $lang == 'fa' ? 'ثبت‌نام کنید' : 'Apply Now'; ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div><!-- /.page-wrapper -->

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="assets/vendors/tiny-slider/tiny-slider.js"></script>
    <script src="assets/vendors/wnumb/wNumb.min.js"></script>
    <script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/imagesloaded/imagesloaded.min.js"></script>
    <script src="assets/vendors/isotope/isotope.js"></script>
    <script src="assets/vendors/slick/slick.min.js"></script>
    <script src="assets/vendors/jquery-flipster-master/jquery.flipster.min.js"></script>
    <script src="assets/vendors/countdown/countdown.min.js"></script>
    <script src="assets/vendors/jquery-circleType/jquery.circleType.js"></script>
    <script src="assets/vendors/jquery-lettering/jquery.lettering.min.js"></script>
    
    <!-- Template JS -->
    <script src="assets/js/salman.js"></script>

    <!-- Enhanced Custom JavaScript for About Us Page -->
    <script>
        /**
         * Custom JavaScript for About Us Page
         * Includes animations, counter effects, and video player functionality
         * 
         * @package Salman Educational Complex
         * @version 2.6
         */
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize components
            initCosmicStars();
            initVideoPlayer();
            initCounters();
            initWowAnimations();
            
            /**
             * Create cosmic stars animation
             * Adds dynamic stars to the header background
             */
            function initCosmicStars() {
                const cosmicBg = document.querySelector('.cosmic-bg');
                if (!cosmicBg) return;
                
                const starsCount = 60; // More stars for better effect
                
                for (let i = 0; i < starsCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'cosmic-star';
                    
                    // Random size between 1-3px
                    const size = Math.random() * 2 + 1;
                    star.style.width = `${size}px`;
                    star.style.height = `${size}px`;
                    
                    // Random position
                    star.style.left = `${Math.random() * 100}%`;
                    star.style.top = `${Math.random() * 100}%`;
                    
                    // Random animation duration and delay
                    star.style.animationDuration = `${Math.random() * 2 + 1}s`;
                    star.style.animationDelay = `${Math.random() * 2}s`;
                    
                    cosmicBg.appendChild(star);
                }
            }
            
            /**
             * Initialize custom video player
             * Handles play/pause functionality and overlay display
             */
            function initVideoPlayer() {
                const video = document.getElementById('schoolVideo');
                const videoOverlay = document.getElementById('videoOverlay');
                const customPlayButton = document.getElementById('customPlayButton');
                
                if (!video || !videoOverlay || !customPlayButton) return;
                
                const videoContainer = video.closest('.video-container');
                
                // Play button click handler
                customPlayButton.addEventListener('click', function() {
                    playVideo();
                });
                
                // Video click handler for play/pause toggle
                video.addEventListener('click', function() {
                    if (video.paused) {
                        playVideo();
                    } else {
                        pauseVideo();
                    }
                });
                
                // Show overlay when video is paused
                video.addEventListener('pause', function() {
                    showOverlay();
                });
                
                // Show overlay when video ends
                video.addEventListener('ended', function() {
                    showOverlay();
                });
                
                // Helper function to play video
                function playVideo() {
                    video.play()
                        .then(() => {
                            hideOverlay();
                        })
                        .catch(error => {
                            console.error('Error playing video:', error);
                            // Show a message to the user that they need to interact with the page first
                            alert('Please interact with the page first to play the video');
                        });
                }
                
                // Helper function to pause video
                function pauseVideo() {
                    video.pause();
                    showOverlay();
                }
                
                // Helper function to hide overlay
                function hideOverlay() {
                    videoContainer.classList.add('video-playing');
                }
                
                // Helper function to show overlay
                function showOverlay() {
                    videoContainer.classList.remove('video-playing');
                }
            }
            
            /**
             * Initialize number counters
             * Animates counting from 0 to target number
             */
            function initCounters() {
                // Select all counter elements
                const counters = document.querySelectorAll('.counter-value');
                const countAnimations = document.querySelectorAll('.count-animation');
                
                // Counter animation for elements with counter-value class
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    
                    // Create waypoint to trigger counter when visible
                    const waypoint = new Waypoint({
                        element: counter,
                        handler: function() {
                            animateCounter(counter, target);
                            this.destroy(); // Only trigger once
                        },
                        offset: '90%'
                    });
                });
                
                // Counter animation for elements with count-animation class
                countAnimations.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    
                    // Create waypoint to trigger counter when visible
                    const waypoint = new Waypoint({
                        element: counter,
                        handler: function() {
                            animateCounter(counter, target);
                            this.destroy(); // Only trigger once
                        },
                        offset: '90%'
                    });
                });
                
                /**
                 * Animate counter from 0 to target
                 * 
                 * @param {HTMLElement} element - The counter element
                 * @param {number} target - The target number
                 */
                function animateCounter(element, target) {
                    let start = 0;
                    const duration = 2000; // 2 seconds
                    const increment = target / (duration / 16); // Update every 16ms (60fps)
                    const startTime = performance.now();
                    
                    function updateCounter(timestamp) {
                        const elapsed = timestamp - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        
                        // Calculate current value based on easing function
                        // Using easeOutQuad for a nice effect
                        const easeProgress = 1 - (1 - progress) * (1 - progress);
                        const currentValue = Math.floor(easeProgress * target);
                        
                        // Update counter display
                        element.textContent = currentValue.toLocaleString();
                        
                        // Continue animation if not complete
                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            // Ensure final value is exactly the target
                            element.textContent = target.toLocaleString();
                        }
                    }
                    
                    requestAnimationFrame(updateCounter);
                }
            }
            
            /**
             * Initialize WOW.js animations
             * Handles scroll-based animations
             */
            function initWowAnimations() {
                if (typeof WOW === 'function') {
                    new WOW({
                        boxClass: 'wow',
                        animateClass: 'animated',
                        offset: 50,
                        mobile: true,
                        live: true
                    }).init();
                }
            }
        });
        
        /**
         * Waypoint library - Simple implementation for counter animations
         * This is a lightweight implementation to avoid loading the full library
         */
        class Waypoint {
            constructor(options) {
                this.element = options.element;
                this.handler = options.handler;
                this.offset = options.offset || '100%';
                
                // Initialize
                this.init();
            }
            
            init() {
                // Create intersection observer
                const offsetValue = parseInt(this.offset) / 100;
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.handler();
                        }
                    });
                }, {
                    threshold: [0],
                    rootMargin: `0px 0px ${offsetValue * 100}% 0px`
                });
                
                // Start observing
                observer.observe(this.element);
                
                // Store observer for later cleanup
                this.observer = observer;
            }
            
            destroy() {
                if (this.observer) {
                    this.observer.disconnect();
                }
            }
        }
    </script>
</body>
</html>