<div class="tab-pane fade show active" id="contract" role="tabpanel">
    <div class="row">
        <div class="col-12">
            <!-- 1. General Contract Info Card -->
            <div class="card detail-card-master border-0 shadow-sm mb-4 radius-15">
                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
                    <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                        <i class="fas fa-info-circle text-primary mr-1" style="font-size: 1.2rem !important;"></i> {!! __('contracts.contract_details') !!}
                    </h5>
                </div>
                <div class="card-body pt-3 pb-3">
                    <div class="row">
                        <!-- Conclusion Date -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-info-opacity">
                                    <i class="fas fa-file-contract text-info"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.conclusion_date') !!}</label>
                                    <span class="data-grid-value">{!! $contract->conclusion_date->format('Y-m-d') !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-primary-opacity">
                                    <i class="fas fa-calendar-check text-primary"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.start_date') !!}</label>
                                    <span class="data-grid-value">{!! $contract->start_date->format('Y-m-d') !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-danger-opacity">
                                    <i class="fas fa-calendar-times text-danger"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.end_date') !!}</label>
                                    <span class="data-grid-value">{!! $contract->end_date->format('Y-m-d') !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-3 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-info-opacity">
                                    <i class="fas fa-hourglass-half text-info"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('general.duration') !!}</label>
                                    <span class="data-grid-value text-info">{!! $contract->duration_label !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Cycle -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-warning-opacity">
                                    <i class="fas fa-sync-alt text-warning"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.payment_cycle') !!}</label>
                                    <span class="data-grid-value">{!! __('contracts.payment_cycle_' . $contract->payment_cycle) !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contract Status -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                @php
                                    $statusClass = 'success';
                                    if ($contract->status == 'ended') $statusClass = 'warning';
                                    if ($contract->status == 'cancelled') $statusClass = 'danger';
                                @endphp
                                <div class="data-grid-icon bg-light-{!! $statusClass !!}-opacity">
                                    <i class="fas {!! $statusIcon !!} text-{!! $statusClass !!}"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.status') !!}</label>
                                    <span class="data-grid-value text-{!! $statusClass !!}">{!! __('contracts.status_' . $contract->status) !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Creator -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-dark-opacity">
                                    <i class="fas fa-user-shield text-dark"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('general.created_by') !!}</label>
                                    <span class="data-grid-value font-small-3">{!! optional($contract->creator)->name ?? __('general.admin') !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Financial & Deposit Card -->
            <div class="card detail-card-master border-0 shadow-sm radius-15">
                <div class="card-header bg-transparent border-0 pt-0 pb-0 d-flex align-items-center" style="height: 50px;">
                    <h5 class="card-title font-weight-bold mb-0" style="font-size: 1.1rem !important;">
                        <i class="fas fa-wallet text-success mr-1" style="font-size: 1.2rem !important;"></i> {!! __('contracts.financial_details_title') !!}
                    </h5>
                </div>
                <div class="card-body pt-3 pb-3">
                    <div class="row">
                        <!-- Rent Amount -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item border-left-success-3">
                                <div class="data-grid-icon bg-light-success-opacity">
                                    <i class="fas fa-money-bill-wave text-success"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.rent_amount') !!}</label>
                                    <span class="data-grid-value text-success">{!! number_format($contract->rent_amount, 2) !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Deposit Amount -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item border-left-warning-3">
                                <div class="data-grid-icon bg-light-warning-opacity">
                                    <i class="fas fa-shield-alt text-warning"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.deposit_amount') !!}</label>
                                    <span class="data-grid-value text-warning">{!! number_format($contract->deposit_amount, 2) !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Deposit Status -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-info-opacity">
                                    <i class="fas fa-check-double text-info"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.deposit_status') !!}</label>
                                    @php
                                        $dStatusInfo = [
                                            'held' => ['class' => 'badge-info-premium', 'icon' => 'fas fa-pause-circle'],
                                            'returned' => ['class' => 'badge-danger-premium', 'icon' => 'fas fa-undo'],
                                            'used' => ['class' => 'badge-success-premium', 'icon' => 'fas fa-check-circle'],
                                        ][$contract->deposit_status] ?? ['class' => 'badge-secondary', 'icon' => 'fas fa-info-circle'];
                                    @endphp
                                    <div class="badge badge-pill badge-glow premium-badge-sm {!! $dStatusInfo['class'] !!} px-2 py-25">
                                        <i class="{!! $dStatusInfo['icon'] !!} mr-25"></i> {!! __('contracts.deposit_status_' . $contract->deposit_status) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deposit Type -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-dark-opacity">
                                    <i class="fas fa-money-check text-dark"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('contracts.deposit_type') !!}</label>
                                    <span class="data-grid-value">{!! __('contracts.deposit_type_' . $contract->deposit_type) !!}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tax -->
                        <div class="col-md-4 mb-3">
                            <div class="data-grid-item">
                                <div class="data-grid-icon bg-light-danger-opacity">
                                    <i class="fas fa-percent text-danger"></i>
                                </div>
                                <div class="data-grid-content">
                                    <label class="data-grid-label">{!! __('general.tax') !!}</label>
                                    <span class="data-grid-value">0.00 %</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($contract->deposit_type == 'cheque' && $contract->insuranceCheque)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card detail-card-master border-0 shadow-sm bg-light-primary-opacity radius-15">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-white p-2 rounded shadow-sm mr-2" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-money-check text-primary font-medium-3"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-0">{!! __('cheques.insurance_cheques') !!}</h6>
                                    <span class="text-muted font-small-3">{!! __('cheques.statuses.' . $contract->insuranceCheque->status) !!}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="badge badge-primary px-3 py-1 radius-10">#{!! $contract->insuranceCheque->cheque_number !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>


