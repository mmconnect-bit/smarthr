@php
    use App\Models\Utility;
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo = Utility::get_file('uploads/landing_page_image/');
    $sup_logo = Utility::get_file('uploads/logo');
    $adminSettings = Utility::settings();
    $company_logo = isset($adminSettings['company_logo']) ? $adminSettings['company_logo'] : '';
    $language = \App\Models\Utility::getValByName('default_language');
    $admin_payment_setting = Utility::getAdminPaymentSetting();
    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = isset($getseo['meta_title']) ? $getseo['meta_title'] : '';
    $metadesc = isset($getseo['meta_description']) ? $getseo['meta_description'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image']) ? $getseo['meta_image'] : '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');
    $setting = \App\Models\Utility::colorset();
    $SITE_RTL = Utility::getValByName('SITE_RTL');
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';
    if ($language == 'ar' || $language == 'he') {
        $setting['SITE_RTL'] = 'on';
    }
    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }
@endphp
<!DOCTYPE html>
<html lang="en" dir="{{ $setting['SITE_RTL'] == 'on' ? 'rtl' : '' }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>{{ $metatitle ?: env('APP_NAME') . ' - Smart HR Management Solution' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $metadesc ?: 'Professional HR Management System with Advanced Features for Modern Businesses' }}">
    <meta name="keywords" content="HR Management, Employee Management, Payroll, Smart HR, Business Management, Cloud HR">
    <meta name="author" content="{{ env('APP_NAME') }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $metatitle ?: env('APP_NAME') }}">
    <meta property="og:description" content="{{ $metadesc }}">
    <meta property="og:image" content="{{ isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : asset('assets/images/default-og.png') }}">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $metatitle ?: env('APP_NAME') }}">
    <meta property="twitter:description" content="{{ $metadesc }}">
    <meta property="twitter:image" content="{{ isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : asset('assets/images/default-og.png') }}">

    <!-- Favicon -->
    <link rel="icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" type="image/png" />
    <link rel="apple-touch-icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" />
    <link rel="shortcut icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" type="image/png" />

    <!-- Preload Critical Resources -->
    <link rel="preload" href="{{ Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- font css -->
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/material.css') }}" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/customizer.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/landing-page.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/custom.css') }}" />

    <!-- Dynamic Color Variables -->

    <style>
        :root {
            --color-customColor: {{ $color }};
            --dynamic-primary: {{ $setting['theme_color'] ?? '#6b7fff' }};
            --smart-primary: {{ $setting['theme_color'] ?? '#6b7fff' }};
            --smart-gray-100: #f8fafc;
            --smart-gray-200: #e2e8f0;
            --smart-gray-300: #cbd5e1;
            --smart-gray-400: #94a3b8;
            --smart-gray-500: #64748b;
            --smart-gray-600: #475569;
            --smart-gray-700: #334155;
            --smart-gray-800: #1e293b;
            --smart-gray-900: #0f172a;
        }

        /* Header Shadow and Styling - Matching Landing Page */
        .main-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-header.scrolled {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.98);
        }

        /* Navigation Styling */
        .smart-navbar {
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .smart-nav .nav-link {
            color: var(--smart-gray-700) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.75rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-decoration: none;
        }

        .smart-nav .nav-link:hover,
        .smart-nav .nav-link.active {
            color: var(--smart-primary) !important;
            background-color: rgba(107, 127, 255, 0.1);
            transform: translateY(-1px);
        }

        /* Enhanced Buttons */
        .navbar-actions .btn {
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .btn-outline-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border: 2px solid transparent;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            color: white !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white !important;
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            transform: translateY(-2px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            color: white !important;
        }

        /* Banner Section */
        .common-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .common-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="none"><path d="M0,0 Q250,100 500,50 T1000,25 L1000,0 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
            background-position: bottom;
        }

        .common-banner .title h1 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        /* Content Sections */
        .static-content {
            padding: 5rem 0;
            background: var(--smart-gray-100);
        }

        .static-content .container > div:first-child {
            background: white;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            border: 1px solid var(--smart-gray-200);
        }

        /* Smart Footer */
        .smart-footer {
            background: var(--smart-gray-900) !important;
            color: var(--smart-gray-300);
        }

        .footer-logo {
            height: 35px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .footer-title {
            color: white !important;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-links a,
        .legal-link {
            color: var(--smart-gray-400);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.875rem;
        }

        .footer-links a:hover,
        .legal-link:hover {
            color: var(--smart-primary);
        }

        .footer-description {
            color: var(--smart-gray-400);
            line-height: 1.6;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--smart-gray-800);
            color: var(--smart-gray-400);
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }

        .social-link:hover {
            background: var(--smart-primary);
            color: white;
            transform: translateY(-2px);
        }

        .newsletter-input {
            background: var(--smart-gray-800);
            border: 1px solid var(--smart-gray-700);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .newsletter-input:focus {
            background: var(--smart-gray-700);
            border-color: var(--smart-primary);
            color: white;
            box-shadow: none;
        }

        .newsletter-btn {
            border-radius: 0 0.5rem 0.5rem 0;
            padding: 0.75rem 1rem;
        }

        /* Floating WhatsApp Button */
        .floating-whatsapp {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            animation: bounce 2s infinite;
        }

        .whatsapp-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #25D366;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.875rem;
        }

        .whatsapp-btn:hover {
            background: #128C7E;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(37, 211, 102, 0.4);
            color: white;
            text-decoration: none;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-5px);
            }
            60% {
                transform: translateY(-3px);
            }
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                margin-top: 1rem;
                padding: 1rem;
                border-radius: 0.75rem;
                box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
                border: 1px solid var(--smart-gray-200);
            }

            .smart-nav {
                flex-direction: column;
                gap: 0.5rem;
                width: 100%;
            }

            .smart-nav .nav-link {
                text-align: center;
                width: 100%;
                padding: 1rem !important;
            }

            .navbar-actions {
                margin-top: 1rem;
                justify-content: center !important;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            /* Hide Get Started button on mobile */
            .smart-btn-primary {
                display: none !important;
            }

            .btn-text {
                display: inline !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 35px;
            }

            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }

            .common-banner {
                padding: 4rem 0 3rem;
            }

            .common-banner .title h1 {
                font-size: 1.5rem;
            }

            .floating-whatsapp {
                bottom: 1rem;
                right: 1rem;
            }

            .whatsapp-btn span {
                display: none;
            }

            .whatsapp-btn {
                width: 56px;
                height: 56px;
                border-radius: 50%;
                justify-content: center;
                padding: 0;
            }

            .footer-logo {
                height: 28px;
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Accessibility */
        .btn:focus,
        .nav-link:focus {
            outline: 2px solid var(--smart-primary);
            outline-offset: 2px;
        }

        /* Typography */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: var(--smart-gray-800);
            background-color: white;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* About Us Section Styling */
        .about-us-content {
            margin: 2rem 0;
        }

        .about-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--smart-gray-900);
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .about-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--smart-primary) 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .about-description .lead {
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--smart-gray-700);
            line-height: 1.7;
        }

        .about-description p {
            font-size: 1.1rem;
            color: var(--smart-gray-600);
            line-height: 1.8;
        }

        .mission-card, .vision-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.1);
            border: 1px solid var(--smart-gray-200);
            height: 100%;
            transition: all 0.3s ease;
        }

        .mission-card:hover, .vision-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--smart-gray-900);
        }

        .card-text {
            color: var(--smart-gray-600);
            font-size: 1rem;
            line-height: 1.6;
        }

        .values-section {
            padding: 3rem 2rem;
            background: var(--smart-gray-100);
            border-radius: 1rem;
            margin: 2rem 0;
        }

        .section-subtitle {
            font-size: 2rem;
            font-weight: 600;
            color: var(--smart-gray-900);
        }

        .value-item {
            padding: 1.5rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.08);
            height: 100%;
            transition: all 0.3s ease;
        }

        .value-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.12);
        }

        .value-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--smart-gray-900);
            margin-bottom: 0.5rem;
        }

        .value-text {
            color: var(--smart-gray-600);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem 2rem;
            border-radius: 1rem;
            color: white;
            margin: 3rem 0;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
        }

        .cta-description {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .cta-buttons .btn {
            font-size: 1rem;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .dynamic-content {
            border-top: 2px solid var(--smart-gray-200);
            padding-top: 2rem;
        }

        /* Mobile Responsive for About Section */
        @media (max-width: 768px) {
            .about-title {
                font-size: 2rem;
            }

            .mission-card, .vision-card {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            .values-section {
                padding: 2rem 1rem;
            }

            .cta-section {
                padding: 2rem 1rem;
            }

            .cta-title {
                font-size: 1.5rem;
            }

            .cta-buttons .btn {
                width: 100%;
                margin-bottom: 0.75rem;
            }

            .cta-buttons .btn:last-child {
                margin-bottom: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">

    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif

    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"
            id="main-style-link">
    @endif

</head>

@if ($setting['cust_darklayout'] == 'on')
    <body class="{{ $themeColor }} smart-landing-page landing-dark" data-theme="dark">
@else
    <body class="{{ $themeColor }} smart-landing-page" data-theme="light">
@endif

<!-- Smart Navigation Header -->
<header class="main-header smart-header" id="main-header">
    @if ($settings['topbar_status'] == 'on')
        <div class="announcement-bar bg-primary text-white text-center py-2">
            <div class="container">
                <div class="announcement-content d-flex align-items-center justify-content-center">
                    <i class="ti ti-bell me-2"></i>
                    <span class="announcement-text">{!! $settings['topbar_notification_msg'] !!}</span>
                </div>
            </div>
        </div>
    @endif

    @if ($settings['menubar_status'] == 'on')
        <nav class="navbar navbar-expand-lg smart-navbar" role="navigation" aria-label="Main navigation">
            <div class="container">
                <!-- Brand Logo -->
                <a class="navbar-brand smart-brand" href="../" aria-label="SmartHR Home">
                    <img src="https://smarthr.co.tz/storage/uploads/logo/logo-light.png"
                         alt="{{ env('APP_NAME') }} Logo"
                         class="brand-logo"
                         width="160"
                         height="40">
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler smart-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#smartNavigation"
                        aria-controls="smartNavigation"
                        aria-expanded="false"
                        aria-label="Toggle navigation menu">
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                    <span class="toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="smartNavigation">
                    <ul class="navbar-nav smart-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link smart-nav-link" href="../#home" data-section="home">
                                <span class="nav-text">{{ $settings['home_title'] ?: 'Home' }}</span>
                            </a>
                        </li>

                        @if ($settings['feature_status'] == 'on')
                        <li class="nav-item">
                            <a class="nav-link smart-nav-link" href="../#features" data-section="features">
                                <span class="nav-text">{{ $settings['feature_title'] ?: 'Features' }}</span>
                            </a>
                        </li>
                        @endif

                        @if ($settings['plan_status'] == 'on')
                        <li class="nav-item">
                            <a class="nav-link smart-nav-link" href="../#pricing" data-section="pricing">
                                <span class="nav-text">{{ $settings['plan_title'] ?: 'Pricing' }}</span>
                            </a>
                        </li>
                        @endif

                        @if ($settings['faq_status'] == 'on')
                        <li class="nav-item">
                            <a class="nav-link smart-nav-link" href="../#faq" data-section="faq">
                                <span class="nav-text">{{ $settings['faq_title'] ?: 'FAQ' }}</span>
                            </a>
                        </li>
                        @endif

                        @if (is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page'])))
                            @foreach (json_decode($settings['menubar_page']) as $key => $value)
                                @if (isset($value->header) && $value->header == 'on' && isset($value->template_name))
                                    <li class="nav-item">
                                        <a class="nav-link smart-nav-link {{ request()->url() == ($value->template_name == 'page_content' ? route('custom.page', $value->page_slug) : $value->page_url) ? 'active' : '' }}"
                                           href="{{ $value->template_name == 'page_content' ? route('custom.page', $value->page_slug) : $value->page_url }}">
                                            <span class="nav-text">{{ $value->menubar_page_name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>

                    <!-- CTA Buttons -->
                    <div class="navbar-actions d-flex gap-3">
                        <a href="{{ route('login') }}"
                           class="btn btn-outline-primary smart-btn-outline"
                           aria-label="Login to your account">
                            <span class="btn-text">{{ __('Login') }}</span>
                            <i class="ti ti-login ms-2"></i>
                        </a>

                        @if (isset($adminSettings['disable_signup_button']) && $adminSettings['disable_signup_button'] == 'on')
                            <a href="{{ route('register') }}"
                               class="btn btn-primary smart-btn-primary d-none d-lg-inline-flex"
                               aria-label="Create new account">
                                <span class="btn-text">{{ __('Get Started') }}</span>
                                <i class="ti ti-user-plus ms-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    @endif
</header>
<!-- [ Header ] End -->
<!-- [ common banner ] start -->
<section class="common-banner bg-primary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="title">
                    <h1 class="text-white">{!! $page['menubar_page_name'] !!}</h1>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- [ common banner ] end -->
<!-- [ Static content ] start -->
<section class="static-content section-gap">
    <div class="container">
        <div class="mb-5">
            <!-- Custom About Us Content -->
            <div class="about-us-content">
                <h2 class="about-title mb-4">About Us – Who We Are</h2>

                <div class="about-description">
                    <p class="lead mb-4">
                        At SmartHR, we believe that managing people should be as smart and seamless as the technology we use every day. Our mission is to simplify Human Resource Management for businesses of all sizes by providing an innovative, reliable, and user-friendly HR platform.
                    </p>

                    <p class="mb-4">
                        We combine cutting-edge technology with deep HR expertise to deliver tools that make it easier to handle recruitment, payroll, attendance, leave management, performance tracking, and employee engagement — all in one place.
                    </p>

                    <p class="mb-0">
                        Our team is passionate about helping organizations save time, reduce administrative burdens, and focus on what matters most — building strong, motivated, and high-performing teams. With SmartHR, you're not just getting software, you're gaining a partner dedicated to your growth and success.
                    </p>
                </div>

                <!-- Mission & Vision Cards -->
                <div class="row mt-5">
                    <div class="col-lg-6 mb-4">
                        <div class="mission-card">
                            <div class="card-icon mb-3">
                                <i class="ti ti-target text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="card-title mb-3">Our Mission</h4>
                            <p class="card-text">
                                To simplify HR management through innovative technology that empowers businesses to focus on their people and growth.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="vision-card">
                            <div class="card-icon mb-3">
                                <i class="ti ti-eye text-success" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="card-title mb-3">Our Vision</h4>
                            <p class="card-text">
                                To be the leading HR platform that transforms how organizations manage their most valuable asset — their people.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Values Section -->
                <div class="values-section mt-5">
                    <h3 class="section-subtitle mb-4 text-center">Our Core Values</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="value-item text-center">
                                <div class="value-icon mb-3">
                                    <i class="ti ti-lightbulb text-warning" style="font-size: 2rem;"></i>
                                </div>
                                <h5 class="value-title">Innovation</h5>
                                <p class="value-text">Continuously improving our platform with cutting-edge technology</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="value-item text-center">
                                <div class="value-icon mb-3">
                                    <i class="ti ti-shield-check text-info" style="font-size: 2rem;"></i>
                                </div>
                                <h5 class="value-title">Reliability</h5>
                                <p class="value-text">Providing secure, stable, and dependable HR solutions</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="value-item text-center">
                                <div class="value-icon mb-3">
                                    <i class="ti ti-users text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <h5 class="value-title">People-First</h5>
                                <p class="value-text">Putting people at the center of everything we build</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="cta-section mt-5 text-center">
                    <div class="cta-content">
                        <h3 class="cta-title mb-3">Ready to Transform Your HR?</h3>
                        <p class="cta-description mb-4">Join thousands of companies that trust SmartHR for their human resource management needs.</p>
                        <div class="cta-buttons">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                                <i class="ti ti-rocket me-2"></i>
                                Get Started Free
                            </a>
                            <a href="https://wa.me/+255754609629" target="_blank" class="btn btn-outline-primary btn-lg">
                                <i class="ti ti-brand-whatsapp me-2"></i>
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display dynamic page content if available -->
            {{-- @if(isset($page['menubar_page_contant']) && !empty($page['menubar_page_contant']))
                <div class="dynamic-content mt-5">
                    {!! $page['menubar_page_contant'] !!}
                </div>
            @endif --}}
        </div>
    </div>
</section>

<!-- [ Static content ] end -->
<!-- Smart Footer -->
<footer class="smart-footer bg-dark text-white">
    <div class="footer-main py-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Company Info -->
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <img src="https://smarthr.co.tz/storage/uploads/logo/logo-light.png"
                             alt="{{ env('APP_NAME') }} Logo"
                             class="footer-logo mb-3">
                        <p class="footer-description">
                            {!! $settings['site_description'] ?: 'Empowering businesses with intelligent HR management solutions for the modern workplace.' !!}
                        </p>
                        <div class="footer-social">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="ti ti-brand-facebook"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter">
                                <i class="ti ti-brand-twitter"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="LinkedIn">
                                <i class="ti ti-brand-linkedin"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="ti ti-brand-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Product</h5>
                        <ul class="footer-links">
                            @if (is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page'])))
                                @foreach (json_decode($settings['menubar_page']) as $key => $value)
                                    @if (isset($value->footer) && $value->footer == 'on' && $value->header == 'off' && isset($value->template_name))
                                        <li><a href="{{ $value->template_name == 'page_content' ? route('custom.page', $value->page_slug) : $value->page_url }}">{{ $value->menubar_page_name }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">Support</h5>
                        <ul class="footer-links">
                            @if (is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page'])))
                                @foreach (json_decode($settings['menubar_page']) as $key => $value)
                                    @if (isset($value->header) && $value->header == 'on' && $value->footer == 'off' && isset($value->template_name))
                                        <li><a href="{{ $value->template_name == 'page_content' ? route('custom.page', $value->page_slug) : $value->page_url }}">{{ $value->menubar_page_name }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-4">
                    @if ($settings['joinus_status'] == 'on')
                        <div class="footer-section">
                            <h5 class="footer-title">{!! $settings['joinus_heading'] !!}</h5>
                            <p class="footer-text">
                                {!! $settings['joinus_description'] !!}
                            </p>
                            <form class="newsletter-form" method="post" action="{{ route('join_us_store') }}">
                                @csrf
                                <div class="input-group">
                                    <input type="email"
                                           name="email"
                                           class="form-control newsletter-input"
                                           placeholder="Enter your email"
                                           aria-label="Email address">
                                    <button class="btn btn-primary newsletter-btn"
                                            type="submit"
                                            aria-label="Subscribe to newsletter">
                                        <i class="ti ti-send"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom py-3 border-top border-secondary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        &copy;{{ date(' Y') }}
                        {{ App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'SmartHR SaaS') }}
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-legal">
                        <a href="#" class="legal-link">Privacy Policy</a>
                        <a href="#" class="legal-link">Terms of Service</a>
                        <a href="#" class="legal-link">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- [ Footer ] end -->
<!-- Required Js -->

<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/feather.min.js') }}"></script>


<script>
    // Start [ Menu hide/show on scroll ]
    let ost = 0;
    document.addEventListener("scroll", function() {
        let cOst = document.documentElement.scrollTop;
        if (cOst == 0) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
        } else if (cOst > ost) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
            document.querySelector(".navbar").classList.remove("default");
        } else {
            document.querySelector(".navbar").classList.add("default");
            document
                .querySelector(".navbar")
                .classList.remove("top-nav-collapse");
        }
        ost = cOst;
    });
    // End [ Menu hide/show on scroll ]

    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: "#navbar-example",
    });
    feather.replace();
</script>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/+255754609629" target="_blank" class="floating-whatsapp" title="Chat with us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

@stack('custom-scripts')
@if ($enable_cookie['enable_cookie'] == 'on')
    @include('layouts.cookie_consent')
@endif

</body>

</html>
