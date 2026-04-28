@extends('layouts.employees.auth')

@section('title')
    {!! __('auth.login') !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/employees/css/login-modern.css') }}?v=branded">
@endpush

@section('content')
    <div class="login-main-wrapper" dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}"
        data-textdirection="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">

        <!-- 1. Visual/Welcome Side (Hidden on Mobile) -->
        <div class="welcome-side">
            <div class="welcome-content-premium">
                <span class="badge-welcome">Employee Portal</span>
                <h1 class="welcome-title">
                    {!! Lang() == 'ar' ? 'تمكين رسالتنا' : 'Empowering Our Mission' !!}
                </h1>
                <p class="welcome-text">
                    {!! Lang() == 'ar' 
                        ? 'كل خطوة تقوم بها تقربنا من مستقبل أفضل. نحن فخورون بعضويتك في فريقنا المتميز.' 
                        : 'Every step you take brings us closer to a better future. We are proud to have you in our distinguished team.' !!}
                </p>
                <div class="welcome-footer">
                    <div class="footer-stats">
                        <span class="stat-item"><i class="fa fa-users"></i> PTC Community</span>
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
                    <i class="fa fa-language"></i>
                    <span>{{ $targetNative }}</span>
                </a>
            </div>

            <div class="login-form-box">
                <!-- Brand logo -->
                <div class="brand-logo-modern">
                    @if (setting()->logo)
                        <img src="{!! asset('uploads/settings/' . setting()->logo) !!}" alt="{{ setting()->site_name }}">
                    @else
                        <h2 style="color: var(--primary); font-weight: 900;">{!! setting()->site_name !!}</h2>
                    @endif
                </div>

                <div class="form-header-modern">
                    <h2>{!! __('auth.login') !!}</h2>
                    <p>{!! __('auth.sign_in_to_continue') !!}</p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger mb-4 py-3"
                        style="font-size: 0.82rem; border-radius: 12px; border: none; background: #fff1f2; color: #be123c;">
                        <i class="fa fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{!! route('employees.post.login') !!}" method="post" class="modern-form" autocomplete="off">
                    @csrf

                    <!-- Username -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">{!! __('auth.personal_id') !!}</label>
                        <div class="input-container-modern">
                            <input type="text" class="form-control-modern @error('personal_id') is-invalid @enderror"
                                name="personal_id" id="personal_id" placeholder="{!! __('auth.personal_id') !!}" required autofocus
                                autocomplete="off">
                            <i class="fa fa-user-o input-icon-modern"></i>
                        </div>
                        @error('personal_id')
                            <span
                                style="color: #e11d48; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group-modern">
                        <label class="form-label-modern">{!! __('auth.password') !!}</label>
                        <div class="input-container-modern">
                            <input type="password" class="form-control-modern @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="••••••••" required autocomplete="new-password">
                            <i class="fa fa-lock input-icon-modern"></i>
                        </div>
                        @error('password')
                            <span
                                style="color: #e11d48; font-size: 0.75rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="login-options-modern">
                        <label class="remember-modern">
                            <input type="checkbox" name="remember">
                            <span>{!! __('auth.remmber_me') !!}</span>
                        </label>
                        {{-- <a href="javascript:void(0)" class="forgot-modern">{!! __('auth.forget_password') !!}</a> --}}
                    </div>

                    <button type="submit" class="btn-login-modern">
                        <span>{!! __('auth.login') !!}</span>
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
