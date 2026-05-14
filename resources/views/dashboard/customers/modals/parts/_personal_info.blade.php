<!-- Company -->
@if (user()->company_id == 1)
    <div class="col-md-12 mb-1">
        <div class="premium-form-group">
            <label for="company_id_{{ $mode }}">{!! __('companies.company') !!} <span class="text-danger">*</span></label>
            <div class="premium-input-wrapper">
                <select class="form-control premium-input shadow-none" id='company_id_{{ $mode }}'
                    name="company_id">
                    <option value="">{!! __('general.select_from_list') !!}</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                <i class="fas fa-briefcase text-primary"></i>
            </div>
            <span class="error-text company_id_error text-danger small"></span>
        </div>
    </div>
@endif

<!-- Name AR -->
<div class="col-md-6 mb-1">
    <div class="premium-form-group">
        <label for="name_ar_{{ $mode }}">{!! __('customers.name_ar') !!} <span class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <input type="text" class="form-control premium-input shadow-none" id="name_ar_{{ $mode }}"
                name="name[ar]" placeholder="{!! __('customers.name_ar') !!}" autocomplete="off">
            <i class="fas fa-user text-primary"></i>
        </div>
        <span class="error-text name_ar_error text-danger small"></span>
    </div>
</div>

<!-- Name EN -->
<div class="col-md-6 mb-1">
    <div class="premium-form-group">
        <label for="name_en_{{ $mode }}">{!! __('customers.name_en') !!} <span class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <input type="text" class="form-control premium-input shadow-none" id="name_en_{{ $mode }}"
                name="name[en]" placeholder="{!! __('customers.name_en') !!}" autocomplete="off">
            <i class="fas fa-user text-primary"></i>
        </div>
        <span class="error-text name_en_error text-danger small"></span>
    </div>
</div>
