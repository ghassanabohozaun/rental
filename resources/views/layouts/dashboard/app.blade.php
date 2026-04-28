<!DOCTYPE html>
<html class="loading"
    @if (Config::get('app.locale') == 'ar') lang="ar" data-textdirection="rtl" @else  lang="en" data-textdirection="ltr" @endif>

<head>
    @include('layouts.dashboard.app-parts._head')

    @stack('style')
    @livewireStyles
</head>

<body class="vertical-layout vertical-menu-modern 2-columns  menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns" style="font-family: 'Tajawal', sans-serif;">


    @include('layouts.dashboard.app-parts._header')
    @include('layouts.dashboard.app-parts._sidebar')

    @isset($slot)
        {{ $slot }}
    @else
        @yield('content')
    @endisset

    @include('layouts.dashboard.app-parts._footer')
    @include('layouts.dashboard.app-parts._scripts')

    <script>
        window.LockScreenConfig = {
            lock_route: "{{ route('dashboard.lock.screen') }}",
            idle_limit: 300 // 5 minutes
        };
    </script>
    <script src="{{ asset('assets/dashbaord/js/lock-screen-modern.js') }}"></script>
    <script>
        // Fix for "Blocked aria-hidden on an element because its descendant retained focus" globally
        $(document).on('hide.bs.modal', '.modal', function() {
            if (document.activeElement && $(this).has(document.activeElement).length) {
                document.activeElement.blur();
            }
        });
    </script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
