@php
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    // $logo = asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo');

    $company_logo = \App\Models\Utility::GetLogo();
    $SITE_RTL = \App\Models\Utility::getValByName('SITE_RTL');
    $language = \App\Models\Utility::getValByName('default_language');

    $setting = \App\Models\Utility::colorset();
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';

    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = isset($getseo['meta_title']) ? $getseo['meta_title'] : '';
    $metadesc = isset($getseo['meta_description']) ? $getseo['meta_description'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image']) ? $getseo['meta_image'] : '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');
    $lang = \App::getLocale('lang');
    if ($lang == 'ar' || $lang == 'he') {
        $SITE_RTL = 'on';
    }
    elseif($SITE_RTL == 'on')
    {
        $SITE_RTL = 'on';
    }
    else {
        $SITE_RTL = 'off';
    }

    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $SITE_RTL == 'on' ? 'rtl' : '' }}">

<head>
    <title>
        {{ \App\Models\Utility::getValByName('title_text') ? \App\Models\Utility::getValByName('title_text') : config('app.name', 'HRMGo SaaS') }}
        - @yield('page-title')</title>

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


    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />

    <!-- Favicon icon -->
    <link rel="icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" type="image/png" />
    <link rel="apple-touch-icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" />
    <link rel="shortcut icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" type="image/png" />

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- vendor css -->

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

        /* Enhanced Background Image Styling */
        .login-bg-img {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }

        .login-bg-img .bg-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            z-index: 1;
            transform: scale(1.1);
            animation: backgroundParallax 20s ease-in-out infinite alternate;
        }

        @keyframes backgroundParallax {
            0% { transform: scale(1.1) translateX(0); }
            100% { transform: scale(1.15) translateX(-2%); }
        }

        .login-bg-img .bg-image.loaded {
            opacity: 1;
        }

        /* Background Overlay */
        .login-bg-img::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(107, 127, 255, 0.15) 0%,
                rgba(30, 41, 59, 0.25) 50%,
                rgba(15, 23, 42, 0.35) 100%
            );
            z-index: 2;
        }

        /* Enhanced Header Styling */
        .dash-header {
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
        }

        .dash-header .navbar-brand {
            padding: 0.5rem 0;
        }

        .logo {
            max-height: 45px;
            width: auto;
            max-width: 200px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        /* Enhanced Custom Wrapper */
        .custom-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 2rem 1rem;
            box-sizing: border-box;
            position: relative;
            z-index: 20;
        }

        .custom-row {
            max-width: 480px;
            width: 100%;
            position: relative;
        }

        /* Enhanced Card Styling */
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 64px rgba(0, 0, 0, 0.15);
            padding: 0;
            overflow: hidden;
            position: relative;
            animation: cardFadeIn 0.8s ease-out;
        }

        @keyframes cardFadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--smart-primary) 0%, rgba(107, 127, 255, 0.8) 100%);
            z-index: 1;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 2rem 2rem 1.5rem;
            text-align: center;
        }

        .card-body {
            padding: 2rem;
            position: relative;
        }

        /* Enhanced Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--smart-gray-700);
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid var(--smart-gray-200);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 2;
        }

        .form-control:focus {
            border-color: var(--smart-primary);
            box-shadow: 0 0 0 4px rgba(107, 127, 255, 0.1);
            background: rgba(255, 255, 255, 0.95);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--smart-gray-400);
            font-weight: 400;
        }

        /* Enhanced Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--smart-primary) 0%, rgba(107, 127, 255, 0.9) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 24px rgba(107, 127, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(107, 127, 255, 0.4);
            background: linear-gradient(135deg, rgba(107, 127, 255, 0.9) 0%, var(--smart-primary) 100%);
        }

        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(107, 127, 255, 0.3);
        }

        /* Enhanced Link Styling */
        .auth-link {
            color: var(--smart-primary);
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .auth-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--smart-primary);
            transition: width 0.3s ease;
        }

        .auth-link:hover::after {
            width: 100%;
        }

        .auth-link:hover {
            color: var(--smart-primary);
            transform: translateY(-1px);
        }

        /* Enhanced Footer */
        .auth-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            z-index: 1000;
            text-align: center;
        }

        .auth-footer span {
            color: var(--smart-gray-600);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Enhanced Navbar Toggler */
        .navbar-toggler {
            border: 2px solid var(--smart-primary);
            border-radius: 8px;
            padding: 0.5rem;
            background: rgba(107, 127, 255, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: var(--smart-primary);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='#{$primary}' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Card Title Styling */
        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--smart-gray-900);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .card-subtitle {
            color: var(--smart-gray-600);
            font-size: 1rem;
            margin-bottom: 2rem;
            text-align: center;
            line-height: 1.5;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        /* Checkbox Styling */
        .form-check-input {
            border-radius: 6px;
            border: 2px solid var(--smart-gray-300);
            width: 1.25rem;
            height: 1.25rem;
        }

        .form-check-input:checked {
            background-color: var(--smart-primary);
            border-color: var(--smart-primary);
        }

        .form-check-label {
            color: var(--smart-gray-700);
            font-weight: 500;
            margin-left: 0.5rem;
        }

        /* Loading Animation */
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

        /* Toast Enhancements */
        .toast {
            border-radius: 12px;
            border: none;
            backdrop-filter: blur(20px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .custom-wrapper {
                padding: 1rem 0.75rem;
                min-height: calc(100vh - 120px);
            }

            .custom-row {
                max-width: 100%;
            }

            .card-body, .card-header {
                padding: 1.5rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .logo {
                max-height: 40px;
            }

            .btn-primary {
                padding: 0.875rem 1.5rem;
                font-size: 0.9rem;
            }

            .form-control {
                padding: 0.875rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .card {
                border-radius: 16px;
                margin: 0 0.5rem;
            }

            .card-body, .card-header {
                padding: 1.25rem;
            }

            .card-title {
                font-size: 1.375rem;
            }

            .auth-footer {
                position: relative;
                margin-top: 2rem;
                background: rgba(255, 255, 255, 0.8);
            }
        }

        /* Enhanced Input Focus Effects */
        .form-floating {
            position: relative;
        }

        .form-floating .form-control:focus ~ label,
        .form-floating .form-control:not(:placeholder-shown) ~ label {
            transform: translateY(-1.5rem) scale(0.85);
            color: var(--smart-primary);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--smart-gray-100);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--smart-gray-400);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--smart-primary);
        }

        /* Particle Effect */
        .auth-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(107, 127, 255, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">

    @if ($setting['cust_darklayout'] == 'on')
        @if (isset($SITE_RTL) && $SITE_RTL == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
        @endif
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        @if (isset($SITE_RTL) && $SITE_RTL == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
        @endif
    @endif
    @if (isset($SITE_RTL) && $SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-login-rtl.css') }}" id="main-style-link">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/custom-login.css') }}" id="main-style-link">
    @endif
    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-dark.css') }}" id="main-style-link">
    @endif

</head>
<style>
 .login-bg-img {
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0; left: 0;
    overflow: hidden;
    z-index: 0;
}

.login-bg-img .bg-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0; left: 0;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    z-index: 1;
}

.login-bg-img .bg-image.loaded {
    opacity: 1;
}

.login-bg-img .overlay-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    text-align: center;
    padding: 1rem 2rem;
    max-width: 90%;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(51, 38, 122, 0.4);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    z-index: 10;
}

.login-bg-img .overlay-text h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
    color: var(--color-customColor);
    text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.4);
}

