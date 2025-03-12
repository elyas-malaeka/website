<?php
/**
 * صفحه وبلاگ و اخبار
 * 
 * نمایش پست‌های وبلاگ با قابلیت جستجو، فیلتر دسته‌بندی و پیجینیشن
 * طراحی جدید با گرید کارت‌های مدرن و امکانات کاربری پیشرفته
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

// لود کردن فایل کانفیگ
require_once 'includes/config.php';

// دریافت زبان فعلی
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');

// دریافت شماره صفحه
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) $page = 1;

// دریافت شناسه دسته‌بندی (اگر تنظیم شده باشد)
$categoryId = isset($_GET['category']) ? intval($_GET['category']) : null;

// دریافت عبارت جستجو (اگر تنظیم شده باشد)
$search = isset($_GET['search']) ? trim($_GET['search']) : null;

// اتصال به دیتابیس
$conn = connectDB();

// تعداد پست‌ها در هر صفحه
$postsPerPage = 6;
$offset = ($page - 1) * $postsPerPage;

// ساخت کوئری SQL
$sql = "SELECT p.*, c.category_name, c.category_name_en 
        FROM post p
        LEFT JOIN categories c ON p.category_id = c.category_id
        WHERE 1=1 ";

// اضافه کردن فیلتر دسته‌بندی
if ($categoryId) {
    $sql .= " AND p.category_id = $categoryId ";
}

// اضافه کردن فیلتر جستجو
if ($search) {
    $search = $conn->real_escape_string($search);
    if ($lang == 'en') {
        $sql .= " AND (p.title_en LIKE '%$search%' OR p.content1_en LIKE '%$search%' OR p.content2_en LIKE '%$search%') ";
    } else {
        $sql .= " AND (p.title LIKE '%$search%' OR p.content1 LIKE '%$search%' OR p.content2 LIKE '%$search%') ";
    }
}

// مرتب‌سازی و محدود کردن نتایج
$sql .= " ORDER BY p.publish_date DESC LIMIT $offset, $postsPerPage";

// اجرای کوئری
$result = $conn->query($sql);
$posts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

// محاسبه‌ی تعداد کل پست‌ها برای صفحه‌بندی
$count_sql = "SELECT COUNT(*) as total FROM post WHERE 1=1 ";
if ($categoryId) {
    $count_sql .= " AND category_id = $categoryId ";
}
if ($search) {
    if ($lang == 'en') {
        $count_sql .= " AND (title_en LIKE '%$search%' OR content1_en LIKE '%$search%' OR content2_en LIKE '%$search%') ";
    } else {
        $count_sql .= " AND (title LIKE '%$search%' OR content1 LIKE '%$search%' OR content2 LIKE '%$search%') ";
    }
}
$count_result = $conn->query($count_sql);
$total_posts = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $postsPerPage);

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

// گرفتن پست‌های محبوب
$popular_sql = "SELECT * FROM post ORDER BY views DESC LIMIT 3";
$popular_result = $conn->query($popular_sql);
$popular_posts = [];
if ($popular_result->num_rows > 0) {
    while ($row = $popular_result->fetch_assoc()) {
        $popular_posts[] = $row;
    }
}

// گرفتن آخرین پست‌ها
$latest_sql = "SELECT * FROM post ORDER BY publish_date DESC LIMIT 3";
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
$pageTitle = t('blog_title', $lang);
if ($search) {
    $pageTitle = t('search_results', $lang) . ': ' . htmlspecialchars($search);
} elseif ($categoryId) {
    foreach ($categories as $category) {
        if ($category['category_id'] == $categoryId) {
            $pageTitle = t('category_posts', $lang) . ': ' . ($lang == 'en' ? $category['category_name_en'] : $category['category_name']);
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?> - <?php echo SITE_NAME_EN; ?></title>
    
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
    
    <!-- Template Styles -->
    <link rel="stylesheet" href="assets/css/salman.css" />
    
    <!-- Blog Specific Styles -->
    <link rel="stylesheet" href="assets/css/blog.css" />
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <section class="terms-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
            <div class="blog-header__content wow fadeIn" data-wow-delay="100ms">
            <h1 class="blog-header__title">
                <?php echo $pageTitle; ?>
            </h1>
            <?php if ($search || $categoryId): ?>
            <p class="blog-header__subtitle">
                <?php if ($search): ?>
                    <?php echo t('search_results', $lang); ?>: "<?php echo htmlspecialchars($search); ?>"
                <?php elseif ($categoryId): ?>
                    <?php echo t('category_posts', $lang); ?>: 
                    <?php 
                    foreach ($categories as $category) {
                        if ($category['category_id'] == $categoryId) {
                            echo htmlspecialchars($lang == 'en' ? $category['category_name_en'] : $category['category_name']);
                            break;
                        }
                    }
                    ?>
                <?php endif; ?>
            </p>
            <?php else: ?>
            <p class="blog-header__subtitle">
                <?php echo $lang == 'fa' ? 'آخرین اخبار و مقالات مجتمع آموزشی سلمان فارسی' : 'Latest news and articles from Salman Farsi Educational Complex'; ?>
            </p>
            <?php endif; ?>
          </div>

            </div>
        </section>

        <!-- Blog Main Content -->
        <section class="blog-section">
            <div class="container">
                <div class="row">
                    <!-- Main Content Column -->
                    <div class="col-lg-8">
                        <?php if (count($posts) > 0): ?>
                            <!-- Featured Blog Post (first post) -->
                            <div class="featured-post wow fadeInUp" data-wow-delay="300ms">
                                <div class="featured-post__image">
                                    <img src="assets/images/blog/<?php echo $posts[0]['main_image']; ?>" alt="<?php echo htmlspecialchars($lang == 'en' ? $posts[0]['title_en'] : $posts[0]['title']); ?>">
                                    <a href="post.php?id=<?php echo $posts[0]['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="featured-post__link"></a>
                                    <div class="featured-post__date">
                                        <?php if ($lang == 'en'): ?>
                                            <span><?php echo date('d', strtotime($posts[0]['publish_date'])); ?></span>
                                            <?php echo date('M', strtotime($posts[0]['publish_date'])); ?>
                                        <?php else: ?>
                                            <?php 
                                            $jalali_date = gregorianToJalali($posts[0]['publish_date']);
                                            $jalali_parts = explode(' ', $jalali_date);
                                            ?>
                                            <span><?php echo $jalali_parts[0]; ?></span>
                                            <?php echo $jalali_parts[1]; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="featured-post__content">
                                    <div class="featured-post__category">
                                        <a href="blog.php?category=<?php echo $posts[0]['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                            <?php echo htmlspecialchars($lang == 'en' ? $posts[0]['category_name_en'] : $posts[0]['category_name']); ?>
                                        </a>
                                    </div>
                                    
                                    <h3 class="featured-post__title">
                                        <a href="post.php?id=<?php echo $posts[0]['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                            <?php echo htmlspecialchars($lang == 'en' ? $posts[0]['title_en'] : $posts[0]['title']); ?>
                                        </a>
                                    </h3>
                                    
                                    <p class="featured-post__text">
                                        <?php echo truncateText($lang == 'en' ? $posts[0]['content1_en'] : $posts[0]['content1'], 200); ?>
                                    </p>
                                    
                                    <a href="post.php?id=<?php echo $posts[0]['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="featured-post__more">
                                        <?php echo t('read_more', $lang); ?>
                                        <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                    </a>
                                </div>
                            </div>
                            
                                   <!-- Blog Posts Grid -->
                                   <div class="blog-grid wow fadeInUp" data-wow-delay="400ms">
                                <div class="row">
                                    <?php for ($i = 1; $i < count($posts); $i++): ?>
                                        <div class="col-md-6">
                                            <div class="blog-card">
                                            <div class="blog-card__image">
                                            <a href="post.php?id=<?php echo $posts[$i]['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                <img src="assets/images/blog/<?php echo $posts[$i]['main_image']; ?>" alt="<?php echo htmlspecialchars($lang == 'en' ? $posts[$i]['title_en'] : $posts[$i]['title']); ?>">
                                                <img src="assets/images/blog/<?php echo $posts[$i]['main_image']; ?>" alt="<?php echo htmlspecialchars($lang == 'en' ? $posts[$i]['title_en'] : $posts[$i]['title']); ?>">
                                                </a>
                                                <div class="blog-card__date">
                                                    <?php 
                                                    if ($lang == 'en') {
                                                        echo date('d M', strtotime($posts[$i]['publish_date']));
                                                    } else {
                                                        $jalali_date = gregorianToJalali($posts[$i]['publish_date']);
                                                        $jalali_parts = explode(' ', $jalali_date);
                                                        echo $jalali_parts[0] . ' ' . $jalali_parts[1];
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                                
                                                <div class="blog-card__content">
                                                    <div class="blog-card__category">
                                                        <a href="blog.php?category=<?php echo $posts[$i]['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                            <?php echo htmlspecialchars($lang == 'en' ? $posts[$i]['category_name_en'] : $posts[$i]['category_name']); ?>
                                                        </a>
                                                    </div>
                                                    
                                                    <h4 class="blog-card__title">
                                                        <a href="post.php?id=<?php echo $posts[$i]['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                            <?php echo htmlspecialchars($lang == 'en' ? $posts[$i]['title_en'] : $posts[$i]['title']); ?>
                                                        </a>
                                                    </h4>
                                                    
                                                    <p class="blog-card__text">
                                                        <?php echo truncateText($lang == 'en' ? $posts[$i]['content1_en'] : $posts[$i]['content1'], 100); ?>
                                                    </p>
                                                    
                                                    <a href="post.php?id=<?php echo $posts[$i]['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="blog-card__more">
                                                        <?php echo t('read_more', $lang); ?>
                                                        <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            
                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                            <div class="blog-pagination">
                                <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?><?php echo $categoryId ? '&category=' . $categoryId : ''; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="blog-pagination__arrow">
                                    <i class="fas fa-angle-<?php echo $isRtl ? 'right' : 'left'; ?>"></i>
                                </a>
                                <?php endif; ?>
                                
                                <?php 
                                // Calculate range of page numbers to display
                                $start_page = max(1, $page - 2);
                                $end_page = min($total_pages, $page + 2);
                                
                                for ($i = $start_page; $i <= $end_page; $i++): 
                                ?>
                                <a href="?page=<?php echo $i; ?><?php echo $categoryId ? '&category=' . $categoryId : ''; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="blog-pagination__page <?php echo $i == $page ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                                <?php endfor; ?>
                                
                                <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?><?php echo $categoryId ? '&category=' . $categoryId : ''; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="blog-pagination__arrow">
                                    <i class="fas fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <div class="no-posts wow fadeInUp" data-wow-delay="300ms">
                                <div class="no-posts__icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h3 class="no-posts__title"><?php echo t('no_posts', $lang); ?></h3>
                                <p class="no-posts__text">
                                    <?php echo $search 
                                        ? t('no_search_results', $lang) . ' "' . htmlspecialchars($search) . '"'
                                        : t('no_posts_yet', $lang); ?>
                                </p>
                                <a href="blog.php<?php echo $isRtl ? '?lang=fa' : ''; ?>" class="no-posts__button">
                                    <?php echo t('view_all_posts', $lang); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Sidebar Column -->
                    <div class="col-lg-4">
                        <div class="blog-sidebar">
                            <!-- Search Widget -->
                            <div class="blog-sidebar__widget blog-sidebar__search wow fadeInUp" data-wow-delay="300ms">
                                <h4 class="blog-sidebar__title">
                                    <?php echo t('search_here', $lang); ?>
                                </h4>
                                
                                <form action="blog.php" method="GET" class="blog-sidebar__search-form">
                                    <?php if ($isRtl): ?>
                                    <input type="hidden" name="lang" value="fa">
                                    <?php endif; ?>
                                    <?php if ($categoryId): ?>
                                    <input type="hidden" name="category" value="<?php echo $categoryId; ?>">
                                    <?php endif; ?>
                                    <input type="text" name="search" placeholder="<?php echo t('search_here', $lang); ?>">
                                    <button type="submit" aria-label="<?php echo t('search_button', $lang); ?>">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Latest Posts Widget -->
                            <div class="blog-sidebar__widget blog-sidebar__posts wow fadeInUp" data-wow-delay="400ms">
                                <h4 class="blog-sidebar__title">
                                    <?php echo t('latest_posts', $lang); ?>
                                </h4>
                                
                                <ul class="blog-sidebar__post-list">
                                    <?php foreach ($latest_posts as $post): ?>
                                        <li class="blog-sidebar__post-item">
                                            <div class="blog-sidebar__post-image">
                                                <img src="assets/images/blog/<?php echo htmlspecialchars($post['main_image']); ?>" alt="<?php echo htmlspecialchars($lang == 'en' ? $post['title_en'] : $post['title']); ?>">
                                            </div>
                                            
                                            <div class="blog-sidebar__post-content">
                                                <h5 class="blog-sidebar__post-title">
                                                    <a href="post.php?id=<?php echo $post['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                        <?php echo htmlspecialchars($lang == 'en' ? $post['title_en'] : $post['title']); ?>
                                                    </a>
                                                </h5>
                                                <span class="blog-sidebar__post-date">
                                                    <?php echo formatDate($post['publish_date'], $lang); ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            
                            <!-- Categories Widget -->
                            <div class="blog-sidebar__widget blog-sidebar__categories wow fadeInUp" data-wow-delay="500ms">
                                <h4 class="blog-sidebar__title">
                                    <?php echo t('categories', $lang); ?>
                                </h4>
                                
                                <div class="blog-sidebar__categories-list">
                                    <?php foreach ($categories as $category): ?>
                                        <?php if ($category['post_count'] > 0): ?>
                                            <a href="blog.php?category=<?php echo $category['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="blog-sidebar__category <?php echo ($categoryId == $category['category_id']) ? 'active' : ''; ?>">
                                                <?php echo htmlspecialchars($lang == 'en' ? $category['category_name_en'] : $category['category_name']); ?>
                                                <span><?php echo $category['post_count']; ?></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- Popular Articles Widget -->
                            <div class="blog-sidebar__widget blog-sidebar__popular wow fadeInUp" data-wow-delay="600ms">
                                <h4 class="blog-sidebar__title">
                                    <?php echo t('popular_articles', $lang); ?>
                                </h4>
                                
                                <div class="blog-sidebar__popular-list">
                                    <?php foreach ($popular_posts as $pop_post): ?>
                                        <div class="blog-sidebar__popular-item">
                                            <?php 
                                            // دریافت نام دسته‌بندی
                                            $category_name = '';
                                            foreach ($categories as $category) {
                                                if ($category['category_id'] == $pop_post['category_id']) {
                                                    $category_name = $lang == 'en' ? $category['category_name_en'] : $category['category_name'];
                                                    break;
                                                }
                                            }
                                            ?>
                                            <div class="blog-sidebar__popular-category">
                                                <?php echo htmlspecialchars($category_name); ?>
                                            </div>
                                            <h5 class="blog-sidebar__popular-title">
                                                <a href="post.php?id=<?php echo $pop_post['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                    <?php echo htmlspecialchars($lang == 'en' ? $pop_post['title_en'] : $pop_post['title']); ?>
                                                </a>
                                            </h5>
                                            <div class="blog-sidebar__popular-meta">
                                                <span><?php echo number_format($pop_post['views']); ?> <?php echo t('views', $lang); ?></span>
                                                <a href="post.php?id=<?php echo $pop_post['id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="blog-sidebar__popular-arrow">
                                                    <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
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
    
    <!-- Blog Specific Scripts -->
    <script src="assets/js/blog.js"></script>
     <!-- Cosmic Background JS -->
    <script src="assets/js/cosmic-bg.js"></script>
</body>
</html>