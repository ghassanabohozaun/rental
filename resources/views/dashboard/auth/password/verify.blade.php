@extends('layouts.dashboard.auth')

@section('title')
    {!! __('auth.confirm') !!}
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
                    <h1 class="login-title">{!! __('auth.verify_password') !!}</h1>
                    <p class="login-subtitle">{!! __('auth.reset_password_verification_code') !!}</p>
                </div>

                @if ($errors->has('error'))
                    <div class="alert-modern alert-danger-modern">
                        <i class="la la-exclamation-circle"></i>
                        <span>{!! $errors->first('error') !!}</span>
                    </div>
                @endif

                <form action="{!! route('dashboard.password.post.verify') !!}" method="post" class="modern-form" novalidate autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">{!! __('auth.you_email_address') !!}</label>
                        <div class="input-wrapper">
                            <input type="email" class="form-control-modern" id="email" name="email"
                                placeholder="email@example.com" autocomplete="off">
                            <i class="la la-envelope input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{!! __('auth.enter_reset_code') !!}</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control-modern @error('code') is-invalid @enderror"
                                id="code" name="code" placeholder="123456" required autofocus autocomplete="off">
                            <i class="la la-key input-icon"></i>
                        </div>
                        @error('code')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="login-btn">
                        <span>{!! __('auth.verify_password') !!}</span>
                        <i class="la la-shield-alt"></i>
                    </button>

                    <div style="text-align: center; margin-top: 24px;">
                        <a href="{!! route('dashboard.get.login') !!}" class="forgot-password">
                            {!! __('auth.login') !!}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
