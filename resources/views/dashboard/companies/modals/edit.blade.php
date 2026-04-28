<div class="modal modal-pop fade" id="editCompanyModal" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data"
            id="edit_company_form" novalidate
            data-success-msg="{!! __('general.update_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            @method('PUT')
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="editCompanyModalLabel">
                        <i class="la la-edit mr-1 text-primary" style="font-size: 22px;"></i> {!! __('companies.update_company') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>

                <div class="modal-body my-2">
                    <input type="hidden" name="id" id="edit_id">
                    
                    <!-- First Row: Names and Plan -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_ar_edit">{!! __('companies.name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_edit" name="name[ar]" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_name_ar') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_en_edit">{!! __('companies.name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_edit" name="name[en]" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_name_en') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="subscription_plan_edit">{!! __('companies.subscription_plan') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select name="subscription_plan" id="subscription_plan_edit" class="form-control premium-input shadow-none">
                                        <option value="Basic">Basic</option>
                                        <option value="Premium">Premium</option>
                                        <option value="Enterprise">Enterprise</option>
                                    </select>
                                    <i class="la la-gem text-primary"></i>
                                </div>
                                <span class="error-text subscription_plan_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Email, Phone, Status -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="email_edit">{!! __('companies.email') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="email" id="email_edit" name="email" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_email') !!}">
                                    <i class="la la-envelope text-primary"></i>
                                </div>
                                <span class="error-text email_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="phone_edit">{!! __('companies.phone') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="phone_edit" name="phone" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_phone') !!}">
                                    <i class="la la-phone text-primary"></i>
                                </div>
                                <span class="error-text phone_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="status_edit">{!! __('companies.status') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select name="status" id="status_edit" class="form-control premium-input shadow-none">
                                        <option value="active">{!! __('general.active') !!}</option>
                                        <option value="inactive">{!! __('general.inactive') !!}</option>
                                    </select>
                                    <i class="la la-check-circle text-primary"></i>
                                </div>
                                <span class="error-text status_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row: Address (Full Width) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group">
                                <label for="address_edit">{!! __('companies.address') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="address_edit" name="address" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_address') !!}">
                                    <i class="la la-map-marker text-primary"></i>
                                </div>
                                <span class="error-text address_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Row: Logo (Full Width) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group mb-0">
                                <label class="font-weight-bold text-dark">{!! __('companies.logo') !!}</label>
                                <div class="premium-photo-container">
                                    <input type="file" name="logo" id="logo_edit" class="form-control" accept="image/*">
                                </div>
                                <span class="error-text logo_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
                        <i class="la la-save mr-1"></i> {!! __('general.update') !!}
                        <i class="la la-refresh la-spin spinner_loading d-none ml-1"></i>
                    </button>
                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10" data-dismiss="modal">
                        <i class="la la-times-circle mr-1"></i> {!! __('general.cancel') !!}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize FileInput for Edit
        $("#logo_edit").fileinput({
            theme: 'fa5',
            language: "{!! app()->getLocale() !!}",
            allowedFileTypes: ['image'],
            maxFileCount: 1,
            showCancel: false,
            showUpload: false,
            initialPreviewAsData: true,
            browseClass: "btn btn-sm btn-primary d-block w-100",
            browseLabel: "{!! __('general.choose_file') !!}",
            removeClass: "btn btn-danger",
            removeLabel: "{!! __('general.delete') !!}"
        });
    });

    // Custom function to open edit modal and fill data
    function openEditCompanyModal(data) {
        let form = $('#edit_company_form');
        form.attr('action', "{!! route('dashboard.companies.index') !!}/" + data.id);
        
        $('#edit_id').val(data.id);
        $('#name_ar_edit').val(data.name_ar);
        $('#name_en_edit').val(data.name_en);
        $('#email_edit').val(data.email);
        $('#phone_edit').val(data.phone);
        $('#address_edit').val(data.address);
        $('#subscription_plan_edit').val(data.subscription_plan);
        $('#status_edit').val(data.status);

        // Reset and update fileinput preview
        if (data.logo_url) {
            $("#logo_edit").fileinput('destroy').fileinput({
                theme: 'fa5',
                language: "{!! app()->getLocale() !!}",
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                showCancel: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [data.logo_url],
                browseClass: "btn btn-sm btn-primary d-block w-100",
                browseLabel: "{!! __('general.choose_file') !!}",
                removeClass: "btn btn-danger",
                removeLabel: "{!! __('general.delete') !!}"
            });
        }

        $('#editCompanyModal').modal('show');
    }
</script>
@endpush
