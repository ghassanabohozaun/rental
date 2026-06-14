<div class="tab-pane fade" id="terms" role="tabpanel">
    <div class="row">
        <!-- Contract Clauses -->
        <div class="col-12">
            <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                <div
                    class="card-header bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title font-weight-bolder text-dark mb-0">
                        <i class="fas fa-file-contract text-primary mr-1"></i> {!! __('contracts.contract_terms') !!}
                    </h6>
                </div>
                <div class="card-body p-3">
                    @php
                        $clauses = optional($contract->contractDetail)->contract_clauses;
                    @endphp

                    @if (is_array($clauses) && count($clauses) > 0)
                        <div class="contract-clauses-wrapper">
                            @foreach ($clauses as $index => $clause)
                                <div class="clause-item mb-3 p-3">
                                    <h6 class="font-weight-bold text-dark mb-2">
                                        <span class="badge badge-light-primary mr-1">{{ $index + 1 }}</span>
                                        {{ $contract->replaceSmartTags($clause['title'] ?? '') }}
                                    </h6>
                                    <div class="clause-content text-muted font-small-3 line-height-1-6">
                                        {!! nl2br(e($contract->replaceSmartTags(trim($clause['content'] ?? '')))) !!}</div>
                                </div>
                            @endforeach
                        </div>
                    @elseif(is_string($clauses) && !empty($clauses))
                        <div class="contract-text-viewer font-small-3 text-muted line-height-1-6 p-3">
                            {!! $contract->replaceSmartTags(trim($clauses)) !!}
                        </div>
                    @elseif(!empty($contract->contract_text))
                        <div class="contract-text-viewer font-small-3 text-muted line-height-1-6 p-3">
                            {!! $contract->replaceSmartTags(trim($contract->contract_text)) !!}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-file-invoice font-large-1 mb-2 d-block opacity-25"></i>
                            {!! __('contracts.no_contract_text') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
