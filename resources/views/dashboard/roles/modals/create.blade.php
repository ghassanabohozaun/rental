<div class="modal modal-pop fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <form class="form" action="{!! route('dashboard.roles.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_role_form'>
            @csrf
            <div class="modal-content">

                <!--begin::modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">{!! __('roles.create_new_role') !!}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">

                            <!-- begin: row -->
                            <div class="row">
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role_ar">{!! __('roles.role_ar') !!}</label>
                                        <input type="text" id="role_ar" name="role[ar]" class="form-control"
                                            autocomplete="off" placeholder="{!! __('roles.enter_role_ar') !!}">
                                        <span class="text text-danger">
                                            <strong id="role_ar_error"></strong>
                                        </span>
                                    </div>
                                </div>
                                <!-- end: input -->
                            </div>
                            <!-- end: row -->

                            <!-- begin: row -->
                            <div class="row">
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role_en">{!! __('roles.role_en') !!}</label>
                                        <input type="text" id="role_en" name="role[en]" class="form-control"
                                            autocomplete="off" placeholder="{!! __('roles.enter_role_en') !!}">
                                        <span class="text text-danger">
                                            <strong id="role_en_error"></strong>
                                        </span>
                                    </div>
                                </div>
                                <!-- end: input -->
                            </div>
                            <!-- end: row -->


                            <!-- begin: row -->
                            <div class="row mt-2">
                                <!-- begin: input -->
                                @foreach (Config('global.permissions') as $key => $value)
                                    <div class="col-md-3 mt-1">
                                        <fieldset class="checkboxsas">
                                            <label>
                                                <input type="checkbox" value="{!! $key !!}"
                                                    name="permissions[]" class="checkbox pt-2">
                                                {{ __(config('global.permissions.', $value)) }}
                                            </label>
                                        </fieldset>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <span class="text text-danger">
                                        <strong id="permissions_error"></strong>
                                    </span>
                                </div>
                                <!-- end: input -->
                            </div>
                            <!-- end: row -->

                        </div>
                    </div>
                    <!--end: form-->
                </div>
                <!--end::modal body-->

                <!--begin::modal footer-->
                <div class="modal-footer">
                    <button type="submit" id="create_role_btn" class="btn btn-info font-weight-bold ">
                        {{ trans('general.save') }}
                        <i class="la la-refresh spinner spinner_loading d-none">
                        </i>
                    </button>

                    <button type="button" id="cancel_role_btn" class="btn btn-light-dark font-weight-bold"
                        data-dismiss="modal">
                        {{ trans('general.cancel') }}
                    </button>
                </div>
                <!--end::modal footer-->

            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        // reset
        function resetCreateForm() {
            $('#role_ar').css('border-color', '');
            $('#role_en').css('border-color', '');
            $('#permissions').css('border-color', '');

            $('#role_ar_error').text('');
            $('#role_en_error').text('');
            $('#permissions_error').text('');

        }

        // cancel
        $('body').on('click', '#cancel_role_btn', function(e) {
            $('#createRoleModal').modal('hide');
            $('#create_role_form')[0].reset();
            resetCreateForm();
        });

        // hide
        $('#createRoleModal').on('hidden.bs.modal', function(e) {
            $('#createRoleModal').modal('hide');
            $('#create_role_form')[0].reset();
            resetCreateForm();
        });


        // create
        $('#create_role_form').on('submit', function(e) {
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
                        console.log(data);
                        $('#myTable').load(location.href + (' #myTable'));
                        $('#create_role_form')[0].reset();
                        resetCreateForm();
                        $('#createRoleModal').modal('hide');
                        flasher.success("{!! __('general.add_success_message') !!}");
                    } else {
                        flasher.error("{!! __('general.add_error_message') !!}");
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        if (key == 'role.en') {
                            key = 'role_en';
                        } else if (key == 'role.ar') {
                            key = 'role_ar';
                        }
                        $('#' + key + '_error').text(value[0]);
                        $('#' + key).css('border-color', '#F64E60');
                    });
                }, //end error
                complete: function() {
                    $('.spinner_loading').addClass('d-none');
                }
            });

        });
    </script>
@endpush




