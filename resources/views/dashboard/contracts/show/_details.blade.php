<div class="tab-pane fade show active" id="contract" role="tabpanel">

    <div class="row">
        <div class="col-lg-8">
            <!-- Data Dense Info Card -->
            <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-info-circle text-primary mr-1"></i>
                        <span>{!! __('contracts.contract_details') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col border-right">
                            <span class="text-muted font-small-3 d-block">{!! __('contracts.start_date') !!}</span>
                            <span class="text-dark font-weight-bold font-small-3">{!! $contract->start_date->format('Y-m-d') !!}</span>
                        </div>
                        <div class="col border-right">
                            <span class="text-muted font-small-3 d-block">{!! __('contracts.end_date') !!}</span>
                            <span class="text-dark font-weight-bold font-small-3">{!! $contract->end_date->format('Y-m-d') !!}</span>
                        </div>
                        <div class="col border-right">
                            <span class="text-muted font-small-3 d-block">{!! __('general.duration') !!}</span>
                            <span class="text-info font-weight-bold font-small-3">{!! $contract->duration_label !!}</span>
                        </div>
                        <div class="col border-right text-center">
                            <span class="text-muted font-small-3 d-block">{!! __('contracts.status') !!}</span>
                            <span class="text-{{ $statusColor }} font-weight-bold font-small-3 d-flex align-items-center justify-content-center">
                                <i class="fas {{ $statusIcon }} mr-1"></i>
                                <span>{!! __('contracts.status_' . $contract->status) !!}</span>
                            </span>
                        </div>
                        <div class="col text-center">
                            <span class="text-muted font-small-3 d-block">{!! __('contracts.payment_cycle') !!}</span>
                            <span class="text-dark font-weight-bold font-small-3">{!! __('contracts.payment_cycle_' . $contract->payment_cycle) !!}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom py-2 px-3">
                    <h6 class="card-title font-weight-bolder text-dark mb-0 d-flex align-items-center justify-content-start">
                        <i class="fas fa-wallet text-success mr-1"></i>
                        <span>{!! __('contracts.financial_details_title') !!}</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-4">
                            <span class="text-muted font-small-3 d-block">{!! __('contracts.rent_amount') !!}</span>
                            <span class="h5 font-weight-bolder text-success mb-0">{!! number_format($contract->rent_amount, 2) !!}</span>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted font-small-3 d-block">{!! __('contracts.deposit_amount') !!}</span>
                            <span class="h5 font-weight-bolder text-warning mb-0">{!! number_format($contract->deposit_amount, 2) !!}</span>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <span class="text-muted font-small-3 d-block mb-1">{!! __('contracts.deposit_type') !!}</span>
                            <span class="text-dark font-weight-bold"><i class="fas fa-money-check text-primary mr-1"></i> {!! __('contracts.deposit_type_' . $contract->deposit_type) !!}</span>
                        </div>
                        <div class="col-md-4 border-left border-right">
                            <span class="text-muted font-small-3 d-block mb-1">{!! __('contracts.deposit_status') !!}</span>
                            <span class="text-{{ $contract->deposit_status == 'received' ? 'success' : 'warning' }} font-weight-bold">
                                <i class="fas fa-circle font-small-2 mr-1"></i> {!! __('contracts.deposit_status_' . $contract->deposit_status) !!}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted font-small-3 d-block mb-1">{!! __('general.tax') !!}</span>
                            <span class="text-dark font-weight-bold">0.00 %</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                <div class="card-body p-2 px-3">
                    <div class="row align-items-center">
                        <div class="col-7 border-right">
                            <div class="d-flex align-items-center">
                                <div class="bg-light-info p-2 rounded mr-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-user-shield text-info font-small-3"></i></div>
                                <div>
                                    <span class="text-muted font-small-3 d-block line-height-1">{!! __('general.created_by') !!}</span>
                                    <span class="text-dark font-weight-bold font-small-3">{!! optional($contract->creator)->name ?? __('general.admin') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="d-flex align-items-center pl-1">
                                <div class="bg-light-warning p-2 rounded mr-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-clock text-warning font-small-3"></i></div>
                                <div>
                                    <span class="text-muted font-small-3 d-block line-height-1">{!! __('general.created_at') !!}</span>
                                    <span class="text-dark font-weight-bold font-small-3">{!! $contract->created_at->format('Y-m-d') !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($contract->deposit_type == 'cheque' && $contract->insuranceCheque)
                <div class="card border-0 shadow-sm bg-primary text-white mb-0 overflow-hidden" style="border-radius: 12px;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-white mb-0">{!! __('cheques.insurance_cheques') !!}</h6>
                            <span class="badge badge-white text-primary badge-pill font-weight-bold">#{!! $contract->insuranceCheque->cheque_number !!}</span>
                        </div>
                        <div class="mt-2 d-flex justify-content-between align-items-center small opacity-75">
                            <span>{!! __('cheques.status') !!}</span>
                            <span>{!! __('cheques.statuses.' . $contract->insuranceCheque->status) !!}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
