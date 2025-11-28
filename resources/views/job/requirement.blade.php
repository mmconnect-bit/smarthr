@php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $setting = App\Models\Utility::colorset();
    $color = $setting['theme_color'] ?? 'theme-3';
    $SITE_RTL = \App\Models\Utility::getValByName('SITE_RTL');
    $company_logo_light = \App\Models\Utility::getValByName('company_logo_light');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = $getseo['meta_title'] ?? config('app.name', 'HRMGo');
    $metadesc = $getseo['meta_description'] ?? '';
    $meta_logo = $getseo['meta_image'] ?? '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $SITE_RTL == 'on' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }} - {{ __('Job Details') }} | {{ config('app.name') }}</title>

    <!-- SEO & Open Graph -->
    <meta name="title" content="{{ $job->title }} - {{ config('app.name') }}">
    <meta name="description" content="{{ Str::limit(strip_tags($job->description), 160) }}">
    <meta property="og:title" content="{{ $job->title }} - We're Hiring!">
    <meta property="og:description" content="{{ Str::limit(strip_tags($job->description), 200) }}">
    <meta property="og:image" content="{{ $meta_logo ? asset('storage/uploads/meta/'.$meta_logo) : 'https://images.unsplash.com/photo-1497032623684-9931c1e73aac?q=80&w=2940&auto=format&fit=crop' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="twitter:card" content="summary_large_image">

    <link rel="icon" href="{{ $logo . '/' . ($company_favicon ?? 'favicon.png') }}">

    <!-- Fonts & Tailwind -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui'] },
                    colors: { primary: '#4361ee', 'primary-dark': '#3a56d4' }
                }
            }
        }
    </script>

    <style>
        .gradient-header {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.95), rgba(58, 86, 212, 0.98)),
                        url('https://images.unsplash.com/photo-1497032623684-9931c1e73aac?q=80&w=2940&auto=format&fit=crop') center/cover no-repeat;
        }
        .prose :where(h3):not(:where([class~="not-prose"] *)) { @apply text-2xl font-bold text-gray-900 mt-12 mb-5; }
        .prose :where(p):not(:where([class~="not-prose"] *)) { @apply text-gray-700 leading-relaxed mb-4; }
        .prose :where(ul):not(:where([class~="not-prose"] *)) { @apply list-disc list-inside space-y-2 text-gray-700; }
        .prose :where(ol):not(:where([class~="not-prose"] *)) { @apply list-decimal list-inside space-y-2 text-gray-700; }
        .sticky-cta { backdrop-filter: blur(12px); background: rgba(255,255,255,0.95); box-shadow: 0 10px 30px rgba(0,0,0,0.12); }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Hero Header -->
    <header class="relative h-96 gradient-header flex items-center justify-center text-center text-white">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative z-10 container mx-auto px-6">
            <img src="{{ $logo . '/' . ($company_logo_light ?? 'logo-light.png') }}" alt="Logo" class="h-16 mx-auto mb-8 drop-shadow-lg">
            <h1 class="text-4xl md:text-6xl font-bold mb-5 leading-tight">{{ $job->title }}</h1>
            <div class="flex flex-wrap justify-center gap-6 text-lg font-medium">
                @if($job->branches?->name)
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        {{ $job->branches->name }}
                    </span>
                @endif
                <span class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414a2 2 0 00-.586-1.414L11.586 2H6z"/></svg>
                    {{ $job->position }} {{ __('Open Position(s)') }}
                </span>
            </div>
        </div>
    </header>

    <!-- Sticky Apply Button (Desktop) -->
    <div class="hidden lg:block sticky top-6 z-40 max-w-5xl mx-auto px-6 -mt-12">
        <div class="sticky-cta rounded-2xl p-6 text-center">
            <a href="{{ route('job.apply', [$job->code, $currantLang ?? 'en']) }}"
               class="inline-flex items-center bg-primary hover:bg-primary-dark text-white font-bold text-lg px-12 py-5 rounded-xl transition shadow-lg hover:shadow-2xl transform hover:-translate-y-1">
                <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                {{ __('Apply for This Position') }}
            </a>
        </div>
    </div>

    <!-- Job Content -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Skills Bar -->
                @if($job->skill)
                <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-10 py-7 border-b">
                    <div class="flex flex-wrap gap-3 justify-center">
                        @foreach(explode(',', $job->skill) as $skill)
                            <span class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-semibold bg-primary text-white shadow-sm">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="p-8 lg:p-14 prose prose-lg max-w-none">

                    <!-- Requirements -->
                    @if(trim(strip_tags($job->requirement)))
                    <div>
                        <h3>{{ __('Job Requirements') }}</h3>
                        {!! $job->requirement !!}
                    </div>
                    <hr class="my-14 border-gray-200">
                    @endif

                    <!-- Description -->
                    <div>
                        <h3>{{ __('About the Role') }}</h3>
                        {!! $job->description !!}
                    </div>

                    <!-- Final CTA -->
                    <div class="mt-16 p-10 bg-gradient-to-r from-primary/5 to-blue-50 rounded-2xl text-center border border-primary/20">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ __('Ready to Make an Impact?') }}</h3>
                        <p class="text-lg text-gray-700 mb-8 max-w-2xl mx-auto">
                            We're looking for passionate people who want to grow with us. If this sounds like you — apply today!
                        </p>
                        <a href="{{ route('job.apply', [$job->code, $currantLang ?? 'en']) }}"
                           class="inline-flex items-center bg-primary hover:bg-primary-dark text-white font-bold text-xl px-14 py-6 rounded-xl transition shadow-xl hover:shadow-2xl transform hover:-translate-y-2">
                            <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/></svg>
                            {{ __('Apply Now') }}
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <!-- Mobile Fixed Apply Button -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t-2 border-gray-200 shadow-2xl">
        <div class="container mx-auto px-6 py-4">
            <a href="{{ route('job.apply', [$job->code, $currantLang ?? 'en']) }}"
               class="block text-center bg-primary hover:bg-primary-dark text-white font-bold text-lg py-4 rounded-xl transition">
                {{ __('Apply for This Job') }}
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-14 mt-24">
        <div class="container mx-auto px-6 text-center">
            <img src="{{ $logo . '/' . ($company_logo_light ?? 'logo-light.png') }}" alt="Logo" class="h-12 mx-auto mb-4">
            <p class="text-gray-400">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>feather && feather.replace();</script>

    @if($enable_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif
</body>
</html>
