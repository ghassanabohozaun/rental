<div>
    <form wire:submit.prevent="save" novalidate>
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
                                    {!! $isEdit
                                        ? __('cheques.edit_cheque')
                                        : ($is_deposit == 1
                                            ? __('cheques.add_insurance_cheque')
                                            : __('cheques.add_cheque')) !!}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <div class="d-flex align-items-center justify-content-end mb-1">
                        <a href="{!! route('dashboard.cheques.index') !!}" class="btn-premium-back mr-1">
                            <i class="fas fa-arrow-right"></i> {!! __('general.back') !!}
                        </a>
                        @if(!$isContractFulfilled)
                        <button class="btn btn-premium-save shadow-pulse" type="submit" wire:loading.attr="disabled"
                            wire:target="save">
                            <i class="fas fa-save" wire:loading.remove wire:target="save"></i>
                            <i class="fas fa-sync fa-spin ml-1" wire:loading wire:target="save"></i>
                            {!! __('general.save') !!}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end :content header -->

            <!-- begin: content body -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row">
                        <div class="col-lg-8 col-md-12">

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

                            <!-- Card 1: Contract & Company -->
                            <div class="premium-fade-in" wire:key="card-1-wrapper">
                                <div class="card premium-card">
                                    <div class="premium-mandatory-header">
                                        <i class="fas fa-file-contract text-primary"></i>
                                        {!! __('cheques.contract_selection') !!}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if (user()->company_id == 1)
                                                <div class="col-md-12 mb-1" wire:key="company-select-container">
                                                    <div class="premium-form-group">
                                                        <label for="company_id">{!! __('companies.company') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper" wire:ignore>
                                                            <select
                                                                class="form-control premium-input shadow-none js-select2"
                                                                id='company_id' wire:model.live="company_id"
                                                                {{ $isEdit ? 'disabled' : '' }}>
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}">{{ $company->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fas fa-briefcase text-primary"></i>
                                                        </div>
                                                        @error('company_id')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12" wire:key="contract-select-container-{{ $company_id }}">
                                                <div class="premium-form-group">
                                                    <label for="contract_id"
                                                        class="premium-label font-weight-bold">{!! __('cheques.contract') !!}
                                                        <span class="text-danger">*</span></label>
                                                    <div class="premium-input-wrapper" wire:ignore>
                                                        <select class="form-control premium-input shadow-none js-select2" id='contract_id' wire:model.live="contract_id" 
                                                             {{ ($isEdit || (user()->company_id == 1 && empty($company_id))) ? 'disabled' : '' }}>
                                                            <option value="">
                                                                @if (user()->company_id == 1 && !$company_id)
                                                                    {!! __('cheques.select_company_first') !!}
                                                                @else
                                                                    {!! __('contracts.select_contract') !!}
                                                                @endif
                                                            </option>
                                                            @foreach ($contracts as $contract)
                                                                <option value="{{ $contract->id }}">
                                                                    {{ __('contracts.contract') . ' #' . $contract->id . ' - ' . optional($contract->customer)->name . ' (' . optional($contract->property)->name . ')' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fas fa-file-invoice text-primary"></i>
                                                    </div>
                                                    @error('contract_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($isContractFulfilled)
                                <div class="premium-fade-in" wire:key="fulfilled-wrapper">
                                    <div class="card premium-card border-success" style="border-top: 4px solid #10b981;">
                                        <div class="card-body text-center py-5">
                                            <div class="mb-3">
                                                <div class="d-inline-flex align-items-center justify-content-center bg-light-success rounded-circle" style="width: 100px; height: 100px; background: rgba(16, 185, 129, 0.1);">
                                                    <i class="fas fa-check-circle text-success fa-4x"></i>
                                                </div>
                                            </div>
                                            <h2 class="text-success font-weight-bold mb-2">{!! __('cheques.contract_fully_covered') !!}</h2>
                                            <p class="text-muted mx-auto mb-4" style="max-width: 450px; font-size: 1.1rem;">
                                                {!! __('cheques.contract_fully_covered_desc') !!}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <span class="badge badge-light-success p-2 px-3 rounded-pill">
                                                    <i class="fas fa-info-circle mr-1"></i> {!! __('cheques.select_another_contract') !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Card 2: Cheque Details -->
                                <div class="premium-fade-in" style="animation-delay: 0.1s;" wire:key="card-2-wrapper">
                                    <div class="card premium-card">
                                        <div class="premium-mandatory-header">
                                            <i class="fas fa-money-check-alt text-warning"></i>
                                            {!! __('cheques.cheque_details') !!}
                                        </div>
                                        <div class="card-body {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="premium-form-group">
                                                        <label for="cheque_number">{!! __('cheques.cheque_number') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="text" class="form-control premium-input shadow-none"
                                                                id="cheque_number" wire:model="cheque_number"
                                                                placeholder="{!! __('cheques.cheque_number') !!}" autocomplete="off" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-barcode text-danger"></i>
                                                        </div>
                                                        @error('cheque_number')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="premium-form-group">
                                                        <label for="amount">{!! __('cheques.amount') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="number" step="0.01"
                                                                class="form-control premium-input shadow-none {{ $currentChequeUsedAmount > 0 ? 'bg-light' : '' }}" 
                                                                id="amount"
                                                                wire:model.live.debounce.150ms="amount" 
                                                                placeholder="{!! __('cheques.amount') !!}"
                                                                {{ ($currentChequeUsedAmount > 0 || !$contract_id) ? 'readonly' : '' }}
                                                                autocomplete="off">
                                                            <i class="fas fa-money-bill-wave text-danger"></i>
                                                        </div>
                                                        @if($currentChequeUsedAmount > 0)
                                                            <div class="mt-1">
                                                                <span class="text-muted small">
                                                                    <i class="fas fa-lock mr-1"></i> {!! __('cheques.cannot_edit_used_cheque') !!}
                                                                </span>
                                                            </div>
                                                        @endif
                                                        @error('amount')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="premium-form-group">
                                                        <label for="status">{!! __('cheques.status') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper" wire:ignore>
                                                            <select class="form-control premium-input shadow-none js-select2"
                                                                id="status" wire:model="status" {{ !$contract_id ? 'disabled' : '' }}>
                                                                @foreach (__('cheques.statuses') as $key => $value)
                                                                    <option value="{!! $key !!}">
                                                                        {!! $value !!}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fas fa-info-circle text-danger"></i>
                                                        </div>
                                                        @error('status')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="premium-form-group">
                                                        <label for="is_deposit">{!! __('cheques.is_deposit') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <select class="form-control premium-input shadow-none"
                                                                id="is_deposit_display" wire:model.live="is_deposit" disabled>
                                                                <option value="0">{!! __('general.no') !!}</option>
                                                                <option value="1">{!! __('general.yes') !!}</option>
                                                            </select>
                                                            <i class="fas fa-shield-alt text-primary"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="premium-form-group">
                                                        <label for="issue_date">{!! __('cheques.issue_date') !!} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper" wire:ignore>
                                                            <input type="text"
                                                                class="form-control premium-input shadow-none ptc-datepicker"
                                                                id="issue_date" wire:model="issue_date" autocomplete="off"
                                                                placeholder="YYYY-MM-DD" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-calendar-alt text-danger"></i>
                                                        </div>
                                                        @error('issue_date')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="premium-form-group">
                                                        <label for="due_date">{!! __('cheques.due_date') !!}</label>
                                                        <div class="premium-input-wrapper" wire:ignore>
                                                            <input type="text"
                                                                class="form-control premium-input shadow-none ptc-datepicker"
                                                                id="due_date" wire:model="due_date" autocomplete="off"
                                                                placeholder="YYYY-MM-DD" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-calendar-alt-times text-primary"></i>
                                                        </div>
                                                        @error('due_date')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            @if($dateWarning)
                                                <div class="row mt-2">
                                                    <div class="col-12">
                                                        <div class="alert alert-light-warning d-flex align-items-center p-2 mb-0" style="border-right: 4px solid #f59e0b; border-radius: 12px;">
                                                            <i class="fas fa-exclamation-triangle mr-2 text-warning"></i>
                                                            <span class="small font-weight-bold text-warning">{{ $dateWarning }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Bank & Owner -->
                                <div class="premium-fade-in" style="animation-delay: 0.2s;" wire:key="card-3-wrapper">
                                    <div class="card premium-card">
                                        <div class="premium-mandatory-header">
                                            <i class="fas fa-university text-danger"></i>
                                            {!! __('cheques.bank_and_owner_info') !!}
                                        </div>
                                        <div class="card-body {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="premium-form-group">
                                                        <label for="bank_name_ar">{!! __('cheques.bank_name') !!}
                                                            ({!! __('general.ar') !!}) <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="text"
                                                                class="form-control premium-input shadow-none"
                                                                id="bank_name_ar" wire:model="bank_name.ar"
                                                                placeholder="{!! __('cheques.bank_name') !!}" autocomplete="off" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-university text-danger"></i>
                                                        </div>
                                                        @error('bank_name.ar')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="premium-form-group">
                                                        <label for="bank_name_en">{!! __('cheques.bank_name') !!}
                                                            ({!! __('general.en') !!}) <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="text"
                                                                class="form-control premium-input shadow-none"
                                                                id="bank_name_en" wire:model="bank_name.en"
                                                                placeholder="{!! __('cheques.bank_name') !!}" autocomplete="off" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-university text-danger"></i>
                                                        </div>
                                                        @error('bank_name.en')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="premium-form-group">
                                                        <label for="owner_name_ar">{!! __('cheques.cheque_owner_name') !!}
                                                            ({!! __('general.ar') !!}) <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="text"
                                                                class="form-control premium-input shadow-none"
                                                                id="owner_name_ar" wire:model="cheque_owner_name.ar"
                                                                placeholder="{!! __('cheques.cheque_owner_name') !!}" autocomplete="off" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-user text-primary"></i>
                                                        </div>
                                                        @error('cheque_owner_name.ar')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="premium-form-group">
                                                        <label for="owner_name_en">{!! __('cheques.cheque_owner_name') !!}
                                                            ({!! __('general.en') !!}) <span
                                                                class="text-danger">*</span></label>
                                                        <div class="premium-input-wrapper">
                                                            <input type="text"
                                                                class="form-control premium-input shadow-none"
                                                                id="owner_name_en" wire:model="cheque_owner_name.en"
                                                                placeholder="{!! __('cheques.cheque_owner_name') !!}" autocomplete="off" {{ !$contract_id ? 'disabled' : '' }}>
                                                            <i class="fas fa-user text-primary"></i>
                                                        </div>
                                                        @error('cheque_owner_name.en')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="premium-form-group mb-0">
                                                        <label for="notes">{!! __('cheques.notes') !!}</label>
                                                        <div class="premium-input-wrapper no-icon">
                                                            <textarea class="form-control premium-input shadow-none" id="notes" wire:model="notes" rows="3"
                                                                placeholder="{!! __('cheques.notes') !!}"></textarea>
                                                        </div>
                                                        @error('notes')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar Area (4) -->
                        <div class="col-lg-4 col-md-12">
                            <div class="sticky-top" style="top: 20px;">

                                <!-- Card 1: Financial Summary -->
                                <div class="premium-fade-in" style="animation-delay: 0.3s;" wire:key="summary-wrapper">
                                    <div class="cheque-summary-card mb-3 {{ $projectedRemaining < 0 ? 'pulse-red' : '' }}">
                                        <div class="cheque-summary-header">
                                            <div class="cheque-summary-icon-box">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                            <div class="cheque-summary-title">{!! __('payments.contract_financial_summary') !!}</div>
                                        </div>

                                        <div class="cheque-summary-body" wire:loading.class.delay.500ms="opacity-50">
                                            <div class="cheque-summary-item">
                                                <span class="cheque-summary-label">{!! __('contracts.total_amount') !!}</span>
                                                <span
                                                    class="cheque-summary-value">{{ number_format($financials['total_amount'], 0) }}</span>
                                            </div>
                                            <div class="cheque-summary-item">
                                                <span
                                                    class="cheque-summary-label text-success">{!! __('payments.paid_amount') !!}</span>
                                                <span
                                                    class="cheque-summary-value text-success">{{ number_format($financials['paid_amount'], 0) }}</span>
                                            </div>
                                            <div class="cheque-summary-item">
                                                <span
                                                    class="cheque-summary-label text-danger">{!! __('payments.remaining_amount') !!}</span>
                                                <span
                                                    class="cheque-summary-value text-danger">{{ number_format($financials['remaining'], 0) }}</span>
                                            </div>

                                            @if ($contract_id)
                                                <hr class="my-1 border-light">
                                                <div class="cheque-summary-item">
                                                    <span
                                                        class="cheque-summary-label font-weight-bold">{{ $is_deposit == 1 ? __('contracts.deposit_amount') : __('payments.projected_remaining') }}</span>
                                                    <span
                                                        class="cheque-summary-value font-weight-bold {{ $projectedRemaining < 0 ? 'text-danger' : 'text-primary' }}">
                                                        {{ number_format($projectedRemaining, 0) }}
                                                    </span>
                                                </div>

                                                <!-- Financial Health Bar -->
                                                @php
                                                    $total = $financials['total_amount'] ?: 1;
                                                    $paid_pct = ($financials['paid_amount'] / $total) * 100;
                                                    
                                                    // Get other cheques' unused total (excluding current)
                                                    $otherPending = $financials['pending_total'];
                                                    if ($isEdit) {
                                                        // Subtract the OLD remaining amount of this cheque which is already in pending_total
                                                        $currentChequeOldRemaining = max(0, (\App\Models\Contract::find($contract_id)->cheques()->find($chequeId)->remaining_amount ?? 0));
                                                        $otherPending = max(0, $otherPending - $currentChequeOldRemaining);
                                                    }
                                                    
                                                    $currentUnused = max(0, (float)$amount - $currentChequeUsedAmount);
                                                    $pending_pct = (($otherPending + $currentUnused) / $total) * 100;
                                                @endphp
                                                <div class="mt-4 mb-2">
                                                    <div class="d-flex justify-content-between small mb-1 font-weight-bold">
                                                        <span>{!! __('payments.financial_health') !!}</span>
                                                        <span class="text-primary">{{ number_format($paid_pct + $pending_pct, 1) }}%</span>
                                                    </div>
                                                    <div class="progress" style="height: 10px; border-radius: 5px; background: #f1f5f9; overflow: hidden;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $paid_pct }}%" title="Paid"></div>
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pending_pct }}%" title="Cheques"></div>
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2" style="font-size: 0.7rem;">
                                                        <span class="text-success"><i class="fas fa-circle mr-1"></i> {!! __('payments.paid') !!}</span>
                                                        <span class="text-warning"><i class="fas fa-circle mr-1"></i> {!! __('cheques.cheques') !!}</span>
                                                        <span class="text-muted"><i class="fas fa-circle mr-1"></i> {!! __('payments.remaining') !!}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="cheque-summary-footer" wire:loading.class.delay.500ms="opacity-50">
                                            {!! __('payments.pending_cheques') !!}:
                                            <span class="text-danger">{{ number_format($financials['pending_total'], 0) }}
                                                / {{ number_format($financials['pending_original'], 0) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Quick Tips -->
                                <div class="premium-fade-in" style="animation-delay: 0.4s;" wire:key="tips-wrapper">
                                    <div class="card premium-card">
                                        <div class="premium-mandatory-header" style="border-bottom-color: #f59e0b;">
                                            <i class="fas fa-lightbulb text-warning"></i>
                                            {!! __('properties.quick_tips') !!}
                                        </div>
                                        <div class="card-body">
                                            <ul class="tip-list mb-0">
                                                <li><i class="fas fa-check-circle text-warning"></i>
                                                    {!! __('cheques.tip_1') !!}</li>
                                                <li><i class="fas fa-check-circle text-warning"></i>
                                                    {!! __('cheques.tip_2') !!}</li>
                                                <li><i class="fas fa-check-circle text-warning"></i>
                                                    {!! __('cheques.amount_guidance') !!}</li>
                                                <li><i class="fas fa-check-circle text-warning"></i>
                                                    {!! __('cheques.is_deposit_guidance') !!}</li>
                                                <li><i class="fas fa-check-circle text-warning"></i>
                                                    {!! __('cheques.cheque_number_guidance') !!}</li>
                                                <li><i class="fas fa-check-circle text-warning"></i>
                                                    {!! __('cheques.due_date_guidance') !!}</li>
                                            </ul>
                                        </div>
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
                    if ($(this).hasClass("select2-hidden-accessible")) {
                        return;
                    }
                    $(this).select2({
                        width: '100%',
                        dir: $('html').attr('data-textdirection') || 'ltr'
                    }).on('change', function(e) {
                        let val = $(this).val();
                        let model = $(this).attr('wire:model.live') || $(this).attr('wire:model') || this.id;
                        if (model) {
                            @this.set(model, val);
                        }
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
                                if (model) {
                                    @this.set(model, dateStr);
                                }
                            }
                        });
                    });
                }
            }

            $(document).ready(function() {
                initPlugins();
            });

            // Listen for browser events (Livewire 3)
            // Explicit re-init when requested by backend
            window.addEventListener('reinit-plugins', event => {
                setTimeout(initPlugins, 50);
            });

            // Re-init on navigated
            document.addEventListener('livewire:navigated', () => {
                initPlugins();
            });
        </script>
    @endpush
</div>
