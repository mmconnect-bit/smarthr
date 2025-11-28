@php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $setting = App\Models\Utility::colorset();
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';
    $SITE_RTL = \App\Models\Utility::getValByName('SITE_RTL');
    $company_logo_light = \App\Models\Utility::getValByName('company_logo_light');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = $getseo['meta_title'] ?? config('app.name', 'HRMGo');
    $metadesc = $getseo['meta_description'] ?? '';
    $meta_logo = $getseo['meta_image'] ?? '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');
    $themeColor = ($setting['color_flag'] ?? '') == 'true' ? 'custom-color' : $color;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $SITE_RTL == 'on' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metatitle }} - {{ __('Careers') }}</title>
    <meta name="title" content="{{ $metatitle }}">
    <meta name="description" content="{{ $metadesc }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metatitle }}">
    <meta property="og:description" content="{{ $metadesc }}">
    <meta property="og:image" content="{{ $meta_logo ? asset('storage/uploads/meta/'.$meta_logo) : asset('assets/images/og-career.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image" content="{{ $meta_logo ? asset('storage/uploads/meta/'.$meta_logo) : asset('assets/images/og-career.jpg') }}">

    <link rel="icon" href="{{ $logo . '/' . ($company_favicon ?? 'favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind + Custom Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4361ee',
                        'primary-dark': '#3a56d4',
                    }
                }
            }
        }
    </script>

    <style>
        :root { --primary-color: #4361ee; }
        .gradient-bg {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.95), rgba(58, 86, 212, 0.98)), url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=2874&auto=format&fit=crop') center/cover no-repeat;
        }
        .job-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .job-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(67, 97, 238, 0.15);
        }
        .badge-skill {
            background: rgba(67, 97, 238, 0.12);
            color: #4361ee;
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Hero Banner -->
    <header class="relative h-screen min-h-[600px] flex items-center justify-center text-center text-white overflow-hidden gradient-bg">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative z-10 container mx-auto px-6">
            <div class="flex justify-center mb-8">
                <img src="{{ $logo . '/' . ($company_logo_light ?? 'logo-light.png') }}" alt="Company Logo" class="h-16 drop-shadow-lg">
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Join Our Team
            </h1>
            <p class="text-xl md:text-2xl font-light max-w-3xl mx-auto opacity-95">
                We're building the future. Come build it with us.
            </p>
            <div class="mt-10">
                <a href="#jobs" class="inline-block bg-white text-primary-dark font-semibold px-10 py-4 rounded-full hover:bg-gray-100 transition shadow-lg">
                    Explore Open Positions
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </header>

    <!-- Jobs Section -->
    <section id="jobs" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 max-w-7xl">
            @php $totaljob = \App\Models\Job::where('created_by', $id)->count(); @endphp

            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    <span class="text-primary">{{ $totaljob }}+</span> Open Positions
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    We’re a fast-growing team passionate about innovation and making an impact.
                    If you're talented and driven, we want to hear from you.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($jobs as $job)
                    <div class="job-card bg-white rounded-2xl overflow-hidden border border-gray-200">
                        <div class="p-8">
                            <!-- Company / Department Logo -->
                            <div class="flex items-center justify-between mb-5">
                                <img src="https://images.unsplash.com/photo-1572021335469-31706a17aaef?q=80&w=100&h=100&auto=format&fit=crop"
                                     alt="Logo" class="w-14 h-14 rounded-xl object-cover shadow-md">
                                <div class="text-right">
                                    <span class="text-sm text-gray-500 flex items-center justify-end">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        {{ $job->branches->name ?? 'Remote' }}
                                    </span>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                <a href="{{ route('job.requirement', [$job->code, $job->createdBy->lang ?? 'en']) }}"
                                   class="hover:text-primary transition">
                                    {{ $job->title }}
                                </a>
                            </h3>

                            <div class="mb-5 text-sm text-gray-600">
                                <span class="font-medium">{{ $job->position }}</span> {{ __('position(s) available') }}
                            </div>

                            <!-- Skills -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach (array_slice(explode(',', $job->skill), 0, 4) as $skill)
                                    <span class="badge-skill text-xs px-3 py-1.5 rounded-full">
                                        {{ trim($skill) }}
                                    </span>
                                @endforeach
                                @if(count(explode(',', $job->skill)) > 4)
                                    <span class="text-xs text-gray-500">+{{ count(explode(',', $job->skill)) - 4 }} more</span>
                                @endif
                            </div>

                            <!-- Apply Button -->
                            <a href="{{ route('job.requirement', [$job->code, $job->createdBy->lang ?? 'en']) }}"
                               class="block text-center bg-primary text-white font-semibold py-3 rounded-xl hover:bg-primary-dark transition shadow-md hover:shadow-lg">
                                View & Apply
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($totaljob == 0)
                <div class="text-center py-20">
                    <p class="text-2xl text-gray-500">No open positions at the moment.</p>
                    <p class="text-gray-400 mt-2">Check back soon — we're always growing!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <img src="{{ $logo . '/' . ($company_logo_light ?? 'logo-light.png') }}" alt="Logo" class="h-12 mx-auto mb-4">
            <p class="text-gray-400">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>
        feather.replace();
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    @if($enable_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif
</body>
</html>
