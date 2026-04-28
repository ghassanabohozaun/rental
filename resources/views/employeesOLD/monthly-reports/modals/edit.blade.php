<div class="modal modal-pop fade" id="updateMonthlyReportModal" tabindex="-1" role="dialog"
    aria-labelledby="updateMonthlyReportModalLabel">

    <div class="modal-dialog modal-md" role="document">
        <form class="form" action="" method="POST" enctype="multipart/form-data" id='update_monthly_report_form'>
            @csrf
            @method('PUT')
            <div class="modal-content">

                <!--begin::modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMonthlyReportModalLabel">
                        <i class="mdi mdi-file-edit-outline text-info fs-4"></i>
                        {!! __('monthlyReports.update_monthly_report') !!}
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <!--end::modal header-->

                <!--begin::modal body-->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">

                            <!-- begin: row -->
                            <div class="row  d-none">
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
                            <div class="row d-none">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="employee_id" id="employee_id_edit"
                                            class="form-control" value="{!! employee()->user()->id !!}">
                                    </div>
                                </div>
                            </div>
                            <!-- end: row -->


                            <!-- begin: row -->
                            <div class="row">
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="month">{!! __('monthlyReports.month') !!}</label>
                                        <input type="month" id="month_edit" name="month" readonly
                                            style="background-color: rgb(228, 225, 225)" class="form-control"></label>
                                    </div>
                                    <span class="text text-danger">
                                        <strong id="month_error_edit"></strong>
                                    </span>
                                </div>
                                <!-- end: input -->

                            </div>
                            <!-- end: row -->

                            <!-- begin: row -->
                            <div class="row">
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="details">{!! __('monthlyReports.details') !!}</label>
                                        <textarea rows="5" id="details_edit" name="details" class="form-control" autocomplete="off"
                                            placeholder="{!! __('monthlyReports.enter_details') !!}"></textarea>
                                        <span class="text text-danger">
                                            <strong id="details_error_edit"></strong>
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
                                        <label for="file">{!! __('monthlyReports.file') !!}</label>
                                        <input type="file" id="file_edit" name="file" class="form-control"
                                            placeholder="{!! __('monthlyReports.enter_file') !!}"></input>
                                        <span class="text text-danger">
                                            <strong id="file_error_edit"></strong>
                                        </span>
                                    </div>
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
                    <button type="submit" class="btn btn-info font-weight-bold ">
                        {{ __('general.save') }}
                        <i class="la la-refresh spinner spinner_loading d-none">
                        </i>
                    </button>

                    <button type="button" id="cancel_monthly_report_btn_edit"
                        class="btn btn-light-dark font-weight-bold" data-dismiss="modal">
                        {{ __('general.cancel') }}
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
        $('body').on('click', '.edit_employees_monthly_report_btn', function(e) {

            e.preventDefault();
            var monthly_report_id = $(this).attr('monthly-report-id');
            var month = $(this).attr('monthly-report-month');
            var year = $(this).attr('monthly-report-year');
            var formattedMonth = year + '-' + month;
            var monthly_report_details = $(this).attr('monthly-report-details');

            $('#id_edit').val(monthly_report_id);
            $('#month_edit').val(formattedMonth);
            $('#details_edit').val(monthly_report_details);

            $('#updateMonthlyReportModal').modal('show');
        })


        // reset
        function resetEditForm() {
            $('#month_edit').css('border-color', '');
            $('#file_edit').css('border-color', '');

            $('#month_error_edit').text('');
            $('#file_error_edit').text('');
        }

        // cancel
        $('body').on('click', '#cancel_monthly_report_btn_edit', function(e) {
            $('#updateMonthlyReportModal').modal('hide');
            $('#update_monthly_report_form')[0].reset();
            resetEditForm();
        });

        // hide
        $('#updateMonthlyReportModal').on('hidden.bs.modal', function(e) {
            $('#updateMonthlyReportModal').modal('hide');
            $('#update_monthly_report_form')[0].reset();
            resetEditForm();
        });


        // update
        $('#update_monthly_report_form').on('submit', function(e) {
            e.preventDefault();

            // reset
            resetEditForm();

            // paramters
            var id = $('#id_edit').val();
            var data = new FormData(this);
            var type = $(this).attr('method');
            var url = "{!! route('employees.monthlyReports.update', 'id') !!}".replace('id', id);

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
                    $('#loading-indicator').show();
                },
                success: function(data) {
                    if (data.status == true) {
                        if (typeof window.fetch_data === 'function') {
                            window.fetch_data(window.currentPage || 1);
                        } else {
                            $('#myTable').load(location.href + (' #myTable'));
                        }
                        resetEditForm();
                        if (document.activeElement) { document.activeElement.blur(); }
                        $('#updateMonthlyReportModal').modal('hide');
                        flasher.success("{!! __('general.update_success_message') !!}");
                    } else {
                        flasher.error("{!! __('general.update_error_message') !!}");
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        $('#' + key + '_error_edit').text(value[0]);
                        $('#' + key + '_edit').css('border-color', '#F64E60');
                    });
                }, //end error
                complete: function() {
                    $('.spinner_loading').addClass('d-none');
                }
            });
        });
    </script>
@endpush
