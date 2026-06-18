<nav id="mainNav" class="w-full fixed top-0 z-50 transition-all duration-500 bg-transparent border-b border-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="navContainer" class="flex justify-between items-center h-24 transition-all duration-500">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('website.home') }}" class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400 hover:scale-105 transition-transform duration-300 origin-left rtl:origin-right">
                    Amlak.
                </a>
            </div>
            
            <!-- Links (Desktop) - Ultra Premium Glowing Hover -->
            <ul class="hidden md:flex items-center space-x-2 rtl:space-x-reverse">
                <li class="relative group px-4 py-2 cursor-pointer">
                    <a href="#home" class="relative z-10 text-sm font-bold text-slate-500 dark:text-slate-400 transition-colors duration-300 group-hover:text-indigo-600 dark:group-hover:text-white">
                        {{ __('website.navbar.home') }}
                    </a>
                    <div class="absolute inset-0 bg-slate-50 dark:bg-slate-800/50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 scale-95 group-hover:scale-100 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-indigo-500 group-hover:w-3/4 transition-all duration-500 shadow-[0_0_10px_rgba(99,102,241,0.8)] opacity-0 group-hover:opacity-100 rounded-full"></div>
                </li>
                
                <li class="relative group px-4 py-2 cursor-pointer">
                    <a href="#features" class="relative z-10 text-sm font-bold text-slate-500 dark:text-slate-400 transition-colors duration-300 group-hover:text-indigo-600 dark:group-hover:text-white">
                        {{ __('website.navbar.features') }}
                    </a>
                    <!-- Soft Background Highlight -->
                    <div class="absolute inset-0 bg-slate-50 dark:bg-slate-800/50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 scale-95 group-hover:scale-100 pointer-events-none"></div>
                    <!-- Glowing Bottom Line expanding from center -->
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-indigo-500 group-hover:w-3/4 transition-all duration-500 shadow-[0_0_10px_rgba(99,102,241,0.8)] opacity-0 group-hover:opacity-100 rounded-full"></div>
                </li>
                
                <li class="relative group px-4 py-2 cursor-pointer">
                    <a href="#how-it-works" class="relative z-10 text-sm font-bold text-slate-500 dark:text-slate-400 transition-colors duration-300 group-hover:text-indigo-600 dark:group-hover:text-white">
                        {{ __('website.navbar.how_it_works') }}
                    </a>
                    <div class="absolute inset-0 bg-slate-50 dark:bg-slate-800/50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 scale-95 group-hover:scale-100 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-indigo-500 group-hover:w-3/4 transition-all duration-500 shadow-[0_0_10px_rgba(99,102,241,0.8)] opacity-0 group-hover:opacity-100 rounded-full"></div>
                </li>
                
                <li class="relative group px-4 py-2 cursor-pointer">
                    <a href="#pricing" class="relative z-10 text-sm font-bold text-slate-500 dark:text-slate-400 transition-colors duration-300 group-hover:text-indigo-600 dark:group-hover:text-white">
                        {{ __('website.navbar.pricing') }}
                    </a>
                    <div class="absolute inset-0 bg-slate-50 dark:bg-slate-800/50 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 scale-95 group-hover:scale-100 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-indigo-500 group-hover:w-3/4 transition-all duration-500 shadow-[0_0_10px_rgba(99,102,241,0.8)] opacity-0 group-hover:opacity-100 rounded-full"></div>
                </li>
            </ul>

            <!-- Actions -->
            <div class="flex items-center gap-3 md:gap-5">
                <!-- Theme Toggle -->
                <button id="themeToggle" class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-indigo-400 dark:hover:bg-slate-800 transition-all duration-300 border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
                    <i class="fas fa-moon dark:hidden text-lg"></i>
                    <i class="fas fa-sun hidden dark:block text-lg"></i>
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
                   class="group flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 hover:bg-white dark:hover:bg-slate-800 transition-all duration-300 border border-slate-200/50 dark:border-slate-700/50 hover:border-indigo-200 dark:hover:border-indigo-500/30 hover:shadow-[0_0_15px_rgba(99,102,241,0.1)]">
                    <img src="{!! $flagPath !!}" class="w-5 h-5 rounded-full object-cover shadow-sm group-hover:scale-110 transition-transform duration-300" alt="{!! $targetNative !!}">
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300 hidden sm:inline-block transition-colors group-hover:text-indigo-600 dark:group-hover:text-indigo-400">{{ $targetNative }}</span>
                </a>

                <!-- CTA -->
                <a href="{{ route('dashboard.index') }}" class="relative group hidden sm:inline-flex items-center justify-center px-6 py-2.5 rounded-xl font-bold text-sm text-white overflow-hidden transition-all duration-300 shadow-[0_0_20px_rgba(99,102,241,0.3)] hover:shadow-[0_0_25px_rgba(99,102,241,0.5)] hover:-translate-y-0.5">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-indigo-600 to-violet-600"></div>
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-violet-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <span class="relative z-10">{{ __('website.navbar.login_system') }}</span>
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

    // Navbar Scroll Motion
    const mainNav = document.getElementById('mainNav');
    const navContainer = document.getElementById('navContainer');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            mainNav.classList.remove('bg-transparent', 'border-transparent');
            mainNav.classList.add('bg-white/80', 'dark:bg-slate-950/80', 'backdrop-blur-xl', 'border-slate-200/50', 'dark:border-slate-800/50', 'shadow-sm');
            navContainer.classList.remove('h-24');
            navContainer.classList.add('h-16');
        } else {
            mainNav.classList.add('bg-transparent', 'border-transparent');
            mainNav.classList.remove('bg-white/80', 'dark:bg-slate-950/80', 'backdrop-blur-xl', 'border-slate-200/50', 'dark:border-slate-800/50', 'shadow-sm');
            navContainer.classList.remove('h-16');
            navContainer.classList.add('h-24');
        }
    });
</script>
@endpush
