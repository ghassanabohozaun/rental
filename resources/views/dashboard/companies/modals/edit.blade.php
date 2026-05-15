<div class="modal modal-pop" id="editCompanyModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="editCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data" id="edit_company_form"
            novalidate data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            @method('PUT')
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center"
                        id="editCompanyModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> {!! __('companies.update_company') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body mt-2 mb-0">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="delete_logo" id="delete_logo_edit" value="0">

                    <!-- First Row: Names and Plan -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_ar_edit">{!! __('companies.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_edit" name="name[ar]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('companies.enter_name_ar') !!}">
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                <span class="text-danger error-text name_ar_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_en_edit">{!! __('companies.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_edit" name="name[en]"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('companies.enter_name_en') !!}">
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                <span class="text-danger error-text name_en_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="subscription_plan_edit">{!! __('companies.subscription_plan') !!} <span
                                        class="text-danger">*</span></label>
                                <select name="subscription_plan" id="subscription_plan_edit"
                                    class="form-control premium-input select2 shadow-none"
                                    data-placeholder="{!! __('companies.subscription_plan') !!}">
                                    <option value="" disabled>{!! __('general.select_from_list') !!}</option>
                                    <option value="Basic">{!! __('companies.plan_basic') !!}</option>
                                    <option value="Premium">{!! __('companies.plan_premium') !!}</option>
                                    <option value="Enterprise">{!! __('companies.plan_enterprise') !!}</option>
                                </select>
                                <span class="text-danger error-text subscription_plan_error"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Email, Phone, Status -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="status_edit">{!! __('companies.status') !!} <span
                                        class="text-danger">*</span></label>
                                <select name="status" id="status_edit"
                                    class="form-control premium-input select2 shadow-none"
                                    data-placeholder="{!! __('companies.status') !!}">
                                    <option value="" disabled>{!! __('general.select_from_list') !!}</option>
                                    <option value="active">{!! __('general.active') !!}</option>
                                    <option value="inactive">{!! __('general.inactive') !!}</option>
                                </select>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="email_edit">{!! __('companies.email') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="email" id="email_edit" name="email"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('companies.enter_email') !!}">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="phone_edit">{!! __('companies.phone') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="phone_edit" name="phone"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('companies.enter_phone') !!}">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <span class="text-danger error-text phone_error"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row: Address (Full Width) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group">
                                <label for="address_edit">{!! __('companies.address') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="address_edit" name="address"
                                        class="form-control premium-input shadow-none" autocomplete="off"
                                        placeholder="{!! __('companies.enter_address') !!}">
                                    <i class="fas fa-map-marker text-primary"></i>
                                </div>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Row: Logo (Full Width) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group mb-0">
                                <label class="font-weight-bold text-dark">{!! __('companies.logo') !!}</label>
                                <div class="premium-photo-container">
                                    <input type="file" name="logo" id="logo_edit" class="form-control"
                                        accept="image/*">
                                </div>
                                <span class="text-danger error-text logo_error"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 premium-modal-footer">
                    <button type="submit" class="btn btn-premium-save font-weight-bold">
                        <i class="fas fa-save mr-2"></i>
                        <i class="fas fa-spinner fa-spin d-none spinner_loading mr-2"></i>
                        {!! __('general.save') !!}
                    </button>
                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold"
                        data-dismiss="modal">
                        <i class="fas fa-times-circle mr-2"></i> {!! __('general.cancel') !!}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).closest('.modal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            });

            // Initialize FileInput for Edit
            $("#logo_edit").fileinput({
                theme: 'fa5',
                language: "{!! app()->getLocale() !!}",
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                showCancel: false,
                showUpload: false,
                dropZoneEnabled: false,
                initialPreviewAsData: true,
                browseClass: "btn btn-sm btn-primary px-3",
                browseLabel: "{!! __('general.choose_file') !!}",
                removeClass: "btn btn-danger",
                removeLabel: "{!! __('general.delete') !!}"
            }).on('fileclear', function() {
                $('#delete_logo_edit').val(1);
            }).on('change', function() {
                if ($(this).val()) {
                    $('#delete_logo_edit').val(0);
                }
            });
        });

        // Custom function to open edit modal and fill data
        function openEditCompanyModal(data) {
            let form = $('#edit_company_form');
            form.attr('action', "{!! route('dashboard.companies.index') !!}/" + data.id);

            $('#edit_id').val(data.id);
            $('#delete_logo_edit').val(0);
            $('#name_ar_edit').val(data.name_ar);
            $('#name_en_edit').val(data.name_en);
            $('#email_edit').val(data.email);
            $('#phone_edit').val(data.phone);
            $('#address_edit').val(data.address);
            $('#subscription_plan_edit').val(data.subscription_plan).trigger('change');
            $('#status_edit').val(data.status).trigger('change');

            // Reset and update fileinput preview using the Global Initializer
            let fileInputOptions = {};
            if (data.logo_url) {
                fileInputOptions = {
                    initialPreview: [data.logo_url],
                    initialPreviewAsData: true
                };
            }
            window.PremiumFileInput.init("#logo_edit", fileInputOptions);

            $('#editCompanyModal').modal('show');
        }
    </script>
@endpush
