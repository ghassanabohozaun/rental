<a href="javascript:void(0)" class="btn btn-link btn-fw" id="show_daily_report_refuse_btn"
    daily-report-refuse-reason="{{ $monthlyReport->refuse_reason }}">
    {!! __('monthlyReports.refuse_reason') !!}
</a>

<!-- begin: modal-->
<div class="modal modal-pop fade" id="refuseReasonModal" tabindex="-1" aria-labelledby="createRefuseReasonModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-md" role="document">

        <div class="modal-content">

            <!--begin::modal header-->
            <div class="modal-header">
                <h5 class="modal-title" id="refuseReasonModalLabel">
                    {!! __('monthlyReports.details') !!}
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
                                    <textarea type="text" rows="6" id="refuse_reason" class="form-control" disabled></textarea>
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
        //show daily report details
        $('body').on('click', '#show_daily_report_refuse_btn', function(e) {
            e.preventDefault();

            var daily_report_refuse_reason = $(this).attr('daily-report-refuse-reason');

            $('#refuse_reason').val(daily_report_refuse_reason);

            $('#refuseReasonModal').modal('show');
        })
    </script>
@endpush




