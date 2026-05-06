<!-- Personal Info Tab -->
<div class="tab-pane fade show active" id="details" role="tabpanel">
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-id-card text-primary mr-1"></i>
                        <span>{!! __('customers.identity_info') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="info-row mb-2 d-flex justify-content-between align-items-center border-bottom pb-1">
                        <span class="text-muted font-small-3">{!! __('customers.id_number') !!}</span>
                        <span class="text-dark font-weight-bold">{!! $customer->id_number !!}</span>
                    </div>
                    <div class="info-row mb-2 d-flex justify-content-between align-items-center border-bottom pb-1">
                        <span class="text-muted font-small-3">{!! __('customers.nationality') !!}</span>
                        <span class="text-dark font-weight-bold">{!! optional($customer->nationality)->name !!}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between align-items-center">
                        <span class="text-muted font-small-3">{!! __('customers.tenant_type') !!}</span>
                        <span class="badge badge-light-primary">{!! __('customers.type_' . strtolower($customer->tenant_type)) !!}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-address-book text-primary mr-1"></i>
                        <span>{!! __('customers.contact_info') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="info-row mb-2 d-flex justify-content-between align-items-center border-bottom pb-1">
                        <span class="text-muted font-small-3">{!! __('customers.phone') !!}</span>
                        <span class="text-dark font-weight-bold">{!! $customer->phone !!}</span>
                    </div>
                    <div class="info-row mb-2 d-flex justify-content-between align-items-center border-bottom pb-1">
                        <span class="text-muted font-small-3">{!! __('customers.email') !!}</span>
                        <span class="text-dark font-weight-bold">{!! $customer->email ?: '---' !!}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between align-items-center">
                        <span class="text-muted font-small-3">{!! __('customers.status') !!}</span>
                        <span class="badge badge-light-{!! $customer->status ? 'success' : 'danger' !!}">
                            {!! $customer->status ? __('general.active') : __('general.inactive') !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-sticky-note text-primary mr-1"></i>
                        <span>{!! __('general.notes') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <p class="text-muted font-small-3 mb-0">
                        {!! $customer->notes ?: __('general.no_notes') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if($customer->guarantor)
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-user-shield text-info mr-1"></i>
                        <span>{!! __('guarantors.guarantor_details') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-3 border-right border-light d-flex align-items-center">
                            <div class="bg-light-info p-2 rounded-circle mr-2">
                                <i class="fas fa-user text-info font-medium-3"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 font-weight-bold text-dark">{!! $customer->guarantor->name !!}</h5>
                                <small class="text-info font-weight-bold">
                                    @php
                                        $rel = $customer->guarantor->relationship;
                                        $relKey = strtolower($rel);
                                        $transKey = 'guarantors.relationships.' . $relKey;
                                    @endphp
                                    {!! \Illuminate\Support\Facades\Lang::has($transKey) ? __($transKey) : $rel !!}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3 border-right border-light d-flex flex-column justify-content-center px-3">
                            <span class="text-muted font-small-3">{!! __('guarantors.id_number') !!}</span>
                            <span class="text-dark font-weight-bold">{!! $customer->guarantor->id_number !!}</span>
                        </div>
                        <div class="col-md-3 border-right border-light d-flex flex-column justify-content-center px-3">
                            <span class="text-muted font-small-3">{!! __('guarantors.phone') !!}</span>
                            <span class="text-dark font-weight-bold">{!! $customer->guarantor->phone !!}</span>
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-center px-3">
                            <span class="text-muted font-small-3">{!! __('guarantors.address') !!}</span>
                            <span class="text-dark">{!! $customer->guarantor->address ?: '---' !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
