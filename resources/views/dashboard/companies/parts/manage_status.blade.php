@can('companies_update')
<div class="premium-switch-centered-wrapper">
    <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
        <input type="checkbox" class="custom-control-input change_status" id="status_{!! $company->id !!}" data-id="{!! $company->id !!}"
            {!! $company->status == 'active' ? 'checked' : '' !!}>
        <label class="custom-control-label" for="status_{!! $company->id !!}"></label>
    </div>
</div>
@endcan
