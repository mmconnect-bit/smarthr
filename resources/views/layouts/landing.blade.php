@php
    // $logos = asset(Storage::url('uploads/logo/'));

    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $footer_text = \App\Models\Utility::getValByName('footer_text');

    // $logo = asset(Storage::url('uploads/logo/'));
    $logos = \App\Models\Utility::get_file('uploads/logo');
    $SITE_RTL = \App\Models\Utility::getValByName('SITE_RTL');
    $company_logo = \App\Models\Utility::GetLogo();
    $company_logo_landing = \App\Models\Utility::GetLogolanding();
    $setting = \App\Models\Utility::colorset();
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';

    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = isset($getseo['meta_title']) ? $getseo['meta_title'] : '';
    $metadesc = isset($getseo['meta_description']) ? $getseo['meta_description'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image']) ? $getseo['meta_image'] : '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');
@endphp

<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $SITE_RTL == 'on' ? 'rtl' : '' }}">

<head>
    {{-- <title>{{ __('HRMGO SaaS') }}</title> --}}
    <title>
        {{ \App\Models\Utility::getValByName('title_text') ? \App\Models\Utility::getValByName('title_text') : config('app.name', 'HRMGO SaaS') }}
    </title>

    <!-- SEO META -->
    <meta name="title" content="{{ $metatitle }}">
    <meta name="description" content="{{ $metadesc }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $metatitle }}">
    <meta property="og:description" content="{{ $metadesc }}">
    <meta property="og:image"
        content="{{ isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png' }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $metatitle }}">
    <meta property="twitter:description" content="{{ $metadesc }}">
    <meta property="twitter:image"
        content="{{ isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png' }}">


    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
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
    <meta name="author" content="choroha technologoies" />

    <!-- Force favicon refresh -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- Favicon icon -->
    <link rel="icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" type="image/png" />
    <link rel="shortcut icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" type="image/png" />
    <link rel="apple-touch-icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="icon" type="image/png" sizes="192x192" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ now()->timestamp }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" />
    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">



    @if ($setting['SITE_RTL'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif
    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    @endif

    @if (isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-dark.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />

    <style>
        :root {
            --color-customColor: <?=$color ?>;
            --smart-primary: <?=$color ?>;
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

        /* Professional Landing Header */
        .landing-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 9999 !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            padding: 0.5rem 0 !important;
        }

        .landing-header.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12) !important;
        }

        .landing-header .navbar-brand {
            padding: 0.25rem 0;
        }

        .landing-header .navbar-brand img {
            max-height: 50px;
            width: auto;
            max-width: 220px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .landing-header .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .landing-header .navbar-nav {
            align-items: center;
        }

        .landing-header .nav-link {
            color: var(--smart-gray-700) !important;
            font-weight: 600 !important;
            padding: 0.75rem 1rem !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            font-size: 0.875rem !important;
        }

        .landing-header .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0.25rem;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--smart-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .landing-header .nav-link:hover::after,
        .landing-header .nav-link.active::after {
            width: 80%;
        }

        .landing-header .nav-link:hover,
        .landing-header .nav-link.active {
            color: var(--smart-primary) !important;
            background: rgba(107, 127, 255, 0.1) !important;
            transform: translateY(-2px) !important;
        }

        /* Professional Action Buttons */
        .landing-header .btn {
            border-radius: 12px !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            margin: 0 0.25rem !important;
        }

        .landing-header .btn-outline-primary {
            background: transparent !important;
            border: 2px solid var(--smart-primary) !important;
            color: var(--smart-primary) !important;
        }

        .landing-header .btn-outline-primary:hover {
            background: var(--smart-primary) !important;
            color: white !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 12px 32px rgba(107, 127, 255, 0.4) !important;
        }

        .landing-header .btn-primary {
            background: linear-gradient(135deg, var(--smart-primary) 0%, rgba(107, 127, 255, 0.9) 100%) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 8px 24px rgba(107, 127, 255, 0.3) !important;
        }

        .landing-header .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .landing-header .btn-primary:hover::before {
            left: 100%;
        }

        .landing-header .btn-primary:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 12px 32px rgba(107, 127, 255, 0.4) !important;
            background: linear-gradient(135deg, rgba(107, 127, 255, 0.9) 0%, var(--smart-primary) 100%) !important;
        }

        /* Enhanced Navbar Toggler */
        .landing-header .navbar-toggler {
            border: 2px solid var(--smart-primary) !important;
            border-radius: 8px !important;
            padding: 0.5rem !important;
            background: rgba(107, 127, 255, 0.1) !important;
            transition: all 0.3s ease !important;
        }

        .landing-header .navbar-toggler:hover {
            background: var(--smart-primary) !important;
        }

        .landing-header .navbar-toggler:focus {
            box-shadow: 0 0 0 4px rgba(107, 127, 255, 0.2) !important;
        }

        /* Body Padding for Fixed Header */
        body {
            padding-top: 80px !important;
        }

        /* Enhanced Container */
        .landing-header .container {
            max-width: 1200px;
        }

        /* Mobile Menu Enhancement */
        @media (max-width: 991.98px) {
            .landing-header .navbar-collapse {
                background: rgba(255, 255, 255, 0.98) !important;
                backdrop-filter: blur(20px) !important;
                border-radius: 16px !important;
                margin-top: 1rem !important;
                padding: 1.5rem !important;
                box-shadow: 0 20px 64px rgba(0, 0, 0, 0.15) !important;
                border: 1px solid rgba(255, 255, 255, 0.2) !important;
            }

            .landing-header .navbar-nav {
                gap: 0.5rem;
            }

            .landing-header .nav-link {
                text-align: center !important;
                padding: 1rem !important;
                border-radius: 12px !important;
            }

            .landing-header .btn {
                margin: 0.5rem 0 !important;
                width: 100% !important;
            }

            body {
                padding-top: 70px !important;
            }
        }

        @media (max-width: 576px) {
            .landing-header .navbar-brand img {
                max-height: 40px;
            }

            body {
                padding-top: 65px !important;
            }
        }

        /* Professional Loading Animation */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Enhanced Focus States */
        .landing-header *:focus {
            outline: 2px solid var(--smart-primary) !important;
            outline-offset: 2px !important;
        }

        /* Smooth Scroll Enhancement */
        html {
            scroll-behavior: smooth;
        }

        /* Professional Brand Enhancement */
        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-text {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--smart-gray-900);
            display: none;
        }

        @media (min-width: 992px) {
            .brand-text {
                display: block;
            }
        }

        /* Enhanced Hero Section Styles */
        .hero-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--smart-primary) 0%, rgba(107, 127, 255, 0.9) 50%, #667eea 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-badge .badge {
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .text-gradient {
            background: linear-gradient(45deg, #ffffff, #f0f9ff, #dbeafe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .hero-description {
            font-size: 1.125rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .btn-hero {
            padding: 0.875rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 50px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-hero:hover .btn-shine {
            left: 100%;
        }

        .hero-stats {
            margin-top: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.25rem;
        }

        .hero-image-wrapper {
            position: relative;
            text-align: center;
        }

        .hero-image-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 50%, transparent 100%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
        }

        .hero-image {
            position: relative;
            z-index: 2;
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.2));
        }

        .floating-element {
            position: absolute;
            z-index: 3;
            animation: float 6s ease-in-out infinite;
        }

        .element-1 {
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .element-2 {
            bottom: 30%;
            left: 5%;
            animation-delay: 2s;
        }

        .element-3 {
            top: 60%;
            right: 5%;
            animation-delay: 4s;
        }

        .floating-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            color: var(--smart-gray-700);
            white-space: nowrap;
        }

        .floating-card i {
            font-size: 1.25rem;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .hero-bg-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            animation: bgFloat 20s ease-in-out infinite;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
            animation-delay: 7s;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            top: 30%;
            left: 10%;
            animation-delay: 14s;
        }

        @keyframes bgFloat {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(30px, -30px) rotate(90deg); }
            50% { transform: translate(-20px, 20px) rotate(180deg); }
            75% { transform: translate(20px, 30px) rotate(270deg); }
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .floating-element {
                display: none;
            }

            .hero-stats {
                justify-content: center;
            }

            .stat-item {
                margin: 0 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.125rem;
            }

            .btn-hero {
                width: 100%;
                margin-bottom: 0.75rem;
            }

            .hero-stats {
                gap: 1rem !important;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.75rem;
            }
        }

        /* Professional Footer Styles */
        .footer-section {
            background: linear-gradient(135deg, var(--smart-primary) 0%, rgba(107, 127, 255, 0.9) 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem 0;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        .footer-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
            pointer-events: none;
        }

        .footer-logo {
            max-height: 50px;
            width: auto;
            filter: brightness(0) invert(1) !important;
            transition: transform 0.3s ease;
        }

        .footer-logo:hover {
            transform: scale(1.05);
        }

        .footer-brand-text h6 {
            color: white !important;
            font-size: 1.25rem;
            margin: 0;
        }

        .footer-brand-text small {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 0.875rem;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0;
        }

        .footer-powered {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 0.875rem;
        }

        .footer-powered .text-primary {
            color: #60a5fa !important;
        }

        @media (max-width: 768px) {
            .footer-section {
                text-align: center;
            }

            .footer-brand {
                justify-content: center;
                margin-bottom: 1rem;
            }
        }
    </style>

</head>
<body class="{{ $color }}">
    <!-- Professional Landing Header -->
    <header class="landing-header navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <div class="brand-wrapper">
                    <img src="{{ $logos . '/' . (isset($company_logo_landing) && !empty($company_logo_landing) ? $company_logo_landing . '?' . time() : '2_light_logo.png' . '?' . time()) }}"
                         alt="{{ config('app.name', 'SmartHR') }}"
                         class="img-fluid" />
                    <span class="brand-text">SmartHR</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavigation" aria-controls="navbarNavigation"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavigation">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#feature">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#price">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">
                            <i class="ti ti-login me-2"></i>Sign In
                        </a>
                    </li>
                    @if (\App\Models\Utility::getValByName('disable_signup_button') == 'on')
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('register') }}">
                                <i class="ti ti-user-plus me-2"></i>Get Started
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Hero Section ] start -->
    <section id="home" class="hero-section bg-primary">
        <div class="container">
            <div class="row align-items-center justify-content-between min-vh-100 py-5">
                <div class="col-lg-6 col-md-12">
                    <div class="hero-content">
                        <div class="hero-badge mb-4 wow animate__fadeInLeft" data-wow-delay="0.1s">
                            <span class="badge bg-light text-primary px-4 py-2 rounded-pill">
                                <i class="ti ti-sparkles me-2"></i>Smart HR Management System
                            </span>
                        </div>

                        <h1 class="hero-title text-white mb-4 wow animate__fadeInLeft" data-wow-delay="0.2s">
                            Transform Your <span class="text-gradient">HR Operations</span> with SmartHR
                        </h1>

                        <h2 class="hero-subtitle text-white-75 mb-4 wow animate__fadeInLeft" data-wow-delay="0.3s">
                            Complete HRM & Payroll Solution for Modern Businesses
                        </h2>

                        <p class="hero-description text-white-75 mb-5 wow animate__fadeInLeft" data-wow-delay="0.4s">
                            Streamline your human resource management with our comprehensive platform.
                            From employee onboarding to payroll processing, manage everything seamlessly
                            in one powerful, user-friendly system.
                        </p>

                        <div class="hero-actions d-flex flex-wrap gap-3 mb-5 wow animate__fadeInLeft" data-wow-delay="0.5s">
                            <a href="{{ route('login') }}" class="btn btn-light btn-hero">
                                <i class="ti ti-eye me-2"></i>
                                <span>Live Demo</span>
                                <div class="btn-shine"></div>
                            </a>
                            <a href="#pricing" class="btn btn-outline-light btn-hero">
                                <i class="ti ti-credit-card me-2"></i>
                                <span>View Pricing</span>
                                <div class="btn-shine"></div>
                            </a>
                        </div>

                        <div class="hero-stats d-flex flex-wrap gap-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                            <div class="stat-item">
                                <div class="stat-number text-white">500+</div>
                                <div class="stat-label text-white-75">Happy Clients</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number text-white">99.9%</div>
                                <div class="stat-label text-white-75">Uptime</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number text-white">24/7</div>
                                <div class="stat-label text-white-75">Support</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="hero-image-wrapper wow animate__fadeInRight" data-wow-delay="0.3s">
                        <div class="hero-image-bg"></div>
                        <img src="{{ asset('assets/images/front/header-mokeup.svg') }}"
                             alt="SmartHR Dashboard Preview"
                             class="img-fluid hero-image" />

                        <!-- Floating Elements -->
                        <div class="floating-element element-1">
                            <div class="floating-card">
                                <i class="ti ti-users text-primary"></i>
                                <span>Employee Management</span>
                            </div>
                        </div>

                        <div class="floating-element element-2">
                            <div class="floating-card">
                                <i class="ti ti-credit-card text-success"></i>
                                <span>Payroll Processing</span>
                            </div>
                        </div>

                        <div class="floating-element element-3">
                            <div class="floating-card">
                                <i class="ti ti-chart-line text-info"></i>
                                <span>Analytics & Reports</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Background Elements -->
        <div class="hero-bg-elements">
            <div class="bg-circle circle-1"></div>
            <div class="bg-circle circle-2"></div>
            <div class="bg-circle circle-3"></div>
        </div>
    </section>
    <!-- [ client ] Start -->
    <section id="dashboard" class="theme-alt-bg dashboard-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2><span>Happy clients use Dashboard</span></h2>
                </div>
            </div>
            <div class="row align-items-center justify-content-center mb-5 mobile-screen">
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.2s">
                        {{-- <img src="{{ asset(Storage::url('uploads/logo/logo-dark.png')) }}" alt=""
                            class="img-fluid" /> --}}
                        <img src="{{ $logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.4s">
                        {{-- <img src="{{ asset(Storage::url('uploads/logo/logo-dark.png')) }}" alt=""
                            class="img-fluid" /> --}}
                        <img src="{{ $logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.6s">
                        {{-- <img src="{{ asset(Storage::url('uploads/logo/logo-dark.png')) }}" alt=""
                            class="img-fluid" /> --}}
                        <img src="{{ $logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.8s">
                        {{-- <img src="{{ asset(Storage::url('uploads/logo/logo-dark.png')) }}" alt=""
                            class="img-fluid" /> --}}
                        <img src="{{ $logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="1s">
                        {{-- <img src="{{ asset(Storage::url('uploads/logo/logo-dark.png')) }}" alt=""
                            class="img-fluid" /> --}}
                        <img src="{{ $logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                            alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
            <img src="{{ asset('landing/hrmgo-saas-pic-1.png') }}" alt=""
                class="img-fluid img-dashboard wow animate__fadeInUp" data-wow-delay="0.2s"
                style="border-radius: 15px;" />
        </div>
    </section>
    <!-- [ client ] End -->
    <!-- [ dashboard ] start -->
    <section class="">
        <div class="container">
            <div class="row align-items-center justify-content-end mb-5">
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        HRMGo Saas
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy
                            now</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('landing/hrmgo-saas-pic-1.png') }}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
            <div class="row align-items-center justify-content-start">
                <div class="col-sm-6">
                    <img src="{{ asset('landing/hrmgo-saas-pic-1.png') }}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInLeft" data-wow-delay="0.2s" />
                </div>
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInRight" data-wow-delay="0.2s">
                        HRMGo Saas
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <div class="my-4 wow animate__fadeInRight" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy
                            now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    <!-- [ feature ] start -->
    <section id="feature" class="feature">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2>
                        <span class="d-block mb-3">Features</span> All in one place HRMGo SaaS
                        system
                    </h2>
                    <p class="m-0">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.2s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-home"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.4s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-success">
                                <i class="ti ti-user-plus"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.6s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-users"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.8s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-report-money"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ feature ] End -->
    <!-- [ dashboard ] start -->
    <section class="">
        <div class="container">
            <div class="row align-items-center justify-content-end mb-5">
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        HRMGo Saas
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy now</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('assets/images/front/img-crm-dash-3.svg') }}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
            <div class="row align-items-center justify-content-start">
                <div class="col-sm-6">
                    <img src="{{ asset('assets/images/front/img-crm-dash-4.svg') }}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInLeft" data-wow-delay="0.2s" />
                </div>
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInRight" data-wow-delay="0.2s">
                        HRMGo Saas
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <div class="my-4 wow animate__fadeInRight" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    <!-- [ price ] start -->
    <section id="price" class="price-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2>
                        <span class="d-block mb-3">Price</span> All in one place HRMGo SaaS
                        system
                    </h2>
                    <p class="m-0">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <span class="price-badge bg-primary">STARTER</span>
                            <span class="mb-4 f-w-600 p-price">$59<small class="text-sm">/month</small></span>
                            <p class="mb-0">
                                You have Free Unlimited Updates and <br />
                                Premium Support on each package.
                            </p>
                            <ul class="list-unstyled my-5">
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    2 team members
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    20GB Cloud storage
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    Integration help
                                </li>
                            </ul>
                            <div class="d-grid text-center">
                                <button
                                    class="btn mb-3 btn-primary d-flex justify-content-center align-items-center mx-sm-5">
                                    Start with Standard plan
                                    <i class="ti ti-chevron-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card price-card price-2 bg-primary wow animate__fadeInUp" data-wow-delay="0.4s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <span class="price-badge">STARTER</span>
                            <span class="mb-4 f-w-600 p-price">$59<small class="text-sm">/month</small></span>
                            <p class="mb-0">
                                You have Free Unlimited Updates and <br />
                                Premium Support on each package.
                            </p>
                            <ul class="list-unstyled my-5">
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    2 team members
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    20GB Cloud storage
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    Integration help
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    Sketch Files
                                </li>
                            </ul>
                            <div class="d-grid text-center">
                                <button
                                    class="btn mb-3 btn-light d-flex justify-content-center align-items-center mx-sm-5">
                                    Start with Standard plan
                                    <i class="ti ti-chevron-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card price-card price-3 wow animate__fadeInUp" data-wow-delay="0.6s"
                        style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <span class="price-badge bg-primary">STARTER</span>
                            <span class="mb-4 f-w-600 p-price">$119<small class="text-sm">/month</small></span>
                            <p class="mb-0">
                                You have Free Unlimited Updates and <br />
                                Premium Support on each package.
                            </p>
                            <ul class="list-unstyled my-5">
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    2 team members
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    20GB Cloud storage
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    Integration help
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    2 team members
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    20GB Cloud storage
                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    Integration help
                                </li>
                            </ul>
                            <div class="d-grid text-center">
                                <button
                                    class="btn mb-3 btn-primary d-flex justify-content-center align-items-center mx-sm-5">
                                    Start with Standard plan
                                    <i class="ti ti-chevron-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ price ] End -->
    <!-- [ faq ] start -->
    <section id="faq" class="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2><span>Frequently Asked Questions</span></h2>
                    <p class="m-0">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10 col-xxl-8">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> How do I
                                        order?
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It
                                    is shown by default, until the collapse plugin adds the
                                    appropriate classes that we use to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> How do I
                                        order?
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong>
                                    It is hidden by default, until the collapse plugin adds the
                                    appropriate classes that we use to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> How do I
                                        order?
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It
                                    is hidden by default, until the collapse plugin adds the
                                    appropriate classes that we use to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ faq ] End -->
    <!-- [ dashboard ] start -->
    <section class="side-feature">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        HRMGo Saas
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy now</a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                    <div class="row feature-img-row m-auto">
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-1.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.2s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-2.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.4s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-6.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.6s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-3.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.8s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-11.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.3s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-12.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.5s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-10.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.7s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="{{ asset('landing/hrmgo-saas-pic-14.png') }}"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.9s"
                                alt="Admin" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->

    <!-- Professional Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="footer-brand d-flex align-items-center">
                        <img src="{{ $logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo . '?' . time() : 'logo-dark.png' . '?' . time()) }}"
                             alt="SmartHR Logo"
                             class="footer-logo img-fluid" />
                        <div class="footer-brand-text ms-3">
                            <h6 class="mb-0 text-dark fw-bold">SmartHR</h6>
                            <small class="text-muted">Professional HR Management</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="footer-content text-md-end text-center mt-3 mt-md-0">
                        <p class="footer-text mb-2">
                            &copy; {{ date('Y') }}
                            {{ \App\Models\Utility::getValByName('footer_text') ? \App\Models\Utility::getValByName('footer_text') : 'SmartHR System' }}
                            - All Rights Reserved
                        </p>
                        <p class="footer-powered mb-0">
                            <span class="text-muted">Powered by</span>
                            <strong class="text-primary">Choroha Technology</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- [ dashboard ] End -->
    <!-- Required Js -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/wow.min.js') }}"></script>
    <script>
        // Enhanced Professional Landing Page JavaScript
        document.addEventListener('DOMContentLoaded', function() {

            // Professional Scroll Handler for Header
            let lastScrollTop = 0;
            const header = document.querySelector('.landing-header');

            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                // Add scrolled class for backdrop effect
                if (scrollTop > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }

                lastScrollTop = scrollTop;
            }

            // Smooth Navigation Link Behavior
            const navLinks = document.querySelectorAll('.landing-header .nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');

                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const targetId = href.substring(1);
                        const targetElement = document.getElementById(targetId);

                        if (targetElement) {
                            // Remove active class from all links
                            navLinks.forEach(nav => nav.classList.remove('active'));
                            // Add active class to clicked link
                            this.classList.add('active');

                            // Smooth scroll to target
                            const headerHeight = header.offsetHeight;
                            const targetPosition = targetElement.offsetTop - headerHeight - 20;

                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });

            // Professional Button Ripple Effect
            const buttons = document.querySelectorAll('.btn');

            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Enhanced Mobile Menu
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            if (navbarToggler && navbarCollapse) {
                navbarToggler.addEventListener('click', function() {
                    setTimeout(() => {
                        if (navbarCollapse.classList.contains('show')) {
                            navbarCollapse.style.opacity = '1';
                            navbarCollapse.style.transform = 'translateY(0)';
                        }
                    }, 10);
                });
            }

            // Scroll-triggered Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Observe elements for animation
            const animateElements = document.querySelectorAll('.card, .hero-stats, .price-card, .feature-item');
            animateElements.forEach(el => observer.observe(el));

            // Parallax Effect for Hero Background
            const heroSection = document.querySelector('.hero-section');
            const bgCircles = document.querySelectorAll('.bg-circle');

            function parallaxEffect() {
                if (heroSection) {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * -0.5;

                    bgCircles.forEach((circle, index) => {
                        const speed = 0.3 + (index * 0.1);
                        circle.style.transform = `translate3d(0, ${scrolled * speed}px, 0)`;
                    });
                }
            }

            // Performance-optimized scroll handler
            let ticking = false;

            function updateOnScroll() {
                handleScroll();
                parallaxEffect();
                ticking = false;
            }

            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(updateOnScroll);
                    ticking = true;
                }
            });

            // Enhanced Form Interactions
            const formInputs = document.querySelectorAll('input, textarea');

            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                    if (this.value) {
                        this.parentElement.classList.add('has-value');
                    } else {
                        this.parentElement.classList.remove('has-value');
                    }
                });
            });

            // Loading Animation for Links
            const externalLinks = document.querySelectorAll('a[target="_blank"]');

            externalLinks.forEach(link => {
                link.addEventListener('click', function() {
                    this.classList.add('loading');

                    setTimeout(() => {
                        this.classList.remove('loading');
                    }, 2000);
                });
            });

            // Professional Preloader
            const preloader = document.querySelector('.preloader');
            if (preloader) {
                window.addEventListener('load', () => {
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 500);
                });
            }

        });

        // WOW.js Animation initialization
        var wow = new WOW({
            animateClass: "animate__animated",
            offset: 100,
            callback: function(box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        });
        wow.init();

        // Bootstrap ScrollSpy
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#navbarNavigation'
        });

        // Add ripple animation CSS
        const rippleCSS = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            .animate-in {
                opacity: 1;
                transform: translateY(0);
                transition: all 0.6s ease;
            }

            .focused {
                transform: translateY(-2px);
                transition: transform 0.3s ease;
            }

            .has-value {
                background: rgba(107, 127, 255, 0.05);
            }
        `;

        const style = document.createElement('style');
        style.textContent = rippleCSS;
        document.head.appendChild(style);
    </script>

    {{-- @stack('custom-scripts')
    @if ($enable_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif --}}

</body>

</html>
