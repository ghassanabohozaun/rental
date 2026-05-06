<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
    <div class="row">
        <!-- Main Info Section -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-2 radius-15">
                <div class="card-header bg-transparent border-0 pt-2 pb-0">
                    <h5 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-info-circle text-primary mr-1"></i> {!! __('properties.basic_information') !!}
                    </h5>
                </div>
                <div class="card-body pt-1 pb-1">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="text-muted small text-uppercase mb-0">{!! __('properties.property_name') !!}</label>
                            <p class="font-weight-bold mb-0">{!! $property->name !!}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-muted small text-uppercase mb-0">{!! __('properties.property_number') !!}</label>
                            <p class="font-weight-bold mb-0">{!! $property->property_number !!}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-muted small text-uppercase mb-0">{!! __('properties.property_type') !!}</label>
                            <p class="font-weight-bold mb-0">{!! $property->propertyType->name !!}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-muted small text-uppercase mb-0">{!! __('properties.location') !!}</label>
                            <p class="font-weight-bold mb-0">{!! $property->location !!}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-muted small text-uppercase mb-0">{!! __('properties.area') !!}</label>
                            <p class="font-weight-bold mb-0">{!! $property->area !!} {!! __('properties.sq_m') ?? 'm²' !!}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-muted small text-uppercase mb-0">{!! __('properties.price') !!}</label>
                            <p class="font-weight-bold mb-0 text-primary">{!! number_format($property->price, 2) !!} {!! __('general.currency') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info Section -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-2 radius-15" style="height: calc(100% - 8px);">
                <div class="card-header bg-transparent border-0 pt-2 pb-0">
                    <h5 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-align-left text-primary mr-1"></i> {!! __('properties.description') !!}
                    </h5>
                </div>
                <div class="card-body pt-1 pb-1">
                    <p class="text-muted small mb-0">
                        {!! $property->description ?: __('general.no_description') !!}
                    </p>
                </div>
            </div>
        </div>

        <!-- Legal & Utility Info - Full Width -->
        <div class="col-12 mt-1">
            <div class="card border-0 shadow-sm mb-2 radius-15">
                <div class="card-header bg-transparent border-0 pt-2 pb-0">
                    <h5 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-file-invoice text-primary mr-1"></i> {!! __('properties.legal_utility_info') !!}
                    </h5>
                </div>
                <div class="card-body pt-1 pb-1">
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: rgba(90, 141, 238, 0.05); border: 1px solid rgba(90, 141, 238, 0.1);">
                                <label class="text-muted small text-uppercase mb-0 mr-1">{!! __('properties.title_deed_number') !!}</label>
                                <span class="font-weight-bold">{!! $property->title_deed_number ?? '---' !!}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: rgba(90, 141, 238, 0.05); border: 1px solid rgba(90, 141, 238, 0.1);">
                                <label class="text-muted small text-uppercase mb-0 mr-1">{!! __('properties.electricity_account_number') !!}</label>
                                <span class="font-weight-bold">{!! $property->electricity_account_number ?? '---' !!}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: rgba(90, 141, 238, 0.05); border: 1px solid rgba(90, 141, 238, 0.1);">
                                <label class="text-muted small text-uppercase mb-0 mr-1">{!! __('properties.water_account_number') !!}</label>
                                <span class="font-weight-bold">{!! $property->water_account_number ?? '---' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Meta Info -->
        <div class="col-12">
            <div class="card border-0 shadow-sm mb-4 radius-15">
                <div class="card-body p-1">
                    <div class="row text-center">
                        <div class="col-md-6 border-right">
                            <span class="text-muted small mr-1">{!! __('general.created_at') !!}:</span>
                            <span class="font-weight-bold small">{!! $property->created_at->format('Y-m-d H:i') !!}</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small mr-1">{!! __('general.created_by') !!}:</span>
                            <span class="font-weight-bold small">{!! $property->creator->name ?? __('general.system') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
