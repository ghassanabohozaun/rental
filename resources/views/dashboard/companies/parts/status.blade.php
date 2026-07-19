<div class="badge badge-pill border-0 shadow-none px-2 py-1 font-weight-bold company_status_{!! $company->id !!} {!! $company->status == 'active' ? 'badge-light-success' : 'badge-light-danger' !!}">
    {!! $company->status == 'active' ? __('general.enable') : __('general.disabled') !!}
</div>


