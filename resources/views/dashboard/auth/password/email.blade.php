@extends('layouts.dashboard.auth')

@section('title')
    {!! __('auth.enter_email') !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/login-modern.css') }}">
@endpush

@section('content')
    <div class="login-page" dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}"
        data-textdirection="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">

        <!-- Language Toggle -->
        <div class="lang-toggle-wrapper">
            @php
                $currentLocale = Lang();
                $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
            @endphp
            <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}" class="enterprise-lang-toggle"
                id="login-rtl-toggle">
                <i class="la la-language" style="font-size: 1.2rem;"></i>
                <span>{{ $targetNative }}</span>
            </a>
        </div>

        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="login-logo">
                        @if (setting()->logo)
                            <img src="{!! asset('uploads/settings/' . setting()->logo) !!}" alt="{{ setting()->site_name }}">
                        @else
                            <h2 class="login-title" style="font-weight: bolder;">{!! setting()->site_name !!}</h2>
                        @endif
                    </div>
                    <h1 class="login-title">{!! __('auth.recover_password') !!}</h1>
                    <p class="login-subtitle">{!! __('auth.we_will_send_you_link_to_reset_password') !!}</p>
                </div>

                @if ($errors->has('error'))
                    <div class="alert-modern alert-danger-modern">
                        <i class="la la-exclamation-circle"></i>
                        <span>{!! $errors->first('error') !!}</span>
                    </div>
                @endif

                <form action="{!! route('dashboard.password.post.email') !!}" method="post" class="modern-form" novalidate autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">{!! __('auth.you_email_address') !!}</label>
                        <div class="input-wrapper">
                            <input type="email" class="form-control-modern @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="email@example.com" required autofocus
                                autocomplete="off">
                            <i class="la la-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="login-btn">
                        <span>{!! __('auth.recover_password') !!}</span>
                        <i class="la la-arrow-right"></i>
                    </button>

                    <div style="text-align: center; margin-top: 24px;">
                        <a href="{!! route('dashboard.get.login') !!}" class="forgot-password">
                            <i class="la la-arrow-left"></i> {!! __('auth.login') !!}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
