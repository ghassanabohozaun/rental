<div>
    <form wire:submit.prevent="save">
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
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="d-flex align-items-center justify-content-end mb-1">
                        <a href="{!! route('dashboard.payments.index') !!}" class="btn-premium-back mr-1">
                            <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                        </a>
                        <button class="btn btn-premium-save shadow-pulse" type="submit" wire:loading.attr="disabled" wire:target="save">
                            <i class="fas fa-save" wire:loading.remove wire:target="save"></i>
                            {!! __('general.save') !!}
                            <i class="fas fa-sync fa-spin ml-1" wire:loading wire:target="save"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <!-- Main Form Column (8) -->
                        <div class="col-lg-8 col-md-12" style="min-height: 700px;">
                            
                            @if($errors->has('general'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert" style="border-radius: 15px; border-right: 5px solid #dc3545; background: #fff;">
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
                            <div class="premium-fade-in" wire:key="card-1-wrapper">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-file-contract text-info"></i>
                                        {!! __('payments.contract_selection') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if (user()->company_id == 1)
                                                <div class="col-md-12 mb-2" wire:key="company-select-container">
                                                    <div class="premium-form-group">
                                                        <label for="company_id">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper {{ $isEdit ? 'opacity-75' : '' }}" wire:ignore>
                                                            <select class="form-control premium-input shadow-none js-select2" id='company_id' wire:model.live="company_id" {{ $isEdit ? 'disabled' : '' }}>
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fas fa-{{ $isEdit ? 'lock' : 'briefcase' }} text-primary"></i>
                                                        </div>
                                                        @error('company_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                <div class="premium-form-group">
                                                    <label for="contract_id" class="premium-label font-weight-bold">
                                                        {!! __('payments.contract') !!} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="premium-input-wrapper {{ ($isEdit || !$company_id) ? 'opacity-75' : '' }}" wire:key="contract-wrapper-{{ $company_id }}" wire:ignore>
                                                        <select class="form-control premium-input shadow-none js-select2" id='contract_id' wire:model.live="contract_id" {{ ($isEdit || !$company_id) ? 'disabled' : '' }}>
                                                            <option value="">{!! __('contracts.select_contract') !!}</option>
                                                            @foreach ($contracts as $contract)
                                                                <option value="{{ $contract->id }}">
                                                                    {{ __('contracts.contract') . ' #' . $contract->id . ' - ' . optional($contract->customer)->name . ' (' . optional($contract->property)->name . ')' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fas fa-{{ $isEdit ? 'lock' : 'file-invoice' }} text-primary"></i>
                                                    </div>
                                                    @error('contract_id') <span class="text-danger small">{{ $message }}</span> @enderror
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
                                <div class="premium-fade-in {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}" wire:key="payment-inputs-wrapper">
                                    <div class="card premium-card mb-2">
                                        <div class="premium-mandatory-header">
                                            <i class="fas fa-money-bill-wave text-success"></i>
                                            {!! __('payments.payment_info') !!}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <div class="premium-form-group">
                                                        <label for="method" class="font-weight-bold">{!! __('payments.method') !!} <span class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper" wire:ignore wire:key="method-wrapper-{{ $contract_id }}">
                                                            <select class="form-control premium-input shadow-none js-select2" id="method" wire:model.live="method" {{ !$contract_id ? 'disabled' : '' }}>
                                                                @foreach (__('payments.methods') as $key => $value)
                                                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fas fa-credit-card text-primary"></i>
                                                        </div>
                                                        @error('method') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <div class="premium-form-group">
                                                        <label for="payment_date" class="font-weight-bold">{!! __('payments.payment_date') !!} <span class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper" wire:ignore wire:key="date-wrapper-{{ $contract_id }}">
                                                            <input type="text" class="form-control premium-input shadow-none ptc-datepicker" id="payment_date" wire:model.live="payment_date" autocomplete="off" placeholder="YYYY-MM-DD" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-calendar-alt text-primary"></i>
                                                        </div>
                                                        @error('payment_date') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <div class="premium-form-group">
                                                        <label for="status" class="font-weight-bold">{!! __('payments.status') !!} <span class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper" wire:ignore wire:key="status-wrapper-{{ $contract_id }}">
                                                            <select class="form-control premium-input shadow-none js-select2" id="status" wire:model.live="status" {{ !$contract_id ? 'disabled' : '' }}>
                                                                @foreach (__('payments.statuses') as $key => $value)
                                                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fas fa-info-circle text-primary"></i>
                                                        </div>
                                                        @error('status') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                @if($method === 'cheque')
                                                    <div class="col-md-12 mb-2 premium-fade-in" wire:key="cheque-selection-container">
                                                        <div class="premium-form-group">
                                                            <label class="premium-label font-weight-bold">{!! __('payments.cheque') !!} <span class="text-danger">*</span></label>
                                                            <div class="premium-input-wrapper" wire:ignore>
                                                                <select id="cheque_id" class="form-control premium-input shadow-none js-select2" wire:model.live="cheque_id" data-placeholder="{!! __('cheques.select_cheque') !!}">
                                                                    <option value="">{!! __('cheques.select_cheque') !!}</option>
                                                                    @foreach($availableCheques as $chq)
                                                                        <option value="{{ $chq['id'] }}">
                                                                            {{ $chq['cheque_number'] }} - {{ is_array($chq['bank_name']) ? ($chq['bank_name'][app()->getLocale()] ?? current($chq['bank_name'])) : $chq['bank_name'] }} ({{ number_format($chq['remaining_amount'], 2) }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <i class="fas fa-university text-primary"></i>
                                                            </div>
                                                            @error('cheque_id') <span class="text-danger small">{{ $message }}</span> @enderror

                                                            @if($selectedChequeDetails)
                                                                <div class="mt-2 premium-fade-in">
                                                                    <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded shadow-sm border-left-info-premium" style="border-right: 4px solid #00cfe8; background: #f8fafc !important;">
                                                                        <div class="d-flex align-items-center gap-3 flex-grow-1">
                                                                            <div class="px-2 border-right">
                                                                                <span class="small text-muted d-block">{!! __('payments.cheque_original_amount') !!}</span>
                                                                                <span class="font-weight-bold text-info">{{ number_format($selectedChequeDetails['amount'], 0) }}</span>
                                                                            </div>
                                                                            <div class="px-2 border-right">
                                                                                <span class="small text-muted d-block">{!! __('payments.cheque_used_amount') !!}</span>
                                                                                <span class="font-weight-bold text-danger">{{ number_format($selectedChequeDetails['used_amount'], 0) }}</span>
                                                                            </div>
                                                                            <div class="px-2">
                                                                                <span class="small text-muted d-block">{!! __('payments.cheque_available_total') !!}</span>
                                                                                <span class="font-weight-bold text-success">{{ number_format($selectedChequeDetails['remaining_amount'], 0) }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn btn-info btn-sm shadow-sm ml-2" style="border-radius: 8px; font-weight: 800; padding: 5px 15px;" wire:click="$set('amount', {{ $selectedChequeDetails['remaining_amount'] }})">
                                                                            <i class="fas fa-magic mr-1"></i> {!! __('cheques.fill_remaining') !!}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-md-6 mb-2">
                                                    <div class="premium-form-group">
                                                        <label for="amount" class="font-weight-bold">{!! __('payments.amount') !!} <span class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="number" step="0.01" class="form-control premium-input shadow-none" id="amount" wire:model.live.debounce.250ms="amount" placeholder="0.00" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-dollar-sign text-primary"></i>
                                                        </div>
                                                        @error('amount') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-2">
                                                    <div class="premium-form-group">
                                                        <label for="reference_number" class="font-weight-bold">{!! __('payments.reference_number') !!}</label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="text" class="form-control premium-input shadow-none" id="reference_number" wire:model.live="reference_number" placeholder="Ref#" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-barcode text-primary"></i>
                                                        </div>
                                                        @error('reference_number') <span class="text-danger small">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <div class="premium-form-group mb-0">
                                                        <label for="notes" class="font-weight-bold">{!! __('payments.notes') !!}</label>
                                                        <textarea class="form-control premium-textarea-standalone shadow-none" id="notes" wire:model.live="notes" rows="3" placeholder="{!! __('payments.any_notes') !!}" {{ !$contract_id ? 'disabled' : '' }}></textarea>
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
                            <div class="sticky-sidebar">
                                <!-- Contract Insight Card -->
                                <div class="premium-fade-in" style="animation-delay: 0.3s;" wire:key="summary-wrapper">
                                    <div class="payment-summary-card mb-3">
                                        <div class="payment-summary-header">
                                            <div class="payment-summary-icon-box">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                            <div class="payment-summary-title">{!! __('payments.contract_financial_summary') !!}</div>
                                        </div>

                                        <div class="payment-summary-body" wire:loading.class.delay.500ms="opacity-50">
                                            @if($contract_id)
                                                <!-- Financial Status Rows -->
                                                <div class="payment-summary-item">
                                                    <span class="payment-summary-label">{!! __('contracts.total_amount') !!}</span>
                                                    <span class="payment-summary-value text-dark font-weight-bold">{{ number_format($financials['total_amount'], 0) }}</span>
                                                </div>
                                                <div class="payment-summary-item">
                                                    <span class="payment-summary-label text-success">{!! __('contracts.paid_amount') !!}</span>
                                                    <span class="payment-summary-value text-success font-weight-bold">{{ number_format($financials['paid_amount'], 0) }}</span>
                                                </div>
                                                <div class="payment-summary-item mb-1">
                                                    <span class="payment-summary-label text-danger">{!! __('contracts.remaining_amount') !!}</span>
                                                    <span class="payment-summary-value text-danger font-weight-bold">{{ number_format($financials['remaining'], 0) }}</span>
                                                </div>

                                                <!-- Progress Bar -->
                                                <div class="px-2 mb-3">
                                                    <div class="financial-progress">
                                                        <div class="financial-progress-bar bg-success" style="width: {{ $financials['paid_pct'] }}%;"></div>
                                                        @if($financials['pending_pct'] > 0)
                                                            <div class="financial-progress-bar bg-warning opacity-75" style="width: {{ $financials['pending_pct'] }}%; {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: {{ $financials['paid_pct'] }}%;"></div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex justify-content-between extra-small font-weight-bold mt-1">
                                                        <span class="text-success">{{ round($financials['paid_pct']) }}%</span>
                                                        <span class="text-muted small">{!! __('payments.financial_coverage_index') !!}</span>
                                                    </div>
                                                </div>

                                                <!-- Projected After This Payment -->
                                                @if($amount > 0)
                                                    <hr class="my-2 border-light">
                                                    <div class="payment-summary-item bg-light-success border-success-premium mb-3" style="border: 1px dashed #10b981; border-radius: 12px; background: rgba(16, 185, 129, 0.05);">
                                                        <span class="payment-summary-label text-dark">{!! __('payments.projected_remaining') !!}</span>
                                                        <span class="payment-summary-value text-success font-weight-bolder" style="font-size: 1.2rem;">{{ number_format($projectedRemaining, 0) }}</span>
                                                    </div>
                                                @endif

                                                <!-- Legend -->
                                                <div class="d-flex justify-content-between mt-2" style="font-size: 0.75rem; font-weight: 700;">
                                                    <span class="text-success"><i class="fas fa-circle mr-1" style="font-size: 8px;"></i> {!! __('payments.paid') !!}</span>
                                                    <span class="text-warning"><i class="fas fa-circle mr-1" style="font-size: 8px;"></i> {!! __('cheques.cheques') !!}</span>
                                                    <span class="text-muted"><i class="fas fa-circle mr-1" style="font-size: 8px;"></i> {!! __('payments.remaining') !!}</span>
                                                </div>

                                                <!-- Portfolio Section -->
                                                @if(count($allCheques) > 0)
                                                    <div class="mt-4 pt-2 border-top">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="small font-weight-bold mb-0 text-dark">
                                                                <i class="fas fa-university mr-1 text-primary"></i> {!! __('payments.linked_cheques') !!}
                                                            </h6>
                                                            <span class="badge badge-light-primary rounded-pill">{{ count($allCheques) }}</span>
                                                        </div>
                                                        <div class="linked-cheques-scrollable" style="max-height: 180px; overflow-y: auto; padding-right: 5px;">
                                                            @foreach($allCheques as $chq)
                                                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-white rounded-lg {{ $chq->remaining_amount <= 0 ? 'opacity-75' : '' }}" 
                                                                     style="border: 1px solid #f1f5f9; border-right: 3px solid {{ $chq->remaining_amount <= 0 ? '#94a3b8' : '#10b981' }};">
                                                                    <div style="flex: 1;">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="small font-weight-bold text-dark">#{{ $chq->cheque_number }}</span>
                                                                            @if($chq->remaining_amount <= 0)
                                                                                <i class="fas fa-check-circle text-success ml-1 small"></i>
                                                                            @endif
                                                                        </div>
                                                                        <div class="extra-small text-muted text-truncate" style="max-width: 120px;">
                                                                            {{ is_array($chq->bank_name) ? ($chq->bank_name[app()->getLocale()] ?? current($chq->bank_name)) : $chq->bank_name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <div class="small font-weight-bold {{ $chq->remaining_amount <= 0 ? 'text-muted' : 'text-primary' }}">
                                                                            {{ number_format($chq->amount, 0) }}
                                                                        </div>
                                                                        @if($chq->remaining_amount > 0)
                                                                            <div class="extra-small text-success font-weight-bold">
                                                                                {{ __('payments.available') }}: {{ number_format($chq->remaining_amount, 0) }}
                                                                            </div>
                                                                        @else
                                                                            <div class="extra-small text-muted italic">
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
                                                <div class="text-center py-4 text-muted">
                                                    <i class="fas fa-info-circle mb-2 font-large-1 d-block opacity-25"></i>
                                                    <span class="small">{!! __('contracts.select_contract_to_view_details') !!}</span>
                                                </div>
                                            @endif
                                        </div>

                                        @if($contract_id)
                                            <div class="payment-summary-footer mt-2 border-top pt-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="small text-muted font-weight-bold">{!! __('payments.cheques_balance') !!} ({{ __('payments.available') }} / {{ __('payments.total') }}):</span>
                                                    <span class="font-weight-bold text-danger" style="font-size: 1.1rem;">
                                                        {{ number_format($financials['pending_cheques_total'], 0) }} / {{ number_format($financials['pending_cheques_original_total'], 0) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
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
                        dir: $('html').attr('data-textdirection') || 'ltr'
                    }).on('change', function(e) {
                        let val = $(this).val();
                        let model = $(this).attr('wire:model.live') || $(this).attr('wire:model') || this.id;
                        if (model) @this.set(model, val);
                    });
                });

                // Datepicker
                if (typeof flatpickr !== 'undefined') {
                    $('.ptc-datepicker').each(function() {
                        flatpickr(this, {
                            dateFormat: "Y-m-d",
                            allowInput: true,
                            locale: $('html').attr('lang') == 'ar' ? 'ar' : 'default',
                            onChange: function(selectedDates, dateStr, instance) {
                                let model = $(instance.element).attr('wire:model.live') || $(instance.element).attr('wire:model');
                                if (model) @this.set(model, dateStr);
                            }
                        });
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
