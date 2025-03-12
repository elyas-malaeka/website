<?php
/**
 * Core Functions
 * 
 * This file contains essential functions for the Salman Educational Complex website,
 * including post retrieval, pagination, category management, and content formatting.
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

require_once 'config.php';

/**
 * Get all published posts with pagination
 * 
 * Retrieves posts with filtering options for category and search,
 * and provides pagination functionality.
 * 
 * @param int $page Current page number
 * @param int $postsPerPage Number of posts per page
 * @param int|null $categoryId Optional category ID to filter by
 * @param string|null $search Optional search term
 * @return array Posts and pagination data
 */
function getPosts($page = 1, $postsPerPage = 6, $categoryId = null, $search = null) {
    $conn = connectDB();
    $lang = getCurrentLanguage();
    
    // Calculate offset for pagination
    $offset = ($page - 1) * $postsPerPage;
    
    // Start building the query
    $sql = "SELECT p.*, c.category_name, c.category_name_en 
            FROM post p
            LEFT JOIN categories c ON p.category_id = c.category_id
            WHERE 1=1";
    
    // Add category filter if provided
    if ($categoryId) {
        $sql .= " AND p.category_id = " . intval($categoryId);
    }
    
    // Add search filter if provided
    if ($search) {
        $search = $conn->real_escape_string($search);
        if ($lang == 'en') {
            $sql .= " AND (p.title_en LIKE '%$search%' OR p.content1_en LIKE '%$search%' OR p.content2_en LIKE '%$search%')";
        } else {
            $sql .= " AND (p.title LIKE '%$search%' OR p.content1 LIKE '%$search%' OR p.content2 LIKE '%$search%')";
        }
    }
    
    // Add order by and limit
    $sql .= " ORDER BY p.publish_date DESC LIMIT $offset, $postsPerPage";
    
    $result = $conn->query($sql);
    
    $posts = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    
    // Count total posts for pagination
    $countSql = "SELECT COUNT(*) AS total FROM post WHERE 1=1";
    
    if ($categoryId) {
        $countSql .= " AND category_id = " . intval($categoryId);
    }
    
    if ($search) {
        if ($lang == 'en') {
            $countSql .= " AND (title_en LIKE '%$search%' OR content1_en LIKE '%$search%' OR content2_en LIKE '%$search%')";
        } else {
            $countSql .= " AND (title LIKE '%$search%' OR content1 LIKE '%$search%' OR content2 LIKE '%$search%')";
        }
    }
    
    $countResult = $conn->query($countSql);
    $totalPosts = 0;
    
    if ($countResult && $countResult->num_rows > 0) {
        $row = $countResult->fetch_assoc();
        $totalPosts = $row['total'];
    }
    
    $totalPages = ceil($totalPosts / $postsPerPage);
    
    closeDB($conn);
    
    return [
        'posts' => $posts,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'totalPosts' => $totalPosts
    ];
}

/**
 * Get a single post by slug
 * 
 * Retrieves a specific post using its URL slug and 
 * increments the view count.
 * 
 * @param string $slug Post slug
 * @return array|null Post data or null if not found
 */
function getPostBySlug($slug) {
    $conn = connectDB();
    
    $slug = $conn->real_escape_string($slug);
    
    $sql = "SELECT p.*, c.category_name, c.category_name_en 
            FROM post p
            LEFT JOIN categories c ON p.category_id = c.category_id
            WHERE p.slug = '$slug'";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
        
        // Update view count
        $updateSql = "UPDATE post SET views = views + 1 WHERE id = " . $post['id'];
        $conn->query($updateSql);
        
        closeDB($conn);
        return $post;
    }
    
    closeDB($conn);
    return null;
}

/**
 * Get related posts
 * 
 * Retrieves posts that are related to the current post by category.
 * 
 * @param int $postId Current post ID
 * @param int $categoryId Category ID for finding related posts
 * @param int $limit Number of related posts to fetch
 * @return array Related posts
 */
function getRelatedPosts($postId, $categoryId, $limit = 3) {
    $conn = connectDB();
    
    $sql = "SELECT * FROM post 
            WHERE id != $postId 
            AND category_id = $categoryId 
            ORDER BY publish_date DESC 
            LIMIT $limit";
    
    $result = $conn->query($sql);
    
    $posts = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    
    closeDB($conn);
    
    return $posts;
}

/**
 * Get popular posts based on view count
 * 
 * Retrieves the most viewed posts for display in sidebars or widgets.
 * 
 * @param int $limit Number of popular posts to fetch
 * @return array Popular posts
 */
function getPopularPosts($limit = 5) {
    $conn = connectDB();
    
    $sql = "SELECT * FROM post 
            ORDER BY views DESC 
            LIMIT $limit";
    
    $result = $conn->query($sql);
    
    $posts = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    
    closeDB($conn);
    
    return $posts;
}

