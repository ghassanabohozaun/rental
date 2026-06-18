<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
    class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMLAK</title>

    <!-- Local Fonts -->
    <link rel="preload" href="{{ asset('assets/dashbaord/fonts/google/Tajawal-400.ttf') }}" as="font" type="font/ttf"
        crossorigin>
    <link rel="preload" href="{{ asset('assets/dashbaord/fonts/google/Tajawal-700.ttf') }}" as="font"
        type="font/ttf" crossorigin>
    <link href="{{ asset('assets/dashbaord/fonts/google/font.css') }}" rel="stylesheet">

    @if (app()->getLocale() == 'ar')
        <style>
            body {
                font-family: 'Tajawal', sans-serif;
            }
        </style>
    @else
        <style>
            body {
                font-family: 'Open Sans', sans-serif;
            }
        </style>
    @endif

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/website.css', 'resources/js/website.js'])
</head>

<body
    class="antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">

    @include('layouts.website.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('layouts.website.footer')

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
