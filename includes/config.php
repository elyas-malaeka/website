<?php
/**
 * Main Configuration File
 */

// Prevent direct script access
if (!defined('BASEPATH')) {
    define('BASEPATH', true);
}

// ======================= //
// TIME ZONE CONFIGURATION //
// ======================= //
date_default_timezone_set('Asia/Dubai');

// ======================= //
// SESSION CONFIGURATION   //
// ======================= //
$session_timeout = 1800; // 30 minutes (1800 seconds)
$session_name = 'salman_session';

// IMPORTANT: Check if session is already started before trying to configure it
if (session_status() == PHP_SESSION_NONE) {
    // Session security settings - set these BEFORE starting the session
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.gc_maxlifetime', $session_timeout);
    
    // Cookie settings - set these BEFORE starting the session
    session_name($session_name);
    session_set_cookie_params([
        'lifetime' => $session_timeout,
        'path'     => '/',
        'domain'   => '',
        'secure'   => false, // Change to true in production environment
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    // Now it's safe to start the session
    session_start();
} 

// Update last activity time for existing sessions
$_SESSION['last_activity'] = time();

// Check for session timeout and auto-logout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    session_unset();
    session_destroy();
    // Redirect to login page if in admin section
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        header('Location: ../login/index.php?expired=1');
        exit;
    }
}


// Start or continue session
if (!session_id()) {
    session_start();
}

// Check for session timeout and auto-logout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    session_unset();
    session_destroy();
    // Redirect to login page if in admin section
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        header('Location: ../login/index.php?expired=1');
        exit;
    }
}
$_SESSION['last_activity'] = time();

// ======================= //
// DATABASE CONFIGURATION  //
// ======================= //
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'salman');

// Create database connection
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$db) {
    die("Database connection error: " . mysqli_connect_error());
}
mysqli_set_charset($db, "utf8mb4");

// ======================= //
// SITE CONFIGURATION      //
// ======================= //
define('SITE_NAME', 'مجتمع آموزشی سلمان');
define('SITE_NAME_EN', 'Salman Educational Complex');
define('SITE_URL', 'http://localhost/web');
define('ADMIN_EMAIL', 'admin@salmanschool.ae');

// ======================= //
// LANGUAGE CONFIGURATION  //
// ======================= //

// همیشه زبان پیش‌فرض را تنظیم کن اگر تنظیم نشده باشد
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fa'; // زبان پیش‌فرض فارسی
}

// بررسی اگر پارامتر زبان در URL وجود دارد و آپدیت نشست
if (isset($_GET['lang']) && in_array($_GET['lang'], ['fa', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// همیشه ریدایرکت برای اضافه کردن پارامتر زبان اگر وجود ندارد (به جز در صفحه index.php)
if (!isset($_GET['lang']) && basename($_SERVER['PHP_SELF']) !== 'index.php' && !headers_sent()) {
    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $connector = (strpos($current_url, '?') !== false) ? '&' : '?';
    $redirect_url = $current_url . $connector . 'lang=' . $_SESSION['lang'];
    
    header("Location: $redirect_url");
    exit;
}

$current_language = $_SESSION['lang'];
$dir = ($current_language == 'fa') ? 'rtl' : 'ltr';
// اطمینان از حفظ پارامتر زبان در لینک‌های داخلی
function processInternalLinks() {
    if (!headers_sent()) {
        ob_start(function($buffer) {
            $lang = getCurrentLanguage();
            
            // این الگو همه لینک‌های <a href="..."> را می‌گیرد
            $pattern = '/<a([^>]*?)href=["\']([^"\']*?)["\']([^>]*?)>/i';
            
            return preg_replace_callback($pattern, function($matches) use ($lang) {
                $url = $matches[2];
                
                // فقط پردازش فایل‌های PHP (لینک‌های داخلی)
                if (preg_match('/\.php($|\?)/', $url) && strpos($url, 'lang=') === false && strpos($url, '://') === false) {
                    $connector = (strpos($url, '?') !== false) ? '&' : '?';
                    $url .= $connector . 'lang=' . $lang;
                    return '<a' . $matches[1] . 'href="' . $url . '"' . $matches[3] . '>';
                }
                
                return $matches[0];
            }, $buffer);
        });
    }
}

/**
 * ایجاد URL برای تغییر زبان که صفحه فعلی را حفظ می‌کند
 * 
 * @param string $targetLang زبان مقصد (en یا fa)
 * @return string URL برای تغییر زبان
 */
function getLanguageSwitchUrl($targetLang) {
    $url = $_SERVER['REQUEST_URI'];
    
    // حذف پارامتر زبان موجود
    $url = preg_replace('/([?&])lang=[^&]+(&|$)/', '$1', $url);
    
    // پاکسازی URL
    $url = rtrim($url, '?&');
    
    // اضافه کردن پارامتر زبان جدید
    $connector = (strpos($url, '?') !== false) ? '&' : '?';
    
    return $url . $connector . 'lang=' . $targetLang;
}

// شروع بافر خروجی برای پردازش لینک‌ها
processInternalLinks();

// ======================= //
// HELPER FUNCTIONS        //
// ======================= //

/**
 * Sanitize input data
 *
 * @param string $data Input data
 * @return string Sanitized data
 */
function clean($data) {
    global $db;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($db) {
        $data = mysqli_real_escape_string($db, $data);
    }
    return $data;
}

/**
 * Check if user is logged in
 *
 * @return bool True if logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['admin-login']);
}

/**
 * Redirect to another page
 *
 * @param string $url Target URL
 * @return void
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Load translation JSON file
 *
 * @param string $language Language code (fa or en)
 * @return array Array of translations
 */
function loadTranslations($language) {
    $json_file = __DIR__ . '/../languages/' . $language . '.json';
    if (file_exists($json_file)) {
        $json_content = file_get_contents($json_file);
        return json_decode($json_content, true);
    }
    return [];
}

// Load translations
$translations = loadTranslations($current_language);

/**
 * Translate text by key
 *
 * @param string $key Translation key (e.g., "Header.home")
 * @return string Translated text or original key if translation not found
 */
function __($key) {
    global $translations;
    if (strpos($key, '.') === false) {
        return isset($translations[$key]) ? $translations[$key] : $key;
    }
    $keys = explode('.', $key);
    $value = $translations;
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $key;
        }
    }
    return is_string($value) ? $value : $key;
}

/**
 * Create new database connection using OOP (if needed)
 *
 * @return mysqli Database connection
 */
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

/**
 * Close database connection
 *
 * @param mysqli $conn Database connection
 */
function closeDB($conn) {
    $conn->close();
}

/**
 * Get current language
 *
 * @return string Current language code (en or fa)
 */
function getCurrentLanguage() {
    return isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fa';
}

/**
 * Truncate text to specified length
 *
 * @param string $text Original text
 * @param int $length Maximum length
 * @return string Truncated text
 */
function truncateText($text, $length = 150) {
    if (mb_strlen($text) > $length) {
        return mb_substr($text, 0, $length) . '...';
    }
    return $text;
}

/**
 * Convert Gregorian date to Jalali (Persian) date
 * 
 * @param string $date Gregorian date
 * @param bool $withNumbers Convert numbers to Persian (optional)
 * @return string Jalali date
 */
function gregorianToJalali($date, $withNumbers = true) {
    $date_array = explode("-", date("Y-m-d", strtotime($date)));
    $g_y = $date_array[0];
    $g_m = $date_array[1];
    $g_d = $date_array[2];
    
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    
    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;
    
    $g_day_no = 365 * $gy + intval(($gy + 3) / 4) - intval(($gy + 99) / 100) + intval(($gy + 399) / 400);
    
    for ($i = 0; $i < $gm; ++$i) {
        $g_day_no += $g_days_in_month[$i];
    }
    
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0))) {
        $g_day_no++;
    }
    
    $g_day_no += $gd;
    
    $j_day_no = $g_day_no - 79;
    
    $j_np = intval($j_day_no / 12053);
    $j_day_no = $j_day_no % 12053;
    
    $jy = 979 + 33 * $j_np + 4 * intval($j_day_no / 1461);
    
    $j_day_no %= 1461;
    
    if ($j_day_no >= 366) {
        $jy += intval(($j_day_no - 1) / 365);
        $j_day_no = ($j_day_no - 1) % 365;
    }
    
    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i) {
        $j_day_no -= $j_days_in_month[$i];
    }
    
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    
    // Persian month names
    $jalali_months = array(
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند'
    );
    
    $result = $jd . ' ' . $jalali_months[$jm] . ' ' . $jy;
    
    // Convert numbers to Persian if requested
    if ($withNumbers) {
        $result = convertToFarsiNumber($result);
    }
    
    return $result;
}

