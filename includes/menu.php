<?php
/**
 * Modern Navigation System - Final Polished Version
 * 
 * Navigation with purple topbar and floating glass-effect menu beneath it,
 * with improved dropdown positioning and enhanced mobile menu design.
 * 
 * @package Salman Educational Complex
 * @version 12.0
 */

require_once 'includes/config.php';

// Get current language for appropriate menu display
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');
$dir = $isRtl ? 'rtl' : 'ltr';
?>

<!-- Modern Navigation Styles -->
<style>
    :root {
        --primary-color: #6461FC;
        --secondary-color: #FF7A1A;
        --accent-color: #7854f7; /* Purple color from screenshot */
        --light-color: #ffffff;
        --dark-color: #333333;
        --dark-bg: #21212D;
        --gray-color: #f5f5f5;
        --border-radius: 15px;
        --box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* Base styles for the header to allow positioning */
    .main-header {
        position: absolute;
        width: 100%;
        z-index: 100;
        left: 0;
        top: 0;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }

    /* Topbar - Full width, directly on background */
    .topbar {
        padding: 12px 0;
        background-color: var(--accent-color);
        color: var(--light-color);
    }

    .topbar__inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .topbar__contact {
        display: flex;
        gap: 25px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .topbar__contact-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .topbar__contact-item a {
        color: var(--light-color);
        text-decoration: none;
        transition: var(--transition);
        font-size: 15px;
    }

    .topbar__contact-item a:hover {
        color: var(--secondary-color);
    }

    .topbar__contact-item i {
        margin-right: 5px;
    }

    [dir="rtl"] .topbar__contact-item i {
        margin-right: 0;
        margin-left: 5px;
    }

    .topbar__social {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .topbar__social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        color: var(--light-color);
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .topbar__social-link:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: scale(0);
        transition: transform 0.3s ease;
        z-index: -1;
    }

    .topbar__social-link:hover {
        color: var(--light-color);
        transform: translateY(-3px);
    }

    .topbar__social-link:hover:before {
        transform: scale(1);
    }

    .topbar__social-link i {
        position: relative;
        z-index: 1;
        font-size: 16px;
    }

    /* Main Navigation - Floating Menu with Light Gradient and Glass Effect */
    .main-nav {
        position: relative;
        padding: 30px 0;
        background-color: transparent; 
        z-index: 50;
    }

    .main-nav__inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 240, 255, 0.85) 100%);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px); /* For Safari */
        border-radius: var(--border-radius);
        padding: 0 30px;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.1),
            0 1px 3px rgba(255, 255, 255, 0.1) inset,
            0 -1px 0 rgba(255, 255, 255, 0.2) inset;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* Sticky behavior for main-nav */
    .main-nav.sticky {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 15px 0;
        background-color: transparent;
        animation: slideDown 0.5s forwards;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0);
        }
    }

    .main-nav__logo {
        max-width: 180px;
        padding: 15px 0;
    }

    .main-nav__logo img {
        width: 100%;
        height: auto;
        display: block;
    }

    .main-nav__menu {
        display: flex;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .main-nav__menu-item {
        position: relative;
    }

    .main-nav__menu-link {
        display: block;
        padding: 25px 20px;
        color: var(--dark-color);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .main-nav__menu-link:hover,
    .main-nav__menu-item.active > .main-nav__menu-link {
        color: var(--primary-color);
    }

    /* Dropdown Menus */
    .main-nav__menu-item.has-dropdown > .main-nav__menu-link::after {
        content: "\f107";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        margin-left: 6px;
        transition: var(--transition);
    }

    [dir="rtl"] .main-nav__menu-item.has-dropdown > .main-nav__menu-link::after {
        margin-left: 0;
        margin-right: 6px;
    }

    .main-nav__menu-item.has-dropdown:hover > .main-nav__menu-link::after {
        transform: rotate(180deg);
    }

    .main-nav__dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 220px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 240, 255, 0.9) 100%);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 10px 0;
        margin: 0;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: var(--transition);
        z-index: 100;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    [dir="rtl"] .main-nav__dropdown {
        left: auto;
        right: 0;
    }

    .main-nav__menu-item:hover > .main-nav__dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .main-nav__dropdown-item {
        position: relative;
    }

    .main-nav__dropdown-link {
        display: block;
        padding: 12px 20px;
        color: var(--dark-color);
        text-decoration: none;
        transition: var(--transition);
        border-left: 3px solid transparent;
    }

    [dir="rtl"] .main-nav__dropdown-link {
        border-left: none;
        border-right: 3px solid transparent;
    }

    .main-nav__dropdown-link:hover {
        background-color: rgba(100, 97, 252, 0.1);
        color: var(--primary-color);
        border-left-color: var(--primary-color);
    }

    [dir="rtl"] .main-nav__dropdown-link:hover {
        border-left-color: transparent;
        border-right-color: var(--primary-color);
    }

    /* Navigation Extras */
    .main-nav__extras {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
    }

    .search-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: var(--dark-color);
        text-decoration: none;
        cursor: pointer;
        transition: var(--transition);
        background-color: rgba(100, 97, 252, 0.1);
        border-radius: 50%;
    }

    .search-toggle:hover {
        color: var(--light-color);
        background-color: var(--primary-color);
    }

    .search-toggle i {
        font-size: 18px;
    }

    .lang-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: rgba(100, 97, 252, 0.1);
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        transition: var(--transition);
    }

    .lang-toggle:hover {
        background-color: var(--primary-color);
    }

    .lang-toggle img {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        object-fit: cover;
    }

    .main-nav__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 44px;
        padding: 0 25px;
        background-color: var(--primary-color);
        color: var(--light-color);
        border-radius: 50px;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .main-nav__btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
    }

    /* Mobile Menu Toggle - Removed from header */
    .mobile-menu-toggle {
        display: none;
    }

    /* =========== Mobile Navigation - Enhanced Design =========== */
    .mobile-nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
    }

    .mobile-nav.active {
        opacity: 1;
        visibility: visible;
    }

    .mobile-nav__container {
        position: fixed;
        top: 0;
        right: -320px;
        width: 320px;
        max-width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
        padding: 30px 0 0;
        overflow-y: auto;
        transition: var(--transition);
    }

    [dir="rtl"] .mobile-nav__container {
        right: auto;
        left: -320px;
    }

    .mobile-nav.active .mobile-nav__container {
        right: 0;
    }

    [dir="rtl"] .mobile-nav.active .mobile-nav__container {
        right: auto;
        left: 0;
    }

    .mobile-nav__header {
        padding: 0 30px;
        margin-bottom: 30px;
        position: relative;
    }

    .mobile-nav__close {
        position: absolute;
        top: 0;
        right: 30px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--light-color);
        border: none;
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
    }

    [dir="rtl"] .mobile-nav__close {
        right: auto;
        left: 30px;
    }

    .mobile-nav__close:hover {
        background-color: var(--secondary-color);
    }

    .mobile-nav__logo {
        max-width: 150px;
    }

    .mobile-nav__logo img {
        width: 100%;
        height: auto;
    }

    .mobile-nav__menu {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .mobile-nav__item {
        position: relative;
        margin-bottom: 5px;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }

    [dir="rtl"] .mobile-nav__item {
        border-left: none;
        border-right: 3px solid transparent;
    }

    .mobile-nav__item.active {
        border-left-color: var(--primary-color);
        background: rgba(100, 97, 252, 0.1);
    }

    [dir="rtl"] .mobile-nav__item.active {
        border-left-color: transparent;
        border-right-color: var(--primary-color);
    }

    .mobile-nav__link {
        display: block;
        padding: 15px 30px;
        color: var(--light-color);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .mobile-nav__link:hover {
        color: var(--secondary-color);
    }

    .mobile-nav__item.has-dropdown > .mobile-nav__link {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mobile-dropdown-toggle {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--light-color);
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }

    .mobile-dropdown-toggle.active {
        background-color: var(--secondary-color);
        transform: rotate(180deg);
    }

    .mobile-nav__dropdown {
        display: none;
        border-left: 1px dashed rgba(255, 255, 255, 0.2);
        margin-left: 30px;
        padding-left: 15px;
        list-style: none;
    }

    [dir="rtl"] .mobile-nav__dropdown {
        margin-left: 0;
        padding-left: 0;
        margin-right: 30px;
        padding-right: 15px;
        border-left: none;
        border-right: 1px dashed rgba(255, 255, 255, 0.2);
    }

    .mobile-nav__dropdown-link {
        display: block;
        padding: 12px 15px;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: var(--transition);
    }

    .mobile-nav__dropdown-link:hover {
        color: var(--secondary-color);
    }

    .mobile-nav__footer {
        background: rgba(0, 0, 0, 0.2);
        padding: 30px;
        margin-top: 30px;
    }

    .mobile-nav__contact {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
    }

    .mobile-nav__contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        color: rgba(255, 255, 255, 0.7);
    }

    .mobile-nav__contact-item i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--light-color);
    }

    .mobile-nav__contact-item a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: var(--transition);
    }

    .mobile-nav__contact-item a:hover {
        color: var(--secondary-color);
    }

    .mobile-nav__social {
        display: flex;
        gap: 10px;
    }

    .mobile-nav__social-link {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--light-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .mobile-nav__social-link:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
    }

    .mobile-nav__langs {
        margin-bottom: 20px;
    }

    .mobile-nav__langs h4 {
        color: rgba(255, 255, 255, 0.7); 
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: normal;
    }

    /* =========== Search Overlay =========== */
    .search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
    }

    .search-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .search-overlay__close {
        position: absolute;
        top: 30px;
        right: 30px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--light-color);
        border: none;
        font-size: 18px;
        cursor: pointer;
        transition: var(--transition);
    }

    [dir="rtl"] .search-overlay__close {
        right: auto;
        left: 30px;
    }

    .search-overlay__close:hover {
        background-color: var(--secondary-color);
    }

    .search-overlay__form {
        width: 90%;
        max-width: 600px;
        position: relative;
    }

    .search-overlay__input {
        width: 100%;
        height: 60px;
        background-color: transparent;
        border: none;
        border-bottom: 2px solid var(--light-color);
        color: var(--light-color);
        font-size: 24px;
        padding: 0 50px 0 0;
        transition: var(--transition);
    }

    [dir="rtl"] .search-overlay__input {
        padding: 0 0 0 50px;
    }

    .search-overlay__input:focus {
        outline: none;
        border-color: var(--secondary-color);
    }

    .search-overlay__input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .search-overlay__btn {
        position: absolute;
        top: 0;
        right: 0;
        height: 60px;
        background-color: transparent;
        border: none;
        color: var(--light-color);
        font-size: 24px;
        cursor: pointer;
        transition: var(--transition);
    }

    [dir="rtl"] .search-overlay__btn {
        right: auto;
        left: 0;
    }

    .search-overlay__btn:hover {
        color: var(--secondary-color);
    }

    /* =========== Language Dropdown =========== */
    .lang-dropdown {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(10px);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 240, 255, 0.9) 100%);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 10px;
        margin-top: 10px;
        min-width: 150px;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        z-index: 100;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .lang-toggle:hover + .lang-dropdown,
    .lang-dropdown:hover {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .lang-dropdown::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 8px solid rgba(255, 255, 255, 0.95);
    }

    .lang-dropdown__item {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        color: var(--dark-color);
        text-decoration: none;
        border-radius: 5px;
        transition: var(--transition);
        margin-bottom: 5px;
    }

    .lang-dropdown__item:last-child {
        margin-bottom: 0;
    }

    .lang-dropdown__item:hover {
        background-color: rgba(100, 97, 252, 0.1);
    }

    .lang-dropdown__item.active {
        background-color: var(--primary-color);
        color: var(--light-color);
    }

    .lang-dropdown__flag {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }

    [dir="rtl"] .lang-dropdown__flag {
        margin-right: 0;
        margin-left: 10px;
    }

    /* =========== Bottom Mobile Navigation =========== */
    .bottom-nav {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, var(--accent-color) 0%, #6247aa 100%);
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        z-index: 998;
        max-width: 320px;
        width: 90%;
        opacity: 0;
        visibility: hidden; /* Initially hidden for all devices */
    }

    .bottom-nav__item {
        position: relative;
        background-color: transparent;
        border: none;
        padding: 0;
        margin: 0;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--light-color);
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
    }

    .bottom-nav__item:hover,
    .bottom-nav__item.active {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .bottom-nav__icon {
        font-size: 22px;
        margin-bottom: 5px;
    }

    .bottom-nav__text {
        font-size: 10px;
        opacity: 0.8;
    }

    /* =========== Language Mobile Overlay =========== */
    .lang-overlay {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: var(--dark-bg);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        transform: translateY(100%);
        padding: 30px 20px;
        border-radius: 20px 20px 0 0;
        box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.2);
    }

    .lang-overlay.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .lang-overlay__close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--light-color);
        border: none;
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
    }

    [dir="rtl"] .lang-overlay__close {
        right: auto;
        left: 20px;
    }

    .lang-overlay__close:hover {
        background-color: var(--secondary-color);
    }

    .lang-overlay__header {
        margin-bottom: 20px;
        text-align: center;
    }

    .lang-overlay__title {
        color: var(--light-color);
        font-size: 24px;
        margin: 0;
    }

    .lang-overlay__items {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 300px;
        margin: 0 auto;
    }

    .lang-overlay__item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--light-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .lang-overlay__item.active {
        background-color: var(--primary-color);
    }

    .lang-overlay__item:hover {
        background-color: rgba(100, 97, 252, 0.3);
    }

    .lang-overlay__flag {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
    }

    [dir="rtl"] .lang-overlay__flag {
        margin-right: 0;
        margin-left: 15px;
    }

    .lang-overlay__name {
        font-size: 18px;
    }

    /* =========== Responsive Styles =========== */
    @media (max-width: 1199px) {
        .main-nav__menu-link {
            padding: 25px 15px;
        }
    }

    @media (max-width: 991px) {
        .main-nav__menu {
            display: none;
        }
        
        .bottom-nav {
            opacity: 1;
            visibility: visible; /* Show on mobile only */
        }

        .main-nav__inner {
            padding: 15px;
        }
    }

    @media (max-width: 767px) {
        .topbar__contact {
            display: none;
        }

        .topbar__inner {
            justify-content: center;
        }
        
        .main-nav__btn {
            display: none;
        }
    }

    /* Handle content padding for fixed header */
    .content-wrapper {
        padding-top: 150px; /* Adjust based on your header height */
    }
