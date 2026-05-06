@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
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
                                    {!! __('users.users') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <button type="button" class="btn btn-premium-add shadow-pulse" data-toggle="modal"
                            data-target="#createUserModal">
                            <i class="fas fa-plus-circle"></i>
                            {!! __('users.create_new_user') !!}
                        </button>
                    </div>
                </div>
                <!-- end: content header right-->
            </div> <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <!-- begin: stats cards -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card premium-card premium-stat-card mb-2">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="stat-value text-primary font-weight-bold mb-0">
                                            {{ $stats['total_users'] }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('users.users') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(30, 159, 242, 0.1);">
                                        <i class="fas fa-users text-primary font-large-2"></i>
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
                                            {{ $stats['active_users'] }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('users.active_users') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(40, 208, 148, 0.1);">
                                        <i class="fas fa-user-check text-success font-large-2"></i>
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
                                        <h3 class="stat-value text-info font-weight-bold mb-0">
                                            {{ $stats['managers'] }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('users.managers') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(0, 207, 221, 0.1);">
                                        <i class="fas fa-user-shield text-info font-large-2"></i>
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
                                            {{ $stats['super_users'] }}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('users.super_users') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(255, 145, 73, 0.1);">
                                        <i class="fas fa-user-tie text-warning font-large-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: stats cards -->
                @include('dashboard.users.partials._search')

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                        <i class="fas fa-users text-primary mr-2 icon-size-16"></i>
                                        {!! __('users.users') !!}
                                        <span id="usersCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11">{!! $users->total() !!}</span>
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
                                        <!-- Container with Loader -->
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                @include('dashboard.users.partials._table')
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
    @include('dashboard.users.modals.create')
    @include('dashboard.users.modals.edit')

    @include('dashboard.users.modals.details')
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/ajax-table.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize AJAX Table
            if (typeof initIndexTable === "function") {
                initIndexTable({
                    container: '#table_data',
                    loader: '.table-loader-overlay',
                    detailsControl: '.details-control'
                });
            }

            // Initialize Modern Filter System
            if (typeof initFilterSystem === "function") {
                initFilterSystem();
            }

            // Status Change Handler (preserving existing logic)
            $('body').on('change', '.change_status', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var statusSwitch = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('dashboard.users.change.status') }}",
                    data: {
                        statusSwitch: statusSwitch,
                        id: id
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function(data) {
                        $('.user_status_' + data.data.id).empty();
                        $('.user_status_' + data.data.id).removeClass(
                            'badge-danger badge-success');
                        if (data.data.status == 1) {
                            $('.user_status_' + data.data.id)
                                .addClass('badge-pill badge-glow badge-success')
                                .css({
                                    'font-size': '11px',
                                    'padding': '4px 10px'
                                })
                                .text("{!! __('general.enable') !!}");
                        } else {
                            $('.user_status_' + data.data.id)
                                .addClass('badge-pill badge-glow badge-danger')
                                .css({
                                    'font-size': '11px',
                                    'padding': '4px 10px'
                                })
                                .text("{!! __('general.disabled') !!}");
                        }
                        if (data.status === true) {
                            flasher.success("{!! __('general.change_status_success_message') !!}");
                        } else {
                            flasher.error("{!! __('general.change_status_error_message') !!}");
                        }
                    }
                });
            });
        });
    </script>
@endpush
