@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/css/permissions.css') !!}">
    
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- begin: content header -->
            <div class="content-header row">

                <!-- begin: content header left-->
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active font-weight-bold">
                                    {!! __('contracts.contracts') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <a href="{!! route('dashboard.contracts.create') !!}" class="btn btn-premium-add shadow-pulse">
                            <i class="fas fa-plus-circle"></i>
                            {!! __('contracts.create_new_contract') !!}
                        </a>
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
                                <h3 class="stat-value">{{ $stats['total_contracts'] }}</h3>
                                <h6 class="stat-title">{!! __('contracts.contracts') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-file-contract"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-active">
                            <div class="stat-content">
                                <h3 class="stat-value">{{ $stats['active_contracts'] }}</h3>
                                <h6 class="stat-title">{!! __('contracts.active_contracts') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-check-double"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-revenue">
                            <div class="stat-content">
                                <h3 class="stat-value">{!! number_format($stats['total_rent_value'], 0) !!}</h3>
                                <h6 class="stat-title">{!! __('contracts.total_rent_value') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 mb-2">
                        <div class="premium-stat-card h-100 card-expiring">
                            <div class="stat-content">
                                <h3 class="stat-value">{{ $stats['expiring_soon'] }}</h3>
                                <h6 class="stat-title">{!! __('contracts.expiring_soon') !!}</h6>
                            </div>
                            <div class="stat-icon-wrapper">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: stats cards -->
                @include('dashboard.contracts.partials._search')

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card premium-card-anim">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                        <i class="fas fa-file-invoice text-primary mr-2 icon-size-16"></i> 
                                        {!! __('contracts.contracts') !!}
                                        <span id="contractCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11">{!! $contracts->total() !!}</span>
                                    </h6>
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
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay" id="tableLoader">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                @include('dashboard.contracts.partials._table')
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
    @include('dashboard.contracts.modals.details')
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/ajax-table.js') }}"></script>
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable();
            }
            if (typeof initFilterSystem === "function") {
                initFilterSystem();
            }
        });
    </script>
@endpush


