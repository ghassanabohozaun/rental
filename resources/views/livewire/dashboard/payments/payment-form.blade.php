<div>
    <form wire:submit.prevent="save" autocomplete="off">
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
                                    <a href="{!! route('dashboard.payments.index') !!}">
                                        {!! __('payments.payments') !!}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $isEdit ? __('payments.edit_payment') : __('payments.add_payment') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                    <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
                        <div class="d-flex justify-content-md-end justify-content-center gap-2">
                            <a href="{!! route('dashboard.payments.index') !!}" class="btn-premium-back">
                                <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                            </a>
                            <button class="btn btn-premium-save" type="submit" wire:loading.attr="disabled"
                                wire:target="save">
                                <i wire:loading.remove wire:target="save" class="fas fa-save mr-2"></i>
                                <i wire:loading wire:target="save" class="fas fa-sync fa-spin mr-2"></i>
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
                        <!-- Main Form Column (8) -->
                        <div class="col-lg-8 col-md-12">
                            
                            @if($errors->has('general'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
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

                            <!-- Step 1: Contract Selection Card -->
                            <div class="premium-card-anim" wire:key="card-1-wrapper-{{ $validation_fail_nonce }}">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header py-2">
                                        <div class="title-wrapper">
                                            <i class="fas fa-file-contract"></i>
                                            <span class="font-weight-bold">{!! __('payments.contract_selection') !!}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if (user()->company_id == 1)
                                                <div class="col-md-12 mb-2" wire:key="company-select-container">
                                                    <div class="premium-form-group @error('company_id') is-invalid-premium @enderror">
                                                        <label for="company_id">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                                        <div wire:ignore>
                                                            <select class="form-control premium-input shadow-none js-select2 {{ $isEdit ? 'opacity-75' : '' }}" id='company_id' wire:model.live="company_id" {{ $isEdit ? 'disabled' : '' }}>
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('company_id') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                <div class="premium-form-group @error('contract_id') is-invalid-premium @enderror">
                                                    <label for="contract_id" class="premium-label font-weight-bold">
                                                        {!! __('payments.contract') !!} <span class="text-danger">*</span>
                                                    </label>
                                                    <div wire:key="contract-wrapper-{{ $company_id }}" wire:ignore>
                                                        <select class="form-control premium-input shadow-none js-select2 {{ ($isEdit || !$company_id) ? 'opacity-75' : '' }}" id='contract_id' wire:model.live="contract_id" {{ ($isEdit || !$company_id) ? 'disabled' : '' }}>
                                                            <option value="">{!! __('contracts.select_contract') !!}</option>
                                                            @foreach ($contracts as $contract)
                                                                <option value="{{ $contract->id }}">
                                                                    {{ __('contracts.contract') . ' #' . $contract->id . ' - ' . optional($contract->customer)->name . ' (' . optional($contract->property)->name . ')' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('contract_id') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fully Paid Message -->
                            @if($contract_id && $financials['remaining'] <= 0 && !$isEdit)
                                <div class="premium-fade-in mb-2" wire:key="fully-paid-msg">
                                    <div class="fully-paid-card">
                                        <div class="fully-paid-icon-wrapper">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <h3 class="fully-paid-title">{!! __('payments.contract_fully_paid') !!}</h3>
                                        <p class="fully-paid-subtitle">{!! __('payments.no_further_payments_required') !!}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Step 2: Payment Details Card -->
                            @if(!($contract_id && $financials['remaining'] <= 0 && !$isEdit))
                                <div class="premium-fade-in {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}" wire:key="payment-inputs-wrapper-{{ $validation_fail_nonce }}">
                                    <div class="card premium-card mb-2">
                                        <div class="premium-mandatory-header py-2">
                                            <div class="title-wrapper">
                                                <i class="fas fa-money-bill-wave"></i>
                                                <span class="font-weight-bold">{!! __('payments.payment_info') !!}</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <div class="premium-form-group @error('method') is-invalid-premium @enderror">
                                                        <label for="method" class="font-weight-bold">{!! __('payments.method') !!} <span class="text-danger">*</span></label>
                                                        <div wire:ignore wire:key="method-wrapper-{{ $contract_id }}">
                                                            <select class="form-control premium-input shadow-none js-select2" id="method" wire:model.live="method" {{ !$contract_id ? 'disabled' : '' }}>
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                @foreach (__('payments.methods') as $key => $value)
                                                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('method') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <div class="premium-form-group @error('payment_date') is-invalid-premium @enderror">
                                                        <label for="payment_date" class="font-weight-bold">{!! __('payments.payment_date') !!} <span class="text-danger">*</span></label>
                                                        <div wire:ignore wire:key="date-wrapper-{{ $contract_id }}">
                                                            <input type="text" class="form-control premium-input shadow-none ptc-datepicker" id="payment_date" wire:model.live="payment_date" autocomplete="off" placeholder="YYYY-MM-DD" {{ !$contract_id ? 'disabled' : '' }}>
                                                        </div>
                                                        @error('payment_date') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <div class="premium-form-group @error('status') is-invalid-premium @enderror">
                                                        <label for="status" class="font-weight-bold">{!! __('payments.status') !!} <span class="text-danger">*</span></label>
                                                        <div wire:ignore wire:key="status-wrapper-{{ $contract_id }}">
                                                            <select class="form-control premium-input shadow-none js-select2" id="status" wire:model.live="status" {{ !$contract_id ? 'disabled' : '' }}>
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                @foreach (__('payments.statuses') as $key => $value)
                                                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('status') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                @if($method === 'cheque')
                                                    <div class="col-md-12 mb-2 premium-fade-in" wire:key="cheque-selection-container-{{ $validation_fail_nonce }}">
                                                        <div class="premium-form-group @error('cheque_id') is-invalid-premium @enderror">
                                                            <label class="premium-label font-weight-bold">{!! __('payments.cheque') !!} <span class="text-danger">*</span></label>
                                                            <div wire:ignore>
                                                                <select id="cheque_id" class="form-control premium-input shadow-none js-select2" wire:model.live="cheque_id" data-placeholder="{!! __('cheques.select_cheque') !!}">
                                                                    <option value="">{!! __('cheques.select_cheque') !!}</option>
                                                                    @foreach($availableCheques as $chq)
                                                                        <option value="{{ $chq['id'] }}">
                                                                            {{ $chq['cheque_number'] }} - {{ is_array($chq['bank_name']) ? ($chq['bank_name'][app()->getLocale()] ?? current($chq['bank_name'])) : $chq['bank_name'] }} ({{ number_format($chq['remaining_amount'], 2) }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('cheque_id') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                        </div>

                                                        @if($selectedChequeDetails)
                                                            <div class="mt-2 premium-fade-in">
                                                                <div class="cheque-details-pill-premium">
                                                                    <div class="pill-info-section">
                                                                        <div class="pill-stat">
                                                                            <span class="pill-label">{!! __('payments.cheque_original_amount') !!}</span>
                                                                            <span class="pill-value text-info">{{ number_format($selectedChequeDetails['amount'], 0) }}</span>
                                                                        </div>
                                                                        <div class="pill-stat">
                                                                            <span class="pill-label">{!! __('payments.cheque_used_amount') !!}</span>
                                                                            <span class="pill-value text-danger">{{ number_format($selectedChequeDetails['used_amount'], 0) }}</span>
                                                                        </div>
                                                                        <div class="pill-stat border-0">
                                                                            <span class="pill-label">{!! __('payments.cheque_available_total') !!}</span>
                                                                            <span class="pill-value text-success">{{ number_format($selectedChequeDetails['remaining_amount'], 0) }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" class="btn btn-info btn-sm pill-action-btn" wire:click="$set('amount', {{ $selectedChequeDetails['remaining_amount'] }})">
                                                                        <i class="fas fa-magic mr-1"></i> {!! __('cheques.fill_remaining') !!}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                                <div class="col-md-6 mb-2">
                                                    <div class="premium-form-group @error('amount') is-invalid-premium @enderror">
                                                        <label for="amount" class="font-weight-bold">{!! __('payments.amount') !!} <span class="text-danger">*</span></label>
                                                        <input type="number" step="0.01" class="form-control premium-input shadow-none" id="amount" wire:model.live.debounce.250ms="amount" placeholder="0.00" {{ !$contract_id ? 'disabled' : '' }} autocomplete="off">
                                                        @error('amount') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-2">
                                                    <div class="premium-form-group @error('reference_number') is-invalid-premium @enderror">
                                                        <label for="reference_number" class="font-weight-bold">{!! __('payments.reference_number') !!}</label>
                                                        <input type="text" class="form-control premium-input shadow-none" id="reference_number" wire:model.live="reference_number" placeholder="Ref#" {{ !$contract_id ? 'disabled' : '' }} autocomplete="off">
                                                        @error('reference_number') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <div class="premium-form-group mb-0 @error('notes') is-invalid-premium @enderror">
                                                        <label for="notes" class="font-weight-bold">{!! __('payments.notes') !!}</label>
                                                        <textarea class="form-control premium-input shadow-none h-80" id="notes" wire:model.live="notes" placeholder="{!! __('payments.any_notes') !!}" {{ !$contract_id ? 'disabled' : '' }}></textarea>
                                                        @error('notes') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div> <!-- end : col-lg-8 -->

                        <!-- Sidebar Column (4) -->
                        <div class="col-lg-4 col-md-12">
                            <div class="sticky-sidebar-premium">
                                <!-- Contract Insight Card -->
                                <div class="premium-card-anim" wire:key="summary-wrapper-{{ $validation_fail_nonce }}">
                                    <div class="payment-summary-card-premium mb-3 {{ ($projectedRemaining ?? 0) < 0 ? 'pulse-red' : '' }}">
                                        <div class="premium-mandatory-header py-2">
                                            <div class="title-wrapper">
                                                <i class="fas fa-chart-pie"></i>
                                                <span class="font-weight-bold">{!! __('payments.contract_financial_summary') !!}</span>
                                            </div>
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
                                                    <span class="indicator-percentage">{{ round($financials['paid_pct']) }}%</span>
                                                    
                                                    <div class="financial-progress-premium">
                                                        <div class="financial-progress-bar-premium financial-progress-bar-paid" style="width: {{ $financials['paid_pct'] }}%;"></div>
                                                        @if($financials['pending_pct'] > 0)
                                                            <div class="financial-progress-bar-premium financial-progress-bar-cheques" style="width: {{ $financials['pending_pct'] }}%;"></div>
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

                                                <!-- Projected After This Payment -->
                                                @if($amount > 0)
                                                    <div class="projected-balance-box-premium">
                                                        <div class="projected-label-premium">{!! __('payments.projected_remaining') !!}</div>
                                                        <div class="projected-value-premium {{ $projectedRemaining < 0 ? 'negative' : '' }}">
                                                            {{ number_format($projectedRemaining, 0) }}
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Portfolio Section -->
                                                @if(count($allCheques) > 0)
                                                <div class="premium-mandatory-header py-1 border-bottom-0 d-flex justify-content-between align-items-center" style="background: transparent;">
                                                    <div class="title-wrapper">
                                                        <i class="fas fa-wallet"></i>
                                                        <span class="font-weight-bold" style="font-size: 0.95rem;">{!! __('payments.linked_cheques') !!}</span>
                                                    </div>
                                                    <span class="badge badge-light-primary rounded-pill px-2" style="font-size: 0.7rem;">{{ count($allCheques) }}</span>
                                                </div>
                                                        
                                                        <div class="linked-cheques-scrollable-premium">
                                                            @foreach($allCheques as $chq)
                                                                <div class="cheque-portfolio-item {{ $chq->remaining_amount <= 0 ? 'fully-used' : '' }}"
                                                                     style="border-right: 4px solid {{ $chq->remaining_amount <= 0 ? '#cbd5e1' : '#10b981' }};">
                                                                    <div class="cheque-item-left">
                                                                        <span class="cheque-number-premium">
                                                                            #{{ $chq->cheque_number }}
                                                                            @if($chq->remaining_amount <= 0)
                                                                                <i class="fas fa-check-circle text-success ml-1" style="font-size: 0.7rem;"></i>
                                                                            @endif
                                                                        </span>
                                                                        <span class="cheque-bank-premium">
                                                                            {{ is_array($chq->bank_name) ? ($chq->bank_name[app()->getLocale()] ?? current($chq->bank_name)) : $chq->bank_name }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="cheque-item-right">
                                                                        <div class="cheque-amount-total">
                                                                            {{ number_format($chq->amount, 0) }}
                                                                        </div>
                                                                        @if($chq->remaining_amount > 0)
                                                                            <div class="cheque-amount-available">
                                                                                {{ __('payments.available') }}: {{ number_format($chq->remaining_amount, 0) }}
                                                                            </div>
                                                                        @else
                                                                            <div class="extra-small text-muted italic" style="font-size: 0.65rem;">
                                                                                {{ __('payments.fully_used') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="text-center py-5">
                                                    <div class="mb-3 opacity-20">
                                                        <i class="fas fa-file-contract font-large-3"></i>
                                                    </div>
                                                    <p class="text-muted small px-4">{!! __('contracts.select_contract_to_view_details') !!}</p>
                                                </div>
                                            @endif
                                        </div>

                                        @if($contract_id)
                                            <div class="summary-footer-premium">
                                                <div class="footer-balance-row">
                                                    <span class="footer-balance-label">{!! __('payments.cheques_balance') !!}:</span>
                                                    <span class="footer-balance-value">
                                                        {{ number_format($financials['pending_cheques_total'], 0) }} <span class="text-muted" style="font-size: 0.7rem; font-weight: 500;">/ {{ number_format($financials['pending_cheques_original_total'], 0) }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Card 2: Quick Tips -->
                                <div class="premium-card-anim mt-3" wire:key="tips-wrapper">
                                    <div class="legendary-tips-card">
                                        <div class="premium-mandatory-header py-2">
                                            <div class="title-wrapper">
                                                <i class="fas fa-lightbulb"></i>
                                                <span class="font-weight-bold">{!! __('properties.quick_tips') !!}</span>
                                            </div>
                                        </div>
                                        <ul class="legendary-list">
                                            <li><i class="fas fa-check-circle"></i> {!! __('payments.tip_verify_amount') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('payments.tip_check_date') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('payments.tip_reference_number') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('payments.tip_notes_importance') !!}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end : col-lg-4 -->
                    </div> <!-- end : row -->
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
