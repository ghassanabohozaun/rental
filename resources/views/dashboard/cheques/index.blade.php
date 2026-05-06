@extends('layouts.dashboard.app')

@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/ajax-table.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/filter.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/vendors/css/pickers/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/cheques-premium.css') }}?v={{ time() }}">
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
                                    {!! __('cheques.cheques') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: content header left-->

                <!-- begin: content header right-->
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="mb-1">
                        @can('cheques_create')
                            <a href="{!! route('dashboard.cheques.create') !!}" id="addChequeBtn" class="btn btn-premium-add shadow-pulse">
                                <i class="fas fa-plus-circle"></i>
                                {!! __('cheques.add_cheque') !!}
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
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card premium-card premium-stat-card mb-2">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="stat-value text-primary font-weight-bold mb-0">
                                            {!! number_format($stats['total_amount'], 0) !!}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('cheques.total_amount') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(30, 159, 242, 0.1);">
                                        <i class="fas fa-money-check-alt text-primary font-large-2"></i>
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
                                            {!! number_format($stats['rent_total'], 0) !!}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('cheques.rent_cheques_total') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(40, 208, 148, 0.1);">
                                        <i class="fas fa-home text-success font-large-2"></i>
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
                                            {!! number_format($stats['insurance_total'], 0) !!}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('cheques.insurance_cheques_total') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(0, 207, 221, 0.1);">
                                        <i class="fas fa-shield-alt text-info font-large-2"></i>
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
                                            {!! number_format($stats['cashed_total'], 0) !!}
                                        </h3>
                                        <span class="stat-label text-muted">{!! __('cheques.cashed_total') !!}</span>
                                    </div>
                                    <div class="align-self-center stat-icon-wrapper" style="background: rgba(255, 145, 73, 0.1);">
                                        <i class="fas fa-wallet text-warning font-large-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: stats cards -->
                @include('dashboard.cheques.partials._search')

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card premium-card">
                                <!-- begin: card header -->
                                <div class="card-header border-0 pb-0">
                                    <h6 class="card-title text-dark font-weight-bold d-flex align-items-center mb-0">
                                        <i class="fas fa-book text-primary mr-2 icon-size-16"></i>
                                        {!! __('cheques.cheques') !!}
                                        <span id="chequesCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11">{!! $cheques->total() !!}</span>
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
                                
                                <!-- Premium Segmented Control Tabs -->
                                <div class="card-header border-bottom px-0 pt-0 mx-2 pb-3 text-center">
                                    <div class="premium-segmented-control">
                                        <button type="button" class="premium-tab-btn active" id="rent-cheques-tab" onclick="applyTabFilter(0)">
                                            <i class="fas fa-money-bill-wave"></i> {!! __('cheques.rent_cheques') !!}
                                        </button>
                                        <button type="button" class="premium-tab-btn" id="insurance-cheques-tab" onclick="applyTabFilter(1)">
                                            <i class="fas fa-shield-alt"></i> {!! __('cheques.insurance_cheques') !!}
                                        </button>
                                    </div>
                                </div>

                                <!-- begin: card content -->
                                <div class="card-content collapse show">
                                    <div class="card-body pt-2">
                                        <!-- Container with Loader -->
                                        <div class="table-loader-container">
                                            <div class="table-loader-overlay">
                                                <span class="premium-loader"></span>
                                            </div>
                                            <div id="table_data">
                                                @include('dashboard.cheques.partials._table')
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

    @include('dashboard.cheques.modals.details')
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/ajax-table.js') }}"></script>
    <script type="text/javascript">
        function applyTabFilter(isDeposit, trigger = true) {
            // Change tab visual state
            if (isDeposit == 1) {
                $('#rent-cheques-tab').removeClass('active');
                $('#insurance-cheques-tab').addClass('active');
            } else {
                $('#insurance-cheques-tab').removeClass('active');
                $('#rent-cheques-tab').addClass('active');
            }

            // Update Add Cheque Button URL to maintain context
            let addBtn = $('#addChequeBtn');
            if(addBtn.length) {
                let baseUrl = "{!! route('dashboard.cheques.create') !!}";
                addBtn.attr('href', baseUrl + '?is_deposit=' + isDeposit);
            }

            // Set hidden filter input if exists, or append to form
            let filterSelect = $('#filter_is_deposit');
            if(filterSelect.length) {
                filterSelect.val(isDeposit).trigger('change');
                if (trigger) {
                    $('.js-filter-form .js-apply-filter').first().trigger('click');
                }
            }
        }

        $(document).ready(function() {
            // Initialize AJAX Table
            if (typeof initIndexTable === "function") {
                initIndexTable();
            }

            // Initialize Modern Filter System
            if (typeof initFilterSystem === "function") {
                initFilterSystem();
            }
            
            // Set initial tab based on current filter state (server-side set)
            let currentIsDeposit = "{!! request('is_deposit', 0) !!}";
            applyTabFilter(currentIsDeposit, false);

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
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
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
                            url: "{{ route('dashboard.cheques.return', ':id') }}".replace(':id', chequeId),
                            type: 'POST',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                if(response.status) {
                                    swal.stopLoading();
                                    swal.close();
                                    if (typeof flasher !== 'undefined') {
                                        flasher.success(response.message);
                                    }
                                    $('.js-filter-form').submit(); // Standard reload via filter form
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
                                    flasher.error(xhr.responseJSON ? xhr.responseJSON.message : 'Error processing request');
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
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
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
                            url: "{{ route('dashboard.cheques.cash', ':id') }}".replace(':id', chequeId),
                            type: 'POST',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                if(response.status) {
                                    swal.stopLoading();
                                    swal.close();
                                    if (typeof flasher !== 'undefined') {
                                        flasher.success(response.message);
                                    }
                                    $('.js-filter-form').submit(); // Standard reload via filter form
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
                                    flasher.error(xhr.responseJSON ? xhr.responseJSON.message : 'Error processing request');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
