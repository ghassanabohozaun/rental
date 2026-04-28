<a href="javascript:void(0)" class="btn btn-link btn-fw" id="show_daily_report_details_btn"
    daily-report-details="{{ $dailyReport->details }}">
    {!! __('dailyReports.show_details') !!}
</a>

<!-- begin: modal-->
<div class="modal modal-pop fade" id="detailsModal" tabindex="-1" aria-labelledby="createDailyReportModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-md" role="document">

        <div class="modal-content">

            <!--begin::modal header-->
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">
                    {!! __('dailyReports.details') !!}
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
                        <!-- begin: row  -->
                        <div class="row">
                            <!-- begin: input details-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea type="text" rows="12" id="details" name="details"
                                        class="form-control daily_report_details_summernote" placeholder="{!! __('dailyReports.enter_details') !!}"></textarea>
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
        </div>
    </div>
</div>
<!-- end: modal-->
@push('scripts')
    <script>
        $('body').on('click', '#show_daily_report_details_btn', function(e) {
            e.preventDefault();

            var daily_report_details = $(this).attr('daily-report-details');

            $('.daily_report_details_summernote').summernote({
                placeholder: '{!! __('general.write_here') !!}',
                tabsize: 2,
                height: 370,
                toolbar: [

                ]
            });
            $('.daily_report_details_summernote').summernote('code', daily_report_details);
            $('.daily_report_details_summernote').summernote('disable');
            $('#detailsModal').modal('show');
        })
    </script>
@endpush




