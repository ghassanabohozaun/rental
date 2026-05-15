<div>
    <form wire:submit.prevent="update" novalidate autocomplete="off">
        <div class="content-wrapper">
            <!-- begin: content header -->
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb premium-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.index') !!}">
                                        <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{!! route('dashboard.cheques.index') !!}">
                                        {!! __('cheques.cheques') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {!! __('cheques.edit_cheque') !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="d-flex align-items-center justify-content-end gap-2 mb-1">
                        <a href="{!! route('dashboard.cheques.index') !!}" class="btn-premium-back">
                            <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                        </a>
                        <button class="btn btn-premium-save" type="submit"
                            wire:loading.attr="disabled" wire:target="update">
                            <i wire:loading.remove wire:target="update" class="fas fa-save mr-2"></i>
                            <i wire:loading wire:target="update" class="fas fa-sync fa-spin mr-2"></i>
                            {!! __('general.save') !!}
                        </button>
                    </div>
                </div>
            </div>
            <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row align-items-start">
                        <div class="col-lg-8 col-md-12">

                            @if ($errors->has('general'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm premium-error-alert"
                                    role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle mx-3 fa-lg text-danger"></i>
                                        <div>
                                            <strong class="text-danger">{!! __('general.error') !!}!</strong><br>
                                            <span class="text-dark">{{ $errors->first('general') }}</span>
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Card 1: Contract & Company -->
                            <div class="premium-fade-in" wire:key="card-1-wrapper-{{ $validation_fail_nonce }}">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-file-contract text-primary"></i>
                                        {!! __('cheques.contract_selection') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if (user()->company_id == 1)
                                                <div class="col-md-12 mb-2" wire:key="company-select-container">
                                                    <div class="premium-form-group @error('company_id') is-invalid-premium @enderror">
                                                        <label for="company_id">{!! __('companies.company') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div wire:ignore>
                                                            <select
                                                                class="form-control premium-input shadow-none js-select2 opacity-75"
                                                                id='company_id' wire:model.live="company_id" disabled>
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}">
                                                                        {{ $company->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('company_id')
                                                            <span class="text-danger error-text">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12"
                                                wire:key="contract-select-container-{{ $company_id }}-{{ $contract_id ? 'has-contract' : 'no-contract' }}-{{ $validation_fail_nonce }}">
                                                <div class="premium-form-group @error('contract_id') is-invalid-premium @enderror">
                                                    <label for="contract_id"
                                                        class="premium-label font-weight-bold">{!! __('cheques.contract') !!}
                                                        <span class="text-danger">*</span></label>
                                                    <div wire:ignore
                                                        wire:key="contract-id-wrapper">
                                                        <select
                                                            class="form-control premium-input shadow-none js-select2 opacity-75"
                                                            id='contract_id' wire:model.live="contract_id" disabled>
                                                            <option value="">
                                                                {!! __('contracts.select_contract') !!}
                                                            </option>
                                                            @foreach ($contracts as $contract)
                                                                <option value="{{ $contract->id }}">
                                                                    {{ __('contracts.contract') . ' #' . $contract->id . ' - ' . optional($contract->customer)->name . ' (' . optional($contract->property)->name . ')' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('contract_id')
                                                        <span class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Cheque Details -->
                            <div class="premium-card-anim" wire:key="card-2-wrapper-{{ $validation_fail_nonce }}">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-money-check-alt text-warning"></i>
                                        {!! __('cheques.cheque_details') !!}
                                    </div>
                                    <div
                                        class="card-body {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}">
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group @error('cheque_number') is-invalid-premium @enderror">
                                                    <label for="cheque_number">{!! __('cheques.cheque_number') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control premium-input shadow-none"
                                                        id="cheque_number" wire:model="cheque_number"
                                                        placeholder="{!! __('cheques.cheque_number') !!}"
                                                        autocomplete="off">
                                                    @error('cheque_number')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group @error('amount') is-invalid-premium @enderror">
                                                    <label for="amount">{!! __('cheques.amount') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" step="0.01"
                                                        class="form-control premium-input shadow-none {{ ($currentChequeUsedAmount > 0) ? 'opacity-75' : '' }}"
                                                        id="amount" wire:model.live.debounce.150ms="amount"
                                                        placeholder="0.00"
                                                        {{ $currentChequeUsedAmount > 0 ? 'readonly' : '' }}
                                                        autocomplete="off">
                                                    @error('amount')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                    @if ($currentChequeUsedAmount > 0)
                                                        <div class="mt-1">
                                                            <span class="text-muted extra-small">
                                                                <i class="fas fa-lock mr-1"></i>
                                                                {!! __('cheques.cannot_edit_used_cheque') !!}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group @error('status') is-invalid-premium @enderror">
                                                    <label for="status">{!! __('cheques.status') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <div wire:ignore
                                                        wire:key="status-wrapper-enabled">
                                                        <select
                                                            class="form-control premium-input shadow-none js-select2"
                                                            id="status" wire:model="status">
                                                            <option value="">{!! __('general.select_from_list') !!}</option>
                                                            @foreach (__('cheques.statuses') as $key => $value)
                                                                <option value="{!! $key !!}">
                                                                    {!! $value !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('status')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group">
                                                    <label for="is_deposit">{!! __('cheques.is_deposit') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control premium-input shadow-none opacity-75"
                                                        id="is_deposit_display" wire:model.live="is_deposit"
                                                        disabled>
                                                        <option value="0">{!! __('general.no') !!}
                                                        </option>
                                                        <option value="1">{!! __('general.yes') !!}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group @error('issue_date') is-invalid-premium @enderror">
                                                    <label for="issue_date">{!! __('cheques.issue_date') !!}</label>
                                                    <div wire:ignore
                                                        wire:key="issue-date-wrapper-enabled">
                                                        <input type="text"
                                                            class="form-control premium-input shadow-none ptc-datepicker"
                                                            id="issue_date" wire:model="issue_date"
                                                            autocomplete="off" placeholder="YYYY-MM-DD">
                                                    </div>
                                                    @error('issue_date')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group @error('due_date') is-invalid-premium @enderror">
                                                    <label for="due_date">{!! __('cheques.due_date') !!}</label>
                                                    <div wire:ignore
                                                        wire:key="due-date-wrapper-enabled">
                                                        <input type="text"
                                                            class="form-control premium-input shadow-none ptc-datepicker"
                                                            id="due_date" wire:model="due_date"
                                                            autocomplete="off" placeholder="YYYY-MM-DD">
                                                    </div>
                                                    @error('due_date')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        @if ($dateWarning)
                                            <div class="premium-warning-pill mt-1">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                <span>{{ $dateWarning }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Bank & Owner -->
                            <div class="premium-card-anim"
                                wire:key="card-3-wrapper-{{ $validation_fail_nonce }}">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-university text-danger"></i>
                                        {!! __('cheques.bank_and_owner_info') !!}
                                    </div>
                                    <div
                                        class="card-body {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="premium-form-group @error('bank_name.ar') is-invalid-premium @enderror">
                                                    <label for="bank_name_ar">{!! __('cheques.bank_name') !!}
                                                        ({!! __('general.ar') !!}) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control premium-input shadow-none"
                                                        id="bank_name_ar" wire:model="bank_name.ar"
                                                        placeholder="{!! __('cheques.bank_name') !!}"
                                                        autocomplete="off">
                                                    @error('bank_name.ar')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="premium-form-group @error('bank_name.en') is-invalid-premium @enderror">
                                                    <label for="bank_name_en">{!! __('cheques.bank_name') !!}
                                                        ({!! __('general.en') !!}) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control premium-input shadow-none"
                                                        id="bank_name_en" wire:model="bank_name.en"
                                                        placeholder="{!! __('cheques.bank_name') !!}"
                                                        autocomplete="off">
                                                    @error('bank_name.en')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="premium-form-group @error('cheque_owner_name.ar') is-invalid-premium @enderror">
                                                    <label for="owner_name_ar">{!! __('cheques.cheque_owner_name') !!}
                                                        ({!! __('general.ar') !!}) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control premium-input shadow-none"
                                                        id="owner_name_ar" wire:model="cheque_owner_name.ar"
                                                        placeholder="{!! __('cheques.cheque_owner_name') !!}"
                                                        autocomplete="off">
                                                    @error('cheque_owner_name.ar')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="premium-form-group @error('cheque_owner_name.en') is-invalid-premium @enderror">
                                                    <label for="owner_name_en">{!! __('cheques.cheque_owner_name') !!}
                                                        ({!! __('general.en') !!}) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control premium-input shadow-none"
                                                        id="owner_name_en" wire:model="cheque_owner_name.en"
                                                        placeholder="{!! __('cheques.cheque_owner_name') !!}"
                                                        autocomplete="off">
                                                    @error('cheque_owner_name.en')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="premium-form-group mb-0 @error('notes') is-invalid-premium @enderror">
                                                    <label for="notes">{!! __('cheques.notes') !!}</label>
                                                    <textarea class="form-control premium-input shadow-none h-80" id="notes" wire:model="notes"
                                                        placeholder="{!! __('cheques.any_notes') !!}"></textarea>
                                                    @error('notes')
                                                        <span
                                                            class="text-danger error-text">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Area (4) -->
                        <div class="col-lg-4 col-md-12">
                            <div class="sticky-sidebar-premium">

                                <!-- Card 1: Financial Summary -->
                                <div class="premium-card-anim" wire:key="summary-wrapper-{{ $validation_fail_nonce }}">
                                    <div class="payment-summary-card-premium mb-3 {{ $projectedRemaining < 0 ? 'pulse-red' : '' }}">
                                        <div class="summary-header-premium">
                                            <i class="fas fa-chart-pie"></i>
                                            <div class="summary-title-premium">{!! __('payments.contract_financial_summary') !!}</div>
                                        </div>

                                        <div class="summary-body-premium" wire:loading.class.delay.500ms="opacity-50">
                                            @if($contract_id)
                                                <!-- Financial Status Rows -->
                                                <div class="summary-stat-row">
                                                    <span class="summary-stat-label">{!! __('contracts.total_amount') !!}</span>
                                                    <span class="summary-stat-value">{{ number_format($financials['total_amount'], 0) }}</span>
                                                </div>
                                                <div class="summary-stat-row">
                                                    <span class="summary-stat-label text-success">{!! __('payments.paid_amount') !!}</span>
                                                    <span class="summary-stat-value text-success">{{ number_format($financials['paid_amount'], 0) }}</span>
                                                </div>
                                                <div class="summary-stat-row mb-0">
                                                    <span class="summary-stat-label text-danger">{!! __('payments.remaining_amount') !!}</span>
                                                    <span class="summary-stat-value text-danger">{{ number_format($financials['remaining'], 0) }}</span>
                                                </div>

                                                <!-- Financial Indicator Section -->
                                                <div class="financial-indicator-section">
                                                    <span class="indicator-title">{!! __('payments.financial_coverage_index') !!}</span>
                                                    
                                                    @php
                                                        $total = $financials['total_amount'] ?: 1;
                                                        $paid_pct = ($financials['paid_amount'] / $total) * 100;
                                                        $otherPending = $financials['pending_total'];
                                                        $currentUnused = max(0, (float) $amount - $currentChequeUsedAmount);
                                                        $pending_pct = (($otherPending + $currentUnused) / $total) * 100;
                                                    @endphp

                                                    <span class="indicator-percentage">{{ round($paid_pct) }}%</span>
                                                    
                                                    <div class="financial-progress-premium">
                                                        <div class="financial-progress-bar-premium financial-progress-bar-paid" style="width: {{ $paid_pct }}%;"></div>
                                                        @if($pending_pct > 0)
                                                            <div class="financial-progress-bar-premium financial-progress-bar-cheques" style="width: {{ $pending_pct }}%;"></div>
                                                        @endif
                                                    </div>

                                                    <!-- Legend -->
                                                    <div class="financial-legend-premium">
                                                        <div class="legend-item-premium text-success">
                                                            <i class="fas fa-circle legend-dot-premium"></i> {!! __('payments.paid') !!}
                                                        </div>
                                                        <div class="legend-item-premium text-warning">
                                                            <i class="fas fa-circle legend-dot-premium"></i> {!! __('cheques.cheques') !!}
                                                        </div>
                                                        <div class="legend-item-premium text-muted">
                                                            <i class="fas fa-circle legend-dot-premium"></i> {!! __('payments.remaining') !!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Projected After This Entry -->
                                                <div class="projected-balance-box-premium">
                                                    <div class="projected-label-premium">
                                                        {{ $is_deposit == 1 ? __('contracts.deposit_amount') : __('payments.projected_remaining') }}
                                                    </div>
                                                    <div class="projected-value-premium {{ $projectedRemaining < 0 ? 'negative' : '' }}">
                                                        {{ number_format($projectedRemaining, 0) }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        @if($contract_id)
                                            <div class="summary-footer-premium" wire:loading.class.delay.500ms="opacity-50">
                                                <div class="footer-balance-row">
                                                    <span class="footer-balance-label">{!! __('payments.pending_cheques') !!}:</span>
                                                    <span class="footer-balance-value">
                                                        {{ number_format($financials['pending_total'], 0) }} <span class="text-muted" style="font-size: 0.7rem; font-weight: 500;">/ {{ number_format($financials['pending_original'], 0) }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Card 2: Quick Tips -->
                                <div class="premium-card-anim" wire:key="tips-wrapper">
                                    <div class="legendary-tips-card">
                                        <div class="legendary-header">
                                            <i class="fas fa-lightbulb"></i>
                                            <div class="legendary-title">{!! __('properties.quick_tips') !!}</div>
                                        </div>
                                        <ul class="legendary-list">
                                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.tip_1') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.tip_2') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.amount_guidance') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.is_deposit_guidance') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.cheque_number_guidance') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('cheques.due_date_guidance') !!}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('livewire:navigated', () => {
                initPlugins();
            });

            function initPlugins() {
                // Select2
                $('.js-select2').each(function() {
                    const $el = $(this);
                    if ($el.hasClass("select2-hidden-accessible")) {
                        $el.prop('disabled', $el.is(':disabled'));
                        $el.trigger('change.select2');
                        return;
                    }
                    $el.select2({
                        width: '100%',
                        dir: $('html').attr('data-textdirection') || 'ltr',
                        dropdownParent: $('body')
                    }).on('change', function(e) {
                        let val = $(this).val();
                        let model = $(this).attr('wire:model.live') || $(this).attr('wire:model') || this.id;
                        if (model) @this.set(model, val);
                    });
                });

                // Datepicker
                if (window.initPTCUI) {
                    window.initPTCUI();

                    $('.ptc-datepicker').on('changeDate', function(e) {
                        let dateStr = $(this).val();
                        let model = $(this).attr('wire:model.live') || $(this).attr('wire:model');
                        if (model) @this.set(model, dateStr);
                    });
                }
            }

            $(document).ready(function() {
                initPlugins();
            });

            window.addEventListener('reinit-plugins', event => {
                setTimeout(initPlugins, 50);
            });
        </script>
    @endpush
</div>
