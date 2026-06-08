<div class="content-wrapper">
    <!-- begin: content header -->
    <div class="content-header row align-items-center mb-2">
        <div class="content-header-left col-md-6 col-12 mb-2 mb-md-0">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb premium-breadcrumb shadow-sm">
                        <li class="breadcrumb-item">
                            <a href="{!! route('dashboard.index') !!}">
                                <i class="fas fa-home"></i> {!! __('dashboard.home') !!}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{!! route('dashboard.contracts.index') !!}">
                                {!! __('contracts.contracts') !!}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {!! __('contracts.create_new_contract') !!}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 text-md-right mb-2">
            <div class="d-flex justify-content-md-end justify-content-center gap-2">
                <a href="{!! route('dashboard.contracts.index') !!}" class="btn-premium-back">
                    <i class="fas fa-arrow-left"></i> {!! __('general.back') !!}
                </a>
                <button wire:click="store" class="btn btn-premium-save" type="button" wire:loading.attr="disabled">
                    <i wire:loading.remove wire:target="store" class="fas fa-save mr-2 save-icon"></i>
                    <i wire:loading wire:target="store" class="fas fa-spinner fa-spin mr-2"></i>
                    {!! __('general.save') !!}
                </button>
            </div>
        </div>
    </div>
    <!-- end :content header -->

    <!-- begin: content body -->
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card premium-card shadow-lg border-0">
                        <div class="premium-mandatory-header py-2">
                            <div class="title-wrapper">
                                <i class="fas fa-plus-circle"></i>
                                <span class="font-weight-bold">{!! __('contracts.create_new_contract') !!}</span>
                            </div>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body pt-1" wire:ignore.self x-data="{ activeTab: 'basic' }">
                                <!-- Elite Floating Tabs Navigation -->
                                @php
                                    $hasBasicErrors = $errors->hasAny(['company_id', 'property_id', 'customer_id', 'conclusion_date', 'start_date', 'end_date', 'rent_amount', 'deposit_amount', 'payment_cycle', 'status', 'deposit_type', 'deposit_status', 'deposit_cheque_number', 'deposit_issue_date', 'deposit_bank_name.*', 'deposit_cheque_owner_name.*']);
                                    $hasPartiesErrors = $errors->hasAny(['second_party_data.*', 'property_data.*']);
                                    $hasUtilitiesErrors = $errors->hasAny(['utilities_data.*']);
                                    $hasTermsErrors = $errors->hasAny(['grace_period', 'contract_clauses.*', 'contract_text', 'notes']);
                                @endphp

                                <div class="d-flex justify-content-center w-100 mb-2">
                                    <ul class="nav premium-nav-tabs" id="contractTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link premium-tab-btn {{ $hasBasicErrors ? 'text-danger' : '' }}" 
                                                :class="{ 'active': activeTab === 'basic' }" @click.prevent="activeTab = 'basic'"
                                                href="#basic">
                                                @if($hasBasicErrors) <span class="tab-error-dot"></span> @endif
                                                <i class="fas fa-info-circle"></i> {!! __('contracts.basic_details_tab') !!}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link premium-tab-btn {{ $hasPartiesErrors ? 'text-danger' : '' }}"
                                                :class="{ 'active': activeTab === 'parties-property' }" @click.prevent="activeTab = 'parties-property'"
                                                href="#parties-property">
                                                @if($hasPartiesErrors) <span class="tab-error-dot"></span> @endif
                                                <i class="fas fa-users"></i> {!! __('contracts.parties_property_tab') !!}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link premium-tab-btn {{ $hasUtilitiesErrors ? 'text-danger' : '' }}"
                                                :class="{ 'active': activeTab === 'utilities' }" @click.prevent="activeTab = 'utilities'"
                                                href="#utilities">
                                                @if($hasUtilitiesErrors) <span class="tab-error-dot"></span> @endif
                                                <i class="fas fa-bolt"></i> {!! __('contracts.utilities_tab') !!}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link premium-tab-btn {{ $hasTermsErrors ? 'text-danger' : '' }}"
                                                :class="{ 'active': activeTab === 'terms' }" @click.prevent="activeTab = 'terms'"
                                                href="#terms">
                                                @if($hasTermsErrors) <span class="tab-error-dot"></span> @endif
                                                <i class="fas fa-file-invoice"></i> {!! __('contracts.contract_terms_tab') !!}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end: Tabs Navigation -->

                                <div class="tab-content tab-content-premium" id="contractTabsContent">
                                    <!-- Tab 1: Basic & Financial Details -->
                                    <div class="tab-pane fade" :class="{ 'show active': activeTab === 'basic' }" id="basic" wire:ignore.self>
                                        <div class="form-body">
                                            
                                            @if ($companies)
                                                <div class="row mb-1">
                                                    <div class="col-md-12 mb-2" wire:key="company-select-col">
                                                        <div class="premium-form-group @error('company_id') is-invalid-premium @enderror">
                                                            <label for="company_id" class="premium-label">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                                                            <div wire:ignore>
                                                                <select id="company_id" wire:model.live="company_id" class="form-control premium-input shadow-none select2">
                                                                    <option value="">{!! __('general.select_company') !!}</option>
                                                                    @foreach ($companies as $company)
                                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('company_id') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-6 mb-2" wire:key="property-col-{{ $company_id }}">
                                                    <div class="premium-form-group @error('property_id') is-invalid-premium @enderror">
                                                        <label for="property_id" class="premium-label">{!! __('contracts.property') !!} <small class="text-muted">({!! __('properties.available_properties') !!})</small> <span class="text-danger">*</span></label>
                                                        <div wire:ignore wire:key="property-wrapper-{{ $company_id ? 'enabled' : 'disabled' }}">
                                                            <select id="property_id" wire:model="property_id" class="form-control premium-input shadow-none select2-ajax"
                                                                data-url="{!! route('dashboard.properties.autocomplete') !!}" data-placeholder="{!! __('contracts.select_property') !!}"
                                                                {{ isset($companies) && !$company_id ? 'disabled' : '' }}>
                                                                <option value="">{!! __('contracts.select_property') !!}</option>
                                                            </select>
                                                        </div>
                                                        @error('property_id') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2" wire:key="customer-col-{{ $company_id }}">
                                                    <div class="premium-form-group @error('customer_id') is-invalid-premium @enderror">
                                                        <label for="customer_id" class="premium-label">{!! __('contracts.customer') !!} <small class="text-muted">({!! __('contracts.available_customers_hint') !!})</small> <span class="text-danger">*</span></label>
                                                        <div wire:ignore wire:key="customer-wrapper-{{ $company_id ? 'enabled' : 'disabled' }}">
                                                            <select id="customer_id" wire:model="customer_id" class="form-control premium-input shadow-none select2-ajax"
                                                                data-url="{!! route('dashboard.customers.autocomplete') !!}" data-placeholder="{!! __('contracts.select_customer') !!}"
                                                                {{ isset($companies) && !$company_id ? 'disabled' : '' }}>
                                                                <option value="">{!! __('contracts.select_customer') !!}</option>
                                                            </select>
                                                        </div>
                                                        @error('customer_id') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group @error('conclusion_date') is-invalid-premium @enderror">
                                                        <label for="conclusion_date" class="premium-label">{!! __('contracts.conclusion_date') !!} <span class="text-danger">*</span></label>
                                                        <input type="text" id="conclusion_date" wire:model="conclusion_date"
                                                            class="form-control premium-input shadow-none ptc-datepicker" autocomplete="off"
                                                            placeholder="YYYY-MM-DD" data-livewire-model="conclusion_date">
                                                        @error('conclusion_date') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group @error('start_date') is-invalid-premium @enderror">
                                                        <label for="start_date" class="premium-label">{!! __('contracts.start_date') !!} <span class="text-danger">*</span></label>
                                                        <input type="text" id="start_date" wire:model.live.debounce.500ms="start_date"
                                                            class="form-control premium-input shadow-none ptc-datepicker" autocomplete="off"
                                                            placeholder="YYYY-MM-DD" data-livewire-model="start_date">
                                                        @error('start_date') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group @error('end_date') is-invalid-premium @enderror">
                                                        <label for="end_date" class="premium-label">{!! __('contracts.end_date') !!} <span class="text-danger">*</span></label>
                                                        <input type="text" id="end_date" wire:model.live.debounce.500ms="end_date"
                                                            class="form-control premium-input shadow-none ptc-datepicker" autocomplete="off"
                                                            placeholder="YYYY-MM-DD" data-livewire-model="end_date">
                                                        @error('end_date') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group">
                                                        <label class="premium-label text-primary">{!! __('contracts.contract_duration_months') !!}</label>
                                                        <input type="text" wire:model="contract_duration_months"
                                                            class="form-control premium-input shadow-none font-weight-bold text-primary" style="background-color: #f8f9fa;" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group @error('rent_amount') is-invalid-premium @enderror">
                                                        <label for="rent_amount" class="premium-label">{!! __('contracts.rent_amount') !!} <span class="text-danger">*</span></label>
                                                        <div class="input-group premium-input-group">
                                                            <input type="number" step="0.01" id="rent_amount" wire:model.live.debounce.300ms="rent_amount"
                                                                class="form-control premium-input shadow-none border-right-0"
                                                                autocomplete="off" placeholder="0.00">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-white border-left-0 text-muted">{{ currency() }}</span>
                                                            </div>
                                                        </div>
                                                        @error('rent_amount') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group">
                                                        <label class="premium-label text-success">{!! __('contracts.total_rent_amount') !!}</label>
                                                        <div class="input-group premium-input-group">
                                                            <input type="text" wire:model="total_rent_amount"
                                                                class="form-control premium-input shadow-none font-weight-bold text-success border-right-0" style="background-color: #f8f9fa;" readonly>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-white border-left-0 text-success font-weight-bold">{{ currency() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group @error('payment_cycle') is-invalid-premium @enderror">
                                                        <label for="payment_cycle" class="premium-label">{!! __('contracts.payment_cycle') !!} <span class="text-danger">*</span></label>
                                                        <div wire:ignore>
                                                            <select id="payment_cycle" wire:model="payment_cycle" class="form-control premium-input shadow-none select2">
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                <option value="monthly">{!! __('contracts.payment_cycle_monthly') !!}</option>
                                                                <option value="quarterly">{!! __('contracts.payment_cycle_quarterly') !!}</option>
                                                                <option value="semi_annually">{!! __('contracts.payment_cycle_semi_annually') !!}</option>
                                                                <option value="yearly">{!! __('contracts.payment_cycle_yearly') !!}</option>
                                                            </select>
                                                        </div>
                                                        @error('payment_cycle') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <div class="premium-form-group @error('status') is-invalid-premium @enderror">
                                                        <label for="status" class="premium-label">{!! __('contracts.status') !!} <span class="text-danger">*</span></label>
                                                        <div wire:ignore>
                                                            <select id="status" wire:model="status" class="form-control premium-input shadow-none select2">
                                                                <option value="">{!! __('general.select_from_list') !!}</option>
                                                                <option value="active">{!! __('contracts.status_active') !!}</option>
                                                                <option value="ended">{!! __('contracts.status_ended') !!}</option>
                                                                <option value="cancelled">{!! __('contracts.status_cancelled') !!}</option>
                                                            </select>
                                                        </div>
                                                        @error('status') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="premium-mandatory-section mb-4">
                                                <div class="premium-mandatory-header">
                                                    <div class="title-wrapper">
                                                        <i class="fas fa-shield-alt"></i>
                                                        <span class="font-weight-bold">{!! __('contracts.deposit_details_title') !!}</span>
                                                    </div>
                                                </div>
                                                <div class="premium-mandatory-body">
                                                    <div class="row">
                                                        <div class="col-md-4 mb-2">
                                                            <div class="premium-form-group @error('deposit_amount') is-invalid-premium @enderror">
                                                                <label for="deposit_amount" class="premium-label">{!! __('contracts.deposit_amount') !!}</label>
                                                                <div class="input-group premium-input-group">
                                                                    <input type="number" step="0.01" id="deposit_amount" wire:model.live.debounce.300ms="deposit_amount"
                                                                        class="form-control premium-input shadow-none border-right-0" autocomplete="off" placeholder="0.00">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text bg-white border-left-0 text-muted">{{ currency() }}</span>
                                                                    </div>
                                                                </div>
                                                                @error('deposit_amount') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <div class="premium-form-group @error('deposit_type') is-invalid-premium @enderror {{ $deposit_amount <= 0 ? 'pointer-events-none opacity-50' : '' }}">
                                                                <label for="deposit_type" class="premium-label">{!! __('contracts.deposit_type') !!}</label>
                                                                <div>
                                                                    <select id="deposit_type" wire:model.live="deposit_type" class="form-control premium-input shadow-none">
                                                                        <option value="cash">{!! __('contracts.deposit_type_cash') !!}</option>
                                                                        <option value="cheque">{!! __('contracts.deposit_type_cheque') !!}</option>
                                                                    </select>
                                                                </div>
                                                                @error('deposit_type') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <div class="premium-form-group @error('deposit_status') is-invalid-premium @enderror {{ $deposit_type == 'cash' ? 'pointer-events-none opacity-50' : '' }}">
                                                                <label for="deposit_status" class="premium-label">{!! __('contracts.deposit_status') !!}</label>
                                                                <div>
                                                                    <select id="deposit_status" wire:model="deposit_status" class="form-control premium-input shadow-none">
                                                                        <option value="held">{!! __('contracts.deposit_status_held') !!}</option>
                                                                        <option value="returned">{!! __('contracts.deposit_status_returned') !!}</option>
                                                                        <option value="used">{!! __('contracts.deposit_status_used') !!}</option>
                                                                    </select>
                                                                </div>
                                                                @error('deposit_status') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Cheque Details Section -->
                                                    @if($deposit_type == 'cheque')
                                                    <div class="row cheque-details-section mt-1">
                                                        <div class="col-md-12 mt-2">
                                                            <div class="mandatory-sub-header">
                                                                <i class="fas fa-money-bill-wave"></i>
                                                                <h6>{!! __('cheques.cheque_details') !!} <small>({!! __('cheques.is_deposit') !!})</small></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <div class="premium-form-group @error('deposit_cheque_number') is-invalid-premium @enderror">
                                                                <label for="deposit_cheque_number" class="premium-label">{!! __('cheques.cheque_number') !!} <span class="text-danger">*</span></label>
                                                                <input type="text" id="deposit_cheque_number" wire:model="deposit_cheque_number"
                                                                    class="form-control premium-input shadow-none" autocomplete="off" placeholder="{!! __('cheques.cheque_number') !!}">
                                                                @error('deposit_cheque_number') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <div class="premium-form-group @error('deposit_issue_date') is-invalid-premium @enderror">
                                                                <label for="deposit_issue_date" class="premium-label">{!! __('cheques.issue_date') !!}</label>
                                                                <input type="text" id="deposit_issue_date" wire:model="deposit_issue_date" 
                                                                    class="form-control premium-input shadow-none ptc-datepicker" 
                                                                    autocomplete="off" placeholder="YYYY-MM-DD" data-livewire-model="deposit_issue_date"
                                                                    x-init="$( $el ).datepicker({ format: 'yyyy-mm-dd', autoclose: true, todayHighlight: true, language: '{{ app()->getLocale() }}', rtl: {{ app()->getLocale() == 'ar' ? 'true' : 'false' }} }).on('changeDate', function(e){ $wire.set('deposit_issue_date', $(e.target).val()); })">
                                                                @error('deposit_issue_date') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="premium-form-group @error('deposit_bank_name.ar') is-invalid-premium @enderror">
                                                                <label for="deposit_bank_name_ar" class="premium-label">{!! __('cheques.bank_name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                                                <input type="text" id="deposit_bank_name_ar" wire:model="deposit_bank_name.ar"
                                                                    class="form-control premium-input shadow-none" autocomplete="off" placeholder="{!! __('cheques.bank_name') !!} ({!! __('general.ar') !!})">
                                                                @error('deposit_bank_name.ar') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="premium-form-group @error('deposit_bank_name.en') is-invalid-premium @enderror">
                                                                <label for="deposit_bank_name_en" class="premium-label">{!! __('cheques.bank_name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                                                <input type="text" id="deposit_bank_name_en" wire:model="deposit_bank_name.en"
                                                                    class="form-control premium-input shadow-none" autocomplete="off" placeholder="{!! __('cheques.bank_name') !!} ({!! __('general.en') !!})">
                                                                @error('deposit_bank_name.en') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="premium-form-group @error('deposit_cheque_owner_name.ar') is-invalid-premium @enderror">
                                                                <label for="deposit_cheque_owner_name_ar" class="premium-label">{!! __('cheques.cheque_owner_name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                                                                <input type="text" id="deposit_cheque_owner_name_ar" wire:model="deposit_cheque_owner_name.ar"
                                                                    class="form-control premium-input shadow-none" autocomplete="off" placeholder="{!! __('cheques.cheque_owner_name') !!} ({!! __('general.ar') !!})">
                                                                @error('deposit_cheque_owner_name.ar') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-2">
                                                            <div class="premium-form-group @error('deposit_cheque_owner_name.en') is-invalid-premium @enderror">
                                                                <label for="deposit_cheque_owner_name_en" class="premium-label">{!! __('cheques.cheque_owner_name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                                                                <input type="text" id="deposit_cheque_owner_name_en" wire:model="deposit_cheque_owner_name.en"
                                                                    class="form-control premium-input shadow-none" autocomplete="off" placeholder="{!! __('cheques.cheque_owner_name') !!} ({!! __('general.en') !!})">
                                                                @error('deposit_cheque_owner_name.en') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div> <!-- end: form-body (basic) -->
                                    </div> <!-- end: tab-pane (basic) -->

                                    <!-- Tab 2: Parties & Property Details -->
                                    <div class="tab-pane fade" :class="{ 'show active': activeTab === 'parties-property' }" id="parties-property" wire:ignore.self>
                                        <div class="form-body">
                                            
                                            <!-- Party One -->
                                            <div class="premium-mandatory-section mb-4">
                                                <div class="premium-mandatory-header">
                                                    <div class="title-wrapper">
                                                        <i class="fas fa-building"></i>
                                                        <span class="font-weight-bold">{!! __('contracts.first_party_company') !!}</span>
                                                    </div>
                                                </div>
                                                <div class="premium-mandatory-body">
                                                    <p class="text-muted small mb-3"><i class="fas fa-info-circle"></i> {!! __('contracts.first_party_hint') !!}</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.first_party_name_ar') !!}</label>
                                                                <input type="text" wire:model="first_party_data.name.ar" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.first_party_name_en') !!}</label>
                                                                <input type="text" wire:model="first_party_data.name.en" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.first_party_owner_name') !!}</label>
                                                                <input type="text" wire:model="first_party_data.owner_name" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.first_party_owner_qid') !!}</label>
                                                                <input type="text" wire:model="first_party_data.owner_qid" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.first_party_owner_phone') !!}</label>
                                                                <input type="text" wire:model="first_party_data.owner_phone" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Party Two -->
                                            <div class="premium-mandatory-section mb-4">
                                                <div class="premium-mandatory-header">
                                                    <div class="title-wrapper">
                                                        <i class="fas fa-user"></i>
                                                        <span class="font-weight-bold">{!! __('contracts.second_party_customer') !!}</span>
                                                    </div>
                                                </div>
                                                <div class="premium-mandatory-body">
                                                    <p class="text-muted small mb-3"><i class="fas fa-info-circle"></i> {!! __('contracts.second_party_hint') !!}</p>
                                                    
                                                    <!-- Company specific fields for Tenant -->
                                                    @if(isset($second_party_data['company_name']) || (isset($second_party_data['tenant_type']) && $second_party_data['tenant_type'] === 'company'))
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('customers.customer_company_name') !!}</label>
                                                                <input type="text" wire:model="second_party_data.company_name" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('customers.cr_number') !!}</label>
                                                                <input type="text" wire:model="second_party_data.cr_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('customers.license_number') !!}</label>
                                                                <input type="text" wire:model="second_party_data.license_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('customers.establishment_number') !!}</label>
                                                                <input type="text" wire:model="second_party_data.establishment_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">
                                                                    @if(isset($second_party_data['company_name']) || (isset($second_party_data['tenant_type']) && $second_party_data['tenant_type'] === 'company'))
                                                                        {!! __('customers.representative_name_ar') !!}
                                                                    @else
                                                                        {!! __('contracts.second_party_name_ar') !!}
                                                                    @endif
                                                                </label>
                                                                <input type="text" wire:model="second_party_data.name.ar" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">
                                                                    @if(isset($second_party_data['company_name']) || (isset($second_party_data['tenant_type']) && $second_party_data['tenant_type'] === 'company'))
                                                                        {!! __('customers.representative_name_en') !!}
                                                                    @else
                                                                        {!! __('contracts.second_party_name_en') !!}
                                                                    @endif
                                                                </label>
                                                                <input type="text" wire:model="second_party_data.name.en" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.id_number') !!}</label>
                                                                <input type="text" wire:model="second_party_data.id_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.nationality') !!}</label>
                                                                <input type="text" wire:model="second_party_data.nationality" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.phone_number') !!}</label>
                                                                <input type="text" wire:model="second_party_data.phone" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Property Data -->
                                            <div class="premium-mandatory-section mb-4">
                                                <div class="premium-mandatory-header">
                                                    <div class="title-wrapper">
                                                        <i class="fas fa-home"></i>
                                                        <span class="font-weight-bold">{!! __('contracts.property_data') !!}</span>
                                                    </div>
                                                </div>
                                                <div class="premium-mandatory-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.zone_number') !!}</label>
                                                                <input type="text" wire:model="property_data.zone_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.street_number') !!}</label>
                                                                <input type="text" wire:model="property_data.street_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.building_number') !!}</label>
                                                                <input type="text" wire:model="property_data.building_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="premium-form-group">
                                                                <label class="premium-label">{!! __('contracts.title_deed_number') !!}</label>
                                                                <input type="text" wire:model="property_data.title_deed_number" class="form-control premium-input shadow-none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Tab 3: Utilities -->
                                    <div class="tab-pane fade" :class="{ 'show active': activeTab === 'utilities' }" id="utilities" wire:ignore.self>
                                        <div class="form-body">
                                            
                                            <div class="premium-mandatory-section mb-4">
                                                <div class="premium-mandatory-header">
                                                    <div class="title-wrapper">
                                                        <i class="fas fa-bolt"></i>
                                                        <span class="font-weight-bold">{!! __('contracts.utilities_numbers') !!}</span>
                                                    </div>
                                                </div>
                                                <div class="premium-mandatory-body">
                                                    <p class="text-muted small mb-3">
                                                        <i class="fas fa-info-circle mr-1"></i> {!! __('contracts.utilities_info_hint') !!}
                                                    </p>

                                                    @if(count($utilities_data) > 0)
                                                        @foreach($utilities_data as $index => $utility)
                                                            <div class="row utility-row {{ !$loop->last ? 'border-bottom pb-3 mb-3' : '' }}">
                                                                <div class="col-md-3">
                                                                    <div class="premium-form-group">
                                                                        <label class="premium-label">{!! __('contracts.unit_name') !!}</label>
                                                                        <input type="text" wire:model="utilities_data.{{ $index }}.name" class="form-control premium-input shadow-none" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="premium-form-group">
                                                                        <label class="premium-label">{!! __('contracts.electricity') !!}</label>
                                                                        <input type="text" wire:model="utilities_data.{{ $index }}.electricity_account_number" class="form-control premium-input shadow-none">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="premium-form-group">
                                                                        <label class="premium-label">{!! __('contracts.water') !!}</label>
                                                                        <input type="text" wire:model="utilities_data.{{ $index }}.water_account_number" class="form-control premium-input shadow-none">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="premium-form-group">
                                                                        <label class="premium-label">{!! __('contracts.unit_rent_amount') !!}</label>
                                                                        <input type="number" wire:model="utilities_data.{{ $index }}.unit_rent_amount" class="form-control premium-input shadow-none">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="premium-form-group">
                                                                        <label class="premium-label">{!! __('contracts.unit_deposit_amount') !!}</label>
                                                                        <div class="input-group">
                                                                            <input type="number" wire:model="utilities_data.{{ $index }}.unit_deposit_amount" class="form-control premium-input shadow-none">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-danger" type="button" wire:click="removeUtility({{ $index }})"><i class="fas fa-trash"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-warning">{!! __('contracts.no_utilities_data') !!}</div>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Tab 4: Contract Terms & Notes -->
                                    <div class="tab-pane fade" :class="{ 'show active': activeTab === 'terms' }" id="terms" wire:ignore.self>
                                        <div class="form-body">
                                            
                                            <!-- Old Inputs Hidden as requested -->
                                            <div class="d-none">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="contract_text" class="premium-label">{!! __('contracts.contract_text') !!}</label>
                                                            <textarea id="contract_text" wire:model="contract_text" class="form-control shadow-none" rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="premium-form-group">
                                                            <label for="notes" class="premium-label">{!! __('contracts.notes') !!}</label>
                                                            <textarea id="notes" wire:model="notes" class="form-control shadow-none" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="premium-form-group">
                                                        <label for="grace_period" class="premium-label">{!! __('contracts.grace_period') !!}</label>
                                                        <input type="text" id="grace_period" wire:model="grace_period" class="form-control shadow-none" placeholder="{!! __('contracts.grace_period_placeholder') !!}">
                                                        @error('grace_period') <span class="text-danger error-text">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                 <div class="col-md-12">
                                                     <div class="d-flex justify-content-between align-items-center mb-2">
                                                         <h5 class="text-primary font-weight-bold mb-0" style="font-size: 1.15rem;"><i class="fas fa-list-ol mr-1 text-primary"></i> {!! __('contracts.contract_clauses_builder_title') !!}</h5>
                                                         <button type="button" class="btn btn-sm btn-premium-add shadow-sm font-weight-bold px-3" data-toggle="modal" data-target="#clauseLibraryModal" style="height: 34px !important;">
                                                             <i class="fas fa-plus"></i> {!! __('contracts.add_clause_from_library') !!}
                                                         </button>
                                                     </div>
                                                     
                                                     @include('dashboard.contracts.partials._smart_tags_hint')
 
                                                     <div id="clauses-container" class="sortable-clauses mt-3">
                                                         @foreach($contract_clauses as $index => $clause)
                                                             <div class="card premium-card border-0 mb-3 clause-item shadow-sm" id="clause-{{ $index }}" style="border: 1px solid #e2e8f0 !important; border-radius: 8px !important; overflow: hidden; transition: all 0.2s ease;">
                                                                 <div class="card-header bg-light-blue-info d-flex justify-content-between align-items-center py-2 px-3" style="border-bottom: 1px solid #e2e8f0;">
                                                                     <div class="d-flex align-items-center w-100">
                                                                         <i class="fas fa-grip-vertical text-secondary cursor-move" style="font-size: 1.1rem; opacity: 0.5; margin-inline-end: 12px;"></i>
                                                                         <input type="text" wire:model="contract_clauses.{{ $index }}.title" 
                                                                                class="form-control form-control-sm font-weight-bold premium-input shadow-none bg-white" 
                                                                                style="font-size: 1rem; color: #1e293b; padding: 0.25rem 0.5rem;"
                                                                                placeholder="{!! __('contracts.clause_title_placeholder') !!}">
                                                                     </div>
                                                                     <div>
                                                                         <button type="button" class="btn-premium-action btn-premium-action-danger" wire:click="removeClause({{ $index }})" title="{!! __('contracts.confirm_delete_clause') !!}">
                                                                             <i class="fas fa-trash-alt"></i>
                                                                         </button>
                                                                     </div>
                                                                 </div>
                                                                 <div class="card-body p-3 bg-white">
                                                                     <div class="premium-input-wrapper no-icon">
                                                                         <textarea wire:model="contract_clauses.{{ $index }}.content" 
                                                                                   class="form-control premium-input shadow-none" rows="3" 
                                                                                   placeholder="{!! __('contracts.clause_content_placeholder') !!}"></textarea>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         @endforeach
                                                     </div>
                                                     
                                                     <button type="button" class="btn btn-sm btn-premium-add shadow-sm font-weight-bold mt-2 px-3" wire:click="addClause" style="height: 36px !important;">
                                                         <i class="fas fa-plus-circle"></i> {!! __('contracts.add_empty_custom_clause') !!}
                                                     </button>
                                                 </div>
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

    @include('dashboard.contracts.partials._clause_library_modal')


</div>
 @push('scripts')
    <script src="{{ asset('assets/dashbaord/js/generic-select2.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Re-init Select2 and Datepickers
            function initPlugins() {
                // Select2 Standard
                $('.select2').select2({
                    width: '100%',
                    dir: document.documentElement.getAttribute('data-textdirection') || 'ltr'
                }).on('change', function (e) {
                    let model = $(this).attr('wire:model') || $(this).attr('wire:model.live');
                    if(model) {
                        @this.set(model, $(this).val());
                    }
                });

                // Select2 Ajax (Property)
                $('#property_id.select2-ajax').select2({
                    width: '100%',
                    dir: document.documentElement.getAttribute('data-textdirection') || 'ltr',
                    ajax: {
                        url: $('#property_id.select2-ajax').data('url'),
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term,
                                company_id: @this.get('company_id'),
                                only_available: 1,
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.results,
                                pagination: { more: (params.page * 30) < data.total_count }
                            };
                        },
                        cache: true
                    },
                    placeholder: $('#property_id.select2-ajax').data('placeholder'),
                    minimumInputLength: 0,
                }).on('change', function(e) {
                    @this.set('property_id', $(this).val());
                });

                // Select2 Ajax (Customer)
                $('#customer_id.select2-ajax').select2({
                    width: '100%',
                    dir: document.documentElement.getAttribute('data-textdirection') || 'ltr',
                    ajax: {
                        url: $('#customer_id.select2-ajax').data('url'),
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term,
                                company_id: @this.get('company_id'),
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            return { results: data };
                        },
                        cache: true
                    },
                    placeholder: $('#customer_id.select2-ajax').data('placeholder'),
                    minimumInputLength: 0,
                }).on('change', function(e) {
                    @this.set('customer_id', $(this).val());
                });

                // Datepickers
                $('.ptc-datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                    language: '{{ app()->getLocale() }}',
                    rtl: {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                    orientation: "bottom auto"
                }).on('changeDate', function(e) {
                    let model = $(this).data('livewire-model');
                    if(model) {
                        @this.set(model, $(this).val());
                    }
                    
                    if($(this).attr('id') === 'start_date') {
                        $('#end_date').datepicker('setStartDate', e.date);
                    } else if($(this).attr('id') === 'end_date') {
                        $('#start_date').datepicker('setEndDate', e.date);
                    }
                });
            }

            initPlugins();

            Livewire.on('reinit-select2', () => {
                setTimeout(() => {
                    initPlugins();
                }, 100);
            });
        });
    </script>
    @endpush
