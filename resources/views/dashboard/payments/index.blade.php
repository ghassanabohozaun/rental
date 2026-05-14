@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- begin: content header -->
            <div class="content-header row align-items-center mb-2">
                <!-- begin: content header left-->
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}" class="text-muted">
                                        <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active font-weight-bold">
                                    {!! __('payments.payments') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        @can('payments_create')
                            <a href="{!! route('dashboard.payments.create') !!}" class="btn btn-premium-add shadow-pulse">
                                <i class="fas fa-plus-circle"></i>
                                {!! __('payments.add_payment') !!}
                            </a>
                        @endcan
                    </div>
                </div>
                <!-- end: content header right-->
            </div> <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <!-- begin: stats cards -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-contracts">
                            <div class="stat-content">
                                <h3 class="stat-value">{!! number_format($stats['total_amount'], 0) !!}</h3>
                                <h6 class="stat-title">{!! __('payments.total_collected') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-active">
                            <div class="stat-content">
                                <h3 class="stat-value">{!! number_format($stats['this_month'], 0) !!}</h3>
                                <h6 class="stat-title">{!! __('payments.collected_this_month') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-revenue">
                            <div class="stat-content">
                                <h3 class="stat-value">{!! number_format($stats['cheque_total'], 0) !!}</h3>
                                <h6 class="stat-title">{!! __('payments.cheque_payments') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-university"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-expiring">
                            <div class="stat-content">
                                <h3 class="stat-value">{!! number_format($stats['cash_online_total'], 0) !!}</h3>
                                <h6 class="stat-title">{!! __('payments.cash_online_payments') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: stats cards -->

                @include('dashboard.payments.partials._search')

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card premium-card-anim">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h4 class="card-title text-dark font-weight-bold d-flex align-items-center">
                                        <i class="fas fa-calculator text-primary mr-2" style="font-size: 24px;"></i>
                                        {!! __('payments.payments') !!}
                                        <span id="paymentsCountBadge" class="badge badge-primary badge-pill badge-glow ml-2"
                                            style="font-size: 11px;">{!! $payments->total() !!}</span>
                                    </h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="fas fa-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="fas fa-sync"></i></a></li>
                                            <li><a data-action="expand"><i class="fas fa-expand"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end: card header -->

                                <!-- begin: card content -->
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <!-- Container with Loader -->
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                @include('dashboard.payments.partials._table')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: card content -->
                            </div>
                        </div> <!-- end: card  -->
                    </div><!-- end: row  -->
                </section><!-- end: sections  -->
            </div><!-- end: content body  -->
        </div> <!-- end: content wrapper  -->
    </div><!-- end: content app  -->

    @include('dashboard.payments.modals.details')
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/ajax-table.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize AJAX Table
            if (typeof initIndexTable === "function") {
                initIndexTable();
            }

            // Initialize Modern Filter System
            if (typeof initFilterSystem === "function") {
                initFilterSystem();
            }
        });
    </script>
@endpush