</style>

<!-- Header Section -->
<header class="main-header" dir="<?php echo $dir; ?>">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar__inner">
                <!-- Social Media Links (Moved to left) -->
                <div class="topbar__social">
                    <a href="https://wa.me/97142988116" class="topbar__social-link">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.youtube.com/@salmanfarsiiranianschool73/videos" class="topbar__social-link">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.instagram.com/ir.salmanfarsi/" class="topbar__social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>

                <!-- Contact Information (Moved to right) -->
                <ul class="topbar__contact">
                    <li class="topbar__contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@ir-salmanfarsi.com">info@ir-salmanfarsi.com</a>
                    </li>
                    <li class="topbar__contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:+97142988116">
                            <?php echo $lang == 'fa' ? '۹۷۱+ ۴ ۲۹۸ ۸۱۱ ۶' : '+971 4 298 811 6'; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Navigation - Floating style -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <div class="main-nav__inner">
                <!-- Logo -->
                <a href="index.php" class="main-nav__logo">
                    <img src="assets/images/logo-dark.png" alt="Salman Farsi Educational Complex">
                </a>

                <!-- Main Menu -->
                <ul class="main-nav__menu">
                    <li class="main-nav__menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <a href="index.php" class="main-nav__menu-link">
                            <?php echo $lang == 'fa' ? 'صفحه اصلی' : 'Home'; ?>
                        </a>
                    </li>
                    <li class="main-nav__menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                        <a href="about.php" class="main-nav__menu-link">
                            <?php echo $lang == 'fa' ? 'درباره ما' : 'About'; ?>
                        </a>
                    </li>
                    <li class="main-nav__menu-item has-dropdown">
                        <a href="#" class="main-nav__menu-link">
                            <?php echo $lang == 'fa' ? 'صفحات' : 'Pages'; ?>
                        </a>
                        <ul class="main-nav__dropdown">
                            <li class="main-nav__dropdown-item">
                                <a href="staff.php" class="main-nav__dropdown-link">
                                    <?php echo $lang == 'fa' ? 'کارکنان' : 'Staff'; ?>
                                </a>
                            </li>
                            <li class="main-nav__dropdown-item">
                                <a href="Curriculum.php" class="main-nav__dropdown-link">
                                    <?php echo $lang == 'fa' ? 'برنامه درسی' : 'Curriculum'; ?>
                                </a>
                            </li>
                            <li class="main-nav__dropdown-item">
                                <a href="Facilities.php" class="main-nav__dropdown-link">
                                    <?php echo $lang == 'fa' ? 'امکانات' : 'Facilities'; ?>
                                </a>
                            </li>
                            <li class="main-nav__dropdown-item">
                                <a href="faq.php" class="main-nav__dropdown-link">
                                    <?php echo $lang == 'fa' ? 'سوالات متداول' : 'FAQs'; ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="main-nav__menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">
                        <a href="blog.php" class="main-nav__menu-link">
                            <?php echo $lang == 'fa' ? 'اخبار' : 'News'; ?>
                        </a>
                    </li>
                    <li class="main-nav__menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                        <a href="contact.php" class="main-nav__menu-link">
                            <?php echo $lang == 'fa' ? 'تماس با ما' : 'Contact'; ?>
                        </a>
                    </li>
                </ul>

                <!-- Nav Extras -->
                <div class="main-nav__extras">
                    <!-- Search Button -->
                    <div class="search-toggle" id="searchToggle">
                        <i class="fas fa-search"></i>
                    </div>

                    <!-- Language Switcher -->
                    <div class="lang-toggle" id="langToggle">
                        <img src="assets/images/flags/<?php echo $lang; ?>.png" alt="<?php echo $lang == 'fa' ? 'فارسی' : 'English'; ?>">
                    </div>

                    <!-- Language Dropdown (Now centered under the toggle) -->
                    <div class="lang-dropdown">
                        <a href="?lang=en" class="lang-dropdown__item <?php echo $lang == 'en' ? 'active' : ''; ?>">
                            <img src="assets/images/flags/en.png" alt="English" class="lang-dropdown__flag">
                            <span>English</span>
                        </a>
                        <a href="?lang=fa" class="lang-dropdown__item <?php echo $lang == 'fa' ? 'active' : ''; ?>">
                            <img src="assets/images/flags/fa.png" alt="فارسی" class="lang-dropdown__flag">
                            <span>فارسی</span>
                        </a>
                    </div>

                    <!-- Apply Now Button -->
                    <a href="Terms and Conditions for Registration.php" class="main-nav__btn">
                        <?php echo $lang == 'fa' ? 'ثبت‌نام' : 'Apply Now'; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Navigation - Enhanced Design -->
