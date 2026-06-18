@extends('layouts.website.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-24 pb-32 overflow-hidden perspective-container">
        <!-- Glow Elements (Blobs) -->
        <div
            class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-400/30 dark:bg-indigo-500/20 blur-[120px] rounded-full mix-blend-multiply dark:mix-blend-screen animate-blob pointer-events-none">
        </div>
        <div
            class="absolute top-1/3 right-1/4 w-96 h-96 bg-violet-400/30 dark:bg-violet-500/20 blur-[120px] rounded-full mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000 pointer-events-none">
        </div>
        <div
            class="absolute -bottom-32 left-1/2 w-96 h-96 bg-fuchsia-400/30 dark:bg-fuchsia-500/20 blur-[120px] rounded-full mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-4000 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 text-sm font-semibold mb-8 border border-indigo-100 dark:border-indigo-800 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    الإصدار 2.0 متاح الآن
                </div>

                <h1
                    class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 text-slate-900 dark:text-white leading-tight drop-shadow-sm">
                    إدارة الأملاك والعقود<br>
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-500 dark:from-indigo-400 dark:to-violet-400">بذكاء
                        لا محدود.</span>
                </h1>

                <p class="text-xl md:text-2xl text-slate-600 dark:text-slate-300 mb-10 leading-relaxed font-light">
                    أتمتة كاملة لدورة حياة العقود، تتبع دقيق للشيكات، ونظام إشعارات استباقي يضمن لك عدم تفويت أي استحقاق
                    مالي أبداً.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('dashboard.index') }}" class="btn-magic text-lg px-8 py-4">
                        ابدأ الآن مجاناً <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                    <a href="#features" class="btn-magic text-lg px-8 py-4" style="--tw-bg-opacity: 0.1; background-color: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: inherit;">
                        تصفح المميزات
                    </a>
                </div>
            </div>

            <!-- Isometric 3D Dashboard Mockup -->
            <div class="relative mx-auto max-w-5xl mt-24 animate-float perspective-container z-20" dir="ltr">
                <div
                    class="isometric-card bg-white dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200/50 dark:border-slate-700/50 shadow-2xl relative">

                    <!-- Mac Header -->
                    <div
                        class="bg-slate-100/80 dark:bg-slate-800/80 backdrop-blur px-4 py-3 flex items-center gap-2 border-b border-slate-200/50 dark:border-slate-700/50">
                        <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    </div>

                    <!-- Mockup Body -->
                    <div class="flex h-[400px] md:h-[500px]">
                        <!-- Sidebar -->
                        <div
                            class="hidden md:flex w-64 bg-slate-50 dark:bg-slate-800/50 border-r border-slate-200/50 dark:border-slate-700/50 flex-col p-4 gap-4">
                            <div class="w-32 h-8 bg-slate-200 dark:bg-slate-700 rounded-lg mb-4"></div>
                            <div
                                class="w-full h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg border border-indigo-200 dark:border-indigo-800/50">
                            </div>
                            <div class="w-full h-10 bg-slate-200 dark:bg-slate-700 rounded-lg opacity-50"></div>
                            <div class="w-full h-10 bg-slate-200 dark:bg-slate-700 rounded-lg opacity-50"></div>
                            <div class="w-full h-10 bg-slate-200 dark:bg-slate-700 rounded-lg opacity-50"></div>
                        </div>

                        <!-- Main Content -->
                        <div class="flex-1 p-6 bg-slate-50/50 dark:bg-slate-900/50 overflow-hidden relative">
                            <!-- Top stats -->
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <div
                                    class="h-24 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-4">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/50 mb-2"></div>
                                    <div class="w-16 h-4 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                </div>
                                <div
                                    class="h-24 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-4">
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 mb-2"></div>
                                    <div class="w-16 h-4 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                </div>
                                <div
                                    class="h-24 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-4">
                                    <div class="w-10 h-10 rounded-full bg-rose-100 dark:bg-rose-900/50 mb-2"></div>
                                    <div class="w-16 h-4 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                </div>
                            </div>

                            <!-- Chart Area -->
                            <div
                                class="h-64 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 flex items-end gap-2">
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 40%"></div>
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 60%"></div>
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 30%"></div>
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 80%"></div>
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 50%"></div>
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 90%"></div>
                                <div class="w-full bg-indigo-500/80 rounded-t-sm" style="height: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Glass Card 1 (Notification) -->
                <div class="absolute -right-8 top-10 md:top-20 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-4 rounded-2xl shadow-2xl border border-white/50 dark:border-slate-600/50 animate-float-delayed z-30"
                    dir="rtl">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">تم تحصيل شيك بقيمة 15,000</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">عقد إيجار #1042 - منذ دقيقتين</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Glass Card 2 (Alert) -->
                <div class="absolute -left-6 bottom-20 md:bottom-32 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-4 rounded-2xl shadow-2xl border border-white/50 dark:border-slate-600/50 animate-float-fast z-30"
                    dir="rtl">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-rose-400 to-rose-600 flex items-center justify-center text-white shadow-lg shadow-rose-500/30">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">عقد شارف على الانتهاء</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">متبقي 60 يوم للتجديد</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Magical Sticky Stacking Features Section -->
    <section id="features" class="relative bg-slate-50 dark:bg-slate-950 pt-32 pb-48">
        <!-- Floating Magic Backgrounds (Sticky so they stay in view while scrolling the section) -->
        <div class="sticky top-0 h-screen w-full overflow-hidden pointer-events-none z-0 -mb-[100vh]">
            <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-indigo-500/20 blur-[150px] rounded-full mix-blend-screen animate-blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-fuchsia-500/20 blur-[150px] rounded-full mix-blend-screen animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-24">
                <h2 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white mb-6 tracking-tight drop-shadow-lg">سحر الإدارة الحقيقية</h2>
                <p class="text-2xl text-slate-600 dark:text-slate-300 font-light">مرر للأسفل واكتشف كيف يتغير كل شيء.</p>
            </div>

            <!-- Sticky Card 1 -->
            <div class="sticky top-32 mx-auto max-w-4xl w-full transition-all duration-500 hover:scale-[1.02] shadow-2xl rounded-[3rem] bg-white/70 dark:bg-slate-900/70 backdrop-blur-3xl border border-white/50 dark:border-slate-700/50 p-12 overflow-hidden mb-[30vh] z-10 group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1">
                        <div class="w-20 h-20 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-3xl flex items-center justify-center text-4xl mb-8 shadow-inner transform group-hover:rotate-6 transition-all duration-500">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-4">عقود تدير نفسها</h3>
                        <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed font-light">تنسى تواريخ الانتهاء؟ النظام لن ينسى. بمجرد إدخال العقد، سيبدأ النظام بمراقبته وتنبيهك تلقائياً قبل 60 يوماً من انتهائه.</p>
                    </div>
                    <div class="w-full md:w-1/3 aspect-square bg-gradient-to-br from-indigo-500 to-violet-600 rounded-3xl p-6 shadow-xl transform group-hover:-translate-y-4 transition-all duration-500 relative">
                        <div class="w-full h-8 bg-white/20 rounded-full mb-4"></div>
                        <div class="w-3/4 h-4 bg-white/20 rounded-full mb-2"></div>
                        <div class="w-1/2 h-4 bg-white/20 rounded-full"></div>
                        <div class="absolute bottom-6 left-6 right-6 p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20">
                            <div class="text-white text-sm font-bold"><i class="fas fa-bell mr-2"></i>ينتهي قريباً</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Card 2 -->
            <div class="sticky top-[calc(8rem+15px)] mx-auto max-w-4xl w-full transition-all duration-500 hover:scale-[1.02] shadow-2xl rounded-[3rem] bg-slate-50 dark:bg-slate-800 backdrop-blur-3xl border border-white/50 dark:border-slate-700/50 p-12 overflow-hidden mb-[30vh] z-20 group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-10">
                    <div class="w-full md:w-1/3 order-2 md:order-1 aspect-square bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-6 shadow-xl transform group-hover:-translate-y-4 transition-all duration-500 relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
                        <div class="h-full flex items-center justify-center">
                            <i class="fas fa-money-check-alt text-6xl text-white opacity-80 group-hover:scale-125 transition-transform duration-700"></i>
                        </div>
                    </div>
                    <div class="flex-1 order-1 md:order-2">
                        <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 rounded-3xl flex items-center justify-center text-4xl mb-8 shadow-inner transform group-hover:-rotate-6 transition-all duration-500">
                            <i class="fas fa-money-check"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-4">شيكاتك في أمان تام</h3>
                        <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed font-light">لا مزيد من الشيكات المنسية أو المرتجعة. تتبع بصري مبهر لحالات الشيكات (معلق، محصل، مرتجع) مع تنبيهات استباقية صارمة.</p>
                    </div>
                </div>
            </div>

            <!-- Sticky Card 3 -->
            <div class="sticky top-[calc(8rem+30px)] mx-auto max-w-4xl w-full transition-all duration-500 hover:scale-[1.02] shadow-2xl rounded-[3rem] bg-indigo-900/90 dark:bg-black/80 backdrop-blur-3xl border border-indigo-700/50 p-12 overflow-hidden mb-[30vh] z-30 group">
                <div class="absolute inset-0 bg-gradient-to-br from-rose-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1">
                        <div class="w-20 h-20 bg-rose-500/20 text-rose-500 rounded-3xl flex items-center justify-center text-4xl mb-8 shadow-inner transform group-hover:scale-110 transition-all duration-500">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-4">عزل وحماية سيبرانية</h3>
                        <p class="text-xl text-indigo-200 leading-relaxed font-light">قاعدة بياناتك معزولة كلياً (Multi-Tenancy). وشاشتك تقفل تلقائياً عند ترك المكتب لضمان سرية أرقامك المالية أمام الجميع.</p>
                    </div>
                    <div class="w-full md:w-1/3 aspect-square bg-slate-900 rounded-3xl p-6 shadow-inner border border-slate-700 transform group-hover:rotate-3 transition-all duration-500 relative flex items-center justify-center">
                        <div class="text-rose-500 text-6xl group-hover:animate-pulse">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Card 4: Notifications -->
            <div class="sticky top-[calc(8rem+45px)] mx-auto max-w-4xl w-full transition-all duration-500 hover:scale-[1.02] shadow-2xl rounded-[3rem] bg-violet-900/90 dark:bg-indigo-950/90 backdrop-blur-3xl border border-violet-500/30 p-12 overflow-hidden mb-[30vh] z-40 group">
                <div class="absolute inset-0 bg-gradient-to-br from-violet-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/5 blur-[40px] rounded-full group-hover:scale-150 transition-all duration-700"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-10">
                    <div class="w-full md:w-1/3 order-2 md:order-1 aspect-square bg-gradient-to-br from-indigo-500 to-violet-700 rounded-3xl p-6 shadow-xl transform group-hover:-translate-y-4 transition-all duration-500 relative flex items-center justify-center">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-5xl text-white shadow-2xl">
                            <i class="fas fa-bell animate-bounce" style="animation-duration: 3s;"></i>
                        </div>
                    </div>
                    <div class="flex-1 order-1 md:order-2">
                        <div class="w-20 h-20 bg-white/10 text-white rounded-3xl flex items-center justify-center text-4xl mb-8 shadow-inner transform group-hover:-translate-y-2 transition-all duration-500">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-4">إشعارات ذكية استباقية</h3>
                        <p class="text-xl text-indigo-200 leading-relaxed font-light">تخلص من المفكرات المزدحمة. مركز إشعارات ذكي يرصد تواريخ الاستحقاق والتجديد ويوصلها إلى متصفحك مباشرة لتعمل براحة بال مطلقة.</p>
                    </div>
                </div>
            </div>

            <!-- Sticky Card 5: Dashboard & Analytics -->
            <div class="sticky top-[calc(8rem+60px)] mx-auto max-w-4xl w-full transition-all duration-500 hover:scale-[1.02] shadow-2xl rounded-[3rem] bg-white/90 dark:bg-slate-900/90 backdrop-blur-3xl border border-white/50 dark:border-slate-700/50 p-12 overflow-hidden z-50 group">
                <div class="absolute inset-0 bg-gradient-to-br from-sky-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1">
                        <div class="w-20 h-20 bg-sky-100 dark:bg-sky-900/50 text-sky-600 dark:text-sky-400 rounded-3xl flex items-center justify-center text-4xl mb-8 shadow-inner transform group-hover:scale-110 transition-all duration-500">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-4">إحصائيات ترسم المستقبل</h3>
                        <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed font-light">لوحة تحكم (Dashboard) بانورامية تضع كل الأرقام بين يديك. راقب أرباحك، نسبة التحصيل، وحالة عقاراتك من شاشة واحدة مصممة بعناية فائقة.</p>
                    </div>
                    <div class="w-full md:w-1/3 aspect-square bg-slate-50 dark:bg-slate-800 rounded-3xl p-6 shadow-xl border border-slate-200 dark:border-slate-700 relative overflow-hidden flex items-end gap-2">
                        <div class="w-full bg-sky-400 rounded-t-lg h-[30%] group-hover:h-[60%] transition-all duration-1000"></div>
                        <div class="w-full bg-sky-500 rounded-t-lg h-[60%] group-hover:h-[90%] transition-all duration-1000 delay-100"></div>
                        <div class="w-full bg-indigo-500 rounded-t-lg h-[40%] group-hover:h-[70%] transition-all duration-1000 delay-200"></div>
                        <div class="w-full bg-indigo-600 rounded-t-lg h-[80%] group-hover:h-[50%] transition-all duration-1000 delay-300"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Ultra Premium How It Works Section -->
    <section id="how-it-works" class="py-32 relative bg-[#0a0f1c] overflow-hidden border-y border-white/5">
        <!-- Deep Space Background Grid -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0a0f1c] via-transparent to-[#0a0f1c] z-0"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24 relative">
                <!-- Glowing accent behind title -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-32 bg-indigo-500/30 blur-[80px] rounded-full pointer-events-none"></div>
                <h2 class="text-sm font-bold text-indigo-400 tracking-[0.2em] uppercase mb-4">آلية العمل الذكية</h2>
                <h3 class="text-5xl md:text-6xl font-black text-white mb-6 drop-shadow-2xl">ثلاث خطوات للتحكم المطلق</h3>
                <p class="text-lg text-slate-400 font-light">مسار هندسي دقيق ينقلك من الفوضى إلى الأتمتة الكاملة.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 relative">
                <!-- Connecting Laser Line (Desktop only) -->
                <div class="hidden md:block absolute top-24 left-[15%] right-[15%] h-[2px] bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent z-0">
                    <div class="absolute top-0 bottom-0 left-0 w-1/3 bg-gradient-to-r from-transparent via-white to-transparent animate-flow-horizontal shadow-[0_0_10px_white]"></div>
                </div>

                <!-- Step 1 -->
                <div class="relative group z-10 cursor-pointer">
                    <!-- Glowing Base Shadow -->
                    <div class="absolute -inset-4 bg-gradient-to-b from-indigo-600 to-purple-600 rounded-[2.5rem] blur-2xl opacity-0 group-hover:opacity-40 transition duration-700"></div>
                    
                    <!-- 3D Glass Card -->
                    <div class="relative h-full bg-[#111827]/90 backdrop-blur-3xl border border-white/10 p-10 rounded-[2rem] transform transition-all duration-700 group-hover:-translate-y-4 group-hover:border-indigo-500/50 shadow-2xl overflow-hidden flex flex-col items-center text-center">
                        <!-- Huge Watermark Number -->
                        <span class="absolute -bottom-10 -left-10 text-[14rem] font-black text-white/[0.02] leading-none pointer-events-none transition-transform duration-700 group-hover:scale-110">1</span>
                        
                        <!-- Floating Icon -->
                        <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-4xl text-white mb-10 shadow-[0_0_40px_rgba(99,102,241,0.5)] transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-[2rem] bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                            <i class="fas fa-building"></i>
                        </div>

                        <div class="relative z-10">
                            <h4 class="text-3xl font-bold text-white mb-4">تأسيس محفظتك</h4>
                            <p class="text-lg text-slate-400 leading-relaxed font-light">أضف عقاراتك، وحداتك، ومستأجريك لإنشاء قاعدة بيانات مشفرة ومعزولة كلياً.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative group z-10 mt-8 md:mt-0 cursor-pointer">
                    <!-- Glowing Base Shadow -->
                    <div class="absolute -inset-4 bg-gradient-to-b from-violet-600 to-fuchsia-600 rounded-[2.5rem] blur-2xl opacity-0 group-hover:opacity-40 transition duration-700"></div>
                    
                    <!-- 3D Glass Card -->
                    <div class="relative h-full bg-[#111827]/90 backdrop-blur-3xl border border-white/10 p-10 rounded-[2rem] transform transition-all duration-700 group-hover:-translate-y-4 group-hover:border-violet-500/50 shadow-2xl overflow-hidden flex flex-col items-center text-center">
                        <!-- Huge Watermark Number -->
                        <span class="absolute -bottom-10 -left-10 text-[14rem] font-black text-white/[0.02] leading-none pointer-events-none transition-transform duration-700 group-hover:scale-110">2</span>
                        
                        <!-- Floating Icon -->
                        <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-violet-500 to-fuchsia-600 flex items-center justify-center text-4xl text-white mb-10 shadow-[0_0_40px_rgba(139,92,246,0.5)] transform group-hover:scale-110 transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-[2rem] bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                            <i class="fas fa-file-signature"></i>
                        </div>

                        <div class="relative z-10">
                            <h4 class="text-3xl font-bold text-white mb-4">توثيق العقود</h4>
                            <p class="text-lg text-slate-400 leading-relaxed font-light">نقرة واحدة تصدر عقداً، وتربطه آلياً بشيكات مجدولة تصب في خزينتك بدقة متناهية.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative group z-10 mt-8 md:mt-0 cursor-pointer">
                    <!-- Glowing Base Shadow -->
                    <div class="absolute -inset-4 bg-gradient-to-b from-emerald-600 to-teal-600 rounded-[2.5rem] blur-2xl opacity-0 group-hover:opacity-40 transition duration-700"></div>
                    
                    <!-- 3D Glass Card -->
                    <div class="relative h-full bg-[#111827]/90 backdrop-blur-3xl border border-white/10 p-10 rounded-[2rem] transform transition-all duration-700 group-hover:-translate-y-4 group-hover:border-emerald-500/50 shadow-2xl overflow-hidden flex flex-col items-center text-center">
                        <!-- Huge Watermark Number -->
                        <span class="absolute -bottom-10 -left-10 text-[14rem] font-black text-white/[0.02] leading-none pointer-events-none transition-transform duration-700 group-hover:scale-110">3</span>
                        
                        <!-- Floating Icon -->
                        <div class="w-24 h-24 rounded-[2rem] bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-4xl text-white mb-10 shadow-[0_0_40px_rgba(16,185,129,0.5)] transform group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500 relative">
                            <div class="absolute inset-0 rounded-[2rem] bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                            <i class="fas fa-satellite-dish"></i>
                        </div>

                        <div class="relative z-10">
                            <h4 class="text-3xl font-bold text-white mb-4">الطيار الآلي</h4>
                            <p class="text-lg text-slate-400 leading-relaxed font-light">استرخِ تماماً! النظام يعمل عنك، يراقب وينبهك استباقياً قبل مواعيد الاستحقاق.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Ultra Premium Pricing Section (Dual Cards) -->
    <section id="pricing" class="py-32 relative bg-slate-50 dark:bg-slate-950 overflow-hidden">
        <!-- Abstract Background Mesh -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] dark:opacity-[0.05] mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-300/20 dark:bg-indigo-900/20 rounded-full blur-[120px] pointer-events-none translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-violet-300/20 dark:bg-violet-900/20 rounded-full blur-[120px] pointer-events-none -translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-sm font-bold mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    الاستثمار الذكي
                </div>
                <h2 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white mb-6 tracking-tight">خطط تنمو مع <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600 dark:from-indigo-400 dark:to-violet-400">طموحك</span></h2>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 font-light leading-relaxed">أدوات متكاملة لإدارة أملاكك بفعالية. اختر الخطة التي تناسب حجم أعمالك اليوم.</p>
            </div>

            <!-- Pricing Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto items-center">
                
                <!-- Basic Plan Card (Light Aesthetic) -->
                <div class="relative bg-white dark:bg-slate-900 rounded-[2.5rem] p-10 md:p-12 shadow-2xl shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-slate-800 transition-transform duration-500 hover:-translate-y-2 flex flex-col h-full z-10">
                    
                    <div class="mb-8">
                        <div class="inline-block px-4 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-bold mb-6 border border-slate-200 dark:border-slate-700">
                            الخطة الأساسية
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-4">تواصل معنا</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm md:text-base leading-relaxed">الخيار الأمثل للمكاتب العقارية الصغيرة والناشئة. ابدأ رحلة الأتمتة بقوة وثبات.</p>
                    </div>

                    <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-200 dark:via-slate-800 to-transparent mb-8"></div>

                    <ul class="space-y-6 mb-12 flex-1">
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mt-1">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white">إدارة 50 عقار</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">أضف حتى 50 عقار أو وحدة سكنية بكل سهولة</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mt-1">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white">أتمتة العقود والشيكات</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">إنشاء وتتبع العقود والشيكات بشكل أساسي</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mt-1">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white">إشعارات النظام</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">تنبيهات مدمجة لانتهاء العقود ومواعيد السداد</p>
                            </div>
                        </li>
                    </ul>

                    <a href="#" class="btn-magic relative z-10 block w-full py-4 text-center rounded-2xl !bg-slate-900 dark:!bg-indigo-600 !text-white text-lg font-bold mt-auto shadow-xl shadow-slate-900/20 dark:shadow-indigo-900/30 overflow-hidden group">
                        اطلب عرض سعر <i class="fas fa-arrow-left mr-2 opacity-70 group-hover:-translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Enterprise Plan Card (Dark Premium Aesthetic) -->
                <div class="relative bg-slate-900 dark:bg-slate-900/80 rounded-[2.5rem] p-10 md:p-12 shadow-2xl shadow-indigo-900/20 border border-indigo-500/30 transition-transform duration-500 hover:-translate-y-2 flex flex-col h-full z-20 lg:-mr-8 overflow-hidden backdrop-blur-xl">
                    
                    <!-- Premium Glow Effects -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/20 blur-[80px] pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-violet-500/20 blur-[80px] pointer-events-none"></div>
                    
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-50"></div>

                    <div class="mb-8 relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/20 text-indigo-300 text-sm font-bold border border-indigo-500/30">
                                <i class="fas fa-crown text-amber-400 mr-1"></i> خطة الشركات
                            </div>
                            <span class="px-3 py-1 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-bold rounded-full shadow-lg">
                                الأكثر طلباً
                            </span>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-4 drop-shadow-md">حسب التقييم</h3>
                        <p class="text-slate-400 text-sm md:text-base leading-relaxed">القوة القصوى. مصممة للشركات العقارية الكبرى والمجمعات السكنية الضخمة التي تتطلب تحكماً كاملاً.</p>
                    </div>

                    <div class="w-full h-px bg-gradient-to-r from-transparent via-slate-700 to-transparent mb-8 relative z-10"></div>

                    <ul class="space-y-6 mb-12 flex-1 relative z-10">
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30 mt-1 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <i class="fas fa-infinity"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white">غير محدود</p>
                                <p class="text-sm text-slate-400 mt-1">عدد لا نهائي من العقارات، الوحدات، والعقود</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30 mt-1 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white">عزل وحماية قصوى</p>
                                <p class="text-sm text-slate-400 mt-1">قواعد بيانات معزولة تماماً مع حماية بمستوى بنكي</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30 mt-1 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white">تنبيهات SMS وبريد</p>
                                <p class="text-sm text-slate-400 mt-1">رسائل نصية مخصصة للمستأجرين وإشعارات بريدية</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-indigo-400 border border-indigo-500/30 mt-1 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div>
                                <p class="font-bold text-white">دعم VIP</p>
                                <p class="text-sm text-slate-400 mt-1">دعم فني مخصص ومهندس حسابات متاح 24/7</p>
                            </div>
                        </li>
                    </ul>

                    <a href="#" class="btn-magic relative z-10 block w-full py-4 text-center rounded-2xl !bg-indigo-600 hover:!bg-indigo-500 !text-white text-lg font-bold mt-auto shadow-xl shadow-indigo-600/40 border border-indigo-500 overflow-hidden group">
                        احجز نسختك الآن <i class="fas fa-rocket mr-2 text-amber-400 group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Ultimate Creative CTA (Animated Pattern & Heavy Motion) -->
    <section class="py-24 relative overflow-hidden bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- The Massive Animated Card -->
            <div class="relative rounded-[3rem] overflow-hidden p-12 md:p-24 shadow-2xl shadow-indigo-500/30 group">
                
                <!-- Dynamic Gradient Background -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-indigo-600 to-fuchsia-600 animate-bg-pan"></div>
                
                <!-- SVG Geometric Pattern Overlay -->
                <div class="absolute inset-0 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); opacity: 0.25;"></div>
                
                <!-- Floating Ambient Orbs (Motion) -->
                <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-white/20 rounded-full blur-[80px] animate-float-slow pointer-events-none"></div>
                <div class="absolute bottom-[-20%] left-[-10%] w-[600px] h-[600px] bg-pink-500/30 rounded-full blur-[100px] animate-float-fast pointer-events-none"></div>

                <!-- Floating 3D Elements (Motion) -->
                <div class="hidden md:flex absolute top-16 right-16 w-24 h-24 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl items-center justify-center animate-float-slow shadow-2xl rotate-12 pointer-events-none">
                    <i class="fas fa-chart-line text-4xl text-white drop-shadow-md"></i>
                </div>
                <div class="hidden md:flex absolute bottom-20 left-16 w-28 h-28 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full items-center justify-center animate-float-fast shadow-2xl -rotate-12 pointer-events-none">
                    <i class="fas fa-building text-5xl text-fuchsia-300 drop-shadow-md"></i>
                </div>
                
                <!-- Abstract rotating ring -->
                <div class="absolute top-1/2 left-1/2 w-[800px] h-[800px] -translate-x-1/2 -translate-y-1/2 border-[2px] border-white/5 rounded-full animate-spin-slow border-dashed pointer-events-none"></div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    
                    <!-- Pulsing Badge -->
                    <div class="inline-flex items-center gap-3 px-6 py-2.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-md text-white font-bold mb-10 shadow-lg hover:scale-110 transition-transform duration-300 cursor-default">
                        <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-400"></span>
                        </span>
                        أكثر من 50,000 وحدة تُدار عبر أملاك
                    </div>

                    <!-- Headline with typing/reveal effect logic (simulated with CSS) -->
                    <h2 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tight leading-[1.2] drop-shadow-lg relative inline-block">
                        ارتقِ بأعمالك العقارية <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-white animate-pulse">نحو المستقبل</span>
                    </h2>

                    <p class="text-xl md:text-2xl text-indigo-50 font-light mb-16 max-w-3xl mx-auto leading-relaxed drop-shadow-md">
                        أملاك هي الأداة التي صُممت خصيصاً لتفهم احتياجاتك. حان الوقت لتترك العمل اليدوي وتبدأ رحلة الأتمتة الكاملة.
                    </p>

                    <!-- Crazy Creative Interactive Button -->
                    <div class="flex justify-center w-full relative">
                        <!-- Ripple effect behind button -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-white/30 rounded-full blur-xl animate-ping" style="animation-duration: 3s;"></div>
                        
                        <a href="{{ route('dashboard.index') }}" class="group relative inline-flex items-center justify-center z-10">
                            <!-- Button Body -->
                            <div class="relative flex items-center gap-6 px-4 py-4 bg-white/95 backdrop-blur-xl rounded-full leading-none overflow-hidden transition-all duration-500 hover:shadow-[0_0_50px_rgba(255,255,255,0.6)] hover:scale-[1.03]">
                                
                                <!-- Shine Sweep -->
                                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-indigo-600/10 to-transparent group-hover:animate-[shimmer_1s_infinite]"></div>
                                
                                <!-- Text -->
                                <span class="text-2xl font-black text-indigo-800 relative z-10 pl-8 pr-8 transition-colors group-hover:text-fuchsia-600">
                                    انطلق مجاناً الآن
                                </span>
                                
                                <!-- Bouncing Icon Circle -->
                                <div class="relative z-10 w-16 h-16 bg-gradient-to-br from-indigo-600 to-fuchsia-600 rounded-full flex items-center justify-center shadow-lg transition-all duration-500 group-hover:rotate-[360deg] group-hover:scale-110">
                                    <i class="fas fa-space-shuttle text-white text-2xl drop-shadow-md"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Bottom trust indicators with float -->
                    <div class="mt-14 flex flex-wrap justify-center items-center gap-8 text-white/90 text-sm md:text-base font-bold drop-shadow-md">
                        <span class="flex items-center gap-2 hover:-translate-y-1 transition-transform cursor-default"><i class="fas fa-check-circle text-emerald-400 text-xl"></i> تفعيل فوري</span>
                        <span class="flex items-center gap-2 hover:-translate-y-1 transition-transform cursor-default"><i class="fas fa-check-circle text-emerald-400 text-xl"></i> حماية بنكية للبيانات</span>
                        <span class="flex items-center gap-2 hover:-translate-y-1 transition-transform cursor-default"><i class="fas fa-check-circle text-emerald-400 text-xl"></i> دعم فني مخصص</span>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Ultimate Partners Section (Infinite Marquee) -->
    <section class="py-20 bg-slate-100 dark:bg-slate-900 relative overflow-hidden border-t border-slate-200 dark:border-slate-800">
        <!-- Soft top glow to connect with CTA -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-32 bg-indigo-500/5 blur-[100px]"></div>

        <div class="max-w-7xl mx-auto px-4 text-center mb-16 relative z-10">
            <h3 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-slate-100 mb-4">
                نفتخر بشراكتنا مع أكثر من <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-fuchsia-500">50 شركة عقارية</span> رائدة
            </h3>
            <p class="text-lg text-slate-500 dark:text-slate-400">انضم إلى النخبة الذين اختاروا أتمتة أعمالهم والارتقاء بها</p>
        </div>

        <!-- Infinite Scrolling Marquee Container -->
        <!-- We use dir="ltr" to ensure the CSS translateX animation moves uniformly -->
        <div class="relative w-full overflow-hidden flex" dir="ltr">
            <!-- Left/Right Fade Masks for premium look -->
            <div class="absolute top-0 left-0 w-40 h-full bg-gradient-to-r from-slate-100 dark:from-slate-900 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute top-0 right-0 w-40 h-full bg-gradient-to-l from-slate-100 dark:from-slate-900 to-transparent z-10 pointer-events-none"></div>

            <!-- The Scrolling Track -->
            <div class="animate-marquee flex items-center gap-6 pl-6 py-6">
                <!-- Group 1 -->
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-indigo-300 dark:hover:border-indigo-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-building text-3xl text-indigo-400 group-hover:text-indigo-600 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Emaar</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 dark:hover:border-emerald-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-city text-3xl text-emerald-400 group-hover:text-emerald-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Damac</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-fuchsia-300 dark:hover:border-fuchsia-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-home text-3xl text-fuchsia-400 group-hover:text-fuchsia-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Dar Alarkan</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-hotel text-3xl text-blue-400 group-hover:text-blue-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Nakheel</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-orange-300 dark:hover:border-orange-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-landmark text-3xl text-orange-400 group-hover:text-orange-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Retal</span>
                </div>

                <!-- Group 2 (Duplicate for seamless infinite loop) -->
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-indigo-300 dark:hover:border-indigo-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-building text-3xl text-indigo-400 group-hover:text-indigo-600 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Emaar</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-emerald-300 dark:hover:border-emerald-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-city text-3xl text-emerald-400 group-hover:text-emerald-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Damac</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-fuchsia-300 dark:hover:border-fuchsia-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-home text-3xl text-fuchsia-400 group-hover:text-fuchsia-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Dar Alarkan</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-hotel text-3xl text-blue-400 group-hover:text-blue-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Nakheel</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-orange-300 dark:hover:border-orange-500/50 transition-all duration-300 group cursor-pointer">
                    <i class="fas fa-landmark text-3xl text-orange-400 group-hover:text-orange-500 transition-colors mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 group-hover:text-slate-900 dark:group-hover:text-white transition-colors tracking-wide">Retal</span>
                </div>
            </div>
            
            <!-- A third duplicate just to ensure ultra-wide screens don't see gaps -->
            <div class="animate-marquee flex items-center gap-6 pl-6 py-6" aria-hidden="true">
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm transition-all duration-300 group">
                    <i class="fas fa-building text-3xl text-indigo-400 mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 tracking-wide">Emaar</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm transition-all duration-300 group">
                    <i class="fas fa-city text-3xl text-emerald-400 mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 tracking-wide">Damac</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm transition-all duration-300 group">
                    <i class="fas fa-home text-3xl text-fuchsia-400 mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 tracking-wide">Dar Alarkan</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm transition-all duration-300 group">
                    <i class="fas fa-hotel text-3xl text-blue-400 mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 tracking-wide">Nakheel</span>
                </div>
                <div class="flex items-center justify-center min-w-[280px] h-[90px] px-8 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm transition-all duration-300 group">
                    <i class="fas fa-landmark text-3xl text-orange-400 mr-4"></i>
                    <span class="text-2xl font-black text-slate-700 dark:text-slate-200 tracking-wide">Retal</span>
                </div>
            </div>
        </div>
    </section>
@endsection
