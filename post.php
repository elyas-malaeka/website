<?php
/**
 * صفحه نمایش پست تکی
 *
 * نمایش پست تکی با طراحی مدرن، پاسخگو و انعطاف‌پذیر
 * با پشتیبانی کامل از نمایش تصاویر و قابلیت دوزبانه
 *
 * @package Salman Educational Complex
 * @version 3.0
 */

// لود کردن فایل کانفیگ
require_once 'includes/config.php';

// دریافت زبان فعلی
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');

// دریافت شناسه پست
$postId = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$postId) {
    header('Location: blog.php' . ($isRtl ? '?lang=fa' : '')); 
    exit;
}

// اتصال به دیتابیس
$conn = connectDB();

// افزایش تعداد بازدید
$conn->query("UPDATE post SET views = views + 1 WHERE id = $postId");

// دریافت اطلاعات پست
$sql = "SELECT p.*, c.category_name, c.category_name_en
        FROM post p
        LEFT JOIN categories c ON p.category_id = c.category_id
        WHERE p.id = $postId";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header('Location: blog.php' . ($isRtl ? '?lang=fa' : '')); 
    exit;
}
$post = $result->fetch_assoc();

// گرفتن دسته‌بندی‌ها
$categories_sql = "SELECT c.*, COUNT(p.id) as post_count
                FROM categories c
                LEFT JOIN post p ON c.category_id = p.category_id
                GROUP BY c.category_id
                ORDER BY c.category_name";
