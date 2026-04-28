<div class="modal modal-pop fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="{!! route('dashboard.users.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_user_form' novalidate
            data-success-msg="{!! __('general.add_success_message') !!}"
            data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark" id="createUserModalLabel">
                        <i class="la la-user-plus mr-1 text-primary" style="font-size: 22px;"></i> {!! __('users.create_new_user') !!}
                    </h5>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <!-- First Row: Names and Mobile (3 Columns) -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_ar_create">{!! __('users.name_ar') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="name_ar_create"
                                    name="name[ar]" placeholder="{!! __('users.enter_name_ar') !!}" autocomplete="off">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_en_create">{!! __('users.name_en') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none" id="name_en_create"
                                    name="name[en]" placeholder="{!! __('users.enter_name_en') !!}" autocomplete="off">
                                    <i class="la la-user text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="mobile_create">{!! __('users.mobile') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left" id="mobile_create"
                                    name="mobile" placeholder="{!! __('users.enter_mobile') !!}" dir="ltr" autocomplete="off">
                                    <i class="la la-phone text-primary"></i>
                                </div>
                                <span class="error-text mobile_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Email, Password, Password Confirm (3 Columns) -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="email_create">{!! __('users.email') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="email" class="form-control premium-input shadow-none text-left" id="email_create"
                                    name="email" placeholder="{!! __('users.enter_email') !!}" dir="ltr" autocomplete="off">
                                    <i class="la la-envelope text-primary"></i>
                                </div>
                                <span class="error-text email_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="password_create">{!! __('users.password') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="la la-eye pointer text-primary premium-icon-opposite" 
                                        style="{{ Lang() == 'ar' ? 'left: 1.15rem !important; right: auto !important;' : 'right: 1.15rem !important; left: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; cursor: pointer;"
                                        onclick="togglePassword('password_create', this);"></i>
                                    <input type="password" class="form-control premium-input shadow-none" id="password_create"
                                    name="password" placeholder="{!! __('users.enter_password') !!}" autocomplete="new-password">
                                    <i class="la la-lock text-primary" 
                                        style="{{ Lang() == 'ar' ? 'right: 1.15rem !important; left: auto !important;' : 'left: 1.15rem !important; right: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; pointer-events: none;"></i>
                                </div>
                                <span class="error-text password_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="password_confirm_create">{!! __('users.password_confirm') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <i class="la la-eye pointer text-primary premium-icon-opposite" 
                                        style="{{ Lang() == 'ar' ? 'left: 1.15rem !important; right: auto !important;' : 'right: 1.15rem !important; left: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; cursor: pointer;"
                                        onclick="togglePassword('password_confirm_create', this);"></i>
                                    <input type="password" class="form-control premium-input shadow-none" id="password_confirm_create"
                                    name="password_confirm" placeholder="{!! __('users.enter_password_confirm') !!}" autocomplete="new-password">
                                    <i class="la la-lock text-primary" 
                                        style="{{ Lang() == 'ar' ? 'right: 1.15rem !important; left: auto !important;' : 'left: 1.15rem !important; right: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; pointer-events: none;"></i>
                                </div>
                                <span class="error-text password_confirm_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row: Role and Company (Two Columns if Admin) -->
                    <div class="row">
                        <div class="@if ($companies) col-md-6 @else col-md-12 @endif">
                            <div class="premium-form-group">
                                <label for="role_id_create">{!! __('users.role_id') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id='role_id_create' name="role_id">
                                        <option value="" selected="">{!! __('general.select_from_list') !!}</option>
                                        @foreach ($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                                        @endforeach
                                    </select>
                                    <i class="la la-shield text-primary"></i>
                                </div>
                                <span class="error-text role_id_error text-danger small"></span>
                            </div>
                        </div>

                        @if ($companies)
                        <div class="col-md-6">
                            <div class="premium-form-group">
                                <label for="company_id_create">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id='company_id_create' name="company_id">
                                        <option value="">{!! __('roles.global_role') !!}</option>
                                        <!-- Options will be loaded dynamically via AJAX -->
                                    </select>
                                    <!-- Select2 will handle its own UI, so we remove the overlapping icon -->
                                </div>
                                <span class="error-text company_id_error text-danger small"></span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Fourth Row: Photo (Full Width) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="premium-form-group mb-0">
                                <label class="font-weight-bold text-dark">{!! __('users.photo') !!}</label>
                                <div class="premium-photo-container">
                                    <input type="file" name="photo" id="photo_create" class="form-control"
                                        accept="image/*">
                                </div>
                                <span class="error-text photo_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

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
    <script type="text/javascript">
        // Global toggle function redefined locally to ensure it works even if global script fails
        if (typeof window.togglePassword !== 'function') {
            window.togglePassword = function(inputId, icon) {
                var input = document.getElementById(inputId);
                if (!input) return;
                var isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                var wrapper = icon.parentElement;
                if (wrapper) {
                    var icons = wrapper.getElementsByTagName('i');
                    for (var i = 0; i < icons.length; i++) {
                        var ico = icons[i];
                        if (ico.classList.contains('la-lock') || ico.classList.contains('la-unlock-alt')) {
                            ico.className = isPassword ? 'la la-unlock-alt text-primary' : 'la la-lock text-primary';
                        } else if (ico.classList.contains('la-eye') || ico.classList.contains('la-eye-slash')) {
                            ico.className = isPassword ? 'la la-eye-slash pointer text-primary premium-icon-opposite' : 'la la-eye pointer text-primary premium-icon-opposite';
                        }
                    }
                }
            };
        }


        $(document).ready(function() {
            // Initialize Generic Select2 for Company Autocomplete
            if ($('#company_id_create').length) {
                initGenericSelect2('#company_id_create', '{!! route("dashboard.companies.autocomplete") !!}', '{!! __("general.select_from_list") !!}', '#createUserModal');
            }

            // Initialize FileInput for Create
            $("#photo_create").fileinput({
                theme: 'fa5',
                language: "{!! Lang() !!}",
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                showCancel: false,
                showUpload: false,
                browseClass: "btn btn-sm btn-primary d-block w-100",
                removeClass: "btn btn-danger",
                removeLabel: "{!! __('general.delete') !!}",
                browseLabel: "{!! __('general.choose_file') !!}"
            });
        });
    </script>
@endpush
