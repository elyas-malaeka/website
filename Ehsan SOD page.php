<?php
/**
 * Ehsan Students of Determination (SOD) Page
 * 
 * Displays detailed information about the Ehsan department of Salman Farsi Educational Complex,
 * which provides specialized education and rehabilitation services for students with special needs.
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
    <title><?php echo $lang == 'fa' ? 'بخش احسان - دانش‌آموزان با نیازهای ویژه' : 'Ehsan Department - Students of Determination'; ?> | <?php echo SITE_NAME_EN; ?></title>

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
        /* Custom styles for Ehsan SOD page */
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
        
        /* Ehsan Header */
        .ehsan-header {
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
        
        .ehsan-header::after {
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
        
        .ehsan-header__content {
            position: relative;
            z-index: 2;
        }
        
        .ehsan-header__title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
        }
        
        [dir="rtl"] .ehsan-header__title {
            font-family: 'Vazir', sans-serif !important;
        }
        
        .ehsan-header__subtitle {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
            color: white;
            animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
        }
        
        [dir="rtl"] .ehsan-header__subtitle {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Content Styling */
        .ehsan-section {
            padding: 100px 0;
            position: relative;
        }
        
        .ehsan-section:nth-child(even) {
            background-color: var(--bg-light);
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
            color: var(--text-color);
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        
        [dir="rtl"] .section-description {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Feature Box */
        .objective-box {
            padding: 25px;
            border-radius: var(--border-radius);
            background-color: var(--white);
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-color);
            transition: var(--transition);
            
        }
        
        [dir="rtl"] .objective-box {
            border-left: none;
            border-right: 4px solid var(--primary-color);
        }
        
        .objective-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(105, 65, 198, 0.15);
        }
        
        .objective-box h4 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        [dir="rtl"] .objective-box h4 {
            font-family: 'Vazir', sans-serif;
        }
        
        .objective-box p {
            color: var(--text-light);
            margin-bottom: 0;
            font-size: 15px;
        }
        
        [dir="rtl"] .objective-box p {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Service Cards */
        .service-card {
            position: relative;
            background-color: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: var(--transition);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(105, 65, 198, 0.2);
        }
        
        .service-card__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background-color: rgba(105, 65, 198, 0.1);
            border-radius: 50%;
            color: var(--primary-color);
            font-size: 28px;
        }
        
        .service-card__content {
            padding: 30px;
        }
        
        .service-card__title {
            color:rgb(15, 12, 95);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        [dir="rtl"] .service-card__title {
            font-family: 'Vazir', sans-serif;
        }
        
        .service-card__text {
            color: var(--text-light);
            font-size: 15px;
            margin-bottom: 0;
            line-height: 1.8;
        }
        
        [dir="rtl"] .service-card__text {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Image Styling */
        .ehsan-image {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            position: relative;
        }
        
        .ehsan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .ehsan-image:hover img {
            transform: scale(1.05);
        }
        
        /* List Styling */
        .check-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
        }
        
        [dir="rtl"] .check-list {
            padding-right: 0;
        }
        
        .check-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
            color: var(--text-color);
            font-size: 16px;
        }
        
        [dir="rtl"] .check-list li {
            padding-left: 0;
            padding-right: 30px;
            font-family: 'Vazir', sans-serif;
        }
        
        .check-list li:before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: var(--primary-color);
            position: absolute;
            left: 0;
            top: 2px;
        }
        
        [dir="rtl"] .check-list li:before {
            left: auto;
            right: 0;
        }
        
        /* Call to Action */
        .cta-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            padding: 50px;
            border-radius: var(--border-radius);
            color: var(--white);
            text-align: center;
            margin-top: 50px;
        }
        
        .cta-box h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--white);
        }
        
        [dir="rtl"] .cta-box h3 {
            font-family: 'Vazir', sans-serif;
        }
        
        .cta-box p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        [dir="rtl"] .cta-box p {
            font-family: 'Vazir', sans-serif;
        }
        
        .btn-cta {
            background-color: var(--white);
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
            text-decoration: none;
        }
        
        [dir="rtl"] .btn-cta {
            font-family: 'Vazir', sans-serif;
        }
        
        .btn-cta i {
            margin-left: 8px;
        }
        
        [dir="rtl"] .btn-cta i {
            margin-left: 0;
            margin-right: 8px;
        }
        
        .btn-cta:hover {
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            transform: translateY(-3px);
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
            .ehsan-section {
                padding: 70px 0;
            }
            
            .ehsan-header {
                padding: 150px 0 120px;
            }
            
            .ehsan-header__title {
                font-size: 36px;
            }
            
            .section-title {
                font-size: 28px;
            }
            
            .cta-box {
                padding: 40px 30px;
            }
        }
        
        @media (max-width: 767px) {
            .ehsan-section {
                padding: 50px 0;
            }
            
            .ehsan-header {
                padding: 120px 0 100px;
            }
            
            .ehsan-header__title {
                font-size: 30px;
            }
            
            .section-title {
                font-size: 24px;
            }
            
            .service-card__content {
                padding: 20px;
            }
            
            .objective-box {
                padding: 20px;
            }
            
            .cta-box {
                padding: 30px 20px;
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
        <section class="ehsan-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="ehsan-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="ehsan-header__title">
                        <?php echo $lang == 'fa' ? 'بخش احسان - دانش‌آموزان با نیازهای ویژه' : 'Ehsan Department - Students of Determination'; ?>
                    </h1>
                    <p class="ehsan-header__subtitle">
                        <?php echo $lang == 'fa' ? 'حمایت، توانمندسازی و پرورش استعدادهای ویژه' : 'Supporting, Empowering, and Nurturing Special Talents'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Introduction Section -->
        <section class="ehsan-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="ehsan-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="assets/images/ehsan/ehsan-students.jpg" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان بخش احسان' : 'Ehsan department students'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-4 wow fadeInRight" data-wow-delay="200ms">
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'معرفی بخش احسان' : 'Introduction to Ehsan'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>مجتمع آموزشی سلمان فارسی با تعهدی راسخ، برای حمایت از دانش‌آموزان با نیازهای ویژه (Students of Determination) در مسیر رشد و پیشرفتشان فعالیت می‌کند. این مجموعه در سال 1995 فعالیت خود را آغاز کرد و طی سال‌ها پذیرای صدها دانش‌آموز بوده است. در سال 2008، اولین بخش تخصصی خود با نام «احسان» را به‌منظور ارائه خدمات آموزشی و توان‌بخشی به این دانش‌آموزان افتتاح کرد.</p>
                                
                                <p>هدف اصلی بخش احسان، شناسایی ظرفیت‌ها و توانمندی‌های همه دانش‌آموزان و فراهم‌کردن فرصت‌هایی برای رشد، یادگیری و مشارکت آن‌ها در فعالیت‌های متنوع آموزشی و غنی‌سازی است. ما به برابری و ایجاد فرصت‌های برابر برای همه اعتقاد داریم و تلاش می‌کنیم زمینه‌ای را فراهم آوریم تا دانش‌آموزان بتوانند آینده‌ای روشن برای خود بسازند.</p>
                                <?php else: ?>
                                <p>The Salman Farsi Educational Complex is committed to supporting Students of Determination (SOD) in their journey toward growth and development. Established in 1995, the complex has welcomed hundreds of students over the years. In 2008, it launched its first specialized department, named <em>Ehsan</em>, to provide educational and rehabilitation services to students with special needs.</p>
                                
                                <p>The primary goal of Ehsan is to recognize the potential and capabilities of all students while creating opportunities for their enrichment and learning. We believe in equality and equal opportunities for everyone, striving to provide a supportive environment where students can shape a brighter future for themselves.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Objectives Section -->
        <section class="ehsan-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                        <h2 class="section-title">
                            <?php echo $lang == 'fa' ? 'اهداف بخش احسان' : 'Objectives of Ehsan'; ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 mb-4 wow fadeInUp" data-wow-delay="200ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lang == 'fa' ? 'ارائه تجارب آموزشی برای رشد توانایی‌ها' : 'Provide Learning Experiences for Full Potential'; ?>
                            </h4>
                            <p>
                                <?php echo $lang == 'fa' ? 'ارائه تجارب آموزشی که دانش‌آموزان را قادر سازد به تمام توانایی‌های خود دست یابند.' : 'To offer learning experiences that enable students to achieve their full potential.'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4 wow fadeInUp" data-wow-delay="300ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lang == 'fa' ? 'ایجاد محیط مثبت برای تقویت اعتماد‌به‌نفس' : 'Create a Positive Environment for Confidence'; ?>
                            </h4>
                            <p>
                                <?php echo $lang == 'fa' ? 'ایجاد محیطی مثبت که در آن دانش‌آموزان اعتمادبه‌نفس و عزت‌نفس خود را تقویت کنند.' : 'To create a positive environment where students can build self-confidence and self-respect.'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4 wow fadeInUp" data-wow-delay="400ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lang == 'fa' ? 'ارزش‌گذاری به نیازها و دیدگاه‌ها' : 'Value Needs and Perspectives'; ?>
                            </h4>
                            <p>
                                <?php echo $lang == 'fa' ? 'ارزش‌گذاری به نیازها و دیدگاه‌های دانش‌آموزان با نیازهای ویژه و پاسخ‌گویی به خواسته‌های آن‌ها.' : 'To value the needs and perspectives of Students of Determination and address their aspirations.'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4 wow fadeInUp" data-wow-delay="500ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lang == 'fa' ? 'فراهم‌کردن بستر ورود به جامعه' : 'Prepare for Social Integration'; ?>
                            </h4>
                            <p>
                                <?php echo $lang == 'fa' ? 'فراهم‌کردن بستری برای ورود دانش‌آموزان دارای نیازهای ویژه به جامعه با ارزش‌های اخلاقی و مهارت‌های شغلی مناسب.' : 'To ensure that students with special needs can integrate into society with appropriate ethical values and vocational skills.'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mb-4 wow fadeInUp" data-wow-delay="600ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lang == 'fa' ? 'تربیت دانش‌آموزان موفق در همه زمینه‌ها' : 'Develop Well-Rounded Students'; ?>
                            </h4>
                            <p>
                            <?php echo $lang == 'fa' ? 'تربیت دانش‌آموزانی که نه‌تنها در حوزه‌های علمی بلکه در ارزش‌های اخلاقی، اجتماعی و شهروندی موفق باشند.' : 'To develop students—not just those with special needs but all students—into responsible citizens equipped with proper social etiquette, ethics, and values to contribute to their future.'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Speech Therapy Services Section -->
        <section class="ehsan-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="ehsan-image wow fadeInUp" data-wow-delay="300ms">
                                    <img src="assets/images/ehsan/speech-therapy.jpg" alt="<?php echo $lang == 'fa' ? 'خدمات گفتاردرمانی' : 'Speech therapy services'; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="ehsan-image wow fadeInUp" data-wow-delay="400ms">
                                    <img src="assets/images/ehsan/classroom.jpg" alt="<?php echo $lang == 'fa' ? 'کلاس‌های بخش احسان' : 'Ehsan department classroom'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-4 wow fadeInLeft" data-wow-delay="200ms">
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'گفتاردرمانی ؛ یکی از خدمات توان‌بخشی بخش احسان' : 'Speech Therapy -- A Key Rehabilitation Service'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>واحد گفتاردرمانی بخش احسان به ارزیابی و درمان اختلالات گفتار و زبان دانش‌آموزان می‌پردازد. این خدمات نقش کلیدی در بهبود توانایی‌های ارتباطی دانش‌آموزان دارد، زیرا گفتار و زبان از مهم‌ترین ابزارهای برقراری ارتباط هستند.</p>
                                <?php else: ?>
                                <p>The speech therapy unit within Ehsan focuses on assessing and treating speech and language disorders in students. This service plays a crucial role in enhancing students' communication skills, as speech and language are vital tools for interaction.</p>
                                <?php endif; ?>
                            </div>

                            <h3 class="mt-5 mb-4" style="font-size: 22px; font-weight: 700; color:) rgb(15, 12, 95;);">
                                <?php echo $lang == 'fa' ? 'حیطه‌های خدمات گفتاردرمانی' : 'Areas of Speech Therapy Services'; ?>
                            </h3>
                            
                            <ul class="check-list">
                                <li>
                                    <strong><?php echo $lang == 'fa' ? 'تأخیر در رشد گفتار و زبان' : 'Delayed Speech and Language Development'; ?>:</strong> 
                                    <?php echo $lang == 'fa' ? 'شامل کودکانی که محیط مناسبی برای رشد گفتار و زبان نداشته یا دچار ناتوانی ذهنی هستند.' : 'For children who lack an environment conducive to speech and language development or have intellectual disabilities.'; ?>
                                </li>
                                <li>
                                    <strong><?php echo $lang == 'fa' ? 'مشکلات یادگیری' : 'Learning Disorders'; ?>:</strong> 
                                    <?php echo $lang == 'fa' ? 'شامل اختلالات در خواندن و نوشتن.' : 'Including challenges related to reading and writing.'; ?>
                                </li>
                                <li>
                                    <strong><?php echo $lang == 'fa' ? 'اختلال تولید' : 'Articulation Disorders'; ?>:</strong> 
                                    <?php echo $lang == 'fa' ? 'ناشی از عدم هماهنگی عضلات زبان، کم‌شنوایی یا ضعف حسی دهان.' : 'Arising from coordination issues in tongue muscles, hearing impairments, or sensory weaknesses in the oral region.'; ?>
                                </li>
                                <li>
                                    <strong><?php echo $lang == 'fa' ? 'لکنت' : 'Stuttering'; ?>:</strong> 
                                    <?php echo $lang == 'fa' ? 'گفتاری که همراه با تکرار، کشش، مکث یا گیر است و گاهی ناشی از فقر واژگان یا اختلالات عصبی است.' : 'Speech characterized by repetition, prolongation, pauses, or blocks, sometimes caused by vocabulary deficiencies or neurological disorders.'; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Services Provided Section -->
        <section class="ehsan-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                        <h2 class="section-title">
                            <?php echo $lang == 'fa' ? 'خدمات ارائه‌شده در واحد گفتاردرمانی' : 'Services Provided by the Speech Therapy Unit'; ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="200ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $lang == 'fa' ? 'ارزیابی اولیه و تعیین سطح' : 'Initial Evaluation'; ?>
                                </h3>
                                <p class="service-card__text">
                                    <?php echo $lang == 'fa' ? 'ارزیابی اولیه و تعیین سطح اختلال گفتار و زبان.' : 'Initial evaluation and determination of the severity of speech and language disorders.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="300ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $lang == 'fa' ? 'برنامه‌ریزی و اجرای دقیق درمان' : 'Treatment Planning'; ?>
                                </h3>
                                <p class="service-card__text">
                                    <?php echo $lang == 'fa' ? 'برنامه‌ریزی و اجرای دقیق درمان.' : 'Planning and precise implementation of treatment programs.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="400ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $lang == 'fa' ? 'مشاوره و راهنمایی خانواده‌ها' : 'Family Counseling'; ?>
                                </h3>
                                <p class="service-card__text">
                                    <?php echo $lang == 'fa' ? 'مشاوره و راهنمایی خانواده‌ها.' : 'Counseling and guiding families.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 mb-4 wow fadeInUp" data-wow-delay="500ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $lang == 'fa' ? 'تقویت سیستم حسی-عصبی' : 'Sensory-Motor Enhancement'; ?>
                                </h3>
                                <p class="service-card__text">
                                    <?php echo $lang == 'fa' ? 'تقویت سیستم حسی-عصبی و مهارت‌های پایه گفتاری مانند جویدن و بلع.' : 'Enhancing sensory-motor systems and foundational speech skills, including chewing and swallowing.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 mb-4 wow fadeInUp" data-wow-delay="600ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $lang == 'fa' ? 'ارتقای مهارت‌های ارتباطی' : 'Communication Skills Improvement'; ?>
                                </h3>
                                <p class="service-card__text">
                                <?php echo $lang == 'fa' ? "ارتقای مهارت‌های ارتباطی دانش‌آموز با استفاده از روش‌های رفتاری، شناختی و زبانی." : "Improving students' communication skills using behavioral, cognitive, and linguistic approaches."; ?>
                                 </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Conclusion Section -->
        <section class="ehsan-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                        <div class="ehsan-image">
                            <img src="assets/images/ehsan/ehsan-group.jpg" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان و معلمان بخش احسان' : 'Ehsan department students and teachers'; ?>">
                        </div>
                        
                        <div class="text-center mt-5">
                            <h2 class="section-title">
                                <?php echo $lang == 'fa' ? 'مسیر موفقیت و توانمندی' : 'A Path to Success and Empowerment'; ?>
                            </h2>
                            <div class="section-description">
                                <?php if ($lang == 'fa'): ?>
                                <p>بخش احسان، با ترکیبی از تعهد و تخصص، به دانش‌آموزان با نیازهای ویژه کمک می‌کند تا مسیر موفقیت و توانمندی را با اطمینان طی کنند. ما با رویکردی مبتنی بر احترام و توجه به تفاوت‌های فردی، شرایطی را فراهم می‌آوریم که هر دانش‌آموز بتواند استعدادهای خود را به بهترین شکل شکوفا سازد.</p>
                                <?php else: ?>
                                <p>With a combination of dedication and expertise, the Ehsan department supports students with special needs, helping them confidently navigate their path to success and empowerment. Through an approach based on respect and attention to individual differences, we create conditions where each student can develop their talents in the best possible way.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="cta-box wow fadeInUp" data-wow-delay="300ms">
                            <h3>
                                <?php echo $lang == 'fa' ? 'برای اطلاعات بیشتر با ما تماس بگیرید' : 'Contact Us for More Information'; ?>
                            </h3>
                            <p>
                                <?php echo $lang == 'fa' ? 'خانواده‌های محترم، برای کسب اطلاعات بیشتر درباره خدمات بخش احسان و شرایط ثبت‌نام، با ما در تماس باشید.' : 'Respected families, for more information about Ehsan department services and registration conditions, please contact us.'; ?>
                            </p>
                            <a href="contact.php<?php echo '?lang=' . $lang; ?>" class="btn-cta">
                                <?php echo $lang == 'fa' ? 'تماس با ما' : 'Contact Us'; ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            </a>
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
    
    <!-- Custom JS for Ehsan SOD Page -->
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