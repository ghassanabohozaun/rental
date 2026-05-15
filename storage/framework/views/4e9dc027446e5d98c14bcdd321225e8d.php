<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-light fixed-top navbar-shadow"
    style="background: #fff !important;">
    <div class="navbar-wrapper" style="background: #fff !important;">
        <div class="navbar-header bg-white" style="background: #fff !important;">
            <ul class="nav navbar-nav flex-row premium-mobile-nav-container">
                <li class="nav-item mobile-menu d-md-none premium-mobile-toggle">
                    <a class="nav-link nav-menu-main menu-toggle" href="javascript:void(0)">
                        <div class="premium-burger sidebar-burger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>
                <li class="nav-item site_name_logo_section">
                    <a class="navbar-brand" href="javascript:void(0)">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting()->logo != null): ?>
                            <img class="brand-logo" alt="" src="<?php echo asset('uploads/settings/' . setting()->logo); ?>">
                        <?php else: ?>
                            <?php
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
                            ?>
                            <div class="enterprise-header-brand">
                                <div class="brand-container">
                                    <div class="brand-icon-frame">
                                        <span class="initials-enterprise">
                                            <?php echo e($displayInitials); ?>

                                        </span>
                                    </div>
                                    <span class="brand-text-enterprise"><?php echo e($brandName); ?></span>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>
                </li>
                <li class="nav-item d-md-none premium-mobile-ellipsis">
                    <a class="nav-link open-navbar-container px-2" data-toggle="collapse" data-target="#navbar-mobile">
                        <div class="premium-burger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left d-none d-md-flex">
                </ul>

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <div id="user_header_content" class="d-flex align-items-center">
                            <a class="dropdown-toggle nav-link dropdown-user-link p-0" href="javascript:void(0)"
                                data-toggle="dropdown">
                                <div class="enterprise-user-pill">
                                    <div class="user-info-text d-none d-lg-flex">
                                        <span class="greeting-text"><?php echo __('dashboard.hello'); ?></span>
                                        <span class="user-name-text"><?php echo user()->getTranslation('name', Lang()); ?></span>
                                    </div>
                                    <?php
                                        $user = user();
                                        $photoUrl = $user->userPhoto();
                                        $colors = [
                                            '#455a64',
                                            '#37474f',
                                            '#263238',
                                            '#1e293b',
                                            '#334155',
                                            '#475569',
                                        ];
                                        $charIndex = abs(crc32($user->name)) % count($colors);
                                        $bgColor = $colors[$charIndex];
                                    ?>
                                    <div class="avatar-wrapper-enterprise">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photoUrl): ?>
                                            <img src="<?php echo $photoUrl; ?>" alt="avatar"
                                                class="avatar-img-enterprise shadow-sm">
                                        <?php else: ?>
                                            <span class="avatar-initials-enterprise shadow-sm"
                                                style="background: <?php echo $bgColor; ?>;">
                                                <?php echo $user->initials; ?>

                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <i class="la la-angle-down ml-1 chevron-icon d-none d-lg-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
                                <div class="dropdown-header-premium">
                                    <span class="user-name"><?php echo user()->name; ?></span>
                                    <span class="user-email"><?php echo user()->email; ?></span>
                                </div>
                                <a class="dropdown-item premium-dropdown-item" href="javascript:void(0)">
                                    <div class="dropdown-icon-wrapper bg-soft-primary">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <span><?php echo __('dashboard.profile'); ?></span>
                                </a>
                                <a class="dropdown-item premium-dropdown-item" href="<?php echo route('dashboard.lock.screen'); ?>">
                                    <div class="dropdown-icon-wrapper bg-soft-warning">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <span><?php echo __('dashboard.lock_screen'); ?></span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item premium-dropdown-item logout-item"
                                    href="<?php echo route('dashboard.logout'); ?>">
                                    <div class="dropdown-icon-wrapper bg-soft-danger">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                    <span><?php echo __('auth.logout'); ?></span>
                                </a>
                            </div>
                        </div>
                    </li>
                    
                    <?php
                        $currentLocale = Lang();
                        $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                        $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
                        $flagPath =
                            $targetLocale == 'ar'
                                ? asset('assets/dashbaord/media/svg/flags/العربية.svg')
                                : asset('assets/dashbaord/media/svg/flags/English.svg');
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo e(LaravelLocalization::getLocalizedURL($targetLocale, null, [], true)); ?>"
                            class="nav-link p-0 d-flex align-items-center h-100">
                            <div class="language-switcher-premium">
                                <img src="<?php echo $flagPath; ?>" class="flag-icon" alt="<?php echo $targetNative; ?>">
                                <span class="lang-name d-none d-sm-inline-block"><?php echo e($targetNative); ?></span>
                            </div>
                        </a>
                    </li>

                    
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="javascript:void(0)" data-toggle="dropdown">
                            <div class="enterprise-action-btn">
                                <i class="ficon la la-bell"></i>
                                <span class="enterprise-badge badge-danger">4</span>
                            </div>
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
                                        <i class="la la-home"></i>
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
                                        <i class="la la-file-text"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Contract Expiring</span>
                                        <span class="message-text">Contract for Property #105 is expiring soon.</span>
                                        <span class="time">1 hour ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-info">
                                        <i class="la la-cog"></i>
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
                                        <i class="la la-credit-card"></i>
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

                    
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="javascript:void(0)" data-toggle="dropdown">
                            <div class="enterprise-action-btn">
                                <i class="ficon la la-envelope"></i>
                                <span class="enterprise-badge badge-primary">4</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
                            <div class="dropdown-header-main">
                                <h6 class="header-title">Messages</h6>
                                <span class="premium-badge-count">4 New</span>
                            </div>
                            <div class="scrollable-container media-list w-100 custom-scrollbar"
                                style="max-height: 350px; overflow-y: auto;">
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-purple">
                                        <i class="la la-user"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Ahmed Mohamed</span>
                                        <span class="message-text">Inquiry about an apartment in Al-Malaz...</span>
                                        <span class="time">10 mins ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-primary">
                                        <i class="la la-user"></i>
                                    </div>
                                    <div class="preview-item-content-premium">
                                        <span class="subject">Sara Ali</span>
                                        <span class="message-text">Rent transferred, find the receipt...</span>
                                        <span class="time">30 mins ago</span>
                                    </div>
                                </a>
                                <a class="preview-item-premium" href="javascript:void(0)">
                                    <div class="preview-thumbnail-premium bg-teal">
                                        <i class="la la-user"></i>
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
<?php /**PATH C:\laragon\www\rental\resources\views/layouts/dashboard/app-parts/_header.blade.php ENDPATH**/ ?>