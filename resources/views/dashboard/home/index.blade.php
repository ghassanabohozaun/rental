@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/css/dashboard-home.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/css/ajax-table.css') !!}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- Integrated Company & Welcome Banner -->
            <div class="row animate-up">
                <div class="col-12">
                    <div class="company-identity-banner card border-0 shadow-sm">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="company-logo-frame">
                                        @if (auth()->user()->company && auth()->user()->company->logo_url)
                                            <img src="{{ auth()->user()->company->logo_url }}" alt="Logo">
                                        @else
                                            <span class="company-initials">
                                                @php
                                                    $brandName = auth()->user()->company
                                                        ? auth()->user()->company->name
                                                        : setting()->site_name;
                                                    $words = explode(' ', $brandName);
                                                    $initials = '';
                                                    foreach ($words as $w) {
                                                        $initials .= mb_substr($w, 0, 1);
                                                    }
                                                    echo mb_strtoupper(mb_substr($initials, 0, 2));
                                                @endphp
                                            </span>
                                        @endif
                                    </div>
                                    <div class="company-info ml-3 mr-3">
                                        <h2 class="welcome-text-premium mb-0" style="font-weight: 800; font-size: 1.6rem;">
                                            {!! greeting() !!}, <span class="text-primary">{!! user()->name !!}</span>! 👋
                                        </h2>
                                        <p class="company-name-subtitle mb-0 text-muted" style="font-size: 1.1rem; font-weight: 500;">
                                            {{ auth()->user()->company ? auth()->user()->company->name : setting()->site_name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="welcome-date-section d-none d-md-block">
                                    <div class="welcome-date mb-0 p-2 px-3">
                                        <i class="fas fa-calendar-check mr-1"></i>
                                        {!! date('l, d F Y') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Premium Tabs Segmented Control -->
            <div class="animate-up delay-1 text-center d-flex justify-content-center mb-3">
                <div class="premium-segmented-control">
                    <button type="button" class="premium-tab-btn active" id="overview-tab"
                        onclick="switchDashTab('overview')">
                        <i class="fas fa-chart-pie"></i> {!! __('dashboard.overview') ?? 'Overview' !!}
                    </button>
                    <button type="button" class="premium-tab-btn" id="activity-tab"
                        onclick="switchDashTab('activity')">
                        <i class="fas fa-chart-line"></i> {!! __('dashboard.activity') ?? 'System Activity' !!}
                    </button>
                    <button type="button" class="premium-tab-btn" id="reports-tab"
                        onclick="switchDashTab('reports')">
                        <i class="fas fa-file-invoice"></i> {!! __('dashboard.reports') ?? 'Reports' !!}
                    </button>
                </div>
            </div>

            <div class="tab-content animate-up delay-2" id="dashboardTabsContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">

                    <!-- Ultra Premium Stats Cards -->
                    <div class="row d-flex align-items-stretch">
                        @if ($isSuperAdmin)
                            <div class="col-xl-3 col-lg-6 col-12 mb-2">
                                <div class="premium-stat-card h-100 card-companies">
                                    <div class="stat-icon-blob"></div>
                                    <h3 class="stat-value text-info">{!! $stats['companies_count'] !!}</h3>
                                    <h6 class="stat-title">{!! __('companies.companies') !!}</h6>
                                    <i class="fas fa-briefcase stat-icon-floating text-info"></i>
                                </div>
                            </div>
                        @endif

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card h-100 card-users">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-success">{!! $stats['properties_count'] !!}</h3>
                                <h6 class="stat-title">{!! __('properties.properties') !!}</h6>
                                <i class="fas fa-home stat-icon-floating text-success"></i>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card h-100 card-departments">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-warning">{!! $stats['active_contracts'] !!}</h3>
                                <h6 class="stat-title">{!! __('contracts.contracts') !!}</h6>
                                <i class="fas fa-file-contract stat-icon-floating text-warning"></i>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card h-100 card-roles">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-danger">{!! number_format($stats['total_payments'], 0) !!}</h3>
                                <h6 class="stat-title">{!! __('contracts.paid_amount') !!}</h6>
                                <i class="fas fa-wallet stat-icon-floating text-danger"></i>
                            </div>
                        </div>

                        @if (!$isSuperAdmin)
                            <div class="col-xl-3 col-lg-6 col-12 mb-2">
                                <div class="premium-stat-card h-100 card-companies">
                                    <div class="stat-icon-blob"></div>
                                    <h3 class="stat-value text-info">{!! number_format($stats['pending_cheques_value'], 0) !!}</h3>
                                    <h6 class="stat-title">{!! __('cheques.pending_cheques') !!}</h6>
                                    <i class="fas fa-credit-card stat-icon-floating text-info"></i>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Premium Chart Row -->
                    <div class="row mt-3 animate-up delay-3">
                        <div class="col-lg-8">
                            <div class="card premium-chart-card h-100">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="fas fa-chart-line text-primary"></i>
                                        {!! __('dashboard.financial_trend') ?? 'Financial Trend' !!}</h4>
                                    <p class="text-muted mb-0 mt-1">{!! __('dashboard.monthly_collections') ?? 'Monthly rent collections overview' !!}</p>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div id="premium-area-chart" class="height-350"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card premium-chart-card h-100">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="fas fa-chart-pie text-success"></i>
                                        {!! __('dashboard.occupancy_rate') ?? 'Occupancy Rate' !!}</h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0 d-flex flex-column align-items-center justify-content-center">
                                        <div id="occupancy-donut-chart" class="height-300"></div>
                                        <div class="mt-2 text-center">
                                            <span class="badge badge-pill badge-glow badge-success px-3 py-1 mr-1">{!! $occupancyChart['series'][0] !!} {!! __('properties.rented') !!}</span>
                                            <span class="badge badge-pill badge-glow badge-secondary px-3 py-1">{!! $occupancyChart['series'][1] !!} {!! __('properties.available') !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Activity Tab (Lists & Task Alerts) -->
                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <div class="row mt-3">
                        {{-- Expiring Contracts --}}
                        <div class="col-md-6">
                            <div class="card premium-card border-0 shadow-sm">
                                <div class="card-header bg-light-warning border-0 d-flex align-items-center">
                                    <div class="icon-circle bg-warning text-white mr-2"><i class="fas fa-clock"></i></div>
                                    <h4 class="card-title mb-0 font-weight-bold">{!! __('dashboard.expiring_contracts') ?? 'Expiring Contracts' !!}</h4>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th>{!! __('customers.customer') !!}</th>
                                                    <th>{!! __('properties.property') !!}</th>
                                                    <th class="text-center">{!! __('contracts.end_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($expiringContracts as $contract)
                                                    <tr>
                                                        <td>
                                                            <div class="font-weight-bold">{!! optional($contract->customer)->name !!}</div>
                                                            <small class="text-muted">{!! optional($contract->customer)->phone !!}</small>
                                                        </td>
                                                        <td>{!! optional($contract->property)->name !!}</td>
                                                        <td class="text-center">
                                                            <span class="badge badge-pill badge-light-danger">{!! $contract->end_date->format('Y-m-d') !!}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="3" class="text-center p-4 text-muted">{!! __('dashboard.no_expiring_contracts') ?? 'No contracts expiring soon' !!}</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Upcoming Cheques --}}
                        <div class="col-md-6">
                            <div class="card premium-card border-0 shadow-sm">
                                <div class="card-header bg-light-info border-0 d-flex align-items-center">
                                    <div class="icon-circle bg-info text-white mr-2"><i class="fas fa-money-bill-wave"></i></div>
                                    <h4 class="card-title mb-0 font-weight-bold">{!! __('dashboard.upcoming_cheques') ?? 'Upcoming Cheques' !!}</h4>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th>{!! __('cheques.cheque_number') !!}</th>
                                                    <th>{!! __('cheques.amount') !!}</th>
                                                    <th class="text-center">{!! __('cheques.due_date') !!}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($upcomingCheques as $cheque)
                                                    <tr>
                                                        <td>
                                                            <div class="font-weight-bold">#{!! $cheque->cheque_number !!}</div>
                                                            <small class="text-muted">{!! $cheque->bank_name !!}</small>
                                                        </td>
                                                        <td><span class="text-success font-weight-bold">{!! number_format($cheque->amount, 2) !!}</span></td>
                                                        <td class="text-center">
                                                            <span class="badge badge-pill badge-light-primary">{!! $cheque->due_date->format('Y-m-d') !!}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="3" class="text-center p-4 text-muted">{!! __('dashboard.no_upcoming_cheques') ?? 'No cheques due soon' !!}</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Tab (Placeholder) -->
                <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                    <div class="card premium-card border-0 shadow-sm mt-3">
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="fas fa-file-pdf text-muted" style="font-size: 6rem; opacity: 0.3;"></i>
                            </div>
                            <h4 class="text-muted">{!! __('dashboard.reports_module_ready') ?? 'Reports module is being prepared with full financial audits.' !!}</h4>
                        </div>
                    </div>
                </div>
            </div>
            </div>


        </div> <!-- end: content wrapper  -->
    </div><!-- end: content app  -->
@endsection

@push('scripts')
    <!-- ApexCharts Vendor JS -->
    <script src="{!! asset('assets/dashbaord/vendors/js/charts/apexcharts.min.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var isRtl = $('html').attr('data-textdirection') === 'rtl';

            // 1. Financial Trend Area Chart
            var financialOptions = {
                chart: {
                    type: 'area',
                    height: 380,
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 1200
                    },
                    fontFamily: 'Cairo, sans-serif'
                },
                colors: ['#4361ee'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                series: [{
                    name: "{!! __('contracts.paid_amount') !!}",
                    data: {!! json_encode($financialChart['data']) !!}
                }],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: {!! json_encode($financialChart['categories']) !!},
                    labels: { 
                        style: { colors: '#a1aab2' },
                        rotate: -45,
                        rotateAlways: false
                    }
                },
                yaxis: {
                    labels: { 
                        style: { colors: '#a1aab2' }, 
                        offsetX: isRtl ? -15 : 0,
                        formatter: function(val) {
                            return val.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: 'rgba(0,0,0,0.05)',
                    strokeDashArray: 4
                },
                tooltip: { theme: 'light' }
            };

            if (document.querySelector("#premium-area-chart")) {
                var financialChart = new ApexCharts(document.querySelector("#premium-area-chart"), financialOptions);
                financialChart.render();
            }

            // 2. Occupancy Donut Chart
            var occupancyOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    fontFamily: 'Cairo, sans-serif'
                },
                colors: ['#2ecc71', '#e0e6ed'],
                series: {!! json_encode($occupancyChart['series']) !!},
                labels: {!! json_encode($occupancyChart['labels']) !!},
                legend: { position: 'bottom' },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                name: { show: true },
                                value: { 
                                    show: true,
                                    formatter: function(val) { return val; }
                                },
                                total: {
                                    show: true,
                                    label: "{!! __('properties.properties') !!}",
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false }
            };

            if (document.querySelector("#occupancy-donut-chart")) {
                var occupancyChart = new ApexCharts(document.querySelector("#occupancy-donut-chart"), occupancyOptions);
                occupancyChart.render();
            }
        });

        function switchDashTab(tabId) {
            // Update button states
            $('.premium-tab-btn').removeClass('active');
            $('#' + tabId + '-tab').addClass('active');

            // Show/hide tab panes
            $('.tab-pane').removeClass('show active');
            $('#' + tabId).addClass('show active');
            
            // Trigger resize to fix ApexCharts rendering inside tabs
            window.dispatchEvent(new Event('resize'));
        }
    </script>
@endpush
