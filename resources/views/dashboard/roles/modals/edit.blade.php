<div class="modal modal-pop fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="updateRoleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <form class="form" action="" method="POST" enctype="multipart/form-data" id='update_role_form'>
            @csrf
            @method('PUT')
            <div class="modal-content">

                <!--begin::modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">{!! __('world.update_role') !!}
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
                            <div class="row d-none">
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" id="id_edit" name="id" class="form-control">
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
                                        <label for="role_ar">{!! __('roles.role_ar') !!}</label>
                                        <input type="text" id="role_ar_edit" name="role[ar]" class="form-control"
                                            autocomplete="off" placeholder="{!! __('roles.enter_role_ar') !!}">
                                        <span class="text text-danger">
                                            <strong id="role_ar_error_edit"></strong>
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
                                        <input type="text" id="role_en_edit" name="role[en]" class="form-control"
                                            autocomplete="off" placeholder="{!! __('roles.enter_role_en') !!}">
                                        <span class="text text-danger">
                                            <strong id="role_en_error_edit"></strong>
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
                                                    name="permissions[]" class="checkbox pt-2" {{-- @checked(in_array($key, $role->permissions)) --}}>
                                                {{ __(config('global.permissions.', $value)) }}
                                            </label>
                                        </fieldset>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <span class="text text-danger">
                                        <strong id="permissions_error_edit"></strong>
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
        // show edit modal
        $('body').on('click', '.edit_role_button', function(e) {
            e.preventDefault();
            var role_id = $(this).attr('role-id');
            var role_ar = $(this).attr('role-ar');
            var role_en = $(this).attr('role-en');
            //  var permissions = $(this).attr('permissions');



            $('#id_edit').val(role_id);
            $('#role_ar_edit').val(role_ar);
            $('#role_en_edit').val(role_en);
            // $('#permissions').val(permissions);

            // $.each(permissions, function(key, value) {
            //     return $key;
            //     // if (key == 'name.en') {
            //     //     key = 'name_en';
            //     // } else if (key == 'name.ar') {
            //     //     key = 'name_ar';
            //     // }

            // });

            $('#updateRoleModal').modal('show');
        })

        // reset
        function resetEditForm() {
            $('#role_ar_edit').css('border-color', '');
            $('#role_en_edit').css('border-color', '');
            $('#permissions_edit').css('border-color', '');

            $('#role_ar_error_edit').text('');
            $('#role_en_error_edit').text('');
            $('#permissions_error_edit').text('');

        }

        // cancel
        $('body').on('click', '#cancel_role_btn', function(e) {
            $('#updateRoleModal').modal('hide');
            $('#update_role_form')[0].reset();
            resetEditForm();
        });

        // hide
        $('#updateRoleModal').on('hidden.bs.modal', function(e) {
            $('#updateRoleModal').modal('hide');
            $('#update_role_form')[0].reset();
            resetEditForm();
        });


        // update
        $('#update_role_form').on('submit', function(e) {
            e.preventDefault();
            // reset
            resetEditForm();

            // paramters
            var role_id = $('#id_edit').val();
            var data = new FormData(this);
            var type = $(this).attr('method');
            var url = "{!! route('dashboard.roles.update', 'id') !!}".replace('id', role_id);

            $.ajax({
                url: url,
                data: data,
                type: type,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == true) {
                        console.log(data);
                        $('#myTable').load(location.href + (' #myTable'));
                        $('#update_role_form')[0].reset();
                        resetEditForm();
                        $('#updateRoleModal').modal('hide');
                        flasher.success("{!! __('general.add_success_message') !!}");
                    } else {
                        flasher.error("{!! __('general.add_error_message') !!}");
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        if (key == 'name.en') {
                            key = 'name_en';
                        } else if (key == 'name.ar') {
                            key = 'name_ar';
                        }
                        $('#' + key + '_error_edit').text(value[0]);
                        $('#' + key + '_edit').css('border-color', '#F64E60');
                    });
                }, //end error
            });

        });
    </script>
@endpush




