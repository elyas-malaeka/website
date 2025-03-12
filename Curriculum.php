<?php
/**
 * Curriculum Page
 * 
 * This file displays the curriculum information for Salman Educational Complex,
 * including Ehsan section (for students with special needs), Elementary, 
 * Middle School and High School divisions.
 * 
 * @package Salman Educational Complex
 * @version 2.1
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
    <title><?php echo t('curriculum_title', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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
    
    <!-- Custom Styles for Curriculum Page -->
    <link rel="stylesheet" href="assets/css/curriculum.css" />
    
    <style>
        /* Core Curriculum Page Styles */
/* Core Curriculum Page Styles */
:root {
    --primary-color: #6941C6;         /* Purple from your CSS */
    --secondary-color: #333333;        /* Dark gray/black for titles */
    --accent-color: #7F56D9;           /* Light purple accent from your CSS */
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
    src: url('../fonts/Vazir.eot');
    src: url('../fonts/Vazir.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Vazir.woff2') format('woff2'),
         url('../fonts/Vazir.woff') format('woff'),
         url('../fonts/Vazir.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Vazir';
    src: url('../fonts/Vazir-Bold.eot');
    src: url('../fonts/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Vazir-Bold.woff2') format('woff2'),
         url('../fonts/Vazir-Bold.woff') format('woff'),
         url('../fonts/Vazir-Bold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}

/* Base Styles */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-color);
    line-height: 1.6;
}

[dir="rtl"] body {
    font-family: 'Vazir', sans-serif;
}

/* Section Styling */
.curriculum-section {
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.curriculum-section:nth-child(even) {
    background-color: var(--bg-light);
}

/* Cosmic Header Styling - Matching your provided CSS */
.curriculum-header {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
    position: relative;
    overflow: hidden;
    color: var(--white);
    text-align: center;
    padding: 180px 0 140px;
    margin-top: 0;
}

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

.curriculum-header::after {
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

.curriculum-header__content {
    position: relative;
    z-index: 2;
}

.curriculum-header__title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 15px;
    color: white;
    animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
}

[dir="rtl"] .curriculum-header__title {
    font-family: 'Vazir', sans-serif !important;
}

.curriculum-header__subtitle {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    color: white;
    animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
}

[dir="rtl"] .curriculum-header__subtitle {
    font-family: 'Vazir', sans-serif;
}

/* Content Sections Styling */
.section-label {
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1.5px;
    color: var(--primary-color);
    margin-bottom: 15px;
    font-weight: 600;
}

.section-title {
    font-size: 32px;
    font-weight: 800;  /* Heavy weight for titles */
    color: #00000;  /* Black color as requested */
    margin-bottom: 25px;
    line-height: 1.3;
}

[dir="rtl"] .section-title {
    font-family: 'Vazir', sans-serif;
}

.section-description {
    color: var(--text-light);
    margin-bottom: 30px;
    font-size: 16px;
}

[dir="rtl"] .section-description {
    font-family: 'Vazir', sans-serif;
}

/* Features and Card Styling */
.feature-item {
    display: flex;
    margin-bottom: 25px;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(105, 65, 198, 0.1);  /* Light purple background */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
}

[dir="rtl"] .feature-icon {
    margin-right: 0;
    margin-left: 20px;
}

.feature-icon i {
    color: var(--primary-color);
    font-size: 22px;
}

.feature-title {
    color: rgb(15, 12, 95);
    font-weight: 700;
    margin-bottom: 8px;
    font-size: 20px;
    color: var(--secondary-color);  /* Black color for title */
}

[dir="rtl"] .feature-title {
    font-family: 'Vazir', sans-serif;
}

.feature-text {
    color: var(--text-light);
    font-size: 15px;
    margin-bottom: 0;
}

[dir="rtl"] .feature-text {
    font-family: 'Vazir', sans-serif;
}

.feature-box {
    background-color: var(--white);
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
    height: 100%;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid rgba(105, 65, 198, 0.1);
}

.feature-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(105, 65, 198, 0.15);
}

.feature-box h4 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
    color: var(--secondary-color);  /* Black color for title */
}

[dir="rtl"] .feature-box h4 {
    font-family: 'Vazir', sans-serif;
}

.feature-box p {
    font-size: 15px;
    color: var(--text-light);
    margin-bottom: 0;
}

[dir="rtl"] .feature-box p {
    font-family: 'Vazir', sans-serif;
}

/* Section Image Styling */
.section-image {
    width: 100%;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.section-image:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(105, 65, 198, 0.2);
}

.section-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.section-image:hover img {
    transform: scale(1.05);
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

/* Video Play Button */
.play-button-wrapper {
    position: relative;
    margin-bottom: 40px;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background-color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
}

.play-button::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: var(--primary-color);
    opacity: 0.3;
    animation: pulse 2s infinite;
    z-index: -1;
}

