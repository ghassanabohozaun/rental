<div class="badge badge-pill border-0 shadow-none px-2 py-1 font-weight-bold user_status_{!! $user->id !!} {!! $user->status == 1 ? 'badge-light-success' : 'badge-light-danger' !!}">
    {!! $user->status == 1 ? __('general.enable') : __('general.disabled') !!}
</div>


