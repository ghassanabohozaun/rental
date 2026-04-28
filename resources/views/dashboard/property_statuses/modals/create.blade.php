<div class="modal modal-pop fade" id="createproperty_statusModal" tabindex="-1" role="dialog"
    aria-labelledby="createproperty_statusModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.property_statuses.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_property_status_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="createproperty_statusModalLabel">
                        <i class="la la-plus-circle mr-1 text-primary" style="font-size: 22px;"></i> {!! __('property_statuses.create_new_property_status') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body">
                    <div class="row">
                        <!-- Name Arabic -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="name_ar_create">{!! __('property_statuses.name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_create" name="name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('property_statuses.enter_name_ar') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <!-- Name English -->
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="name_en_create">{!! __('property_statuses.name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_create" name="name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('property_statuses.enter_name_en') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if (isset($companies))
                            <!-- Company -->
                            <div class="col-md-12">
                                <div class="premium-form-group">
                                    <label for="company_id_dept_create">{!! __('property_statuses.company') !!} <span class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper no-icon">
                                        <select name="company_id" id="company_id_dept_create" class="form-control premium-input select2-remote">
                                            <option value="">{{ __('general.select_from_list') }}</option>
                                        </select>
                                    </div>
                                    <span class="error-text company_id_error text-danger small"></span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row mt-2">
                        <!-- Color -->
                        <div class="col-md-12">
                            <div class="premium-form-group mb-0">
                                <label class="mb-3">{!! __('property_statuses.color') !!} <span class="text-danger">*</span></label>
                                
                                <div class="premium-color-selection-v2">
                                    <div class="color-options-row">
                                        <div class="color-chip active" style="--chip-color: #1e9ff2;" data-color="#1e9ff2" title="Blue"></div>
                                        <div class="color-chip" style="--chip-color: #666ee8;" data-color="#666ee8" title="Indigo"></div>
                                        <div class="color-chip" style="--chip-color: #28d094;" data-color="#28d094" title="Green"></div>
                                        <div class="color-chip" style="--chip-color: #ff9149;" data-color="#ff9149" title="Orange"></div>
                                        <div class="color-chip" style="--chip-color: #ff4961;" data-color="#ff4961" title="Red"></div>
                                        <div class="color-chip" style="--chip-color: #e91e63;" data-color="#e91e63" title="Pink"></div>
                                        <div class="color-chip" style="--chip-color: #9c27b0;" data-color="#9c27b0" title="Purple"></div>
                                        <div class="color-chip" style="--chip-color: #00bcd4;" data-color="#00bcd4" title="Cyan"></div>
                                        <div class="color-chip" style="--chip-color: #ffc107;" data-color="#ffc107" title="Amber"></div>
                                        <div class="color-chip" style="--chip-color: #8bc34a;" data-color="#8bc34a" title="Light Green"></div>
                                        <div class="color-chip" style="--chip-color: #009688;" data-color="#009688" title="Teal"></div>
                                        <div class="color-chip" style="--chip-color: #795548;" data-color="#795548" title="Brown"></div>
                                        <div class="color-chip" style="--chip-color: #607d8b;" data-color="#607d8b" title="Blue Gray"></div>
                                        <div class="color-chip" style="--chip-color: #323232;" data-color="#323232" title="Dark"></div>
                                        <div class="color-chip" style="--chip-color: #babfc7;" data-color="#babfc7" title="Gray"></div>
                                        
                                        <div class="advanced-picker-trigger" id="advancedPickerBtn" title="Custom Color">
                                            <i class="la la-cog"></i>
                                            <input type="color" id="color_create_picker" value="#1e9ff2" class="d-none">
                                        </div>
                                    </div>
                                    
                                    <div class="selected-color-info mt-3 d-flex align-items-center">
                                        <div class="color-preview-circle" id="colorPreview_create"></div>
                                        <input type="text" id="color_create" name="color" class="premium-hex-display" value="#1e9ff2" readonly>
                                        <small class="text-muted ml-2">({{ __('general.selected_color') }})</small>
                                    </div>
                                </div>
                                <span class="error-text color_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtn" class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
                        <i class="la la-save mr-1"></i> {{ __('general.save') }}
                        <i class="la la-refresh la-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
                        <i class="la la-times-circle mr-1"></i> {{ __('general.cancel') }}
                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            if ($('#company_id_dept_create').length) {
                initGenericSelect2('#company_id_dept_create', '{!! route("dashboard.companies.autocomplete") !!}', '{!! __("general.select_from_list") !!}', '#createproperty_statusModal');
            }

            // Premium Color Picker Logic V2
            function updateColor_create(color) {
                $('#color_create').val(color);
                $('#color_create_picker').val(color);
                $('#colorPreview_create').css('background-color', color);
                
                // Highlight active chip
                $('.color-chip').removeClass('active');
                $(`.color-chip[data-color="${color.toLowerCase()}"]`).addClass('active');
            }

            // When advanced picker changes
            $('#color_create_picker').on('input', function() {
                updateColor_create($(this).val());
            });

            // When a chip is clicked
            $('.color-chip').on('click', function() {
                updateColor_create($(this).data('color'));
            });

            // When trigger is clicked, open hidden picker
            $('#advancedPickerBtn').on('click', function() {
                $('#color_create_picker').click();
            });

            // Set initial state
            updateColor_create('#1e9ff2');
        });
    </script>
@endpush


