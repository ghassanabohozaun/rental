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
            <!-- begin: content header -->
            <div class="content-header row">
                <div class="col-12 welcome-section animate-up">
                    <div class="d-flex justify-content-between align-items-end flex-wrap gap-4">
                        <div>
                            <h1 class="welcome-title">{!! greeting() !!}, <span class="text-warning">{!! user()->name !!}</span>! 👋</h1>
                            <p class="mt-1 mb-0" style="font-size: 1.1rem; opacity: 0.85;">{!! __('dashboard.overview_of_performance') ?? 'Here is your system overview.' !!}</p>
                        </div>
                        <div class="welcome-date mb-1">
                            <i class="icon-calendar"></i>
                            {!! date('l, d F Y') !!}
                        </div>
                    </div>
                </div>
            </div> <!-- end :content header -->

            <!-- Premium Tabs Segmented Control -->
            <div class="premium-tabs-wrapper animate-up delay-1 text-center d-flex justify-content-center">
                <ul class="nav nav-pills custom-pills" id="dashboardTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="pill" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                            <i class="la la-pie-chart"></i> {!! __('dashboard.overview') ?? 'Overview' !!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="activity-tab" data-toggle="pill" href="#activity" role="tab" aria-controls="activity" aria-selected="false">
                            <i class="la la-pulse"></i> {!! __('dashboard.activity') ?? 'System Activity' !!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reports-tab" data-toggle="pill" href="#reports" role="tab" aria-controls="reports" aria-selected="false">
                            <i class="la la-file-text"></i> {!! __('dashboard.reports') ?? 'Reports' !!}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content animate-up delay-2" id="dashboardTabsContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    
                    <!-- Ultra Premium Stats Cards -->
                    <div class="row">
                        @if($isSuperAdmin)
                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card card-companies">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-info">{!! $stats['companies_count'] !!}</h3>
                                <h6 class="stat-title">{!! __('companies.companies') !!}</h6>
                                <i class="icon-briefcase stat-icon-floating text-info"></i>
                            </div>
                        </div>
                        @endif

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card card-users">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-success">{!! $stats['users_count'] !!}</h3>
                                <h6 class="stat-title">{!! __('users.users') !!}</h6>
                                <i class="icon-user stat-icon-floating text-success"></i>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card card-departments">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-warning">{!! $stats['departments_count'] !!}</h3>
                                <h6 class="stat-title">{!! __('departments.departments') !!}</h6>
                                <i class="icon-layers stat-icon-floating text-warning"></i>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 mb-2">
                            <div class="premium-stat-card card-roles">
                                <div class="stat-icon-blob"></div>
                                <h3 class="stat-value text-danger">{!! $stats['roles_count'] !!}</h3>
                                <h6 class="stat-title">{!! __('roles.roles') !!}</h6>
                                <i class="icon-lock stat-icon-floating text-danger"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Premium Chart Row -->
                    <div class="row mt-3 animate-up delay-3">
                        <div class="col-12">
                            <div class="card premium-chart-card">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="la la-line-chart text-primary"></i> {!! __('dashboard.system_statistics') ?? 'Activity Trend' !!}</h4>
                                    <p class="text-muted mb-0 mt-1">{!! __('dashboard.monthly_overview') ?? 'Monthly system activity and engagement overview' !!}</p>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div id="premium-area-chart" class="height-350"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Activity Tab (Placeholder) -->
                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <div class="card premium-card border-0 shadow-sm mt-3">
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="icon-graph text-muted" style="font-size: 6rem; opacity: 0.3;"></i>
                            </div>
                            <h4 class="text-muted">{!! __('dashboard.no_recent_activity') !!}</h4>
                        </div>
                    </div>
                </div>

                <!-- Reports Tab (Placeholder) -->
                <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                    <div class="card premium-card border-0 shadow-sm mt-3">
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="icon-docs text-muted" style="font-size: 6rem; opacity: 0.3;"></i>
                            </div>
                            <h4 class="text-muted">{!! __('dashboard.reports_empty') !!}</h4>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- end: content wrapper  -->
    </div><!-- end: content app  -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var isRtl = $('html').attr('data-textdirection') === 'rtl';
            
            // Premium Smooth Area Chart Options
            var options = {
                chart: {
                    type: 'area',
                    height: 380,
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 1200,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    },
                    fontFamily: 'Cairo, sans-serif'
                },
                colors: ['#4361ee', '#2ecc71'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    lineCap: 'round'
                },
                series: [{
                    name: "{!! __('users.users') !!}",
                    data: {!! json_encode($chartData['users']) !!}
                }, {
                    name: "{!! __('departments.departments') !!}",
                    data: {!! json_encode($chartData['departments']) !!}
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
                    categories: {!! json_encode($chartData['categories']) !!},
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: { style: { colors: '#a1aab2' } }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#a1aab2' },
                        offsetX: isRtl ? -15 : 0
                    }
                },
                grid: {
                    borderColor: 'rgba(0,0,0,0.05)',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } },
                    xaxis: { lines: { show: false } },
                    padding: { top: 0, right: 0, bottom: 0, left: 10 }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -20,
                    itemMargin: { horizontal: 10, vertical: 0 }
                },
                tooltip: {
                    theme: 'light',
                    y: { formatter: function (val) { return val + " " + "{!! __('dashboard.records') ?? 'Records' !!}" } }
                }
            };

            var chart = new ApexCharts(document.querySelector("#premium-area-chart"), options);
            chart.render();
        });
    </script>
@endpush
