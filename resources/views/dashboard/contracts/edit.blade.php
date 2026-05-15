@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/vendors/css/pickers/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link href="{!! asset('vendor/summernote/summernote-bs4.css') !!}" rel="stylesheet">
    
@endpush

@section('content')
    <div class="app-content content">
        <form class="form ajax-form" id='myForm' action="{!! route('dashboard.contracts.update', $contract->id) !!}" method="post" enctype="multipart/form-data"
            novalidate autocomplete="off" data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="redirect"
            data-redirect-url="{!! route('dashboard.contracts.index') !!}">
            @csrf
            @method('PUT')
            <div class="content-wrapper">
                <!-- begin: content header -->
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb premium-breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.index') !!}">
                                            <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{!! route('dashboard.contracts.index') !!}">
                                            {!! __('contracts.contracts') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {!! __('contracts.update_contract') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
                        <div class="d-flex justify-content-md-end justify-content-center gap-2">
                            <a href="{!! route('dashboard.contracts.index') !!}" class="btn-premium-back">
                                <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                            </a>
                            <button class="btn btn-premium-save" type="submit" id="saveBtn">
                                <i class="fas fa-save mr-2"></i>
                                {!! __('general.save') !!}
                                <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end :content header -->

                <!-- begin: content body -->
                <div class="content-body">
                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card premium-card shadow-lg border-0 premium-card-anim">
                                    <div class="card-header border-0 pb-0">
                                        <h6 class="card-title text-dark font-weight-bold d-flex align-items-center">
                                            <i class="fas fa-edit text-primary mr-2 icon-size-16"></i> 
                                            {!! __('contracts.update_contract') !!}
                                        </h6>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body pt-1">
                                            <!-- Elite Floating Tabs Navigation -->
                                            <div class="d-flex justify-content-center w-100 mb-2">
                                                <ul class="nav premium-nav-tabs" id="contractTabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" data-text="{!! __('contracts.basic_details_tab') !!}">
                                                            <i class="fas fa-info-circle"></i> {!! __('contracts.basic_details_tab') !!}
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="terms-tab" data-toggle="tab" href="#terms" role="tab" data-text="{!! __('contracts.contract_terms_tab') !!}">
                                                            <i class="fas fa-file-invoice"></i> {!! __('contracts.contract_terms_tab') !!}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end: Tabs Navigation -->

                                            <div class="tab-content tab-content-premium" id="contractTabsContent">
                                                <!-- Tab 1: Basic & Financial Details -->
                                                <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                                    <div class="form-body">

                                                    @include('dashboard.contracts.edit._basic')
                                                </div> <!-- end: form-body (basic) -->
                                            </div> <!-- end: tab-pane (basic) -->

                                            <!-- Tab 2: Contract Terms & Notes -->
                                            <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                                                <div class="form-body">
                                                    @include('dashboard.contracts.edit._terms')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('dashboard.contracts.edit._cheques_list')
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Ensure tabs work correctly by explicitly calling tab('show')
            $('#contractTabs .premium-tab-btn').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
                
                // Handle active class for premium buttons
                $('#contractTabs .premium-tab-btn').removeClass('active');
                $(this).addClass('active');
            });

            // Fix Summernote issues in hidden tabs
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                if($(e.target).attr('id') == 'terms-tab') {
                    $('.summernote').each(function() {
                        $(this).summernote('resize');
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });

            // Initialize Autocomplete Select2
            $('.js-autocomplete').each(function() {
                let url = $(this).data('url');
                let placeholder = $(this).data('placeholder');
                initGenericSelect2(this, url, placeholder);
            });

            // Initialize Property AJAX Select2 with Company dependency
            $('#property_id.select2-ajax').select2({
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr',
                ajax: {
                    url: function() { return $(this).data('url'); },
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            company_id: $('#company_id').val(),
                            only_available: 1,
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: $('#property_id').data('placeholder'),
                minimumInputLength: 0,
            });

            // Reset property if company changes (but keep initial if same company)
            let initialCompanyId = $('#company_id').val();
            $('#company_id').on('change', function() {
                let companyId = $(this).val();
                if (companyId != initialCompanyId) {
                    $('#property_id').val(null).trigger('change');
                    $('#customer_id').val(null).trigger('change');
                }

                if (companyId) {
                    $('#property_id, #customer_id').prop('disabled', false);
                } else {
                    $('#property_id, #customer_id').prop('disabled', true);
                }
            });

            // Initialize Customer AJAX Select2 with Company dependency
            $('#customer_id.select2-ajax').select2({
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr',
                ajax: {
                    url: function() {
                        return $(this).data('url');
                    },
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            company_id: $('#company_id').val(),
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: $('#customer_id').data('placeholder'),
                minimumInputLength: 0,
            });

            // Sync Start and End Date (Frontend Validation)
            $('#start_date').on('changeDate', function(e) {
                if (e.date) {
                    $('#end_date').datepicker('setStartDate', e.date);
                }
            });
            $('#end_date').on('changeDate', function(e) {
                if (e.date) {
                    $('#start_date').datepicker('setEndDate', e.date);
                }
            });

            // Toggle Insurance Cheque Details
            function toggleChequeDetails() {
                let depositType = $('#deposit_type').val();
                
                if (depositType === 'cheque') {
                    $('.cheque-details-section').slideDown(150);
                } else {
                    $('.cheque-details-section').slideUp(150);
                }
            }

            $('#deposit_amount').on('input change', toggleChequeDetails);
            $('#deposit_amount').on('blur', function() {
                if ($(this).val() === '') {
                    $(this).val(0);
                }
            });
            $('#deposit_type').on('change', function() {
                toggleChequeDetails();
                if ($(this).val() === 'cash') {
                    $('#deposit_status').val('held').trigger('change');
                }
            });
            
            // Initial check on load (for validation errors repopulation)
            toggleChequeDetails();
        });
    </script>
@endpush



@push('scripts')
    <script src="{!! asset('vendor/summernote/summernote.js') !!}"></script>
    <script>
        $(document).ready(function() {
            // Summernote initialization
            if ($('.summernote').length > 0) {
                if (typeof $.fn.summernote !== 'undefined') {
                    $('.summernote').summernote({
                        height: 250,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph', 'height']],
                            ['table', ['table']],
                            ['insert', ['link', 'hr']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                }
            }
        });
    </script>
@endpush