<div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav__container">
        <!-- Mobile Header -->
        <div class="mobile-nav__header">
            <!-- Close Button -->
            <button class="mobile-nav__close" id="mobileNavClose">
                <i class="fas fa-times"></i>
            </button>

            <!-- Mobile Logo -->
            <div class="mobile-nav__logo">
                <img src="assets/images/logo-light.png" alt="Salman Farsi Educational Complex">
            </div>
        </div>

        <!-- Mobile Menu -->
        <ul class="mobile-nav__menu">
            <li class="mobile-nav__item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <a href="index.php" class="mobile-nav__link">
                    <?php echo $lang == 'fa' ? 'صفحه اصلی' : 'Home'; ?>
                </a>
            </li>
            <li class="mobile-nav__item <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                <a href="about.php" class="mobile-nav__link">
                    <?php echo $lang == 'fa' ? 'درباره ما' : 'About'; ?>
                </a>
            </li>
            <li class="mobile-nav__item has-dropdown">
                <a href="#" class="mobile-nav__link">
                    <?php echo $lang == 'fa' ? 'صفحات' : 'Pages'; ?>
                    <button class="mobile-dropdown-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </a>
                <ul class="mobile-nav__dropdown">
                    <li>
                        <a href="staff.php" class="mobile-nav__dropdown-link">
                            <?php echo $lang == 'fa' ? 'کارکنان' : 'Staff'; ?>
                        </a>
                    </li>
                    <li>
                        <a href="Curriculum.php" class="mobile-nav__dropdown-link">
                            <?php echo $lang == 'fa' ? 'برنامه درسی' : 'Curriculum'; ?>
                        </a>
                    </li>
                    <li>
                        <a href="Facilities.php" class="mobile-nav__dropdown-link">
                            <?php echo $lang == 'fa' ? 'امکانات' : 'Facilities'; ?>
                        </a>
                    </li>
                    <li>
                        <a href="faq.php" class="mobile-nav__dropdown-link">
                            <?php echo $lang == 'fa' ? 'سوالات متداول' : 'FAQs'; ?>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="mobile-nav__item <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">
                <a href="blog.php" class="mobile-nav__link">
                    <?php echo $lang == 'fa' ? 'اخبار' : 'News'; ?>
                </a>
            </li>
            <li class="mobile-nav__item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                <a href="contact.php" class="mobile-nav__link">
                    <?php echo $lang == 'fa' ? 'تماس با ما' : 'Contact'; ?>
                </a>
            </li>
        </ul>

        <!-- Mobile Footer -->
        <div class="mobile-nav__footer">
            <!-- Mobile Language Switcher -->
            <div class="mobile-nav__langs">
                <h4><?php echo $lang == 'fa' ? 'انتخاب زبان:' : 'Select Language:'; ?></h4>
                <div style="display: flex; gap: 10px;">
                    <a href="?lang=en" class="mobile-nav__social-link <?php echo $lang == 'en' ? 'active' : ''; ?>" style="<?php echo $lang == 'en' ? 'background-color: var(--primary-color);' : ''; ?>">
                        <img src="assets/images/flags/en.png" alt="English" style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;">
                    </a>
                    <a href="?lang=fa" class="mobile-nav__social-link <?php echo $lang == 'fa' ? 'active' : ''; ?>" style="<?php echo $lang == 'fa' ? 'background-color: var(--primary-color);' : ''; ?>">
                        <img src="assets/images/flags/fa.png" alt="فارسی" style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Mobile Contact Info -->
            <ul class="mobile-nav__contact">
                <li class="mobile-nav__contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:+97142988116">
                        <?php echo $lang == 'fa' ? '۹۷۱+ ۴ ۲۹۸ ۸۱۱ ۶' : '+971 4 298 811 6'; ?>
                    </a>
                </li>
                <li class="mobile-nav__contact-item">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:info@ir-salmanfarsi.com">info@ir-salmanfarsi.com</a>
                </li>
            </ul>

            <!-- Mobile Social Links -->
            <div class="mobile-nav__social">
                <a href="https://www.instagram.com/ir.salmanfarsi/" class="mobile-nav__social-link">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.youtube.com/@salmanfarsiiranianschool73/videos" class="mobile-nav__social-link">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://wa.me/97142988116" class="mobile-nav__social-link">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search Overlay -->
