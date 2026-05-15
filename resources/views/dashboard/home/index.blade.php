@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper mt-n2">
            <!-- Integrated Company & Welcome Banner -->
            <div class="row animate-up mt-n1">
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
                                            {!! greeting() !!}, <span
                                                class="text-primary">{!! user()->name !!}</span>! 👋
                                        </h2>
                                        <p class="company-name-subtitle mb-0 text-muted"
                                            style="font-size: 1.1rem; font-weight: 500;">
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

            <!-- Elite Floating Tabs Navigation -->
            <div class="animate-up text-center d-flex justify-content-center mt-n1 mb-1">
                <ul class="nav premium-nav-tabs" id="dashboardMainTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-text="{!! __('dashboard.overview') ?? 'Overview' !!}"
                            onclick="switchDashTab('overview')">
                            <i class="fas fa-chart-pie"></i> {!! __('dashboard.overview') ?? 'Overview' !!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="activity-tab" data-text="{!! __('dashboard.activity') ?? 'System Activity' !!}"
                            onclick="switchDashTab('activity')">
                            <i class="fas fa-chart-line"></i> {!! __('dashboard.activity') ?? 'System Activity' !!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reports-tab" data-text="{!! __('dashboard.reports') ?? 'Reports' !!}"
                            onclick="switchDashTab('reports')">
                            <i class="fas fa-file-invoice"></i> {!! __('dashboard.reports') ?? 'Reports' !!}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content animate-up" id="dashboardTabsContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">

                    <!-- Ultra Premium Stats Cards -->
                    <div class="row d-flex align-items-stretch">
                        @if ($isSuperAdmin)
                            <div class="col-xl-3 col-lg-6 col-12 mb-2">
                                <div class="premium-stat-card h-100 card-contracts">
                                    <div class="stat-content">
                                        <h3 class="stat-value">{!! $stats['companies_count'] !!}</h3>
                                        <h6 class="stat-title">{!! __('companies.companies') !!}</h6>
                                    </div>
                                    <div class="stat-icon-wrapper">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card h-100 card-active">
                                <div class="stat-content">
                                    <h3 class="stat-value">{!! $stats['properties_count'] !!}</h3>
                                    <h6 class="stat-title">{!! __('properties.properties') !!}</h6>
                                </div>
                                <div class="stat-icon-wrapper">
                                    <i class="fas fa-home"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card h-100 card-revenue">
                                <div class="stat-content">
                                    <h3 class="stat-value">{!! $stats['active_contracts'] !!}</h3>
                                    <h6 class="stat-title">{!! __('contracts.contracts') !!}</h6>
                                </div>
                                <div class="stat-icon-wrapper">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card h-100 card-expiring">
                                <div class="stat-content">
                                    <h3 class="stat-value">{!! number_format($stats['total_payments'], 0) !!}</h3>
                                    <h6 class="stat-title">{!! __('contracts.paid_amount') !!}</h6>
                                </div>
                                <div class="stat-icon-wrapper">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>

                        @if (!$isSuperAdmin)
                            <div class="col-xl-3 col-lg-6 col-12 mb-2">
                                <div class="premium-stat-card h-100 card-contracts">
                                    <div class="stat-content">
                                        <h3 class="stat-value">{!! number_format($stats['pending_cheques_value'], 0) !!}</h3>
                                        <h6 class="stat-title">{!! __('cheques.pending_cheques') !!}</h6>
                                    </div>
                                    <div class="stat-icon-wrapper">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Premium Chart Row -->
                    <div class="row mt-1 animate-up">
                        <div class="col-lg-8">
                            <div class="card premium-chart-card h-100">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="fas fa-chart-line text-primary"></i>
                                        {!! __('dashboard.financial_trend') ?? 'Financial Trend' !!}</h4>
                                    <p class="text-muted mb-0 mt-1">{!! __('dashboard.monthly_collections') ?? 'Monthly rent collections overview' !!}</p>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div id="premium-area-chart"></div>
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
                                    <div
                                        class="card-body pt-0 d-flex flex-column align-items-center justify-content-center">
                                        <div id="occupancy-donut-chart" class="height-300"></div>
                                        <div class="mt-2 text-center">
                                            <span
                                                class="badge badge-pill badge-glow badge-success px-3 py-1 mr-1">{!! $occupancyChart['series'][0] !!}
                                                {!! __('properties.rented') !!}</span>
                                            <span
                                                class="badge badge-pill badge-glow badge-secondary px-3 py-1">{!! $occupancyChart['series'][1] !!}
                                                {!! __('properties.available') !!}</span>
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
                            <div class="card premium-card border-0 shadow-sm radius-15">
                                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center"
                                    style="height: 50px;">
                                    <h5 class="card-title mb-0 font-weight-bold" style="font-size: 1.1rem !important;">
                                        <i class="fas fa-clock text-warning mr-1"
                                            style="font-size: 1.2rem !important;"></i> {!! __('dashboard.expiring_contracts') ?? 'Expiring Contracts' !!}
                                    </h5>
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
                                                            <span class="badge badge-light-danger"
                                                                style="border-radius: 6px !important;">{!! $contract->end_date->format('Y-m-d') !!}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center p-4 text-muted">
                                                            {!! __('dashboard.no_expiring_contracts') ?? 'No contracts expiring soon' !!}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Upcoming Cheques --}}
                        <div class="col-md-6">
                            <div class="card premium-card border-0 shadow-sm radius-15">
                                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center"
                                    style="height: 50px;">
                                    <h5 class="card-title mb-0 font-weight-bold" style="font-size: 1.1rem !important;">
                                        <i class="fas fa-money-bill-wave text-info mr-1"
                                            style="font-size: 1.2rem !important;"></i> {!! __('dashboard.upcoming_cheques') ?? 'Upcoming Cheques' !!}
                                    </h5>
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
                                                        <td><span
                                                                class="text-success font-weight-bold">{!! number_format($cheque->amount, 2) !!}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-primary"
                                                                style="border-radius: 6px !important;">{!! $cheque->due_date->format('Y-m-d') !!}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center p-4 text-muted">
                                                            {!! __('dashboard.no_upcoming_cheques') ?? 'No cheques due soon' !!}</td>
                                                    </tr>
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
                    height: 400,
                    width: '100%',
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 1200
                    },
                    fontFamily: 'Cairo, sans-serif'
                },
                colors: ['#4361ee'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
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
                        style: {
                            colors: '#a1aab2'
                        },
                        rotate: -45,
                        rotateAlways: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#a1aab2'
                        },
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
                tooltip: {
                    theme: 'light'
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 300
                        },
                        xaxis: {
                            labels: {
                                rotate: -45,
                                style: {
                                    fontSize: '10px'
                                }
                            }
                        }
                    }
                }]
            };

            if (document.querySelector("#premium-area-chart")) {
                var financialChart = new ApexCharts(document.querySelector("#premium-area-chart"),
                    financialOptions);
                financialChart.render();
                
                // Professional way to ensure chart fills container dynamically
                new ResizeObserver(() => {
                    financialChart.updateOptions({ chart: { width: '100%' } }, false, false);
                }).observe(document.querySelector("#premium-area-chart").parentElement);
            }

            // 2. Occupancy Donut Chart
            var occupancyOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    fontFamily: 'Cairo, sans-serif',
                    animations: {
                        enabled: true
                    }
                },
                colors: ['#2ecc71', '#e0e6ed'],
                series: {!! json_encode($occupancyChart['series']) !!},
                labels: {!! json_encode($occupancyChart['labels']) !!},
                legend: {
                    show: false // Disabled default legend to prevent overlap
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true,
                                    formatter: function(val) {
                                        return val;
                                    }
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
                dataLabels: {
                    enabled: false
                }
            };

            if (document.querySelector("#occupancy-donut-chart")) {
                var occupancyChart = new ApexCharts(document.querySelector("#occupancy-donut-chart"),
                    occupancyOptions);
                occupancyChart.render();

                new ResizeObserver(() => {
                    occupancyChart.updateOptions({ chart: { width: '100%' } }, false, false);
                }).observe(document.querySelector("#occupancy-donut-chart").parentElement);
            }
        });

        function switchDashTab(tabId) {
            // Update button states
            $('.premium-nav-tabs .nav-link').removeClass('active');
            $('#' + tabId + '-tab').addClass('active');

            // Show/hide tab panes
            $('.tab-pane').removeClass('show active');
            $('#' + tabId).addClass('show active');

            // Trigger resize to fix ApexCharts rendering inside tabs
            window.dispatchEvent(new Event('resize'));
        }
    </script>
@endpush
