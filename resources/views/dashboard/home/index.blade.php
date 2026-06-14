@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper mt-n2 dashboard-revolution-wrapper">

            <!-- 1. Integrated Company & Welcome Banner -->
            <div class="row animate-up mt-n1">
                <div class="col-12">
                    <div class="company-identity-banner card border-0 shadow-sm"
                        style="border-radius: 15px; overflow: hidden;">
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

            <!-- 2. Quick Actions Bar -->
            <div class="quick-actions-bar animate-up mt-2">
                @can('contracts_create')
                    <a href="{!! route('dashboard.contracts.create') !!}" class="btn-quick-action btn-qa-contract">
                        <i class="fas fa-file-signature"></i> {!! __('contracts.add_contract') !!}
                    </a>
                @endcan
                @can('properties_create')
                    <a href="{!! route('dashboard.properties.create') !!}" class="btn-quick-action btn-qa-property">
                        <i class="fas fa-building"></i> {!! __('properties.create_new_property') !!}
                    </a>
                @endcan
                @can('customers_create')
                    <a href="{!! route('dashboard.customers.create') !!}" class="btn-quick-action btn-qa-customer">
                        <i class="fas fa-user-plus"></i> {!! __('customers.add_customer') !!}
                    </a>
                @endcan
                @can('payments_create')
                    <a href="{!! route('dashboard.payments.create') !!}" class="btn-quick-action btn-qa-payment">
                        <i class="fas fa-hand-holding-usd"></i> {!! __('payments.add_payment') !!}
                    </a>
                @endcan
                @can('cheques_create')
                    <a href="{!! route('dashboard.cheques.import') !!}" class="btn-quick-action btn-qa-cheque">
                        <i class="fas fa-file-import"></i> {!! __('cheques.import_cheques') !!}
                    </a>
                @endcan
            </div>

            <!-- 3. Ultra Premium Stats Cards -->
            <div class="row d-flex align-items-stretch revolutionary-stats-container animate-up mt-2">
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
                            <h3 class="stat-value">{!! number_format($stats['total_payments'], 0) !!} <span
                                    style="font-size: 1rem;">{!! currency() !!}</span></h3>
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
                                <h3 class="stat-value">{!! number_format($stats['pending_cheques_value'], 0) !!} <span
                                        style="font-size: 1rem;">{!! currency() !!}</span></h3>
                                <h6 class="stat-title">{!! __('cheques.pending_cheques') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 3. Smart Alerts Section (The Core of the Revolution) -->
            <div class="row animate-up">
                <!-- Actionable Cheques -->
                <div class="col-xl-6 col-12 mb-3">
                    <div class="premium-glass-card h-100">
                        <div class="alert-header-gradient d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 font-weight-bold text-dark">
                                <i class="fas fa-exclamation-triangle text-danger mr-2"></i> {!! __('dashboard.actionable_cheques') ?? 'شيكات تتطلب إجراء' !!}
                            </h5>
                            <span class="badge badge-danger badge-pill">{{ $actionableCheques->count() }}</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollable-table-container">
                                <div class="table-responsive">
                                <table class="table actionable-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>{!! __('cheques.cheque_number') !!}</th>
                                            <th>{!! __('cheques.amount') !!}</th>
                                            <th>{!! __('cheques.due_date') !!}</th>
                                            <th class="text-center">{!! __('general.actions') !!}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($actionableCheques as $cheque)
                                            <tr>
                                                <td>
                                                    <div class="font-weight-bold text-dark">#{!! $cheque->cheque_number !!}</div>
                                                    <small class="text-muted">{!! optional($cheque->customer)->name !!}</small>
                                                </td>
                                                <td>
                                                    <span class="text-success font-weight-bold">{!! number_format($cheque->amount, 0) !!}
                                                        {!! currency() !!}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $isOverdue = $cheque->due_date < now()->startOfDay();
                                                    @endphp
                                                    <span
                                                        class="{{ $isOverdue ? 'status-badge-urgent' : 'status-badge-upcoming' }}">
                                                        {!! $cheque->due_date->format('Y-m-d') !!}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @can('cheques_update')
                                                        <a href="{!! route('dashboard.cheques.edit', $cheque->id) !!}"
                                                            class="btn-mini-action btn-mini-success ml-1"
                                                            title="{!! __('general.edit') !!}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        {{-- Return Cheque --}}
                                                        <a href="javascript:void(0)"
                                                            class="btn-mini-action btn-mini-warning btn-return-cheque ml-1"
                                                            data-id="{!! $cheque->id !!}" title="{!! __('cheques.return_cheque') !!}">
                                                            <i class="fas fa-undo"></i>
                                                        </a>

                                                        @if ($cheque->is_deposit)
                                                            {{-- Cash Insurance Cheque --}}
                                                            <a href="javascript:void(0)"
                                                                class="btn-mini-action btn-mini-success btn-cash-cheque ml-1"
                                                                data-id="{!! $cheque->id !!}"
                                                                title="{!! __('cheques.cash_cheque') !!}">
                                                                <i class="fas fa-money-bill-wave"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center p-5 text-muted">
                                                    <i class="fas fa-check-circle text-success mb-2"
                                                        style="font-size: 2rem;"></i><br>
                                                    {!! __('dashboard.no_actionable_cheques') ?? 'لا يوجد شيكات متأخرة أو مستحقة قريباً. العمل ممتاز!' !!}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expiring Contracts -->
                <div class="col-xl-6 col-12 mb-3">
                    <div class="premium-glass-card h-100">
                        <div class="alert-header-gradient d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 font-weight-bold text-dark">
                                <i class="fas fa-file-signature text-warning mr-2"></i> {!! __('dashboard.expiring_contracts') ?? 'عقود تنتهي قريباً (60 يوماً)' !!}
                            </h5>
                            <span class="badge badge-warning badge-pill">{{ $expiringContracts->count() }}</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollable-table-container">
                                <div class="table-responsive">
                                <table class="table actionable-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>{!! __('customers.customer') !!}</th>
                                            <th>{!! __('properties.property') !!}</th>
                                            <th>{!! __('contracts.end_date') !!}</th>
                                            <th class="text-center">{!! __('general.actions') !!}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($expiringContracts as $contract)
                                            <tr>
                                                <td>
                                                    <div class="font-weight-bold text-dark">{!! optional($contract->customer)->name !!}</div>
                                                    <small class="text-muted">{!! optional($contract->customer)->phone !!}</small>
                                                </td>
                                                <td>{!! optional($contract->property)->name !!}</td>
                                                <td>
                                                    <span class="badge badge-light-warning"
                                                        style="font-size: 0.8rem; padding: 5px 10px;">
                                                        {!! $contract->end_date->format('Y-m-d') !!}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{!! route('dashboard.contracts.show', $contract->id) !!}"
                                                        class="btn-mini-action bg-white border border-secondary"
                                                        title="{!! __('general.show') !!}">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </a>
                                                    @can('contracts_update')
                                                        <a href="{!! route('dashboard.contracts.edit', $contract->id) !!}"
                                                            class="btn-mini-action btn-mini-success ml-1"
                                                            title="{!! __('general.edit') !!}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center p-5 text-muted">
                                                    <i class="fas fa-shield-check text-success mb-2"
                                                        style="font-size: 2rem;"></i><br>
                                                    {!! __('dashboard.no_expiring_contracts') ?? 'لا يوجد عقود تنتهي خلال الـ 60 يوماً القادمة.' !!}
                                                </td>
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

            <!-- 5. Premium Chart Row -->
            <div class="row mt-1 animate-up mb-5">
                <div class="col-lg-8">
                    <div class="card premium-chart-card h-100">
                        <div class="card-header border-0 pb-0 pt-3 px-3">
                            <h4 class="card-title font-weight-bold" style="font-size: 1.1rem;"><i
                                    class="fas fa-chart-line text-primary mr-2"></i>
                                {!! __('dashboard.financial_trend') ?? 'Financial Trend' !!}</h4>
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
                        <div class="card-header border-0 pb-0 pt-3 px-3">
                            <h4 class="card-title font-weight-bold" style="font-size: 1.1rem;"><i
                                    class="fas fa-chart-pie text-success mr-2"></i>
                                {!! __('dashboard.occupancy_rate') ?? 'Occupancy Rate' !!}</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body pt-0 d-flex flex-column align-items-center justify-content-center">
                                <div id="occupancy-donut-chart" class="height-300 w-100"></div>
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

        </div> <!-- end: content wrapper  -->
    </div><!-- end: content app  -->
@endsection

@push('scripts')
    <!-- ApexCharts Vendor JS -->
    <script src="{!! asset('assets/dashbaord/vendors/js/charts/apexcharts.min.js') !!}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var isRtl = $('html').attr('data-textdirection') === 'rtl';

            // Action Buttons Logic
            // Return Cheque Action
            $(document).on('click', '.btn-return-cheque', function() {
                let btn = $(this);
                let chequeId = btn.attr('data-id');
                swal({
                    title: '{!! __('cheques.confirm_return_title') !!}',
                    text: '{!! __('cheques.confirm_return_text') !!}',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: '{!! __('general.no') !!}',
                            visible: true,
                            closeModal: true
                        },
                        confirm: {
                            text: '{!! __('general.yes') !!}',
                            value: true,
                            visible: true,
                            className: "btn-warning",
                            closeModal: false
                        }
                    }
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('dashboard.cheques.return', ':id') }}".replace(
                                ':id', chequeId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    swal.stopLoading();
                                    swal.close();
                                    if (typeof flasher !== 'undefined') {
                                        flasher.success(response.message);
                                    }
                                    setTimeout(() => window.location.reload(), 1000);
                                } else {
                                    swal.stopLoading();
                                    swal.close();
                                    if (typeof flasher !== 'undefined') {
                                        flasher.error(response.message);
                                    }
                                }
                            },
                            error: function(xhr) {
                                swal.stopLoading();
                                swal.close();
                                if (typeof flasher !== 'undefined') {
                                    flasher.error(xhr.responseJSON ? xhr.responseJSON
                                        .message : 'Error');
                                }
                            }
                        });
                    }
                });
            });

            // Cash Cheque Action
            $(document).on('click', '.btn-cash-cheque', function() {
                let btn = $(this);
                let chequeId = btn.attr('data-id');
                swal({
                    title: '{!! __('cheques.confirm_cash_title') !!}',
                    text: '{!! __('cheques.confirm_cash_text') !!}',
                    icon: 'info',
                    buttons: {
                        cancel: {
                            text: '{!! __('general.no') !!}',
                            visible: true,
                            closeModal: true
                        },
                        confirm: {
                            text: '{!! __('general.yes') !!}',
                            value: true,
                            visible: true,
                            className: "btn-success",
                            closeModal: false
                        }
                    }
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('dashboard.cheques.cash', ':id') }}".replace(
                                ':id', chequeId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    swal.stopLoading();
                                    swal.close();
                                    if (typeof flasher !== 'undefined') {
                                        flasher.success(response.message);
                                    }
                                    setTimeout(() => window.location.reload(), 1000);
                                } else {
                                    swal.stopLoading();
                                    swal.close();
                                    if (typeof flasher !== 'undefined') {
                                        flasher.error(response.message);
                                    }
                                }
                            },
                            error: function(xhr) {
                                swal.stopLoading();
                                swal.close();
                                if (typeof flasher !== 'undefined') {
                                    flasher.error(xhr.responseJSON ? xhr.responseJSON
                                        .message : 'Error');
                                }
                            }
                        });
                    }
                });
            });

            // Charts
            var financialOptions = {
                chart: {
                    type: 'area',
                    height: 350,
                    width: '100%',
                    toolbar: {
                        show: false
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
                        rotate: -45
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
                }
            };

            if (document.querySelector("#premium-area-chart")) {
                var financialChart = new ApexCharts(document.querySelector("#premium-area-chart"),
                    financialOptions);
                financialChart.render();
            }

            var occupancyOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    fontFamily: 'Cairo, sans-serif'
                },
                colors: ['#2ecc71', '#e0e6ed'],
                series: {!! json_encode($occupancyChart['series']) !!},
                labels: {!! json_encode($occupancyChart['labels']) !!},
                legend: {
                    position: 'bottom'
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
                                    show: true
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
            }
        });
    </script>
@endpush
