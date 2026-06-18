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

    <!-- Back to Top Button -->
    <button id="backToTopBtn" 
        class="fixed bottom-8 right-8 rtl:right-auto rtl:left-8 z-50 w-12 h-12 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:shadow-[0_0_25px_rgba(99,102,241,0.6)] hover:-translate-y-1 opacity-0 translate-y-10 pointer-events-none transition-all duration-500 group">
        <i class="fas fa-arrow-up group-hover:animate-bounce"></i>
    </button>

    <!-- Scripts -->
    @stack('scripts')

    <script>
        // Back to Top Button Logic
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopBtn = document.getElementById('backToTopBtn');
            
            if (backToTopBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
                        backToTopBtn.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    } else {
                        backToTopBtn.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
                        backToTopBtn.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    }
                });

                backToTopBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        });
    </script>
</body>

</html>