@keyframes pulse {
    0% {
        transform: scale(0.95);
        opacity: 0.7;
    }
    70% {
        transform: scale(1.2);
        opacity: 0;
    }
    100% {
        transform: scale(0.95);
        opacity: 0;
    }
}

.play-button i {
    color: var(--primary-color);
    font-size: 30px;
    margin-left: 5px;
}

.play-button:hover {
    transform: translate(-50%, -50%) scale(1.1);
    background-color: var(--primary-color);
}

.play-button:hover i {
    color: var(--white);
}

/* CTA Button */
.btn-read-more {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(105, 65, 198, 0.3);
    margin-top: 20px;
}

.btn-read-more i {
    margin-left: 8px;
}

[dir="rtl"] .btn-read-more i {
    margin-left: 0;
    margin-right: 8px;
}

[dir="rtl"] .btn-read-more {
    font-family: 'Vazir', sans-serif;
}

.btn-read-more:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(105, 65, 198, 0.4);
    color: white;
}

/* Special Needs Section Highlight */
.special-needs-badge {
    display: inline-block;
    background-color: rgba(105, 65, 198, 0.1);
    color: var(--primary-color);
    font-weight: 600;
    padding: 5px 15px;
    border-radius: 20px;
    margin-bottom: 20px;
    font-size: 14px;
}

[dir="rtl"] .special-needs-badge {
    font-family: 'Vazir', sans-serif;
}

/* Animation Keyframes */
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

@keyframes floatEffect {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .curriculum-section {
        padding: 70px 0;
    }
    
    .curriculum-header {
        padding: 150px 0 120px;
    }
    
    .curriculum-header__title {
        font-size: 36px;
    }
    
    .section-title {
        font-size: 28px;
    }
}

