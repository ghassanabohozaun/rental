<footer class="relative bg-slate-950 text-slate-300 overflow-hidden pt-24 pb-12 border-t border-slate-900 mt-20">
    <!-- Huge background watermark -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[15rem] md:text-[25rem] font-black text-white/[0.02] whitespace-nowrap pointer-events-none select-none">
        AMLAK
    </div>
    
    <!-- Background pattern -->
    <div class="absolute inset-0 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); opacity: 0.1;"></div>

    <!-- Soft top glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-40 bg-indigo-500/10 blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Top CTA inside footer (Glassmorphic) -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-20 p-10 md:p-12 bg-white/[0.03] border border-white/10 rounded-[2.5rem] backdrop-blur-xl relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-fuchsia-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            <div class="relative z-10 text-center md:text-right mb-8 md:mb-0">
                <h3 class="text-3xl md:text-4xl font-bold text-white mb-3">{{ __('website.footer.ready_heading') }}</h3>
                <p class="text-lg text-slate-400">{{ __('website.footer.ready_desc') }}</p>
            </div>
            <div class="relative z-10">
                <a href="#" class="px-10 py-5 bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white text-lg font-bold rounded-full hover:shadow-[0_0_40px_rgba(99,102,241,0.5)] transition-all duration-300 hover:scale-105 inline-block text-center w-full md:w-auto">
                    {{ __('website.footer.create_account') }}
                </a>
            </div>
        </div>

        <!-- Main Footer Links -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
            
            <!-- Brand Column -->
            <div class="md:col-span-4">
                <a href="#" class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-fuchsia-400 mb-6 inline-block tracking-tight drop-shadow-md">
                    Amlak.
                </a>
                <p class="text-slate-400 text-base leading-relaxed mb-8 max-w-sm">
                    {{ __('website.hero.title') }} في الشرق الأوسط. {{ __('website.hero.subtitle') }}
                </p>
                <div class="flex space-x-4 rtl:space-x-reverse">
                    <a href="#" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:bg-[#1DA1F2] hover:text-white hover:border-[#1DA1F2] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_10px_20px_rgba(29,161,242,0.4)]">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:bg-[#0A66C2] hover:text-white hover:border-[#0A66C2] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_10px_20px_rgba(10,102,194,0.4)]">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:bg-gradient-to-tr hover:from-[#f09433] hover:via-[#dc2743] hover:to-[#bc1888] hover:text-white hover:border-transparent transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_10px_20px_rgba(220,39,67,0.4)]">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="md:col-span-2 md:col-start-7">
                <h4 class="text-white font-bold mb-6 text-xl">{{ __('website.footer.quick_links') }}</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2 group"><i class="fas fa-chevron-left text-xs text-slate-600 group-hover:text-indigo-400 transition-colors"></i> {{ __('website.navbar.home') }}</a></li>
                    <li><a href="#features" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2 group"><i class="fas fa-chevron-left text-xs text-slate-600 group-hover:text-indigo-400 transition-colors"></i> {{ __('website.navbar.features') }}</a></li>
                    <li><a href="#pricing" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2 group"><i class="fas fa-chevron-left text-xs text-slate-600 group-hover:text-indigo-400 transition-colors"></i> {{ __('website.navbar.pricing') }}</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="md:col-span-4">
                <h4 class="text-white font-bold mb-6 text-xl">{{ __('website.footer.newsletter') }}</h4>
                <p class="text-slate-400 mb-6 leading-relaxed">{{ __('website.footer.newsletter_desc') }}</p>
                <div class="relative group">
                    <!-- Glow behind input -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-fuchsia-500 rounded-full blur opacity-0 group-hover:opacity-30 transition duration-500"></div>
                    
                    <div class="relative flex items-center">
                        <input type="email" placeholder="{{ __('website.footer.email_placeholder') }}" class="w-full bg-slate-900 border border-white/10 rounded-full pl-6 pr-6 py-4 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all duration-300">
                        <button class="absolute left-1.5 bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white rounded-full px-6 py-2.5 font-bold hover:shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all duration-300">
                            {{ __('website.footer.subscribe') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright & Terms -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
            <div class="mb-4 md:mb-0 font-medium">
                &copy; {{ date('Y') }} Amlak System. {{ __('website.footer.copyright') }}
            </div>
            <div class="flex space-x-6 rtl:space-x-reverse font-medium">
                <a href="#" class="hover:text-white transition-colors relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-white hover:after:w-full after:transition-all after:duration-300">{{ __('website.footer.privacy') }}</a>
                <a href="#" class="hover:text-white transition-colors relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-white hover:after:w-full after:transition-all after:duration-300">{{ __('website.footer.terms') }}</a>
            </div>
        </div>
    </div>
</footer>
