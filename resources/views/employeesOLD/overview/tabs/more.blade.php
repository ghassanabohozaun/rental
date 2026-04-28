<div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more">

    <!-- Hero Profile Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="profile-hero-card d-sm-flex align-items-center gap-4">
                <div class="hero-avatar-wrapper position-relative">
                    @php
                        $user = employee()->user();
                        $photoUrl = $user->photo ? asset('uploads/employeesPhotos/' . $user->photo) : null;
                        $colors = ['#5A8DEE', '#FDAC41', '#FF5B5C', '#39DA8A', '#00CFDD', '#7117EA', '#272727'];
                        $charIndex = abs(crc32($user->first_name)) % count($colors);
                        $bgColor = $colors[$charIndex];
                    @endphp
                    @if ($photoUrl)
                        <img src="{!! $photoUrl !!}" alt="avatar" class="profile-hero-avatar">
                    @else
                        <div class="profile-hero-initials"
                            style="background: linear-gradient(135deg, {!! $bgColor !!}, {!! $bgColor !!}dd);">
                            {!! $user->initials !!}
                        </div>
                    @endif
                </div>
                <div class="hero-content mt-3 mt-sm-0 flex-grow-1">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <h2 class="fw-bold text-dark mb-0" style="line-height: 1.2;">
                            <span class="d-block">{!! $employee->first_name !!} {!! $employee->father_name !!}</span>
                            <span class="d-block fs-3 opacity-75">{!! $employee->family_name !!}</span>
                        </h2>
                        <span
                            class="profile-badge @if ($employee->employeeJobDetails->employee_status_id == 1) bg-label-success @else bg-label-danger @endif"
                            style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                            {!! $employee->employeeJobDetails->employeeStatus->name ?? __('general.active') !!}
                        </span>
                    </div>
                    <p class="text-muted mb-3 d-flex align-items-center gap-2">
                        <i class="mdi mdi-briefcase-variant-outline"></i>
                        {!! $employee->employeeJobDetails->title ?? __('dashboard.employee') !!}
                        <span class="mx-2 text-silver opacity-50">|</span>
                        <i class="mdi mdi-office-building-outline"></i>
                        {!! $employee->employeeJobDetails->department->name ?? __('dashboard.no_department_found') !!}
                    </p>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="mdi mdi-email-outline text-primary"></i>
                            <span class="fw-semibold text-dark">{!! $employee->email !!}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="mdi mdi-phone-outline text-primary"></i>
                            <span class="fw-semibold text-dark">{!! $employee->mobile_no !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4">

        <!-- Personal Column -->
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <i class="mdi mdi-account-card-details-outline"></i>
                    <h5>{!! __('employees.basic') !!}</h5>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.personal_id') !!}</span>
                        <span class="info-value text-primary">{!! $employee->personal_id !!}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.gender') !!}</span>
                        <span class="info-value">{!! $employee->EmployeeGender() !!}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.marital_status') !!}</span>
                        <span class="info-value">{!! $employee->marital_status !!}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.birthday') !!}</span>
                        <span class="info-value">{!! $employee->birthday !!}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Details Column -->
        <div class="col-lg-4">
            <div class="info-card border-primary-light">
                <div class="info-card-header bg-label-primary">
                    <i class="mdi mdi-shield-account-outline"></i>
                    <h5>{!! __('employees.job_details') !!}</h5>
                </div>
                <div class="info-card-body">
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.supervisor') !!}</span>
                        <span class="info-value">{!! $employee->employeeJobDetails->supervisor ?? '---' !!}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.appointment_date') !!}</span>
                        <span class="info-value">{!! $employee->employeeJobDetails->appointment_date ?? '---' !!}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.contract_expiry_date') !!}</span>
                        <span class="info-value text-danger">{!! $employee->employeeJobDetails->contact_expire_date ?? '---' !!}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{!! __('employees.employment_type') !!}</span>
                        <span class="info-value badge bg-light text-dark fw-bold border" style="width: fit-content;">
                            {!! $employee->employeeJobDetails->EmploymentType() !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- address & Banking -->
        <div class="col-lg-4">
            <div class="d-flex flex-column gap-4" style="height: 100%;">
                <!-- Address Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="mdi mdi-map-marker-outline text-warning"></i>
                        <h5>{!! __('employees.address_details') !!}</h5>
                    </div>
                    <div class="info-card-body">
                        <div class="info-item">
                            <span class="info-label">{!! __('general.location') !!}</span>
                            <span class="info-value">{!! $employee->governorate->name !!}, {!! $employee->city->name !!}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">{!! __('employees.address_details') !!}</span>
                            <span class="info-value">{!! $employee->address_details !!}</span>
                        </div>
                    </div>
                </div>

                <!-- Banking Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="mdi mdi-bank-outline text-success"></i>
                        <h5>{!! __('employees.bank_details') !!}</h5>
                    </div>
                    <div class="info-card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="info-label">{!! __('employees.bank_name') !!}</span>
                            <span class="fw-bold">{!! $employee->bank_name !!}</span>
                        </div>
                        <div class="p-3 bg-light rounded-3 border border-dashed">
                            <div class="info-item mb-2">
                                <span class="info-label">IBAN</span>
                                <span class="info-value small text-monospace">{!! $employee->iban !!}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">{!! __('employees.basic_salary') !!}</span>
                                <span class="info-value fs-5">{!! $employee->basic_salary !!} <span
                                        class="text-primary fs-6">{!! $employee->currency !!}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education History - Specific Section -->
        <div class="col-12 mt-2">
            <div class="info-card">
                <div class="info-card-header d-flex justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-school-outline"></i>
                        <h5>{!! __('employees.education') !!}</h5>
                    </div>
                </div>
                <div class="info-card-body">
                    <div class="row">
                        @forelse ($employee->employeeEducation as $item)
                            <div class="col-md-6">
                                <div class="edu-item border">
                                    <div class="edu-icon">
                                        <i class="mdi mdi-certificate-outline"></i>
                                    </div>
                                    <div class="edu-content">
                                        <div class="edu-title">{!! $item->educational_instituation_name !!}</div>
                                        <div class="edu-meta">
                                            {!! $item->education_specialization !!} • {!! $item->EmployeEducationLevel() !!} •
                                            {!! $item->education_year !!}
                                        </div>
                                    </div>
                                    @if ($item->certification)
                                        <a href="{!! asset('uploads/employeesCertifications/' . $item->certification) !!}" target="_blank"
                                            class="btn btn-icon btn-light btn-sm shadow-sm"
                                            title="{!! __('general.download') !!}">
                                            <i class="mdi mdi-download text-primary"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted mb-0">{!! __('employees.no_data_found') !!}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
