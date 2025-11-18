<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('Module LandingPage') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" type="image/png" />
        <link rel="apple-touch-icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" />
        <link rel="shortcut icon" href="https://smarthr.co.tz/storage/uploads/logo/favicon.png?v={{ time() }}" type="image/png" />

       {{-- Laravel Vite - CSS File --}}
       {{-- {{ module_vite('build-landingpage', 'Resources/assets/sass/app.scss') }} --}}

    </head>
    <body>
        @yield('content')

        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-landingpage', 'Resources/assets/js/app.js') }} --}}
    </body>
</html>