.login-bg-img .overlay-text p {
    font-size: 1.25rem;
    line-height: 1.4;
    text-shadow: 1px 1px 6px rgba(0, 29, 195, 0.6);
}

.custom-login-inner {
    position: relative;
    z-index: 20;
}

.custom-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    padding: 1rem;
    box-sizing: border-box;
    z-index: 20;
}

.custom-row {
    max-width: 600px;
    width: 100%;
}

.logo {
    max-height: 50px;
    width: auto;
    max-width: 100%;
    height: auto;
}

@media (max-width: 768px) {
    .login-bg-img .overlay-text h1 {
        font-size: 2rem;
        padding: 0.75rem 1.5rem;
    }
    .login-bg-img .overlay-text p {
        font-size: 1rem;
    }
    .custom-row {
        max-width: 100%;
        padding: 0 1rem;
    }
}

@media (max-width: 480px) {
    .login-bg-img .overlay-text h1 {
        font-size: 1.5rem;
        padding: 0.5rem 1rem;
    }
    .login-bg-img .overlay-text p {
        font-size: 0.9rem;
    }
}

.dash-header {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    z-index: 9999 !important;
    background-color: rgb(255, 255, 255) !important;

    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
}
.custom-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100%;
  padding: 1rem;
  box-sizing: border-box;
}

