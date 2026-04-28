<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-light fixed-top navbar-shadow" style="background: #fff !important;">
    <div class="navbar-wrapper" style="background: #fff !important;">
        <div class="navbar-header bg-white" style="background: #fff !important;">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="javascript:void(0)"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto site_name_logo_section">
                    <a class="navbar-brand" href="javascript:void(0)">
                        @if (setting()->logo != null)
                            <img class="brand-logo" alt="" src="{!! asset('uploads/settings/' . setting()->logo) !!}">
                        @else
                            @php
                                $brandName = setting()->site_name;
                                if (auth()->check() && auth()->user()->company) {
                                    $brandName = auth()->user()->company->name;
                                }
                                
                                $words = explode(' ', $brandName);
                                $initials = '';
                                foreach ($words as $w) {
                                    $initials .= mb_substr($w, 0, 1);
                                }
                                $displayInitials = mb_strtoupper(mb_substr($initials, 0, 2));
                            @endphp
                            <div class="company-header-brand">
                                <div class="brand-pill">
                                    <div class="brand-avatar">
                                        <span class="initials" style="background: #5A8DEE">
                                            {{ $displayInitials }}
                                        </span>
                                    </div>
                                    <span class="brand-text">{{ $brandName }}</span>
                                </div>
                            </div>
                        @endif
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container px-2" data-toggle="collapse" data-target="#navbar-mobile">
                        <i class="la la-ellipsis-v font-medium-3 text-primary"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                </ul>


                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <div id="user_header_content" class="d-flex align-items-center">
                            <a class="dropdown-toggle nav-link dropdown-user-link p-0" href="javascript:void(0)"
                                data-toggle="dropdown">
                                <div class="premium-user-pill">
                                    <div class="user-info-text d-none d-lg-flex">
                                        <span class="greeting-text">{!! __('dashboard.hello') !!}</span>
                                        <span class="user-name-text">{!! user()->getTranslation('name', Lang()) !!}</span>
                                    </div>
                                    @php
                                        $user = user();
                                        $photoUrl = $user->userPhoto();
                                        $colors = [
                                            '#5A8DEE',
                                            '#FDAC41',
                                            '#FF5B5C',
                                            '#39DA8A',
                                            '#00CFDD',
                                            '#7117EA',
                                            '#272727',
                                        ];
                                        $charIndex = abs(crc32($user->name)) % count($colors);
                                        $bgColor = $colors[$charIndex];
                                    @endphp
                                    <div class="avatar-wrapper-premium">
                                        @if ($photoUrl)
                                            <img src="{!! $photoUrl !!}" alt="avatar"
                                                class="avatar-img-premium shadow-sm">
                                        @else
                                            <span class="avatar-initials-premium shadow-sm"
                                                style="background: linear-gradient(135deg, {!! $bgColor !!}, {!! $bgColor !!}dd);">
                                                {!! $user->initials !!}
                                            </span>
                                        @endif
                                    </div>
                                    <i class="la la-angle-down ml-1 chevron-icon d-none d-lg-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
                                <div class="dropdown-header-premium">
                                    <span class="user-name">{!! user()->name !!}</span>
                                    <span class="user-email">{!! user()->email !!}</span>
                                </div>
                                <a class="dropdown-item premium-dropdown-item" href="javascript:void(0)">
                                    <i class="ft-user"></i> {!! __('dashboard.profile') !!}
                                </a>
                                <a class="dropdown-item premium-dropdown-item" href="{!! route('dashboard.lock.screen') !!}">
                                    <i class="la la-lock"></i> {!! __('dashboard.lock_screen') !!}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item premium-dropdown-item logout-item"
                                    href="{!! route('dashboard.logout') !!}">
                                    <i class="ft-power"></i> {!! __('auth.logout') !!}
                                </a>
                            </div>
                        </div>
                    </li>
                    {{-- Premium Language Switcher Toggle --}}
                    @php
                        $currentLocale = Lang();
                        $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                        $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
                        $flagPath =
                            $targetLocale == 'ar'
                                ? asset('assets/dashbaord/media/svg/flags/العربية.svg')
                                : asset('assets/dashbaord/media/svg/flags/English.svg');
                    @endphp
                    <li class="nav-item">
                        <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}"
                            class="nav-link p-0 d-flex align-items-center h-100">
                            <div class="language-switcher-premium">
                                <img src="{!! $flagPath !!}" class="flag-icon" alt="{!! $targetNative !!}">
                                <span class="lang-name">{{ $targetNative }}</span>
                            </div>
                        </a>
                    </li>

                    {{-- Hardcoded Notifications --}}
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="javascript:void(0)" data-toggle="dropdown">
                            <i class="ficon ft-bell"></i>
                            <span class="badge badge-pill badge-default badge-danger badge-up badge-glow">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
                            <div class="dropdown-header-main">
                                <h6 class="header-title">Notifications</h6>
                                <span class="premium-badge-count">4 New</span>
                            </div>
                            <div class="scrollable-container media-list w-100 custom-scrollbar"
                                style="max-height: 350px; overflow-y: auto;">
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-success">
                                        <i class="ft-home"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">New Property</span>
                                        <span class="message-text">"Al-Yasmeen Villa" has been added
                                            successfully.</span>
                                        <span class="time">5 mins ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-warning">
                                        <i class="ft-file-text"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Contract Expiring</span>
                                        <span class="message-text">Contract for Property #105 is expiring soon.</span>
                                        <span class="time">1 hour ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-info">
                                        <i class="ft-tool"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Maintenance Request</span>
                                        <span class="message-text">New maintenance request for Al-Baraka
                                            Apartment.</span>
                                        <span class="time">2 hours ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-danger">
                                        <i class="ft-credit-card"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Due Cheque</span>
                                        <span class="message-text">A cheque of 5,000 SAR is due tomorrow.</span>
                                        <span class="time">5 hours ago</span>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer-premium">
                                <a href="javascript:void(0)">View All</a>
                            </div>
                        </div>
                    </li>

                    {{-- Hardcoded Messages --}}
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="javascript:void(0)" data-toggle="dropdown">
                            <i class="ficon ft-mail"></i>
                            <span class="badge badge-pill badge-default badge-danger badge-up badge-glow">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
                            <div class="dropdown-header-main">
                                <h6 class="header-title">Messages</h6>
                                <span class="premium-badge-count">4 New</span>
                            </div>
                            <div class="scrollable-container media-list w-100 custom-scrollbar"
                                style="max-height: 350px; overflow-y: auto;">
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-cyan">
                                        <i class="ft-user"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Ahmed Mohamed</span>
                                        <span class="message-text">Inquiry about an apartment in Al-Malaz...</span>
                                        <span class="time">10 mins ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-primary">
                                        <i class="ft-user"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Sara Ali</span>
                                        <span class="message-text">Rent transferred, find the receipt...</span>
                                        <span class="time">30 mins ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-teal">
                                        <i class="ft-user"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Khaled Mahmoud</span>
                                        <span class="message-text">Can we inspect the villa tomorrow?...</span>
                                        <span class="time">1 hour ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-purple">
                                        <i class="ft-user"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Nour El-Din</span>
                                        <span class="message-text">Commercial office booking confirmation...</span>
                                        <span class="time">4 hours ago</span>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer-premium">
                                <a href="javascript:void(0)">View all messages</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
