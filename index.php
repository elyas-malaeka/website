<?php
/**
 * Salman Farsi Educational Complex - Premium Creative Homepage
 * 
 * A highly creative, visually stunning bilingual (Persian/English) homepage 
 * with advanced animations, space-themed design elements.
 * 
 * @package Salman Educational Complex
 * @version 7.0
 */

// Load configuration
require_once 'includes/config.php';

// Get current language
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');

// Database connection
$db = connectDB();

// Initialize arrays with fallback data in case of database errors
$latest_posts = [];
$reviews = [];
$faqs = [];

// Try to fetch data from database
try {
    // Get latest featured articles
    $latest_posts_query = "SELECT p.*, c.category_name, c.category_name_en 
                         FROM post p
                         LEFT JOIN categories c ON p.category_id = c.category_id
                         ORDER BY p.publish_date DESC LIMIT 4";
    $latest_posts_result = $db->query($latest_posts_query);
    
    if ($latest_posts_result && $latest_posts_result->num_rows > 0) {
        while ($row = $latest_posts_result->fetch_assoc()) {
            $latest_posts[] = $row;
        }
    }
    
    // Get testimonials/reviews
    $reviews_query = "SELECT * FROM reviews ORDER BY id DESC LIMIT 6";
    $reviews_result = $db->query($reviews_query);
    
    if ($reviews_result && $reviews_result->num_rows > 0) {
        while ($row = $reviews_result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }
    
    // Get FAQs
    $faqs_query = "SELECT * FROM faqs WHERE active = 1 ORDER BY id ASC LIMIT 6";
    $faqs_result = $db->query($faqs_query);
    
    if ($faqs_result && $faqs_result->num_rows > 0) {
        while ($row = $faqs_result->fetch_assoc()) {
            $faqs[] = $row;
        }
    }
} catch (Exception $e) {
    // Silent fail - we'll use fallback data
}

// Close database connection
try {
    closeDB($db);
} catch (Exception $e) {
    // Ignore closing errors
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isRtl ? 'مجتمع آموزشی سلمان فارسی | صفحه اصلی' : 'Salman Farsi Educational Complex | Home'; ?></title>
    <meta name="description" content="<?php echo $isRtl ? 'مجتمع آموزشی سلمان فارسی: اولین مدرسه ایرانی در دبی، ارائه دهنده آموزش فارسی و امکانات پیشرفته برای رشد دانش‌آموزان.' : 'Salman Farsi Educational Complex: The first Iranian school in Dubai, offering Persian education and advanced facilities for students\' growth.'; ?>">
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/salman.css">

    <!-- Custom Creative Styles -->
    <style>
        /**
         * Space-Themed Creative Styling for Salman Farsi Educational Complex
         * A celestial-inspired design system with premium visual elements
         */
         
        /****************************
         * VARIABLES
         ****************************/
        :root {
            /* Primary Color Scheme - Celestial Theme */
            --sky-blue: #6C9EFF;
            --light-blue: #87CEFA;
            --purple: #9471FF;
            --deep-purple: #6C63FF;
            --light-purple: #A89BFF;
            --pink: #FF6B8B;
            --teal: #36F1CD;
            --yellow: #FFDE59;
            --orange: #FF8A65;
            
            /* Backgrounds */
            --light-sky: #E8F5FF;
            --light-star: #F8F9FE;
            --light-purple-bg: #F5F3FF;
            --medium-purple-bg: #E0E0FF;
            
            /* Gradients */
            --sky-gradient: linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%);
            --purple-gradient: linear-gradient(135deg, #9471FF 0%, #6C63FF 100%);
            --soft-gradient: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
            --sunset-gradient: linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%);
            
            /* Typography */
            --body-font: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
            --heading-font: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
            --base-font-size: 16px;
            --base-line-height: 1.7;
            --heading-weight: 700;
            
            /* Spacing */
            --section-spacing: 100px;
            --section-spacing-sm: 70px;
            --content-spacing: 50px;
            --element-spacing: 30px;
            --gap-spacing: 20px;
            
            /* Borders */
            --border-radius-xs: 6px;
            --border-radius-sm: 10px;
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --border-radius-xl: 32px;
            --border-radius-pill: 100px;
            --border-radius-circle: 50%;
            
            /* Shadows */
            --shadow-sm: 0 4px 10px rgba(0, 0, 0, 0.05);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
            --glow-shadow: 0 0 20px rgba(108, 99, 255, 0.4);
            --purple-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
            --blue-shadow: 0 5px 15px rgba(108, 158, 255, 0.3);
            
            /* Transitions */
            --transition-fast: 0.3s ease;
            --transition-medium: 0.5s ease;
            --transition-slow: 0.8s ease;
        }

        /****************************
         * BASE STYLES
         ****************************/
        html {
            font-size: var(--base-font-size);
            scroll-behavior: smooth;
        }
        
        body {
            font-family: var(--body-font);
            font-size: 1rem;
            line-height: var(--base-line-height);
            color: #555;
            background-color: #fff;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Background stars effect */
        body:before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background-image: 
                radial-gradient(1px 1px at 20% 30%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(1px 1px at 40% 70%, rgba(150, 150, 255, 0.8) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(2px 2px at 90% 15%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(2px 2px at 15% 85%, rgba(150, An150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            z-index: -2;
            opacity: 0.2;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
            font-weight: var(--heading-weight);
            line-height: 1.3;
            color: #333;
            margin-bottom: 1rem;
        }
        
        p {
            margin-bottom: 1.5rem;
        }
        
        a {
            color: var(--deep-purple);
            text-decoration: none;
            transition: color var(--transition-fast);
        }
        
        a:hover {
            color: var(--purple);
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        section {
            position: relative;
            padding: var(--section-spacing) 0;
            overflow: hidden;
        }
        
        @media (max-width: 991px) {
            section {
                padding: var(--section-spacing-sm) 0;
            }
        }

        /****************************
         * UTILITY CLASSES
         ****************************/
        .bg-sky {
            background-color: var(--light-sky) !important;
        }
        
        .bg-soft-purple {
            background-color: var(--light-purple-bg) !important;
        }
        
        .bg-medium-purple {
            background-color: var(--medium-purple-bg) !important;
        }
        
        .bg-white {
            background-color: #fff !important;
        }
        
        .bg-gradient-sky {
            background: var(--sky-gradient) !important;
            color: #fff;
        }
        
        .bg-gradient-purple {
            background: var(--purple-gradient) !important;
            color: #fff;
        }
        
        .bg-gradient-sunset {
            background: var(--sunset-gradient) !important;
            color: #fff;
        }
        
        .text-gradient {
            background: var(--purple-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: var(--deep-purple);
            display: inline-block;
        }
        
        .text-sky {
            color: var(--sky-blue) !important;
        }
        
        .text-purple {
            color: var(--deep-purple) !important;
        }
        
        .text-pink {
            color: var(--pink) !important;
        }
        
        .text-white {
            color: #fff !important;
        }
        
        .rounded-sm {
            border-radius: var(--border-radius-sm) !important;
        }
        
        .rounded {
            border-radius: var(--border-radius) !important;
        }
        
        .rounded-lg {
            border-radius: var(--border-radius-lg) !important;
        }
        
        .rounded-pill {
            border-radius: var(--border-radius-pill) !important;
        }
        
        .shadow-effect {
            box-shadow: var(--shadow) !important;
        }
        
        .shadow-effect-lg {
            box-shadow: var(--shadow-lg) !important;
        }
        
        .shadow-purple {
            box-shadow: var(--purple-shadow) !important;
        }
        
        .shadow-blue {
            box-shadow: var(--blue-shadow) !important;
        }
        
        .has-shape {
            position: relative;
            z-index: 1;
        }

        /****************************
         * ANIMATIONS
         ****************************/
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        
        @keyframes meteor {
            0% {
                transform: translateX(300%) translateY(-300%) rotate(45deg);
                opacity: 1;
            }
            70% {
                opacity: 1;
            }
            100% {
                transform: translateX(-300%) translateY(300%) rotate(45deg);
                opacity: 0;
            }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulsing {
            animation: pulse 2s ease-in-out infinite;
        }
        
        .spinning {
            animation: spin 15s linear infinite;
        }

        /****************************
         * SHAPES
         ****************************/
        .shape {
            position: absolute;
            pointer-events: none;
            z-index: 0;
        }
        
        .shape-circle {
            width: 200px;
            height: 200px;
            border-radius: var(--border-radius-circle);
            background: var(--soft-gradient);
            opacity: 0.5;
        }
        
        .shape-blob {
            width: 300px;
            height: 300px;
            background: var(--light-purple-bg);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            opacity: 0.3;
            animation: float 15s ease-in-out infinite;
        }
        
        .shape-meteor {
            position: absolute;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, var(--deep-purple), transparent);
            opacity: 0.8;
            top: 20%;
            left: 10%;
            z-index: 0;
            animation: meteor 5s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        .shape-meteor:before {
            content: '';
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--deep-purple);
            box-shadow: 0 0 10px var(--deep-purple);
            left: 0;
            top: -1px;
        }
        
        .shape-meteor-2 {
            width: 150px;
            top: 40%;
            left: 70%;
            animation-delay: 3.5s;
        }

        /****************************
         * BUTTONS
         ****************************/
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            border-radius: var(--border-radius-pill);
            transition: all var(--transition-fast);
            border: none;
            cursor: pointer;
        }
        
        .btn i, .btn svg {
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 10px;
            font-size: 1.125rem;
            transition: transform var(--transition-fast);
        }
        
        .btn:hover i, .btn:hover svg {
            transform: translateX(<?php echo $isRtl ? '-5px' : '5px'; ?>);
        }
        
        .btn-primary {
            background: var(--purple-gradient);
            color: #fff;
            box-shadow: var(--purple-shadow);
        }
        
        .btn-primary:hover {
            color: #fff;
            box-shadow: 0 10px 20px rgba(108, 99, 255, 0.4);
            transform: translateY(-3px);
        }
        
        .btn-secondary {
            background: var(--sky-gradient);
            color: #fff;
            box-shadow: var(--blue-shadow);
        }
        
        .btn-secondary:hover {
            color: #fff;
            box-shadow: 0 10px 20px rgba(108, 158, 255, 0.4);
            transform: translateY(-3px);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--deep-purple);
            color: var(--deep-purple);
        }
        
        .btn-outline:hover {
            background-color: var(--deep-purple);
            color: #fff;
            transform: translateY(-3px);
        }
        
        .btn-light {
            background-color: #fff;
            color: var(--deep-purple);
            box-shadow: var(--shadow);
        }
        
        .btn-light:hover {
            background-color: #f8f9ff;
            box-shadow: var(--shadow-lg);
            transform: translateY(-3px);
        }
        
        .btn-lg {
            padding: 15px 35px;
            font-size: 1.125rem;
        }
        
        .btn-sm {
            padding: 8px 20px;
            font-size: 0.875rem;
        }

        /****************************
         * SECTION STYLES
         ****************************/
        .section-subtitle {
            display: inline-block;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--deep-purple);
            margin-bottom: 1rem;
            padding: 8px 20px;
            background-color: var(--light-purple-bg);
            border-radius: var(--border-radius-pill);
        }
        
        .section-heading {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .section-heading span {
            position: relative;
            z-index: 1;
        }
        
        .section-heading span.text-underline:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 5px;
            width: 100%;
            height: 12px;
            background-color: rgba(255, 222, 89, 0.4);
            z-index: -1;
            transform: skewX(-5deg);
        }
        
        .section-description {
            font-size: 1.125rem;
            max-width: 800px;
            margin-bottom: 2.5rem;
        }
        
        .text-center .section-description {
            margin-left: auto;
            margin-right: auto;
        }
        
        .section-divider {
            height: 4px;
            width: 60px;
            background: var(--purple-gradient);
            margin: 1.5rem 0;
            border-radius: var(--border-radius-pill);
        }
        
        .text-center .section-divider {
            margin-left: auto;
            margin-right: auto;
        }
        
        @media (max-width: 991px) {
            .section-heading {
                font-size: 2.25rem;
            }
            
            .section-description {
                font-size: 1.0625rem;
            }
        }
        
        @media (max-width: 767px) {
            .section-heading {
                font-size: 2rem;
            }
            
            .section-subtitle {
                font-size: 0.75rem;
            }
            
            .section-description {
                font-size: 1rem;
            }
        }

        /****************************
         * HERO SECTION
         ****************************/
        .hero-section {
            position: relative;
            padding: 160px 0 100px;
            background: var(--soft-gradient);
            overflow: hidden;
            min-height: 85vh;
            display: flex;
            align-items: center;
        }
        
        .hero-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(1px 1px at 20% 30%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(1px 1px at 40% 70%, rgba(150, 150, 255, 0.8) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(2px 2px at 90% 15%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(1.5px 1.5px at 60% 90%, rgba(150, 150, 255, 0.8) 0%, rgba(150, 150, 255, 0) 100%);
            opacity: 0.6;
            z-index: 0;
        }
        
        .hero-shape-1 {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: var(--sky-gradient);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            opacity: 0.2;
            animation: float 15s ease-in-out infinite;
            z-index: 0;
        }
        
        .hero-shape-2 {
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: var(--purple-gradient);
            border-radius: 40% 60% 70% 30% / 40% 60% 30% 70%;
            opacity: 0.15;
            animation: float 20s ease-in-out infinite reverse;
            z-index: 0;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 25px;
            border-radius: var(--border-radius-pill);
            margin-bottom: 30px;
            border: 1px solid rgba(108, 99, 255, 0.2);
            box-shadow: var(--shadow-sm);
        }
        
        .hero-badge i {
            color: var(--yellow);
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 12px;
            font-size: 1.25rem;
            animation: pulse 2s infinite;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 25px;
            color: #333;
        }
        
        .hero-description {
            font-size: 1.25rem;
            max-width: 600px;
            margin-bottom: 35px;
            color: #555;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
        }
        
        .hero-image-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .hero-image {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-image-main {
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            border: 5px solid #fff;
        }
        
        .hero-image-main img {
            width: 100%;
            transition: transform 0.5s ease;
        }
        
        .hero-image:hover .hero-image-main img {
            transform: scale(1.05);
        }
        
        .hero-feature {
            position: absolute;
            z-index: 2;
            background-color: #fff;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            border: 1px solid rgba(108, 99, 255, 0.1);
            transition: all var(--transition-fast);
        }
        
        .hero-feature:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .hero-feature-1 {
            top: 15%;
            right: -10%;
        }
        
        .hero-feature-2 {
            bottom: 15%;
            left: -10%;
        }
        
        .hero-feature i {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--purple-gradient);
            color: #fff;
            border-radius: var(--border-radius-circle);
            font-size: 1.125rem;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 15px;
        }
        
        .hero-feature-content h4 {
            font-size: 1rem;
            margin-bottom: 3px;
            color: #333;
        }
        
        .hero-feature-content p {
            font-size: 0.875rem;
            margin-bottom: 0;
            color: #666;
        }
        
        @media (max-width: 1199px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-feature-1 {
                right: -5%;
            }
            
            .hero-feature-2 {
                left: -5%;
            }
        }
        
        @media (max-width: 991px) {
            .hero-section {
                padding: 120px 0 80px;
            }
            
            .hero-title {
                font-size: 2.75rem;
            }
            
            .hero-description {
                font-size: 1.125rem;
            }
            
            .hero-image-wrapper {
                margin-top: 50px;
            }
            
            .hero-feature-1 {
                top: 10%;
                right: 0;
            }
            
            .hero-feature-2 {
                bottom: 10%;
                left: 0;
            }
        }
        
        @media (max-width: 767px) {
            .hero-section {
                padding: 100px 0 70px;
                min-height: auto;
            }
            
            .hero-title {
                font-size: 2.25rem;
            }
            
            .hero-description {
                font-size: 1.0625rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .hero-feature {
                padding: 12px 15px;
            }
            
            .hero-feature i {
                width: 35px;
                height: 35px;
                font-size: 0.9375rem;
            }
        }

        /****************************
         * EDUCATIONAL PATHS SECTION
         ****************************/
        .edu-path-section {
            position: relative;
            overflow: hidden;
            background-color: #fff;
        }
        
        .edu-path-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(108, 99, 255, 0.05) 0%, rgba(108, 99, 255, 0) 70%);
            z-index: 0;
        }
        
        .edu-path-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            position: relative;
            z-index: 1;
        }
        
        .edu-path-card {
            position: relative;
            background-color: #fff;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all var(--transition-medium);
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 35px 25px;
            text-align: center;
            border: 1px solid rgba(108, 99, 255, 0.1);
            z-index: 1;
        }
        
        .edu-path-card:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--purple-gradient);
            z-index: 1;
            transition: height var(--transition-fast);
        }
        
        .edu-path-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }
        
        .edu-path-card:hover:after {
            height: 7px;
        }
        
        .edu-path-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-purple-bg);
            border-radius: var(--border-radius-circle);
            transition: all var(--transition-medium);
            color: var(--deep-purple);
            font-size: 2.5rem;
        }
        
        .edu-path-card:hover .edu-path-icon {
            background: var(--purple-gradient);
            color: #fff;
            transform: rotateY(360deg);
        }
        
        .edu-path-title {
            font-size: 1.375rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
            transition: all var(--transition-fast);
        }
        
        .edu-path-card:hover .edu-path-title {
            color: var(--deep-purple);
        }
        
        .edu-path-text {
            color: #666;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .edu-path-link {
            display: inline-flex;
            align-items: center;
            color: var(--deep-purple);
            font-weight: 600;
            transition: all var(--transition-fast);
            margin-top: auto;
        }
        
        .edu-path-link:hover {
            color: var(--purple);
        }
        
        .edu-path-link i {
            margin-<?php echo $isRtl ? 'right' : 'left'; ?>: 8px;
            transition: transform var(--transition-fast);
        }
        
        .edu-path-link:hover i {
            transform: translateX(<?php echo $isRtl ? '-5px' : '5px'; ?>);
        }
        
        @media (max-width: 1199px) {
            .edu-path-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 767px) {
            .edu-path-grid {
                grid-template-columns: 1fr;
            }
        }

        /****************************
         * ABOUT SECTION
         ****************************/
        .about-section {
            position: relative;
            overflow: hidden;
            background-color: var(--light-sky);
        }
        
        .about-section:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at bottom right, rgba(108, 158, 255, 0.1) 0%, rgba(108, 158, 255, 0) 70%);
            z-index: 0;
        }
        
        .about-image-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .about-image {
            position: relative;
            max-width: 90%;
        }
        
        .about-image-wrap {
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            border: 5px solid #fff;
        }
        
        .about-image img {
            width: 100%;
            transition: transform var(--transition-medium);
        }
        
        .about-image:hover img {
            transform: scale(1.05);
        }
        
        .about-experience {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background: var(--purple-gradient);
            color: #fff;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            z-index: 2;
            text-align: center;
        }
        
        .about-experience-number {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }
        
        .about-experience-text {
            font-size: 0.9375rem;
            font-weight: 500;
        }
        
        .about-content {
            position: relative;
            z-index: 1;
        }
        
        .about-text {
            font-size: 1.0625rem;
            line-height: 1.8;
            margin-bottom: 25px;
            color: #555;
        }
        
        .about-features {
            margin: 0 0 25px;
            padding: 0;
            list-style: none;
        }
        
        .about-feature {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        
        .about-feature i {
            color: #fff;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 15px;
            font-size: 0.875rem;
            background: var(--purple-gradient);
            width: 30px;
            height: 30px;
            min-width: 30px;
            border-radius: var(--border-radius-circle);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--purple-shadow);
            transition: all var(--transition-fast);
        }
        
        .about-feature:hover i {
            transform: scale(1.1);
        }
        
        @media (max-width: 991px) {
            .about-image {
                margin-bottom: 70px;
                max-width: 100%;
            }
            
            .about-experience {
                right: 20px;
            }
        }

        /****************************
         * STATS SECTION
         ****************************/
        .stats-section {
            position: relative;
            background: var(--purple-gradient);
            overflow: hidden;
            color: #fff;
            padding: 80px 0;
        }
        
        .stats-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(2px 2px at 90px 40px, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(3px 3px at 160px 120px, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(1.5px 1.5px at 230px 180px, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%);
            background-repeat: repeat;
            background-size: 250px 250px;
            opacity: 0.1;
            z-index: 0;
        }
        
        .stats-container {
            position: relative;
            z-index: 1;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }
        
        .stat-card {
            position: relative;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 40px 20px;
            text-align: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            transition: all var(--transition-medium);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #fff;
            opacity: 0.9;
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1);
            opacity: 1;
            animation: pulse 2s infinite;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            line-height: 1;
            color: #fff;
        }
        
        .stat-label {
            font-size: 1.125rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }
        
        @media (max-width: 1199px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .stat-card {
                padding: 30px 20px;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 767px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /****************************
         * TESTIMONIALS SECTION
         ****************************/
        .testimonials-section {
            position: relative;
            overflow: hidden;
            background-color: var(--soft-gradient);
        }
        
        .testimonials-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(108, 99, 255, 0.05) 0%, rgba(108, 99, 255, 0) 70%);
            z-index: 0;
        }
        
        .testimonial-carousel {
            margin-top: 50px;
            position: relative;
        }
        
        .testimonial-card {
            background-color: #fff;
            border-radius: var(--border-radius-lg);
            padding: 40px 30px;
            transition: all var(--transition-medium);
            box-shadow: var(--shadow);
            margin: 20px 15px 40px;
            position: relative;
            border: 1px solid rgba(108, 99, 255, 0.05);
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }
        
        .testimonial-content {
            position: relative;
            font-size: 1.0625rem;
            line-height: 1.7;
            margin-bottom: 25px;
            padding-top: 30px;
            color: #555;
        }
        
        .testimonial-content:before {
            content: """;
            position: absolute;
            top: -15px;
            left: -5px;
            font-size: 9rem;
            font-family: serif;
            line-height: 1;
            color: var(--light-purple);
            opacity: 0.3;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .testimonial-author:before {
            content: '';
            position: absolute;
            top: -15px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--purple-gradient);
            border-radius: 5px;
        }
        
        .testimonial-author-image {
            width: 60px;
            height: 60px;
            border-radius: var(--border-radius-circle);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 3px solid #fff;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 15px;
        }
        
        .testimonial-author-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-fast);
        }
        
        .testimonial-card:hover .testimonial-author-image img {
            transform: scale(1.1);
        }
        
        .testimonial-author-info h4 {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 3px;
            color: #333;
        }
        
        .testimonial-card:hover .testimonial-author-info h4 {
            color: var(--deep-purple);
        }
        
        .testimonial-author-info p {
            font-size: 0.875rem;
            color: var(--deep-purple);
            margin-bottom: 5px;
        }
        
        .testimonial-rating {
            display: flex;
        }
        
        .testimonial-rating i {
            color: var(--yellow);
            font-size: 0.875rem;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 3px;
        }
        
        .testimonial-carousel .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background: #fff !important;
            border-radius: 50%;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-fast);
        }
        
        .testimonial-carousel .owl-nav button.owl-prev {
            left: -22px;
        }
        
        .testimonial-carousel .owl-nav button.owl-next {
            right: -22px;
        }
        
        .testimonial-carousel .owl-nav button:hover {
            background: var(--purple-gradient) !important;
        }
        
        .testimonial-carousel .owl-nav button span {
            font-size: 1.75rem;
            line-height: 1;
            color: var(--deep-purple);
            transition: all var(--transition-fast);
        }
        
        .testimonial-carousel .owl-nav button:hover span {
            color: #fff;
        }
        
        .testimonial-carousel .owl-dots {
            margin-top: 20px;
            text-align: center;
        }
        
        .testimonial-carousel .owl-dots .owl-dot {
            display: inline-block;
            margin: 0 5px;
        }
        
        .testimonial-carousel .owl-dots .owl-dot span {
            display: block;
            width: 10px;
            height: 10px;
            background: #ccc;
            border-radius: 50%;
            transition: all var(--transition-fast);
        }
        
        .testimonial-carousel .owl-dots .owl-dot.active span,
        .testimonial-carousel .owl-dots .owl-dot:hover span {
            background: var(--deep-purple);
            transform: scale(1.2);
        }
        
        @media (max-width: 767px) {
            .testimonial-card {
                padding: 30px 20px;
            }
            
            .testimonial-content {
                font-size: 1rem;
            }
            
            .testimonial-carousel .owl-nav button {
                width: 35px;
                height: 35px;
            }
            
            .testimonial-carousel .owl-nav button.owl-prev {
                left: -10px;
            }
            
            .testimonial-carousel .owl-nav button.owl-next {
                right: -10px;
            }
        }

        /****************************
         * LOGOS CAROUSEL SECTION
         ****************************/
        .logos-section {
            position: relative;
            padding: 60px 0;
            overflow: hidden;
            background-color: #fff;
        }
        
        .logos-container {
            position: relative;
            z-index: 1;
        }
        
        .logos-carousel-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 15px 0;
        }
        
        .logos-carousel {
            display: flex;
            animation: logoScroll 30s linear infinite;
            width: calc(200px * 12);
        }
        
        @keyframes logoScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-200px * 6));
            }
        }
        
        .logo-item {
            width: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
        }
        
        .logo-item img {
            max-height: 80px;
            max-width: 160px;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all var(--transition-medium);
        }
        
        .logo-item:hover img {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.1);
        }
        
        .logos-carousel-container:before,
        .logos-carousel-container:after {
            content: '';
            position: absolute;
            top: 0;
            width: 100px;
            height: 100%;
            z-index: 2;
        }
        
        .logos-carousel-container:before {
            left: 0;
            background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
        }
        
        .logos-carousel-container:after {
            right: 0;
            background: linear-gradient(to left, white 0%, rgba(255, 255, 255, 0) 100%);
        }

        /****************************
         * BLOG SECTION
         ****************************/
        .blog-section {
            position: relative;
            overflow: hidden;
            background-color: var(--light-sky);
        }
        
        .blog-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at bottom, rgba(108, 158, 255, 0.1) 0%, rgba(108, 158, 255, 0) 70%);
            z-index: 0;
        }
        
        .blog-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
            position: relative;
            z-index: 1;
        }
        
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            position: relative;
            z-index: 1;
        }
        
        .blog-card {
            position: relative;
            background-color: #fff;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all var(--transition-medium);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(108, 158, 255, 0.1);
        }
        
        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }
        
        .blog-image {
            position: relative;
            overflow: hidden;
            height: 220px;
        }
        
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        
        .blog-card:hover .blog-image img {
            transform: scale(1.1);
        }
        
        .blog-category {
            position: absolute;
            top: 15px;
            <?php echo $isRtl ? 'right' : 'left'; ?>: 15px;
            background: var(--purple-gradient);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 15px;
            border-radius: var(--border-radius-pill);
            z-index: 2;
            box-shadow: var(--purple-shadow);
            transition: all var(--transition-fast);
        }
        
        .blog-card:hover .blog-category {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(108, 99, 255, 0.4);
        }
        
        .blog-date {
            position: absolute;
            bottom: 15px;
            <?php echo $isRtl ? 'left' : 'right'; ?>: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 15px;
            border-radius: var(--border-radius);
            z-index: 2;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-fast);
        }
        
        .blog-card:hover .blog-date {
            transform: translateY(3px);
            background-color: rgba(255, 255, 255, 1);
        }
        
        .blog-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .blog-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        
        .blog-title a {
            color: #333;
            transition: color var(--transition-fast);
        }
        
        .blog-title a:hover {
            color: var(--deep-purple);
        }
        
        .blog-text {
            color: #666;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .blog-link {
            display: inline-flex;
            align-items: center;
            color: var(--deep-purple);
            font-weight: 600;
            margin-top: auto;
            transition: all var(--transition-fast);
        }
        
        .blog-link:hover {
            color: var(--purple);
        }
        
        .blog-link i {
            margin-<?php echo $isRtl ? 'right' : 'left'; ?>: 8px;
            transition: transform var(--transition-fast);
        }
        
        .blog-link:hover i {
            transform: translateX(<?php echo $isRtl ? '-5px' : '5px'; ?>);
        }
        
        @media (max-width: 1199px) {
            .blog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 991px) {
            .blog-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }
        
        @media (max-width: 767px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }
        }

        /****************************
         * VIDEO TOUR SECTION
         ****************************/
        .video-tour-section {
            position: relative;
            overflow: hidden;
            padding: 0;
        }
        
        .video-tour-wrapper {
            position: relative;
            height: 500px;
            background-color: #1A1F2A;
            overflow: hidden;
        }
        
        .video-tour-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7;
            transition: transform 0.8s ease;
        }
        
        .video-tour-wrapper:hover .video-tour-placeholder {
            transform: scale(1.05);
        }
        
        .video-tour-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(26, 31, 42, 0.5), rgba(26, 31, 42, 0.8));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            padding: 30px;
            z-index: 1;
        }
        
        .video-tour-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .video-tour-description {
            font-size: 1.25rem;
            max-width: 700px;
            margin-bottom: 35px;
            opacity: 0.9;
        }
        
        .video-play-btn {
            width: 85px;
            height: 85px;
            border-radius: var(--border-radius-circle);
            background: var(--purple-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
            box-shadow: 0 0 0 10px rgba(108, 99, 255, 0.2), 0 0 30px rgba(108, 99, 255, 0.5);
            cursor: pointer;
            transition: all var(--transition-medium);
            position: relative;
            z-index: 1;
        }
        
        .video-play-btn:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(108, 99, 255, 0.3);
            z-index: -1;
            animation: pulse 2s infinite;
        }
        
        .video-play-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 0 15px rgba(108, 99, 255, 0.2), 0 0 40px rgba(108, 99, 255, 0.6);
        }
        
        .video-play-btn i {
            margin-left: 5px;
        }
        
        @media (max-width: 991px) {
            .video-tour-wrapper {
                height: 450px;
            }
            
            .video-tour-title {
                font-size: 2.5rem;
            }
            
            .video-tour-description {
                font-size: 1.125rem;
            }
            
            .video-play-btn {
                width: 75px;
                height: 75px;
                font-size: 1.75rem;
            }
        }
        
        @media (max-width: 767px) {
            .video-tour-wrapper {
                height: 400px;
            }
            
            .video-tour-title {
                font-size: 2rem;
            }
            
            .video-tour-description {
                font-size: 1rem;
            }
            
            .video-play-btn {
                width: 65px;
                height: 65px;
                font-size: 1.5rem;
            }
        }

        /****************************
         * FAQ SECTION
         ****************************/
        .faq-section {
            position: relative;
            overflow: hidden;
            background-color: #fff;
        }
        
        .faq-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(108, 99, 255, 0.05) 0%, rgba(108, 99, 255, 0) 70%);
            z-index: 0;
        }
        
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .faq-item {
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 20px;
            transition: all var(--transition-medium);
            border: 1px solid rgba(108, 99, 255, 0.05);
            position: relative;
        }
        
        .faq-item:hover, .faq-item.active {
            box-shadow: var(--shadow-lg);
            border-color: rgba(108, 99, 255, 0.1);
            transform: translateY(-3px);
        }
        
        .faq-question {
            padding: 20px 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            color: #333;
            transition: all var(--transition-fast);
        }
        
        .faq-question:hover {
            color: var(--deep-purple);
        }
        
        .faq-question i {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-purple-bg);
            color: var(--deep-purple);
            border-radius: var(--border-radius-circle);
            font-size: 0.875rem;
            transition: all var(--transition-medium);
        }
        
        .faq-item.active .faq-question {
            color: var(--deep-purple);
        }
        
        .faq-item.active .faq-question i,
        .faq-question:hover i {
            background: var(--purple-gradient);
            color: #fff;
            transform: rotate(180deg);
        }
        
        .faq-answer {
            padding: 0 25px;
            max-height: 0;
            overflow: hidden;
            transition: max-height var(--transition-medium);
        }
        
        .faq-answer-content {
            padding-bottom: 25px;
            color: #666;
        }
        
        .faq-item.active .faq-answer {
            max-height: 1000px;
        }
        
        .faq-more {
            text-align: center;
            margin-top: 40px;
        }

        /****************************
         * CTA SECTION
         ****************************/
        .cta-section {
            position: relative;
            background: var(--sky-gradient);
            color: #fff;
            overflow: hidden;
        }
        
        .cta-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(2px 2px at 90px 40px, rgba(255, 255, 255, 0.6) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(3px 3px at 160px 120px, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(1.5px 1.5px at 230px 180px, rgba(255, 255, 255, 0.6) 0%, rgba(255, 255, 255, 0) 100%);
            background-repeat: repeat;
            background-size: 250px 250px;
            opacity: 0.15;
            z-index: 0;
        }
        
        .cta-container {
            position: relative;
            z-index: 1;
        }
        
        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .cta-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: #fff;
        }
        
        .cta-text {
            font-size: 1.25rem;
            margin-bottom: 35px;
            opacity: 0.9;
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        
        @media (max-width: 991px) {
            .cta-title {
                font-size: 2.5rem;
            }
            
            .cta-text {
                font-size: 1.125rem;
            }
        }
        
        @media (max-width: 767px) {
            .cta-title {
                font-size: 2rem;
            }
            
            .cta-text {
                font-size: 1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .cta-buttons .btn {
                width: 100%;
                max-width: 280px;
            }
        }

        /****************************
         * BACK TO TOP BUTTON
         ****************************/
        .back-to-top {
            position: fixed;
            bottom: 30px;
            <?php echo $isRtl ? 'left' : 'right'; ?>: 30px;
            width: 50px;
            height: 50px;
            border-radius: var(--border-radius-circle);
            background: var(--purple-gradient);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: var(--shadow), var(--purple-shadow);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all var(--transition-fast);
            z-index: 99;
            cursor: pointer;
        }
        
        .back-to-top.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .back-to-top:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg), 0 0 20px rgba(108, 99, 255, 0.5);
        }

        /****************************
         * VIDEO MODAL
         ****************************/
        .modal-content {
            background-color: #1A1F2A;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        
        .modal-header {
            background: var(--purple-gradient);
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
        }
        
        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .modal-header .close {
            color: #fff;
            opacity: 0.8;
            text-shadow: none;
            transition: all var(--transition-fast);
        }
        
        .modal-header .close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 0;
        }
        
        .embed-responsive {
            background-color: #000;
        }
    </style>
</head>

<body>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Header -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Section -->
        <section class="hero-section" id="home">
            <!-- Hero Shapes -->
            <div class="hero-shape-1"></div>
            <div class="hero-shape-2"></div>
            
            <!-- Hero meteors -->
            <div class="shape-meteor"></div>
            <div class="shape-meteor shape-meteor-2"></div>
            
            <div class="container">
                <div class="row align-items-center">
                    <!-- Hero Content -->
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <div class="hero-badge">
                                <i class="fas fa-graduation-cap"></i>
                                <?php echo $isRtl ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex'; ?>
                            </div>
                            
                            <h1 class="hero-title">
                                <?php if($isRtl): ?>
                                انتخابی برای <span class="text-gradient">موفقیت</span>، مسیری برای <span class="text-gradient">رشد</span>
                                <?php else: ?>
                                <span class="text-gradient">Excellence</span> in Education, Path to <span class="text-gradient">Success</span>
                                <?php endif; ?>
                            </h1>
                            
                            <p class="hero-description">
                                <?php echo $isRtl ? 'آموزش با کیفیت بالا، مطابق با استانداردهای وزارت آموزش و پرورش ایران و با رویکرد بین‌المللی برای پرورش نسل آینده.' : 'High-quality education following Iranian Ministry of Education standards with an international approach to nurture the next generation.'; ?>
                            </p>
                            
                            <div class="hero-buttons">
                                <a href="Terms and Conditions for Registration.php" class="btn btn-primary">
                                    <?php echo $isRtl ? 'ثبت‌نام' : 'Apply Now'; ?>
                                    <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                </a>
                                <a href="about.php" class="btn btn-outline">
                                    <?php echo $isRtl ? 'درباره ما' : 'About Us'; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hero Image -->
                    <div class="col-lg-6">
                        <div class="hero-image-wrapper">
                            <div class="hero-image">
                                <div class="hero-image-main">
                                    <img src="assets/images/resources/graduates.jpg" alt="<?php echo $isRtl ? 'دانش‌آموزان مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex Students'; ?>">
                                </div>
                                
                                <div class="hero-feature hero-feature-1">
                                    <i class="fas fa-medal"></i>
                                    <div class="hero-feature-content">
                                        <h4><?php echo $isRtl ? 'آموزش با کیفیت' : 'Quality Education'; ?></h4>
                                        <p><?php echo $isRtl ? 'استانداردهای آموزشی برتر' : 'Top Educational Standards'; ?></p>
                                    </div>
                                </div>
                                
                                <div class="hero-feature hero-feature-2">
                                    <i class="fas fa-history"></i>
                                    <div class="hero-feature-content">
                                        <h4><?php echo $isRtl ? '۶۷+ سال تجربه' : '67+ Years Experience'; ?></h4>
                                        <p><?php echo $isRtl ? 'سابقه درخشان آموزشی' : 'Proven Educational Track Record'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Educational Paths Section -->
        <section class="edu-path-section" id="educational-paths">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-subtitle"><?php echo $isRtl ? 'آشنایی با دوره‌های تحصیلی ما' : 'Our Educational Paths'; ?></span>
                    <h2 class="section-heading">
                        <?php echo $isRtl ? 'دوره‌های تحصیلی ما، <span class="text-underline">فرصتی</span> برای رشد و شکوفایی در هر مقطع' : 'Our Academic <span class="text-underline">Programs</span> for Growth at Every Level'; ?>
                    </h2>
                    <div class="section-divider"></div>
                    <p class="section-description text-center">
                        <?php echo $isRtl ? 'مجتمع آموزشی سلمان فارسی با ارائه دوره‌های آموزشی در مقاطع مختلف، پاسخگوی نیازهای آموزشی دانش‌آموزان از پیش‌دبستانی تا متوسطه دوم است.' : 'Salman Farsi Educational Complex offers educational programs at various levels, meeting the educational needs of students from kindergarten through high school.'; ?>
                    </p>
                </div>
                
                <div class="edu-path-grid">
                    <!-- Kindergarten (Ehsan) -->
                    <div class="edu-path-card">
                        <div class="edu-path-icon">
                            <i class="fas fa-child"></i>
                        </div>
                        <h3 class="edu-path-title"><?php echo $isRtl ? 'بخش احسان' : 'EHSAN SECTION'; ?></h3>
                        <p class="edu-path-text">
                            <?php echo $isRtl ? 'محیطی مملو از شادی و آرامش برای دانش‌آموزان، با تأکید بر موضوعات متنوع و تقویت استعدادهای فردی' : 'A joyful and nurturing environment for young learners, focusing on diverse topics and developing individual talents'; ?>
                        </p>
                        <a href="Ehsan SOD page.php" class="edu-path-link">
                            <?php echo $isRtl ? 'اطلاعات بیشتر' : 'Learn More'; ?>
                            <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        </a>
                    </div>
                    
                    <!-- Primary School -->
                    <div class="edu-path-card">
                        <div class="edu-path-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3 class="edu-path-title"><?php echo $isRtl ? 'دوره ابتدایی' : 'Primary School'; ?></h3>
                        <p class="edu-path-text">
                            <?php echo $isRtl ? 'مرحله مهارت‌های اساسی، تمرکز بر خواندن و نوشتن، علوم، ریاضی و مهارت‌های اجتماعی در محیطی جذاب و امن' : 'The foundational skills phase, focusing on reading, writing, science, mathematics, and social skills in an engaging and safe environment'; ?>
                        </p>
                        <a href="Curriculum.php#primary-school" class="edu-path-link">
                            <?php echo $isRtl ? 'اطلاعات بیشتر' : 'Learn More'; ?>
                            <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        </a>
                    </div>
                    
                    <!-- Middle School -->
                    <div class="edu-path-card">
                        <div class="edu-path-icon">
                            <i class="fas fa-atom"></i>
                        </div>
                        <h3 class="edu-path-title"><?php echo $isRtl ? 'دوره متوسطه اول' : 'Middle School'; ?></h3>
                        <p class="edu-path-text">
                            <?php echo $isRtl ? 'آموزش پیشرفته در دروس تخصصی با تأکید بر موضوعات علمی و تقویت مهارت‌های حل مسئله برای آماده‌سازی دانش‌آموزان' : 'Advanced learning in specialized subjects with emphasis on scientific topics and strengthening problem-solving skills to prepare students'; ?>
                        </p>
                        <a href="Curriculum.php#middle-school" class="edu-path-link">
                            <?php echo $isRtl ? 'اطلاعات بیشتر' : 'Learn More'; ?>
                            <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        </a>
                    </div>
                    
                    <!-- High School -->
                    <div class="edu-path-card">
                        <div class="edu-path-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="edu-path-title"><?php echo $isRtl ? 'دوره متوسطه دوم' : 'High School'; ?></h3>
                        <p class="edu-path-text">
                            <?php echo $isRtl ? 'آموزش تخصصی در رشته‌های علوم تجربی، علوم انسانی، علوم ریاضی، کامپیوتر، و آماده‌سازی دانش‌آموزان برای دانشگاه' : 'Specialized education in natural sciences, humanities, mathematics, computer science, and preparation of students for university entrance'; ?>
                        </p>
                        <a href="Curriculum.php#high-school" class="edu-path-link">
                            <?php echo $isRtl ? 'اطلاعات بیشتر' : 'Learn More'; ?>
                            <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <!-- About Image -->
                    <div class="col-lg-6">
                        <div class="about-image-wrapper">
                            <div class="about-image">
                                <div class="about-image-wrap">
                                    <img src="assets/images/facilities/school.jpeg" alt="<?php echo $isRtl ? 'درباره مجتمع آموزشی سلمان فارسی' : 'About Salman Farsi Educational Complex'; ?>">
                                </div>
                                
                                <div class="about-experience">
                                    <div class="about-experience-number">67+</div>
                                    <div class="about-experience-text">
                                        <?php echo $isRtl ? 'سال تجربه آموزشی' : 'Years Experience'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- About Content -->
                    <div class="col-lg-6">
                        <div class="about-content">
                            <span class="section-subtitle"><?php echo $isRtl ? 'درباره ما' : 'About Us'; ?></span>
                            <h2 class="section-heading">
                                <?php echo $isRtl ? 'مجتمع آموزشی <span class="text-underline">سلمان</span> فارسی' : 'Salman Farsi <span class="text-underline">Educational</span> Complex'; ?>
                            </h2>
                            <div class="section-divider"></div>
                            
                            <p class="about-text">
                                <?php echo $isRtl ? 'آموزشی با کیفیت بالا، مطابق با استانداردهای وزارت آموزش و پرورش ایران، با تمرکز بر رشد شخصی و تقویت هویت فرهنگی دانش‌آموزان ایرانی در دبی. مسیر آموزشی ما شامل برنامه‌های تقویتی برای رشد شخص و توسعه شخصیت در یک محیط چندفرهنگی است.' : 'High-quality education following Iranian Ministry of Education standards, focusing on personal growth and strengthening the cultural identity of Iranian students in Dubai. Our educational path includes supportive programs for personal growth and character development in a multicultural environment.'; ?>
                            </p>
                            
                            <ul class="about-features">
                                <li class="about-feature">
                                    <i class="fas fa-check"></i>
                                    <span><?php echo $isRtl ? 'کادر آموزشی مجرب و متخصص' : 'Experienced and specialized teaching staff'; ?></span>
                                </li>
                                <li class="about-feature">
                                    <i class="fas fa-check"></i>
                                    <span><?php echo $isRtl ? 'محیط یادگیری امن و حمایت‌کننده' : 'Safe and supportive learning environment'; ?></span>
                                </li>
                                <li class="about-feature">
                                    <i class="fas fa-check"></i>
                                    <span><?php echo $isRtl ? 'برنامه‌های فوق‌برنامه متنوع و غنی‌کننده' : 'Diverse and enriching extracurricular activities'; ?></span>
                                </li>
                                <li class="about-feature">
                                    <i class="fas fa-check"></i>
                                    <span><?php echo $isRtl ? 'آموزش چندزبانه (فارسی، عربی، انگلیسی)' : 'Multilingual education (Persian, Arabic, English)'; ?></span>
                                </li>
                            </ul>
                            
                            <a href="about.php" class="btn btn-primary">
                                <?php echo $isRtl ? 'بیشتر درباره ما' : 'More About Us'; ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">            
            <div class="container stats-container">
                <div class="stats-grid">
                    <!-- Students Stat -->
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-number" data-count="1700">1.7k+</div>
                        <div class="stat-label"><?php echo $isRtl ? 'فارغ التحصیلان موفق' : 'Successful Graduates'; ?></div>
                    </div>
                    
                    <!-- Years Stat -->
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-number" data-count="67">67+</div>
                        <div class="stat-label"><?php echo $isRtl ? 'سال‌های تجربه' : 'Years of Experience'; ?></div>
                    </div>
                    
                    <!-- Students Stat -->
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number" data-count="490">490</div>
                        <div class="stat-label"><?php echo $isRtl ? 'پذیرش سالانه دانش‌آموزان ' : 'Current Students'; ?></div>
                    </div>
                    
                    <!-- Partners Stat -->
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-number" data-count="14">14+</div>
                        <div class="stat-label"><?php echo $isRtl ? 'دانشگاه‌های همکار' : 'University Partners'; ?></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- University Logos Carousel -->
        <section class="university-logos-section py-5 bg-light">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <span class="section-subtitle d-inline-block rounded-pill fw-semibold mb-3">
                        <?php echo $isRtl ? 'افتخار حضور در دانشگاه‌های برتر' : 'Proud Presence in Top Universities'; ?>
                    </span>
                    <h2 class="section-heading fs-1 fw-bold mb-3">
                        <?php echo $isRtl ? 'مقاصد <span class="text-underline position-relative">دانشگاهی</span> فارغ‌التحصیلان ما' : 'University <span class="text-underline position-relative">Destinations</span> of Our Graduates'; ?>
                    </h2>
                    <div class="section-divider mx-auto"></div>
                    <p class="section-description text-center mx-auto mb-0 text-secondary">
                        <?php echo $isRtl ? 'فارغ‌التحصیلان مجتمع آموزشی سلمان فارسی در معتبرترین دانشگاه‌های ایران و جهان مشغول به تحصیل هستند' : 'Graduates of Salman Farsi Educational Complex are studying in the most prestigious universities in Iran and around the world'; ?>
                    </p>
                </div>

                <!-- Universities Carousel -->
                <div class="university-carousel-container position-relative mt-5">
                    <?php
                    // Define university logos array
                    $university_logos = [
                        [
                            'image' => 'assets/images/University_Logos/ajman-university8747-removebg-preview.png',
                            'name' => 'Ajman University',
                            'name_fa' => 'دانشگاه عجمان'
                        ],
                        [
                            'image' => 'assets/images/University_Logos/b1b6c65f341b33f98c748d68aa8ed0e2.American_University_in_Dubai.png',
                            'name' => 'American University in Dubai',
                            'name_fa' => 'دانشگاه آمریکایی دبی'
                        ],
                        [
                            'image' => 'assets/images/University_Logos/iau-removebg-preview.png',
                            'name' => 'Islamic Azad University',
                            'name_fa' => 'دانشگاه آزاد اسلامی'
                        ],
                        [
                            'image' => 'assets/images/University_Logos/images-removebg-preview.png',
                            'name' => 'University of Tehran',
                            'name_fa' => 'دانشگاه تهران'
                        ],
                        [
                            'image' => 'assets/images/University_Logos/UOWD_Secondary_CMYK_Dark Blue.png',
                            'name' => 'University of Wollongong Dubai',
                            'name_fa' => 'دانشگاه وولونگونگ دبی'
                        ],
                        [
                            'image' => 'assets/images/University_Logos/sharif.png',
                            'name' => 'Sharif University of Technology',
                            'name_fa' => 'دانشگاه صنعتی شریف'
                        ],
                        [
                            'image' => 'assets/images/University_Logos/amirkabir.png',
                            'name' => 'Amirkabir University of Technology',
                            'name_fa' => 'دانشگاه صنعتی امیرکبیر'
                        ],
                    ];
                    ?>

                    <!-- Static Marquee Effect for Universities -->
                    <div class="university-marquee overflow-hidden">
                        <div class="university-marquee-content d-flex align-items-center justify-content-around" id="university-marquee-content">
                            <?php foreach ($university_logos as $logo): ?>
                            <div class="university-logo mx-4 p-3 bg-white rounded-3 shadow-sm" data-bs-toggle="tooltip" 
                                title="<?php echo $isRtl ? htmlspecialchars($logo['name_fa']) : htmlspecialchars($logo['name']); ?>">
                                <img src="<?php echo htmlspecialchars($logo['image']); ?>" 
                                    alt="<?php echo $isRtl ? htmlspecialchars($logo['name_fa']) : htmlspecialchars($logo['name']); ?>"
                                    class="img-fluid" style="max-height: 70px; max-width: 140px;">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Gradient Overlays -->
                    <div class="university-overlay-start position-absolute top-0 start-0 h-100" style="width: 100px; background: linear-gradient(to right, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%); z-index: 1;"></div>
                    <div class="university-overlay-end position-absolute top-0 end-0 h-100" style="width: 100px; background: linear-gradient(to left, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%); z-index: 1;"></div>
                </div>
            </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Clone logos for infinite scroll effect
                const marqueeContent = document.getElementById('university-marquee-content');
                const logoElements = marqueeContent.querySelectorAll('.university-logo');
                
                // Clone the logos and append to create infinite scroll effect
                logoElements.forEach(logo => {
                    const clone = logo.cloneNode(true);
                    marqueeContent.appendChild(clone);
                });
                
                // Set animation properties based on RTL or LTR
                const isRtl = <?php echo $isRtl ? 'true' : 'false'; ?>;
                const direction = isRtl ? 'right' : 'left';
                const distance = isRtl ? '100%' : '-100%';
                
                // Add animation
                marqueeContent.style.animationName = 'scrollLogos';
                marqueeContent.style.animationDuration = '40s';
                marqueeContent.style.animationTimingFunction = 'linear';
                marqueeContent.style.animationIterationCount = 'infinite';
                
                // Create keyframes for the animation
                const styleSheet = document.createElement('style');
                styleSheet.textContent = `
                    @keyframes scrollLogos {
                        from {
                            transform: translateX(0);
                        }
                        to {
                            transform: translateX(${distance});
                        }
                    }
                `;
                document.head.appendChild(styleSheet);
                
                // Initialize Bootstrap tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl, {
                        placement: 'top',
                        trigger: 'hover'
                    });
                });
                
                // Pause animation on hover
                marqueeContent.addEventListener('mouseenter', () => {
                    marqueeContent.style.animationPlayState = 'paused';
                });
                
                marqueeContent.addEventListener('mouseleave', () => {
                    marqueeContent.style.animationPlayState = 'running';
                });
            });
        </script>


<!-- Testimonials Section -->
<?php
// Get testimonials from database
$testimonials = [];

try {
    $conn = connectDB();
    
    if ($conn) {
        // Query to fetch reviews/testimonials
        $reviews_query = "SELECT * FROM reviews ORDER BY id DESC LIMIT 6";
        $reviews_result = $conn->query($reviews_query);
        
        if ($reviews_result && $reviews_result->num_rows > 0) {
            while ($row = $reviews_result->fetch_assoc()) {
                $testimonials[] = $row;
            }
        }
        closeDB($conn);
    }
} catch (Exception $e) {
    // Silent fail - will use fallback data
}

// Fallback data if no testimonials found in database
if (empty($testimonials)) {
    $testimonials = [
        [
            'name_fa' => 'دنی داریو',
            'name_en' => 'Danny Dario',
            'position_fa' => '۲۹ مرداد ۱۴۰۰',
            'position_en' => '29 August 2021',
            'review_fa' => 'اولین سرویسی که در بازار پیدا کردم که تجربه واقعی پرداخت آسان را به من می‌دهد. فرآیند پرداخت بسیار ساده و روان است.',
            'review_en' => 'The first one I found in market that gives me a real experience of having an easy payment process',
            'rating' => 5,
            'image_url' => 'assets/images/avatar/person1.jpg'
        ],
        [
            'name_fa' => 'آلبرت سیریل',
            'name_en' => 'Albert Cyrill',
            'position_fa' => '۲۹ مرداد ۱۴۰۰',
            'position_en' => '29 August 2021',
            'review_fa' => 'ساخت کارت خودم و انتخاب شماره شخصی یک تجربه کاملاً جدید برای من است. کار عالی برای این ویژگی‌های فوق‌العاده!',
            'review_en' => 'Making my own card and choosing my own number is a whole new experience for me. Nice work for this super features',
            'rating' => 5,
            'image_url' => 'assets/images/avatar/person2.jpg'
        ],
        [
            'name_fa' => 'مادونا کادی',
            'name_en' => 'Madona Cadee',
            'position_fa' => '۲۹ مرداد ۱۴۰۰',
            'position_en' => '29 August 2021',
            'review_fa' => 'انتظار نداشتم که انجام تراکنش حتی بین پلتفرم‌های مختلف تا این حد آسان باشد. ممنون پیومنت!',
            'review_en' => 'I don\'t expect it will be this easy to do transaction even on between different platform. Thanks Payoment!',
            'rating' => 5,
            'image_url' => 'assets/images/avatar/person3.jpg'
        ],
    ];
}

// Current language for display
$isRtl = (isset($_SESSION['lang']) && $_SESSION['lang'] === 'fa');
?>

<!-- Testimonials Section -->
<section class="testimonials-section py-5" id="testimonials" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
    <div class="container py-4">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h2 class="section-heading fw-bold mb-2">
                <?php echo $isRtl ? 'آنچه والدین می‌گویند' : 'What Parents Are Saying'; ?>
            </h2>
            <p class="text-muted">
                <?php echo $isRtl ? 'والدین و دانش‌آموزان توضیح می‌دهند که چرا مجتمع آموزشی ما را انتخاب کرده‌اند و چگونه در مسیر تحصیلی آنها تأثیر گذاشته است' : 'Parents and students explain why they chose our educational complex and how it has impacted their educational journey'; ?>
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="row">
            <?php foreach (array_slice($testimonials, 0, 3) as $testimonial): ?>
            <div class="col-md-4 mb-4">
                <div class="testimonial-card h-100 bg-white p-4 rounded shadow-sm">
                    <!-- Quote Icon -->
                    <div class="quote-icon mb-3">
                        <i class="fas fa-quote-left text-primary opacity-25 fa-2x"></i>
                    </div>
                    
                    <!-- Testimonial Content -->
                    <div class="testimonial-content mb-4">
                        <p class="testimonial-text mb-0">
                            <?php echo htmlspecialchars($isRtl ? $testimonial['review_fa'] : $testimonial['review_en']); ?>
                        </p>
                    </div>
                    
                    <!-- Rating Stars -->
                    <div class="testimonial-rating mb-3">
                        <?php 
                        // Default rating to 5 if not set
                        $rating = isset($testimonial['rating']) ? $testimonial['rating'] : 5;
                        for ($i = 0; $i < 5; $i++): 
                        ?>
                            <?php if ($i < $rating): ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php else: ?>
                                <i class="far fa-star text-warning"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    
                    <!-- Author Info -->
                    <div class="testimonial-author d-flex align-items-center">
                        <?php 
                        // Simplified image handling
                        $avatar_path = 'assets/images/avatar/';
                        $image_filename = isset($testimonial['image_url']) ? basename($testimonial['image_url']) : '';
                        $default_image = $avatar_path . 'default.jpg';
                        
                        // Either use the specified image or a default image based on index
                        if (!empty($image_filename)) {
                            $image_path = $avatar_path . $image_filename;
                        } else {
                            // Default to personX.jpg where X is the index + 1
                            $index = array_search($testimonial, $testimonials) + 1;
                            $image_path = $avatar_path . 'person' . $index . '.jpg';
                        }
                        ?>
                        
                        <img src="<?php echo htmlspecialchars($image_path); ?>" 
                             alt="<?php echo htmlspecialchars($isRtl ? $testimonial['name_fa'] : $testimonial['name_en']); ?>" 
                             class="rounded-circle" 
                             width="50" height="50"
                             onerror="this.onerror=null; this.src='<?php echo $default_image; ?>';">
                        
                        <div class="<?php echo $isRtl ? 'me-3' : 'ms-3'; ?>">
                            <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($isRtl ? $testimonial['name_fa'] : $testimonial['name_en']); ?></h6>
                            <small class="text-muted"><?php echo htmlspecialchars($isRtl ? $testimonial['position_fa'] : $testimonial['position_en']); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Additional CSS for the testimonials section -->
<style>
    .testimonials-section {
        background-color: #f8f9fa;
    }
    
    .section-heading {
        font-size: 2.5rem;
        color: #3d4f6c;
    }
    
    .testimonial-card {
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.06);
        transition: all 0.3s ease;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .testimonial-text {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #4a5568;
        min-height: 120px;
    }
    
    .testimonial-rating {
        font-size: 1.1rem;
    }
    
    /* Style for RTL */
    [dir="rtl"] .fa-quote-left:before {
        content: "\f10e"; /* fa-quote-right for RTL */
    }
    
    /* Responsive styles */
    @media (max-width: 767.98px) {
        .section-heading {
            font-size: 2rem;
        }
        
        .testimonial-text {
            min-height: auto;
        }
    }
</style>

            <!-- Blog Section -->
            <section class="blog-section py-5 my-4 bg-light">
                <div class="container">
                    <!-- Section Header -->
                    <div class="row mb-5">
                        <div class="col-lg-8">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                                <?php echo ($current_language === 'fa') ? 'اخبار و مقالات' : 'News & Articles'; ?>
                            </span>
                            <h2 class="section-heading h1 mb-4 fw-bold">
                                <?php echo ($current_language === 'fa') ? 'آخرین <span class="text-primary">اخبار</span> مجموعه آموزشی سلمان فارسی' : 'Latest <span class="text-primary">News</span> from Salman Farsi Educational Complex'; ?>
                            </h2>
                            <div class="divider mb-4" style="height: 4px; width: 60px; background: var(--bs-primary);"></div>
                        </div>
                        <div class="col-lg-4 d-flex align-items-center justify-content-lg-end mt-4 mt-lg-0">
                            <a href="blog.php<?php echo '?lang=' . $current_language; ?>" class="btn btn-primary rounded-pill px-4 py-2">
                                <?php echo ($current_language === 'fa') ? 'مشاهده همه اخبار' : 'View All News'; ?>
                                <i class="fas fa-arrow-<?php echo ($current_language === 'fa') ? 'left' : 'right'; ?> ms-2"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Blog Posts Grid -->
                    <div class="row g-4">
                        <?php
                        // Database query to fetch blog posts
                        $latest_posts = [];
                        $isRtl = ($current_language === 'fa');
                        
                        try {
                            $conn = connectDB(); // Using the function from config.php
                            
                            if ($conn) {
                                // Updated database name in query
                                $conn->select_db("salmandatabase"); // Change to your actual database name
                                
                                // Check if post table exists
                                $table_check_query = "SHOW TABLES LIKE 'post'";
                                $table_check_result = $conn->query($table_check_query);
                                
                                if ($table_check_result && $table_check_result->num_rows > 0) {
                                    // If table exists, fetch posts
                                    $posts_query = "SELECT p.*, c.category_name, c.category_name_en 
                                                FROM post p
                                                LEFT JOIN categories c ON p.category_id = c.category_id
                                                ORDER BY p.publish_date DESC LIMIT 3";
                                    
                                    $posts_result = $conn->query($posts_query);
                                    if ($posts_result && $posts_result->num_rows > 0) {
                                        while ($row = $posts_result->fetch_assoc()) {
                                            $latest_posts[] = $row;
                                        }
                                    }
                                }
                                closeDB($conn);
                            }
                        } catch (Exception $e) {
                            // Silent fail - will use fallback data
                        }
                        
                        // If no posts found, use fallback data
                        if (empty($latest_posts)) {
                            $latest_posts = [
                                [
                                    'id' => 1,
                                    'title' => 'سالگرد رحلت امام خمینی (ره)، پدر انقلاب اسلامی',
                                    'title_en' => 'Anniversary of Imam Khomeini\'s Passing, Father of the Islamic Revolution',
                                    'content1' => 'مراسم بزرگداشت سالگرد رحلت امام خمینی (ره) با حضور دانش‌آموزان و کادر آموزشی در مجتمع آموزشی سلمان فارسی برگزار شد. در این مراسم درباره شخصیت و میراث ایشان صحبت شد.',
                                    'content1_en' => 'The commemoration ceremony for the anniversary of Imam Khomeini\'s passing was held with the presence of students and faculty at Salman Farsi Educational Complex. The ceremony discussed his personality and legacy.',
                                    'main_image' => 'imam-khomeini.png',
                                    'category_name' => 'مناسبت‌ها',
                                    'category_name_en' => 'Events',
                                    'publish_date' => '2024-06-03'
                                ],
                                [
                                    'id' => 2,
                                    'title' => 'روز معلم، گرامیداشت فرهنگیان و پیشگامان دانش',
                                    'title_en' => 'Teacher\'s Day: Honoring Educators and Pioneers of Knowledge',
                                    'content1' => 'مراسم بزرگداشت مقام معلم با حضور اساتید، دانش‌آموزان و خانواده‌ها در سالن اجتماعات مجتمع آموزشی سلمان فارسی برگزار شد. در این مراسم از معلمان برتر تقدیر به عمل آمد.',
                                    'content1_en' => 'The ceremony honoring teachers was held with the presence of faculty, students, and families in the assembly hall of Salman Farsi Educational Complex. Outstanding teachers were recognized in this ceremony.',
                                    'main_image' => 'teachers-day.png',
                                    'category_name' => 'رویدادها',
                                    'category_name_en' => 'Events',
                                    'publish_date' => '2024-05-01'
                                ],
                                [
                                    'id' => 3,
                                    'title' => 'نوروز باستانی، آغازی دوباره',
                                    'title_en' => 'Ancient Nowruz, A New Beginning',
                                    'content1' => 'فرارسیدن سال نو و آغاز بهار طبیعت، فرصتی است برای زدودن غبار غم از دل‌ها و تجدید روحیه امید و نشاط در کالبد جامعه. ایران باستان، ایران اسلامی و ایران معاصر، همگی شاهد جشن‌های رنگارنگ نوروزی بوده‌اند؛ جشنی که ریشه در فرهنگ غنی این سرزمین کهن دارد.',
                                    'content1_en' => 'The arrival of the new year and the beginning of spring is an opportunity to wipe away the dust of sorrow from our hearts and renew the spirit of hope and joy in the fabric of society. Ancient Iran, Islamic Iran, and contemporary Iran have all witnessed the colorful celebrations of Nowruz - a festivity rooted in the rich culture of this ancient land.',
                                    'main_image' => 'nowruz.png',
                                    'category_name' => 'اطلاعیه‌ها',
                                    'category_name_en' => 'Announcements',
                                    'publish_date' => '2024-03-20'
                                ]
                            ];
                        }
                        
                        ?>
                            
                        <!-- Featured Post -->
                        <?php if (!empty($latest_posts)): ?>
                        <div class="col-12">
                            <div class="blog-card featured-post bg-white shadow rounded-4 overflow-hidden mb-4">
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <div class="blog-image position-relative h-100">
                                            <?php
                                            $image_path = 'assets/images/blog/' . (!empty($latest_posts[0]['main_image']) ? 
                                                $latest_posts[0]['main_image'] : 'blog-default.jpg');
                                            ?>
                                            <img src="<?php echo htmlspecialchars($image_path); ?>" 
                                                alt="<?php echo htmlspecialchars($isRtl ? $latest_posts[0]['title'] : $latest_posts[0]['title_en']); ?>"
                                                class="img-fluid w-100 h-100" style="object-fit: cover;">
                                                
                                            <div class="position-absolute top-0 <?php echo $isRtl ? 'end-0' : 'start-0'; ?> p-3">
                                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                                    <?php echo htmlspecialchars($isRtl ? 
                                                        (isset($latest_posts[0]['category_name']) ? $latest_posts[0]['category_name'] : '') : 
                                                        (isset($latest_posts[0]['category_name_en']) ? $latest_posts[0]['category_name_en'] : '')
                                                    ); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="blog-content p-4 h-100 d-flex flex-column">
                                            <div class="blog-date mb-3">
                                                <span class="text-muted">
                                                    <?php 
                                                    if ($isRtl && function_exists('gregorianToJalali')) {
                                                        echo gregorianToJalali($latest_posts[0]['publish_date'], true);
                                                    } else {
                                                        echo date('j F Y', strtotime($latest_posts[0]['publish_date']));
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            
                                            <h3 class="blog-title h4 fw-bold mb-3">
                                                <a href="post.php?id=<?php echo $latest_posts[0]['id']; ?>&lang=<?php echo $current_language; ?>" 
                                                class="text-dark text-decoration-none">
                                                    <?php echo htmlspecialchars($isRtl ? $latest_posts[0]['title'] : $latest_posts[0]['title_en']); ?>
                                                </a>
                                            </h3>
                                            
                                            <p class="blog-excerpt flex-grow-1">
                                                <?php 
                                                $content = $isRtl ? 
                                                    (isset($latest_posts[0]['content1']) ? $latest_posts[0]['content1'] : '') : 
                                                    (isset($latest_posts[0]['content1_en']) ? $latest_posts[0]['content1_en'] : '');
                                                    
                                                if (function_exists('truncateText')) {
                                                    echo truncateText($content, 200);
                                                } else {
                                                    $max_length = 200;
                                                    if (mb_strlen($content) > $max_length) {
                                                        echo htmlspecialchars(mb_substr($content, 0, $max_length)) . '...';
                                                    } else {
                                                        echo htmlspecialchars($content);
                                                    }
                                                }
                                                ?>
                                            </p>
                                            
                                            <a href="post.php?id=<?php echo $latest_posts[0]['id']; ?>&lang=<?php echo $current_language; ?>" 
                                            class="read-more text-primary fw-bold text-decoration-none mt-3">
                                                <?php echo $isRtl ? 'ادامه مطلب' : 'Read More'; ?>
                                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?> ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Regular Blog Posts -->
                        <?php 
                        // Skip the first post and loop through the rest
                        for ($i = 1; $i < count($latest_posts); $i++): 
                            $post = $latest_posts[$i];
                            $image_path = 'assets/images/blog/' . (!empty($post['main_image']) ? 
                                $post['main_image'] : 'blog-default.jpg');
                        ?>
                        <div class="col-md-6">
                            <div class="blog-card h-100 bg-white shadow rounded-4 overflow-hidden">
                                <div class="blog-image position-relative">
                                    <img src="<?php echo htmlspecialchars($image_path); ?>" 
                                        alt="<?php echo htmlspecialchars($isRtl ? $post['title'] : $post['title_en']); ?>"
                                        class="img-fluid w-100" style="height: 240px; object-fit: cover;">
                                        
                                    <div class=" position-absolute top-0 <?php echo $isRtl ? 'end-0' : 'start-0'; ?> p-3">
                                        <span class="badge bg-primary rounded-pill px-3 py-2">
                                            <?php echo htmlspecialchars($isRtl ? 
                                                (isset($post['category_name']) ? $post['category_name'] : '') : 
                                                (isset($post['category_name_en']) ? $post['category_name_en'] : '')
                                            ); ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="blog-content p-4">
                                    <div class="blog-date mb-3">
                                        <span class="text-muted">
                                            <?php 
                                            if ($isRtl && function_exists('gregorianToJalali')) {
                                                echo gregorianToJalali($post['publish_date'], true);
                                            } else {
                                                echo date('j F Y', strtotime($post['publish_date']));
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    
                                    <h3 class="blog-title h5 fw-bold mb-3">
                                        <a href="post.php?id=<?php echo $post['id']; ?>&lang=<?php echo $current_language; ?>" 
                                        class="text-dark text-decoration-none">
                                            <?php echo htmlspecialchars($isRtl ? $post['title'] : $post['title_en']); ?>
                                        </a>
                                    </h3>
                                    
                                    <p class="blog-excerpt">
                                        <?php 
                                        $content = $isRtl ? 
                                            (isset($post['content1']) ? $post['content1'] : '') : 
                                            (isset($post['content1_en']) ? $post['content1_en'] : '');
                                            
                                        if (function_exists('truncateText')) {
                                            echo truncateText($content, 120);
                                        } else {
                                            $max_length = 120;
                                            if (mb_strlen($content) > $max_length) {
                                                echo htmlspecialchars(mb_substr($content, 0, $max_length)) . '...';
                                            } else {
                                                echo htmlspecialchars($content);
                                            }
                                        }
                                        ?>
                                    </p>
                                    
                                    <a href="post.php?id=<?php echo $post['id']; ?>&lang=<?php echo $current_language; ?>" 
                                    class="read-more text-primary fw-bold text-decoration-none">
                                        <?php echo $isRtl ? 'ادامه مطلب' : 'Read More'; ?>
                                        <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?> ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                    
                    <!-- Mobile View More Button -->
                    <div class="row mt-5">
                        <div class="col-12 d-md-none text-center">
                            <a href="blog.php<?php echo '?lang=' . $current_language; ?>" class="btn btn-primary rounded-pill px-4 py-2">
                                <?php echo $isRtl ? 'مشاهده همه اخبار' : 'View All News'; ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?> ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <style>
                /* Blog Section Styles */
                .blog-card {
                    transition: all 0.3s ease;
                    border: none;
                }

                .blog-card:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
                }

                .blog-image {
                    overflow: hidden;
                }

                .blog-image img {
                    transition: transform 0.5s ease;
                }

                .blog-card:hover .blog-image img {
                    transform: scale(1.05);
                }

                .blog-title a {
                    transition: color 0.3s ease;
                }

                .blog-title a:hover {
                    color: var(--bs-primary) !important;
                }

                .blog-date {
                    font-size: 0.85rem;
                }

                .blog-excerpt {
                    color: #6c757d;
                    line-height: 1.6;
                }

                .read-more {
                    font-size: 0.95rem;
                    display: inline-flex;
                    align-items: center;
                }

                .read-more i {
                    transition: transform 0.3s ease;
                    margin-<?php echo $isRtl ? 'right' : 'left'; ?>: 5px;
                }

                .read-more:hover i {
                    transform: translateX(<?php echo $isRtl ? '-5px' : '5px'; ?>);
                }

                .featured-post {
                    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
                }

                @media (max-width: 991.98px) {
                    .featured-post .blog-image {
                        height: 300px;
                    }
                }
            </style>
            <script>
                $(document).ready(function() {
                    // Add animation to blog cards
                    $(".blog-card").each(function(index) {
                        $(this).css({
                            'opacity': '0',
                            'transform': 'translateY(20px)'
                        });
                        
                        setTimeout(function() {
                            $(this).css({
                                'transition': 'all 0.5s ease',
                                'opacity': '1',
                                'transform': 'translateY(0)'
                            });
                        }.bind(this), 100 * index);
                    });
                });
            </script>

        <!-- Video Tour Section -->
        <section class="video-tour-section position-relative">
            <!-- Video Container with Parallax Effect -->
            <div class="video-tour-wrapper position-relative overflow-hidden" style="height: 600px;">
                <!-- Video Thumbnail Image -->
                <div class="video-thumbnail position-absolute w-100 h-100">
                    <img src="assets/images/resources/video-thumbnail.jpg" 
                        alt="<?php echo $isRtl ? 'تور مجازی مدرسه سلمان فارسی' : 'Salman Farsi School Virtual Tour'; ?>" 
                        class="w-100 h-100 object-fit-cover" id="videoThumbnail">
                        
                    <!-- Particle Overlay (Stars Effect) -->
                    <div class="particles-js position-absolute top-0 start-0 w-100 h-100" id="particles-js"></div>
                    
                    <!-- Dark Gradient Overlay -->
                    <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
                        style="background: linear-gradient(to bottom, rgba(13, 16, 45, 0.7), rgba(13, 16, 45, 0.9))"></div>
                </div>
                
                <!-- Content Overlay -->
                <div class="video-tour-content position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center text-white p-4 z-1">
                    <div class="container">
                        <h2 class="video-tour-title display-4 fw-bold mb-4 animate__animated animate__fadeInDown" style="color: rgba(255, 255, 255, 0.8);">
                            <?php echo $isRtl ? 'بازدید مجازی سلمان فارسی' : 'Salman Farsi Virtual Tour'; ?>
                        </h2>
                        
                        <p class="video-tour-description fs-5 mb-5 mx-auto animate__animated animate__fadeInUp" style="max-width: 800px;">
                            <?php echo $isRtl ? 'از فضای مدرسه، کلاس‌ها، آزمایشگاه‌ها و امکانات ورزشی بازدید کنید و با محیط آموزشی ما آشنا شوید.' : 'Explore our school grounds, classrooms, laboratories, and sports facilities to get familiar with our educational environment.'; ?>
                        </p>
                        
                        <!-- Play Button with Pulse Effect -->
                        <div class="video-play-container position-relative animate__animated animate__zoomIn">
                            <a href="#" class="video-play-btn d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-lg" 
                            style="width: 90px; height: 90px;" 
                            data-bs-toggle="modal" data-bs-target="#videoModal">
                                <i class="fas fa-play fs-3" style="margin-left: 5px;"></i>
                            </a>
                            
                            <!-- Pulsing Circles -->
                            <div class="pulse-circles position-absolute top-0 start-0 w-100 h-100">
                                <div class="pulse-circle position-absolute top-0 start-0 w-100 h-100 rounded-circle"></div>
                                <div class="pulse-circle position-absolute top-0 start-0 w-100 h-100 rounded-circle" style="animation-delay: 1s;"></div>
                            </div>
                        </div>
                        
                        <!-- Video Info Badge -->
                        <div class="video-info-badge d-inline-block mt-5 py-2 px-4 rounded-pill bg-white bg-opacity-10 animate__animated animate__fadeInUp animate__delay-1s">
                            <i class="fas fa-clock me-2 text-primary"></i>
                            <span class="video-duration" style="color: rgb(0, 0, 0);"><?php echo $isRtl ? '۳ دقیقه و ۴۵ ثانیه' : '3:45 minutes'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Video Modal -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-dark">
                        <div class="modal-header border-0">
                            <h5 class="modal-title text-white" id="videoModalLabel">
                                <?php echo $isRtl ? 'تور مجازی مدرسه سلمان فارسی' : 'Salman Farsi School Virtual Tour'; ?>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="ratio ratio-16x9">
                                <iframe id="videoIframe" src="about:blank" allowfullscreen allow="autoplay; encrypted-media" class="rounded"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            /* Video Tour Section Styles */
            .video-tour-wrapper {
                background-color: #0d102d;
            }

            .video-thumbnail img {
                transition: transform 8s ease;
            }

            .video-thumbnail:hover img {
                transform: scale(1.05);
            }

            .video-play-btn {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                z-index: 2;
            }

            .video-play-btn:hover {
                transform: scale(1.1);
                box-shadow: 0 0 0 15px rgba(var(--bs-primary-rgb), 0.2), 0 0 30px rgba(var(--bs-primary-rgb), 0.4) !important;
            }

            .pulse-circle {
                border: 2px solid rgba(var(--bs-primary-rgb), 0.8);
                animation: pulse 2.5s infinite;
                opacity: 0;
            }

            @keyframes pulse {
                0% {
                    transform: scale(0.95);
                    opacity: 0.9;
                }
                70% {
                    transform: scale(1.5);
                    opacity: 0;
                }
                100% {
                    transform: scale(1.5);
                    opacity: 0;
                }
            }

            /* Particle Canvas */
            #particles-js canvas {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            /* Animation for parallax effect */
            .parallax-bg {
                transform: translateY(0);
                transition: transform 0.5s ease-out;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize particles.js
                if (typeof particlesJS !== 'undefined') {
                    particlesJS('particles-js', {
                        "particles": {
                            "number": {
                                "value": 80,
                                "density": {
                                    "enable": true,
                                    "value_area": 800
                                }
                            },
                            "color": {
                                "value": "#ffffff"
                            },
                            "shape": {
                                "type": "circle"
                            },
                            "opacity": {
                                "value": 0.5,
                                "random": true
                            },
                            "size": {
                                "value": 3,
                                "random": true
                            },
                            "line_linked": {
                                "enable": false
                            },
                            "move": {
                                "enable": true,
                                "speed": 1,
                                "direction": "none",
                                "random": true,
                                "straight": false,
                                "out_mode": "out"
                            }
                        },
                        "interactivity": {
                            "detect_on": "canvas",
                            "events": {
                                "onhover": {
                                    "enable": true,
                                    "mode": "bubble"
                                },
                                "onclick": {
                                    "enable": true,
                                    "mode": "repulse"
                                }
                            },
                            "modes": {
                                "bubble": {
                                    "distance": 150,
                                    "size": 5,
                                    "duration": 2,
                                    "opacity": 0.8,
                                    "speed": 3
                                },
                                "repulse": {
                                    "distance": 200,
                                    "duration": 0.4
                                }
                            }
                        }
                    });
                }
                
                // Parallax effect on scroll
                const videoThumbnail = document.getElementById('videoThumbnail');
                window.addEventListener('scroll', function() {
                    const scrollPosition = window.scrollY;
                    const videoSection = document.querySelector('.video-tour-section');
                    const rect = videoSection.getBoundingClientRect();
                    
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const scrollPercentage = 1 - (rect.top / window.innerHeight);
                        videoThumbnail.style.transform = `scale(${1 + scrollPercentage * 0.1}) translateY(${scrollPercentage * -30}px)`;
                    }
                });
                
                // Video Modal Functionality
                const videoModal = document.getElementById('videoModal');
                const videoIframe = document.getElementById('videoIframe');
                const videoSrc = 'assets/videos/school-intro.mp4'; // Replace with your actual video source
                
                videoModal.addEventListener('show.bs.modal', function () {
                    videoIframe.src = videoSrc;
                });
                
                videoModal.addEventListener('hidden.bs.modal', function () {
                    videoIframe.src = 'about:blank';
                });
            });
        </script>
        <!-- FAQ Section -->
        <section class="faq-section" id="faq">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="section-subtitle"><?php echo $isRtl ? 'سوالات متداول' : 'Frequently Asked Questions'; ?></span>
                    <h2 class="section-heading">
                        <?php echo $isRtl ? 'پاسخ به <span class="text-underline">سوالات</span> متداول شما' : 'Answers to Your <span class="text-underline">Common</span> Questions'; ?>
                    </h2>
                    <div class="section-divider"></div>
                    <p class="section-description text-center">
                        <?php echo $isRtl ? 'پاسخ سوالات شایع در مورد مدرسه از جمله پذیرش، شهریه و برنامه‌های آموزشی را اینجا بیابید.' : 'Find answers to common questions about the school including admissions, tuition, and educational programs.'; ?>
                    </p>
                </div>
                
                <div class="faq-container">
                    <?php if (!empty($faqs)): ?>
                        <?php foreach ($faqs as $index => $faq): ?>
                            <div class="faq-item<?php echo $index === 0 ? ' active' : ''; ?>">
                                <div class="faq-question">
                                    <span><?php echo htmlspecialchars($isRtl ? $faq['question_fa'] : $faq['question_en']); ?></span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">
                                    <div class="faq-answer-content">
                                        <?php echo $isRtl ? $faq['answer_fa'] : $faq['answer_en']; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Fallback FAQs if no data from database -->
                        <div class="faq-item active">
                            <div class="faq-question">
                                <span><?php echo $isRtl ? 'زبان تدریس در مدرسه چه زبان‌هایی است؟' : 'What languages are used for instruction at the school?'; ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p><?php echo $isRtl ? 'زبان تدریس اصلی در مدرسه ما فارسی است، با این حال، زبان‌های انگلیسی و عربی نیز در برنامه درسی گنجانده شده‌اند تا مهارت‌های زبانی دانش‌آموزان تقویت شود.' : 'The primary language of instruction at our school is Persian, while English and Arabic are also included in the curriculum to enhance students\' language skills.'; ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question">
                                <span><?php echo $isRtl ? 'نحوه ثبت‌نام در مدرسه چیست و مدارک و زمان‌بندی ثبت‌نام چگونه است؟' : 'What is the registration process, and what are the required documents and timeline?'; ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p><?php echo $isRtl ? 'برای ثبت‌نام در مدرسه، والدین باید به صورت حضوری مراجعه کرده و مدارک مورد نیاز شامل شناسنامه، کارت ملی، گواهی سلامت، عکس پرسنلی و مدارک تحصیلی قبلی را ارائه دهند. لطفاً برای اطلاعات دقیق‌تر و مطمئن‌شدن از مدارک لازم، قبل از مراجعه حضوری با مدرسه تماس بگیرید. ثبت‌نام در ماه‌های خرداد و تیر انجام می‌شود و در صورتی که بعد از این زمان ثبت‌نام صورت گیرد، هزینه‌ای تحت عنوان جریمه دریافت خواهد شد.' : 'To register at the school, parents need to visit the school in person and provide required documents such as birth certificate, ID card, health certificate, passport-sized photo, and previous academic records. For detailed information and to confirm the necessary documents, please contact the school before visiting. Registration typically occurs in June and July, and late registrations will incur an additional penalty fee.'; ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question">
                                <span><?php echo $isRtl ? 'هزینه‌های شهریه مدرسه چقدر است و شامل چه مواردی می‌شود؟' : 'What are the tuition fees and what do they cover?'; ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p><?php echo $isRtl ? 'هزینه‌های شهریه بر اساس مقطع تحصیلی و رشته انتخابی متفاوت است. شهریه شامل هزینه‌های آموزشی، کتاب‌های درسی، فعالیت‌های فوق‌برنامه و خدمات پایه مدرسه می‌شود. برای اطلاعات دقیق‌تر، لطفاً با بخش مالی مدرسه تماس بگیرید.' : 'Tuition fees vary depending on the grade level and chosen specialization. The fees cover educational costs, textbooks, extracurricular activities, and basic school services. For more precise details, please contact the school\'s finance department.'; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="faq-more">
                    <a href="faq.php" class="btn btn-primary">
                        <?php echo $isRtl ? 'مشاهده همه سوالات متداول' : 'View All FAQs'; ?>
                        <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section py-5 position-relative overflow-hidden">
            <!-- Background Gradient -->
            <div class="cta-bg position-absolute top-0 start-0 w-100 h-100" 
                style="background: linear-gradient(135deg,rgb(21, 28, 169) 0%, #FF6B8B 100%); z-index: -2;"></div>
            
            <!-- Animated Shapes -->
            <div class="animated-shapes">
                <!-- Floating Circles -->
                <div class="shape shape-circle position-absolute bg-white bg-opacity-10 rounded-circle" 
                    style="width: 150px; height: 150px; top: -50px; left: 10%; animation: float 8s ease-in-out infinite;"></div>
                <div class="shape shape-circle position-absolute bg-white bg-opacity-10 rounded-circle" 
                    style="width: 100px; height: 100px; bottom: -30px; right: 15%; animation: float 6s ease-in-out infinite;"></div>
                
                <!-- Floating Blobs -->
                <div class="shape shape-blob position-absolute bg-white bg-opacity-10" 
                    style="width: 200px; height: 200px; top: 20%; right: -50px; border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; animation: float 10s ease-in-out infinite alternate;"></div>
                <div class="shape shape-blob position-absolute bg-white bg-opacity-10" 
                    style="width: 180px; height: 180px; bottom: 10%; left: -50px; border-radius: 40% 60% 70% 30% / 40% 60% 30% 70%; animation: float 8s ease-in-out infinite 1s alternate;"></div>
            </div>
            
            <!-- Star Pattern Overlay -->
            <div class="star-pattern position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAiPjwvcmVjdD4KPHBhdGggZD0iTTAgNUw1IDBaTTYgNEw0IDZaTS0xIDFMMSAtMVoiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLW9wYWNpdHk9IjAuMDUiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4='); z-index: -1; opacity: 0.4;"></div>
            
            <div class="container position-relative z-1">
                <div class="cta-content text-center text-white mx-auto" style="max-width: 800px;">
                    <!-- Animated Badge -->
                    <div class="cta-badge d-inline-block mb-4">
                        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fw-semibold animate__animated animate__fadeInDown">
                            <?php echo $isRtl ? 'ثبت‌نام سال تحصیلی ' : ' Enrollment Open'; ?>
                        </span>
                    </div>
                    
                    <h2 class="cta-title display-4 fw-bold mb-4 animate__animated animate__fadeInUp">
                        <?php echo $isRtl ? 'به خانواده سلمان فارسی بپیوندید' : 'Join the Salman Farsi Family'; ?>
                    </h2>
                    
                    <p class="cta-text fs-5 mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                        <?php echo $isRtl ? 'برای ثبت‌نام فرزندان خود در مجتمع آموزشی سلمان فارسی و بهره‌مندی از آموزش باکیفیت ایرانی در دبی، همین امروز اقدام کنید.' : 'To register your children at Salman Farsi Educational Complex and benefit from quality Iranian education in Dubai, take action today.'; ?>
                    </p>
                    
                    <div class="cta-buttons d-flex flex-column flex-md-row justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="Terms and Conditions for Registration.php" class="btn btn-light btn-lg rounded-pill px-5 py-3 text-primary fw-semibold shadow-lg hover-scale">
                            <i class="fas fa-user-plus me-2"></i>
                            <?php echo $isRtl ? 'ثبت‌نام آنلاین' : 'Online Registration'; ?>
                        </a>
                        
                        <a href="contact.php" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-semibold hover-scale">
                            <i class="fas fa-envelope me-2"></i>
                            <?php echo $isRtl ? 'تماس با ما' : 'Contact Us'; ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <style>
            /* CTA Section Styles */
            @keyframes float {
                0% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-20px);
                }
                100% {
                    transform: translateY(0);
                }
            }

            .hover-scale {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .hover-scale:hover {
                transform: scale(1.05);
            }

            .btn-light {
                position: relative;
                overflow: hidden;
                z-index: 1;
            }

            .btn-light:after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 75%);
                z-index: -1;
            }

            .time-block {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .time-block:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Countdown Timer Functionality
                function updateCountdown() {
                    // Set the deadline date (you can change this to your actual deadline)
                    const deadline = new Date("2024-07-31T23:59:59").getTime();
                    const now = new Date().getTime();
                    const timeLeft = deadline - now;
                    
                    // If time is up
                    if (timeLeft <= 0) {
                        document.getElementById('countdown-days').innerText = '00';
                        document.getElementById('countdown-hours').innerText = '00';
                        document.getElementById('countdown-minutes').innerText = '00';
                        document.getElementById('countdown-seconds').innerText = '00';
                        return;
                    }
                    
                    // Calculate days, hours, minutes, seconds
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    
                    // Add leading zeros if needed
                    document.getElementById('countdown-days').innerText = days < 10 ? '0' + days : days;
                    document.getElementById('countdown-hours').innerText = hours < 10 ? '0' + hours : hours;
                    document.getElementById('countdown-minutes').innerText = minutes < 10 ? '0' + minutes : minutes;
                    document.getElementById('countdown-seconds').innerText = seconds < 10 ? '0' + seconds : seconds;
                }
                
                // Update countdown every second
                updateCountdown();
                setInterval(updateCountdown, 1000);
                
                // Animate elements when they come into view
                const animateOnScroll = function() {
                    const ctaSection = document.querySelector('.cta-section');
                    if (ctaSection) {
                        const rect = ctaSection.getBoundingClientRect();
                        if (rect.top < window.innerHeight && rect.bottom > 0) {
                            // Add animate.css classes to elements when they enter viewport
                            const elements = ctaSection.querySelectorAll('.animate__animated');
                            elements.forEach(element => {
                                element.classList.add('animate__visible');
                            });
                            
                            // Stop checking once animations have been triggered
                            window.removeEventListener('scroll', animateOnScroll);
                        }
                    }
                };
                
                window.addEventListener('scroll', animateOnScroll);
                // Check on load too
                animateOnScroll();
            });
        </script>
        <!-- Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel"><?php echo $isRtl ? 'تور مجازی مدرسه سلمان فارسی' : 'Salman Farsi School Virtual Tour'; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="about:blank" data-src="assets/videos/school-intro.mp4" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (needed for Owl Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Particles.js for Video Tour section -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            'use strict';

            // Testimonials Carousel
            $('.testimonial-carousel').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                navText: [
                    '<span>&lsaquo;</span>',
                    '<span>&rsaquo;</span>'
                ],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    992: { items: 3 }
                }
            });
            
            // FAQ Accordion
            $('.faq-question').on('click', function() {
                $(this).parent().toggleClass('active').siblings().removeClass('active');
            });
            
            // Video Modal
            $('#videoModal').on('show.bs.modal', function () {
                var iframe = $(this).find('iframe');
                var src = iframe.data('src');
                iframe.attr('src', src);
            });
            
            $('#videoModal').on('hidden.bs.modal', function () {
                var iframe = $(this).find('iframe');
                iframe.attr('src', 'about:blank');
            });
            
            // Back to Top
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 400) {
                    $('#backToTop').addClass('active');
                } else {
                    $('#backToTop').removeClass('active');
                }
            });
            
            $('#backToTop').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            });
            
            // Smooth Scroll for Anchor Links
            $('a[href^="#"]:not([href="#"])').on('click', function(e) {
                e.preventDefault();
                var target = $($(this).attr('href'));
                
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                }
            });
            
            // Animate stat numbers
            function animateStats() {
                $('.stat-number').each(function() {
                    var $this = $(this);
                    var countTo = $this.attr('data-count');
                    
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
                });
            }
            
            // Run stats animation when stats section is in viewport
            function isScrolledIntoView(elem) {
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height();
                var elemTop = $(elem).offset().top;
                var elemBottom = elemTop + $(elem).height();
                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }
            
            // Initialize stats animation when visible
            var statsAnimated = false;
            $(window).scroll(function() {
                if (!statsAnimated && isScrolledIntoView($('.stats-section'))) {
                    animateStats();
                    statsAnimated = true;
                }
            });
            
            // Trigger scroll event to check if stats section is already visible
            $(window).trigger('scroll');
        });
    </script>
</body>
</html>