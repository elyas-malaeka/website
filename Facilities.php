     
     
     <?php
/**
 * Facilities Page
 * 
 * This file displays information about the facilities and services available
 * at the Salman Farsi Educational Complex.
 * 
 * @package Salman Educational Complex
 * @version 2.0
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
    <title><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities & Services'; ?> | <?php echo SITE_NAME_EN; ?></title>

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
        /* Custom styles for Facilities page */
        :root {
            --primary-color: #6941C6;
            --secondary-color: #333333;
            --accent-color: #7F56D9;
            --text-color: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --bg-primary: #f9f9f9;
            --white: #ffffff;
            --border-radius: 15px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --animation-duration: 0.3s;
            --transition: all 0.3s ease;
        }
        
        /* Font Styles */
        @font-face {
            font-family: 'Vazir';
            src: url('assets/fonts/Vazir.eot');
            src: url('assets/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                 url('assets/fonts/Vazir.woff2') format('woff2'),
                 url('assets/fonts/Vazir.woff') format('woff'),
                 url('assets/fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
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
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        [dir="rtl"] body {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Facilities Header */
        .facilities-header {
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
        
        .facilities-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,229.3C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center bottom;
            z-index: 1;
        }
        
        .facilities-header__content {
            position: relative;
            z-index: 2;
        }
        
        .facilities-header__title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
        }
        
        [dir="rtl"] .facilities-header__title {
            font-family: 'Vazir', sans-serif !important;
        }
        
        .facilities-header__subtitle {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
            color: white;
            animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
            color: rgb(15, 12, 95);
        }
        
        [dir="rtl"] .facilities-header__subtitle {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Facility Sections */
        .facility-section {
            padding: 100px 0;
            position: relative;
        }
        
        .facility-section:nth-child(even) {
            background-color: var(--bg-light);
        }
        
        .section-label {
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1.5px;
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        [dir="rtl"] .section-label {
            font-family: 'Vazir', sans-serif;
        }
        
        .section-title {
            font-size: 32px;
            font-weight: 800;
            color: rgb(2, 2, 10);
            margin-bottom: 25px;
            line-height: 1.3;
        }
        
        [dir="rtl"] .section-title {
            font-family: 'Vazir', sans-serif;
        }
        
        .section-description {
            color: var(--text-color);
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        
        [dir="rtl"] .section-description {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Facility Image */
        .facility-image {
            width: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            position: relative;
            transition: var(--transition);
        }
        
        .facility-image:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(105, 65, 198, 0.15);
        }
        
        .facility-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .facility-image:hover img {
            transform: scale(1.05);
        }
        
        /* Feature Boxes */
        .feature-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
        }
        
        [dir="rtl"] .feature-list {
            padding-right: 0;
        }
        
        .feature-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            color: var(--text-color);
            font-size: 16px;
        }
        
        [dir="rtl"] .feature-list li {
            padding-left: 0;
            padding-right: 30px;
            font-family: 'Vazir', sans-serif;
        }
        
        .feature-list li:before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: var(--primary-color);
            position: absolute;
            left: 0;
            top: 2px;
        }
        
        [dir="rtl"] .feature-list li:before {
            left: auto;
            right: 0;
        }
        
        /* Key Focus Box */
        .key-focus {
            border-left: 4px solid var(--primary-color);
            padding-left: 20px;
            margin-top: 40px;
            background-color: rgba(105, 65, 198, 0.05);
            padding: 25px 25px 25px 30px;
            border-radius: 0 15px 15px 0;
        }
        
        [dir="rtl"] .key-focus {
            border-left: none;
            border-right: 4px solid var(--primary-color);
            padding-left: 25px;
            padding-right: 30px;
            border-radius: 15px 0 0 15px;
        }
        
        .key-focus h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }
        
        [dir="rtl"] .key-focus h4 {
            font-family: 'Vazir', sans-serif;
        }
        
        .key-focus p {
            font-size: 15px;
            color: var(--text-light);
            margin-bottom: 0;
        }
        
        [dir="rtl"] .key-focus p {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Dual Images */
        .dual-images {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .dual-image-item {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            position: relative;
            transition: var(--transition);
        }
        
        .dual-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(105, 65, 198, 0.15);
        }
        
        .dual-image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .dual-image-item:hover img {
            transform: scale(1.05);
        }
        
        /* Animation Keyframes */
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
        
        @keyframes floatEffect {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .facility-section {
                padding: 70px 0;
            }
            
            .facilities-header {
                padding: 150px 0 120px;
            }
            
            .facilities-header__title {
                font-size: 36px;
            }
            
            .section-title {
                font-size: 28px;
            }
        }
        
        @media (max-width: 767px) {
            .facility-section {
                padding: 50px 0;
            }
            
            .facilities-header {
                padding: 120px 0 100px;
            }
            
            .facilities-header__title {
                font-size: 30px;
            }
            
            .section-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Header Section -->
        <section class="facilities-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="facilities-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="facilities-header__title">
                        <?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities & Services'; ?>
                    </h1>
                    <p class="facilities-header__subtitle">
                        <?php echo $lang == 'fa' ? 'محیطی پویا برای رشد و یادگیری' : 'A Thriving Environment for Growth and Learning'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Introduction Section -->
        <section class="facility-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="assets/images/facilities/school.jpeg" alt="<?php echo $lang == 'fa' ? 'نمای مدرسه سلمان فارسی' : 'Salman Farsi School Building'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'محیطی پویا برای رشد و یادگیری' : 'A Thriving Environment for Growth and Learning'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>مجتمع آموزشی سلمان فارسی محیطی پویا را برای رشد جامع دانش‌آموزان در زمینه‌های علمی، ورزشی، فرهنگی و اجتماعی فراهم کرده است. با زیرساخت‌های مدرن و امکانات پیشرفته، این مجموعه به پرورش افرادی خلاق، متعهد و توانمند برای موفقیت در جنبه‌های مختلف زندگی اختصاص یافته است.</p>
                                <?php else: ?>
                                <p>The Salman Farsi Educational Complex offers a dynamic setting designed to foster comprehensive student development in academic, athletic, cultural, and social spheres. Equipped with modern infrastructure and state-of-the-art facilities, the complex is dedicated to nurturing creative, committed, and capable individuals prepared to excel in various aspects of life.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Smart Classrooms Section -->
        <section class="facility-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="200ms">
                            <img src="assets/images/facilities/classes.png" alt="<?php echo $lang == 'fa' ? 'کلاس‌های هوشمند' : 'Smart Classrooms'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'کلاس‌های هوشمند و ابزارهای آموزشی مدرن' : 'Smart Classrooms and Modern Educational Tools'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>هر کلاس درس مجهز به تخته‌های هوشمند، پروژکتورهای پیشرفته و سیستم‌های صوتی-تصویری است که امکان یادگیری تعاملی و جذاب را فراهم می‌کند. با ادغام فناوری‌های پیشرفته آموزشی، مجتمع کیفیت یادگیری را ارتقا داده و دانش‌آموزان را به طور فعال در فرآیند آموزشی درگیر می‌کند.</p>
                                <?php else: ?>
                                <p>Each classroom is outfitted with smart boards, advanced projectors, and audio-visual systems, enabling interactive and engaging learning experiences. By integrating cutting-edge educational technologies, the complex enhances learning quality and actively involves students in the educational process.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Science Labs Section -->
        <section class="facility-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="assets/images/facilities/laboratoy.jpg" alt="<?php echo $lang == 'fa' ? 'آزمایشگاه‌های علمی' : 'Science Laboratories'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'آزمایشگاه‌های علمی پیشرفته' : 'Advanced Scientific Laboratories'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>مجتمع دارای آزمایشگاه‌های کاملا مجهز شیمی و زیست‌شناسی است که محیطی عملی و محرک برای انجام آزمایش‌ها، پروژه‌های تحقیقاتی و ارتقای مهارت‌ها در علوم را فراهم می‌کند.</p>
                                <?php else: ?>
                                <p>The complex features fully equipped laboratories for chemistry and biology, providing a practical and stimulating environment for experiments, research projects, and skill enhancement in the sciences.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Library Section -->
        <section class="facility-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="200ms">
                            <img src="assets/images/facilities/library.png" alt="<?php echo $lang == 'fa' ? 'کتابخانه' : 'Library'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'کتابخانه جامع' : 'Comprehensive Library'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>با هزاران کتاب چاپی، کتابخانه فضایی آرام و پر منبع برای مطالعه و تحقیق فراهم می‌کند. ابزارهای جستجوی دیجیتال و دسترسی به منابع علمی، دانش‌آموزان را در دستیابی به برتری تحصیلی و پژوهشی پشتیبانی می‌کند.</p>
                                <?php else: ?>
                                <p>With thousands of printed books, the library offers a quiet, resourceful space for study and research. Digital search tools and access to scientific resources further support students in achieving academic and research excellence.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
<!-- Sports Facilities Section -->
<section class="facility-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                    <img src="assets/images/facilities/football feild.png" alt="<?php echo $lang == 'fa' ? 'زمین فوتبال' : 'Football Field'; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                    <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                    <h2 class="section-title">
                        <?php echo $lang == 'fa' ? 'امکانات ورزشی و فضاهای تفریحی' : 'Sports Facilities and Recreation Areas'; ?>
                    </h2>
                    <div class="section-description">
                        <?php if ($lang == 'fa'): ?>
                        <p>مجتمع آموزشی سلمان فارسی دارای امکانات ورزشی متنوع برای تقویت سلامت جسمی و روحیه کار تیمی دانش‌آموزان است.</p>
                        <?php else: ?>
                        <p>The Salman Farsi Educational Complex offers diverse sports facilities to enhance students' physical health and teamwork spirit.</p>
                        <?php endif; ?>
                    </div>
                    
                    <ul class="feature-list">
                        <li><?php echo $lang == 'fa' ? 'چندین زمین چمن ورزشی' : 'Multiple grass sports fields'; ?></li>
                        <li><?php echo $lang == 'fa' ? 'سالن‌های ورزشی چندمنظوره داخلی' : 'Multifunctional indoor sports halls'; ?></li>
                        <li><?php echo $lang == 'fa' ? 'امکانات برای فعالیت‌هایی مانند فوتبال، والیبال، بسکتبال و تنیس روی میز' : 'Facilities for activities such as football, volleyball, basketball, and table tennis'; ?></li>
                    </ul>
                    
                    <div class="section-description">
                        <?php if ($lang == 'fa'): ?>
                        <p>این امکانات، همراه با برنامه‌های ورزشی سازمان‌یافته، سلامت جسمی و کار تیمی را تشویق می‌کنند.</p>
                        <?php else: ?>
                        <p>These amenities, coupled with organized sports programs, encourage physical health and teamwork.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Arts and Culture Section -->
<section class="facility-section" style="background-color: var(--bg-light);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                <div class="facility-image wow fadeInUp" data-wow-delay="200ms">
                    <img src="assets/images/facilities/arts.png" alt="<?php echo $lang == 'fa' ? 'فعالیت‌های هنری' : 'Art Activities'; ?>">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                    <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                    <h2 class="section-title">
                        <?php echo $lang == 'fa' ? 'فعالیت‌های فرهنگی و هنری' : 'Cultural and Artistic Activities'; ?>
                    </h2>
                    <ul class="feature-list">
                        <li><?php echo $lang == 'fa' ? 'جشن‌های ملی و مذهبی' : 'National and religious celebrations'; ?></li>
                        <li><?php echo $lang == 'fa' ? 'نمایشگاه‌های هنری و کارگاه‌های خلاقیت' : 'Art exhibitions and creativity workshops'; ?></li>
                        <li><?php echo $lang == 'fa' ? 'آموزش هنرهایی مانند نقاشی، موسیقی و تئاتر' : 'Training in arts such as painting, music, and theater'; ?></li>
                    </ul>
                    <div class="section-description">
                        <?php if ($lang == 'fa'): ?>
                        <p>مجتمع سلمان فارسی با ارائه برنامه‌های غنی فرهنگی و هنری، به پرورش استعدادهای چندبعدی دانش‌آموزان کمک می‌کند.</p>
                        <?php else: ?>
                        <p>The Salman Farsi Complex helps develop students' multidimensional talents through rich cultural and artistic programs.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        
        <!-- Prayer Hall Section -->
        <section class="facility-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="assets/images/facilities/prayerhall.jpg" alt="<?php echo $lang == 'fa' ? 'نمازخانه' : 'Prayer Hall'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'نمازخانه و برنامه‌های مذهبی' : 'Prayer Hall and Religious Programs'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>نمازخانه محیطی دلنشین برای نمازهای جماعت، جلسات قرآنی و بحث‌های اخلاقی فراهم می‌کند که به رشد معنوی و اخلاقی دانش‌آموزان کمک می‌کند.</p>
                                <?php else: ?>
                                <p>The prayer hall provides a welcoming environment for congregational prayers, Quranic sessions, and ethical discussions, fostering students' spiritual and moral growth.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Health Clinic Section -->
        <section class="facility-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="200ms">
                            <img src="assets/images/facilities/clinic.png" alt="<?php echo $lang == 'fa' ? 'درمانگاه سلامت' : 'Health Clinic'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'درمانگاه سلامت و خدمات تندرستی' : 'Health Clinic and Wellness Services'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>درمانگاه سلامت، تحت نظارت متخصصان پزشکی واجد شرایط، خدمات زیر را ارائه می‌دهد:</p>
                                <?php else: ?>
                                <p>Supervised by qualified medical professionals, the health clinic offers:</p>
                                <?php endif; ?>
                            </div>
                            
                            <ul class="feature-list">
                                <li><?php echo $lang == 'fa' ? 'معاینات پزشکی معمول' : 'Routine medical check-ups'; ?></li>
                                <li><?php echo $lang == 'fa' ? 'برنامه‌های واکسیناسیون' : 'Vaccination programs'; ?></li>
                                <li><?php echo $lang == 'fa' ? 'مشاوره تغذیه و روانشناسی' : 'Nutritional and psychological counseling'; ?></li>
                            </ul>
                            
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>این خدمات با هدف حفظ و بهبود سلامت جسمی و روانی دانش‌آموزان ارائه می‌شود.</p>
                                <?php else: ?>
                                <p>These services aim to maintain and improve the physical and mental health of students.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Counseling Services Section -->
        <section class="facility-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="assets/images/facilities/counseling.jpg" alt="<?php echo $lang == 'fa' ? 'خدمات مشاوره' : 'Counseling Services'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'خدمات مشاوره و راهنمایی' : 'Counseling and Guidance Services'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>مشاوران حرفه‌ای به دانش‌آموزان در زمینه‌های تحصیلی، عاطفی و اجتماعی از طریق موارد زیر کمک می‌کنند:</p>
                                <?php else: ?>
                                <p>Professional counselors support students academically, emotionally, and socially through:</p>
                                <?php endif; ?>
                            </div>
                            
                            <ul class="feature-list">
                                <li><?php echo $lang == 'fa' ? 'مشاوره فردی و گروهی' : 'Individual and group counseling'; ?></li>
                                <li><?php echo $lang == 'fa' ? 'کارگاه‌های مهارت‌های زندگی' : 'Life skills workshops'; ?></li>
                                <li><?php echo $lang == 'fa' ? 'جلسات راهنمایی شغلی' : 'Career guidance sessions'; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Cafeteria Section -->
        <section class="facility-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="200ms">
                            <img src="assets/images/facilities/cafeteria.jpg" alt="<?php echo $lang == 'fa' ? 'سالن غذاخوری' : 'Cafeteria'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'سالن غذاخوری بهداشتی با غذاهای مغذی' : 'Hygienic Cafeteria with Nutritious Meals'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>سالن غذاخوری دسترسی به وعده‌های غذایی و میان‌وعده‌های سالم و مغذی را تضمین می‌کند و رژیم‌های غذایی متعادل را برای حفظ انرژی و سلامت کلی دانش‌آموزان ترویج می‌دهد.</p>
                                <?php else: ?>
                                <p>The cafeteria ensures access to healthy, nutritious meals and snacks, promoting balanced diets to sustain student energy and overall well-being.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Special Needs Support Section -->
        <section class="facility-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="assets/images/facilities/Primary Reception.png" alt="<?php echo $lang == 'fa' ? 'پذیرش ابتدایی' : 'Primary Reception'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'پشتیبانی از دانش‌آموزان با نیازهای ویژه' : 'Support for Students with Special Needs'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>خدمات تخصصی برای دانش‌آموزان با نیازهای ویژه، شامل موارد زیر است:</p>
                                <?php else: ?>
                                <p>Specialized services cater to students with unique needs, including:</p>
                                <?php endif; ?>
                            </div>
                            
                            <ul class="feature-list">
                                <li><?php echo $lang == 'fa' ? 'گفتاردرمانی و توانبخشی' : 'Speech therapy and rehabilitation'; ?></li>
                                <li><?php echo $lang == 'fa' ? 'مشاوره شخصی‌سازی شده' : 'Personalized counseling'; ?></li>
                                <li><?php echo $lang == 'fa' ? 'برنامه‌های توسعه مهارت‌های اجتماعی' : 'Social skills development programs'; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Safety Section -->
        <section class="facility-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="200ms">
                            <img src="assets/images/facilities/saftey.jpg" alt="<?php echo $lang == 'fa' ? 'ایمنی و آمادگی بحران' : 'Safety and Crisis Preparedness'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'امکانات و خدمات' : 'Facilities and Services'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'ایمنی و آمادگی بحران' : 'Safety and Crisis Preparedness'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>مجتمع از پروتکل‌های ایمنی سختگیرانه‌ای پیروی می‌کند و دوره‌هایی درباره مدیریت بحران، ایمنی آتش‌سوزی و آمادگی زلزله ارائه می‌دهد تا دانش‌آموزان را برای شرایط اضطراری آماده کند.</p>
                                <?php else: ?>
                                <p>The complex adheres to rigorous safety protocols, providing courses on crisis management, fire safety, and earthquake preparedness to equip students for emergencies.</p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="key-focus">
                                <h4>
                                    <?php echo $lang == 'fa' ? 'تمرکز ویژه: آموزش مدیریت بحران' : 'Key Focus: Crisis Management Training'; ?>
                                </h4>
                                <p>
                                    <?php echo $lang == 'fa' ? 'ما دانش‌آموزان را با دانش و مهارت‌های لازم برای مدیریت مؤثر شرایط اضطراری توانمند می‌کنیم و آنها را برای هر موقعیت غیرمنتظره آماده می‌کنیم.' : 'We empower students with the knowledge and skills to handle emergencies effectively, preparing them for any unexpected situation.'; ?>
                                </p>
                            </div>
                        </div>
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
    
    <!-- Custom JS for Facilities Page -->
    <script>
        // Initialize wow.js for animations
        new WOW().init();
        
        // Generate random stars for cosmic background
        function generateStars() {
            const cosmicBg = document.querySelector('.cosmic-bg');
            if (!cosmicBg) return;
            
            const starsCount = 100;
            
            for (let i = 0; i < starsCount; i++) {
                const star = document.createElement('div');
                star.classList.add('cosmic-star');
                
                // Random size between 1-3px
                const size = Math.random() * 2 + 1;
                star.style.width = size + 'px';
                star.style.height = size + 'px';
                
                // Random position
                star.style.top = Math.random() * 100 + '%';
                star.style.left = Math.random() * 100 + '%';
                
                // Random animation delay
                star.style.animationDelay = Math.random() * 2 + 's';
                
                cosmicBg.appendChild(star);
            }
        }
        
        $(document).ready(function() {
            generateStars();
        });
    </script>
</body>
</html>