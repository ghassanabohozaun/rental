@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/dashbaord/css/permissions.css') !!}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/ajax-table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/filter.css') }}">
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
                                    {!! __('properties.properties') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12">
                    <div class="float-md-right mb-1">
                        <a href="{!! route('dashboard.properties.create') !!}" class="btn btn-premium-add shadow-pulse">
                            <i class="fas fa-plus-circle"></i>
                            {!! __('properties.create_new_property') !!}
                        </a>
                    </div>
                </div>
                <!-- end: content header right-->

            </div> <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <!-- begin: Quick Stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card premium-card premium-stat-card mb-2">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="stat-value text-primary font-weight-bold mb-0">
                                            {{ $total_count }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('properties.properties') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(30, 159, 242, 0.1);">
                                        <i class="fas fa-building text-primary font-large-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card premium-card premium-stat-card mb-2">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="stat-value text-success font-weight-bold mb-0">
                                            {{ $available_count ?? 0 }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('properties.available') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(40, 208, 148, 0.1);">
                                        <i class="fas fa-check-circle text-success font-large-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card premium-card premium-stat-card mb-2">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="stat-value text-danger font-weight-bold mb-0">
                                            {{ $rented_count ?? 0 }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('properties.rented') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(255, 73, 97, 0.1);">
                                        <i class="fas fa-key text-danger font-large-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card premium-card premium-stat-card mb-2">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="stat-value text-warning font-weight-bold mb-0">
                                            {{ $maintenance_count ?? 0 }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('properties.status_maintenance') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(255, 145, 73, 0.1);">
                                        <i class="fas fa-tools text-warning font-large-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Quick Stats -->

                @include('dashboard.properties.partials._search')

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                    <div class="card-header border-0 pb-0">
                                        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                            <i class="fas fa-building text-primary mr-2 icon-size-16"></i> 
                                            {!! __('properties.properties') !!}
                                            <span id="propertyCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11">{!! $properties->total() !!}</span>
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
                                                @include('dashboard.properties.partials._table')
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
    @include('dashboard.properties.modals.details')
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
