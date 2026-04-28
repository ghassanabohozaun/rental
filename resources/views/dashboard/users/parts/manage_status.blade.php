<div class="premium-switch-centered-wrapper">
    <div class="custom-control custom-switch custom-control-primary premium-switch-centered">
        <input type="checkbox" class="custom-control-input change_status" id="customSwitch_{{ $user->id }}" {{ $user->status == 1 ? 'checked' : '' }} data-id="{{ $user->id }}" />
        <label class="custom-control-label" for="customSwitch_{{ $user->id }}"></label>
    </div>
</div>
