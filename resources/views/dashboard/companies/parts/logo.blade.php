@php
    $size = $size ?? 45;
    $logoUrl = $company->logo_url;
@endphp

@if ($logoUrl)
    <div class="premium-avatar-wrapper mx-auto" style="width: {!! $size !!}px; height: {!! $size !!}px;">
        <img src="{!! $logoUrl !!}" alt="{!! $company->name !!}" class="premium-avatar shadow-sm" style="width:100%; height:100%; border-radius: 8px; object-fit: cover;">
    </div>
@else
    <div class="avatar-circle avatar-size-{!! $size !!} d-inline-flex align-items-center justify-content-center text-white shadow-sm"
         style="background-color: {!! $company->getAvatarColor() !!}; width: {!! $size !!}px; height: {!! $size !!}px; border-radius: 8px; font-weight: bold; font-size: {!! $size / 2.5 !!}px;">
        {!! $company->initials !!}
    </div>
@endif
