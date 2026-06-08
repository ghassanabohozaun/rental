    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow expanded" data-scroll-to-active="true">
        <div class="main-menu-content">
            {{-- Search Bar --}}
            <div class="sidebar-search-wrapper">
                <div class="sidebar-search-container">
                    <i class="fas fa-search sidebar-search-icon"></i>
                    <input type="text" class="sidebar-search-input" id="sidebar-menu-search"
                        placeholder="{!! __('dashboard.search') !!}">
                </div>
            </div>

            <ul class="navigation navigation-main mt-1" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- begin: Dashboard -->
                <li class=" nav-item @if (Request::is('*welcome*')) active @endif">
                    <a href="{!! route('dashboard.index') !!}">
                        <i class="{{ config('global.module_icons.dashboard') }}"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{!! __('dashboard.dashboard') !!}</span>
                    </a>
                </li>
                <!-- end: Dashboard -->

                {{-- Group 1: System Management --}}
                @if(auth()->user()->can('companies_read') || auth()->user()->can('bank_accounts_read') || auth()->user()->can('departments_read') || auth()->user()->can('settings_read'))
                @php
                    $isSystemActive =
                        Request::routeIs('dashboard.companies.*') ||
                        Request::routeIs('dashboard.bank-accounts.*') ||
                        Request::routeIs('dashboard.departments.*') ||
                        Request::routeIs('dashboard.settings.*');
                @endphp
                <li class="nav-item has-sub @if ($isSystemActive) open @endif">
                    <a href="javascript:void(0)">
                        <i class="fas fa-cogs"></i>
                        <span class="menu-title">{!! __('dashboard.main_navigation') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('companies_read')
                            <li class="@if (Request::routeIs('dashboard.companies.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.companies.index') !!}">
                                    {!! __('companies.companies') !!}
                                </a>
                            </li>
                        @endcan
                        @can('bank_accounts_read')
                            <li class="@if (Request::routeIs('dashboard.bank-accounts.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.bank-accounts.index') !!}">
                                    {!! __('bank_accounts.bank_accounts') !!}
                                </a>
                            </li>
                        @endcan
                        @can('departments_read')
                            <li class="@if (Request::routeIs('dashboard.departments.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.departments.index') !!}">
                                    {!! __('departments.departments') !!}
                                </a>
                            </li>
                        @endcan
                        @can('settings_read')
                            <li class="@if (Request::routeIs('dashboard.settings.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.settings.index') !!}">
                                    {!! __('settings.settings') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{-- Group 2: Support & Access (Users, Roles) --}}
                @if(auth()->user()->can('users_read') || auth()->user()->can('roles_read'))
                @php
                    $isSupportActive =
                        Request::routeIs('dashboard.users.*') ||
                        Request::routeIs('dashboard.roles.*');
                @endphp
                <li class="nav-item has-sub @if ($isSupportActive) open @endif">
                    <a href="javascript:void(0)">
                        <i class="fas fa-tools"></i>
                        <span class="menu-title">{!! __('dashboard.technical_support') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('users_read')
                            <li class="@if (Request::routeIs('dashboard.users.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.users.index') !!}">
                                    {!! __('users.users') !!}
                                </a>
                            </li>
                        @endcan
                        @can('roles_read')
                            <li class="@if (Request::routeIs('dashboard.roles.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.roles.index') !!}">
                                    {!! __('roles.roles') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{-- Group 3: Asset Management --}}
                @if(auth()->user()->can('owners_read') || auth()->user()->can('properties_read') || auth()->user()->can('property_types_read') || auth()->user()->can('property_statuses_read') || auth()->user()->can('maintenances_read'))
                @php
                    $isAssetActive =
                        Request::routeIs('dashboard.owners.*') ||
                        Request::routeIs('dashboard.properties.*') ||
                        Request::routeIs('dashboard.property_types.*') ||
                        Request::routeIs('dashboard.property_statuses.*') ||
                        Request::routeIs('dashboard.maintenances.*');
                @endphp
                <li class="nav-item has-sub @if ($isAssetActive) open @endif">
                    <a href="javascript:void(0)">
                        <i class="fas fa-city"></i>
                        <span class="menu-title">{!! __('properties.properties') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('owners_read')
                            <li class="@if (Request::routeIs('dashboard.owners.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.owners.index') !!}">
                                    {!! __('owners.owners') !!}
                                </a>
                            </li>
                        @endcan
                        @can('properties_read')
                            <li class="@if (Request::routeIs('dashboard.properties.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.properties.index') !!}">
                                    {!! __('properties.properties') !!}
                                </a>
                            </li>
                        @endcan
                        @can('property_types_read')
                            <li class="@if (Request::routeIs('dashboard.property_types.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.property_types.index') !!}">
                                    {!! __('property_types.property_types') !!}
                                </a>
                            </li>
                        @endcan
                        @can('property_statuses_read')
                            <li class="@if (Request::routeIs('dashboard.property_statuses.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.property_statuses.index') !!}">
                                    {!! __('property_statuses.property_statuses') !!}
                                </a>
                            </li>
                        @endcan
                        @can('maintenances_read')
                            <li class="@if (Request::routeIs('dashboard.maintenances.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.maintenances.index') !!}">
                                    {!! __('maintenances.maintenances') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif

                {{-- Group 4: Customer Relations --}}
                @if(auth()->user()->can('customers_read') || auth()->user()->can('guarantors_read'))
                @php
                    $isCustomerActive =
                        Request::routeIs('dashboard.customers.*') || Request::routeIs('dashboard.guarantors.*');
                @endphp
                <li class="nav-item has-sub @if ($isCustomerActive) open @endif">
                    <a href="javascript:void(0)">
                        <i class="fas fa-user-friends"></i>
                        <span class="menu-title">{!! __('customers.customers') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('guarantors_read')
                            <li class="@if (Request::routeIs('dashboard.guarantors.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.guarantors.index') !!}">
                                    {!! __('guarantors.guarantors') !!}
                                </a>
                            </li>
                        @endcan
                        @can('customers_read')
                            <li class="@if (Request::routeIs('dashboard.customers.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.customers.index') !!}">
                                    {!! __('customers.customers') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif

                <!-- begin: Contracts -->
                @if(auth()->user()->can('contracts_read') || auth()->user()->can('contract_clauses_read'))
                @php
                    $isContractsActive =
                        Request::routeIs('dashboard.contracts.*') ||
                        Request::routeIs('dashboard.contract_clause_templates.*');
                @endphp
                <li class="nav-item has-sub @if ($isContractsActive) open @endif">
                    <a href="javascript:void(0)">
                        <i class="fas fa-file-contract"></i>
                        <span class="menu-title">{!! __('contracts.contracts') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('contracts_read')
                            <li class="@if (Request::routeIs('dashboard.contracts.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.contracts.index') !!}">
                                    {!! __('contracts.contracts') !!}
                                </a>
                            </li>
                        @endcan
                        @can('contract_clauses_read')
                            <li class="@if (Request::routeIs('dashboard.contract_clause_templates.*')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.contract_clause_templates.index') !!}">
                                    {!! __('contracts.contract_clauses_library') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif
                <!-- end: Contracts -->

                <!-- begin: Cheques -->
                @if(auth()->user()->can('cheques_read') || auth()->user()->can('cheques_import'))
                @php
                    $isChequesActive = Request::routeIs('dashboard.cheques.*');
                @endphp
                <li class="nav-item has-sub @if ($isChequesActive) open @endif">
                    <a href="javascript:void(0)">
                        <i class="fas fa-money-check-alt"></i>
                        <span class="menu-title">{!! __('cheques.cheques') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @can('cheques_read')
                            <li class="@if (Request::routeIs('dashboard.cheques.index') || Request::routeIs('dashboard.cheques.create') || Request::routeIs('dashboard.cheques.edit') || Request::routeIs('dashboard.cheques.show')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.cheques.index') !!}">
                                    {!! __('cheques.all_cheques') !!}
                                </a>
                            </li>
                        @endcan
                        @can('cheques_import')
                            <li class="@if (Request::routeIs('dashboard.cheques.import')) active @endif">
                                <a class="menu-item" href="{!! route('dashboard.cheques.import') !!}">
                                    {!! __('cheques.import_cheques') !!}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif
                <!-- end: Cheques -->

                <!-- begin: Payments -->
                @can('payments_read')
                    <li class="nav-item @if (Request::routeIs('dashboard.payments.*')) active @endif">
                        <a href="{!! route('dashboard.payments.index') !!}">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="menu-title">{!! __('payments.payments') !!}</span>
                        </a>
                    </li>
                @endcan
                <!-- end: Payments -->

                {{-- Group 5: Reports --}}
                @if (auth()->user()->id === 1 || auth()->user()->role_id === 1 || auth()->user()->hasAbility('reports_properties'))
                <li class="nav-item {{ Route::is('dashboard.reports.*') ? 'open' : '' }}">
                    <a href="#">
                        <i class="la la-bar-chart"></i>
                        <span class="menu-title" data-i18n="nav.reports">{!! __('global.reports') !!}</span>
                    </a>
                    <ul class="menu-content">
                        @if (auth()->user()->id === 1 || auth()->user()->role_id === 1 || auth()->user()->hasAbility('reports_properties'))
                            <li class="{{ Route::is('dashboard.reports.properties.*') ? 'active' : '' }}">
                                <a class="menu-item" href="{!! route('dashboard.reports.properties.index') !!}">
                                    <i class="la la-building"></i>
                                    <span data-i18n="nav.reports.properties">{!! __('reports.properties_reports') !!}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            </ul>
        </div>

        @push('js')
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
        @endpush
    </div>
