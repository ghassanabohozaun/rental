@can('departments_update')
<div class="premium-switch-centered-wrapper">
    <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
        <input type="checkbox" class="custom-control-input change_status" id="status_{!! $department->id !!}" data-id="{!! $department->id !!}"
            {!! $department->status == 1 ? 'checked' : '' !!}>
        <label class="custom-control-label" for="status_{!! $department->id !!}"></label>
    </div>
</div>
@endcan
