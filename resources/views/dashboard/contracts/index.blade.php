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
            <div class="content-header row align-items-center mb-2">

                <!-- begin: content header left-->
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb shadow-sm">
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
                    <div class="mb-1 d-flex justify-content-md-end justify-content-start align-items-center" style="gap: 10px;" x-data>
                        <button type="button" @click="$store.privacy.toggle()" class="btn btn-premium-add shadow-pulse">
                            <span class="privacy-icon-show"><i class="fas fa-eye"></i> <span class="ml-1 font-weight-bold">إظهار المبالغ</span></span>
                            <span class="privacy-icon-hide"><i class="fas fa-eye-slash"></i> <span class="ml-1 font-weight-bold">إخفاء المبالغ</span></span>
                        </button>

                        @can('contracts_create')
                        <a href="{!! route('dashboard.contracts.create') !!}" class="btn btn-premium-add shadow-pulse">
                            <i class="fas fa-plus-circle"></i>
                            {!! __('contracts.create_new_contract') !!}
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
                                <h3 class="stat-value privacy-blur-target">{{ $stats['total_contracts'] }}</h3>
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
                                <h3 class="stat-value privacy-blur-target">{{ $stats['active_contracts'] }}</h3>
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
                                <h3 class="stat-value privacy-blur-target" style="white-space: nowrap; direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; display: inline-flex; align-items: center; justify-content: center; gap: 4px;"><span>{!! number_format($stats['total_rent_value'], 0) !!}</span><span style="margin-bottom: 2px;">{!! currency() !!}</span></h3>
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
                                <h3 class="stat-value privacy-blur-target">{{ $stats['expiring_soon'] }}</h3>
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
                                <div class="premium-mandatory-header py-2">
                                    <div class="title-wrapper">
                                        <i class="fas fa-file-invoice"></i> 
                                        <span class="font-weight-bold">{!! __('contracts.contracts') !!}</span>
                                        <span id="contractCountBadge" class="badge badge-primary badge-pill badge-glow ml-2 font-11">{!! $contracts->total() !!}</span>
                                    </div>
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

    <!-- Custom Offcanvas Structure -->
    <div class="offcanvas-backdrop" id="customOffcanvasBackdrop"></div>
    <div class="custom-offcanvas" id="customOffcanvasDetails">
        <div class="custom-offcanvas-header">
            <h5 id="offcanvasTitle">{!! __('contracts.contract_details') ?? 'تفاصيل العقد' !!}</h5>
            <button type="button" class="custom-offcanvas-close" id="closeOffcanvasBtn">&times;</button>
        </div>
        <div class="custom-offcanvas-body" id="offcanvasBody">
            <!-- Details will be injected here -->
        </div>
        <div class="custom-offcanvas-footer" id="offcanvasFooter">
            <!-- Actions will be injected here -->
        </div>
    </div>
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

            // --- Custom Offcanvas Logic ---
            var $offcanvas = $('#customOffcanvasDetails');
            var $backdrop = $('#customOffcanvasBackdrop');

            function openOffcanvas() {
                $offcanvas.addClass('show');
                $backdrop.addClass('show');
                $('body').css('overflow', 'hidden');
            }

            function closeOffcanvas() {
                $offcanvas.removeClass('show');
                $backdrop.removeClass('show');
                $('body').css('overflow', '');
            }

            $('#closeOffcanvasBtn, #customOffcanvasBackdrop').on('click', function() {
                closeOffcanvas();
            });

            // Handle row click (Event Delegation for AJAX loaded tables)
            $('#myTable').on('click', 'tbody tr.premium-table-row', function(e) {
                // Prevent opening if clicking on specific controls
                if ($(e.target).closest('a, button, .details-control').length) {
                    return;
                }

                var $row = $(this);
                
                // Extract details and actions from the hidden divs inside the row
                var detailsHtml = $row.find('.row-details').html();
                var actionsHtml = $row.find('.contract-actions-wrapper').html();

                if (detailsHtml) {
                    // Inject content
                    $('#offcanvasBody').html(detailsHtml);
                    $('#offcanvasFooter').html(actionsHtml);
                    
                    // Open the sidebar
                    openOffcanvas();
                }
            });
        });
    </script>
@endpush


