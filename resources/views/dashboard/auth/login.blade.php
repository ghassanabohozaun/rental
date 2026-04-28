@extends('layouts.dashboard.auth')

@section('title')
    {!! setting()->site_name !!} {!! __('auth.login') !!}
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/login.css') }}">
@endpush

@section('content')
    <div class="login-main-wrapper" dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}"
        data-textdirection="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">

        <!-- 1. Visual/Welcome Side (Hidden on Mobile) -->
        <div class="welcome-side">
            <div class="welcome-content-premium">
                <span class="badge-welcome">MJK-ALTHANI GROUP</span>
                <h1 class="welcome-title">
                    {!! Lang() == 'ar' ? 'التميز في الاستثمار' : 'Excellence in Investment' !!}
                </h1>
                <p class="welcome-text">
                    {!! Lang() == 'ar'
                        ? 'رؤية طموحة لمستقبل واعد. نحن نبني النجاح معاً من خلال الالتزام والابتكار.'
                        : 'An ambitious vision for a promising future. We build success together through commitment and innovation.' !!}
                </p>
                <div class="welcome-footer">
                    <div class="footer-stats">
                        <span class="stat-item"><i class="la la-briefcase"></i> MJK-ALTHANI Portal</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Form Side / Side Pane -->
        <div class="form-side">
            <!-- Language Toggle -->
            <div class="lang-toggle-container">
                @php
                    $currentLocale = Lang();
                    $targetLocale = $currentLocale == 'ar' ? 'en' : 'ar';
                    $targetNative = LaravelLocalization::getSupportedLocales()[$targetLocale]['native'];
                @endphp
                <a href="{{ LaravelLocalization::getLocalizedURL($targetLocale, null, [], true) }}" class="btn-lang-toggle">
                    <i class="la la-language"></i>
                    <span>{{ $targetNative }}</span>
                </a>
            </div>

            <div class="login-form-box">
                <!-- Brand logo -->
                <div class="brand-logo-modern">
                    @if (setting()->logo)
                        <img src="{!! asset('uploads/settings/' . setting()->logo) !!}" alt="{{ setting()->site_name }}">
                    @else
                        <img src="{{ asset('assets/dashbaord/images/mjk/logo.png') }}" alt="MJK-ALTHANI">
                    @endif
                </div>

                <div class="form-header-modern">
                    <h2>{!! __('auth.login') !!}</h2>
                    <p>{!! __('auth.login_dashboard') !!}</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4 py-3"
                        style="font-size: 0.82rem; border-radius: 12px; border: none; background: #ecfdf5; color: #065f46;">
                        <i class="la la-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-4 py-3"
                        style="font-size: 0.82rem; border-radius: 12px; border: none; background: #fff1f2; color: #be123c;">
                        <i class="la la-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{!! route('dashboard.post.login') !!}" method="post" class="modern-form" autocomplete="off">
                    @csrf

                    <!-- Email -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">{!! __('auth.enter_you_email') !!}</label>
                        <div class="input-container-modern">
                            <input type="text" class="form-control-modern @error('email') is-invalid @enderror"
                                name="email" id="email" placeholder="email@example.com" required autofocus
                                autocomplete="off">
                            <i class="la la-envelope input-icon-modern"></i>
                        </div>
                        @error('email')
                            <span
                                style="color: #e11d48; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">{!! __('auth.enter_you_password') !!}</label>
                        <div class="input-container-modern">
                            <input type="password" class="form-control-modern @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="••••••••" required autocomplete="new-password">
                            <i class="la la-lock input-icon-modern"></i>
                        </div>
                        @error('password')
                            <span
                                style="color: #e11d48; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="login-options-modern">
                        <label class="remember-modern">
                            <input type="checkbox" name="remmber" {{ old('remmber') ? 'checked' : '' }}>
                            <span>{!! __('auth.remmber_me') !!}</span>
                        </label>
                        <a href="{!! route('dashboard.password.get.email') !!}" class="forgot-modern">
                            {!! __('auth.forget_password') !!}
                        </a>
                    </div>

                    <button type="submit" class="btn-login-modern">
                        <span>{!! __('auth.login') !!}</span>
                        <i class="la la-arrow-{{ Config::get('app.locale') == 'ar' ? 'left' : 'right' }}"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
