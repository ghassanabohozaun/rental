@extends('layouts.employees.app')

@section('title', __('dashboard.monthly_reports'))


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">

                        <ul class="nav nav-tabs" role="tablist">

                        </ul>

                        <div>
                            <div class="btn-wrapper">
                                <button type="button" class="btn btn-primary text-white me-0" id="create_monthly_report_btn">
                                    <i class="fa fa-plus-circle"></i>
                                    {!! __('general.add') !!}
                                </button>
                                @include('employees.monthly-reports.modals.create')
                                @include('employees.monthly-reports.modals.edit')
                                @include('employees.monthly-reports.modals.details')
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview">

                            <div class="row">
                                <div class="col-lg-12 d-flex flex-column">

                                    <div class="table-container position-relative">
                                        <div id="loading-indicator" class="loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="spinner-premium"></div>
                                                <p class="mt-2 fw-semibold text-primary">{!! __('general.loading') !!}</p>
                                            </div>
                                        </div>
                                        <div id="table_data">
                                            @include('employees.monthly-reports.partials._table', [
                                                'monthlyReports' => $monthlyReports,
                                            ])
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        // Expose fetch_data globally so modals can use it
        window.fetch_data = function(page) {
            $.ajax({
                url: "{{ route('employees.monthlyReports.index') }}?page=" + (page || 1),
                data: {},
                beforeSend: function() {
                    $('#loading-indicator').show();
                },
                success: function(data) {
                    $('#table_data').html(data);
                },
                complete: function() {
                    $('#loading-indicator').hide();
                },
                error: function() {
                    $('#loading-indicator').hide();
                    flasher.error("{!! __('general.error_occurred') !!}");
                }
            });
        }

        $(document).ready(function() {
            let page = 1;

            // Handle pagination link clicks
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    window.currentPage = url.split('page=')[1];
                    fetch_data(window.currentPage);
                }
            });

            // Open Details Modal (Eye Icon)
            $(document).on('click', '.details-control', function() {
                var btn = $(this);

                // Extract data from attributes
                var employee_name = btn.attr('data-employee-name');
                var month_year = btn.attr('data-month-year');
                var details = btn.attr('data-details');
                var status_html = btn.attr('data-status-html');
                var file_url = btn.attr('data-file-url');
                var refuse_reason = btn.attr('data-refuse-reason');
                var has_refuse = btn.attr('data-has-refuse') === "1";

                // Populate Modal
                $('#display_employee_name').text(employee_name || '---');
                $('#display_month_year').text(month_year);
                $('#display_details').text(details || '---');
                $('#display_status').html(status_html);

                if (file_url) {
                    $('#display_file_area').html(
                        '<a class="btn btn-outline-primary btn-icon-text py-2 px-3" href="' + file_url +
                        '" download><i class="fa fa-download me-2"></i> {!! __('general.download') !!}</a>');
                } else {
                    $('#display_file_area').html(
                        '<span class="badge badge-opacity-danger">{!! __('general.no_file_found') !!}</span>');
                }

                if (has_refuse) {
                    $('#display_refuse_reason').text(refuse_reason || '---');
                    $('#refusal_section').removeClass('d-none');
                } else {
                    $('#refusal_section').addClass('d-none');
                }

                // Show Modal
                $('#detailsMonthlyReportModal').modal('show');
            });



            // Open Create Modal
            $('#create_monthly_report_btn').on('click', function() {
                $('#createMonthlyReportForm')[0].reset();
                $('#createMonthlyReportModal').modal('show');
            });

            // Open Edit Modal
            $(document).on('click', '.edit_employees_monthly_report_btn', function() {
                var btn = $(this);
                var id = btn.attr('monthly-report-id');
                var month = btn.attr('monthly-report-month');
                var year = btn.attr('monthly-report-year');
                var details = btn.attr('monthly-report-details');

                $('#edit_monthly_report_id').val(id);
                $('#edit_month').val(month);
                $('#edit_year').val(year);
                $('#edit_details').val(details);

                $('#editMonthlyReportModal').modal('show');
            });

            // Handle search input (e.g., on keyup)
            $('#search').on('keyup', function() {
                fetch_data(1); // Reset to page 1 on new search
            });

        });
    </script>
@endpush
