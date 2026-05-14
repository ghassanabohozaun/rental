<div class="tab-pane fade" id="property" role="tabpanel">
    <div class="row d-flex align-items-stretch">
        <!-- Left Column: Primary Property Info -->
        <div class="col-lg-8 mb-3">
            <div class="card border-0 shadow-sm h-100 mb-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-building text-primary mr-1"></i>
                        <span>{!! __('properties.basic_info') !!}</span>
                    </h6>
                    <a href="{!! route('dashboard.properties.index') !!}?id={!! $contract->property_id !!}" 
                       class="btn btn-sm btn-light-primary px-2 py-0 font-small-3">
                        {!! __('properties.view_property') !!} <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('properties.type') !!}</span>
                            <span class="text-dark font-weight-bold d-flex align-items-center">
                                <i class="fas fa-home text-primary mr-1 font-small-2"></i>
                                <span>{!! optional(optional($contract->property)->propertyType)->name ?? '---' !!}</span>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('properties.status') !!}</span>
                            <span class="text-primary font-weight-bold d-flex align-items-center">
                                <i class="fas fa-info-circle mr-1 font-small-2"></i>
                                <span>{!! optional(optional($contract->property)->propertyStatus)->name ?? '---' !!}</span>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('properties.area') !!}</span>
                            <span class="text-dark font-weight-bold d-flex align-items-center">
                                <i class="fas fa-expand-arrows-alt text-success mr-1 font-small-2"></i>
                                <span>{!! optional($contract->property)->area ?? '---' !!}</span>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('properties.owner') !!}</span>
                            <span class="text-primary font-weight-bold d-flex align-items-center">
                                <i class="fas fa-user-tie text-warning mr-1 font-small-2"></i>
                                <span>{!! optional($contract->property->owner)->name ?? '---' !!}</span>
                            </span>
                        </div>
                        <div class="col-md-8 mb-3">
                            <span class="text-muted font-small-3 d-block">{!! __('properties.location') !!}</span>
                            <span class="text-dark font-weight-bold d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-danger mr-1 font-small-2"></i>
                                <span>{!! optional($contract->property)->location !!}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Technical Details Summary -->
        <div class="col-lg-4 mb-3">
            <div class="card border-0 shadow-sm h-100 mb-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-fingerprint text-muted mr-1"></i>
                        <span>{!! __('properties.property_edit_summary') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted font-small-3">{!! __('properties.property_number') !!}</span>
                        <span class="text-dark font-weight-bold">#{!! optional($contract->property)->property_number ?? '---' !!}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                        <span class="text-muted font-small-3">{!! __('properties.title_deed_number') !!}</span>
                        <span class="text-dark font-weight-bold">{!! optional($contract->property)->title_deed_number ?? '---' !!}</span>
                    </div>
                    
                    <div class="row text-center mt-3">
                        <div class="col-6 border-right">
                            <i class="fas fa-bolt text-warning d-block mb-1"></i>
                            <span class="text-dark font-weight-bold font-small-3">{!! optional($contract->property)->electricity_account_number ?? '---' !!}</span>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-tint text-info d-block mb-1"></i>
                            <span class="text-dark font-weight-bold font-small-3">{!! optional($contract->property)->water_account_number ?? '---' !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Width Description Row -->
    @if (optional($contract->property)->description)
        <div class="row mt-1">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-white" style="border-radius: 12px;">
                    <div class="card-body p-3">
                        <h6 class="font-weight-bold mb-2 text-dark font-small-3 border-bottom pb-2 d-flex align-items-center justify-content-start">
                            <i class="fas fa-align-right text-muted mr-1"></i>
                            <span>{!! __('properties.description') !!}</span>
                        </h6>
                        <div class="text-muted font-small-2 line-height-1-4">
                            {!! $contract->property->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


