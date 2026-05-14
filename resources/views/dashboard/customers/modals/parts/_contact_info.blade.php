<!-- Phone -->
<div class="col-md-4 mb-1">
    <div class="premium-form-group">
        <label for="phone_{{ $mode }}">{!! __('customers.phone') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <input type="text" class="form-control premium-input shadow-none text-left"
                id="phone_{{ $mode }}" name="phone" placeholder="{!! __('customers.phone') !!}"
                dir="ltr" autocomplete="off">
            <i class="fas fa-phone text-primary"></i>
        </div>
        <span class="error-text phone_error text-danger small"></span>
    </div>
</div>

<!-- Email -->
<div class="col-md-4 mb-1">
    <div class="premium-form-group">
        <label for="email_{{ $mode }}">{!! __('customers.email') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <input type="email" class="form-control premium-input shadow-none text-left"
                id="email_{{ $mode }}" name="email" placeholder="{!! __('customers.email') !!}"
                dir="ltr" autocomplete="off">
            <i class="fas fa-envelope text-primary"></i>
        </div>
        <span class="error-text email_error text-danger small"></span>
    </div>
</div>

<!-- ID Number -->
<div class="col-md-4 mb-1">
    <div class="premium-form-group">
        <label for="id_number_{{ $mode }}">{!! __('customers.id_number') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <input type="text" class="form-control premium-input shadow-none"
                id="id_number_{{ $mode }}" name="id_number" placeholder="{!! __('customers.id_number') !!}"
                autocomplete="off">
            <i class="fas fa-credit-card text-primary"></i>
        </div>
        <span class="error-text id_number_error text-danger small"></span>
    </div>
</div>

<!-- Nationality -->
<div class="col-md-4 mb-1">
    <div class="premium-form-group">
        <label for="nationality_id_{{ $mode }}">{!! __('customers.nationality') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <i class="fas fa-flag text-primary" style="z-index: 10000 !important;"></i>
            <select class="form-control premium-input shadow-none js-select2"
                id='nationality_id_{{ $mode }}' name="nationality_id"
                data-placeholder="{!! __('general.select_from_list') !!}" data-parent="#{{ $mode }}Modal">
                <option value=""></option>
                @foreach ($nationalities as $nationality)
                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                @endforeach
            </select>
        </div>
        <span class="error-text nationality_id_error text-danger small"></span>
    </div>
</div>

<!-- Tenant Type -->
<div class="col-md-4 mb-1">
    <div class="premium-form-group">
        <label for="tenant_type_{{ $mode }}">{!! __('customers.tenant_type') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <i class="fas fa-tags text-primary" style="z-index: 10000 !important;"></i>
            <select class="form-control premium-input shadow-none js-select2"
                id='tenant_type_{{ $mode }}' name="tenant_type"
                data-placeholder="{!! __('general.select_from_list') !!}" data-parent="#{{ $mode }}Modal"
                required>
                <option value="individual">{!! __('customers.individual') !!}</option>
                <option value="company">{!! __('customers.company') !!}</option>
            </select>
        </div>
        <span class="error-text tenant_type_error text-danger small"></span>
    </div>
</div>

<!-- Guarantor -->
<div class="col-md-4 mb-1">
    <div class="premium-form-group">
        <label for="guarantor_id_{{ $mode }}">{!! __('customers.guarantor') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <i class="fas fa-shield-alt text-primary" style="z-index: 10000 !important;"></i>
            <select class="form-control premium-input shadow-none select2-autocomplete"
                id='guarantor_id_{{ $mode }}' name="guarantor_id"
                data-placeholder="{!! __('general.select_from_list') !!}"
                data-url="{!! route('dashboard.guarantors.autocomplete') !!}" data-simple="true"
                data-parent="#{{ $mode }}Modal" required>
                <option value=""></option>
            </select>
        </div>
        <span class="error-text guarantor_id_error text-danger small"></span>
    </div>
</div>