.custom-row {
  max-width: 600px;
  width: 100%;
}


</style>



<body class="{{ $themeColor }}">

    <!-- [custom-login] start -->
    <div class="custom-login">
   <div class="login-bg-img">
    <img src="{{ asset('assets/images/background-02.jpg') }}" alt="Background" class="bg-image" />

    {{-- <div class="overlay-text">
        <h1>Welcome to Smart HR System</h1>
        <p>Your all-in-one solution to streamline human resource management efficiently and effortlessly.</p>
    </div> --}}
</div>



        <div class="custom-login-inner">
            <!-- Enhanced Header -->
            <header class="dash-header">
                <nav class="navbar navbar-expand-md default">
                    <div class="container">
                        <div class="navbar-brand">
                            <a href="#">
                                <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo . '?' . time() : 'logo_dark.png' . '?' . time()) }}"
                                    class="logo" alt="{{ config('app.name', 'HRMGo SaaS') }}" alt="logo"
                                    loading="lazy" style="max-height: 45px;" />
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarlogin">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarlogin">
                            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                                @include('landingpage::layouts.buttons')
                                @yield('language-bar')
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Floating Particles Background -->
            <div class="auth-particles">
                <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
                <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
                <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
                <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
                <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
                <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
                <div class="particle" style="left: 70%; animation-delay: 12s;"></div>
                <div class="particle" style="left: 80%; animation-delay: 14s;"></div>
                <div class="particle" style="left: 90%; animation-delay: 16s;"></div>
            </div>

            <!-- Enhanced Main Content -->
            <main class="custom-wrapper">
                <div class="custom-row">
                    <div class="card">
                        @yield('content')
                    </div>
                </div>
            </main>


            <!-- Enhanced Footer -->
            <footer>
                <div class="auth-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span>
                                    @if (empty(App\Models\Utility::getValByName('footer_text')))
                                        &copy;{{ date(' Y') }}
                                    @endif
                                    {{ App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'SmartHR') }}
                                    - Powered by ChorohaTechnology
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Enhanced Toast Notification -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- [custom-login] end -->

    <!-- Required Js -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor-all.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>
        feather.replace();
    </script>

    <input type="checkbox" class="d-none" id="cust-theme-bg"
        {{ \App\Models\Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : '' }} />
    <input type="checkbox" class="d-none" id="cust-darklayout"
        {{ \App\Models\Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : '' }} />

    {{-- Dark Mode ReCaptcha --}}
    {{-- @if (\App\Models\Utility::getValByName('cust_darklayout') == 'on')
        <style>
            .g-recaptcha {
                filter: invert(1) hue-rotate(180deg) !important;
            }
        </style>
    @endif --}}

    {{-- <script src="{{asset('custom/js/custom.js')}}"></script> --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('script')
    @stack('custom-scripts')
    @if ($enable_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif

    @if ($message = Session::get('success'))
        <script>
            show_toastr('Success', '{!! $message !!}', 'success');
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            show_toastr('Error', '{!! $message !!}', 'error');
        </script>
    @endif
</body>

</html>

<script>
$(document).ready(function() {
    // Enhanced background image loading
    $('.login-bg-img .bg-image').each(function() {
        if (this.complete) {
            $(this).addClass('loaded');
        } else {
            $(this).on('load', function() {
                $(this).addClass('loaded');
            });
        }
    });

    // Enhanced form interactions
    $('.form-control').on('focus', function() {
        $(this).closest('.form-group').addClass('focused');
    });

    $('.form-control').on('blur', function() {
        $(this).closest('.form-group').removeClass('focused');
    });

    // Button loading state enhancement
    $('form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.addClass('loading').prop('disabled', true);

        // Re-enable after 3 seconds if still processing
        setTimeout(function() {
            submitBtn.removeClass('loading').prop('disabled', false);
        }, 3000);
    });

    // Enhanced input validation feedback
    $('.form-control').on('input', function() {
        const $this = $(this);
        const value = $this.val();

        if (value.length > 0) {
            $this.addClass('has-value');
        } else {
            $this.removeClass('has-value');
        }
    });

    // Smooth scroll for any anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 500);
        }
    });

    // Enhanced navbar scroll effect
    $(window).on('scroll', function() {
        const scrollTop = $(window).scrollTop();
        const header = $('.dash-header');

        if (scrollTop > 50) {
            header.addClass('scrolled');
        } else {
            header.removeClass('scrolled');
        }
    });

    // Add ripple effect to buttons
    $('.btn').on('click', function(e) {
        const $this = $(this);
        const offset = $this.offset();
        const xPos = e.pageX - offset.left;
        const yPos = e.pageY - offset.top;

        const ripple = $('<span class="ripple"></span>');
        ripple.css({
            top: yPos,
            left: xPos
        });

        $this.append(ripple);

        setTimeout(function() {
            ripple.remove();
        }, 600);
    });

    // Auto-hide alerts after 5 seconds
    $('.alert').each(function() {
        const $alert = $(this);
        setTimeout(function() {
            $alert.fadeOut(500);
        }, 5000);
    });

    // Enhanced keyboard navigation
    $(document).on('keydown', function(e) {
        if (e.key === 'Tab') {
            $('body').addClass('keyboard-navigation');
        }
    });

    $(document).on('mousedown', function() {
        $('body').removeClass('keyboard-navigation');
    });

    // Progressive enhancement for older browsers
    if (!window.CSS || !CSS.supports('backdrop-filter', 'blur(10px)')) {
        $('.card, .dash-header, .auth-footer').css({
            'background': 'rgba(255, 255, 255, 0.98)',
            'backdrop-filter': 'none'
        });
    }
});

// Enhanced particle animation
function createParticles() {
    const particleContainer = $('.auth-particles');
    const particleCount = window.innerWidth < 768 ? 5 : 9;

    for (let i = 0; i < particleCount; i++) {
        const particle = $('<div class="particle"></div>');
        particle.css({
            left: Math.random() * 100 + '%',
            animationDelay: Math.random() * 20 + 's',
            animationDuration: (15 + Math.random() * 10) + 's'
        });
        particleContainer.append(particle);
    }
}

// Initialize particles on load
$(window).on('load', function() {
    createParticles();
});

// Add custom CSS for enhanced effects
const enhancedStyles = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: rippleEffect 0.6s linear;
        pointer-events: none;
    }

    @keyframes rippleEffect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .keyboard-navigation *:focus {
        outline: 2px solid var(--smart-primary);
        outline-offset: 2px;
    }

    .form-group.focused .form-label {
        color: var(--smart-primary);
        transform: translateY(-2px);
    }

    .has-value {
        background: rgba(107, 127, 255, 0.05);
    }

    .dash-header.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12) !important;
    }
`;

$('<style>').text(enhancedStyles).appendTo('head');
</script>
