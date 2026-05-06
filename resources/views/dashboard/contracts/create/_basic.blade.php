@if (isset($companies))
    <div class="row mb-1 mt-n2">
        <div class="col-md-12">
            <div class="premium-form-group" style="margin-bottom: 0.5rem !important;">
                <label for="company_id" class="premium-label">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
                <div class="premium-input-wrapper">
                    <select id="company_id" name="company_id" class="form-control premium-input shadow-none select2">
                        <option value="">{!! __('general.select_company') !!}</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-briefcase text-primary"></i>
                </div>
                <span class="text text-danger small mt-1 d-block error-text company_id_error"></span>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="premium-form-group">
            <label for="property_id" class="premium-label">{!! __('contracts.property') !!} <small class="text-muted">({!! __('properties.available_properties') !!})</small> <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <select id="property_id" name="property_id" class="form-control premium-input shadow-none select2-ajax" data-url="{!! route('dashboard.properties.autocomplete') !!}" data-placeholder="{!! __('contracts.select_property') !!}" {{ isset($companies) ? 'disabled' : '' }}>
                    <option value="">{!! __('contracts.select_property') !!}</option>
                </select>
                <i class="fas fa-building text-primary"></i>
            </div>
            <span class="text text-danger small mt-1 d-block error-text property_id_error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="premium-form-group">
            <label for="customer_id" class="premium-label">{!! __('contracts.customer') !!} <small class="text-muted">({!! __('contracts.available_customers_hint') !!})</small> <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <select id="customer_id" name="customer_id" class="form-control premium-input shadow-none select2-ajax" data-url="{!! route('dashboard.customers.autocomplete') !!}" data-placeholder="{!! __('contracts.select_customer') !!}" {{ isset($companies) ? 'disabled' : '' }}>
                    <option value="">{!! __('contracts.select_customer') !!}</option>
                </select>
                <i class="fas fa-user text-primary"></i>
            </div>
            <span class="text text-danger small mt-1 d-block error-text customer_id_error"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="premium-form-group">
            <label for="start_date" class="premium-label">{!! __('contracts.start_date') !!} <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <input type="text" id="start_date" name="start_date" value="{!! old('start_date') !!}" class="form-control premium-input shadow-none ptc-datepicker" autocomplete="off" placeholder="YYYY-MM-DD">
                <i class="fas fa-calendar-alt text-primary"></i>
            </div>
            <span class="text text-danger small mt-1 d-block error-text start_date_error"></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="premium-form-group">
            <label for="end_date" class="premium-label">{!! __('contracts.end_date') !!} <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <input type="text" id="end_date" name="end_date" value="{!! old('end_date') !!}" class="form-control premium-input shadow-none ptc-datepicker" autocomplete="off" placeholder="YYYY-MM-DD">
                <i class="fas fa-calendar-times text-primary"></i>
            </div>
            <span class="text text-danger small mt-1 d-block error-text end_date_error"></span>
        </div>
    </div>
    <div class="col-md-2">
        <div class="premium-form-group">
            <label for="rent_amount" class="premium-label">{!! __('contracts.rent_amount') !!} <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <input type="number" step="0.01" id="rent_amount" name="rent_amount" value="{!! old('rent_amount') !!}" class="form-control premium-input shadow-none" autocomplete="off" placeholder="0.00">
                <i class="fas fa-money-bill-wave text-primary"></i>
            </div>
            <span class="text text-danger small mt-1 d-block error-text rent_amount_error"></span>
        </div>
    </div>
    <div class="col-md-2">
        <div class="premium-form-group">
            <label for="payment_cycle" class="premium-label">{!! __('contracts.payment_cycle') !!} <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <i class="fas fa-sync text-primary z-index-high"></i>
                <select id="payment_cycle" name="payment_cycle" class="form-control premium-input shadow-none select2">
                    <option value="monthly">{!! __('contracts.payment_cycle_monthly') !!}</option>
                    <option value="yearly">{!! __('contracts.payment_cycle_yearly') !!}</option>
                </select>
            </div>
            <span class="text text-danger small mt-1 d-block error-text payment_cycle_error"></span>
        </div>
    </div>
    <div class="col-md-2">
        <div class="premium-form-group">
            <label for="status" class="premium-label">{!! __('contracts.status') !!} <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <i class="fas fa-check-circle text-primary z-index-high"></i>
                <select id="status" name="status" class="form-control premium-input shadow-none select2">
                    <option value="active">{!! __('contracts.status_active') !!}</option>
                    <option value="ended">{!! __('contracts.status_ended') !!}</option>
                    <option value="cancelled">{!! __('contracts.status_cancelled') !!}</option>
                </select>
            </div>
            <span class="text text-danger small mt-1 d-block error-text status_error"></span>
        </div>
    </div>
</div>

