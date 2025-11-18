@php
    use App\Models\Utility;
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo = Utility::get_file('uploads/landing_page_image/');
    $sup_logo = Utility::get_file('uploads/logo');
    $adminSettings = Utility::settings();
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
    <link rel="icon" href="{{ $sup_logo . '/' . (isset($adminSettings['company_favicon']) && !empty($adminSettings['company_favicon']) ? $adminSettings['company_favicon'] : 'favicon.png') }}" type="image/x-icon" />
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
        }
    </style>
    
    <!-- Additional Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">
    
    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif

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
                <img src="{{ $sup_logo . '/' . (isset($adminSettings['company_logo']) ? $adminSettings['company_logo'] : 'logo.png') }}" alt="Loading..." class="loader-logo">
            </div>
            <div class="loading-text">Loading SmartHR...</div>
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
                        <img src="{{ $logo . '/' . $settings['site_logo'] . '?' . time() }}" 
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
                                <span class="btn-text d-none d-lg-inline">{{ __('Login') }}</span>
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
                <div class="hero-background">
                    <div class="hero-gradient"></div>
                    <div class="hero-pattern"></div>
                    <div class="floating-elements">
                        <div class="floating-element element-1"></div>
                        <div class="floating-element element-2"></div>
                        <div class="floating-element element-3"></div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row align-items-center min-vh-100 py-5">
                        <div class="col-lg-6">
                            <div class="hero-content fade-in-up">
                                @if($settings['home_offer_text'])
                                    <div class="hero-badge mb-4">
                                        <span class="badge-content">
                                            <i class="ti ti-sparkles me-2"></i>
                                            {{ $settings['home_offer_text'] }}
                                        </span>
                                    </div>
                                @endif
                                
                                <h1 id="hero-heading" class="hero-title mb-4">
                                    {{ $settings['home_heading'] ?: 'Smart HR Management for Modern Businesses' }}
                                </h1>
                                
                                <p class="hero-description mb-5">
                                    {{ $settings['home_description'] ?: 'Streamline your HR processes with our intelligent, cloud-based platform designed for efficiency and growth.' }}
                                </p>
                                
                                <div class="hero-actions d-flex flex-wrap gap-3">
                                    @if ($settings['home_live_demo_link'])
                                        <a href="{{ $settings['home_live_demo_link'] }}" 
                                           class="btn btn-primary btn-lg smart-btn-hero"
                                           aria-label="View live demo">
                                            <span class="btn-text">{{ __('Live Demo') }}</span>
                                            <i class="ti ti-play ms-2"></i>
                                        </a>
                                    @endif
                                    
                                    @if ($settings['home_buy_now_link'])
                                        <a href="{{ $settings['home_buy_now_link'] }}" 
                                           class="btn btn-outline-primary btn-lg smart-btn-hero-outline"
                                           aria-label="Purchase now">
                                            <span class="btn-text">{{ __('Get Started') }}</span>
                                            <i class="ti ti-arrow-right ms-2"></i>
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Social Proof -->
                                <div class="hero-social-proof mt-5">
                                    <div class="social-proof-stats d-flex flex-wrap gap-4">
                                        <div class="stat-item">
                                            <div class="stat-number">1000+</div>
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
                        
                        <div class="col-lg-6">
                            <div class="hero-visual fade-in-right">
                                <div class="hero-image-container">
                                    <img src="{{ $logo . '/' . $settings['home_banner'] }}" 
                                         alt="SmartHR Dashboard Preview" 
                                         class="hero-image img-fluid"
                                         loading="lazy">
                                    
                                    <!-- Floating UI Elements -->
                                    <div class="floating-ui-elements">
                                        <div class="ui-element ui-card-1">
                                            <div class="ui-content">
                                                <i class="ti ti-users text-success"></i>
                                                <span>125 Employees</span>
                                            </div>
                                        </div>
                                        <div class="ui-element ui-card-2">
                                            <div class="ui-content">
                                                <i class="ti ti-trending-up text-primary"></i>
                                                <span>98% Attendance</span>
                                            </div>
                                        </div>
                                        <div class="ui-element ui-card-3">
                                            <div class="ui-content">
                                                <i class="ti ti-clock text-warning"></i>
                                                <span>Real-time Updates</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Trusted By Section -->
                    @if($settings['home_trusted_by'] && $settings['home_logo'])
                        <div class="trusted-by-section py-5">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="trusted-text">
                                        <span class="trusted-label">{{ __('Trusted by') }}</span>
                                        <span class="trusted-count">{{ $settings['home_trusted_by'] }}</span>
                                        <span class="trusted-suffix">{{ __('companies worldwide') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="trusted-logos">
                                        <div class="logos-scroll">
                                            @foreach (explode(',', $settings['home_logo']) as $k => $home_logo)
                                                <div class="logo-item">
                                                    <img src="{{ $logo . '/' . $home_logo }}" 
                                                         alt="Trusted Company Logo {{ $k + 1 }}" 
                                                         class="trusted-logo"
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

        <!-- Features Section -->
        @if ($settings['feature_status'] == 'on')
            <section class="smart-features-section section-gap" id="features" aria-labelledby="features-heading">
                <div class="container">
                    <div class="row gy-5">
                        <!-- Features Header -->
                        <div class="col-lg-5">
                            <div class="features-header">
                                <div class="section-badge mb-3">
                                    <span class="badge-text">{{ $settings['feature_title'] ?: 'Features' }}</span>
                                </div>
                                <h2 id="features-heading" class="section-title mb-4">
                                    {!! $settings['feature_heading'] ?: 'Powerful Features for <span class="text-primary">Modern HR</span>' !!}
                                </h2>
                                <p class="section-description mb-4">
                                    {!! $settings['feature_description'] ?: 'Discover comprehensive HR tools designed to streamline your workflow and enhance productivity.' !!}
                                </p>
                                @if ($settings['feature_buy_now_link'])
                                    <a href="{{ $settings['feature_buy_now_link'] }}" 
                                       class="btn btn-primary smart-btn-cta"
                                       aria-label="Purchase now">
                                        {{ __('Get Started Today') }}
                                        <i class="ti ti-arrow-right ms-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Features Grid -->
                        <div class="col-lg-7">
                            <div class="features-grid">
                                @if (is_array(json_decode($settings['feature_of_features'], true)) || is_object(json_decode($settings['feature_of_features'], true)))
                                    @foreach (json_decode($settings['feature_of_features'], true) as $key => $feature)
                                        <div class="feature-card {{ $key == 0 ? 'featured-card' : '' }}" 
                                             data-aos="fade-up" 
                                             data-aos-delay="{{ $key * 100 }}">
                                            <div class="feature-icon">
                                                <img src="{{ $logo . '/' . $feature['feature_logo'] . '?' . time() }}" 
                                                     alt="{{ $feature['feature_heading'] }} icon" 
                                                     class="feature-icon-img"
                                                     loading="lazy">
                                            </div>
                                            <div class="feature-content">
                                                <h3 class="feature-title">
                                                    {!! $feature['feature_heading'] !!}
                                                </h3>
                                                <p class="feature-description">
                                                    {!! $feature['feature_description'] !!}
                                                </p>
                                                <a href="#" class="feature-link">
                                                    Learn more <i class="ti ti-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feature Highlight -->
                    @if($settings['highlight_feature_heading'])
                        <div class="feature-highlight mt-5 pt-5">
                            <div class="text-center mb-5">
                                <div class="section-badge mb-3">
                                    <span class="badge-text">{{ $settings['feature_title'] ?: 'Spotlight' }}</span>
                                </div>
                                <h2 class="section-title mb-4">
                                    {!! $settings['highlight_feature_heading'] !!}
                                </h2>
                                <p class="section-description">
                                    {!! $settings['highlight_feature_description'] !!}
                                </p>
                            </div>
                            
                            <div class="feature-showcase">
                                <div class="showcase-image-container">
                                    <img src="{{ $logo . '/' . $settings['highlight_feature_image'] }}" 
                                         alt="Feature Highlight" 
                                         class="showcase-image img-fluid"
                                         loading="lazy">
                                    
                                    <!-- Interactive Elements -->
                                    <div class="showcase-elements">
                                        <div class="showcase-dot dot-1" data-feature="Analytics">
                                            <div class="dot-content">
                                                <strong>Advanced Analytics</strong>
                                                <p>Real-time insights into your workforce</p>
                                            </div>
                                        </div>
                                        <div class="showcase-dot dot-2" data-feature="Automation">
                                            <div class="dot-content">
                                                <strong>Smart Automation</strong>
                                                <p>Reduce manual work by 80%</p>
                                            </div>
                                        </div>
                                        <div class="showcase-dot dot-3" data-feature="Integration">
                                            <div class="dot-content">
                                                <strong>Seamless Integration</strong>
                                                <p>Connect with 500+ apps</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- Additional Features Section -->
        @if ($settings['feature_status'] == 'on' && isset($settings['other_features']))
            <section class="smart-additional-features bg-light section-gap">
                <div class="container">
                    @if (is_array(json_decode($settings['other_features'], true)) || is_object(json_decode($settings['other_features'], true)))
                        @foreach (json_decode($settings['other_features'], true) as $key => $otherFeature)
                            <div class="additional-feature-row {{ $key % 2 == 0 ? '' : 'reverse' }} mb-5">
                                <div class="row align-items-center gy-4">
                                    <div class="col-lg-6">
                                        <div class="feature-content-alt">
                                            <div class="section-badge mb-3">
                                                <span class="badge-text">Feature {{ $key + 1 }}</span>
                                            </div>
                                            <h2 class="feature-title-alt mb-4">
                                                {!! $otherFeature['other_features_heading'] !!}
                                            </h2>
                                            <p class="feature-description-alt mb-4">
                                                {!! $otherFeature['other_feature_description'] !!}
                                            </p>
                                            <div class="feature-benefits">
                                                <div class="benefit-item">
                                                    <i class="ti ti-check text-success me-2"></i>
                                                    <span>Easy to implement and use</span>
                                                </div>
                                                <div class="benefit-item">
                                                    <i class="ti ti-check text-success me-2"></i>
                                                    <span>24/7 customer support</span>
                                                </div>
                                                <div class="benefit-item">
                                                    <i class="ti ti-check text-success me-2"></i>
                                                    <span>Regular updates and improvements</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="feature-visual-alt">
                                            <img src="{{ $logo . '/' . $otherFeature['other_features_image'] }}" 
                                                 alt="{{ $otherFeature['other_features_heading'] }}" 
                                                 class="feature-image-alt img-fluid"
                                                 loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        @if ($settings['plan_status'] == 'on' && isset($plans))
            <section class="smart-pricing-section section-gap" id="pricing" aria-labelledby="pricing-heading">
                <div class="container">
                    <div class="text-center mb-5">
                        <div class="section-badge mb-3">
                            <span class="badge-text">{{ $settings['plan_title'] ?: 'Pricing' }}</span>
                        </div>
                        <h2 id="pricing-heading" class="section-title mb-4">
                            Simple, Transparent Pricing
                        </h2>
                        <p class="section-description">
                            Choose the perfect plan for your business needs. No hidden fees, no surprises.
                        </p>
                    </div>
                    
                    <div class="pricing-grid">
                        @foreach($plans as $key => $plan)
                            <div class="pricing-card {{ $key == 1 ? 'featured-plan' : '' }}" 
                                 data-aos="fade-up" 
                                 data-aos-delay="{{ $key * 100 }}">
                                @if($key == 1)
                                    <div class="plan-badge">Most Popular</div>
                                @endif
                                
                                <div class="plan-header">
                                    <h3 class="plan-name">{{ $plan->name }}</h3>
                                    <div class="plan-price">
                                        <span class="price-currency">$</span>
                                        <span class="price-amount">{{ $plan->price }}</span>
                                        <span class="price-period">/month</span>
                                    </div>
                                    <p class="plan-description">{{ $plan->description }}</p>
                                </div>
                                
                                <div class="plan-features">
                                    <ul class="features-list">
                                        <li class="feature-item">
                                            <i class="ti ti-check text-success me-2"></i>
                                            {{ $plan->max_users }} Users
                                        </li>
                                        <li class="feature-item">
                                            <i class="ti ti-check text-success me-2"></i>
                                            {{ $plan->max_employees }} Employees
                                        </li>
                                        <li class="feature-item">
                                            <i class="ti ti-check text-success me-2"></i>
                                            {{ $plan->storage_limit }}GB Storage
                                        </li>
                                        <li class="feature-item">
                                            <i class="ti ti-check text-success me-2"></i>
                                            24/7 Support
                                        </li>
                                        <li class="feature-item">
                                            <i class="ti ti-check text-success me-2"></i>
                                            Regular Updates
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="plan-action">
                                    <a href="{{ route('register') }}" 
                                       class="btn {{ $key == 1 ? 'btn-primary' : 'btn-outline-primary' }} btn-lg w-100"
                                       aria-label="Choose {{ $plan->name }} plan">
                                        Get Started
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="pricing-footer text-center mt-5">
                        <p class="mb-0">
                            Need a custom plan? 
                            <a href="#" class="text-primary fw-semibold">Contact our sales team</a>
                        </p>
                    </div>
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
                                <a href="#" class="btn btn-outline-primary">
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
    <footer class="smart-footer bg-dark text-white">
        <div class="footer-main py-5">
            <div class="container">
                <div class="row gy-4">
                    <!-- Company Info -->
                    <div class="col-lg-4">
                        <div class="footer-brand">
                            <img src="{{ $logo . '/' . $settings['site_logo'] . '?' . time() }}" 
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
                    
                    <!-- Support -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-section">
                            <h5 class="footer-title">Support</h5>
                            <ul class="footer-links">
                                <li><a href="#faq">FAQ</a></li>
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">System Status</a></li>
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
        <div class="footer-bottom py-3 border-top border-secondary">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            © {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.
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

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="ti ti-arrow-up"></i>
    </button>

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
                }
            });
        });
    </script>
</body>
</html>
