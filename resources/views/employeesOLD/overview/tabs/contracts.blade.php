<div class="tab-pane fade" id="contracts" role="tabpanel" aria-labelledby="contracts">
    @php
        $contractDetails = $employee->employeeContractDetails;
        $allContracts = $employee->employeeContracts()->orderBy('contract_start_date', 'desc')->get();
        $currentContract = $allContracts->first();
    @endphp

    @php
        // Section check: if everything is empty, we still want to show the layout but with tables
        $hasAnyInfo = $contractDetails || !$allContracts->isEmpty();
    @endphp
        <!-- Contract Status & Summary -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="profile-hero-card d-sm-flex align-items-center justify-content-between gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon bg-label-primary p-3 rounded-4 shadow-sm" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                            <i class="mdi mdi-file-certificate-outline fs-1 text-primary"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h3 class="fw-bold text-dark mb-0">{!! __('employees.contract_details') !!}</h3>
                                @if($currentContract)
                                    <span class="badge bg-label-success rounded-pill px-2 py-1" style="font-size: 0.65rem;">
                                        <i class="mdi mdi-check-decagram me-1"></i>{!! __('employees.currently_active') !!}
                                    </span>
                                @endif
                            </div>
                            <p class="text-muted mb-0 lh-base">
                                @if($currentContract)
                                    <span class="d-block mb-1">
                                        {!! __('employees.contract_start_date') !!}: <span class="fw-bold text-dark">{!! $currentContract->contract_start_date ?? '---' !!}</span>
                                    </span>
                                    <span class="d-block">
                                        {!! __('employees.contract_duration') !!}: <span class="fw-bold text-dark">{!! $currentContract->contract_duration ?? '---' !!}</span>
                                    </span>
                                @else
                                    <span class="text-danger opacity-75">{!! __('employees.no_active_contract') !!}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    @if($currentContract)
                    <div class="d-flex gap-3 mt-3 mt-sm-0">
                        <div class="text-center px-4 py-2 bg-white rounded-3 border shadow-sm">
                            <span class="info-label d-block text-uppercase mb-1" style="font-size: 0.65rem !important;">{!! __('employees.monthly_salary') !!}</span>
                            <span class="fs-4 fw-bold text-primary">{!! $currentContract->monthly_salary ?? '0' !!}</span>
                            <span class="small text-muted">{!! $employee->currency !!}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($contractDetails)
        <div class="row g-4 mb-4">
            <!-- Duties & Hours -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <!-- Job Duties -->
                    <div class="col-md-6">
                        <div class="info-card h-100">
                            <div class="info-card-header bg-light-soft">
                                <i class="mdi mdi-clipboard-text-outline text-indigo"></i>
                                <h5>{!! __('employees.job_duties') !!}</h5>
                            </div>
                            <div class="info-card-body">
                                <div class="mb-0 text-dark lh-base fs-6">
                                    {!! $contractDetails->job_duties ?: '<span class="text-muted italic small">' . __('employees.no_duties_added') . '</span>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Working Hours -->
                    <div class="col-md-6">
                        <div class="info-card h-100">
                            <div class="info-card-header">
                                <i class="mdi mdi-clock-check-outline text-success"></i>
                                <h5>{!! __('employees.weekly_working_hours_and_days') !!}</h5>
                            </div>
                            <div class="info-card-body">
                                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-3">
                                    <i class="mdi mdi-calendar-clock fs-3 text-success"></i>
                                    <span class="fw-semibold">{!! $contractDetails->weekly_working_hours_and_days ?? '---' !!}</span>
                                </div>
                                <h6 class="info-label mb-2">{!! __('employees.holidays_and_festivals') !!}</h6>
                                <p class="small text-muted mb-0">{!! $contractDetails->holidays_and_festivals ?? '---' !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Terms -->
                    <div class="col-12">
                        <div class="info-card">
                            <div class="info-card-header">
                                <i class="mdi mdi-shield-check-outline text-warning"></i>
                                <h5>{!! __('employees.contract_terms') !!}</h5>
                            </div>
                            <div class="info-card-body">
                                <div class="mb-0 text-dark lh-base">
                                    {!! $contractDetails->contract_terms ?: '<span class="text-muted italic small">' . __('employees.no_terms_added') . '</span>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requirements & Education -->
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4 v-fill">
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="mdi mdi-school-outline text-primary"></i>
                            <h5>{!! __('employees.education_contract') !!}</h5>
                        </div>
                        <div class="info-card-body">
                            <p class="small mb-0">{!! $contractDetails->education_contract ?? '---' !!}</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="mdi mdi-briefcase-check-outline text-info"></i>
                            <h5>{!! __('employees.experiences_contract') !!}</h5>
                        </div>
                        <div class="info-card-body">
                            <p class="small mb-0">{!! $contractDetails->experiences_contract ?? '---' !!}</p>
                        </div>
                    </div>
                    <div class="info-card flex-grow-1">
                        <div class="info-card-header">
                            <i class="mdi mdi-dots-horizontal-circle-outline text-muted"></i>
                            <h5>{!! __('employees.other_requirements') !!}</h5>
                        </div>
                        <div class="info-card-body">
                            <p class="small mb-0">{!! $contractDetails->other_requirements ?? '---' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <!-- Partial Empty State for details -->
            <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
                <i class="mdi mdi-alert-circle-outline fs-2"></i>
                <div>
                    <h6 class="alert-heading fw-bold mb-1">{!! __('employees.details_missing') !!}</h6>
                    <p class="small mb-0">{!! __('employees.details_missing_desc') !!}</p>
                </div>
            </div>
        @endif

        <!-- Contracts History -->
        <div class="row">
            <div class="col-12">
                <div class="info-card">
                    <div class="info-card-header bg-label-info d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="mdi mdi-history"></i>
                            <h5>{!! __('employees.contracts') !!}</h5>
                        </div>
                    </div>
                    <div class="info-card-body p-0" id="contracts_table_wrapper">
                        @include('employees.overview.tabs.partials._contracts_table', ['contracts' => $allContracts])
                    </div>
                </div>
            </div>
        </div>
</div>

@include('employees.overview.modals.contract-details')

@push('scripts')
<script>
$(document).ready(function() {
    // Simple AJAX fetch for contracts (like monthly reports)
    window.fetch_contracts = function() {
        $.ajax({
            url: "{{ route('employees.overview.contracts.data') }}",
            type: 'GET',
            beforeSend: function() {
                // Optional loader
            },
            success: function(data) {
                $('#contracts_table_wrapper').html(data);
            }
        });
    }

    // Handle Details Modal manually (simple & direct)
    $(document).on('click', '.view-contract-details-btn', function() {
        var btn = $(this);
        
        $('#det_duration').text(btn.data('duration'));
        $('#det_salary').text(btn.data('salary'));
        $('#det_start_date').text(btn.data('start'));
        $('#det_expiry_date').text(btn.data('expiry'));
        $('#det_status').text(btn.data('status'))
            .removeClass('text-success text-secondary')
            .addClass(btn.data('status-color'));
        
        $('#contractDetailsModal').modal('show');
    });
});
</script>
@endpush

<style>
    .bg-light-soft { background-color: #f8fafc; }
    .text-indigo { color: #6610f2; }
    .v-fill { height: 100%; }
    
    .bg-label-info { background: rgba(0, 207, 221, 0.05); }
    .bg-label-primary { background: rgba(99, 102, 241, 0.05); }
    .bg-label-success { background: rgba(16, 185, 129, 0.08); color: #10b981; }
    .bg-label-secondary { background: rgba(100, 116, 139, 0.08); color: #64748b; }
    
    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        border-bottom: 2px solid #f1f5f9;
        padding-top: 15px;
        padding-bottom: 15px;
    }
    
    .table tbody td {
        padding-top: 15px;
        padding-bottom: 15px;
        vertical-align: middle;
        font-size: 0.9rem !important;
    }
</style>
