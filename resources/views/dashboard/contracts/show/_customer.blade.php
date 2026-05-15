<div class="tab-pane fade" id="customer" role="tabpanel">
    <!-- 1. Main Tenant Horizontal Card -->
    <div class="card detail-card-master border-0 shadow-sm mb-4 radius-15">
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center justify-content-between" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-user-tie text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('contracts.customer') !!}
            </h5>
            <a href="{!! route('dashboard.customers.index') !!}?id={!! $contract->customer_id !!}"
                class="btn btn-sm btn-light-primary px-2 py-0 font-small-3 radius-6">
                {!! __('customers.view_customer') !!} <i class="fas fa-external-link-alt mx-1"></i>
            </a>
        </div>
        <div class="card-body pt-3 pb-3">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="data-grid-item">
                        <div class="data-grid-icon bg-light-primary-opacity">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div class="data-grid-content">
                            <label class="data-grid-label">{!! __('customers.full_name') !!}</label>
                            <span class="data-grid-value">{!! optional($contract->customer)->name !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="data-grid-item">
                        <div class="data-grid-icon bg-light-info-opacity">
                            <i class="fas fa-id-card text-info"></i>
                        </div>
                        <div class="data-grid-content">
                            <label class="data-grid-label">{!! __('customers.personal_id') !!}</label>
                            <span class="data-grid-value">{!! optional($contract->customer)->id_number ?? '---' !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="data-grid-item">
                        <div class="data-grid-icon bg-light-warning-opacity">
                            <i class="fas fa-phone text-warning"></i>
                        </div>
                        <div class="data-grid-content">
                            <label class="data-grid-label">{!! __('customers.phone') !!}</label>
                            <span class="data-grid-value">{!! optional($contract->customer)->phone !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="data-grid-item">
                        <div class="data-grid-icon bg-light-success-opacity">
                            <i class="fas fa-globe text-success"></i>
                        </div>
                        <div class="data-grid-content">
                            <label class="data-grid-label">{!! __('customers.nationality') !!}</label>
                            <span class="data-grid-value">{!! optional(optional($contract->customer)->nationality)->name ?? '---' !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-2 border-dashed-premium rounded bg-light-blue-info d-flex align-items-center">
                        <i class="fas fa-map-marker-alt text-danger mx-2"></i>
                        <span class="text-muted mx-2">{!! __('customers.address') !!}:</span>
                        <span class="text-dark font-weight-bold">{!! optional($contract->customer)->address ?? '---' !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Guarantors Table Section -->
    <div class="card detail-card-master border-0 shadow-sm radius-15">
        <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
            <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                <i class="fas fa-user-shield text-success mr-1" style="font-size: 1.2rem !important;"></i> {!! __('customers.guarantors') !!}
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted" style="font-size: 13px;">
                            <th class="border-top-0 py-2">{!! __('customers.full_name') !!}</th>
                            <th class="border-top-0 py-2">{!! __('customers.personal_id') !!}</th>
                            <th class="border-top-0 py-2">{!! __('customers.phone') !!}</th>
                            <th class="border-top-0 py-2">{!! __('customers.relationship') !!}</th>
                            <th class="border-top-0 py-2">{!! __('customers.nationality') !!}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse(optional($contract->customer)->guarantors ?? [] as $guarantor)
                        <tr>
                            <td class="py-2 font-weight-bold text-dark">{!! $guarantor->name !!}</td>
                            <td class="py-2">{!! $guarantor->id_number !!}</td>
                            <td class="py-2 text-primary">{!! $guarantor->phone !!}</td>
                            <td class="py-2">
                                @php
                                    $rel = strtolower($guarantor->relationship);
                                    $translatedRel = Lang::has('guarantors.relationships.' . $rel) 
                                        ? __('guarantors.relationships.' . $rel) 
                                        : $guarantor->relationship;
                                @endphp
                                <span class="badge badge-light-success badge-pill border-0 px-2">{!! $translatedRel !!}</span>
                            </td>
                            <td class="py-2">{!! optional($guarantor->nationality)->name ?? '---' !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="opacity-50">
                                    <i class="fas fa-user-slash font-large-1 mb-2 d-block"></i>
                                    {!! __('customers.no_guarantor') !!}
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


