    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true">
        <div class="main-menu-content">

            <ul class="navigation navigation-main mt-3" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- begin: Dashboard -->
                <li class=" nav-item @if (Request::is('*welcome*')) active @endif">
                    <a href="{!! route('dashboard.index') !!}">
                        <i class="icon-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.dashboard') !!}</span>
                    </a>
                </li>
                <!-- end: Dashboard -->

                <!-- begin: companies -->
                @can('companies_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.companies.*')) open @endif">
                        <a href="#">
                            <i class="icon-briefcase"></i>
                            <span class="menu-title">{!! __('companies.companies') !!}</span>
                        </a>
                        <ul class="menu-content">
                            <li class=" @if (Request::routeIs('dashboard.companies.index')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.companies.index') !!}">
                                    {!! __('companies.companies') !!}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <!-- end: companies -->

                <!-- begin: bank accounts -->
                @can('bank_accounts_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.bank-accounts.*')) open @endif">
                        <a href="#">
                            <i class="la la-bank"></i>
                            <span class="menu-title">{!! __('bank_accounts.bank_accounts') !!}</span>
                        </a>
                        <ul class="menu-content">
                            <li class=" @if (Request::routeIs('dashboard.bank-accounts.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.bank-accounts.index') !!}">
                                    {!! __('bank_accounts.bank_accounts') !!}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <!-- end: bank accounts -->

                <!-- begin: properties -->
                @php
                    $isPropertiesActive = Request::routeIs('dashboard.properties.*') || Request::routeIs('dashboard.property_types.*') || Request::routeIs('dashboard.property_statuses.*');
                @endphp
                <li class="nav-item has-sub @if ($isPropertiesActive) open @endif">
                    <a href="#">
                        <i class="la la-building"></i>
                        <span class="menu-title">{!! __('properties.properties') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('properties_read')
                            <li class=" @if (Request::routeIs('dashboard.properties.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.properties.index') !!}">
                                    {!! __('properties.properties') !!}
                                </a>
                            </li>
                        @endcan
                        @can('property_types_read')
                            <li class=" @if (Request::routeIs('dashboard.property_types.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.property_types.index') !!}">
                                    {!! __('property_types.property_types') !!}
                                </a>
                            </li>
                        @endcan
                        @can('property_statuses_read')
                            <li class=" @if (Request::routeIs('dashboard.property_statuses.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.property_statuses.index') !!}">
                                    {!! __('property_statuses.property_statuses') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <!-- end: properties -->

                <!-- begin: departments -->
                @can('departments_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.departments.*')) open @endif">
                        <a href="#">
                            <i class="la la-sitemap"></i>
                            <span class="menu-title" data-i18n="nav.dash.departments">{!! __('dashboard.departments') !!}</span>
                        </a>
                        <!-- begin: departments -->
                        <ul class="menu-content">
                            <li class="@if (Request::routeIs('dashboard.departments.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.departments.index') !!}" data-i18n="nav.dash.departments">
                                    {!! __('departments.departments') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: departments -->
                    </li>
                @endcan
                <!-- end: departments -->

                <!-- begin: roles -->
                @can('roles_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.roles.*')) open @endif">
                        <a href="javascript:void(0)">
                            <i class="icon-lock"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.roles') !!}</span>
                        </a>
                        <!-- begin: roles -->
                        <ul class="menu-content">
                            <li class="@if (Request::routeIs('dashboard.roles.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.roles.index') !!}" data-i18n="nav.dash.roles">
                                    {!! __('roles.roles') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: roles -->
                    </li>
                @endcan
                <!-- end: roles -->

                <!-- begin: users -->
                @can('users_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.users.*')) open @endif">
                        <a href="javascript:void(0)">
                            <i class="icon-user"></i>
                            <span class="menu-title" data-i18n="nav.dash.users">{!! __('dashboard.users') !!}</span>
                        </a>
                        <!-- begin: users -->
                        <ul class="menu-content">
                            <li class="@if (Request::routeIs('dashboard.users.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.users.index') !!}" data-i18n="nav.dash.users">
                                    {!! __('users.users') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: users -->
                    </li>
                @endcan
                <!-- end: users -->

                <!-- begin: guarantors -->
                @can('guarantors_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.guarantors.*')) open @endif">
                        <a href="javascript:void(0)">
                            <i class="la la-shield"></i>
                            <span class="menu-title" data-i18n="nav.dash.guarantors">{!! __('guarantors.guarantors') !!}</span>
                        </a>
                        <!-- begin: guarantors -->
                        <ul class="menu-content">
                            <li class="@if (Request::routeIs('dashboard.guarantors.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.guarantors.index') !!}" data-i18n="nav.dash.guarantors">
                                    {!! __('guarantors.guarantors') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: guarantors -->
                    </li>
                @endcan
                <!-- end: guarantors -->

                <!-- begin: settings -->
                @can('settings_read')
                    <li class="nav-item has-sub @if (Request::routeIs('dashboard.settings.*')) open @endif">
                        <a href="javascript:void(0)">
                            <i class="icon-settings"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.settings') !!}</span>
                        </a>
                        <!-- begin: settings -->
                        <ul class="menu-content">
                            <li class="@if (Request::routeIs('dashboard.settings.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.settings.index') !!}" data-i18n="nav.dash.settings">
                                    {!! __('settings.settings') !!}
                                </a>
                            </li>
                        </ul>
                        <!-- end: settings -->
                    </li>
                @endcan
                <!-- end: settings -->

            </ul>
        </div>
    </div>
