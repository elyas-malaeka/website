<?php
/**
 * صفحه سوالات متداول (FAQ) با طراحی مدرن
 * 
 * نمایش سوالات متداول با سیستم ترجمه و طراحی مدرن
 * با پشتیبانی از جستجو و سیستم تب‌بندی دسته‌بندی‌ها
 * 
 * @package Salman Educational Complex
 * @version 4.0
 */

// Include configuration file
require_once 'includes/config.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa' || $lang == 'ar');

// Organize FAQ categories
$faqCategories = [
    'general' => [
        'title' => [
            'en' => 'General Information',
            'fa' => 'اطلاعات عمومی'
        ],
        'icon' => 'fa-info-circle',
        'color' => '#6941C6',
        'questions' => ['faq_language_title', 'faq_hours_title', 'faq_curriculum_title', 'faq_extracurricular_title']
    ],
    'admissions' => [
        'title' => [
            'en' => 'Admissions & Registration',
            'fa' => 'پذیرش و ثبت‌نام'
        ],
        'icon' => 'fa-user-plus',
        'color' => '#9E77ED',
        'questions' => ['faq_registration_title', 'faq_tuition_title', 'faq_documents_title', 'faq_age_requirements_title']
    ],
    'services' => [
        'title' => [
            'en' => 'School Services',
            'fa' => 'خدمات مدرسه'
        ],
        'icon' => 'fa-hands-helping',
        'color' => '#7F56D9',
        'questions' => ['faq_transportation_title', 'faq_special_support_title', 'faq_cafeteria_title', 'faq_healthcare_title']
    ],
    'academics' => [
        'title' => [
            'en' => 'Academic Information',
            'fa' => 'اطلاعات تحصیلی'
        ],
        'icon' => 'fa-graduation-cap',
        'color' => '#4E36B1',
        'questions' => ['faq_assessment_title', 'faq_international_exams_title', 'faq_homework_title', 'faq_counseling_title']
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo t('faq', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    
    <!-- Template Styles -->
    <link rel="stylesheet" href="assets/css/salman.css" />
    
    <!-- FAQ Specific Styles -->
    <link rel="stylesheet" href="assets/css/faq.css" />
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Modern FAQ Header with Search -->
        <section class="faq-header">
            <!-- Cosmic Background Effect -->
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars are generated via JS -->
            </div>
            
            <div class="container">
                <div class="faq-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="faq-header__title" style="font-family:vazir">
                        <?php echo t('frequently_asked_questions', $lang); ?>
                    </h1>
                    <p class="faq-header__subtitle">
                        <?php echo t('faq_subtitle', $lang); ?>
                    </p>
                    
                    <!-- Search Bar -->
                    <div class="faq-search wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" id="faqSearch" class="faq-search__input" placeholder="<?php echo t('faq_search_placeholder', $lang); ?>">
                        <button class="faq-search__btn" aria-label="<?php echo $lang == 'fa' ? 'جستجو' : 'Search'; ?>">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main FAQ Content -->
        <section class="faq-content">
            <div class="container">
                <div class="row">
                    <!-- FAQ Sidebar (Left Column) -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="faq-sidebar wow fadeInLeft" data-wow-delay="400ms">
                            <!-- Decorative shapes -->
                            <div class="faq-sidebar__shape"></div>
                            <div class="faq-sidebar__shape"></div>
                            
                            <h2 class="faq-sidebar__title">
                                <?php echo $lang == 'fa' ? 'به دنبال ثبت‌نام هستید؟' : 'Looking to Register?'; ?>
                            </h2>
                            <p class="faq-sidebar__text">
                                <?php echo $lang == 'fa' 
                                    ? 'برای کسب اطلاعات بیشتر درباره شرایط و ضوابط ثبت‌نام و مدارک مورد نیاز، با ما تماس بگیرید.' 
                                    : 'Contact us for more information about registration requirements.'; ?>
                            </p>
                            <a href="Terms and Conditions for Registration.php<?php echo '?lang=' . $lang; ?>" class="faq-sidebar__btn">
                                <i class="fas fa-file-alt"></i>
                                <?php echo $lang == 'fa' ? 'شرایط و ضوابط ثبت‌نام' : 'Registration Terms'; ?>
                            </a>
                            
                            <!-- Divider -->
                            <div class="faq-sidebar__divider"></div>
                            
                            <!-- Still Have Questions Section -->
                            <h3 class="faq-sidebar__title" style="font-size: 22px;">
                                <?php echo t('faq_more_questions', $lang); ?>
                            </h3>
                            <p class="faq-sidebar__text">
                                <?php echo t('faq_contact_us_text', $lang); ?>
                            </p>
                            <a href="contact.php<?php echo '?lang=' . $lang; ?>" class="faq-sidebar__btn">
                                <i class="fas fa-envelope"></i>
                                <?php echo t('contact_us', $lang); ?>
                            </a>
                        </div>
                    </div>
                    
                    <!-- FAQ Content (Right Column) -->
                    <div class="col-lg-8">
                        <div class="faq-main wow fadeInRight" data-wow-delay="400ms">
                            <!-- Tab Navigation -->
                            <div class="faq-nav">
                                <?php $firstCategory = true; foreach ($faqCategories as $categoryId => $category): ?>
                                <button class="faq-nav__item <?php echo $firstCategory ? 'active' : ''; ?>" data-category="<?php echo $categoryId; ?>">
                                    <span class="faq-nav__icon">
                                        <i class="fas <?php echo $category['icon']; ?>"></i>
                                    </span>
                                    <span><?php echo $category['title'][$lang]; ?></span>
                                </button>
                                <?php $firstCategory = false; endforeach; ?>
                            </div>
                            
                            <!-- FAQ Categories -->
                            <?php $firstCategory = true; foreach ($faqCategories as $categoryId => $category): ?>
                            <div id="<?php echo $categoryId; ?>" class="faq-category <?php echo $firstCategory ? 'active' : ''; ?>">
                                <div class="faq-category__header">
                                    <div class="faq-category__icon" style="background-color: <?php echo $category['color']; ?>">
                                        <i class="fas <?php echo $category['icon']; ?>"></i>
                                    </div>
                                    <h2 class="faq-category__title"><?php echo $category['title'][$lang]; ?></h2>
                                </div>
                                
                                <div class="faq-items">
                                    <?php $firstItem = true; foreach ($category['questions'] as $questionKey): ?>
                                    <div class="faq-item <?php echo $firstItem ? 'active' : ''; ?>">
                                        <button class="faq-question">
                                            <?php echo t($questionKey, $lang); ?>
                                            <span class="faq-icon">
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                        </button>
                                        <div class="faq-answer">
                                            <p><?php echo t(str_replace('_title', '_answer', $questionKey), $lang); ?></p>
                                        </div>
                                    </div>
                                    <?php $firstItem = false; endforeach; ?>
                                </div>
                            </div>
                            <?php $firstCategory = false; endforeach; ?>
                            
                            <!-- No Results Message (initially hidden) -->
                            <div id="noResults" class="no-results">
                                <div class="no-results__icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h3 class="no-results__title">
                                    <?php echo t('faq_no_results', $lang); ?>
                                </h3>
                                <p class="no-results__text">
                                    <?php echo t('faq_try_again', $lang); ?>
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
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- FAQ Specific Scripts -->
    <script src="assets/js/faq.js"></script>
</body>
</html>