<div class="search-overlay" id="searchOverlay">
    <button class="search-overlay__close" id="searchClose">
        <i class="fas fa-times"></i>
    </button>
    <form class="search-overlay__form" action="blog.php" method="get">
        <input type="text" name="search" class="search-overlay__input" placeholder="<?php echo $lang == 'fa' ? 'جستجو کنید...' : 'Search Here...'; ?>">
        <button type="submit" class="search-overlay__btn">
            <i class="fas fa-search"></i>
        </button>
        <?php if ($lang != 'en'): ?>
        <input type="hidden" name="lang" value="<?php echo $lang; ?>">
        <?php endif; ?>
    </form>
</div>

<!-- Language Mobile Overlay -->
<div class="lang-overlay" id="langOverlay">
    <button class="lang-overlay__close" id="langClose">
        <i class="fas fa-times"></i>
    </button>
    <div class="lang-overlay__header">
        <h2 class="lang-overlay__title">
            <?php echo $lang == 'fa' ? 'انتخاب زبان' : 'Select Language'; ?>
        </h2>
    </div>
    <div class="lang-overlay__items">
        <a href="?lang=en" class="lang-overlay__item <?php echo $lang == 'en' ? 'active' : ''; ?>">
            <img src="assets/images/flags/en.png" alt="English" class="lang-overlay__flag">
            <span class="lang-overlay__name">English</span>
        </a>
        <a href="?lang=fa" class="lang-overlay__item <?php echo $lang == 'fa' ? 'active' : ''; ?>">
            <img src="assets/images/flags/fa.png" alt="فارسی" class="lang-overlay__flag">
            <span class="lang-overlay__name">فارسی</span>
        </a>
    </div>
