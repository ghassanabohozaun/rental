<div class="badge badge-pill badge-glow premium-status-badge company_status_{!! $company->id !!} {!! $company->status == 'active' ? 'badge-success' : 'badge-danger' !!}">
    {!! $company->status == 'active' ? __('general.enable') : __('general.disabled') !!}
</div>