/**
 * Get all categories with post counts
 * 
 * Retrieves all categories along with the number of posts in each.
 * 
 * @return array Categories with post counts
 */
function getCategories() {
    $conn = connectDB();
    
    $sql = "SELECT c.*, COUNT(p.id) as post_count 
            FROM categories c
            LEFT JOIN post p ON c.category_id = p.category_id
            GROUP BY c.category_id
            ORDER BY c.category_name";
    
    $result = $conn->query($sql);
    
    $categories = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    
    closeDB($conn);
    
    return $categories;
}

/**
 * Get latest posts
 * 
 * Retrieves the most recent posts for display in sidebars or widgets.
 * 
 * @param int $limit Number of latest posts to fetch
 * @return array Latest posts
 */
function getLatestPosts($limit = 5) {
    $conn = connectDB();
    
    $sql = "SELECT * FROM post 
            ORDER BY publish_date DESC 
            LIMIT $limit";
    
    $result = $conn->query($sql);
    
    $posts = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    
    closeDB($conn);
    
    return $posts;
}

/**
 * Format date according to language
 * 
 * Formats dates differently based on the language (English or Persian).
 * 
 * @param string $date Date string
 * @param string $lang Language (en or fa)
 * @return string Formatted date
 */
function formatDate($date, $lang = 'en') {
    if ($lang == 'en') {
        return date('F j, Y', strtotime($date));
    } else {
        // Persian date formatting
        $months = [
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
        ];
        
        $day = date('j', strtotime($date));
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        
        // Convert to Persian (Hijri Shamsi) date
        // For accurate conversion, use gregorianToJalali() from config.php
        return gregorianToJalali($date);
    }
}

/**
 * Truncate text to a certain length
 * 
 * Shortens text to specified length for previews or excerpts.
 * 
 * @param string $text Text to truncate
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
 * Generate HTML for pagination links
 * 
 * Creates accessible and styled pagination controls.
 * 
 * @param int $currentPage Current page number
 * @param int $totalPages Total number of pages
 * @param string $baseUrl Base URL for pagination links
 * @return string HTML for pagination links
 */
function getPaginationLinks($currentPage, $totalPages, $baseUrl = '?') {
    if ($totalPages <= 1) {
        return '';
    }

    $lang = getCurrentLanguage();
    
    // Add language parameter to base URL if it's already set
    if (strpos($baseUrl, 'lang=') === false && $lang === 'fa') {
        $baseUrl .= (strpos($baseUrl, '?') !== false ? '&' : '?') . 'lang=fa';
    }
    
    // Ensure base URL ends with either ? or &
    if (strpos($baseUrl, '?') !== false) {
        if (substr($baseUrl, -1) !== '?' && substr($baseUrl, -1) !== '&') {
            $baseUrl .= '&';
        }
    } else {
        $baseUrl .= '?';
    }
    
    $pagination = '<div style="display: flex; justify-content: center; margin-top: 40px;">';
    
    // Previous page
    if ($currentPage > 1) {
        $pagination .= '<a href="' . $baseUrl . 'page=' . ($currentPage - 1) . '" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 5px; border-radius: 8px; background: #fff; color: #666; text-decoration: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05);"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"></path></svg></a>';
    }
    
    // Page numbers
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);
    
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<a href="#" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 5px; border-radius: 8px; background: #4361ee; color: #fff; text-decoration: none;">' . $i . '</a>';
        } else {
            $pagination .= '<a href="' . $baseUrl . 'page=' . $i . '" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 5px; border-radius: 8px; background: #fff; color: #666; text-decoration: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">' . $i . '</a>';
        }
    }
    
    // Next page
    if ($currentPage < $totalPages) {
        $pagination .= '<a href="' . $baseUrl . 'page=' . ($currentPage + 1) . '" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 5px; border-radius: 8px; background: #fff; color: #666; text-decoration: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05);"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"></path></svg></a>';
    }
    
    $pagination .= '</div>';
    
    return $pagination;
}

/**
 * Generate URL for language switching
 * 
 * Creates a URL that switches between English and Farsi while 
 * preserving other parameters.
 * 
 * @param string|null $currentLang Current language
 * @return string URL for switching language
 */
function getLanguageSwitchUrl($currentLang = null) {
    if ($currentLang === null) {
        $currentLang = getCurrentLanguage();
    }
    
    $url = $_SERVER['REQUEST_URI'];
    
    // Remove existing language parameter
    $url = preg_replace('/([?&])lang=[^&]+(&|$)/', '$1', $url);
    
    // Clean up URL
    $url = rtrim($url, '?&');
    
    // Add new language parameter
    $newLang = ($currentLang == 'en') ? 'fa' : 'en';
    $connector = (strpos($url, '?') !== false) ? '&' : '?';
    
    return $url . $connector . 'lang=' . $newLang;
}