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
    <title>{{ $job->title }} - {{ __('Apply Now') }} | {{ $metatitle }}</title>

    <!-- SEO & Social -->
    <meta name="title" content="{{ $job->title }} - Career Opportunity">
    <meta name="description" content="Apply now for {{ $job->title }} at {{ config('app.name') }}. Join our growing team.">
    <meta property="og:title" content="{{ $job->title }} - Apply Now">
    <meta property="og:description" content="We're hiring! Join our team as {{ $job->title }}.">
    <meta property="og:image" content="{{ $meta_logo ? asset('storage/uploads/meta/'.$meta_logo) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2940&auto=format&fit=crop' }}">
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
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2940&auto=format&fit=crop') center/cover no-repeat;
        }
        .input-focus:focus {
            outline: none;
            ring: 2px solid #4361ee;
            border-color: #4361ee;
        }
        .file-upload {
            @apply border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer transition hover:border-primary hover:bg-blue-50;
        }
        .file-upload.dragover {
            @apply border-primary bg-blue-50;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Hero Header -->
    <header class="relative h-96 gradient-header flex items-center justify-center text-center text-white overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative z-10 container mx-auto px-6">
            <img src="{{ $logo . '/' . ($company_logo_light ?? 'logo-light.png') }}" alt="Logo" class="h-16 mx-auto mb-6 drop-shadow-lg">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $job->title }}</h1>
            <div class="flex flex-wrap justify-center gap-4 text-lg">
                @if($job->branches?->name)
                    <span class="flex items-center"><svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg> {{ $job->branches->name }}</span>
                @endif
                <span class="flex items-center"><svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5h8a1 1 0 011 1v8a1 1 0 01-1 1H6a1 1 0 01-1-1V8a1 1 0 011-1z" clip-rule="evenodd"/></svg> Full Time</span>
            </div>
        </div>
    </header>

    <!-- Application Form -->
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-primary-dark text-white p-8 text-center">
                    <h2 class="text-3xl font-bold">{{ __('Apply for this Position') }}</h2>
                    <p class="mt-2 opacity-90">We'd love to learn more about you</p>
                </div>

                <div class="p-8 lg:p-12">
                    {{ Form::open(['route' => ['job.apply.data', $job->code], 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'applyForm']) }}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Name & Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Full Name') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Email Address') }} <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition" placeholder="john@example.com">
                        </div>

                        <!-- Phone & DOB -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Phone Number') }} <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" required class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition" placeholder="+1 (555) 000-0000">
                        </div>

                        @if(!empty($job->applicant) && in_array('dob', explode(',', $job->applicant)))
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Date of Birth') }}</label>
                            <input type="date" name="dob" class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition">
                        </div>
                        @endif

                        <!-- Gender -->
                        @if(!empty($job->applicant) && in_array('gender', explode(',', $job->applicant)))
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('Gender') }}</label>
                            <div class="flex gap-8">
                                <label class="flex items-center"><input type="radio" name="gender" value="Male" class="mr-3"><span>Male</span></label>
                                <label class="flex items-center"><input type="radio" name="gender" value="Female" class="mr-3"><span>Female</span></label>
                                <label class="flex items-center"><input type="radio" name="gender" value="Other" class="mr-3"><span>Other / Prefer not to say</span></label>
                            </div>
                        </div>
                        @endif

                        <!-- Location Fields -->
                        @if(!empty($job->applicant) && in_array('country', explode(',', $job->applicant)))
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Country') }}</label>
                            <input type="text" name="country" class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('State / Region') }}</label>
                            <input type="text" name="state" class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('City') }}</label>
                            <input type="text" name="city" class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition">
                        </div>
                        @endif

                        <!-- File Uploads -->
                        @if(!empty($job->visibility) && in_array('profile', explode(',', $job->visibility)))
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('Profile Photo') }}</label>
                            <div class="file-upload" onclick="document.getElementById('profile').click()">
                                <input type="file" name="profile" id="profile" class="hidden" accept="image/*">
                                <p class="text-gray-500">Click to upload your photo (optional)</p>
                            </div>
                        </div>
                        @endif

                        @if(!empty($job->visibility) && in_array('resume', explode(',', $job->visibility)))
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('CV / Resume') }} <span class="text-red-500">*</span></label>
                            <div class="file-upload" onclick="document.getElementById('resume').click()">
                                <input type="file" name="resume" id="resume" class="hidden" accept=".pdf,.doc,.docx" required>
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                <p class="text-gray-600 font-medium">Drop your resume here or click to upload</p>
                                <p class="text-sm text-gray-500 mt-2">PDF, DOC, DOCX up to 10MB</p>
                            </div>
                        </div>
                        @endif

                        <!-- Cover Letter -->
                        @if(!empty($job->visibility) && in_array('letter', explode(',', $job->visibility)))
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('Cover Letter (Optional)') }}</label>
                            <textarea name="cover_letter" rows="6" class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition resize-none" placeholder="Tell us why you're excited about this role and what makes you a great fit..."></textarea>
                        </div>
                        @endif

                        <!-- Custom Questions -->
                        @foreach ($questions as $question)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                {{ $question->question }} {{ $question->is_required == 'yes' ? '<span class="text-red-500">*</span>' : '' }}
                            </label>
                            <input type="text" name="question[{{ $question->id }}]" {{ $question->is_required == 'yes' ? 'required' : '' }}
                                   class="w-full px-5 py-4 border border-gray-300 rounded-xl input-focus transition">
                        </div>
                        @endforeach

                        <!-- Terms -->
                        @if(!empty($job->visibility) && in_array('terms', explode(',', $job->visibility)))
                        <div class="md:col-span-2">
                            <label class="flex items-start">
                                <input type="checkbox" name="terms_condition_check" required class="mt-1 mr-3">
                                <span class="text-sm text-gray-700">
                                    I accept the <a href="{{ route('terms-and-conditions', $job->id) }}" target="_blank" class="text-primary underline font-medium">Terms and Conditions</a> and
                                    <a href="#" class="text-primary underline font-medium">Privacy Policy</a>
                                </span>
                            </label>
                        </div>
                        @endif

                        <!-- Submit -->
                        <div class="md:col-span-2 text-center mt-8">
                            <button type="submit" class="inline-flex items-center bg-primary hover:bg-primary-dark text-white font-bold text-lg px-12 py-5 rounded-xl transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                {{ __('Submit Application') }}
                            </button>
                            <p class="text-sm text-gray-500 mt-6">We typically reply within 3–5 business days</p>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 text-center">
        <div class="container mx-auto px-6">
            <img src="{{ $logo . '/' . ($company_logo_light ?? 'logo-light.png') }}" alt="Logo" class="h-12 mx-auto mb-4">
            <p class="text-gray-400">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>
        // File upload visual feedback
        ['profile', 'resume'].forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('change', function() {
                    const parent = this.parentElement;
                    if (this.files.length > 0) {
                        parent.innerHTML = `<p class="text-green-600 font-medium">Selected: ${this.files[0].name}</p>`;
                        parent.classList.add('bg-blue-50', 'border-primary');
                    }
                });
            }
        });

        // Toast notifications (if needed)
        @if(session('success'))
            alert("{{ session('success') }}");
        @endif
        @if(session('error'))
            alert("{{ session('error') }}");
        @endif
    </script>

    @if($enable_cookie['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif
</body>
</html>
