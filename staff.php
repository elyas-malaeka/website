<?php
/**
 * Staff Page
 * 
 * This file displays all staff members of Salman Educational Complex
 * with categorized view by position, filtering, and responsive design.
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
    <title><?php echo t('staff_title', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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
    
    <!-- Staff Page Styles -->
    <link rel="stylesheet" href="assets/css/staff-page.css" />
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Staff Hero Header Section -->
        <section class="staff-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="staff-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="staff-header__title">
                        <?php echo $lang == 'fa' ? 'کارکنان مجتمع' : 'Our Team'; ?>
                    </h1>
                    <p class="staff-header__subtitle">
                        <?php echo $lang == 'fa' ? 'آشنایی با اعضای هیئت علمی و کارکنان مجتمع آموزشی سلمان فارسی' : 'Meet the academic staff and personnel of Salman Farsi Educational Complex'; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Filter and Search Section -->
        <section class="staff-filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="staff-filter-container">
                            <div class="staff-search">
                                <input type="text" id="staff-search-input" placeholder="<?php echo $lang == 'fa' ? 'جستجوی نام یا سمت...' : 'Search by name or position...'; ?>" class="staff-search-input">
                                <button class="staff-search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                            <div class="staff-category-filters">
                                <button class="staff-filter-btn active" data-filter="all">
                                    <?php echo $lang == 'fa' ? 'همه' : 'All'; ?>
                                </button>
                                <button class="staff-filter-btn" data-filter="management">
                                    <?php echo $lang == 'fa' ? 'مدیریت' : 'Management'; ?>
                                </button>
                                <button class="staff-filter-btn" data-filter="teaching">
                                    <?php echo $lang == 'fa' ? 'آموزشی' : 'Teaching'; ?>
                                </button>
                                <button class="staff-filter-btn" data-filter="support">
                                    <?php echo $lang == 'fa' ? 'پشتیبانی' : 'Support'; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Cards Section -->
        <section class="staff-cards-section">
            <div class="container">
                <div class="row" id="staff-cards-container" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
                <?php
                // Database connection
                $conn = connectDB();

                // Define categories for staff members
                $management_positions_fa = array("مدیر", "معاون", "حسابدار", "معاون اجرایی", "معاون آموزشی", "معاون پرورشی");
                $teaching_positions_fa = array("دبیر", "آموزگار", "مربی زبان", "هنرآموز");
                
                $management_positions_en = array("Management", "Deputy", "Accountant", "Deputy manager", "Educational Assistant");
                $teaching_positions_en = array("Teacher", "language instructor");
                
                // Fetch staff members
                $sql = "SELECT * FROM staff ORDER BY id ASC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    $counter = 0;
                    
                    while($row = $result->fetch_assoc()) {
                        // Calculate delay for animation
                        $delay = ($counter % 4) * 100;
                        $counter++;
                        
                        // Get data based on selected language
                        $name = ($lang == 'fa') ? $row["name_fa"] : $row["name_en"];
                        $position = ($lang == 'fa') ? $row["position_fa"] : $row["position_en"];
                        $education = ($lang == 'fa') ? $row["education_fa"] : $row["education_en"];
                        
                        // Check if photo exists, otherwise use vector.jpg
                        $image_path = !empty($row["photo_url"]) ? 
                                    "assets/images/Staff/" . $row["photo_url"] : 
                                    "assets/images/Staff/vector.jpg";
                        
                        // Determine card type based on position
                        $card_class = "support"; // Default class
                        $category = "support"; // Default category for data attribute
                        
                        // Check position category
                        if ($lang == 'fa') {
                            foreach ($management_positions_fa as $pos) {
                                if (strpos($row["position_fa"], $pos) !== false) {
                                    $card_class = "management";
                                    $category = "management";
                                    break;
                                }
                            }
                            
                            foreach ($teaching_positions_fa as $pos) {
                                if (strpos($row["position_fa"], $pos) !== false) {
                                    $card_class = "teaching";
                                    $category = "teaching";
                                    break;
                                }
                            }
                        } else {
                            foreach ($management_positions_en as $pos) {
                                if (strpos($row["position_en"], $pos) !== false) {
                                    $card_class = "management";
                                    $category = "management";
                                    break;
                                }
                            }
                            
                            foreach ($teaching_positions_en as $pos) {
                                if (strpos($row["position_en"], $pos) !== false) {
                                    $card_class = "teaching";
                                    $category = "teaching";
                                    break;
                                }
                            }
                        }
                ?>
                    <div class="col-lg-4 col-md-6 staff-card-container" data-category="<?php echo $category; ?>" data-name="<?php echo strtolower($name); ?>" data-position="<?php echo strtolower($position); ?>">
                        <div class="staff-card <?php echo $card_class; ?> wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='<?php echo $delay; ?>ms'>
                            <div class="staff-image">
                                <img src="<?php echo $image_path; ?>" alt="<?php echo $name; ?>">
                                
                                <div class="staff-info">
                                    <h3 class="staff-name"><?php echo $name; ?></h3>
                                    <p class="staff-position"><?php echo $position; ?></p>
                                    
                                    <?php if (!empty($education)): ?>
                                    <div class="staff-education">
                                        <?php echo $education; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="staff-social">
                                    <a href="#" class="staff-social-link" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="#" class="staff-social-link" title="Profile">
                                        <i class="fas fa-user"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    $no_staff = ($lang == 'fa') ? 'هیچ عضوی یافت نشد' : 'No staff members found';
                    echo "<div class='col-12 text-center'><p class='no-results'>{$no_staff}</p></div>";
                }
                closeDB($conn);
                ?>
                </div>
                
                <!-- No Results Message (Initially Hidden) -->
                <div id="no-results-message" class="no-results-container" style="display: none;">
                    <div class="no-results">
                        <i class="fas fa-user-slash no-results-icon"></i>
                        <h3><?php echo $lang == 'fa' ? 'نتیجه‌ای یافت نشد' : 'No Results Found'; ?></h3>
                        <p><?php echo $lang == 'fa' ? 'هیچ اعضایی با معیارهای جستجوی شما یافت نشد. لطفاً معیارهای جستجو را تغییر دهید.' : 'No staff members match your search criteria. Please try different search terms.'; ?></p>
                        <button id="reset-search" class="reset-btn">
                            <i class="fas fa-sync-alt"></i> 
                            <?php echo $lang == 'fa' ? 'بازنشانی' : 'Reset'; ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Overview Section -->
        <section class="staff-overview-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="staff-stat-card wow fadeInUp" data-wow-delay="100ms">
                            <div class="staff-stat-icon management-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <div class="staff-stat-info">
                                <h3 class="staff-stat-title"><?php echo $lang == 'fa' ? 'کادر مدیریتی' : 'Management Team'; ?></h3>
                                <p class="staff-stat-desc"><?php echo $lang == 'fa' ? 'مدیران مجتمع با تجربه و دانش کافی در زمینه مدیریت آموزشی' : 'Experienced managers with expertise in educational administration'; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="staff-stat-card wow fadeInUp" data-wow-delay="200ms">
                            <div class="staff-stat-icon teaching-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="staff-stat-info">
                                <h3 class="staff-stat-title"><?php echo $lang == 'fa' ? 'کادر آموزشی' : 'Teaching Staff'; ?></h3>
                                <p class="staff-stat-desc"><?php echo $lang == 'fa' ? 'معلمان متخصص با تجربه تدریس در زمینه‌های مختلف آموزشی' : 'Qualified teachers with extensive experience in various educational fields'; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-12">
                        <div class="staff-stat-card wow fadeInUp" data-wow-delay="300ms">
                            <div class="staff-stat-icon support-icon">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <div class="staff-stat-info">
                                <h3 class="staff-stat-title"><?php echo $lang == 'fa' ? 'کادر پشتیبانی' : 'Support Staff'; ?></h3>
                                <p class="staff-stat-desc"><?php echo $lang == 'fa' ? 'همکاران پشتیبانی که در ارائه خدمات آموزشی با کیفیت به دانش‌آموزان یاری می‌رسانند' : 'Support personnel assisting in providing quality educational services to students'; ?></p>
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
    
    <!-- Staff Page JS -->
    <script src="assets/js/staff-page.js"></script>
</body>
</html>