<div class="premium-mandatory-section mb-4">
    <div class="premium-mandatory-header">
        <i class="fas fa-shield-alt mr-1"></i>
        {!! __('contracts.deposit_details_title') !!}
    </div>
    <div class="premium-mandatory-body">
        <div class="row">
            <div class="col-md-4">
                <div class="premium-form-group">
                    <label for="deposit_amount" class="premium-label">
                        {!! __('contracts.deposit_amount') !!}
                    </label>
                    <div class="premium-input-wrapper">
                        <input type="number" step="0.01" id="deposit_amount" name="deposit_amount" value="{!! old('deposit_amount', 0) !!}" class="form-control premium-input shadow-none" autocomplete="off" placeholder="0.00">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_amount_error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-form-group">
                    <label for="deposit_type" class="premium-label">
                        {!! __('contracts.deposit_type') !!}
                    </label>
                    <div class="premium-input-wrapper">
                        <i class="fas fa-money-bill-wave text-primary z-index-high"></i>
                        <select id="deposit_type" name="deposit_type" class="form-control premium-input shadow-none select2">
                            <option value="cash">{!! __('contracts.deposit_type_cash') !!}</option>
                            <option value="cheque">{!! __('contracts.deposit_type_cheque') !!}</option>
                        </select>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_type_error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="premium-form-group">
                    <label for="deposit_status" class="premium-label">
                        {!! __('contracts.deposit_status') !!}
                    </label>
                    <div class="premium-input-wrapper">
                        <i class="fas fa-shield-alt text-primary z-index-high"></i>
                        <select id="deposit_status" name="deposit_status" class="form-control premium-input shadow-none select2">
                            <option value="held">{!! __('contracts.deposit_status_held') !!}</option>
                            <option value="returned">{!! __('contracts.deposit_status_returned') !!}</option>
                            <option value="used">{!! __('contracts.deposit_status_used') !!}</option>
                        </select>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_status_error"></span>
                </div>
            </div>
        </div>
        
        <!-- Cheque Details Section (Hidden by default) -->
        <div class="row cheque-details-section mt-3 cheque-details-section-box" style="display: none;">
            <div class="col-md-12">
                <h6 class="text-primary mb-2"><i class="fas fa-money-bill-wave"></i> {!! __('cheques.cheque_details') !!} <small class="text-muted">({!! __('cheques.is_deposit') !!})</small></h6>
            </div>
            <div class="col-md-6">
                <div class="premium-form-group">
                    <label for="deposit_cheque_number" class="premium-label">{!! __('cheques.cheque_number') !!} <span class="text-danger">*</span></label>
                    <div class="premium-input-wrapper">
                        <input type="text" id="deposit_cheque_number" name="deposit_cheque_number" value="{!! old('deposit_cheque_number') !!}" class="form-control premium-input shadow-none" placeholder="{!! __('cheques.cheque_number') !!}">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_cheque_number_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="premium-form-group">
                    <label for="deposit_issue_date" class="premium-label">{!! __('cheques.issue_date') !!} <span class="text-danger">*</span></label>
                    <div class="premium-input-wrapper">
                        <input type="text" id="deposit_issue_date" name="deposit_issue_date" value="{!! old('deposit_issue_date') !!}" class="form-control premium-input shadow-none ptc-datepicker" placeholder="YYYY-MM-DD" autocomplete="off">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_issue_date_error"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="deposit_bank_name_ar" class="premium-label">{!! __('cheques.bank_name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                    <div class="premium-input-wrapper">
                        <input type="text" id="deposit_bank_name_ar" name="deposit_bank_name[ar]" value="{!! old('deposit_bank_name.ar') !!}" class="form-control premium-input shadow-none" placeholder="{!! __('cheques.bank_name') !!} ({!! __('general.ar') !!})">
                        <i class="fas fa-university"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_bank_name_ar_error"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="deposit_bank_name_en" class="premium-label">{!! __('cheques.bank_name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                    <div class="premium-input-wrapper">
                        <input type="text" id="deposit_bank_name_en" name="deposit_bank_name[en]" value="{!! old('deposit_bank_name.en') !!}" class="form-control premium-input shadow-none" placeholder="{!! __('cheques.bank_name') !!} ({!! __('general.en') !!})">
                        <i class="fas fa-university"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_bank_name_en_error"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="deposit_cheque_owner_name_ar" class="premium-label">{!! __('cheques.cheque_owner_name') !!} ({!! __('general.ar') !!}) <span class="text-danger">*</span></label>
                    <div class="premium-input-wrapper">
                        <input type="text" id="deposit_cheque_owner_name_ar" name="deposit_cheque_owner_name[ar]" value="{!! old('deposit_cheque_owner_name.ar') !!}" class="form-control premium-input shadow-none" placeholder="{!! __('cheques.cheque_owner_name') !!} ({!! __('general.ar') !!})">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_cheque_owner_name_ar_error"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="premium-form-group">
                    <label for="deposit_cheque_owner_name_en" class="premium-label">{!! __('cheques.cheque_owner_name') !!} ({!! __('general.en') !!}) <span class="text-danger">*</span></label>
                    <div class="premium-input-wrapper">
                        <input type="text" id="deposit_cheque_owner_name_en" name="deposit_cheque_owner_name[en]" value="{!! old('deposit_cheque_owner_name.en') !!}" class="form-control premium-input shadow-none" placeholder="{!! __('cheques.cheque_owner_name') !!} ({!! __('general.en') !!})">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="text text-danger small mt-1 d-block error-text deposit_cheque_owner_name_en_error"></span>
                </div>
            </div>
        </div>
    </div>
</div>
