<!-- Address -->
<div class="col-md-12 mb-1">
    <div class="premium-form-group">
        <label for="address_{{ $mode }}">{!! __('customers.address') !!} <span
                class="text-danger">*</span></label>
        <div class="premium-input-wrapper">
            <input type="text" class="form-control premium-input shadow-none"
                id="address_{{ $mode }}" name="address" placeholder="{!! __('customers.address') !!}"
                autocomplete="off">
            <i class="fas fa-map-marker-alt text-primary"></i>
        </div>
        <span class="error-text address_error text-danger small"></span>
    </div>
</div>

<!-- Notes -->
<div class="col-md-12 mb-1">
    <div class="premium-form-group">
        <label for="notes_{{ $mode }}">{!! __('customers.notes') !!}</label>
        <div class="premium-input-wrapper no-icon">
            <textarea class="form-control premium-input shadow-none" id="notes_{{ $mode }}" name="notes" rows="1"
                placeholder="{!! __('customers.notes') !!}"></textarea>
        </div>
        <span class="error-text notes_error text-danger small"></span>
    </div>
</div>


