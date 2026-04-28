<div class="modal modal-pop fade updateDailyReportModal" id="updateDailyReportModal" tabindex="-1"
    aria-labelledby="createDailyReportModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-md" role="document">
        <form class="form" action="" method="POST" enctype="multipart/form-data" id='update_daily_report_form'>
            @csrf
            @method('PUT')
            <div class="modal-content">

                <!--begin::modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDailyReportModalLabel">{!! __('dailyReports.update_daily_report') !!}
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
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" id="id_edit" name="id" class="form-control">
                                    </div>
                                </div>
                                <!-- end: input -->

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
                                <div class="col-md-12 mb-3">
                                    <div class="premium-form-group">
                                        <label
                                            class="premium-label font-weight-bold text-dark">{!! __('dailyReports.date') !!}</label>
                                        <div class="premium-input-wrapper">
                                            <input type="date" id="date_edit" name="date" readonly
                                                style="background-color: #f8fafc" value="{!! old('date') !!}"
                                                class="form-control premium-input shadow-none" autocomplete="off"
                                                placeholder="{!! __('dailyReports.enter_date') !!}">
                                            <i class="la la-calendar text-indigo"></i>
                                        </div>
                                        <span class="text text-danger small"><strong
                                                id="date_error_edit"></strong></span>
                                    </div>
                                </div>
                                <!-- end: input -->
                            </div>
                            <!-- end: row -->


                            <!-- begin: row  -->
                            <div class="row">
                                <!-- begin: input details-->
                                <div class="col-md-12 mb-3">
                                    <div class="premium-form-group">
                                        <label
                                            class="premium-label font-weight-bold text-dark">{!! __('dailyReports.details') !!}</label>
                                        <textarea id="details_edit" name="details" class="form-control premium-input shadow-none details_summernote_edit"
                                            placeholder="{!! __('dailyReports.enter_details') !!}"></textarea>
                                        <span class="text text-danger small"><strong
                                                id="details_error_edit"></strong></span>
                                    </div>
                                </div>
                                <!-- end: input -->
                            </div>
                            <!-- end: row -->

                            <!-- begin: row  -->
                            <div class="row">
                                <!-- begin: input -->
                                <div class="col-md-12">
                                    <div class="premium-form-group">
                                        <label
                                            class="premium-label font-weight-bold text-dark">{!! __('dailyReports.file') !!}</label>
                                        <div class="premium-input-wrapper">
                                            <input type="file" id="file_edit" name="file"
                                                class="form-control premium-input shadow-none" autocomplete="off"
                                                placeholder="{!! __('dailyReports.enter_file') !!}">
                                            <i class="la la-cloud-upload text-indigo"></i>
                                        </div>
                                        <span class="text text-danger small"><strong
                                                id="file_error_edit"></strong></span>
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
                    <button type="submit" id="create_governorate_btn" class="btn btn-info font-weight-bold ">
                        {!! __('general.save') !!}
                        <div class="spinner-border spinner-border-sm spinner_loading d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>

                    <button type="button" id="cancel_daily_report_btn" class="btn btn-light-dark font-weight-bold"
                        data-dismiss="modal">
                        {!! __('general.cancel') !!}
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
            $('.details_summernote_edit').summernote({
                placeholder: '{!! __('general.write_here') !!}',
                tabsize: 2,
                height: 370,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'video']],
                ]
            });
        });


        // show edit modal
        $('body').on('click', '.edit_employees_daily_report_btn', function(e) {
            e.preventDefault();

            var daily_report_id = $(this).attr('daily-report-id');
            var daily_report_date = $(this).attr('daily-report-date');
            var daily_report_time = $(this).attr('daily-report-time');
            var daily_report_details = $(this).attr('daily-report-details');

            $('#id_edit').val(daily_report_id);
            $('#date_edit').val(daily_report_date);
            $('#time_edit').val(daily_report_time);
            $('.details_summernote_edit').summernote('code', daily_report_details);

            $('.updateDailyReportModal').modal('show');
        })

        // reset
        function resetEditForm() {
            $('#date_edit').css('border-color', '');
            $('#time_edit').css('border-color', '');
            $('.details_summernote_edit').next('.note-editor').removeClass(
                'is-invalid-summernote-editor');

            $('#date_error_edit').text('');
            $('#time_error_edit').text('');
            $('#details_error_edit').text('');
        }

        // cancel
        $('body').on('click', '#cancel_daily_report_btn', function(e) {
            $('.updateDailyReportModal').modal('hide');
            $('#update_daily_report_form')[0].reset();
            $('.details_summernote_edit').summernote('code', '');
            resetEditForm();
        });

        // hide
        $('#updateDailyReportModal').on('hidden.bs.modal', function(e) {
            $('.updateDailyReportModal').modal('hide');
            $('#update_daily_report_form')[0].reset();
            $('.details_summernote_edit').summernote('code', '');
            resetEditForm();
        });


        // update
        $('#update_daily_report_form').on('submit', function(e) {
            e.preventDefault();
            // reset
            resetEditForm();

            // paramters
            var governorate_id = $('#id_edit').val();
            var data = new FormData(this);
            var type = $(this).attr('method');
            var url = "{!! route('employees.dailyReports.update', 'id') !!}".replace('id', governorate_id);

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
                        $('.updateDailyReportModal').modal('hide');
                        $('#update_daily_report_form')[0].reset();
                        resetEditForm();
                        $('.details_summernote_edit').summernote('code', '');

                        flasher.success("{!! __('general.update_success_message') !!}");
                    } else {
                        flasher.error("{!! __('general.update_error_message') !!}");
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        if (key == 'details') {
                            $('.details_summernote_edit').next('.note-editor')
                                .addClass(
                                    'is-invalid-summernote-editor');
                        }
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
