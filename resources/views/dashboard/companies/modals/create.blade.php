<div class="modal modal-pop fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.companies.store') !!}" method="POST" enctype="multipart/form-data"
            id="create_company_form" novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="addCompanyModalLabel">
                        <i class="la la-building-o mr-1 text-primary" style="font-size: 22px;"></i> {!! __('companies.create_new_company') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>

                <div class="modal-body my-2">
                    <!-- First Row: Names and Plan -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_ar_create">{!! __('companies.name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_ar_create" name="name[ar]" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_name_ar') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_en_create">{!! __('companies.name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="name_en_create" name="name[en]" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_name_en') !!}">
                                    <i class="la la-building text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="subscription_plan_create">{!! __('companies.subscription_plan') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select name="subscription_plan" id="subscription_plan_create" class="form-control premium-input shadow-none">
                                        <option value="Basic">Basic</option>
                                        <option value="Premium" selected>Premium</option>
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
                                <label for="email_create">{!! __('companies.email') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="email" id="email_create" name="email" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_email') !!}">
                                    <i class="la la-envelope text-primary"></i>
                                </div>
                                <span class="error-text email_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="phone_create">{!! __('companies.phone') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="phone_create" name="phone" class="form-control premium-input shadow-none" 
                                        autocomplete="off" placeholder="{!! __('companies.enter_phone') !!}">
                                    <i class="la la-phone text-primary"></i>
                                </div>
                                <span class="error-text phone_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="status_create">{!! __('companies.status') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select name="status" id="status_create" class="form-control premium-input shadow-none">
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
                                <label for="address_create">{!! __('companies.address') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" id="address_create" name="address" class="form-control premium-input shadow-none" 
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
                                    <input type="file" name="logo" id="logo_create" class="form-control" accept="image/*">
                                </div>
                                <span class="error-text logo_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-premium-add px-4 font-weight-bold h-42 radius-10">
                        <i class="la la-save mr-1"></i> {!! __('general.save') !!}
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
        // Initialize FileInput for Create
        $("#logo_create").fileinput({
            theme: 'fa5',
            language: "{!! app()->getLocale() !!}",
            allowedFileTypes: ['image'],
            maxFileCount: 1,
            showCancel: false,
            showUpload: false,
            browseClass: "btn btn-sm btn-primary d-block w-100",
            browseLabel: "{!! __('general.choose_file') !!}",
            removeClass: "btn btn-danger",
            removeLabel: "{!! __('general.delete') !!}"
        });
    });
</script>
@endpush
