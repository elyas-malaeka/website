<?php
/**
 * Final Improved Brix Style Footer
 * 
 * Fixed translation issues and updated social links
 * Added language-specific logo handling
 * 
 * @package Salman Educational Complex
 * @version 1.2
 */

// Get current language
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$isRtl = ($lang == 'fa' || $lang == 'ar');

// Instagram posts - you can manually update these with your latest posts
$instagram_posts = [
    [
        'image' => 'assets/images/instagram/post1.jpg',
        'link' => 'https://www.instagram.com/ir.salmanfarsi/reel/DGxEgQRSYSO/'
    ],
    [
        'image' => 'assets/images/instagram/post2.jpg',
        'link' => 'https://www.instagram.com/ir.salmanfarsi/reel/DG0vtmpvZgA/'
    ],
    [
        'image' => 'assets/images/instagram/post3.jpg',
        'link' => 'https://www.instagram.com/ir.salmanfarsi/reel/DGXmpk-yCs9/'
    ],
    [
        'image' => 'assets/images/instagram/post4.jpg',
        'link' => 'https://www.instagram.com/p/DGua6ipPWj7/'
    ]
];
?>

<footer class="brix-footer">
    <div class="container">
        <!-- Footer Top Section -->
        <div class="footer-top">
            <!-- Logo and Description -->
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                    <!-- Different logo based on language -->
                    <?php if($isRtl): ?>
                    <img src="assets/images/farsi-logo.png" alt="<?php echo SITE_NAME; ?>">
                    <?php else: ?>
                    <img src="assets/images/logo-dark.png" alt="<?php echo SITE_NAME; ?>">
                    <?php endif; ?>
                </a>
                <p class="footer-description">
                    <?php echo t('school_description', $lang); ?>
                </p>
                
                <!-- Newsletter Subscribe -->
                <form action="includes/process-newsletter.php" method="post" class="footer-form">
                    <input type="email" name="EMAIL" placeholder="<?php echo t('enter_email', $lang); ?>" required>
                    <button type="submit"><?php echo $isRtl ? 'اشتراک' : 'Subscribe'; ?></button>
                </form>
            </div>
            
            <!-- Menu Links Column (Quick Links) -->
            <div class="footer-links">
                <h2 class="footer-widget__title"><?php echo t('quick_link', $lang); ?></h2>
                <ul class="list-unstyled footer-widget__links">
                    
                    <li><a href="contact.php"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('contact_us', $lang); ?></a></li>
                    <li><a href="blog.php"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('blog_news', $lang); ?></a></li>
                    <li><a href="Facilities.php"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('facilities', $lang); ?></a></li>
                    <li><a href="faq.php"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('faq', $lang); ?></a></li>
                    <li><a href="Privacy Policy.php"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('privacy', $lang); ?></a></li>
                </ul>
            </div>
            
            <!-- Company Links Column (Our Services) -->
            <div class="footer-links">
                <h2 class="footer-widget__title"><?php echo t('crriculum', $lang); ?></h2>
                <ul class="list-unstyled footer-widget__links">
                    <li><a href="Curriculum.php#ehsan-section"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('ehsan_section', $lang); ?></a></li>
                    <li><a href="Curriculum.php#primary-school"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('primary_school', $lang); ?></a></li>
                    <li><a href="Curriculum.php#middle-school"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('middle_school', $lang); ?></a></li>
                    <li><a href="Curriculum.php#high-school"><i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i> <?php echo t('high_school', $lang); ?></a></li>
                </ul>
            </div>
            
            <!-- Instagram Feed -->
            <div class="footer-links">
                <h2 class="footer-widget__title"><?php echo $isRtl ? 'ما را در اینستاگرام دنبال کنید' : 'Follow on Instagram'; ?></h2>
                <div class="instagram-grid">
                    <?php foreach($instagram_posts as $post): ?>
                    <a href="<?php echo $post['link']; ?>" target="_blank" class="instagram-item">
                        <img src="<?php echo $post['image']; ?>" alt="Instagram Post">
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Footer Divider -->
        <div class="footer-divider"></div>
        
        <!-- Footer Bottom Section -->
        <div class="footer-bottom">
            <p class="copyright">
                <?php echo t('copyright', $lang); ?> &copy; <?php echo date('Y'); ?> | <?php echo $isRtl ? 'تمامی حقوق محفوظ است' : 'All Rights Reserved'; ?>
            </p>
            <div class="social-icons">
                <a href="https://www.instagram.com/ir.salmanfarsi/" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/@salmanfarsiiranianschool73/videos" class="social-icon"><i class="fab fa-youtube"></i></a>
                <a href="https://wa.me/97142988116" class="social-icon"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- Newsletter Success Popup -->
<div class="newsletter-popup" id="newsletterPopup">
    <div class="popup-content">
        <div class="popup-icon">
            <i class="fas fa-check"></i>
        </div>
        <h3 class="popup-title" id="popupTitle"></h3>
        <p class="popup-message" id="popupMessage"></p>
        <button class="popup-close" id="popupClose"><?php echo $isRtl ? 'بستن' : 'Close'; ?></button>
    </div>
