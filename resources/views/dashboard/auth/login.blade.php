@extends('layouts.dashboard.auth')

@section('title')
    {!! __('auth.login') !!}
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
                    <p class="login-subtitle">{!! __('auth.login_dashboard') !!}</p>
                </div>

                @if (session('success'))
                    <div class="alert-modern alert-success-modern">
                        <i class="la la-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-modern alert-danger-modern">
                        <i class="la la-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{!! route('dashboard.post.login') !!}" method="post" class="modern-form" novalidate autocomplete="off">
                    @csrf

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label">{!! __('auth.enter_you_email') !!}</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control-modern @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="email@example.com" required autofocus
                                tabindex="1" autocomplete="off">
                            <i class="la la-user input-icon"></i>
                        </div>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label class="form-label">{!! __('auth.enter_you_password') !!}</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control-modern @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="••••••••" required tabindex="2"
                                autocomplete="new-password">
                            <i class="la la-lock input-icon"></i>
                        </div>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="login-options">
                        <label class="remember-me">
                            <input type="checkbox" id="remember-me" name="remmber" {{ old('remmber') ? 'checked' : '' }}>
                            <span>{!! __('auth.remmber_me') !!}</span>
                        </label>
                        <a href="{!! route('dashboard.password.get.email') !!}" class="forgot-password">
                            {!! __('auth.forget_password') !!}
                        </a>
                    </div>

                    <button type="submit" class="login-btn">
                        <span>{!! __('auth.login') !!}</span>
                        <i class="la la-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
