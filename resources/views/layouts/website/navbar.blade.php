<nav class="w-full bg-white/80 dark:bg-slate-950/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200 dark:border-slate-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('website.home') }}" class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400">
                    Amlak.
                </a>
            </div>
            
            <!-- Links (Desktop) -->
            <div class="hidden md:flex space-x-8 rtl:space-x-reverse">
                <a href="#features" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 px-3 py-2 text-sm font-medium transition-colors">{{ __('website.navbar.features') }}</a>
                <a href="#how-it-works" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 px-3 py-2 text-sm font-medium transition-colors">{{ __('website.navbar.how_it_works') }}</a>
                <a href="#pricing" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 px-3 py-2 text-sm font-medium transition-colors">{{ __('website.navbar.pricing') }}</a>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3 md:gap-5">
                <!-- Theme Toggle -->
                <button id="themeToggle" class="text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 p-2 transition">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>

                <!-- Language Toggle -->
                @php
                    $currentLocale = app()->getLocale();
                    $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                    $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
                    $flagPath =
                        $targetLocale == 'ar'
                            ? asset('assets/dashbaord/media/svg/flags/العربية.svg')
                            : asset('assets/dashbaord/media/svg/flags/English.svg');
                @endphp
                <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}" 
                   class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800/50 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors border border-slate-200 dark:border-slate-700/50">
                    <img src="{!! $flagPath !!}" class="w-5 h-5 rounded-full object-cover shadow-sm" alt="{!! $targetNative !!}">
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300 hidden sm:inline-block">{{ $targetNative }}</span>
                </a>

                <!-- CTA -->
                <a href="{{ route('dashboard.index') }}" class="btn-magic px-6 py-2.5 text-sm">
                    {{ __('website.navbar.login_system') }}
                </a>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    // Simple Dark Mode Toggle
    const themeToggleBtn = document.getElementById('themeToggle');
    themeToggleBtn.addEventListener('click', function() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    });

    // Check System Preference or LocalStorage
    if (localStorage.theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
@endpush
