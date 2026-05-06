<div class="tab-pane fade" id="customer" role="tabpanel">
    <div class="row d-flex align-items-stretch">
        <!-- Right Column: Guarantor Details -->
        <div class="col-lg-4 mb-3">
            <div class="card border-0 shadow-sm h-100 mb-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-user-shield text-success mr-1"></i>
                        <span>{!! __('customers.guarantor') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3 text-center">
                    @if (optional($contract->customer)->guarantor)
                        <div class="avatar bg-light-success p-2 mb-2 mx-auto"
                            style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-shield text-success h4 mb-0"></i>
                        </div>
                        <h6 class="text-dark font-weight-bold mb-1">{!! $contract->customer->guarantor->name !!}</h6>
                        @php
                            $rel = strtolower($contract->customer->guarantor->relationship);
                            $translatedRel = Lang::has('guarantors.relationships.' . $rel) 
                                ? __('guarantors.relationships.' . $rel) 
                                : $contract->customer->guarantor->relationship;
                        @endphp
                        <span class="badge badge-light-success badge-pill font-small-2 mb-3">{!! $translatedRel !!}</span>

                        <div class="text-right border-top pt-2">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted font-small-3">{!! __('customers.phone') !!}</span>
                                <span class="text-dark font-weight-bold font-small-3">{!! $contract->customer->guarantor->phone !!}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted font-small-3">{!! __('customers.personal_id') !!}</span>
                                <span class="text-dark font-weight-bold font-small-3">{!! $contract->customer->guarantor->id_number !!}</span>
                            </div>
                        </div>
                    @else
                        <div class="py-3">
                            <i class="fas fa-user-slash font-large-1 text-muted mb-2 d-block"></i>
                            <span class="text-muted font-small-3">{!! __('customers.no_guarantor') !!}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Left Column: Tenant Basic Info -->
        <div class="col-lg-8 mb-3">
            <div class="card border-0 shadow-sm h-100 mb-0" style="border-radius: 12px;">
                <div
                    class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-user-tie text-primary mr-1"></i>
                        <span>{!! __('contracts.customer') !!}</span>
                    </h6>
                    <a href="{!! route('dashboard.customers.index') !!}?id={!! $contract->customer_id !!}"
                        class="btn btn-sm btn-light-primary px-2 py-0 font-small-3">
                        {!! __('customers.view_customer') !!} <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('customers.full_name') !!}</span>
                            <span class="text-dark font-weight-bold h6 mb-0">{!! optional($contract->customer)->name !!}</span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('customers.personal_id') !!}</span>
                            <span class="text-dark font-weight-bold">{!! optional($contract->customer)->id_number ?? '---' !!}</span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('customers.tenant_type') !!}</span>
                            <span class="badge badge-light-info badge-pill font-small-2">{!! __('customers.' . (optional($contract->customer)->tenant_type ?? 'individual')) !!}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('customers.phone') !!}</span>
                            <span class="text-primary font-weight-bold">
                                {!! optional($contract->customer)->phone !!} <i class="fas fa-phone-alt font-small-2 ml-1 text-muted"></i>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('customers.email') !!}</span>
                            <span class="text-dark font-weight-bold font-small-3">{!! optional($contract->customer)->email ?? '---' !!}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('customers.nationality') !!}</span>
                            <span class="text-dark font-weight-bold">{!! optional(optional($contract->customer)->nationality)->name ?? '---' !!}</span>
                        </div>
                        <div class="col-12">
                            <div class="p-2 bg-light rounded-lg border-primary-left border"
                                style="border-radius: 10px;">
                                <span class="text-muted font-small-3 d-block mb-0">{!! __('customers.address') !!}</span>
                                <span class="text-dark font-weight-bold font-small-3">
                                    {!! optional($contract->customer)->address ?? '---' !!} <i class="fas fa-map-marker-alt text-danger ml-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
