@extends('layouts.dashboard.auth')

@section('title')
    {!! __('auth.reset_password') !!}
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
                    <h1 class="login-title">{!! __('auth.reset_password') !!}</h1>
                    <p class="login-subtitle">{!! __('auth.login_dashboard') !!}</p>
                </div>

                @if (session('error'))
                    <div class="alert-modern alert-danger-modern">
                        <i class="la la-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{!! route('dashboard.password.post.reset') !!}" method="post" class="modern-form" novalidate autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">{!! __('auth.you_email_address') !!}</label>
                        <div class="input-wrapper">
                            <input type="email" class="form-control-modern @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="email@example.com" required autocomplete="off">
                            <i class="la la-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{!! __('auth.enter_password') !!}</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control-modern @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                            <i class="la la-lock input-icon"></i>
                        </div>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{!! __('auth.enter_confirm_password') !!}</label>
                        <div class="input-wrapper">
                            <input type="password"
                                class="form-control-modern @error('confirm_password') is-invalid @enderror"
                                id="confirm_password" name="confirm_password" placeholder="••••••••" required
                                autocomplete="new-password">
                            <i class="la la-check-double input-icon"></i>
                        </div>
                        @error('confirm_password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="login-btn">
                        <span>{!! __('auth.reset_password') !!}</span>
                        <i class="la la-key"></i>
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