$categories_result = $conn->query($categories_sql);
$categories = [];
if ($categories_result->num_rows > 0) {
    while ($row = $categories_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// گرفتن پست‌های مرتبط (از همان دسته‌بندی)
$related_sql = "SELECT * FROM post 
                WHERE category_id = {$post['category_id']} 
                AND id != $postId 
                ORDER BY publish_date DESC LIMIT 3";
$related_result = $conn->query($related_sql);
$related_posts = [];
if ($related_result->num_rows > 0) {
    while ($row = $related_result->fetch_assoc()) {
        $related_posts[] = $row;
    }
}

// گرفتن آخرین پست‌ها
$latest_sql = "SELECT * FROM post WHERE id != $postId ORDER BY publish_date DESC LIMIT 4";
$latest_result = $conn->query($latest_sql);
$latest_posts = [];
if ($latest_result->num_rows > 0) {
    while ($row = $latest_result->fetch_assoc()) {
        $latest_posts[] = $row;
    }
}

// بستن اتصال دیتابیس
closeDB($conn);

// تعیین عنوان صفحه
$pageTitle = $lang == 'en' ? $post['title_en'] : $post['title'];

// تعیین تعداد تصاویر موجود برای استفاده در طراحی پویا
$imageCount = 0;
if (!empty($post['image1'])) $imageCount++;
if (!empty($post['image2'])) $imageCount++;

// تعیین تاریخ پست
$postDate = formatDate($post['publish_date'], $lang);

// تعیین زمان خواندن تقریبی پست
$contentLength = strlen($lang == 'en' ? $post['content1_en'] . $post['content2_en'] : $post['content1'] . $post['content2']);
$readingTime = ceil($contentLength / 2000); // تقریباً 2000 کاراکتر برای 1 دقیقه خواندن
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo htmlspecialchars(truncateText($lang == 'en' ? $post['content1_en'] : $post['content1'], 150)); ?>" />
    
    <title><?php echo htmlspecialchars($pageTitle); ?> - <?php echo SITE_NAME_EN; ?></title>
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars(truncateText($lang == 'en' ? $post['content1_en'] : $post['content1'], 150)); ?>" />
    <meta property="og:image" content="<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/blog/{$post['main_image']}"; ?>" />
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta property="og:type" content="article" />
    
    <!-- Favicon -->
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
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/magnific-popup/magnific-popup.css" />
    
    <!-- Template Styles -->
    <link rel="stylesheet" href="assets/css/salman.css" />
    
    <!-- Post Specific Styles -->
    <link rel="stylesheet" href="assets/css/post.css" />
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Header for Post -->
        <section class="post-hero">
            <div class="post-hero__bg" style="background-image: url('assets/images/blog/<?php echo htmlspecialchars($post['main_image']); ?>')">
                <div class="post-hero__overlay"></div>
            </div>
            
            <div class="container">
                <div class="post-hero__content wow fadeIn" data-wow-delay="200ms">
                    <!-- Category Badge -->
                    <div class="post-hero__category">
                        <a href="blog.php?category=<?php echo $post['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                            <?php echo htmlspecialchars($lang == 'en' ? $post['category_name_en'] : $post['category_name']); ?>
                        </a>
                    </div>
                    
                    <!-- Post Title -->
                    <h1 class="post-hero__title">
                        <?php echo htmlspecialchars($lang == 'en' ? $post['title_en'] : $post['title']); ?>
                    </h1>
                    
                    <!-- Post Meta -->
                    <div class="post-hero__meta">
                        <div class="post-hero__date">
                            <i class="far fa-calendar-alt"></i>
                            <span><?php echo $postDate; ?></span>
                        </div>
                        
                        <div class="post-hero__views">
                            <i class="far fa-eye"></i>
                            <span><?php echo number_format($post['views']); ?> <?php echo t('views', $lang); ?></span>
                        </div>
                        
                        <div class="post-hero__reading-time">
                            <i class="far fa-clock"></i>
                            <span><?php echo $readingTime; ?> <?php echo $lang == 'en' ? 'min read' : 'دقیقه مطالعه'; ?></span>
                        </div>
                    </div>
                    
                    <!-- Breadcrumbs -->
                    <div class="post-hero__breadcrumbs">
                        <a href="index.php<?php echo $isRtl ? '?lang=fa' : ''; ?>"><?php echo $lang == 'en' ? 'Home' : 'صفحه اصلی'; ?></a>
                        <i class="fas fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        <a href="blog.php<?php echo $isRtl ? '?lang=fa' : ''; ?>"><?php echo t('blog_title', $lang); ?></a>
                        <i class="fas fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        <span><?php echo htmlspecialchars($pageTitle); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Area -->
        <section class="post-content">
            <div class="container">
                <div class="row">
                    <!-- Main Content Column -->
                    <div class="col-lg-8">
                        <div class="post-content__main wow fadeInUp" data-wow-delay="300ms">
                            <!-- First Content Section -->
                            <div class="post-content__text">
                                <?php echo $lang == 'en' ? $post['content1_en'] : $post['content1']; ?>
                            </div>
                            
                            <!-- Post Images Gallery - Flexible based on image count -->
                            <?php if ($imageCount > 0): ?>
                            <div class="post-content__gallery">
                                <div class="row">
                                    <?php if (!empty($post['image1'])): ?>
                                    <div class="col-md-<?php echo $imageCount == 1 ? '12' : '6'; ?>">
                                        <div class="post-content__gallery-item">
                                            <a href="assets/images/blog/Extra_Post_Images/<?php echo htmlspecialchars($post['image1']); ?>" class="post-content__gallery-link">
                                                <img src="assets/images/blog/Extra_Post_Images/<?php echo htmlspecialchars($post['image1']); ?>" alt="<?php echo htmlspecialchars($pageTitle); ?> - 1" class="post-content__gallery-img">
                                                <div class="post-content__gallery-overlay">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($post['image2'])): ?>
                                    <div class="col-md-<?php echo $imageCount == 1 ? '12' : '6'; ?>">
                                        <div class="post-content__gallery-item">
                                            <a href="assets/images/blog/Extra_Post_Images/<?php echo htmlspecialchars($post['image2']); ?>" class="post-content__gallery-link">
                                                <img src="assets/images/blog/Extra_Post_Images/<?php echo htmlspecialchars($post['image2']); ?>" alt="<?php echo htmlspecialchars($pageTitle); ?> - 2" class="post-content__gallery-img">
                                                <div class="post-content__gallery-overlay">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Second Content Section -->
                            <div class="post-content__text">
                                <?php echo $lang == 'en' ? $post['content2_en'] : $post['content2']; ?>
                            </div>
                            
                            <!-- Post Footer -->
                            <div class="post-content__footer">
                                <!-- Categories -->
                                <div class="post-content__categories">
                                    <span class="post-content__categories-title"><?php echo t('categories', $lang); ?>:</span>
                                    <a href="blog.php?category=<?php echo $post['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="post-content__category-link">
                                        <?php echo htmlspecialchars($lang == 'en' ? $post['category_name_en'] : $post['category_name']); ?>
                                    </a>
                                </div>
                                
                                <!-- Social Share Buttons -->
                                <div class="post-content__share">
                                    <span class="post-content__share-title"><?php echo $lang == 'en' ? 'Share:' : 'اشتراک‌گذاری:'; ?></span>
                                    <div class="post-content__share-buttons">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" class="post-content__share-link facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?php echo urlencode($pageTitle); ?>" target="_blank" class="post-content__share-link twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://wa.me/?text=<?php echo urlencode($pageTitle . " - https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" class="post-content__share-link whatsapp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="https://t.me/share/url?url=<?php echo urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?php echo urlencode($pageTitle); ?>" target="_blank" class="post-content__share-link telegram">
                                            <i class="fab fa-telegram-plane"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Related Posts Section -->
                        <?php if (!empty($related_posts)): ?>
                        <div class="post-related wow fadeInUp" data-wow-delay="400ms">
                            <h3 class="post-related__title"><?php echo $lang == 'en' ? 'Related Posts' : 'پست‌های مرتبط'; ?></h3>
                            
                            <div class="row">
                                <?php foreach ($related_posts as $rpost): ?>
                                <div class="col-md-4">
                                    <div class="post-related__item">
                                        <div class="post-related__image">
                                            <img src="assets/images/blog/<?php echo htmlspecialchars($rpost['main_image']); ?>" alt="<?php echo htmlspecialchars($lang == 'en' ? $rpost['title_en'] : $rpost['title']); ?>">
                                            <a href="post.php?id=<?php echo $rpost['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="post-related__link"></a>
                                        </div>
                                        
                                        <div class="post-related__content">
                                            <div class="post-related__date"><?php echo formatDate($rpost['publish_date'], $lang); ?></div>
                                            <h4 class="post-related__item-title">
                                                <a href="post.php?id=<?php echo $rpost['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                    <?php echo htmlspecialchars($lang == 'en' ? $rpost['title_en'] : $rpost['title']); ?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Sidebar Column -->
                    <div class="col-lg-4">
                        <div class="post-sidebar">
                            <!-- About Author/School Widget -->
                            <div class="post-sidebar__widget post-sidebar__author wow fadeInUp" data-wow-delay="300ms">
                                <div class="post-sidebar__author-image">
                                    <img src="assets/images/general/school-logo.png" alt="<?php echo SITE_NAME_EN; ?>">
                                </div>
                                
                                <div class="post-sidebar__author-content">
                                    <h4 class="post-sidebar__author-name"><?php echo SITE_NAME_EN; ?></h4>
                                    <p class="post-sidebar__author-bio">
                                        <?php echo $lang == 'en' 
                                            ? 'Salman Farsi Educational Complex is dedicated to providing quality education with innovative teaching methods.'
                                            : 'مجتمع آموزشی سلمان فارسی با هدف ارائه آموزش با کیفیت و روش‌های تدریس نوآورانه فعالیت می‌کند.'; 
                                        ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Search Widget -->
                            <div class="post-sidebar__widget post-sidebar__search wow fadeInUp" data-wow-delay="400ms">
                                <h4 class="post-sidebar__title">
                                    <?php echo t('search_here', $lang); ?>
                                </h4>
                                
                                <form action="blog.php" method="GET" class="post-sidebar__search-form">
                                    <?php if ($isRtl): ?>
                                    <input type="hidden" name="lang" value="fa">
                                    <?php endif; ?>
                                    <input type="text" name="search" placeholder="<?php echo t('search_here', $lang); ?>">
                                    <button type="submit" aria-label="<?php echo t('search_button', $lang); ?>">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Latest Posts Widget -->
                            <div class="post-sidebar__widget post-sidebar__latest wow fadeInUp" data-wow-delay="500ms">
                                <h4 class="post-sidebar__title">
                                    <?php echo t('latest_posts', $lang); ?>
                                </h4>
                                
                                <ul class="post-sidebar__latest-list">
                                    <?php foreach ($latest_posts as $lpost): ?>
                                    <li class="post-sidebar__latest-item">
                                        <div class="post-sidebar__latest-image">
                                            <img src="assets/images/blog/<?php echo htmlspecialchars($lpost['main_image']); ?>" alt="<?php echo htmlspecialchars($lang == 'en' ? $lpost['title_en'] : $lpost['title']); ?>">
                                        </div>
                                        
                                        <div class="post-sidebar__latest-content">
                                            <h5 class="post-sidebar__latest-title">
                                                <a href="post.php?id=<?php echo $lpost['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                    <?php echo htmlspecialchars($lang == 'en' ? $lpost['title_en'] : $lpost['title']); ?>
                                                </a>
                                            </h5>
                                            <span class="post-sidebar__latest-date">
                                                <?php echo formatDate($lpost['publish_date'], $lang); ?>
                                            </span>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            
                            <!-- Categories Widget -->
                            <div class="post-sidebar__widget post-sidebar__categories wow fadeInUp" data-wow-delay="600ms">
                                <h4 class="post-sidebar__title">
                                    <?php echo t('categories', $lang); ?>
                                </h4>
                                
                                <div class="post-sidebar__categories-list">
                                    <?php foreach ($categories as $category): ?>
                                        <?php if ($category['post_count'] > 0): ?>
                                            <a href="blog.php?category=<?php echo $category['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="post-sidebar__category-item <?php echo ($category['category_id'] == $post['category_id']) ? 'active' : ''; ?>">
                                                <?php echo htmlspecialchars($lang == 'en' ? $category['category_name_en'] : $category['category_name']); ?>
                                                <span><?php echo $category['post_count']; ?></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- Back to Blog Button -->
                            <div class="post-sidebar__widget post-sidebar__back-btn wow fadeInUp" data-wow-delay="700ms">
                                <a href="blog.php<?php echo $isRtl ? '?lang=fa' : ''; ?>" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-arrow-<?php echo $isRtl ? 'right' : 'left'; ?> me-2"></i>
                                    <?php echo $lang == 'en' ? 'Back to Blog' : 'بازگشت به وبلاگ'; ?>
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
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- Post Specific Scripts -->
    <script src="assets/js/post.js"></script>
</body>
</html>