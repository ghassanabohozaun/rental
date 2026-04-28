@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/ajax-table.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row align-items-center mb-2">
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb shadow-sm">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        <i class="la la-home mr-1"></i> {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <i class="la la-briefcase mr-1 pointer-events-none"></i> {!! __('departments.departments') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        <button type="button" class="btn btn-premium-add shadow-pulse h-42 radius-10" data-toggle="modal"
                            data-target="#createDepartmentModal">
                            <i class="la la-plus-circle mr-1"></i>
                            {!! __('departments.create_new_department') !!}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search Filters (Moved standalone out) -->
            @include('dashboard.departments.partials._search')

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h4 class="card-title text-dark font-weight-bold d-flex align-items-center">
                                        <i class="la la-briefcase text-primary mr-2 font-24"></i>
                                        {!! __('departments.departments') !!}
                                        <span
                                            class="badge badge-primary badge-pill badge-glow ml-2 font-11">{!! $departments->total() !!}</span>
                                    </h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="la la-refresh"></i></a></li>
                                            <li><a data-action="expand"><i class="la la-expand"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end: card header -->
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0">
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay" id="tableLoader">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                @include('dashboard.departments.partials._table')
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

    @include('dashboard.departments.modals.create')

    @include('dashboard.departments.modals.edit')

    @include('dashboard.departments.modals.details')
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/ajax-table.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if (typeof initIndexTable === "function") {
                initIndexTable({
                    detailsModal: "#detailsDepartmentModal",
                    detailsModalBody: "#detailsDepartmentModalBody"
                });
            }
        });

        // change status
        $(document).on('change', '.change_status', function(e) {
            // e.preventDefault();
            var id = $(this).data('id');

            if ($(this).is(':checked')) {
                statusSwitch = 1;
            } else {
                statusSwitch = 0;
            }


            $.ajax({
                url: "{{ route('dashboard.departments.change.status') }}",
                data: {
                    statusSwitch: statusSwitch,
                    id: id
                },
                type: 'post',
                dataType: 'JSON',
                success: function(data) {

                    $('.department_status_' + data.data.id).empty();
                    $('.department_status_' + data.data.id).removeClass('badge-danger');
                    $('.department_status_' + data.data.id).removeClass('badge-success');
                    if (data.data.status == 1) {
                        $('.department_status_' + data.data.id).addClass('badge-success');
                        $('.department_status_' + data.data.id).text("{!! __('general.enable') !!}");
                    } else if (data.data.status == '') {
                        $('.department_status_' + data.data.id).addClass('badge-danger');
                        $('.department_status_' + data.data.id).text("{!! __('general.disabled') !!}");
                    }

                    if (data.status === true) {
                        flasher.success("{!! __('general.change_status_success_message') !!}");
                    } else {
                        flasher.error("{!! __('general.change_status_error_message') !!}");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        flasher.error("{!! __('dashboard.access_denied') !!}");
                        // Revert switch state
                        var checkbox = $('#status_' + id);
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    } else {
                        flasher.error("{!! __('general.try_catch_error_message') !!}");
                    }
                }
            });

        });
    </script>
@endpush