</div>
<div class="popup-overlay" id="popupOverlay"></div>

<style>
/* ==================
   Font Imports
   ================== */
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

/* ==================
   Brix Style Footer
   ================== */

/* Base Styles */
.brix-footer {
    font-family: 'Arial', sans-serif;
    background-color: #f8fafc;
    color: #4b5563; /* Darker text color for better contrast */
    padding: 80px 0 40px;
}

[dir="rtl"] .brix-footer {
    font-family: 'Vazir', Arial, sans-serif; /* Use Vazir font for RTL */
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Footer Top Section */
.footer-top {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 40px;
}

/* Logo and Description */
.footer-brand {
    padding-right: 40px;
}

.footer-logo {
    display: inline-block;
    margin-bottom: 20px;
}

.footer-logo img {
    max-height: 40px;
    width: auto;
}

.footer-description {
    font-size: 16px;
    line-height: 1.6;
    color: #4b5563; /* Darker text color */
    margin-bottom: 25px;
}

/* Newsletter Form */
.footer-form {
    position: relative;
    max-width: 400px;
    margin-bottom: 30px;
}

.footer-form input {
    width: 100%;
    height: 50px;
    padding: 0 20px;
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 25px;
    font-size: 14px;
    color: #4b5563;
}

.footer-form input:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
}

.footer-form button {
    position: absolute;
    right: 5px;
    top: 5px;
    height: 40px;
    padding: 0 25px;
    background-color: #6366f1;
    color: white;
    border: none;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.footer-form button:hover {
    background-color: #4f46e5;
}

[dir="rtl"] .footer-form button {
    right: auto;
    left: 5px;
}

/* Footer Titles - From your existing code */
.footer-widget__title {
    font-size: 18px;
    font-weight: 600;
    color: #6366f1;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-widget__title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background-color: #6366f1;
}

[dir="rtl"] .footer-widget__title:after {
    left: auto;
    right: 0;
}

/* Footer Links */
.list-unstyled {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-widget__links li {
    margin-bottom: 12px;
    position: relative;
}

.footer-widget__links li a {
    color: #4b5563; /* Darker text color */
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s;
    display: flex;
    align-items: center;
}

.footer-widget__links li a:hover {
    color: #6366f1;
}

.footer-widget__links li a i {
    margin-right: 8px;
    font-size: 12px;
    color: #6366f1;
}

[dir="rtl"] .footer-widget__links li a i {
    margin-right: 0;
    margin-left: 8px;
}

/* Instagram Grid */
.instagram-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.instagram-item {
    display: block;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s;
}

.instagram-item:hover {
    transform: translateY(-3px);
}

.instagram-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    display: block;
}

/* Footer Divider */
.footer-divider {
    height: 1px;
    background-color: #e2e8f0;
    margin: 40px 0;
}

/* Footer Bottom */
.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.copyright {
    font-size: 14px;
    color: #4b5563; /* Darker text color */
    margin: 0;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: #f1f5f9;
    border-radius: 50%;
    color: #64748b;
    text-decoration: none;
    transition: all 0.2s;
}

.social-icon:hover {
    background-color: #6366f1;
    color: white;
}

/* Newsletter Popup */
.newsletter-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    width: 90%;
    max-width: 400px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    z-index: 1001;
    overflow: hidden;
    display: none;
}

.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
    z-index: 1000;
    display: none;
}

.popup-content {
    padding: 30px;
    text-align: center;
}

.popup-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    background-color: #ecfdf5;
    color: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
}

.popup-icon.error {
    background-color: #fef2f2;
    color: #ef4444;
}

.popup-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 10px;
}

.popup-message {
    font-size: 16px;
    color: #4b5563;
    margin-bottom: 20px;
    line-height: 1.5;
}

.popup-close {
    background-color: #6366f1;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.popup-close:hover {
    background-color: #4f46e5;
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 0.3s forwards;
}

