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
       <meta name="keywords" content="
        HR software Tanzania, Payroll software Tanzania, Payroll system Dar es Salaam,
        HR system Tanzania, Human resource management system Tanzania,
        Employee management software Tanzania, HR and payroll software Tanzania,
        HR software in Dar es Salaam, Online HR system Tanzania,
        Best payroll software Tanzania, HR solution for small businesses Tanzania,
        Leave management software Tanzania, Attendance management system Tanzania,
        Cloud-based HR system Tanzania, HR software for SMEs in Tanzania,
        SmartHR Tanzania, SmartHR payroll system, SmartHR HR software Dar es Salaam,
        SmartHR HR and payroll solution
    ">
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
    <link rel="apple-touch-icon" href="{{ $sup_logo . '/' . (isset($adminSettings['company_favicon']) && !empty($adminSettings['company_favicon']) ? $adminSettings['company_favicon'] : 'favicon.png') }}">

    <!-- Preload Critical Resources -->
    <link rel="preload" href="{{ Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ Module::asset('LandingPage:Resources/assets/css/my-landing-styles.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/material.css') }}" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/customizer.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/landing-page.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/custom.css') }}" />

    <!-- My Custom Landing Styles -->
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/my-landing-styles.css') }}" />

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

        /* Header Shadow and Styling */
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

        /* Enhanced Card Padding and Styling */
        .feature-card-modern {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card-modern:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: var(--smart-primary);
        }

        .feature-card-header {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .feature-card-content {
            padding: 0;
        }

        .feature-title-modern {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--smart-gray-900);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .feature-description-modern {
            color: var(--smart-gray-600);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .feature-benefits {
            margin-bottom: 1.5rem;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0;
            font-size: 0.875rem;
            color: var(--smart-gray-700);
        }

        .feature-card-footer {
            display: none;
        }

        /* Enhanced Pricing Card Styling */
        .pricing-card-modern {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: auto;
            min-height: 600px;
        }

        .pricing-card-modern.featured-plan {
            border: 2px solid var(--smart-primary);
            box-shadow: 0 12px 40px rgba(107, 127, 255, 0.15);
            transform: scale(1.05);
        }

        .pricing-card-modern:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.15);
        }

        .pricing-card-modern.featured-plan:hover {
            transform: translateY(-12px) scale(1.07);
        }

        .plan-header-modern {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--smart-gray-200);
        }

        .plan-name-modern {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--smart-gray-900);
            margin-bottom: 0.5rem;
        }

        .plan-subtitle {
            color: var(--smart-gray-600);
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .plan-features-modern {
            margin-bottom: 2rem;
        }

        .features-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--smart-gray-900);
            margin-bottom: 1rem;
        }

        .features-list-modern {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-item-modern {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            font-size: 0.875rem;
            color: var(--smart-gray-700);
        }

        .plan-action-modern {
            margin-top: auto;
            padding-top: 1.5rem;
        }

        .btn-plan {
            width: 100%;
            padding: 1rem 1.5rem;
            font-weight: 600;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .plan-guarantee {
            text-align: center;
            font-size: 0.75rem;
            color: var(--smart-gray-500);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Additional Features Card Styling */
        .feature-content-enhanced {
            padding: 2rem;
        }

        .feature-title-enhanced {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--smart-gray-900);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .feature-description-enhanced {
            color: var(--smart-gray-600);
            font-size: 1.125rem;
            line-height: 1.6;
        }

        .feature-benefits-grid {
            margin-top: 1.5rem;
        }

        .benefit-item-enhanced {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--smart-gray-100);
            border-radius: 8px;
            font-size: 0.875rem;
            color: var(--smart-gray-700);
        }

        .benefit-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: var(--smart-primary);
            color: white;
            border-radius: 50%;
            font-size: 12px;
        }

        .feature-stats {
            margin-top: 2rem;
        }

        .stat-box {
            text-align: center;
            padding: 1rem;
            background: var(--smart-gray-100);
            border-radius: 12px;
        }

        .stat-number {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--smart-primary);
            display: block;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--smart-gray-600);
            margin-top: 0.25rem;
        }

        /* Hero Section Enhancements */
        .smart-hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(107, 127, 255, 0.3) 0%,
                rgba(99, 102, 241, 0.25) 50%,
                rgba(139, 92, 246, 0.2) 100%
            );
            z-index: 2;
        }

        .hero-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 2rem 0;
            color: white;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.1;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-description {
            font-size: 1.375rem;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            display: inline-block;
        }

        .badge-content {
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .hero-actions .btn {
            padding: 1rem 2rem;
            font-size: 1.125rem;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .smart-btn-hero {
            background: var(--smart-primary);
            color: white;
            border: 2px solid var(--smart-primary);
        }

        .smart-btn-hero:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .smart-btn-hero-outline {
            background: var(--smart-primary);
            color: white;
            border: 2px solid var(--smart-primary);
        }

        .smart-btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .hero-social-proof {
            margin-top: 3rem;
        }

        .social-proof-stats {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            display: block;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 0.25rem;
        }

        .hero-visual {
            position: relative;
            z-index: 10;
            display: none; /* Hide the right side image since we're using background */
        }

        /* Trusted By Section Styling */
        .trusted-by-section {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            margin-top: 3rem;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .trusted-text {
            color: white;
            text-align: center;
        }

        .trusted-label,
        .trusted-suffix {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }

        .trusted-count {
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            margin: 0 0.5rem;
        }

        .trusted-logos {
            margin-top: 1rem;
        }

        .logo-item img {
            filter: brightness(0) invert(1);
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .logo-item img:hover {
            opacity: 1;
        }

        /* FAQ Section Enhancements */
        .faq-header {
            padding: 2rem;
        }

        .accordion-item {
            background: #ffffff;
            border: 1px solid var(--smart-gray-200);
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .accordion-button {
            padding: 1.5rem;
            font-weight: 600;
            color: var(--smart-gray-900);
            background: transparent;
            border: none;
        }

        .accordion-body {
            padding: 1.5rem;
            color: var(--smart-gray-600);
            line-height: 1.6;
        }

        /* Section Padding Improvements */
        .section-padding {
            padding: 5rem 0;
        }

        .section-gap {
            padding: 4rem 0;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .feature-card-modern,
            .pricing-card-modern {
                padding: 1.5rem;
            }

            .feature-content-enhanced {
                padding: 1.5rem;
            }

            .hero-title {
                font-size: 2.75rem;
            }

            .hero-description {
                font-size: 1.125rem;
            }

            .pricing-card-modern.featured-plan {
                transform: none;
            }

            /* Mobile Navigation Buttons */
            .navbar-actions {
                gap: 0.5rem !important;
            }

            /* Hide Get Started button on mobile */
            .navbar-actions .btn-primary.smart-btn-primary {
                display: none !important;
            }

            /* Show Login text on mobile and make button smaller */
            .navbar-actions .btn-outline-primary .btn-text {
                display: inline !important;
                font-size: 0.875rem;
            }

            .navbar-actions .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.875rem;
            }

            .navbar-actions .btn i {
                font-size: 1rem;
                margin-left: 0.25rem !important;
            }

            /* Ensure mobile text visibility */
            .smart-header .navbar-nav .nav-link,
            .smart-header .btn {
                color: var(--smart-gray-700) !important;
                font-weight: 500;
            }

            .smart-header .btn-outline-primary:hover {
                color: white !important;
            }

            .pricing-card-modern.featured-plan:hover {
                transform: translateY(-8px);
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .hero-actions .btn {
                width: 100%;
                max-width: 280px;
            }

            .social-proof-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .trusted-by-section {
                margin-top: 2rem;
                padding: 1.5rem;
            }

            /* Footer Logo Mobile Sizing */
            .footer-logo {
                max-height: 28px;
                width: auto;
            }
        }

        /* Footer Logo General Styling */
        .footer-logo {
            max-height: 35px;
            width: auto;
            transition: all 0.3s ease;
            filter: brightness(0) invert(1) !important;
        }

        @media (max-width: 576px) {
            .feature-card-modern,
            .pricing-card-modern {
                padding: 1.25rem;
            }

            .hero-title {
                font-size: 2.25rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .hero-actions .btn {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }

            .social-proof-stats {
                padding: 1rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.875rem;
            }

            .hero-content {
                padding: 1rem 0;
            }

            .hero-badge {
                padding: 0.5rem 1rem;
            }

            .badge-content {
                font-size: 0.75rem;
            }
        }

        /* Animation Enhancements */
        .fade-in-up {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Parallax Effect for Hero Background */
        .hero-background-image {
            transform: scale(1.1);
            transition: transform 0.3s ease-out;
        }

        .smart-hero-section:hover .hero-background-image {
            transform: scale(1.05);
        }

        /* Floating WhatsApp Action Button */
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

        @media (max-width: 768px) {
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
        }

        /* Enhanced Footer Styling */
        .smart-footer {
            position: relative;
            overflow: hidden;
        }

        .smart-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--color-customColor) 0%, rgba(var(--color-customColor-rgb), 0.9) 100%);
            z-index: 1;
        }

        .smart-footer > * {
            position: relative;
            z-index: 2;
        }

        .footer-title {
            color: white !important;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.125rem;
        }

        .footer-description,
        .footer-text {
            color: rgba(255, 255, 255, 0.9) !important;
            line-height: 1.6;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a,
        .contact-link {
            color: rgba(255, 255, 255, 0.8) !important;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .footer-links a:hover,
        .contact-link:hover {
            color: white !important;
            transform: translateX(5px);
            text-decoration: none;
        }

        .contact-link i {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            border-radius: 50%;
            text-decoration: none;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            color: white !important;
            text-decoration: none;
        }

        .footer-social {
            margin-top: 1.5rem;
        }

        .newsletter-input {
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 50px 0 0 50px;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .newsletter-input:focus {
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .newsletter-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 0 50px 50px 0;
            border-left: none;
        }

        .newsletter-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .border-white-25 {
            border-color: rgba(255, 255, 255, 0.25) !important;
        }

        .legal-link {
            color: rgba(255, 255, 255, 0.8) !important;
            text-decoration: none;
            margin-left: 1rem;
            transition: color 0.3s ease;
        }

        .legal-link:hover {
            color: white !important;
            text-decoration: none;
        }

        .legal-link:first-child {
            margin-left: 0;
        }
    </style>

    <!-- Additional Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">

    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "{{ env('APP_NAME') }}",
        "description": "{{ $metadesc ?: 'Professional HR Management System' }}",
        "url": "{{ env('APP_URL') }}",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web Browser",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        }
    }
    </script>
</head>

<body class="{{ $themeColor }} smart-landing-page" data-theme="light">

    <!-- Loading Screen -->
    <div id="page-loader" class="page-loader">
        <div class="loader-content">
            <div class="loader-icon">
                {{-- <img src="{{ $sup_logo . '/' . (isset($adminSettings['company_logo']) ? $adminSettings['company_logo'] : 'logo.png') }}" alt="Loading..." class="loader-logo"> --}}
            </div>
        </div>
    </div>

    <!-- Skip to Content (Accessibility) -->
    <a href="#main-content" class="skip-link visually-hidden-focusable">Skip to main content</a>

    <!-- Smart Navigation Header -->
    <header class="main-header smart-header" id="main-header">
        @if ($settings['topbar_status'] == 'on')
            <div class="announcement-bar bg-primary text-white text-center py-2">
                <div class="container">
                    <div class="announcement-content d-flex align-items-center justify-content-center">
                        <i class="ti ti-bell me-2"></i>
                        <span class="announcement-text">{!! $settings['topbar_notification_msg'] !!}</span>
                        <button class="btn-close-announcement ms-3" aria-label="Close announcement">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if ($settings['menubar_status'] == 'on')
            <nav class="navbar navbar-expand-lg smart-navbar" role="navigation" aria-label="Main navigation">
                <div class="container">
                    <!-- Brand Logo -->
                    <a class="navbar-brand smart-brand" href="#home" aria-label="SmartHR Home">
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
                                <a class="nav-link smart-nav-link active" href="#home" data-section="home">
                                    <span class="nav-text">{{ $settings['home_title'] ?: 'Home' }}</span>
                                </a>
                            </li>

                            @if ($settings['feature_status'] == 'on')
                            <li class="nav-item">
                                <a class="nav-link smart-nav-link" href="#features" data-section="features">
                                    <span class="nav-text">{{ $settings['feature_title'] ?: 'Features' }}</span>
                                </a>
                            </li>
                            @endif

                            @if ($settings['plan_status'] == 'on')
                            <li class="nav-item">
                                <a class="nav-link smart-nav-link" href="#pricing" data-section="pricing">
                                    <span class="nav-text">{{ $settings['plan_title'] ?: 'Pricing' }}</span>
                                </a>
                            </li>
                            @endif

                            @if ($settings['faq_status'] == 'on')
                            <li class="nav-item">
                                <a class="nav-link smart-nav-link" href="#faq" data-section="faq">
                                    <span class="nav-text">{{ $settings['faq_title'] ?: 'FAQ' }}</span>
                                </a>
                            </li>
                            @endif

                            @if (is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page'])))
                                @foreach (json_decode($settings['menubar_page']) as $key => $value)
                                    @if (isset($value->header) && $value->header == 'on' && isset($value->template_name))
                                        <li class="nav-item">
                                            <a class="nav-link smart-nav-link"
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
                                   class="btn btn-primary smart-btn-primary"
                                   aria-label="Create new account">
                                    <span class="btn-text d-none d-lg-inline">{{ __('Get Started') }}</span>
                                    <i class="ti ti-user-plus ms-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        @endif
    </header>

    <!-- Main Content -->
    <main id="main-content" class="smart-main-content" role="main">

        <!-- Hero Section -->
        @if ($settings['home_status'] == 'on')
            <section class="smart-hero-section" id="home" aria-labelledby="hero-heading">
                <!-- Full Screen Background Image -->
                <img src="{{ asset('assets/images/background-02.jpg') }}"
                     alt="Background"
                     class="hero-background-image"
                     loading="eager">

                <!-- Hero Overlay -->
                <div class="hero-overlay"></div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-xl-8">
                            <div class="hero-content text-center fade-in-up">
                                @if($settings['home_offer_text'])
                                    <div class="hero-badge mb-4">
                                        <span class="badge-content">
                                            <i class="ti ti-sparkles me-2"></i>
                                            {{ $settings['home_offer_text'] }}
                                        </span>
                                    </div>
                                @endif

                                <h1 id="hero-heading" class="hero-title mb-4">
                                    {{ $settings['home_heading'] ?: 'SmartHR - HRM and Payroll Tool' }}
                                </h1>

                                <p class="hero-description mb-5">
                                    {{ $settings['home_description'] ?: 'Use these awesome forms to login or create new account in your project for free. Streamline your HR processes with our intelligent, cloud-based platform designed for efficiency and growth.' }}
                                </p>

                                <div class="hero-actions d-flex flex-wrap gap-3 justify-content-center">
                                    @if ($settings['home_buy_now_link'])
                                        <a href="{{ $settings['home_buy_now_link'] }}"
                                           class="btn smart-btn-hero-outline"
                                           aria-label="Get started now">
                                            <span class="btn-text">{{ __('Get Started Free') }}</span>
                                            <i class="ti ti-arrow-right ms-2"></i>
                                        </a>
                                    @endif
                                </div>

                                <!-- Social Proof -->
                                <div class="hero-social-proof">
                                    <div class="social-proof-stats">
                                        <div class="stat-item">
                                            <div class="stat-number">100+</div>
                                            <div class="stat-label">Happy Clients</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-number">99.9%</div>
                                            <div class="stat-label">Uptime</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-number">24/7</div>
                                            <div class="stat-label">Support</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trusted By Section -->
                    @if($settings['home_trusted_by'] && $settings['home_logo'])
                        <div class="trusted-by-section">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="trusted-text mb-3">
                                        <span class="trusted-label">{{ __('Trusted by') }}</span>
                                        <span class="trusted-count">{{ $settings['home_trusted_by'] }}</span>
                                        <span class="trusted-suffix">{{ __('companies worldwide') }}</span>
                                    </div>
                                    <div class="trusted-logos">
                                        <div class="logos-scroll d-flex justify-content-center flex-wrap gap-4">
                                            @foreach (explode(',', $settings['home_logo']) as $k => $home_logo)
                                                <div class="logo-item">
                                                    <img src="{{ $logo . '/' . $home_logo }}"
                                                         alt="Trusted Company Logo {{ $k + 1 }}"
                                                         class="trusted-logo"
                                                         style="height: 40px; width: auto;"
                                                         loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- Enhanced Features Section -->
        @if ($settings['feature_status'] == 'on')
            <section class="smart-features-section section-padding bg-gradient-light" id="features" aria-labelledby="features-heading">
                <div class="container">
                    <!-- Section Header -->
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-8 text-center">
                            <div class="section-header">
                                <div class="section-badge pulse-badge mb-3">
                                    <i class="ti ti-star-filled text-warning me-2"></i>
                                    <span class="badge-text">{{ $settings['feature_title'] ?: 'Why Choose Us' }}</span>
                                </div>
                                <h2 id="features-heading" class="section-title gradient-text mb-4">
                                    {!! $settings['feature_heading'] ?: 'Powerful Features for <span class="highlight-text">Modern HR Management</span>' !!}
                                </h2>
                                <p class="section-description lead">
                                    {!! $settings['feature_description'] ?: 'Unlock the full potential of your HR operations with our comprehensive suite of intelligent tools designed for efficiency, scalability, and growth.' !!}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Features Grid -->
                    <div class="row g-4 mb-5">
                        @if (is_array(json_decode($settings['feature_of_features'], true)) || is_object(json_decode($settings['feature_of_features'], true)))
                            @foreach (json_decode($settings['feature_of_features'], true) as $key => $feature)
                                <div class="col-lg-4 col-md-6">
                                    <div class="feature-card-modern {{ $key == 0 ? 'featured-highlight' : '' }}"
                                         data-aos="fade-up"
                                         data-aos-delay="{{ $key * 150 }}">
                                        <!-- Card Header -->
                                        <div class="feature-card-header">
                                            <div class="feature-icon-container">
                                                <div class="feature-icon-bg"></div>
                                                <img src="{{ $logo . '/' . $feature['feature_logo'] . '?' . time() }}"
                                                     alt="{{ $feature['feature_heading'] }} icon"
                                                     class="feature-icon-img"
                                                     loading="lazy">
                                                <div class="feature-icon-shine"></div>
                                            </div>
                                            @if($key == 0)
                                                <div class="popular-badge">
                                                    <i class="ti ti-flame"></i>
                                                    <span>Popular</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Card Content -->
                                        <div class="feature-card-content">
                                            <h3 class="feature-title-modern">
                                                {!! $feature['feature_heading'] !!}
                                            </h3>
                                            <p class="feature-description-modern">
                                                {!! $feature['feature_description'] !!}
                                            </p>

                                            <!-- Feature Benefits -->
                                            <div class="feature-benefits">
                                                <div class="benefit-item">
                                                    <i class="ti ti-check-circle text-success"></i>
                                                    <span>Easy Setup</span>
                                                </div>
                                                <div class="benefit-item">
                                                    <i class="ti ti-check-circle text-success"></i>
                                                    <span>24/7 Support</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Footer -->
                                        <div class="feature-card-footer">
                                            <div class="feature-stats">
                                                <div class="stat-item">
                                                    <span class="stat-number">{{ rand(95, 99) }}%</span>
                                                    <span class="stat-label">Satisfaction</span>
                                                </div>
                                                <div class="stat-item">
                                                    <span class="stat-number">{{ rand(100, 500) }}+</span>
                                                    <span class="stat-label">Companies</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Call to Action Row -->
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="features-cta-container">
                                <div class="cta-content">
                                    <h3 class="cta-title">Ready to Transform Your HR?</h3>
                                    <p class="cta-description">Join thousands of companies already using our platform</p>
                                    <div class="cta-actions">
                                        @if ($settings['feature_buy_now_link'])
                                            <a href="{{ $settings['feature_buy_now_link'] }}"
                                               class="btn btn-primary btn-lg cta-primary">
                                                <i class="ti ti-rocket me-2"></i>
                                                {{ __('Start Free Trial') }}
                                            </a>
                                        @endif
                                        <a href="#pricing" class="btn btn-outline-primary btn-lg cta-secondary">
                                            <i class="ti ti-eye me-2"></i>
                                            {{ __('View Pricing') }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Trust Indicators -->
                                <div class="trust-indicators mt-4">
                                    <div class="trust-item">
                                        <i class="ti ti-shield-check text-success"></i>
                                        <span>Enterprise Security</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="ti ti-clock text-primary"></i>
                                        <span>Real-time Updates</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="ti ti-users text-info"></i>
                                        <span>Multi-tenant Support</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Background Elements -->
                <div class="features-bg-elements">
                    <div class="bg-shape shape-1"></div>
                    <div class="bg-shape shape-2"></div>
                    <div class="bg-shape shape-3"></div>
                </div>
            </section>
        @endif

        <!-- Enhanced Additional Features Section -->
        @if ($settings['feature_status'] == 'on' && isset($settings['other_features']))
            <section class="smart-additional-features bg-light section-gap">
                <div class="container">
                    <div class="text-center mb-5">
                        <div class="section-badge mb-3">
                            <span class="badge-text">Advanced Features</span>
                        </div>
                        <h2 class="section-title mb-4">
                            More Ways to Succeed
                        </h2>
                        <p class="section-description">
                            Discover additional powerful features that make SmartHR the complete solution for your organization.
                        </p>
                    </div>

                    @if (is_array(json_decode($settings['other_features'], true)) || is_object(json_decode($settings['other_features'], true)))
                        <div class="additional-features-container">
                            @foreach (json_decode($settings['other_features'], true) as $key => $otherFeature)
                                <div class="additional-feature-row {{ $key % 2 == 0 ? 'standard' : 'reverse' }} mb-5">
                                    <div class="row align-items-center gy-5">
                                        <div class="col-lg-6 order-lg-{{ $key % 2 == 0 ? '1' : '2' }}">
                                            <div class="feature-content-enhanced">
                                                <div class="feature-meta mb-3">
                                                    <div class="section-badge">
                                                        <span class="badge-text">Feature {{ $key + 1 }}</span>
                                                    </div>
                                                    <div class="feature-category">
                                                        {{ $key == 0 ? 'Automation' : ($key == 1 ? 'Analytics' : 'Integration') }}
                                                    </div>
                                                </div>

                                                <h3 class="feature-title-enhanced mb-4">
                                                    {!! isset($otherFeature['other_features_heading']) ? $otherFeature['other_features_heading'] : 'Advanced Feature Heading' !!}
                                                </h3>

                                                <p class="feature-description-enhanced mb-4">
                                                    {!! isset($otherFeature['other_featured_description']) ? $otherFeature['other_featured_description'] : (isset($otherFeature['other_feature_description']) ? $otherFeature['other_feature_description'] : 'Discover how this powerful feature can transform your HR processes and improve organizational efficiency.') !!}
                                                </p>

                                                <!-- Enhanced Benefits Grid -->
                                                <div class="feature-benefits-grid">
                                                    <div class="row g-3">
                                                        <div class="col-sm-6">
                                                            <div class="benefit-item-enhanced">
                                                                <div class="benefit-icon">
                                                                    <i class="ti ti-check"></i>
                                                                </div>
                                                                <span>Easy Implementation</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="benefit-item-enhanced">
                                                                <div class="benefit-icon">
                                                                    <i class="ti ti-clock"></i>
                                                                </div>
                                                                <span>Real-time Updates</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="benefit-item-enhanced">
                                                                <div class="benefit-icon">
                                                                    <i class="ti ti-shield-check"></i>
                                                                </div>
                                                                <span>Secure & Compliant</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="benefit-item-enhanced">
                                                                <div class="benefit-icon">
                                                                    <i class="ti ti-headset"></i>
                                                                </div>
                                                                <span>24/7 Support</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Feature Statistics -->
                                                <div class="feature-stats mt-4">
                                                    <div class="row g-3">
                                                        <div class="col-4">
                                                            <div class="stat-box">
                                                                <div class="stat-number">{{ ['95%', '80%', '500+'][$key % 3] }}</div>
                                                                <div class="stat-label">{{ ['Accuracy', 'Time Saved', 'Integrations'][$key % 3] }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="stat-box">
                                                                <div class="stat-number">{{ ['<5min', '24/7', '99.9%'][$key % 3] }}</div>
                                                                <div class="stat-label">{{ ['Setup Time', 'Availability', 'Uptime'][$key % 3] }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="stat-box">
                                                                <div class="stat-number">{{ ['4.9★', '1M+', 'SOC2'][$key % 3] }}</div>
                                                                <div class="stat-label">{{ ['Rating', 'Users', 'Compliant'][$key % 3] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 order-lg-{{ $key % 2 == 0 ? '2' : '1' }}">
                                            <div class="feature-visual-enhanced">
                                                <div class="visual-container">
                                                    <div class="visual-backdrop"></div>
                                                    <div class="visual-frame">
                                                        <img src="{{ $logo . '/' . (isset($otherFeature['other_features_image']) ? $otherFeature['other_features_image'] : 'default.jpg') }}"
                                                             alt="{{ isset($otherFeature['other_features_heading']) ? strip_tags($otherFeature['other_features_heading']) : 'Feature' }}"
                                                             class="feature-image-enhanced img-fluid"
                                                             loading="lazy">

                                                        <!-- Interactive Overlay Elements -->
                                                        <div class="visual-overlays">
                                                            <div class="overlay-element element-1">
                                                                <div class="element-content">
                                                                    <i class="ti ti-{{ ['robot', 'chart-line', 'plug'][$key % 3] }}"></i>
                                                                    <span>{{ ['Smart AI', 'Analytics', 'Integration'][$key % 3] }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="overlay-element element-2">
                                                                <div class="element-content">
                                                                    <div class="progress-ring">
                                                                        <svg width="40" height="40">
                                                                            <circle cx="20" cy="20" r="15" stroke="var(--smart-primary)" stroke-width="3" fill="none" stroke-dasharray="60" stroke-dashoffset="15"/>
                                                                        </svg>
                                                                    </div>
                                                                    <span>{{ ['85%', '92%', '78%'][$key % 3] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Call-to-Action Section -->
                        <div class="additional-features-cta mt-5 pt-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <div class="cta-content">
                                        <h3 class="cta-title mb-3">
                                            Ready to Transform Your HR?
                                        </h3>
                                        <p class="cta-description mb-4">
                                            Join thousands of companies that have revolutionized their HR processes with SmartHR.
                                        </p>
                                        <div class="cta-actions">
                                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                                                Start Free Trial
                                                <i class="ti ti-arrow-right ms-2"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- Dynamic Sections (from get_section) -->
        @if(isset($get_section))
            @foreach($get_section as $section)
                @includeIf('landingpage::layouts.sections.' . $section->section_name, ['section' => $section])
            @endforeach
        @endif

        <!-- Pricing Section -->
        <!-- Enhanced Pricing Section -->
        @if ($settings['plan_status'] == 'on' && isset($plans))
            <section class="smart-pricing-section section-padding" id="pricing" aria-labelledby="pricing-heading">
                <div class="container">
                    <!-- Section Header -->
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-8 text-center">
                            <div class="section-header">
                                <div class="section-badge mb-3">
                                    <i class="ti ti-currency-dollar text-success me-2"></i>
                                    <span class="badge-text">{{ $settings['plan_title'] ?: 'Pricing Plans' }}</span>
                                </div>
                                <h2 id="pricing-heading" class="section-title gradient-text mb-4">
                                    Simple, Transparent Pricing
                                </h2>
                                <p class="section-description lead">
                                    Choose the perfect plan for your business needs. No hidden fees, no long-term contracts. Start your journey today.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Toggle -->
                    <div class="row justify-content-center mb-5">
                        <div class="col-auto">
                            <div class="pricing-toggle">
                                <span class="toggle-label monthly active">Monthly</span>
                                <div class="toggle-switch" id="pricingToggle">
                                    <div class="toggle-slider"></div>
                                </div>
                                <span class="toggle-label yearly">
                                    Yearly
                                    <span class="save-badge">Save 20%</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Grid -->
                    <div class="row g-4 justify-content-center">
                        @foreach($plans as $key => $plan)
                            <div class="col-lg-4 col-md-6">
                                <div class="pricing-card-modern {{ $key == 1 ? 'featured-plan' : '' }}"
                                     data-aos="fade-up"
                                     data-aos-delay="{{ $key * 150 }}">

                                    @if($key == 1)
                                        <div class="plan-badge-modern">
                                            <i class="ti ti-crown"></i>
                                            <span>Most Popular</span>
                                        </div>
                                    @endif

                                    @if($key == 2)
                                        <div class="plan-badge-modern enterprise">
                                            <i class="ti ti-building-skyscraper"></i>
                                            <span>Enterprise</span>
                                        </div>
                                    @endif

                                    <!-- Plan Header -->
                                    <div class="plan-header-modern">
                                        <div class="plan-icon">
                                            @if($key == 0)
                                                <i class="ti ti-user text-primary"></i>
                                            @elseif($key == 1)
                                                <i class="ti ti-users text-warning"></i>
                                            @else
                                                <i class="ti ti-building text-success"></i>
                                            @endif
                                        </div>
                                        <h3 class="plan-name-modern">{{ $plan->name }}</h3>
                                        <p class="plan-subtitle">{{ $plan->description ?: 'Perfect for getting started' }}</p>

                                        <div class="plan-price-modern">
                                            <div class="price-container monthly-price">
                                                <span class="price-currency">Tsh</span>
                                                <span class="price-amount">{{ number_format($plan->price, 0, '.', ',') }}</span>
                                                <span class="price-period">/month</span>
                                            </div>
                                            <div class="price-container yearly-price" style="display: none;">
                                                <span class="price-currency">Tsh</span>
                                                <span class="price-amount">{{ number_format(round($plan->price * 12 * 0.8), 0, '.', ',') }}</span>
                                                <span class="price-period">/year</span>
                                            </div>
                                            <div class="price-note">
                                                <span class="monthly-note">Billed monthly</span>
                                                <span class="yearly-note" style="display: none;">Billed annually</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Plan Features -->
                                    <div class="plan-features-modern">
                                        <h4 class="features-title">Everything included:</h4>
                                        <ul class="features-list-modern">
                                            <li class="feature-item-modern">
                                                <i class="ti ti-check-circle text-success"></i>
                                                <span><strong>{{ $plan->max_users }}</strong> Active Users</span>
                                            </li>
                                            <li class="feature-item-modern">
                                                <i class="ti ti-check-circle text-success"></i>
                                                <span><strong>{{ $plan->max_employees }}</strong> Employee Records</span>
                                            </li>
                                            <li class="feature-item-modern">
                                                <i class="ti ti-check-circle text-success"></i>
                                                <span><strong>{{ $plan->storage_limit }}MB</strong> Secure Storage</span>
                                            </li>
                                            <li class="feature-item-modern">
                                                <i class="ti ti-check-circle text-success"></i>
                                                <span>24/7 Priority Support</span>
                                            </li>
                                            <li class="feature-item-modern">
                                                <i class="ti ti-check-circle text-success"></i>
                                                <span>Regular Updates & Backups</span>
                                            </li>
                                            <li class="feature-item-modern">
                                                <i class="ti ti-check-circle text-success"></i>
                                                <span>Advanced Reporting</span>
                                            </li>
                                            @if($key >= 1)
                                                <li class="feature-item-modern">
                                                    <i class="ti ti-check-circle text-success"></i>
                                                    <span>API Access</span>
                                                </li>
                                                <li class="feature-item-modern">
                                                    <i class="ti ti-check-circle text-success"></i>
                                                    <span>Custom Integrations</span>
                                                </li>
                                            @endif
                                            @if($key == 2)
                                                <li class="feature-item-modern">
                                                    <i class="ti ti-check-circle text-success"></i>
                                                    <span>Dedicated Account Manager</span>
                                                </li>
                                                <li class="feature-item-modern">
                                                    <i class="ti ti-check-circle text-success"></i>
                                                    <span>Custom Onboarding</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <!-- Plan Action -->
                                    <div class="plan-action-modern">
                                        <a href="{{ route('register') }}"
                                           class="btn {{ $key == 1 ? 'btn-primary' : ($key == 2 ? 'btn-success' : 'btn-outline-primary') }} btn-lg btn-plan">
                                            @if($key == 0)
                                                <i class="ti ti-rocket me-2"></i>
                                                Start Free Trial
                                                 @elseif($key == 1)
                                                <i class="ti ti-rocket me-2"></i>
                                                Start Free Trial
                                                 @else
                                                <i class="ti ti-rocket me-2"></i>
                                                Start Free Trial
                                            {{-- @elseif($key == 1)
                                                <i class="ti ti-star me-2"></i>
                                                Get Started
                                            @else
                                                <i class="ti ti-phone me-2"></i>
                                                Contact Sales --}}
                                            @endif
                                        </a>

                                        <div class="plan-guarantee">
                                            <i class="ti ti-shield-check text-success"></i>
                                            <span>30-day money-back guarantee</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pricing Footer -->
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-10">
                            <div class="pricing-footer-modern">
                                <div class="row g-4 align-items-center">
                                    <div class="col-lg-8">
                                        <div class="pricing-help">
                                            <h4>Need a custom solution?</h4>
                                            <p class="mb-0">We offer enterprise solutions tailored to your specific needs. Contact our sales team for a personalized quote.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-lg-end">
                                        <a href="#contact" class="btn btn-outline-primary btn-lg">
                                            <i class="ti ti-message-circle me-2"></i>
                                            Contact Sales
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Features Comparison -->
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-12">
                            <div class="comparison-table-wrapper">
                                <h3 class="comparison-title text-center mb-4">Feature Comparison</h3>
                                <div class="table-responsive">
                                    <table class="table comparison-table">
                                        <thead>
                                            <tr>
                                                <th>Features</th>
                                                @foreach($plans as $plan)
                                                    <th class="text-center">{{ $plan->name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Users</strong></td>
                                                @foreach($plans as $plan)
                                                    <td class="text-center">{{ $plan->max_users }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td><strong>Employees</strong></td>
                                                @foreach($plans as $plan)
                                                    <td class="text-center">{{ $plan->max_employees }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td><strong>Storage</strong></td>
                                                @foreach($plans as $plan)
                                                    <td class="text-center">{{ $plan->storage_limit }}MB</td>
                                                @endforeach
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Background Elements -->
                <div class="pricing-bg-elements">
                    <div class="bg-circle circle-1"></div>
                    <div class="bg-circle circle-2"></div>
                    <div class="bg-circle circle-3"></div>
                </div>
            </section>
        @endif

        <!-- FAQ Section -->
        @if ($settings['faq_status'] == 'on')
            <section class="smart-faq-section bg-light section-gap" id="faq" aria-labelledby="faq-heading">
                <div class="container">
                    <div class="row gy-5">
                        <div class="col-lg-5">
                            <div class="faq-header">
                                <div class="section-badge mb-3">
                                    <span class="badge-text">{{ $settings['faq_title'] ?: 'FAQ' }}</span>
                                </div>
                                <h2 id="faq-heading" class="section-title mb-4">
                                    Frequently Asked Questions
                                </h2>
                                <p class="section-description mb-4">
                                    Can't find the answer you're looking for? Reach out to our customer support team.
                                </p>

                                <a href="tel:+255753417792" class="btn btn-outline-primary">
                                    Contact Support
                                    <i class="ti ti-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="faq-container">
                                <div class="accordion smart-accordion" id="faqAccordion">
                                    <!-- FAQ items would be dynamically generated here -->
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="faq{{ $i }}">
                                                <button class="accordion-button {{ $i == 1 ? '' : 'collapsed' }}"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#faqCollapse{{ $i }}"
                                                        aria-expanded="{{ $i == 1 ? 'true' : 'false' }}"
                                                        aria-controls="faqCollapse{{ $i }}">
                                                    How does SmartHR help streamline HR processes?
                                                </button>
                                            </h3>
                                            <div id="faqCollapse{{ $i }}"
                                                 class="accordion-collapse collapse {{ $i == 1 ? 'show' : '' }}"
                                                 aria-labelledby="faq{{ $i }}"
                                                 data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    SmartHR automates routine HR tasks, provides comprehensive employee management tools, and offers real-time analytics to help you make data-driven decisions.
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </main>

    <!-- Smart Footer -->
    <footer class="smart-footer bg-primary text-white">
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
                                Empowering businesses with intelligent HR management solutions for the modern workplace.
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
                                <li><a href="#features">Features</a></li>
                                <li><a href="#pricing">Pricing</a></li>
                                <li><a href="#">Integrations</a></li>
                                <li><a href="#">Security</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-section">
                            <h5 class="footer-title">Contact</h5>
                            <ul class="footer-links">
                                <li>
                                    <a href="mailto:support@smarthr.co.tz" class="contact-link">
                                        <i class="ti ti-mail me-2"></i>
                                        <span>info@smarthr.co.tz</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:+255753417792" class="contact-link">
                                        <i class="ti ti-phone me-2"></i>
                                        <span>+255 753 417 792</span>
                                    </a>
                                </li>
                                <li><a href="#faq">FAQ</a></li>
                                <li><a href="#">Help Center</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="col-lg-4">
                        <div class="footer-section">
                            <h5 class="footer-title">Stay Updated</h5>
                            <p class="footer-text">
                                Subscribe to our newsletter for the latest updates and HR insights.
                            </p>
                            <form class="newsletter-form">
                                <div class="input-group">
                                    <input type="email"
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom py-3 border-top border-white-25">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-white">
                            © {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-legal">
                            <a href="#" class="legal-link text-white">Privacy Policy</a>
                            <a href="#" class="legal-link text-white">Terms of Service</a>
                            <a href="#" class="legal-link text-white">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="ti ti-arrow-up"></i>
    </button>

    <!-- Floating WhatsApp Button -->
    <div class="floating-whatsapp">
        <a href="https://wa.me/255753417792" target="_blank" class="whatsapp-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="24" height="24">
            <span>Contact Sales</span>
        </a>
    </div>

    <!-- Cookie Consent -->
    @if($enable_cookie['enable_cookie'] == 'on')
        <div class="cookie-consent" id="cookieConsent">
            <div class="cookie-content">
                <div class="cookie-text">
                    <strong>We use cookies</strong>
                    <p>This website uses cookies to enhance your browsing experience and provide personalized content.</p>
                </div>
                <div class="cookie-actions">
                    <button class="btn btn-outline-light btn-sm" id="cookieDecline">Decline</button>
                    <button class="btn btn-primary btn-sm" id="cookieAccept">Accept</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('assets/js/vendor-all.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/feather.min.js') }}"></script>

    <!-- Custom Landing Page Scripts -->
    <script>
        // Page loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 300);
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navigation scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('main-header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Back to top button
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Cookie consent
        const cookieConsent = document.getElementById('cookieConsent');
        const cookieAccept = document.getElementById('cookieAccept');
        const cookieDecline = document.getElementById('cookieDecline');

        if (cookieAccept) {
            cookieAccept.addEventListener('click', function() {
                cookieConsent.style.display = 'none';
                localStorage.setItem('cookieConsent', 'accepted');
            });
        }

        if (cookieDecline) {
            cookieDecline.addEventListener('click', function() {
                cookieConsent.style.display = 'none';
                localStorage.setItem('cookieConsent', 'declined');
            });
        }

        // Check if cookie consent was already given
        if (localStorage.getItem('cookieConsent')) {
            if (cookieConsent) {
                cookieConsent.style.display = 'none';
            }
        }

        // Announcement bar close
        const closeAnnouncement = document.querySelector('.btn-close-announcement');
        if (closeAnnouncement) {
            closeAnnouncement.addEventListener('click', function() {
                this.closest('.announcement-bar').style.display = 'none';
            });
        }

        // Initialize Feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

        // Add loading state to forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;

                    // Re-enable after 3 seconds (fallback)
                    setTimeout(() => {
                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
    </script>

    @stack('custom-scripts')
    @if ($enable_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif

</body>
</html>