</div>

<!-- Bottom Mobile Navigation -->
<div class="bottom-nav">
    <a href="index.php" class="bottom-nav__item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
        <span class="bottom-nav__icon">
            <i class="fas fa-home"></i>
        </span>
        <span class="bottom-nav__text">
            <?php echo $lang == 'fa' ? 'خانه' : 'Home'; ?>
        </span>
    </a>
    <button class="bottom-nav__item" id="bottomSearchToggle">
        <span class="bottom-nav__icon">
            <i class="fas fa-search"></i>
        </span>
        <span class="bottom-nav__text">
            <?php echo $lang == 'fa' ? 'جستجو' : 'Search'; ?>
        </span>
    </button>
    <button class="bottom-nav__item" id="bottomLangToggle">
        <span class="bottom-nav__icon">
            <i class="fas fa-globe"></i>
        </span>
        <span class="bottom-nav__text">
            <?php echo $lang == 'fa' ? 'زبان' : 'Language'; ?>
        </span>
    </button>
    <button class="bottom-nav__item" id="bottomMenuToggle">
        <span class="bottom-nav__icon">
            <i class="fas fa-bars"></i>
        </span>
        <span class="bottom-nav__text">
            <?php echo $lang == 'fa' ? 'منو' : 'Menu'; ?>
        </span>
    </button>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DOM Elements
        const mainNav = document.getElementById('mainNav');
        const bottomMenuToggle = document.getElementById('bottomMenuToggle');
        const mobileNav = document.getElementById('mobileNav');
        const mobileNavClose = document.getElementById('mobileNavClose');
        const searchToggle = document.getElementById('searchToggle');
        const bottomSearchToggle = document.getElementById('bottomSearchToggle');
        const searchOverlay = document.getElementById('searchOverlay');
        const searchClose = document.getElementById('searchClose');
        const bottomLangToggle = document.getElementById('bottomLangToggle');
        const langOverlay = document.getElementById('langOverlay');
        const langClose = document.getElementById('langClose');
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        // Sticky Header
        const stickyHeader = () => {
            const scrollY = window.scrollY;
            if (scrollY > 100) {
                mainNav.classList.add('sticky');
            } else {
                mainNav.classList.remove('sticky');
            }
        };

        // Listen for scroll events
        window.addEventListener('scroll', stickyHeader);

        // Show/hide bottom navigation based on device 
        function adjustBottomNavVisibility() {
            const bottomNav = document.querySelector('.bottom-nav');
            if (window.innerWidth <= 991) {
                bottomNav.style.opacity = '1';
                bottomNav.style.visibility = 'visible';
            } else {
                bottomNav.style.opacity = '0';
                bottomNav.style.visibility = 'hidden';
            }
        }

        // Initialize visibility
        adjustBottomNavVisibility();

        // Listen for window resize events
        window.addEventListener('resize', adjustBottomNavVisibility);

        // Toggle Mobile Menu
        function toggleMobileMenu() {
            mobileNav.classList.toggle('active');
            document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
        }

        if (bottomMenuToggle) {
            bottomMenuToggle.addEventListener('click', toggleMobileMenu);
        }

        if (mobileNavClose) {
            mobileNavClose.addEventListener('click', toggleMobileMenu);
        }

        // Toggle Search Overlay
        function toggleSearchOverlay() {
            searchOverlay.classList.toggle('active');
            document.body.style.overflow = searchOverlay.classList.contains('active') ? 'hidden' : '';
            
            if (searchOverlay.classList.contains('active')) {
                setTimeout(() => {
                    document.querySelector('.search-overlay__input').focus();
                }, 100);
            }
        }

        if (searchToggle) {
            searchToggle.addEventListener('click', toggleSearchOverlay);
        }

        if (bottomSearchToggle) {
            bottomSearchToggle.addEventListener('click', toggleSearchOverlay);
        }

        if (searchClose) {
            searchClose.addEventListener('click', toggleSearchOverlay);
        }

        // Toggle Language Overlay
        function toggleLangOverlay() {
            langOverlay.classList.toggle('active');
            document.body.style.overflow = langOverlay.classList.contains('active') ? 'hidden' : '';
        }

        if (bottomLangToggle) {
            bottomLangToggle.addEventListener('click', toggleLangOverlay);
        }

        if (langClose) {
            langClose.addEventListener('click', toggleLangOverlay);
        }

        // Mobile Dropdown Toggle
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const parent = this.closest('.has-dropdown');
                const dropdown = parent.querySelector('.mobile-nav__dropdown');
                const allDropdowns = document.querySelectorAll('.mobile-nav__dropdown');
                const allToggles = document.querySelectorAll('.mobile-dropdown-toggle');
                
                // Close other dropdowns
                allDropdowns.forEach(item => {
                    if (item !== dropdown) {
                        item.style.display = 'none';
                    }
                });
                
                allToggles.forEach(item => {
                    if (item !== this) {
                        item.classList.remove('active');
                    }
                });
                
                // Toggle current dropdown
                this.classList.toggle('active');
                
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                } else {
                    dropdown.style.display = 'block';
                }
            });
        });

        // Close dropdowns when clicking elsewhere
        document.addEventListener('click', function(e) {
            const isDropdownBtn = e.target.closest('.mobile-dropdown-toggle');
            if (!isDropdownBtn) {
                const allDropdowns = document.querySelectorAll('.mobile-nav__dropdown');
                const allToggles = document.querySelectorAll('.mobile-dropdown-toggle');
                
                allDropdowns.forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
                
                allToggles.forEach(toggle => {
                    toggle.classList.remove('active');
                });
            }
        });

        // Close overlays on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (searchOverlay.classList.contains('active')) {
                    toggleSearchOverlay();
                }
                
                if (langOverlay.classList.contains('active')) {
                    toggleLangOverlay();
                }
                
                if (mobileNav.classList.contains('active')) {
                    toggleMobileMenu();
                }
            }
        });
    });
</script>