.slide-up {
    animation: slideUp 0.3s forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        opacity: 0;
        transform: translate(-50%, -40%);
    }
    to { 
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

/* RTL Support */
[dir="rtl"] .footer-brand {
    padding-right: 0;
    padding-left: 40px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .footer-top {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .footer-brand {
        grid-column: span 2;
        padding-right: 0;
    }
    
    [dir="rtl"] .footer-brand {
        padding-left: 0;
    }
}

@media (max-width: 768px) {
    .brix-footer {
        padding: 60px 0 30px;
    }
    
    .footer-top {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .footer-brand {
        grid-column: span 1;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .brix-footer {
        padding: 40px 0 20px;
    }
    
    .footer-form {
        margin-bottom: 40px;
    }
    
    .instagram-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .instagram-item img {
        height: 120px;
    }
}
</style>

<script>
// Newsletter form with localStorage for checking duplicate emails
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.querySelector('.footer-form');
    const popup = document.getElementById('newsletterPopup');
    const popupOverlay = document.getElementById('popupOverlay');
    const popupClose = document.getElementById('popupClose');
    const popupTitle = document.getElementById('popupTitle');
    const popupMessage = document.getElementById('popupMessage');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            // جلوگیری از ارسال معمولی فرم
            e.preventDefault();
            
            const email = this.querySelector('input[name="EMAIL"]').value;
            const isRtl = document.dir === 'rtl';
            
            // بررسی اعتبار فرمت ایمیل
            if (!validateEmail(email)) {
                showPopup(
                    'error',
                    isRtl ? 'خطا در ایمیل' : 'Invalid Email',
                    isRtl ? 'لطفا یک آدرس ایمیل معتبر وارد کنید.' : 'Please enter a valid email address.'
                );
                return;
            }
            
            // نمایش وضعیت در حال بارگذاری
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = isRtl ? '<i class="fas fa-spinner fa-spin"></i> در حال ارسال...' : '<i class="fas fa-spinner fa-spin"></i> Sending...';
            
            // تهیه داده‌ها برای ارسال
            const formData = new FormData();
            formData.append('EMAIL', email);
            
            // ارسال درخواست AJAX به سرور
            fetch('includes/process-newsletter.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // بازگرداندن دکمه به حالت عادی
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                // بررسی پاسخ سرور و نمایش پیام مناسب
                if (data.includes('success')) {
                    showPopup(
                        'success',
                        isRtl ? 'با موفقیت انجام شد!' : 'Success!',
                        isRtl ? 'شما با موفقیت در خبرنامه ما عضو شدید.' : 'You have successfully subscribed to our newsletter.'
                    );
                    newsletterForm.reset();
                } 
                else if (data.includes('already') || data.includes('exists')) {
                    showPopup(
                        'info',
                        isRtl ? 'اطلاع‌رسانی' : 'Notice',
                        isRtl ? 'این ایمیل قبلاً در خبرنامه ما ثبت شده است.' : 'This email is already subscribed to our newsletter.'
                    );
                }
                else {
                    showPopup(
                        'error',
                        isRtl ? 'خطا در ثبت‌نام' : 'Subscription Error',
                        isRtl ? 'متأسفانه مشکلی در ثبت‌نام شما پیش آمد. لطفاً بعداً دوباره تلاش کنید.' : 'There was a problem with your subscription. Please try again later.'
                    );
                    console.error('Server response:', data);
                }
            })
            .catch(error => {
                // بازگرداندن دکمه به حالت عادی در صورت خطا
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                // نمایش پیام خطا
                showPopup(
                    'error',
                    isRtl ? 'خطای ارتباط' : 'Connection Error',
                    isRtl ? 'ارتباط با سرور برقرار نشد. لطفاً اتصال اینترنت خود را بررسی کنید.' : 'Could not connect to the server. Please check your internet connection.'
                );
                console.error('Error:', error);
            });
        });
    }
    
    // بستن پاپ‌آپ با کلیک روی دکمه بستن
    if (popupClose) {
        popupClose.addEventListener('click', closePopup);
    }
    
    // بستن پاپ‌آپ با کلیک روی پس‌زمینه
    if (popupOverlay) {
        popupOverlay.addEventListener('click', closePopup);
    }
    
    // بستن پاپ‌آپ با فشردن کلید Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popup.style.display === 'block') {
            closePopup();
        }
    });
    
    /**
     * نمایش پاپ‌آپ با پیام
     */
    function showPopup(type, title, message) {
        const popupIcon = popup.querySelector('.popup-icon');
        
        // تنظیم کلاس و آیکون بر اساس نوع پیام
        popupIcon.className = 'popup-icon ' + type;
        
        if (type === 'error') {
            popupIcon.innerHTML = '<i class="fas fa-times"></i>';
            popupIcon.style.backgroundColor = '#fef2f2';
            popupIcon.style.color = '#ef4444';
        } else if (type === 'info') {
            popupIcon.innerHTML = '<i class="fas fa-info"></i>';
            popupIcon.style.backgroundColor = '#e0f2fe';
            popupIcon.style.color = '#0284c7';
        } else {
            popupIcon.innerHTML = '<i class="fas fa-check"></i>';
            popupIcon.style.backgroundColor = '#ecfdf5';
            popupIcon.style.color = '#10b981';
        }
        
        // تنظیم عنوان و متن پیام
        popupTitle.textContent = title;
        popupMessage.textContent = message;
        
        // نمایش پاپ‌آپ و پس‌زمینه
        popupOverlay.style.display = 'block';
        popup.style.display = 'block';
        
        // اضافه کردن کلاس‌های انیمیشن
        setTimeout(() => {
            popupOverlay.classList.add('fade-in');
            popup.classList.add('slide-up');
        }, 10);
    }
    
    /**
     * بستن پاپ‌آپ
     */
    function closePopup() {
        popupOverlay.classList.remove('fade-in');
        popup.classList.remove('slide-up');
        
        // مخفی کردن پاپ‌آپ پس از اتمام انیمیشن
        setTimeout(() => {
            popup.style.display = 'none';
            popupOverlay.style.display = 'none';
        }, 300);
    }
    
    /**
     * بررسی اعتبار فرمت ایمیل
     */
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});
</script>
    <!-- Back to Top Button -->
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__text"><?php echo t('back_top', $lang); ?></span>
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
    </a>