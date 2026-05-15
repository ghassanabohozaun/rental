    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true">
        <div class="main-menu-content">
            
            <div class="sidebar-search-wrapper">
                <div class="sidebar-search-container">
                    <i class="fas fa-search sidebar-search-icon"></i>
                    <input type="text" class="sidebar-search-input" id="sidebar-menu-search"
                        placeholder="<?php echo __('dashboard.search'); ?>">
                </div>
            </div>

            <ul class="navigation navigation-main mt-1" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- begin: Dashboard -->
                <li class=" nav-item <?php if(Request::is('*welcome*')): ?> active <?php endif; ?>">
                    <a href="<?php echo route('dashboard.index'); ?>">
                        <i class="<?php echo e(config('global.module_icons.dashboard')); ?>"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"><?php echo __('dashboard.dashboard'); ?></span>
                    </a>
                </li>
                <!-- end: Dashboard -->

                
                <?php
                    $isSystemActive =
                        Request::routeIs('dashboard.companies.*') ||
                        Request::routeIs('dashboard.bank-accounts.*') ||
                        Request::routeIs('dashboard.departments.*') ||
                        Request::routeIs('dashboard.settings.*');
                ?>
                <li class="nav-item has-sub <?php if($isSystemActive): ?> open <?php endif; ?>">
                    <a href="javascript:void(0)">
                        <i class="fas fa-cogs"></i>
                        <span class="menu-title"><?php echo __('dashboard.main_navigation'); ?></span>
                    </a>
                    <ul class="menu-content">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('companies_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.companies.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.companies.index'); ?>">
                                    <?php echo __('companies.companies'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bank_accounts_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.bank-accounts.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.bank-accounts.index'); ?>">
                                    <?php echo __('bank_accounts.bank_accounts'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('departments_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.departments.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.departments.index'); ?>">
                                    <?php echo __('departments.departments'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.settings.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.settings.index'); ?>">
                                    <?php echo __('settings.settings'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                
                <?php
                    $isSupportActive =
                        Request::routeIs('dashboard.users.*') ||
                        Request::routeIs('dashboard.roles.*') ||
                        Request::routeIs('dashboard.maintenances.*');
                ?>
                <li class="nav-item has-sub <?php if($isSupportActive): ?> open <?php endif; ?>">
                    <a href="javascript:void(0)">
                        <i class="fas fa-tools"></i>
                        <span class="menu-title"><?php echo __('dashboard.technical_support'); ?></span>
                    </a>
                    <ul class="menu-content">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.users.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.users.index'); ?>">
                                    <?php echo __('users.users'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.roles.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.roles.index'); ?>">
                                    <?php echo __('roles.roles'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('maintenances_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.maintenances.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.maintenances.index'); ?>">
                                    <?php echo __('maintenances.maintenances'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>


                
                <?php
                    $isAssetActive =
                        Request::routeIs('dashboard.owners.*') ||
                        Request::routeIs('dashboard.properties.*') ||
                        Request::routeIs('dashboard.property_types.*') ||
                        Request::routeIs('dashboard.property_statuses.*');
                ?>
                <li class="nav-item has-sub <?php if($isAssetActive): ?> open <?php endif; ?>">
                    <a href="javascript:void(0)">
                        <i class="fas fa-city"></i>
                        <span class="menu-title"><?php echo __('properties.properties'); ?></span>
                    </a>
                    <ul class="menu-content">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('owners_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.owners.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.owners.index'); ?>">
                                    <?php echo __('owners.owners'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('properties_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.properties.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.properties.index'); ?>">
                                    <?php echo __('properties.properties'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('property_types_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.property_types.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.property_types.index'); ?>">
                                    <?php echo __('property_types.property_types'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('property_statuses_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.property_statuses.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.property_statuses.index'); ?>">
                                    <?php echo __('property_statuses.property_statuses'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>


                
                <?php
                    $isCustomerActive =
                        Request::routeIs('dashboard.customers.*') || Request::routeIs('dashboard.guarantors.*');
                ?>
                <li class="nav-item has-sub <?php if($isCustomerActive): ?> open <?php endif; ?>">
                    <a href="javascript:void(0)">
                        <i class="fas fa-user-friends"></i>
                        <span class="menu-title"><?php echo __('customers.customers'); ?></span>
                    </a>
                    <ul class="menu-content">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('guarantors_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.guarantors.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.guarantors.index'); ?>">
                                    <?php echo __('guarantors.guarantors'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customers_read')): ?>
                            <li class="<?php if(Request::routeIs('dashboard.customers.*')): ?> active <?php endif; ?>">
                                <a class="menu-item" href="<?php echo route('dashboard.customers.index'); ?>">
                                    <?php echo __('customers.customers'); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- begin: Contracts -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_read')): ?>
                    <li class="nav-item <?php if(Request::routeIs('dashboard.contracts.*')): ?> active <?php endif; ?>">
                        <a href="<?php echo route('dashboard.contracts.index'); ?>">
                            <i class="fas fa-file-contract"></i>
                            <span class="menu-title"><?php echo __('contracts.contracts'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- end: Contracts -->

                <!-- begin: Cheques -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cheques_read')): ?>
                    <li class="nav-item <?php if(Request::routeIs('dashboard.cheques.*')): ?> active <?php endif; ?>">
                        <a href="<?php echo route('dashboard.cheques.index'); ?>">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="menu-title"><?php echo __('cheques.cheques'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- end: Cheques -->

                <!-- begin: Payments -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments_read')): ?>
                    <li class="nav-item <?php if(Request::routeIs('dashboard.payments.*')): ?> active <?php endif; ?>">
                        <a href="<?php echo route('dashboard.payments.index'); ?>">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="menu-title"><?php echo __('payments.payments'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- end: Payments -->
            </ul>
        </div>

        <?php $__env->startPush('js'); ?>
            <script>
                (function() {
                    const searchInput = document.getElementById('sidebar-menu-search');
                    if (!searchInput) return;

                    searchInput.addEventListener('keyup', function() {
                        let filter = this.value.toLowerCase();
                        let menuItems = document.querySelectorAll('#main-menu-navigation li.nav-item');

                        menuItems.forEach(function(item) {
                            let text = item.innerText.toLowerCase();
                            if (text.includes(filter)) {
                                item.style.display = "";
                            } else {
                                item.style.display = "none";
                            }
                        });

                        // Show/hide headers based on search
                        let headers = document.querySelectorAll('#main-menu-navigation li.navigation-header');
                        headers.forEach(h => h.style.display = filter ? "none" : "");
                    });
                })();
            </script>
        <?php $__env->stopPush(); ?>
    </div>
<?php /**PATH C:\laragon\www\rental\resources\views/layouts/dashboard/app-parts/_sidebar.blade.php ENDPATH**/ ?>