<!-- Personal Info Tab -->
<div class="tab-pane fade show active" id="details" role="tabpanel">
    <!-- Main Info Section (12) - Expanded Grid -->
    <div class="col-md-12">
        <div class="card border-0 shadow-sm mb-2 radius-15">
            <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
                <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                    <i class="fas fa-user-circle text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('customers.personal_info') !!}
                </h5>
            </div>
            <div class="card-body pt-3 pb-3">
                <div class="row">
                    <!-- 1. Name Ar -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-primary-opacity">
                                <i class="fas fa-signature text-primary"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.name_ar') !!}</label>
                                <span class="data-grid-value">{!! $customer->getTranslation('name', 'ar') !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Name En -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-info-opacity">
                                <i class="fas fa-font text-info"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.name_en') !!}</label>
                                <span class="data-grid-value">{!! $customer->getTranslation('name', 'en') !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Tenant Type -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-warning-opacity">
                                <i class="fas fa-users-cog text-warning"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.tenant_type') !!}</label>
                                <span class="data-grid-value text-warning">{!! __('customers.type_' . strtolower($customer->tenant_type)) !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. ID Number -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-dark-opacity">
                                <i class="fas fa-passport text-dark"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.id_number') !!}</label>
                                <span class="data-grid-value">{!! $customer->id_number !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Nationality -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-success-opacity">
                                <i class="fas fa-globe-africa text-success"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.nationality') !!}</label>
                                <span class="data-grid-value">{!! optional($customer->nationality)->name !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Phone -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-primary-opacity">
                                <i class="fas fa-phone-alt text-primary"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.phone') !!}</label>
                                <span class="data-grid-value">{!! $customer->phone !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Email -->
                    <div class="col-md-4 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-info-opacity">
                                <i class="fas fa-envelope text-info"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.email') !!}</label>
                                <span class="data-grid-value font-small-3">{!! $customer->email ?: '---' !!}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Address -->
                    <div class="col-md-8 mb-3">
                        <div class="data-grid-item">
                            <div class="data-grid-icon bg-light-danger-opacity">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                            </div>
                            <div class="data-grid-content">
                                <label class="data-grid-label">{!! __('customers.address') !!}</label>
                                <span class="data-grid-value">{!! $customer->address ?: '---' !!}</span>
                            </div>
                        </div>
                    </div>

                    @if (strtolower($customer->tenant_type) == 'company')
                        <div class="col-12">
                            <hr class="my-2 opacity-50 border-dashed-premium">
                        </div>

                        <!-- Company Specifics -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item border-left-primary-3">
                                <div class="data-grid-icon bg-light-primary-opacity">
                                    <i class="fas fa-building text-primary"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('customers.customer_company_name') !!}</label>
                                    <span class="data-grid-value text-primary">{!! $customer->company_name !!}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-dark-opacity">
                                    <i class="fas fa-file-invoice text-dark"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('customers.cr_number') !!}</label>
                                    <span class="data-grid-value">{!! $customer->cr_number !!}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-warning-opacity">
                                    <i class="fas fa-certificate text-warning"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('customers.license_number') !!}</label>
                                    <span class="data-grid-value">{!! $customer->license_number !!}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-info-opacity">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('customers.establishment_number') !!}</label>
                                    <span class="data-grid-value">{!! $customer->establishment_number !!}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Notes Section - Integrated -->
                <div class="col-12 mt-2">
                    <div class="notes-area-premium p-2 rounded bg-light-warning-opacity border-left-warning-3">
                        <h6 class="font-weight-bold text-warning mb-1" style="font-size: 1.1rem !important;">
                            <i class="fas fa-sticky-note mr-1" style="font-size: 1.2rem !important;"></i> {!! __('customers.notes') !!}
                        </h6>
                        <p class="text-muted font-small-3 mb-0">
                            {!! $customer->notes ?: __('general.no_notes') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
