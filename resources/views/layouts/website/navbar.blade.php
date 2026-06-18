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
                <a href="#features" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 px-3 py-2 text-sm font-medium transition-colors">المميزات</a>
                <a href="#how-it-works" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 px-3 py-2 text-sm font-medium transition-colors">آلية العمل</a>
                <a href="#pricing" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 px-3 py-2 text-sm font-medium transition-colors">الأسعار</a>
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
                    $targetLocale = app()->getLocale() == 'ar' ? 'en' : 'ar';
                    $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
                @endphp
                <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 dark:text-slate-300 transition">
                    {{ $targetNative }}
                </a>

                <!-- CTA -->
                <a href="{{ route('dashboard.index') }}" class="btn-magic px-6 py-2.5 text-sm">
                    الدخول للنظام
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
