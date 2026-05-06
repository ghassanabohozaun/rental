<div class="modal modal-pop fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="form ajax-form" action="" method="POST" enctype="multipart/form-data" id='update_user_form'
            novalidate data-success-msg="{!! __('general.update_success_message') !!}" data-success-action="reload-table"
            data-table-id="#table_data">
            @csrf
            @method('PUT')
            <div class="modal-content border-0">

                <!--begin::modal header-->
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center" id="updateUserModalLabel">
                        <i class="fas fa-edit text-primary mr-2 icon-size-18"></i> {!! __('users.update_user') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body my-2">
                    <input type="hidden" id="id_edit" name="id">

                    <!-- First Row: Names and Mobile (3 Columns) -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_ar_edit">{!! __('users.name_ar') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="name_ar_edit" name="name[ar]" placeholder="{!! __('users.enter_name_ar') !!}"
                                        autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="error-text name_ar_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="name_en_edit">{!! __('users.name_en') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none"
                                        id="name_en_edit" name="name[en]" placeholder="{!! __('users.enter_name_en') !!}"
                                        autocomplete="off">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <span class="error-text name_en_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="mobile_edit">{!! __('users.mobile') !!}</label>
                                <div class="premium-input-wrapper">
                                    <input type="text" class="form-control premium-input shadow-none text-left"
                                        id="mobile_edit" name="mobile" placeholder="{!! __('users.enter_mobile') !!}"
                                        dir="ltr" autocomplete="off">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <span class="error-text mobile_error text-danger small"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Email, Password, Password Confirm (3 Columns) -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="email_edit">{!! __('users.email') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <input type="email" class="form-control premium-input shadow-none text-left"
                                        id="email_edit" name="email" placeholder="{!! __('users.enter_email') !!}"
                                        dir="ltr" autocomplete="off">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <span class="error-text email_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="password_edit">{!! __('users.password') !!}</label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-eye pointer text-primary premium-icon-opposite"
                                        style="{{ Lang() == 'ar' ? 'left: 1.15rem !important; right: auto !important;' : 'right: 1.15rem !important; left: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; cursor: pointer;"
                                        onclick="togglePassword('password_edit', this);"></i>
                                    <input type="password" class="form-control premium-input shadow-none"
                                        id="password_edit" name="password" placeholder="{!! __('users.enter_password') !!}"
                                        autocomplete="new-password">
                                    <i class="fas fa-lock text-primary"
                                        style="{{ Lang() == 'ar' ? 'right: 1.15rem !important; left: auto !important;' : 'left: 1.15rem !important; right: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; pointer-events: none;"></i>
                                </div>
                                <span class="error-text password_error text-danger small"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="premium-form-group">
                                <label for="password_confirm_edit">{!! __('users.password_confirm') !!}</label>
                                <div class="premium-input-wrapper">
                                    <i class="fas fa-eye pointer text-primary premium-icon-opposite"
                                        style="{{ Lang() == 'ar' ? 'left: 1.15rem !important; right: auto !important;' : 'right: 1.15rem !important; left: auto !important;' }} position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; font-size: 1.35rem; cursor: pointer;"
                                        onclick="togglePassword('password_confirm_edit', this);"></i>
                                    <input type="password" class="form-control premium-input shadow-none"
                                        id="password_confirm_edit" name="password_confirm"
                                        placeholder="{!! __('users.enter_password_confirm') !!}" autocomplete="new-password">
                                    <i class="fas fa-lock text-primary"
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
                                <label for="role_id_edit">{!! __('users.role_id') !!} <span
                                        class="text-danger">*</span></label>
                                <div class="premium-input-wrapper">
                                    <select class="form-control premium-input shadow-none" id='role_id_edit'
                                        name="role_id">
                                        <option value="" selected="">{!! __('general.select_from_list') !!}</option>
                                        @foreach ($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-shield-alt text-primary"></i>
                                </div>
                                <span class="error-text role_id_error text-danger small"></span>
                            </div>
                        </div>

                        @if ($companies)
                            <div class="col-md-6">
                                <div class="premium-form-group">
                                    <label for="company_id_edit">{!! __('companies.company') !!} <span
                                            class="text-danger">*</span></label>
                                    <div class="premium-input-wrapper">
                                        <select class="form-control premium-input shadow-none select2"
                                            id='company_id_edit' name="company_id">
                                            <option value="">{!! __('roles.global_role') !!}</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-briefcase text-primary"></i>
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
                                    <input type="file" name="photo" id="photo_edit" class="form-control"
                                        accept="image/*">
                                </div>
                                <span class="error-text photo_error text-danger small"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" id="saveBtnEdit"
                        class="btn btn-premium-save shadow-pulse px-4 font-weight-bold h-42 radius-10">
                        <i class="fas fa-save"></i> {{ __('general.save') }}
                        <i class="fas fa-sync fa-spin spinner_loading d-none ml-1"></i>
                    </button>

                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold h-42 radius-10"
                        data-dismiss="modal">
                        <i class="fas fa-times-circle mr-1"></i> {{ __('general.cancel') }}
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
                            ico.className = isPassword ? 'fas fa-unlock-alt text-primary' : 'fas fa-lock text-primary';
                        } else if (ico.classList.contains('la-eye') || ico.classList.contains('la-eye-slash')) {
                            ico.className = isPassword ? 'fas fa-eye-slash pointer text-primary premium-icon-opposite' :
                                'fas fa-eye pointer text-primary premium-icon-opposite';
                        }
                    }
                }
            };
        }


        $(document).ready(function() {
            let lang = "{!! Lang() !!}";

            // Show edit modal and populate data dynamically
            $('body').on('click', '.edit_user_button', function(e) {
                e.preventDefault();

                let user_id = $(this).attr('user-id');
                let user_name_ar = $(this).attr('user-name-ar');
                let user_name_en = $(this).attr('user-name-en');
                let user_email = $(this).attr('user-email');
                let user_mobile = $(this).attr('user-mobile');
                let user_role_id = $(this).attr('user-role-id');
                let user_photo_url = $(this).attr('user-photo-url');
                let user_photo = $(this).attr('user-photo');

                let user_company_id = $(this).attr('user-company-id');
                let user_company_name = $(this).attr('user-company-name');

                // Populate fields
                $('#id_edit').val(user_id);
                $('#name_ar_edit').val(user_name_ar);
                $('#name_en_edit').val(user_name_en);
                $('#email_edit').val(user_email);
                $('#mobile_edit').val(user_mobile);
                $('#role_id_edit').val(user_role_id);

                // Pre-populate Select2 for Company without Extra AJAX Call
                if ($('#company_id_edit').length) {
                    if (user_company_id) {
                        $('#company_id_edit').val(user_company_id).trigger('change');
                    } else {
                        $('#company_id_edit').val(null).trigger('change');
                    }
                }

                // Update form action URL dynamically
                let url = "{!! route('dashboard.users.update', 'id') !!}".replace('id', user_id);
                $('#update_user_form').attr('action', url);

                // Re-initialize FileInput with preview
                $("#photo_edit").fileinput('destroy');
                $("#photo_edit").fileinput({
                    theme: 'fa5',
                    language: lang,
                    allowedFileTypes: ['image'],
                    maxFileCount: 1,
                    showCancel: false,
                    showUpload: false,
                    initialPreview: user_photo ? [user_photo_url] : [],
                    initialPreviewAsData: true,
                    browseClass: "btn btn-sm btn-primary d-block w-100",
                    removeClass: "btn btn-danger",
                    removeLabel: "{!! __('general.delete') !!}",
                    browseLabel: "{!! __('general.choose_file') !!}"
                });

                // Show modal
                $('#updateUserModal').modal('show');
            });

            // Initialize Generic Select2 for Company Autocomplete in Edit Modal
            if ($('#company_id_edit').length) {
                $('#company_id_edit').select2({
                    dropdownParent: $('#updateUserModal'),
                    width: '100%',
                    dir: $('html').attr('data-textdirection') || 'ltr'
                });
            }

            // Handle Header Update after successful profile edit
            $('#update_user_form').on('ajax-form-success', function(e, response) {
                let user_id = $('#id_edit').val();
                let auth_id = "{{ user()->id }}";

                if (user_id == auth_id && response.status) {
                    let userName = response.data.name[lang] || response.data.name['en'] || response.data
                        .name['ar'];
                    $('.user-name-text').text(userName);
                    $('.dropdown-header-premium .user-name').text(userName);
                    if (response.photo_url) {
                        let imgHtml = '<img src="' + response.photo_url + '?t=' + new Date().getTime() +
                            '" alt="avatar" class="avatar-img-premium shadow-sm">';
                        $('.avatar-wrapper-premium').html(imgHtml);
                    }
                }
            });
        });
    </script>
@endpush
