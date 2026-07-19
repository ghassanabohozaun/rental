@extends('layouts.dashboard.app')
@section('title')
    {!! $title !!}
@endsection

@push('style')
    <link rel="stylesheet"
        href="{{ asset('assets/dashbaord/vendors/css/pickers/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <form class="form ajax-form" id='myForm' action="{!! route('dashboard.maintenances.store') !!}" method="post" enctype="multipart/form-data"
            novalidate autocomplete="off" data-success-msg="{!! __('general.add_success_message') !!}" data-success-action="redirect"
            data-redirect-url="{!! route('dashboard.maintenances.index') !!}">
            @csrf
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
                                        <a href="{!! route('dashboard.maintenances.index') !!}">
                                            {!! __('maintenances.maintenances') !!}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        {!! __('maintenances.create_maintenance') !!}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
                        <div class="d-flex justify-content-md-end justify-content-center gap-2">
                            <a href="{!! route('dashboard.maintenances.index') !!}" class="btn-premium-back">
                                <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                            </a>
                            <button class="btn btn-premium-save" type="submit" id="saveBtn">
                                <i class="fas fa-save mr-2 save-icon"></i>
                                <i class="fas fa-spinner fa-spin spinner_loading d-none mr-2"></i>
                                {!! __('general.save') !!}
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
                                    <div class="property-mandatory-header">
                                        <div class="title-wrapper">
                                            <i class="fas fa-tools"></i>
                                            <span>{!! __('maintenances.create_maintenance') !!}</span>
                                        </div>
                                    </div>

                                    <div class="card-content collapse show">
                                        <div class="card-body pt-3">
                                            
                                            @if (user()->company_id == 1)
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="company_id" class="premium-label">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                                            <select id="company_id" name="company_id" class="form-control premium-input shadow-none select2">
                                                                <option value="" selected>{!! __('companies.choose_company') !!}</option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger error-text company_id_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <div class="premium-form-group">
                                                        <label for="property_id" class="premium-label">{!! __('maintenances.property') !!} <span class="text-danger">*</span></label>
                                                        <select id="property_id" name="property_id" class="form-control premium-input shadow-none select2-ajax" data-url="{!! route('dashboard.properties.autocomplete') !!}" data-placeholder="{!! __('properties.choose_property') !!}" @if(user()->company_id == 1) disabled @endif>
                                                        </select>
                                                        <span class="text-danger error-text property_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="premium-form-group">
                                                        <label for="date" class="premium-label">{!! __('maintenances.date') !!} <span class="text-danger">*</span></label>
                                                        <input type="text" id="date" name="date" class="form-control premium-input shadow-none filter-datepicker" autocomplete="off" data-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" value="">
                                                        <span class="text-danger error-text date_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="premium-form-group">
                                                        <label for="status" class="premium-label">{!! __('maintenances.status') !!} <span class="text-danger">*</span></label>
                                                        <select id="status" name="status" class="form-control premium-input shadow-none select2">
                                                            <option value="" selected>{!! __('general.select_from_list') !!}</option>
                                                            <option value="pending">{!! __('maintenances.pending') !!}</option>
                                                            <option value="in_progress">{!! __('maintenances.in_progress') !!}</option>
                                                            <option value="done">{!! __('maintenances.done') !!}</option>
                                                        </select>
                                                        <span class="text-danger error-text status_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="premium-form-group">
                                                        <label for="main_cost" class="premium-label">{!! __('maintenances.cost') !!}</label>
                                                        <div class="input-group premium-input-group">
                                                            <input type="number" step="0.01" id="main_cost" name="cost" class="form-control premium-input shadow-none border-right-0" value="0.00">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-white border-left-0 text-muted">{{ currency() }}</span>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger error-text cost_error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="premium-form-group">
                                                        <label for="description_ar" class="premium-label">{!! __('maintenances.description_ar') !!}</label>
                                                        <textarea id="description_ar" name="description_ar" rows="3" class="form-control premium-input shadow-none" placeholder="{!! __('maintenances.enter_description_ar') !!}"></textarea>
                                                        <span class="text-danger error-text description_ar_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="premium-form-group">
                                                        <label for="description_en" class="premium-label">{!! __('maintenances.description_en') !!}</label>
                                                        <textarea id="description_en" name="description_en" rows="3" class="form-control premium-input shadow-none" placeholder="{!! __('maintenances.enter_description_en') !!}"></textarea>
                                                        <span class="text-danger error-text description_en_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- End Primary Card -->

                                <!-- Maintenance Items Card -->
                                <div class="card premium-card shadow-lg border-0 premium-card-anim">
                                    <div class="property-mandatory-header maintenance-items-header">
                                        <div class="title-wrapper maintenance-items-header-title">
                                            <i class="fas fa-list-ul"></i>
                                            <span>{!! __('maintenances.maintenance_items') !!}</span>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" id="add-item-btn" class="btn-premium-add-guarantor" title="{!! __('maintenances.add_item') !!}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body pt-3">
                                            
                                            <div id="items-container">
                                                <div id="empty-items-message" class="text-center p-3 text-dark font-weight-bold">
                                                    <i class="fas fa-info-circle mr-1 text-primary"></i>
                                                    {!! __('maintenances.no_maintenance_items_added') !!}
                                                </div>
                                            </div>
                                            <div class="text-right mt-2">
                                                <h5 class="font-weight-bold text-dark">{!! __('maintenances.total_cost') !!}: <span id="total_items_cost">0.00</span> {{ currency() }}</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                dir: $('html').attr('data-textdirection') || 'ltr'
            });

            // Update Custom File Label on selection
            $(document).on('change', '.file-upload-input', function (e) {
                var fileName = $(this).val().split('\\').pop();
                $(this).siblings('label').find('.file-name').html(fileName || '{!! __('general.choose_file') !!}');
            });

            let itemIndex = 1;
            $('#add-item-btn').click(function() {
                $('#empty-items-message').hide();
                let html = `
                <div class="maintenance-item-row align-all-items-row row align-items-start mb-2 pb-2 border-bottom">
                    <div class="col-md-3">
                        <div class="premium-form-group mb-0">
                            <label class="premium-label">{!! __('maintenances.maintenance_type') !!} <span class="text-danger">*</span></label>
                            <input type="text" name="items[${itemIndex}][type]" class="form-control premium-input shadow-none" placeholder="{!! __('maintenances.enter_type') !!}">
                            <span class="text-danger error-text items_${itemIndex}_type_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="premium-form-group mb-0">
                            <label class="premium-label">{!! __('maintenances.cost') !!}</label>
                            <div class="input-group premium-input-group">
                                <input type="number" step="0.01" name="items[${itemIndex}][cost]" class="form-control premium-input shadow-none border-right-0 item-cost" value="0.00">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0 text-muted">{{ currency() }}</span>
                                </div>
                            </div>
                            <span class="text-danger error-text items_${itemIndex}_cost_error"></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="premium-form-group mb-0">
                            <label class="premium-label">{!! __('maintenances.attachment') !!}</label>
                            <div class="d-flex align-items-center w-100">
                                <div class="premium-file-upload-wrapper mt-0">
                                    <input type="file" name="items[${itemIndex}][attachment]" class="d-none file-upload-input" id="attachment_${itemIndex}" accept=".jpg,.jpeg,.png,.pdf">
                                    <label for="attachment_${itemIndex}" class="premium-file-label w-100 mb-0">
                                        <div class="premium-file-box premium-file-box-match w-100 d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="file-icon-box"><i class="fas fa-paperclip text-primary"></i></div>
                                                <span class="file-name text-muted text-truncate d-inline-block">{!! __('general.choose_file') !!}</span>
                                            </div>
                                            <span class="browse-badge browse-badge-primary">{!! __('general.browse') !!}</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="file-preview-container mx-1 d-flex align-items-center"></div>
                            </div>
                            <span class="text-danger error-text items_${itemIndex}_attachment_error"></span>
                        </div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div class="premium-form-group mb-0">
                            <label class="premium-label d-block text-transparent" style="opacity: 0; user-select: none;">Ù†ÙˆØ¹ Ø§Ù„ØµÙŠØ§Ù†Ø©</label>
                            <div class="d-flex align-items-center justify-content-center action-btn-wrapper">
                                <a href="javascript:void(0)" class="btn-premium-action btn-premium-action-danger remove-item-btn" title="{!! __('general.delete') !!}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $('#items-container').append(html);
                itemIndex++;
            });

            $(document).on('click', '.remove-item-btn', function() {
                $(this).closest('.maintenance-item-row').remove();
                if ($('.maintenance-item-row').length === 0) {
                    $('#empty-items-message').show();
                }
                calculateTotal();
            });

            $(document).on('input', 'input[name^="items"][name$="[cost]"]', function() {
                calculateTotal();
            });

            function calculateTotal() {
                let total = 0;
                $('input[name^="items"][name$="[cost]"]').each(function() {
                    let val = parseFloat($(this).val());
                    if (!isNaN(val)) {
                        total += val;
                    }
                });
                $('#total_items_cost').text(total.toFixed(2));
                $('#main_cost').val(total.toFixed(2));
            }
            
            // File Preview Logic
            $(document).on('change', '.file-upload-input', function (e) {
                var file = this.files[0];
                var $previewContainer = $(this).closest('.premium-form-group').find('.file-preview-container');
                $previewContainer.empty();
                
                if (file) {
                    var fileType = file.type;
                    if (fileType.match('image.*')) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $previewContainer.html('<img src="' + e.target.result + '" class="img-thumbnail shadow-sm" style="height: 30px; max-height: 30px; object-fit: cover; border-radius: 4px; margin-top: 0; padding: 1px;">');
                        }
                        reader.readAsDataURL(file);
                    } else if (fileType === 'application/pdf') {
                        $previewContainer.html('<span class="browse-badge browse-badge-info" style="height: 24px; line-height: 20px; display: inline-flex; align-items: center; justify-content: center; gap: 4px; font-size: 0.7rem; text-transform: none; letter-spacing: 0; margin-top: 0; padding: 0 8px; border-radius: 4px; font-weight: 600;"><i class="fas fa-file-pdf"></i> PDF</span>');
                    }
                }
            });

            // Initialize Property AJAX Select2 with Company dependency
            $('#property_id.select2-ajax').select2({
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
                            company_id: $('#company_id').length ? $('#company_id').val() : null,
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results || data,
                            pagination: {
                                more: data.total_count ? (params.page * 30) < data.total_count : false
                            }
                        };
                    },
                    cache: true
                },
                placeholder: $('#property_id').data('placeholder'),
                minimumInputLength: 0,
            });

            @if(user()->company_id == 1)
                $('#company_id').on('change', function() {
                    let companyId = $(this).val();
                    $('#property_id').val(null).trigger('change');
                    
                    if (companyId) {
                        $('#property_id').prop('disabled', false);
                    } else {
                        $('#property_id').prop('disabled', true);
                    }
                });
            @endif
        });
    </script>
@endpush