@media (max-width: 767px) {
    .curriculum-section {
        padding: 50px 0;
    }
    
    .curriculum-header {
        padding: 120px 0 100px;
    }
    
    .curriculum-header__title {
        font-size: 30px;
    }
    
    .section-title {
        font-size: 24px;
    }
    
    .section-image {
        margin-bottom: 30px;
    }
    
    .feature-icon {
        width: 40px;
        height: 40px;
    }
    
    .feature-icon i {
        font-size: 18px;
    }
    
    .play-button {
        width: 60px;
        height: 60px;
    }
    
    .play-button i {
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
        <section class="curriculum-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="curriculum-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="curriculum-header__title">
                        <?php echo $lang == 'fa' ? 'برنامه آموزشی مجتمع سلمان فارسی' : 'Salman Farsi Educational Curriculum'; ?>
                    </h1>
                    <p class="curriculum-header__subtitle">
                        <?php echo $lang == 'fa' ? 'برنامه آموزشی جامع و پیشرفته، با تمرکز بر پرورش استعدادها و آماده‌سازی دانش‌آموزان برای آینده‌ای درخشان' : 'Comprehensive and advanced curriculum focused on nurturing talents and preparing students for a bright future'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Ehsan Section -->
        <section class="curriculum-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="section-image wow fadeInUp" data-wow-delay="100ms">
                            <!-- Using the correct image path -->
                            <img src="assets/images/Curriculum/ehsan.jpg" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان بخش احسان' : 'Ehsan section students'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-content ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'بخش احسان' : 'EHSAN SECTION'; ?></p>
                            <div class="special-needs-badge">
                                <i class="fas fa-star me-1"></i>
                                <?php echo $lang == 'fa' ? 'برای دانش‌آموزان با نیازهای ویژه' : 'For Students with Special Needs'; ?>
                            </div>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'احسان؛ جایی که هر توانایی مسیر خود را پیدا می‌کند' : 'Ehsan – Where Every Ability Finds Its Path'; ?>
                            </h2>
                            <p class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                از سال 2008، احسان در مجتمع آموزشی سلمان فارسی محیطی گرم و پذیرا برای دانش‌آموزان با نیازهای ویژه فراهم کرده است. با بهره‌گیری از حمایت تخصصی و رویکردی دلسوزانه، ما هر دانش‌آموز را توانمند می‌سازیم تا استعدادهای خود را شکوفا کند و آینده‌ای روشن‌تر بسازد.
                                <?php else: ?>
                                Since 2008, Ehsan at the Salman Farsi Educational Complex has been a welcoming space for Students of Determination. Through expert support and a nurturing approach, we empower every student to unlock their potential and shape a brighter future.
                                <?php endif; ?>
                            </p>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title" style="color: rgb(15, 12, 95);"><?php echo $lang == 'fa' ? 'معلمان متخصص' : 'Expert Teachers'; ?></h4>
                                    <p class="feature-text">
                                        <?php echo $lang == 'fa' ? 'تیمی از کارشناسان آموزش و توانبخشی باکیفیت ارائه می‌دهند.' : 'A team of specialists providing high-quality education and rehabilitation.'; ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title" style="color: rgb(15, 12, 95);"><?php echo $lang == 'fa' ? 'حمایت جامع' : 'Comprehensive Support'; ?></h4>
                                    <p class="feature-text">
                                        <?php echo $lang == 'fa' ? 'تضمین فرصت‌های برابر برای موفقیت هر دانش‌آموز.' : 'Ensuring equal opportunities for every student to succeed.'; ?>
                                    </p>
                                </div>
                            </div>
                            
                            <a href="Ehsan SOD page.php<?php echo '?lang=' . $lang; ?>" class="btn btn-read-more">
                                <?php echo $lang == 'fa' ? 'بیشتر بخوانید' : 'Read More'; ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Elementary Section -->
        <section class="curriculum-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="row wow fadeInUp" data-wow-delay="200ms">
                            <div class="col-md-12 mb-4">
                                <div class="section-image">
                                    <!-- Using the correct image path -->
                                    <img src="assets/images/Curriculum/elementry-graduation.jpg" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان ابتدایی' : 'Elementary students'; ?>">
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="section-content pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'بخش ابتدایی' : 'ELEMENTARY SECTION'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'از پایه‌ای قوی تا موفقیتی درخشان' : 'From Foundational Excellence To Future Success'; ?>
                            </h2>
                            
                            <div class="ps-lg-0 mt-4">
                                <h3 style="font-size: 22px; margin-bottom: 20px; font-weight: 700; color: rgb(15, 12, 95);">
                                    <?php echo $lang == 'fa' ? 'راهنمایی تخصصی و امکانات پیشرفته' : 'Expert Guidance and Advanced Facilities'; ?>
                                </h3>
                                <p class="section-description">
                                    <?php if ($lang == 'fa'): ?>
                                    بخش آموزش ابتدایی (پایه‌های 1 تا 6) شامل دو کلاس در هر پایه است که بر آموزش قوی و برنامه‌های پیشرفته زبانی در عربی و انگلیسی، تدریس‌شده توسط کارشناسان بومی زبان تمرکز دارد. با معلمان باتجربه، روش‌های نوآورانه و کلاس‌های هوشمند، ما تجربه یادگیری جذاب و شخصی‌سازی‌شده‌ای را تضمین می‌کنیم.
                                    <?php else: ?>
                                    The primary education section (Grades 1 to 6) offers two classes per grade, focusing on strong academics and advanced language programs in Arabic and English taught by native-speaking experts. With experienced teachers, innovative methods, and smart classrooms, we ensure an engaging and personalized learning experience.
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Middle School Section -->
        <section class="curriculum-section">
            <div class="container">
            <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="section-image wow fadeInUp" data-wow-delay="100ms">
                            <!-- Using the correct image path -->
                            <img src="assets/images/Curriculum/rahnmaii.jpg" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان راهنمایی' : 'Middle school students'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-content ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'راهنمایی' : 'MIDDLE SCHOOL'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'مدرسان بااستعداد، امکانات مدرن و روش‌های پیشرفته' : 'Talented Educators, Modern Facilities, And Advanced Methods'; ?>
                            </h2>
                            <p class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                دبیرستان (پایه‌های هفتم تا نهم) در مدرسه سلمان فارسی محیطی مدرن با کلاس‌های هوشمند و معلمان متخصص فراهم می‌آورد. هر پایه دو کلاس دارد که با روش‌های تدریس پیشرفته پشتیبانی می‌شود.
                                <?php else: ?>
                                Middle school (grades 7 to 9) at Salman Farsi School offers a modern learning environment with smart classrooms and expert teachers. Each grade has two classes, supported by advanced teaching methods.
                                <?php endif; ?>
                            </p>
                            <p class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                مدرسه برنامه‌های فوق‌برنامه، آزمایشگاه‌های علمی، امکانات ورزشی و رفاهی ارائه می‌دهد تا دانش‌آموزان هم از نظر علمی و هم شخصی رشد کنند و برای چالش‌های آینده آماده شوند.
                                <?php else: ?>
                                The school provides extracurricular programs, science labs, sports facilities, and amenities, ensuring students grow academically and personally while preparing for future challenges.
                                <?php endif; ?>
                            </p>
                            
                            <div class="key-focus">
                                <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lang == 'fa' ? 'تمرکز اصلی: پایداری و برتری' : 'Key Focus: Consistency and Excellence'; ?></h4>
                                <p>
                                    <?php echo $lang == 'fa' ? 'ما بر پایداری و پیشرفت به موقع برای موفقیت دانش‌آموزان تمرکز داریم.' : 'We focus on consistency and timely progress for student success.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- High School Section -->
        <section class="curriculum-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
                        <div class="section-image h-100 wow fadeInUp" data-wow-delay="200ms">
                            <!-- Using the correct image path -->
                            <img src="assets/images/Curriculum/highschool.JPG" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان دبیرستان' : 'High school students'; ?>" style="height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-7 order-lg-1">
                        <div class="section-content pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo $lang == 'fa' ? 'دبیرستان' : 'HIGH SCHOOL'; ?></p>
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'معلمان باتجربه، امکانات تخصصی و برنامه‌های پیشرفته' : 'Experienced Educators, Specialized Facilities, And Cutting-Edge Programs'; ?>
                            </h2>
                            <p class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                دبیرستان (پایه‌های 10 تا 12) در مدرسه سلمان فارسی توسط تیمی از معلمان باتجربه و استادان دانشگاه در رشته‌های علوم، علوم انسانی، ریاضیات، فیزیک و توسعه وب اداره می‌شود.
                                <?php else: ?>
                                High school (grades 10 to 12) at Salman Farsi School is guided by a team of experienced educators, many of whom are university professors specializing in science, humanities, mathematics, physics, and web development.
                                <?php endif; ?>
                            </p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="feature-box wow fadeInUp" data-wow-delay="200ms">
                                        <h4 style="color: rgb(15, 12, 95);">
                                        <?php echo $lang == 'fa' ? 'آموزش پیشرفته علوم' : 'Advanced Science Instruction'; ?></h4>
                                        <p>
                                            <?php echo $lang == 'fa' ? 'استادان با تخصص در ریاضیات، زیست‌شناسی، شیمی و فیزیک، راهنمایی‌های عمیق و کارآمدی برای موفقیت تحصیلی ارائه می‌دهند.' : 'Professors provide expert guidance in biology, chemistry, and physics for academic success.'; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="feature-box wow fadeInUp" data-wow-delay="300ms">
                                        <h4 style="color: rgb(15, 12, 95);">
                                            <?php echo $lang == 'fa' ? 'آزمایشگاه‌های پیشرفته علوم' : 'State-of-the-Art Science Labs'; ?></h4>
                                        <p>
                                            <?php echo $lang == 'fa' ? 'آزمایشگاه‌های کاملاً مجهز فرصتی برای انجام آزمایش‌های علمی در رشته‌های مختلف فراهم می‌آورند.' : 'Fully equipped labs enable practical experiments in core sciences.'; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="feature-box wow fadeInUp" data-wow-delay="400ms">
                                        <h4 style="color: rgb(15, 12, 95);">
                                        <?php echo $lang == 'fa' ? 'برتری در توسعه وب' : 'Web Development Excellence'; ?></h4>
                                        <p>
                                            <?php echo $lang == 'fa' ? 'دانش‌آموزان از طریق کارگاه‌های مدرن کامپیوتری، تجربه عملی در زمینه توسعه وب کسب می‌کنند.' : 'Students gain hands-on experience in modern computer labs tailored for web development.'; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="feature-box wow fadeInUp" data-wow-delay="500ms">
                                        <h4 style="color: rgb(15, 12, 95);">
                                        <?php echo $lang == 'fa' ? 'برنامه‌های فوق‌برنامه تخصصی' : 'Tailored Extracurricular Programs'; ?></h4>
                                        <p>
                                            <?php echo $lang == 'fa' ? 'برنامه‌های متنوع فوق‌برنامه، دانش‌آموزان را در زمینه‌های علوم انسانی، ریاضی و فناوری تقویت می‌کند.' : 'Diverse activities support students in humanities, mathematics, and technology.'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel"><?php echo $lang == 'fa' ? 'تور مدرسه' : 'School Tour'; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoFrame" src="" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    
    <!-- Custom JS for Curriculum Page -->
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
        
        // Video modal functionality
        $(document).ready(function() {
            generateStars();
            
            // Video URLs mapping
            const videoURLs = {
                'elementary-tour': 'https://www.youtube.com/embed/your-elementary-video-id'
            };
            
            // Play button click handler
            $('.play-button').on('click', function() {
                const videoId = $(this).data('video-id');
                const videoURL = videoURLs[videoId] || '';
                
                $('#videoFrame').attr('src', videoURL);
                $('#videoModal').modal('show');
            });
            
            // Stop video when modal is closed
            $('#videoModal').on('hidden.bs.modal', function () {
                $('#videoFrame').attr('src', '');
            });
        });
    </script>
</body>
</html>