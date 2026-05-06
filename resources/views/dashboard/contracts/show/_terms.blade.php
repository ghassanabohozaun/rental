<div class="tab-pane fade" id="terms" role="tabpanel">
    <div class="row">
        <!-- Left Column: Contract Text -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0"><i class="fas fa-file-alt text-primary mr-1"></i> {!! __('contracts.contract_text') !!}</h6>
                </div>
                <div class="card-body p-3">
                    <div class="contract-text-viewer font-small-3 text-muted line-height-1-6" style="max-height: 400px; overflow-y: auto; padding: 10px; background: #fdfdfd; border-radius: 8px; border: 1px solid #f1f1f1;">
                        {!! $contract->contract_text ?? '<div class="text-center py-4"><i class="fas fa-file-invoice font-large-1 mb-2 d-block opacity-25"></i>'.__('contracts.no_contract_text').'</div>' !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Notes -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0"><i class="fas fa-sticky-note text-warning mr-1"></i> {!! __('general.notes') !!}</h6>
                </div>
                <div class="card-body p-3">
                    @if ($contract->notes)
                        <div class="p-2 border rounded bg-light-warning font-small-3" style="border-radius: 8px;">
                            {!! $contract->notes !!}
                        </div>
                    @else
                        <div class="text-center py-3 text-muted font-small-3">
                            <i class="fas fa-info-circle mb-1 d-block"></i>
                            {!! __('general.no_notes') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
