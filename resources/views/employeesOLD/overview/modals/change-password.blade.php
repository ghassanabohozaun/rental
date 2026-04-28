<div class="modal modal-pop fade" id="employeeChangePasswordModal" tabindex="-1" aria-labelledby="employeeChangePasswordModalLabel"
    data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form class="form w-100" action="{!! route('employees.overview.change.password') !!}" method="POST" enctype="multipart/form-data"
            id='employee_change_password_form'>
            @csrf
            <div class="modal-content shadow-lg border-0">

                <!--begin::modal header-->
                <div class="modal-header px-4 py-3">
                    <h5 class="modal-title" id="employeeChangePasswordModalLabel">
                        <i class="mdi mdi-lock-reset text-primary fs-4"></i>
                        {!! __('employees.change_password') !!}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12 d-none">
                            <input type="text" name="employee_id" id="employee_id" class="form-control"
                                value="{!! employee()->user()->id !!}">
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted mb-2">
                                    {!! __('employees.password') !!}
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                        autocomplete="new-password" placeholder="{!! __('employees.enter_password') !!}">
                                    <button class="btn btn-merge-toggle" type="button" onclick="showPassword();">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <span class="text-danger small mt-1" id="password_error"></span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label class="form-label fw-bold small text-uppercase text-muted mb-2">
                                    {!! __('employees.password_confirm') !!}
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirm" name="password_confirm"
                                        class="form-control" autocomplete="new-password"
                                        placeholder="{!! __('employees.enter_password_confirm') !!}">
                                    <button class="btn btn-merge-toggle" type="button" onclick="showPasswordConfirm();">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                <span class="text-danger small mt-1" id="password_confirm_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer border-0 px-4 py-3">
                    <button type="button" id="cancel_employee_change_password_btn"
                        class="btn btn-light px-4 py-2 me-2">
                        {{ __('general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-info px-4 py-2 d-flex align-items-center gap-2">
                        <i class="mdi mdi-check-circle-outline"></i>
                        {{ __('general.save') }}
                        <div class="spinner-border spinner-border-sm spinner_loading d-none ms-1" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
                <!--end::modal footer-->
            </div>
        </form>
    </div>
</div>


@push('scripts')
    <script type="text/javascript">
        // show password
        function showPassword() {
            var password = document.getElementById('password');
            if (password.type == 'password') {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
        }

        // show password confirm
        function showPasswordConfirm() {
            var password_confirm = document.getElementById('password_confirm');
            if (password_confirm.type == 'password') {
                password_confirm.type = 'text';
            } else {
                password_confirm.type = 'password';
            }
        }


        $(document).ready(function() {


            // open create modal
            $('body').on('click', '#employee_change_password_btn', function(e) {
                $('#employeeChangePasswordModal').modal('show');
            });

            // reset
            function resetCreateForm() {
                $('#password').css('border-color', '');
                $('#password_confirm').css('border-color', '');

                $('#password_error').text('');
                $('#password_confirm_error').text('');
            }

            // cancel
            $('body').on('click', '#cancel_employee_change_password_btn', function(e) {
                $('#employeeChangePasswordModal').modal('hide');
                $('#employee_change_password_form')[0].reset();
                resetCreateForm();
            });

            // hide
            $('#employeeChangePasswordModal').on('hidden.bs.modal', function(e) {
                $('#employeeChangePasswordModal').modal('hide');
                $('#employee_change_password_form')[0].reset();
                resetCreateForm();
            });


            // create
            $('#employee_change_password_form').on('submit', function(e) {
                e.preventDefault();
                // reset
                resetCreateForm();

                // paramters
                var data = new FormData(this);
                var type = $(this).attr('method');
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    data: data,
                    type: type,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.spinner_loading').removeClass('d-none');
                    },
                    success: function(data) {
                        if (data.status == true) {
                            $('#employee_change_password_form')[0].reset();
                            resetCreateForm();
                            if (document.activeElement) { document.activeElement.blur(); }
                            $('#employeeChangePasswordModal').modal('hide');
                            flasher.success("{!! __('general.change_password_success_message') !!}");
                        } else {
                            flasher.error("{!! __('general.change_password_error_message') !!}");
                        }
                    },
                    error: function(reject) {
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                            $('#' + key).css('border-color', '#F64E60');
                        });
                    }, //end error
                    complete: function() {
                        $('.spinner_loading').addClass('d-none');
                    }
                });

            });


        });
    </script>
@endpush