/**
 * Format date according to language
 * 
 * @param string $date Date string
 * @param string $lang Language code (en or fa)
 * @return string Formatted date
 */
function formatDate($date, $lang = 'en') {
    if ($lang == 'en') {
        return date('F j, Y', strtotime($date));
    } else {
        // Convert to Persian date for Farsi language
        return gregorianToJalali($date, true);
    }
}


// ======================= //
// FALLBACK TRANSLATIONS   //
// ======================= //
$translationsFallback = [
    'blog_title' => [
        'en' => 'Latest News & Articles',
        'fa' => 'آخرین اخبار و مقالات'
    ],
    'read_more' => [
        'en' => 'Read More',
        'fa' => 'ادامه مطلب'
    ],
    'search_here' => [
        'en' => 'Search Here',
        'fa' => 'جستجو کنید'
    ],
    'search_button' => [
        'en' => 'Search',
        'fa' => 'جستجو'
    ],
    'latest_posts' => [
        'en' => 'Latest Posts',
        'fa' => 'آخرین مطالب'
    ],
    'categories' => [
        'en' => 'Categories',
        'fa' => 'دسته‌بندی‌ها'
    ],
    'popular_articles' => [
        'en' => 'Popular Articles',
        'fa' => 'مقالات محبوب' 
    ],
    'views' => [
        'en' => 'views',  
        'fa' => 'بازدید'  
    ],
    'back_top' => [
        'en' => 'back top',
        'fa' => 'بازگشت به بالا'
    ],  
    'subscribe_newsletter' => [
        'en' => 'Subscribe To Our Newsletter!',
        'fa' => 'در خبرنامه ما مشترک شوید!'
    ],
    'enter_email' => [
        'en' => 'Enter Email Address',
        'fa' => 'آدرس ایمیل خود را وارد کنید'
    ],
    'submit' => [
        'en' => 'submit',
        'fa' => 'ارسال'
    ],
    'school_description' => [
        'en' => 'Salman Farsi Educational Complex: The first Iranian school in Dubai, offering Persian education and advanced facilities for students\' growth.',
        'fa' => 'مجتمع آموزشی سلمان فارسی: اولین مدرسه ایرانی در دبی، ارائه دهنده آموزش فارسی و امکانات پیشرفته برای رشد دانش‌آموزان.'
    ],
    'contact_us' => [
        'en' => 'Contact Us',
        'fa' => 'تماس با ما'
    ],
    'follow_on' => [
        'en' => 'Follow on',
        'fa' => 'ما را دنبال کنید'
    ],
    'quick_link' => [
        'en' => 'Quick Link',
        'fa' => 'لینک‌های سریع'
    ],
    'about_us' => [
        'en' => 'About Us',
        'fa' => 'درباره ما'
    ],
    'blog_news' => [
        'en' => 'Blog & News',
        'fa' => 'وبلاگ و اخبار'
    ],
    'facilities' => [
        'en' => 'Facilities',
        'fa' => 'امکانات'
    ],
    'faq' => [
        'en' => 'FAQ\'S',
        'fa' => 'سوالات متداول'
    ],
    'our_services' => [
        'en' => 'our services',
        'fa' => 'خدمات ما'
    ],
    'crriculum' => [
        'en' => 'Curriculum',
        'fa' => 'مقاطع تحصیلی'
    ],
    'ehsan_section' => [
        'en' => 'EHSAN SECTION',
        'fa' => 'بخش احسان'
    ],
    'primary_school' => [
        'en' => 'Primary School',
        'fa' => 'دبستان'
    ],
    'middle_school' => [
        'en' => 'Middle School',
        'fa' => 'دوره اول متوسطه'
    ],
    'high_school' => [
        'en' => 'High School',
        'fa' => 'دوره دوم متوسطه'
    ],
    'contact_us_title' => [
        'en' => 'contact us',
        'fa' => 'اطلاعات تماس'
    ],
    'address' => [
        'en' => 'Al Qusais - Al Qusais 1 - Dubai',
        'fa' => 'دبی - القصیص - القصیص ۱'
    ],
    'copyright' => [
        'en' => '&copy; Copyright <span class="dynamic-year"></span> by Salman Farsi Educational Complex.',
        'fa' => '&copy; تمامی حقوق برای مجتمع آموزشی سلمان فارسی محفوظ است <span class="dynamic-year"></span>.'
    ],
    'terms' => [
        'en' => 'Terms & Conditions',
        'fa' => 'قوانین و مقررات'
    ],
    'privacy' => [
        'en' => 'Privacy Policy',
        'fa' => 'حریم خصوصی'
    ],
    'close' => [
        'en' => 'Close',
        'fa' => 'بستن'
    ],
    'subscription_success_title' => [
        'en' => 'Subscription Successful',
        'fa' => 'اشتراک موفقیت‌آمیز'
    ],
    'subscription_success_message' => [
        'en' => 'Thank you for subscribing to our newsletter!',
        'fa' => 'با تشکر از اشتراک شما در خبرنامه ما!'
    ],
    'already_subscribed_title' => [
        'en' => 'Already Subscribed',
        'fa' => 'قبلاً مشترک شده‌اید'
    ],
    'already_subscribed_message' => [
        'en' => 'You are already subscribed to our newsletter!',
        'fa' => 'شما قبلاً در خبرنامه ما مشترک شده‌اید!'
    ],
    'subscription_failed_title' => [
        'en' => 'Subscription Failed',
        'fa' => 'اشتراک ناموفق'
    ],
    'subscription_failed_message' => [
        'en' => 'An error occurred while processing your request. Please try again later.',
        'fa' => 'خطایی در پردازش درخواست شما رخ داد. لطفاً بعداً دوباره تلاش کنید.'
    ],
    'invalid_email_title' => [
        'en' => 'Invalid Email',
        'fa' => 'ایمیل نامعتبر'
    ],
    'invalid_email_message' => [
        'en' => 'Please enter a valid email address.',
        'fa' => 'لطفاً یک آدرس ایمیل معتبر وارد کنید.'
    ],
    // ترجمه‌های مربوط به صفحه شرایط و ضوابط ثبت‌نام
    'apply_now'=> [
        'en' => 'Apply Now',
        'fa' => 'ثبت‌نام'
    ],
    'home'=> [
        'en' => 'Home',
        'fa' => 'صفحه اصلی'
    ],
'registration_terms_title' => [
    'en' => 'Terms and Conditions for Registration',
    'fa' => 'شرایط و ضوابط ثبت‌نام'
],
'registration_instructions' => [
    'en' => 'Salman Farsi School Registration Instructions',
    'fa' => 'دستورالعمل‌های ثبت‌نام مدرسه سلمان فارسی'
],
'required_documents' => [
    'en' => 'Required Documents for Registration',
    'fa' => 'مدارک لازم برای ثبت‌نام'
],
'documents_ready' => [
    'en' => 'Before starting the online registration process, ensure you have the following files ready:',
    'fa' => 'قبل از شروع فرآیند ثبت‌نام آنلاین، اطمینان حاصل کنید که فایل‌های زیر را آماده دارید:'
],
'passport_photo' => [
    'en' => 'Student\'s Passport Photo (white background)',
    'fa' => 'عکس پاسپورتی دانش‌آموز (با پس‌زمینه سفید)'
],
'emirates_id' => [
    'en' => 'Copy of Emirates ID',
    'fa' => 'کپی کارت شناسایی امارات'
],
'passport_copy' => [
    'en' => 'Copy of Passport\'s First Page',
    'fa' => 'کپی صفحه اول پاسپورت'
],
'birth_certificate' => [
    'en' => 'Birth Certificate Copy',
    'fa' => 'کپی گواهی تولد'
],
'national_id' => [
    'en' => 'National ID Copy',
    'fa' => 'کپی کارت ملی'
],
'academic_certificate' => [
    'en' => 'Translated Copy of Latest Academic Certificate (for new students)',
    'fa' => 'کپی ترجمه شده آخرین مدرک تحصیلی (برای دانش‌آموزان جدید)'
],
'transportation_services' => [
    'en' => 'Student Transportation Services',
    'fa' => 'خدمات حمل و نقل دانش‌آموزان'
],
'transportation_info' => [
    'en' => 'Salman Farsi School provides daily transportation services for over 170 students across Dubai, Sharjah, and Ajman. The services are coordinated by',
    'fa' => 'مدرسه سلمان فارسی خدمات حمل و نقل روزانه برای بیش از ۱۷۰ دانش‌آموز در سراسر دبی، شارجه و عجمان ارائه می‌دهد. این خدمات توسط'
],
'coordinator' => [
    'en' => 'Mr. Farrokhi-Nejad',
    'fa' => 'آقای فرخی‌نژاد'
],
'contact' => [
    'en' => 'Contact:',
    'fa' => 'تماس:'
],
'rta_regulations' => [
    'en' => ', ensuring compliance with RTA regulations.',
    'fa' => '، با رعایت مقررات RTA هماهنگ می‌شود.'
],
'transportation_routes' => [
    'en' => 'Transportation Routes:',
    'fa' => 'مسیرهای حمل و نقل:'
],
'route' => [
    'en' => 'Route',
    'fa' => 'مسیر'
],
'stops' => [
    'en' => 'Stops',
    'fa' => 'توقف‌ها'
],
'tuition_fees_title' => [
    'en' => 'Tuition Fees for the Academic Year 2024-2025',
    'fa' => 'شهریه برای سال تحصیلی ۲۰۲۴-۲۰۲۵'
],
'basic_tuition_fees' => [
    'en' => 'Basic Tuition Fees:',
    'fa' => 'شهریه اصلی:'
],
'grade' => [
    'en' => 'Grade',
    'fa' => 'پایه'
],
'tuition_fee' => [
    'en' => 'Tuition Fee (AED)',
    'fa' => 'شهریه (درهم)'
],
'grades_1_5' => [
    'en' => 'Grades 1 to 5',
    'fa' => 'پایه‌های ۱ تا ۵'
],
'grade_6' => [
    'en' => 'Grade 6',
    'fa' => 'پایه ۶'
],
'grades_7_8' => [
    'en' => 'Grades 7 and 8',
    'fa' => 'پایه‌های ۷ و ۸'
],
'grade_9' => [
    'en' => 'Grade 9',
    'fa' => 'پایه ۹'
],
'grades_10_12' => [
    'en' => 'Grades 10 to 12',
    'fa' => 'پایه‌های ۱۰ تا ۱۲'
],
'transportation_fees' => [
    'en' => 'Transportation Fees:',
    'fa' => 'هزینه‌های حمل و نقل:'
],
'transportation_fee' => [
    'en' => 'Transportation Fee (AED)',
    'fa' => 'هزینه حمل و نقل (درهم)'
],
'dubai' => [
    'en' => 'Dubai',
    'fa' => 'دبی'
],
'sharjah' => [
    'en' => 'Sharjah',
    'fa' => 'شارجه'
],
'ajman' => [
    'en' => 'Ajman',
    'fa' => 'عجمان'
],
'payment_methods' => [
    'en' => 'Payment Methods',
    'fa' => 'روش‌های پرداخت'
],
'full_cash_payment' => [
    'en' => 'Full cash payment.',
    'fa' => 'پرداخت کامل نقدی.'
],
'payment_installments' => [
    'en' => 'Payment in two installments:',
    'fa' => 'پرداخت در دو قسط:'
],
'first_installment' => [
    'en' => 'First Installment:',
    'fa' => 'قسط اول:'
],
'first_installment_date' => [
    'en' => 'Due by 10/12/2024.',
    'fa' => 'سررسید تا ۱۰/۱۲/۲۰۲۴.'
],
'second_installment' => [
    'en' => 'Second Installment:',
    'fa' => 'قسط دوم:'
],
'second_installment_date' => [
    'en' => 'Due by 15/03/2025.',
    'fa' => 'سررسید تا ۱۵/۰۳/۲۰۲۵.'
],
'minimum_payment' => [
    'en' => 'Minimum advance payment includes tuition, books, insurance, health services, and extracurricular activities:',
    'fa' => 'حداقل پرداخت پیش‌پرداخت شامل شهریه، کتاب‌ها، بیمه، خدمات بهداشتی و فعالیت‌های فوق برنامه:'
],
'primary_level' => [
    'en' => 'Primary Level:',
    'fa' => 'مقطع ابتدایی:'
],
'middle_school_level' => [
    'en' => 'Middle School:',
    'fa' => 'مقطع متوسطه اول:'
],
'high_school_level' => [
    'en' => 'High School:',
    'fa' => 'مقطع متوسطه دوم:'
],
'bank_accounts' => [
    'en' => 'Bank Accounts:',
    'fa' => 'حساب‌های بانکی:'
],
'tuition_account' => [
    'en' => 'Tuition Fee Payments:',
    'fa' => 'پرداخت‌های شهریه:'
],
'transportation_account' => [
    'en' => 'Transportation Fee Payments:',
    'fa' => 'پرداخت‌های حمل و نقل:'
],
'approved_banks' => [
    'en' => 'Approved Banks:',
    'fa' => 'بانک‌های مورد تأیید:'
],
'school_regulations' => [
    'en' => 'School Regulations',
    'fa' => 'مقررات مدرسه'
],
'code_of_conduct' => [
    'en' => 'Prior to registration, it is mandatory to read and accept the <strong>Code of Conduct</strong>. By registering at Salman Farsi School, you agree to adhere to all school policies.',
    'fa' => 'قبل از ثبت‌نام، مطالعه و پذیرش <strong>آیین‌نامه انضباطی</strong> الزامی است. با ثبت‌نام در مدرسه سلمان فارسی، شما موافقت می‌کنید که از تمام سیاست‌های مدرسه پیروی کنید.'
],
'read_complete_code' => [
    'en' => 'Read the Complete Code of Conduct',
    'fa' => 'مطالعه کامل آیین‌نامه انضباطی'
],
'apply_today' => [
    'en' => 'Apply today',
    'fa' => 'امروز ثبت‌نام کنید'
],
'need_help' => [
    'en' => 'Need Help?',
    'fa' => 'نیاز به کمک دارید؟'
],
'call_us' => [
    'en' => 'Call Us:',
    'fa' => 'با ما تماس بگیرید:'
],
'email' => [
    'en' => 'Email:',
    'fa' => 'ایمیل:'
],
'visit_us' => [
    'en' => 'Visit Us:',
    'fa' => 'از ما بازدید کنید:'
],
'important_dates' => [
    'en' => 'Important Dates',
    'fa' => 'تاریخ‌های مهم'
],
'registration_deadline' => [
    'en' => 'Registration Deadline for New Students',
    'fa' => 'مهلت ثبت‌نام برای دانش‌آموزان جدید'
],
'academic_year_begins' => [
    'en' => 'Academic Year Begins',
    'fa' => 'شروع سال تحصیلی'
],
'first_installment_due' => [
    'en' => 'First Installment Due Date',
    'fa' => 'موعد سررسید قسط اول'
],
'second_installment_due' => [
    'en' => 'Second Installment Due Date',
    'fa' => 'موعد سررسید قسط دوم'
],
// ترجمه‌های مربوط به صفحه کارکنان
'staff_title' => [
    'en' => 'Our Team',
    'fa' => 'کارکنان مجتمع'
],
'team_members' => [
    'en' => 'Team Members',
    'fa' => 'اعضای تیم'
],
'management_team' => [
    'en' => 'Management Team',
    'fa' => 'تیم مدیریت'
],
'teaching_staff' => [
    'en' => 'Teaching Staff',
    'fa' => 'کادر آموزشی'
],
'support_staff' => [
    'en' => 'Support Staff',
    'fa' => 'کادر پشتیبانی'
],
'no_staff_found' => [
    'en' => 'No staff members found',
    'fa' => 'هیچ عضوی یافت نشد'
],
// ترجمه‌های مربوط به صفحه سیاست حریم خصوصی
'privacy_policy' => [
    'en' => 'Privacy Policy',
    'fa' => 'سیاست حفظ حریم خصوصی'
],
'privacy_intro_title' => [
    'en' => 'Introduction',
    'fa' => 'مقدمه'
],
'privacy_intro_text_1' => [
    'en' => 'At Salman Educational Complex, we respect your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information when you visit our website or use our services. Please read this policy carefully to understand our practices regarding your personal data.',
    'fa' => 'در مجتمع آموزشی سلمان فارسی، ما به حریم خصوصی شما احترام می‌گذاریم و متعهد به حفاظت از اطلاعات شخصی شما هستیم. این سیاست حریم خصوصی توضیح می‌دهد که چگونه اطلاعات شما را هنگام بازدید از وب‌سایت ما یا استفاده از خدمات ما جمع‌آوری، استفاده و محافظت می‌کنیم. لطفاً این سیاست را با دقت مطالعه کنید تا از شیوه‌های ما در مورد اطلاعات شخصی شما آگاه شوید.'
],
'privacy_intro_text_2' => [
    'en' => 'This policy applies to all information collected through our website, as well as any related services, sales, marketing, or events. By accessing our website and services, you agree to the terms outlined in this policy.',
    'fa' => 'این سیاست در مورد تمام اطلاعاتی که از طریق وب‌سایت ما و همچنین هرگونه خدمات، فروش، بازاریابی یا رویدادهای مرتبط جمع‌آوری می‌شود، اعمال می‌شود. با دسترسی به وب‌سایت و خدمات ما، شما با شرایط مندرج در این سیاست موافقت می‌کنید.'
],
'privacy_collection_title' => [
    'en' => 'Information We Collect',
    'fa' => 'اطلاعاتی که جمع‌آوری می‌کنیم'
],
'privacy_collection_text_1' => [
    'en' => 'We collect personal information that you voluntarily provide to us when you register on our website, express interest in obtaining information about us or our products and services, participate in activities on the website, or otherwise contact us.',
    'fa' => 'ما اطلاعات شخصی را که داوطلبانه هنگام ثبت‌نام در وب‌سایت ما، ابراز علاقه به کسب اطلاعات درباره ما یا محصولات و خدمات ما، شرکت در فعالیت‌های وب‌سایت، یا تماس با ما ارائه می‌دهید، جمع‌آوری می‌کنیم.'
],
'privacy_collection_text_2' => [
    'en' => 'The personal information we collect may include:',
    'fa' => 'اطلاعات شخصی که ما جمع‌آوری می‌کنیم ممکن است شامل موارد زیر باشد:'
],
'privacy_collection_item_1' => [
    'en' => 'Names, email addresses, phone numbers, and business contact details',
    'fa' => 'نام، آدرس ایمیل، شماره تلفن و اطلاعات تماس تجاری'
],
'privacy_collection_item_2' => [
    'en' => 'Billing and payment information',
    'fa' => 'اطلاعات صورتحساب و پرداخت'
],
'privacy_collection_item_3' => [
    'en' => 'User credentials (usernames, passwords)',
    'fa' => 'اعتبارنامه‌های کاربر (نام کاربری، رمز عبور)'
],
'privacy_collection_item_4' => [
    'en' => 'Profile information and preferences',
    'fa' => 'اطلاعات پروفایل و ترجیحات'
],
'privacy_collection_item_5' => [
    'en' => 'Feedback, survey responses, and testimonials',
    'fa' => 'بازخورد، پاسخ‌های نظرسنجی و گواهی‌نامه‌ها'
],
'privacy_collection_text_3' => [
    'en' => 'We also automatically collect certain information when you visit our website, including:',
    'fa' => 'ما همچنین هنگام بازدید شما از وب‌سایت ما، اطلاعات خاصی را به طور خودکار جمع‌آوری می‌کنیم، از جمله:'
],
'privacy_collection_item_6' => [
    'en' => 'IP addresses and device information',
    'fa' => 'آدرس‌های IP و اطلاعات دستگاه'
],
'privacy_collection_item_7' => [
    'en' => 'Browser type and settings',
    'fa' => 'نوع مرورگر و تنظیمات'
],
'search_results' => [
    'en' => 'Search Results',
    'fa' => 'نتایج جستجو'
],
'privacy_collection_item_8' => [
    'en' => 'Usage data and browsing history on our website',
    'fa' => 'داده‌های استفاده و تاریخچه مرور در وب‌سایت ما'
],
'privacy_collection_item_9' => [
    'en' => 'Cookies and similar tracking technologies',
    'fa' => 'کوکی‌ها و فناوری‌های ردیابی مشابه'
],
'privacy_usage_title' => [
    'en' => 'How We Use Your Information',
    'fa' => 'چگونه از اطلاعات شما استفاده می‌کنیم'
],
'privacy_usage_text' => [
    'en' => 'We use the information we collect for various business purposes, including:',
    'fa' => 'ما از اطلاعاتی که جمع‌آوری می‌کنیم برای اهداف تجاری مختلف استفاده می‌کنیم، از جمله:'
],
'privacy_usage_item_1' => [
    'en' => 'Providing, operating, and maintaining our website and services',
    'fa' => 'ارائه، بهره‌برداری و نگهداری وب‌سایت و خدمات ما'
],
'privacy_usage_item_2' => [
    'en' => 'Improving, personalizing, and expanding our offerings',
    'fa' => 'بهبود، شخصی‌سازی و گسترش خدمات ما'
],
'privacy_usage_item_3' => [
    'en' => 'Understanding how you interact with our website',
    'fa' => 'درک چگونگی تعامل شما با وب‌سایت ما'
],
'privacy_usage_item_4' => [
    'en' => 'Developing new products, services, and features',
    'fa' => 'توسعه محصولات، خدمات و ویژگی‌های جدید'
],
'privacy_usage_item_5' => [
    'en' => 'Communicating with you about updates, security alerts, and support',
    'fa' => 'ارتباط با شما در مورد به‌روزرسانی‌ها، هشدارهای امنیتی و پشتیبانی'
],
'privacy_usage_item_6' => [
    'en' => 'Sending marketing and promotional communications (with your consent)',
    'fa' => 'ارسال ارتباطات بازاریابی و تبلیغاتی (با رضایت شما)'
],
'privacy_usage_item_7' => [
    'en' => 'Protecting against fraudulent, unauthorized, or illegal activity',
    'fa' => 'محافظت در برابر فعالیت‌های تقلبی، غیرمجاز یا غیرقانونی'
],
'privacy_sharing_title' => [
    'en' => 'Information Sharing',
    'fa' => 'اشتراک‌گذاری اطلاعات'
],
'privacy_sharing_text' => [
    'en' => 'We only share your personal information in the following situations:',
    'fa' => 'ما اطلاعات شخصی شما را فقط در موارد زیر به اشتراک می‌گذاریم:'
],
'privacy_sharing_item_1_title' => [
    'en' => 'With Service Providers:',
    'fa' => 'با ارائه‌دهندگان خدمات:'
],
'privacy_sharing_item_1_text' => [
    'en' => 'We may share your information with third-party vendors and service providers who perform services for us, such as payment processing, data analysis, email delivery, hosting, and customer service.',
    'fa' => 'ما ممکن است اطلاعات شما را با فروشندگان و ارائه‌دهندگان خدمات شخص ثالثی که خدماتی مانند پردازش پرداخت، تجزیه و تحلیل داده، تحویل ایمیل، میزبانی و خدمات مشتری را برای ما انجام می‌دهند، به اشتراک بگذاریم.'
],
'privacy_sharing_item_2_title' => [
    'en' => 'Business Transfers:',
    'fa' => 'انتقال‌های تجاری:'
],
'privacy_sharing_item_2_text' => [
    'en' => 'We may share or transfer your information in connection with a merger, acquisition, reorganization, or sale of all or a portion of our company assets.',
    'fa' => 'ما ممکن است اطلاعات شما را در ارتباط با ادغام، تملک، سازماندهی مجدد یا فروش تمام یا بخشی از دارایی‌های شرکت خود به اشتراک بگذاریم یا منتقل کنیم.'
],
'privacy_sharing_item_3_title' => [
    'en' => 'Legal Obligations:',
    'fa' => 'تعهدات قانونی:'
],
'privacy_sharing_item_3_text' => [
    'en' => 'We may disclose your information where required by law or if we believe disclosure is necessary to protect our rights or comply with a judicial proceeding, court order, or legal process.',
    'fa' => 'ما ممکن است اطلاعات شما را در جایی که قانون الزام می‌کند یا اگر معتقد باشیم که افشای اطلاعات برای محافظت از حقوق ما یا رعایت یک رسیدگی قضایی، دستور دادگاه یا فرآیند قانونی ضروری است، افشا کنیم.'
],
'privacy_sharing_item_4_title' => [
    'en' => 'With Your Consent:',
    'fa' => 'با رضایت شما:'
],
'privacy_sharing_item_4_text' => [
    'en' => 'We may share your personal information with third parties when you have given us consent to do so.',
    'fa' => 'ما ممکن است اطلاعات شخصی شما را با اشخاص ثالث به اشتراک بگذاریم، هنگامی که شما رضایت خود را به ما داده‌اید.'
],
'privacy_security_title' => [
    'en' => 'Data Security',
    'fa' => 'امنیت داده‌ها'
],
'privacy_security_text_1' => [
    'en' => 'We implement appropriate technical and organizational security measures to protect the security of your personal information. However, please be aware that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your personal information, we cannot guarantee its absolute security.',
    'fa' => 'ما اقدامات امنیتی فنی و سازمانی مناسبی را برای محافظت از امنیت اطلاعات شخصی شما اجرا می‌کنیم. با این حال، لطفاً توجه داشته باشید که هیچ روش انتقال از طریق اینترنت یا روش ذخیره‌سازی الکترونیکی ۱۰۰٪ ایمن نیست. در حالی که ما تلاش می‌کنیم از روش‌های قابل قبول تجاری برای محافظت از اطلاعات شخصی شما استفاده کنیم، نمی‌توانیم امنیت مطلق آن را تضمین کنیم.'
],
'privacy_security_text_2' => [
    'en' => 'We maintain security measures including:',
    'fa' => 'ما اقدامات امنیتی زیر را حفظ می‌کنیم:'
],
'privacy_security_item_1' => [
    'en' => 'Encryption of sensitive data',
    'fa' => 'رمزگذاری داده‌های حساس'
],
'privacy_security_item_2' => [
    'en' => 'Secure networks and access controls',
    'fa' => 'شبکه‌های امن و کنترل‌های دسترسی'
],
'privacy_security_item_3' => [
    'en' => 'Regular security assessments',
    'fa' => 'ارزیابی‌های امنیتی منظم'
],
'privacy_security_item_4' => [
    'en' => 'Staff training on data protection',
    'fa' => 'آموزش کارکنان در مورد حفاظت از داده‌ها'
],
'privacy_cookies_title' => [
    'en' => 'Cookies and Tracking Technologies',
    'fa' => 'کوکی‌ها و فناوری‌های ردیابی'
],
'privacy_cookies_text_1' => [
    'en' => 'We use cookies and similar tracking technologies to track activity on our website and store certain information. Cookies are files with a small amount of data which may include an anonymous unique identifier. They are sent to your browser from a website and stored on your device.',
    'fa' => 'ما از کوکی‌ها و فناوری‌های ردیابی مشابه برای پیگیری فعالیت در وب‌سایت خود و ذخیره برخی اطلاعات استفاده می‌کنیم. کوکی‌ها فایل‌هایی با مقدار کمی داده هستند که ممکن است شامل یک شناسه منحصر به فرد ناشناس باشند. آنها از یک وب‌سایت به مرورگر شما ارسال می‌شوند و روی دستگاه شما ذخیره می‌شوند.'
],
'privacy_cookies_text_2' => [
    'en' => 'You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our website.',
    'fa' => 'شما می‌توانید به مرورگر خود دستور دهید تا همه کوکی‌ها را رد کند یا زمانی که یک کوکی ارسال می‌شود را نشان دهد. با این حال، اگر کوکی‌ها را نپذیرید، ممکن است نتوانید از برخی بخش‌های وب‌سایت ما استفاده کنید.'
],
'privacy_cookies_text_3' => [
    'en' => 'We use the following types of cookies:',
    'fa' => 'ما از انواع کوکی‌های زیر استفاده می‌کنیم:'
],
'privacy_cookies_item_1_title' => [
    'en' => 'Essential Cookies:',
    'fa' => 'کوکی‌های ضروری:'
],
'privacy_cookies_item_1_text' => [
    'en' => 'Necessary for the website to function properly',
    'fa' => 'برای عملکرد صحیح وب‌سایت ضروری هستند'
],
'privacy_cookies_item_2_title' => [
    'en' => 'Functionality Cookies:',
    'fa' => 'کوکی‌های عملکردی:'
],
'privacy_cookies_item_2_text' => [
    'en' => 'Remember your preferences and settings',
    'fa' => 'ترجیحات و تنظیمات شما را به خاطر می‌سپارند'
],
'privacy_cookies_item_3_title' => [
    'en' => 'Analytics Cookies:',
    'fa' => 'کوکی‌های تجزیه و تحلیل:'
],
'privacy_cookies_item_3_text' => [
    'en' => 'Help us understand how visitors interact with our website',
    'fa' => 'به ما کمک می‌کنند تا نحوه تعامل بازدیدکنندگان با وب‌سایت ما را درک کنیم'
],
'privacy_cookies_item_4_title' => [
    'en' => 'Marketing Cookies:',
    'fa' => 'کوکی‌های بازاریابی:'
],
'privacy_cookies_item_4_text' => [
    'en' => 'Track your browsing habits to deliver targeted advertising',
    'fa' => 'عادات مرور شما را برای ارائه تبلیغات هدفمند پیگیری می‌کنند'
],
'privacy_rights_title' => [
    'en' => 'Your Privacy Rights',
    'fa' => 'حقوق حریم خصوصی شما'
],
'privacy_rights_text' => [
    'en' => 'Depending on your location, you may have certain rights regarding your personal information, which may include:',
    'fa' => 'بسته به موقعیت شما، ممکن است حقوق خاصی در مورد اطلاعات شخصی خود داشته باشید، که ممکن است شامل موارد زیر باشد:'
],
'privacy_rights_item_1' => [
    'en' => 'Right to access the personal information we hold about you',
    'fa' => 'حق دسترسی به اطلاعات شخصی که ما درباره شما نگهداری می‌کنیم'
],
'privacy_rights_item_2' => [
    'en' => 'Right to request correction of inaccurate data',
    'fa' => 'حق درخواست اصلاح داده‌های نادرست'
],
'privacy_rights_item_3' => [
    'en' => 'Right to request deletion of your personal data',
    'fa' => 'حق درخواست حذف داده‌های شخصی شما'
],
'privacy_rights_item_4' => [
    'en' => 'Right to object to processing of your data',
    'fa' => 'حق اعتراض به پردازش داده‌های شما'
],
'privacy_rights_item_5' => [
    'en' => 'Right to data portability',
    'fa' => 'حق قابلیت حمل داده‌ها'
],
'privacy_rights_item_6' => [
    'en' => 'Right to withdraw consent where processing is based on consent',
    'fa' => 'حق لغو رضایت در جایی که پردازش بر اساس رضایت باشد'
],
'privacy_rights_contact' => [
    'en' => 'To exercise any of these rights, please contact us using the details provided in the "Contact Us" section.',
    'fa' => 'برای اعمال هر یک از این حقوق، لطفاً با استفاده از اطلاعات ارائه شده در بخش "تماس با ما" با ما تماس بگیرید.'
],
'privacy_children_title' => [
    'en' => 'Children\'s Privacy',
    'fa' => 'حریم خصوصی کودکان'
],
'privacy_children_text' => [
    'en' => 'Our website and services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children. If you are a parent or guardian and believe that your child has provided us with personal information, please contact us so that we can take necessary actions.',
    'fa' => 'وب‌سایت و خدمات ما برای افراد زیر ۱۶ سال در نظر گرفته نشده است. ما آگاهانه اطلاعات شخصی از کودکان جمع‌آوری نمی‌کنیم. اگر شما والدین یا سرپرست هستید و معتقدید که فرزند شما اطلاعات شخصی را برای ما ارائه کرده است، لطفاً با ما تماس بگیرید تا بتوانیم اقدامات لازم را انجام دهیم.'
],
'privacy_changes_title' => [
    'en' => 'Changes to This Privacy Policy',
    'fa' => 'تغییرات در این سیاست حریم خصوصی'
],
'privacy_changes_text_1' => [
    'en' => 'We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date. You are advised to review this Privacy Policy periodically for any changes.',
    'fa' => 'ما ممکن است سیاست حریم خصوصی خود را هر از گاهی به‌روزرسانی کنیم. ما شما را از هرگونه تغییر با انتشار سیاست حریم خصوصی جدید در این صفحه و به‌روزرسانی تاریخ "آخرین به‌روزرسانی" مطلع خواهیم کرد. به شما توصیه می‌شود این سیاست حریم خصوصی را برای هرگونه تغییر به طور دوره‌ای بررسی کنید.'
],
'privacy_changes_text_2' => [
    'en' => 'Significant changes will be communicated to you through a prominent notice on our website or by direct communication if we have your contact details.',
    'fa' => 'تغییرات مهم از طریق یک اعلان برجسته در وب‌سایت ما یا از طریق ارتباط مستقیم در صورتی که اطلاعات تماس شما را داشته باشیم، به شما اطلاع داده خواهد شد.'
],
'privacy_contact_title' => [
    'en' => 'Contact Us',
    'fa' => 'تماس با ما'
],
'privacy_contact_text' => [
    'en' => 'If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:',
    'fa' => 'اگر سوال یا نگرانی در مورد این سیاست حریم خصوصی یا شیوه‌های داده‌ای ما دارید، لطفاً با ما تماس بگیرید:'
],
'phone' => [
    'en' => 'Phone:',
    'fa' => 'تلفن:'
],
'school_address' => [
    'en' => 'Al Qusais, Dubai, United Arab Emirates',
    'fa' => 'القصیص، دبی، امارات متحده عربی'
],
'privacy_last_updated' => [
    'en' => 'Last Updated:',
    'fa' => 'آخرین به‌روزرسانی:'
],
    // عناوین اصلی FAQ
    'faq' => [
        'en' => 'FAQ',
        'fa' => 'سوالات متداول'
    ],
    'frequently_asked_questions' => [
        'en' => 'Frequently Asked Questions',
        'fa' => 'سوالات متداول'
    ],
    'faq_subtitle' => [
        'en' => 'Find answers to common questions about Salman Educational Complex',
        'fa' => 'پاسخ سوالات رایج درباره مجتمع آموزشی سلمان را در اینجا بیابید'
    ],
    
    // سوالات عمومی
    'faq_language_title' => [
        'en' => 'What languages are used for instruction at the school?',
        'fa' => 'زبان تدریس در مدرسه چه زبان‌هایی است؟'
    ],
    'faq_language_answer' => [
        'en' => 'The primary language of instruction at our school is Persian, while English and Arabic are also included in the curriculum to enhance students\' language skills.',
        'fa' => 'زبان تدریس اصلی در مدرسه ما فارسی است، با این حال، زبان‌های انگلیسی و عربی نیز در برنامه درسی گنجانده شده‌اند تا مهارت‌های زبانی دانش‌آموزان تقویت شود.'
    ],
    'faq_hours_title' => [
        'en' => 'What are the school working hours and official holidays?',
        'fa' => 'ساعات کاری مدرسه و تعطیلات رسمی چگونه است؟'
    ],
    'faq_hours_answer' => [
        'en' => 'The school operates from Monday to Friday, from 7 AM to 4 PM. Saturdays are reserved for administrative tasks. Official holidays include summer vacation, Nowruz break, Ramadan break, and national holidays.',
        'fa' => 'ساعات کاری مدرسه از دوشنبه تا جمعه از ساعت ۷ صبح تا ۴ بعدازظهر است. شنبه‌ها تنها برای امور اداری مدرسه است. تعطیلات رسمی شامل تعطیلات تابستانی، تعطیلات نوروزی، تعطیلات ماه رمضان و تعطیلات ملی کشور است.'
    ],
    'faq_curriculum_title' => [
        'en' => 'What curriculum does the school follow?',
        'fa' => 'مدرسه از چه برنامه درسی پیروی می‌کند؟'
    ],
    'faq_curriculum_answer' => [
        'en' => 'Our school follows the official Iranian curriculum approved by the Ministry of Education, with additional international components to provide a well-rounded education. Students follow the standard Iranian textbooks while also benefiting from complementary educational materials that enhance their learning experience.',
        'fa' => 'مدرسه ما از برنامه درسی رسمی ایران که توسط وزارت آموزش و پرورش تأیید شده است، پیروی می‌کند و همچنین اجزای بین‌المللی اضافی را برای ارائه آموزش جامع در برنامه دارد. دانش‌آموزان از کتاب‌های درسی استاندارد ایرانی استفاده می‌کنند و همچنین از مواد آموزشی تکمیلی که تجربه یادگیری آنها را ارتقا می‌دهد، بهره‌مند می‌شوند.'
    ],
    'faq_extracurricular_title' => [
        'en' => 'What extracurricular activities are offered?',
        'fa' => 'چه فعالیت‌های فوق برنامه‌ای ارائه می‌شود؟'
    ],
    'faq_extracurricular_answer' => [
        'en' => 'We offer a variety of extracurricular activities including sports (soccer, volleyball, basketball, swimming), arts (music, painting, calligraphy), cultural clubs, science and technology clubs, and educational competitions. These activities are designed to develop students\' talents, interests, and social skills beyond academic learning.',
        'fa' => 'ما طیف متنوعی از فعالیت‌های فوق برنامه از جمله ورزش (فوتبال، والیبال، بسکتبال، شنا)، هنر (موسیقی، نقاشی، خوشنویسی)، انجمن‌های فرهنگی، انجمن‌های علمی و فناوری و مسابقات آموزشی ارائه می‌دهیم. این فعالیت‌ها برای توسعه استعدادها، علایق و مهارت‌های اجتماعی دانش‌آموزان فراتر از یادگیری آکادمیک طراحی شده‌اند.'
    ],

    // سوالات پذیرش و ثبت‌نام
    'faq_registration_title' => [
        'en' => 'What is the registration process, and what are the required documents and timeline?',
        'fa' => 'نحوه ثبت‌نام در مدرسه چیست و مدارک و زمان‌بندی ثبت‌نام چگونه است؟'
    ],
    'faq_registration_answer' => [
        'en' => 'To register at the school, parents need to visit the school in person and provide required documents such as birth certificate, ID card, health certificate, passport-sized photo, and previous academic records. For detailed information and to confirm the necessary documents, please contact the school before visiting. Registration typically occurs in June and July, and late registrations will incur an additional penalty fee.',
        'fa' => 'برای ثبت‌نام در مدرسه، والدین باید به صورت حضوری مراجعه کرده و مدارک مورد نیاز شامل شناسنامه، کارت ملی، گواهی سلامت، عکس پرسنلی و مدارک تحصیلی قبلی را ارائه دهند. لطفاً برای اطلاعات دقیق‌تر و مطمئن‌شدن از مدارک لازم، قبل از مراجعه حضوری با مدرسه تماس بگیرید. ثبت‌نام در ماه‌های خرداد و تیر انجام می‌شود و در صورتی که بعد از این زمان ثبت‌نام صورت گیرد، هزینه‌ای تحت عنوان جریمه دریافت خواهد شد.'
    ],
    'faq_tuition_title' => [
        'en' => 'What are the tuition fees and what do they cover?',
        'fa' => 'هزینه‌های شهریه مدرسه چقدر است و شامل چه مواردی می‌شود؟'
    ],
    'faq_tuition_answer' => [
        'en' => 'Tuition fees vary depending on the grade level and chosen specialization. The fees cover educational costs, textbooks, extracurricular activities, and basic school services. For more precise details, please contact the school\'s finance department.',
        'fa' => 'هزینه‌های شهریه بر اساس مقطع تحصیلی و رشته انتخابی متفاوت است. شهریه شامل هزینه‌های آموزشی، کتاب‌های درسی، فعالیت‌های فوق‌برنامه و خدمات پایه مدرسه می‌شود. برای اطلاعات دقیق‌تر، لطفاً با بخش مالی مدرسه تماس بگیرید.'
    ],
    'faq_documents_title' => [
        'en' => 'What documents are required for student registration?',
        'fa' => 'چه مدارکی برای ثبت‌نام دانش‌آموز لازم است؟'
    ],
    'faq_documents_answer' => [
        'en' => 'Required documents include: student\'s passport and Emirates ID (original and copy), birth certificate, 6 passport-sized photos with white background, health and vaccination records, previous academic records and transcripts, transfer certificate from previous school (if applicable), and parents\' identification documents. International students may need additional documentation according to UAE regulations.',
        'fa' => 'مدارک مورد نیاز شامل: پاسپورت و کارت شناسایی امارات دانش‌آموز (اصل و کپی)، گواهی تولد، ۶ قطعه عکس پرسنلی با پس‌زمینه سفید، سوابق بهداشتی و واکسیناسیون، سوابق و کارنامه‌های تحصیلی قبلی، گواهی انتقال از مدرسه قبلی (در صورت وجود) و مدارک شناسایی والدین می‌باشد. دانش‌آموزان بین‌المللی ممکن است به مدارک اضافی طبق مقررات امارات متحده عربی نیاز داشته باشند.'
    ],
    'faq_age_requirements_title' => [
        'en' => 'What are the age requirements for admission?',
        'fa' => 'شرایط سنی برای پذیرش چیست؟'
    ],
    'faq_age_requirements_answer' => [
        'en' => 'Age requirements depend on the grade level. For kindergarten, students must be at least 4 years old by August 31st of the academic year. For first grade, students must be at least 6 years old. For other grades, appropriate age progression applies. In special cases, placement tests may be used to determine the suitable grade level based on the student\'s academic abilities.',
        'fa' => 'شرایط سنی بسته به مقطع تحصیلی متفاوت است. برای پیش‌دبستانی، دانش‌آموزان باید حداقل ۴ سال تا ۳۱ مرداد سال تحصیلی داشته باشند. برای کلاس اول، دانش‌آموزان باید حداقل ۶ سال سن داشته باشند. برای سایر مقاطع، پیشرفت سنی مناسب اعمال می‌شود. در موارد خاص، ممکن است از آزمون‌های تعیین سطح برای تعیین مقطع تحصیلی مناسب بر اساس توانایی‌های تحصیلی دانش‌آموز استفاده شود.'
    ],

    // سوالات خدمات مدرسه
    'faq_transportation_title' => [
        'en' => 'How does the school handle student transportation?',
        'fa' => 'مدرسه چگونه به حمل و نقل و جابه‌جایی دانش‌آموزان رسیدگی می‌کند؟'
    ],
    'faq_transportation_answer' => [
        'en' => 'The school provides safe and reliable transportation services for students. The bus services include well-equipped buses with skilled drivers, and routes are closely monitored. For more information and to register for transportation, please contact the school\'s transportation department.',
        'fa' => 'مدرسه خدمات حمل و نقل ایمن و قابل اعتماد را برای دانش‌آموزان فراهم می‌آورد. سرویس‌های مدرسه شامل اتوبوس‌های مجهز با رانندگان ماهر است و مسیرها تحت نظارت دقیق قرار دارند. برای اطلاعات بیشتر و ثبت‌نام در سرویس حمل و نقل، لطفاً با بخش حمل و نقل مدرسه تماس بگیرید.'
    ],
    'faq_special_support_title' => [
        'en' => 'Does the school have a program for students who require special support?',
        'fa' => 'آیا مدرسه برنامه‌ای برای دانش‌آموزانی که نیاز به حمایت ویژه دارند دارد؟'
    ],
    'faq_special_support_answer' => [
        'en' => 'Yes, our school offers specialized programs to support students with special needs. These programs include individualized teaching and psychological and social support to help students succeed in the educational environment.',
        'fa' => 'بله، مدرسه ما برنامه‌های ویژه‌ای برای حمایت از دانش‌آموزان با نیازهای خاص دارد. این برنامه‌ها شامل آموزش فردی و حمایت‌های روان‌شناختی و اجتماعی است تا به دانش‌آموزان کمک کند تا در محیط آموزشی به بهترین شکل ممکن پیشرفت کنند.'
    ],
    'faq_cafeteria_title' => [
        'en' => 'Does the school have a cafeteria and what type of food is served?',
        'fa' => 'آیا مدرسه غذاخوری دارد و چه نوع غذایی سرو می‌شود؟'
    ],
    'faq_cafeteria_answer' => [
        'en' => 'Yes, our school has a cafeteria that serves nutritious and balanced meals. The menu includes a variety of healthy options including local and international cuisine, with special attention to dietary restrictions and preferences. The food is prepared fresh daily under strict hygiene standards. Parents can also opt to send packed lunches for their children if preferred.',
        'fa' => 'بله، مدرسه ما دارای غذاخوری است که وعده‌های غذایی مغذی و متعادل ارائه می‌دهد. منوی غذا شامل انواع گزینه‌های سالم از جمله غذاهای محلی و بین‌المللی است، با توجه ویژه به محدودیت‌ها و ترجیحات غذایی. غذا هر روز تازه و تحت استانداردهای بهداشتی سختگیرانه تهیه می‌شود. والدین همچنین می‌توانند در صورت تمایل، برای فرزندان خود غذای بسته‌بندی شده بفرستند.'
    ],
    'faq_healthcare_title' => [
        'en' => 'What healthcare services are available at school?',
        'fa' => 'چه خدمات بهداشتی در مدرسه در دسترس است؟'
    ],
    'faq_healthcare_answer' => [
        'en' => 'Our school is equipped with a medical clinic staffed by qualified nurses during school hours. The clinic provides first aid, handles minor injuries and illnesses, and manages routine health check-ups for students. In case of emergencies, we have protocols in place to ensure rapid response and communication with parents. Additionally, we maintain updated health records for all students including vaccination histories and any specific health conditions.',
        'fa' => 'مدرسه ما مجهز به یک کلینیک پزشکی با پرستاران واجد شرایط در ساعات مدرسه است. کلینیک خدمات کمک‌های اولیه، رسیدگی به جراحات و بیماری‌های جزئی و مدیریت چکاپ‌های معمول سلامت برای دانش‌آموزان را ارائه می‌دهد. در صورت بروز شرایط اضطراری، ما پروتکل‌هایی برای اطمینان از پاسخ سریع و ارتباط با والدین داریم. علاوه بر این، ما سوابق بهداشتی به‌روز برای تمام دانش‌آموزان از جمله سوابق واکسیناسیون و هرگونه شرایط خاص سلامتی را نگهداری می‌کنیم.'
    ],

    // سوالات آموزشی
    'faq_assessment_title' => [
        'en' => 'How are students assessed throughout the year?',
        'fa' => 'دانش‌آموزان در طول سال چگونه ارزیابی می‌شوند؟'
    ],
    'faq_assessment_answer' => [
        'en' => 'Students are assessed through a comprehensive evaluation system including continuous assessment, mid-term and final examinations, projects, and class participation. We use both formative and summative assessment methods to ensure a holistic evaluation of student progress. Report cards are issued quarterly, providing detailed feedback on academic performance and personal development.',
        'fa' => 'دانش‌آموزان از طریق یک سیستم ارزیابی جامع شامل ارزیابی مستمر، امتحانات میان‌ترم و پایان‌ترم، پروژه‌ها و مشارکت کلاسی ارزیابی می‌شوند. ما از روش‌های ارزیابی تکوینی و تجمعی استفاده می‌کنیم تا اطمینان حاصل شود که پیشرفت دانش‌آموز به صورت همه‌جانبه ارزیابی می‌شود. کارنامه‌ها به صورت فصلی صادر می‌شوند و بازخورد دقیقی در مورد عملکرد تحصیلی و رشد شخصی ارائه می‌دهند.'
    ],
    'faq_international_exams_title' => [
        'en' => 'Does the school offer preparation for international examinations?',
        'fa' => 'آیا مدرسه آمادگی برای آزمون‌های بین‌المللی ارائه می‌دهد؟'
    ],
    'faq_international_exams_answer' => [
        'en' => 'Yes, we provide preparation courses for several international examinations including TOEFL, IELTS, and SAT for older students. These preparation courses are offered as optional programs and are designed to help students meet international academic standards and prepare for higher education abroad. Our qualified teachers use specialized materials and exam-focused strategies to maximize students\' success in these tests.',
        'fa' => 'بله، ما دوره‌های آمادگی برای چندین آزمون بین‌المللی از جمله تافل، آیلتس و SAT برای دانش‌آموزان بزرگتر ارائه می‌دهیم. این دوره‌های آمادگی به عنوان برنامه‌های اختیاری ارائه می‌شوند و برای کمک به دانش‌آموزان در رسیدن به استانداردهای آکادمیک بین‌المللی و آمادگی برای تحصیلات عالی در خارج از کشور طراحی شده‌اند. معلمان واجد شرایط ما از مواد تخصصی و استراتژی‌های متمرکز بر آزمون استفاده می‌کنند تا موفقیت دانش‌آموزان را در این آزمون‌ها به حداکثر برسانند.'
    ],
    'faq_homework_title' => [
        'en' => 'What is the school\'s homework policy?',
        'fa' => 'سیاست مدرسه در مورد تکالیف خانه چیست؟'
    ],
    'faq_homework_answer' => [
        'en' => 'Our homework policy is designed to reinforce classroom learning without overwhelming students. The amount of homework is age-appropriate and increases gradually as students advance in grades. Homework typically includes regular practice in core subjects, reading assignments, and occasional project work. We encourage parental involvement in reviewing homework but emphasize that the work should primarily be completed by students to develop their independence and responsibility.',
        'fa' => 'سیاست تکلیف خانه ما برای تقویت یادگیری کلاسی بدون ایجاد فشار بیش از حد بر دانش‌آموزان طراحی شده است. میزان تکالیف متناسب با سن است و با پیشرفت دانش‌آموزان در مقاطع تحصیلی به تدریج افزایش می‌یابد. تکالیف معمولاً شامل تمرین منظم در دروس اصلی، تکالیف خواندن و گاهی کار پروژه‌ای است. ما مشارکت والدین را در بررسی تکالیف تشویق می‌کنیم، اما تأکید داریم که کار باید عمدتاً توسط دانش‌آموزان انجام شود تا استقلال و مسئولیت‌پذیری آنها تقویت شود.'
    ],
    'faq_counseling_title' => [
        'en' => 'Does the school provide academic and career counseling?',
        'fa' => 'آیا مدرسه مشاوره تحصیلی و شغلی ارائه می‌دهد؟'
    ],
    'faq_counseling_answer' => [
        'en' => 'Yes, we have a dedicated counseling department that provides both academic and career guidance. Our counselors work with students to help them identify their strengths, interests, and goals. For high school students, we offer career orientation sessions, university application support, and information about various educational paths. The counseling team also provides resources and organizes workshops on study skills, time management, and test preparation strategies.',
        'fa' => 'بله، ما یک بخش مشاوره اختصاصی داریم که راهنمایی‌های تحصیلی و شغلی ارائه می‌دهد. مشاوران ما با دانش‌آموزان همکاری می‌کنند تا به آنها در شناسایی نقاط قوت، علایق و اهداف خود کمک کنند. برای دانش‌آموزان دبیرستان، ما جلسات آشنایی با مشاغل، پشتیبانی درخواست دانشگاه و اطلاعات در مورد مسیرهای مختلف آموزشی ارائه می‌دهیم. تیم مشاوره همچنین منابع ارائه می‌دهد و کارگاه‌هایی درباره مهارت‌های مطالعه، مدیریت زمان و استراتژی‌های آمادگی آزمون برگزار می‌کند.'
    ],
    
    // عبارات جستجو و CTA
    'faq_search_placeholder' => [
        'en' => 'Search FAQs...',
        'fa' => 'جستجو در سوالات متداول...'
    ],
    'faq_no_results' => [
        'en' => 'No results found',
        'fa' => 'نتیجه‌ای یافت نشد'
    ],
    'faq_try_again' => [
        'en' => 'Please try different search terms or contact us for more information',
        'fa' => 'لطفاً عبارت جستجوی دیگری را امتحان کنید یا برای اطلاعات بیشتر با ما تماس بگیرید'
    ],
    'faq_more_questions' => [
        'en' => 'Still Have Questions?',
        'fa' => 'هنوز سوالی دارید؟'
    ],
    'faq_contact_us_text' => [
        'en' => 'If you couldn\'t find the answer to your question, please check our registration terms or contact our support team. We\'re here to help you.',
        'fa' => 'اگر پاسخ سوال خود را پیدا نکردید، لطفاً شرایط و ضوابط ثبت‌نام ما را بررسی کنید یا با تیم پشتیبانی ما تماس بگیرید. ما آماده کمک به شما هستیم.'
    ],
    // به انتهای آرایه $translationsFallback این موارد را اضافه کنید
'no_posts' => [
    'en' => 'No Posts Found',
    'fa' => 'هیچ مطلبی یافت نشد'
],
'no_search_results' => [
    'en' => 'No results found for',
    'fa' => 'هیچ نتیجه‌ای برای جستجوی شما یافت نشد'
],
'view_all_posts' => [
    'en' => 'View All Posts',
    'fa' => 'مشاهده همه مطالب'
]
];

