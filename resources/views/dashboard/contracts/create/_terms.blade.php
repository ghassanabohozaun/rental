
<div class="row">
    <div class="col-md-12">
        <div class="premium-form-group">
            <label for="contract_text" class="premium-label">{!! __('contracts.contract_text') !!}</label>
            <textarea id="contract_text" name="contract_text" class="form-control shadow-none summernote" rows="10" placeholder="{!! __('contracts.enter_contract_text') !!}">{!! old('contract_text') !!}</textarea>
            <span class="text-danger error-text contract_text_error"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="premium-form-group">
            <label for="notes" class="premium-label">{!! __('contracts.notes') !!}</label>
            <textarea id="notes" name="notes" class="form-control shadow-none" rows="3" placeholder="{!! __('contracts.enter_notes') !!}">{!! old('notes') !!}</textarea>
            <span class="text-danger error-text notes_error"></span>
        </div>
    </div>
</div>


