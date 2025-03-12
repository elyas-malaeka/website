<?php
/**
 * Terms and Conditions for Registration Page
 * 
 * This file contains the registration terms, requirements, fees information,
 * and payment methods for Salman Educational Complex.
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
    <title><?php echo t('registration_terms_title', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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

    <!-- Custom Styles for Registration Terms Page -->
    <link rel="stylesheet" href="assets/css/terms-registration.css" />
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Header Section -->
        <section class="terms-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="terms-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="terms-header__title">
                        <?php echo t('registration_terms_title', $lang); ?>
                    </h1>
                    <p class="terms-header__subtitle">
                        <?php echo $lang == 'fa' ? 'اطلاعات مهم درباره ثبت‌نام، مدارک مورد نیاز، هزینه‌ها و روش‌های پرداخت' : 'Important information about registration, required documents, fees, and payment methods'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content Section for Terms and Registration -->
        <section class="terms-registration-section">
            <div class="container">
                <div class="row">
                    <!-- Left Content Column -->
                    <div class="col-lg-8">
                        <!-- Registration Instructions -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="100ms">
                            <h3 class="section-title">
                                <i class="fas fa-clipboard-list section-icon"></i>
                                <?php echo t('registration_instructions', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <div class="documents-required">
                                    <h4><?php echo t('required_documents', $lang); ?></h4>
                                    <p><?php echo t('documents_ready', $lang); ?></p>
                                    <ul class="check-list">
                                        <li><span class="icon"><i class="fas fa-check"></i></span> <?php echo t('passport_photo', $lang); ?></li>
                                        <li><span class="icon"><i class="fas fa-check"></i></span> <?php echo t('emirates_id', $lang); ?></li>
                                        <li><span class="icon"><i class="fas fa-check"></i></span> <?php echo t('passport_copy', $lang); ?></li>
                                        <li><span class="icon"><i class="fas fa-check"></i></span> <?php echo t('birth_certificate', $lang); ?></li>
                                        <li><span class="icon"><i class="fas fa-check"></i></span> <?php echo t('national_id', $lang); ?></li>
                                        <li><span class="icon"><i class="fas fa-check"></i></span> <?php echo t('academic_certificate', $lang); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Transportation Services -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="200ms">
                            <h3 class="section-title">
                                <i class="fas fa-bus-alt section-icon"></i>
                                <?php echo t('transportation_services', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <p>
                                    <?php echo t('transportation_info', $lang); ?>
                                    <strong><?php echo t('coordinator', $lang); ?></strong> 
                                    <?php echo t('contact', $lang); ?>
                                    <a href="tel:+971507840067" class="highlight-phone <?php echo $isRtl ? 'numbers-ltr' : ''; ?>">
                                        <?php echo formatPhone('+971507840067', $lang); ?>
                                    </a>
                                    
                                    <?php echo t('rta_regulations', $lang); ?>
                                </p>
                                
                                <div class="transportation-routes">
                                    <h4><?php echo t('transportation_routes', $lang); ?></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered route-table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo t('route', $lang); ?></th>
                                                    <th><?php echo t('stops', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><?php echo $lang == 'fa' ? 'قافیه - مدرسه شارجه - میدان اول التعاون - المتینه - بازار قدیم - بازار ایرانی - بانک صادرات - بانک ملی - خیابان شاه فیصل - المجاز - القصبا - الرولا - ام خنور - المجاز ۱ و ۲، شارجه' : 'Qafiya - Sharjah School - First Al Taawun Roundabout - Al Muteena - Old Market - Iranian Bazaar - Export Bank - National Bank - King Faisal Road - Al Majaz - Al Qasba - Al Rolla - Umm Khanour - Al Majaz 1 & 2, Sharjah'; ?></td>
                                                </tr>
                                                <tr>
                                                <td>2</td>
                                                    <td><?php echo $lang == 'fa' ? 'خیابان اصلی منطقه صنعتی - الروضه ۱ و ۲ - الحمیدیه - المویهات - الجرف - جاده شیخ بن زاید - الیاسمین - خان صاحب' : 'Industrial Area Main Street - Al Rawda 1 & 2 - Al Hamidiya - Al Mowaihat - Al Jurf - Sheikh Bin Zayed Road - Al Yasmeen - Khansaheb'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td><?php echo $lang == 'fa' ? 'عجمان، بیمارستان GMC - تقاطع کویت - النعیمیه ۲ و ۳ - بازارهای العین - کورنیش - الرشیدیه - بازار ماهی - برج‌های الخور - منطقه الکرامه - پارک مشیرف، عجمان' : 'Ajman, GMC Hospital - Kuwait Junction - Al Nuaimiya 2 & 3 - Al Ain Markets - Al Corniche - Al Rashidiya - Fish Market - Al Khor Towers - Al Karama Area - Mushairif Park, Ajman'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td><?php echo $lang == 'fa' ? 'الصفا - مردیف - الرشیدیه - ند الحمر - الورقاء - عود المتینه - محیصنه ۲ - القصیص - مردیف سیتی' : 'Al Safa - Mirdif - Al Rashidiya - Nad Al Hamar - Al Warqa - Oud Al Muteena - Muhaisnah 2 - Al Qusais - Mirdif City'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td><?php echo $lang == 'fa' ? 'بر دبی - المنخول - مصلی نزدیک قبرستان - مینا بازار - بندر راشد - تقاطع جافلیه - جاده ستوه - تقاطع الوصل - القوز ۲ و ۴ - پشت اسپینیس، جمیرا' : 'Bur Dubai - Al Mankhool - Musalla near Cemetery - Meena Bazaar - Port Rashid - Jafliya Junction - Satwa Road - Al Wasl Junction - Al Quoz 2 & 4 - Behind Spinneys, Jumeirah'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td><?php echo $lang == 'fa' ? 'پارک النهضه، شارجه - خیابان اصلی التعاون - انصار مال - النهضه شارجه ۲ - مرکز صحارا - پشت اتصالات النهضه - پشت انصار مال' : 'Al Nahda Park, Sharjah - Main Street Al Taawun - Ansar Mall - Al Nahda Sharjah 2 - Sahara Centre - Behind Etisalat Al Nahda - Behind Ansar Mall'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td><?php echo $lang == 'fa' ? 'ابوهیل - هور العنز - المتینه - میدان ماهی - نایف - الکرامه - الحمریه - الراس - النهضه ۲، دبی' : 'Abu Hail - Hor Al Anz - Al Muteena - Fish Roundabout - Naif - Al Karama - Al Hamriya - Al Ras - Al Nahda 2, Dubai'; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tuition Fees -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="300ms">
                            <h3 class="section-title">
                                <i class="fas fa-money-bill-wave section-icon"></i>
                                <?php echo t('tuition_fees_title', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <div class="tuition-fees">
                                    <h4><?php echo t('basic_tuition_fees', $lang); ?></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered fees-table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo t('grade', $lang); ?></th>
                                                    <th><?php echo t('tuition_fee', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo t('grades_1_5', $lang); ?></td>
                                                    <td>4,587 AED</td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo t('grade_6', $lang); ?></td>
                                                    <td>5,633 AED</td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo t('grades_7_8', $lang); ?></td>
                                                    <td>5,285 AED</td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo t('grade_9', $lang); ?></td>
                                                    <td>5,633 AED</td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo t('grades_10_12', $lang); ?></td>
                                                    <td>6,720 AED</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h4><?php echo t('transportation_fees', $lang); ?></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered fees-table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo t('route', $lang); ?></th>
                                                    <th><?php echo t('transportation_fee', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo t('dubai', $lang); ?></td>
                                                    <td>5,750 AED</td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo t('sharjah', $lang); ?></td>
                                                    <td>6,250 AED</td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo t('ajman', $lang); ?></td>
                                                    <td>6,750 AED</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="400ms">
                            <h3 class="section-title">
                                <i class="fas fa-credit-card section-icon"></i>
                                <?php echo t('payment_methods', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <div class="payment-methods">
                                    <ol class="numbered-list">
                                        <li><?php echo t('full_cash_payment', $lang); ?></li>
                                        <li>
                                            <?php echo t('payment_installments', $lang); ?>
                                            <ul class="inner-list">
                                                <li><strong><?php echo t('first_installment', $lang); ?></strong> <?php echo t('first_installment_date', $lang); ?></li>
                                                <li><strong><?php echo t('second_installment', $lang); ?></strong> <?php echo t('second_installment_date', $lang); ?></li>
                                                <li>
                                                    <?php echo t('minimum_payment', $lang); ?>
                                                    <ul class="sub-inner-list">
                                                        <li><strong><?php echo t('primary_level', $lang); ?></strong> 2,500 AED</li>
                                                        <li><strong><?php echo t('middle_school_level', $lang); ?></strong> 3,000 AED</li>
                                                        <li><strong><?php echo t('high_school_level', $lang); ?></strong> 3,200 AED</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>

                                <div class="bank-accounts">
                                    <h4><?php echo t('bank_accounts', $lang); ?></h4>
                                    <ul class="account-list">
                                        <li><span class="icon"><i class="fas fa-university"></i></span> <strong><?php echo t('tuition_account', $lang); ?></strong> Account No. 0101021161720, Bank Melli Iran, Bur Dubai Branch.</li>
                                        <li><span class="icon"><i class="fas fa-university"></i></span> <strong><?php echo t('transportation_account', $lang); ?></strong> Account No. 0101021568820, Bank Melli Iran, Bur Dubai Branch.</li>
                                    </ul>
                                    <p><strong><?php echo t('approved_banks', $lang); ?></strong> Dubai Islamic, Sharjah Islamic Bank, RAK Bank, Commercial Bank of Dubai, Abu Dhabi Union Bank.</p>
                                </div>
                            </div>
                        </div>

                        <!-- School Regulations -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="500ms">
                            <h3 class="section-title">
                                <i class="fas fa-gavel section-icon"></i>
                                <?php echo t('school_regulations', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <p><?php echo t('code_of_conduct', $lang); ?></p>
                                <div class="regulation-action">
                                    <a href="#" class="btn btn-primary terms-btn">
                                        <i class="fas fa-book-open me-2"></i>
                                        <span><?php echo t('read_complete_code', $lang); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar Column -->
                    <div class="col-lg-4">
                        <div class="registration-sidebar wow fadeInRight" data-wow-delay="200ms">
                            <!-- Apply CTA Widget -->
                            <div class="sidebar-widget registration-cta">
                                <h3><?php echo t('apply_today', $lang); ?></h3>
                                <p><?php echo $lang == 'fa' ? 'برای ثبت‌نام در مدرسه سلمان فارسی، فرم آنلاین زیر را تکمیل کنید. فرصت‌های ثبت‌نام محدود است.' : 'To register at Salman Farsi School, complete the online form below. Registration spots are limited.'; ?></p>
                                <a href="Registration/index.php<?php echo '?lang=' . $lang; ?>" class="btn btn-apply">
                                    <i class="fas fa-user-plus me-2"></i>
                                    <span><?php echo t('apply_now', $lang); ?></span>
                                </a>
                            </div>
                            
                            <!-- Contact Info Widget -->
                            <div class="sidebar-widget contact-info">
                                <h3><?php echo t('need_help', $lang); ?></h3>
                                <ul class="contact-list">
                                    <li>
                                        <span class="icon"><i class="fas fa-phone-alt"></i></span>
                                        <div class="text">
                                            <h5><?php echo t('call_us', $lang); ?></h5>
                                            <a href="tel:+97142824214" class="contact-link"><?php echo formatPhone('+97142824214', $lang); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon"><i class="fas fa-envelope"></i></span>
                                        <div class="text">
                                            <h5><?php echo t('email', $lang); ?></h5>
                                            <a href="mailto:info@salmanfarsi.ae" class="contact-link">info@salmanfarsi.ae</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <div class="text">
                                            <h5><?php echo t('visit_us', $lang); ?></h5>
                                            <p><?php echo $lang == 'fa' ? 'القصیص، دبی، امارات متحده عربی' : 'Al Qusais, Dubai, United Arab Emirates'; ?></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Important Dates Widget -->
                            <div class="sidebar-widget important-dates">
                                <h3><?php echo t('important_dates', $lang); ?></h3>
                                <ul class="dates-list">
                                    <li>
                                        <span class="date"><?php echo $lang == 'fa' ? '۱۵ مرداد ۱۴۰۴' : 'Aug 15, 2024'; ?></span>
                                        <p><?php echo t('registration_deadline', $lang); ?></p>
                                    </li>
                                    <li>
                                        <span class="date"><?php echo $lang == 'fa' ? '۲۵ مرداد ۱۴۰۴' : 'Aug 25, 2024'; ?></span>
                                        <p><?php echo t('academic_year_begins', $lang); ?></p>
                                    </li>
                                    <li>
                                        <span class="date"><?php echo $lang == 'fa' ? '۱۰ آذر ۱۴۰۴' : 'Dec 10, 2024'; ?></span>
                                        <p><?php echo t('first_installment_due', $lang); ?></p>
                                    </li>
                                    <li>
                                        <span class="date"><?php echo $lang == 'fa' ? '۱۵ اسفند ۱۴۰۴' : 'Mar 15, 2025'; ?></span>
                                        <p><?php echo t('second_installment_due', $lang); ?></p>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- FAQ Quick Link Widget -->
                            <div class="sidebar-widget faq-link">
                                <h3><?php echo $lang == 'fa' ? 'سؤالات متداول' : 'Frequently Asked Questions'; ?></h3>
                                <p><?php echo $lang == 'fa' ? 'پاسخ سؤالات رایج خود را در صفحه سؤالات متداول ما پیدا کنید.' : 'Find answers to your common questions on our FAQ page.'; ?></p>
                                <a href="faq.php<?php echo '?lang=' . $lang; ?>" class="btn btn-outline">
                                    <i class="fas fa-question-circle me-2"></i>
                                    <span><?php echo $lang == 'fa' ? 'مشاهده سؤالات متداول' : 'View FAQs'; ?></span>
                                </a>
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
    
    <!-- Custom JS for Cosmic Background -->
    <script src="assets/js/cosmic-bg.js"></script>
</body>
</html>