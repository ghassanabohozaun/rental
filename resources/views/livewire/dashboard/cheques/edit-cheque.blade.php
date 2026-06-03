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
                                    <div class="premium-mandatory-header py-2">
                                        <div class="title-wrapper">
                                            <i class="fas fa-file-contract"></i>
                                            <span class="font-weight-bold">{!! __('cheques.contract_selection') !!}</span>
                                        </div>
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
                            <div class="" wire:key="card-2-wrapper-{{ $validation_fail_nonce }}">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header py-2 d-flex justify-content-between align-items-center">
                                        <div class="title-wrapper">
                                            <i class="fas fa-money-check-alt"></i>
                                            <span class="font-weight-bold">{!! __('cheques.cheque_details') !!}</span>
                                        </div>
                                        @if($contract_id)
                                            <button type="button" class="btn btn-sm btn-premium-save shadow-sm" data-toggle="modal" data-target="#excelImportModal" style="border-radius: 8px;">
                                                <i class="fas fa-file-excel mr-1"></i> {!! __('cheques.import_from_excel') !!}
                                            </button>
                                        @endif
                                    </div>
                                    <div
                                        class="card-body {{ !$contract_id ? 'opacity-50 pointer-events-none' : '' }}">
                                        @if($amountExceedsRemaining)
                                            <div class="alert alert-premium-warning premium-fade-in d-flex align-items-center mb-3 border-0 shadow-sm" style="border-radius: 12px; background-color: #fff3cd;">
                                                <i class="fas fa-exclamation-triangle font-large-1 mr-2 text-warning"></i>
                                                <div>
                                                    <strong class="text-warning">{!! __('cheques.amount_exceeds_contract_remaining') !!} ({{ number_format($availableToCover, 2) }})</strong>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class="premium-form-group @error('cheque_number') is-invalid-premium @enderror">
                                                    <label for="cheque_number">{!! __('cheques.cheque_number') !!} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control premium-input shadow-none"
                                                        id="cheque_number" wire:model.live.debounce.150ms="cheque_number"
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
                                                        <div class="mt-1 d-flex align-items-center gap-1" style="color: #dc3545;">
                                                            <i class="fas fa-lock" style="font-size: 0.75rem;"></i>
                                                            <span style="font-size: 0.78rem; font-weight: 600;">
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
                            <div class=""
                                wire:key="card-3-wrapper-{{ $validation_fail_nonce }}">
                                <div class="card premium-card mb-2">
                                    <div class="premium-mandatory-header py-2">
                                        <div class="title-wrapper">
                                            <i class="fas fa-university"></i>
                                            <span class="font-weight-bold">{!! __('cheques.bank_and_owner_info') !!}</span>
                                        </div>
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
                                                        id="bank_name_ar" wire:model.live.debounce.150ms="bank_name.ar"
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
                                                        id="bank_name_en" wire:model.live.debounce.150ms="bank_name.en"
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
                                                        id="owner_name_ar" wire:model.live.debounce.150ms="cheque_owner_name.ar"
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
                                                        id="owner_name_en" wire:model.live.debounce.150ms="cheque_owner_name.en"
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
                                <div class="" wire:key="summary-wrapper-{{ $validation_fail_nonce }}">
                                    <div class="payment-summary-card-premium mb-3 {{ $projectedRemaining < 0 ? 'pulse-red' : '' }}">
                                        <div class="premium-mandatory-header py-2">
                                            <div class="title-wrapper">
                                                <i class="fas fa-chart-pie"></i>
                                                <span class="font-weight-bold">{!! __('payments.contract_financial_summary') !!}</span>
                                            </div>
                                        </div>

                                        <div class="summary-body-premium" wire:loading.class.delay.500ms="opacity-50">
                                            @if($contract_id)
                                                <!-- Adaptive Smart Balance Breakdown -->
                                                <div class="smart-balance-card mb-3">
                                                    @if($is_deposit == 1)
                                                        <!-- Insurance Layout -->
                                                        <div class="smart-balance-header d-flex justify-content-between align-items-center mb-2">
                                                            <span class="font-weight-bold text-dark">{!! __('cheques.required_deposit_amount') !!}</span>
                                                            <span class="font-weight-bold text-dark" style="font-size: 1.1rem;">{{ number_format($financials['deposit_amount'], 2) }}</span>
                                                        </div>
                                                        <div class="smart-balance-breakdown">
                                                            <div class="breakdown-item covered-item">
                                                                <div class="breakdown-label"><i class="fas fa-shield-alt mr-1"></i> {!! __('cheques.insurance_covered_previously') !!}</div>
                                                                <div class="breakdown-value">{{ number_format($financials['insurance_covered'], 2) }}</div>
                                                            </div>
                                                            <div class="breakdown-item uncovered-item {{ $financials['insurance_uncovered'] > 0 ? 'has-debt' : '' }}">
                                                                <div class="breakdown-label"><i class="fas fa-exclamation-circle mr-1"></i> {!! __('cheques.insurance_uncovered') !!}</div>
                                                                <div class="breakdown-value">{{ number_format($financials['insurance_uncovered'], 2) }}</div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- Rent Layout -->
                                                        <div class="smart-balance-header d-flex justify-content-between align-items-center mb-2">
                                                            <span class="font-weight-bold text-dark">{!! __('contracts.total_amount') !!}</span>
                                                            <span class="font-weight-bold text-dark" style="font-size: 1.1rem;">{{ number_format($financials['total_amount'], 2) }}</span>
                                                        </div>
                                                        <div class="smart-balance-breakdown">
                                                            <div class="breakdown-item paid-item">
                                                                <div class="breakdown-label"><i class="fas fa-check-circle mr-1"></i> {!! __('payments.paid_amount') !!}</div>
                                                                <div class="breakdown-value">{{ number_format($financials['paid_amount'], 2) }}</div>
                                                            </div>
                                                            <div class="breakdown-item covered-item">
                                                                <div class="breakdown-label"><i class="fas fa-shield-alt mr-1"></i> {!! __('cheques.current_guarantees') !!}</div>
                                                                <div class="breakdown-value">{{ number_format($financials['covered_by_cheques'], 2) }}</div>
                                                            </div>
                                                            <div class="breakdown-item uncovered-item {{ $financials['uncovered_debt'] > 0 ? 'has-debt' : '' }}">
                                                                <div class="breakdown-label"><i class="fas fa-exclamation-circle mr-1"></i> {!! __('cheques.uncovered_debt') !!}</div>
                                                                <div class="breakdown-value">{{ number_format($financials['uncovered_debt'], 2) }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Financial Indicator Section -->
                                                <div class="financial-indicator-section mt-4">
                                                     <span class="indicator-title">{!! __('cheques.financial_coverage_index') !!}</span>

                                                     <span class="indicator-percentage {{ $amountExceedsRemaining ? 'text-danger' : '' }}">{{ round(min(120, $paid_pct)) }}%</span>

                                                     <div class="financial-progress-premium triple-segment {{ $amountExceedsRemaining ? 'border-danger' : '' }}" style="{{ $amountExceedsRemaining ? 'border: 1px solid #ea5455; box-shadow: 0 0 0 3px rgba(234,84,85,0.2);' : '' }}">
                                                         <!-- Segment 1: Previous Paid -->
                                                         <div class="financial-progress-bar-premium financial-progress-bar-paid" style="width: {{ min(100, $paid_pct_previous) }}%;"></div>
                                                         
                                                         <!-- Segment 2: Existing Cheques (Striped) -->
                                                         @if($pending_pct > 0)
                                                             <div class="financial-progress-bar-premium financial-progress-bar-cheques-striped" style="width: {{ min(100 - min(100, $paid_pct_previous), $pending_pct) }}%;"></div>
                                                         @endif

                                                         <!-- Segment 3: Current Cheque (Pulsing) -->
                                                         @if($current_pct_dynamic > 0)
                                                             <div class="financial-progress-bar-premium financial-progress-bar-current-pulse pulse-blue" style="width: {{ min(100 - min(100, $paid_pct_previous + $pending_pct), $current_pct_dynamic) }}%; {{ $amountExceedsRemaining ? 'background: linear-gradient(90deg, #ea5455, #f87171) !important; box-shadow: 0 0 10px rgba(234,84,85,0.6) !important;' : '' }}"></div>
                                                         @endif
                                                     </div>

                                                     <!-- Legend -->
                                                     <div class="financial-legend-premium mt-2">
                                                         <div class="legend-item-premium text-success">
                                                             <i class="fas fa-circle legend-dot-premium"></i> {!! __('payments.paid') !!}
                                                         </div>
                                                         <div class="legend-item-premium text-warning">
                                                             <i class="fas fa-circle legend-dot-premium"></i> {!! __('cheques.cheques') !!} {!! __('cheques.previous_cheques') !!}
                                                         </div>
                                                         <div class="legend-item-premium text-primary pulse-legend-dot" style="opacity: 0.8;">
                                                             <i class="fas fa-circle legend-dot-premium" style="color: #60a5fa;"></i> {!! __('cheques.current_cheque') !!}
                                                         </div>
                                                     </div>
                                                 </div>

                                                <!-- Smart Assistant Box -->
                                                @if($smart_assistant_message)
                                                    <div class="smart-assistant-box premium-fade-in mt-3 {{ str_contains($smart_assistant_message, '❌') || str_contains($smart_assistant_message, 'تنبيه') || str_contains($smart_assistant_message, 'Warning') || str_contains($smart_assistant_message, 'Error') ? 'alert-state' : '' }}">
                                                        <div class="assistant-icon">
                                                            @if(str_contains($smart_assistant_message, '❌') || str_contains($smart_assistant_message, 'تنبيه') || str_contains($smart_assistant_message, 'Warning') || str_contains($smart_assistant_message, 'Error'))
                                                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                                            @elseif(str_contains($smart_assistant_message, 'ممتاز') || str_contains($smart_assistant_message, 'رائع') || str_contains($smart_assistant_message, 'Excellent') || str_contains($smart_assistant_message, 'Great'))
                                                                <i class="fas fa-check-double text-success"></i>
                                                            @else
                                                                <i class="fas fa-robot text-primary"></i>
                                                            @endif
                                                        </div>
                                                        <div class="assistant-text">
                                                            {{ $smart_assistant_message }}
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
                                            <div class="summary-footer-premium" wire:loading.class.delay.500ms="opacity-50">
                                                <div class="footer-balance-row justify-content-center">
                                                    <span class="footer-balance-label text-muted" style="font-size: 0.8rem;"><i class="fas fa-lock mr-1"></i> {!! __('cheques.all_amounts_are_without_currency') !!}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Card 2: Live Digital Cheque Preview -->
                                <div class="premium-card-anim mt-3" wire:key="live-cheque-preview">
                                    <div class="live-cheque-card">
                                        <div class="live-cheque-header">
                                            <i class="fas fa-money-check text-primary"></i>
                                            <span>{!! __('cheques.live_cheque_preview') !!}</span>
                                        </div>
                                        <div class="live-cheque-canvas">
                                            <div class="cheque-paper">
                                                <div class="cheque-top-row">
                                                    <div class="cheque-bank-name">
                                                        {{ $bank_name[app()->getLocale()] ?: __('cheques.bank_name_placeholder') }}
                                                    </div>
                                                    <div class="cheque-date">
                                                        {!! __('cheques.date') !!}: <span class="val">{{ $issue_date ?: 'YYYY-MM-DD' }}</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="cheque-pay-to">
                                                    {!! __('cheques.pay_to_the_order_of') !!}: <span class="val">{{ $cheque_owner_name[app()->getLocale()] ?: __('cheques.beneficiary_name_placeholder') }}</span>
                                                </div>
                                                
                                                <div class="cheque-amount-row">
                                                    {!! __('cheques.amount_in_words_label') !!}: <span class="val font-weight-bold" style="font-size: 1.2rem;">{{ $amount ? number_format((float)$amount, 2) : '0.00' }}</span>
                                                    @if($is_deposit == 1)
                                                        <span class="badge badge-light-warning ml-2" style="font-size: 0.6rem;">{!! __('cheques.insurance_cheque') !!}</span>
                                                    @endif
                                                </div>

                                                <div class="cheque-bottom-row">
                                                    <div class="cheque-no">
                                                        {!! __('cheques.cheque_number_label') !!}: <span class="val font-monospace">{{ $cheque_number ?: 'XXXXXX' }}</span>
                                                    </div>
                                                    <div class="cheque-signature">
                                                        {!! __('cheques.signature') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
            <!-- end :content body -->
        </div>
    </form>

    <!-- Excel Import Modal -->
    <div wire:ignore.self class="modal fade premium-modal" id="excelImportModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title font-weight-bold text-dark d-flex align-items-center">
                        {!! __('cheques.import_from_excel') !!}
                    </h6>
                    <button type="button" class="close premium-modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body py-3 px-4">
                    @if(empty($importedCheques))
                        <div class="text-center excel-dropzone">
                            <div class="mb-3">
                                <i class="fas fa-cloud-upload-alt excel-dropzone-icon"></i>
                            </div>
                            <h4 class="font-weight-bold text-dark mb-2">{!! __('cheques.upload_excel_file') !!}</h4>
                            <p class="text-muted mb-4">{!! __('cheques.upload_excel_file_hint') !!}</p>
                            
                            <div class="d-flex justify-content-center">
                                <input type="file" wire:model="excelFile" class="d-none" id="excelFileInput" accept=".xlsx,.xls,.csv">
                                <label for="excelFileInput" class="btn btn-outline-primary px-4 py-2 cursor-pointer mb-0 font-weight-bold" style="border-radius: 8px;">
                                    <i class="fas fa-search mr-2"></i> {!! __('cheques.choose_file') !!}
                                </label>
                            </div>
                            <div wire:loading wire:target="excelFile" class="text-primary mt-4 font-weight-bold">
                                <i class="fas fa-spinner fa-spin mr-2"></i> {!! __('cheques.uploading_and_analyzing') !!}
                            </div>
                            @error('excelFile') <div class="alert alert-danger mt-4 border-0 shadow-sm"><i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}</div> @enderror
                            
                            @if($excelFile)
                                <div class="mt-4 pt-3 border-top border-light">
                                    <button type="button" wire:click="importFromExcel" class="btn btn-excel-upload" wire:loading.attr="disabled" wire:target="importFromExcel">
                                        <i wire:loading.remove wire:target="importFromExcel" class="fas fa-file-import mr-2"></i>
                                        <i wire:loading wire:target="importFromExcel" class="fas fa-spinner fa-spin mr-2"></i>
                                        {!! __('cheques.upload') !!}
                                    </button>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-list-ul mr-2 text-primary"></i>{!! __('cheques.excel_cheques_list') !!}
                            </h5>
                            <button type="button" class="btn btn-light-secondary btn-sm rounded-pill px-3 font-weight-bold" wire:click="$set('importedCheques', [])">
                                <i class="fas fa-redo mr-1"></i> {!! __('cheques.upload_another_file') !!}
                            </button>
                        </div>
                        <div class="excel-table-wrapper" style="max-height: 500px; overflow-y: auto;">
                            <table class="table table-hover text-center w-100">
                                <thead class="sticky-top">
                                    <tr>
                                        <th>#</th>
                                        <th>{!! __('cheques.cheque_number') !!}</th>
                                        <th>{!! __('cheques.amount') !!}</th>
                                        <th>{!! __('cheques.bank_name') !!}</th>
                                        <th>{!! __('cheques.date') !!}</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($importedCheques as $index => $cheque)
                                        <tr>
                                            <td class="text-muted">{{ $index + 1 }}</td>
                                            <td class="font-weight-bold text-dark">{{ $cheque['cheque_number'] }}</td>
                                            <td><span class="excel-amount-badge">{{ number_format($cheque['amount'], 2) }}</span></td>
                                            <td>{{ $cheque['bank_name'] }}</td>
                                            <td class="text-muted">{{ $cheque['issue_date'] ?: '-' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-excel-select" wire:click="selectExcelCheque({{ $index }})" data-dismiss="modal">
                                                    <i class="fas fa-check mr-1"></i> {!! __('cheques.select_this_cheque') !!}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-0 pt-0 premium-modal-footer">
                    <button type="button" class="btn btn-premium-secondary px-4 font-weight-bold" data-dismiss="modal">
                        <i class="fas fa-times-circle mr-2"></i> {{ __('general.cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

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
