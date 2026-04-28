<div class="modal modal-pop fade" id="addMonthlyReportModal" tabindex="-1" role="dialog"
    aria-labelledby="addMonthlyReportModalLabel" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-md" role="document">
        <form class="form" action="{!! route('employees.monthlyReports.store') !!}" method="POST" enctype="multipart/form-data"
            id='create_monthly_report_form'>
            @csrf
            <div class="modal-content">

                <!--begin::modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="createMonthlyReportModalLabel">
                        <i class="mdi mdi-file-plus-outline text-primary fs-4"></i>
                        {!! __('monthlyReports.create_new_monthly_report') !!}
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
                            <div class="row d-none">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="employee_id" id="employee_id" class="form-control"
                                            value="{!! employee()->user()->id !!}">
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
                                        <input type="month" id="month" name="month" class="form-control"
                                            autocomplete="off" placeholder="{!! __('monthlyReports.enter_month') !!}">
                                        <span class="text text-danger">
                                            <strong id="month_error"></strong>
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
                                        <label for="details">{!! __('monthlyReports.details') !!}</label>
                                        <textarea rows="5" id="details" name="details" class="form-control" autocomplete="off"
                                            placeholder="{!! __('monthlyReports.enter_details') !!}"></textarea>
                                        <span class="text text-danger">
                                            <strong id="details_error"></strong>
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
                                        <input type="file" id="file" name="file" class="form-control"
                                            placeholder="{!! __('monthlyReports.enter_file') !!}"></input>
                                        <span class="text text-danger">
                                            <strong id="file_error"></strong>
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
                        <div class="spinner-border spinner-border-sm spinner_loading d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <button type="button" id="cancel_monthly_report_btn" class="btn btn-light-dark font-weight-bold">
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
        $(document).ready(function() {

            // open create modal
            $('body').on('click', '#create_monthly_report_btn', function(e) {
                $('#addMonthlyReportModal').modal('show');
            });


            // reset
            function resetCreateForm() {
                $('#month').css('border-color', '');
                $('#file').css('border-color', '');

                $('#month_error').text('');
                $('#file_error').text('');
            }

            // cancel
            $('body').on('click', '#cancel_monthly_report_btn', function(e) {
                $('#addMonthlyReportModal').modal('hide');
                $('#create_monthly_report_form')[0].reset();
                resetCreateForm();
            });

            // hide
            $('#addMonthlyReportModal').on('hidden.bs.modal', function(e) {
                $('#addMonthlyReportModal').modal('hide');
                $('#create_monthly_report_form')[0].reset();
                resetCreateForm();
            });


            // create
            $('#create_monthly_report_form').on('submit', function(e) {
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
                        $('#loading-indicator').show();
                    },
                    success: function(data) {
                        if (data.status == 'added') {
                            if (typeof window.fetch_data === 'function') {
                                window.fetch_data(1);
                            } else {
                                $('#myTable').load(location.href + (' #myTable'));
                            }
                            $('#create_monthly_report_form')[0].reset();
                            resetCreateForm();
                            if (document.activeElement) { document.activeElement.blur(); }
                            $('#addMonthlyReportModal').modal('hide');
                            flasher.success("{!! __('general.add_success_message') !!}");
                        } else if (data.status == 'error') {
                            flasher.error("{!! __('general.add_error_message') !!}");
                        } else if (data.status == 'exists') {
                            flasher.error("{!! __('general.recored_exists') !!}");
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