// Use fallback translations if JSON translations are not loaded
if (empty($translations)) {
    $translations = $translationsFallback;
}

/**
 * Get translation from fallback array
 *
 * @param string $key Text key
 * @param string $lang Language code (fa or en)
 * @return string Translated text or original key
 */
function t($key, $lang) {
    global $translations;
    return isset($translations[$key][$lang]) ? $translations[$key][$lang] : $key;
}
/**
 * تبدیل اعداد انگلیسی به فارسی
 * 
 * @param string|int $number عدد یا رشته حاوی اعداد انگلیسی
 * @return string رشته حاوی اعداد فارسی
 */
function convertToFarsiNumber($number) {
    $farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    
    return str_replace($englishDigits, $farsiDigits, (string)$number);
}

/**
 * نمایش شماره تلفن با فرمت مناسب زبان
 * 
 * @param string $phone شماره تلفن
 * @param string $lang زبان (en یا fa)
 * @return string شماره تلفن فرمت‌بندی شده
 */
function formatPhone($phone, $lang = 'en') {
    // حذف کاراکترهای غیر عددی
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    
    // فرمت‌بندی شماره تلفن
    if (strlen($cleanPhone) >= 10) {
        // برای اعداد طولانی مثل شماره موبایل با کد کشور
        $formattedPhone = '+' . substr($cleanPhone, 0, 3) . ' ' . substr($cleanPhone, 3, 2) . ' ' . substr($cleanPhone, 5, 3) . ' ' . substr($cleanPhone, 8);
    } else {
        // برای شماره‌های کوتاه‌تر
        $formattedPhone = $phone;
    }
    
    // تبدیل به فارسی برای زبان فارسی
    if ($lang == 'fa') {
        return convertToFarsiNumber($formattedPhone);
    }
    
    return $formattedPhone;
}

// Default redirection to English language
if (!defined('REDIRECT_DONE')) {
    define('REDIRECT_DONE', true);
    
    // If language parameter is not set
    if (!isset($_GET['lang'])) {
        // Create new URL with English language parameter
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $connector = (strpos($current_url, '?') !== false) ? '&' : '?';
        $redirect_url = $current_url . $connector . 'lang=en';
        
        // Redirect to new URL
        header("Location: $redirect_url");
        exit;
    }
}

?>