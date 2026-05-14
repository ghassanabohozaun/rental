@can('companies_update')
<div class="premium-switch-centered-wrapper">
    <label class="modern-switch">
        <input type="checkbox" class="change_status" id="status_{!! $company->id !!}" data-id="{!! $company->id !!}"
            {!! $company->status == 'active' ? 'checked' : '' !!}>
        <span class="modern-slider"></span>
    </label>
</div>
@endcan


