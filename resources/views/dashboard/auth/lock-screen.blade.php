@extends('layouts.dashboard.auth')

@section('title')
    {!! __('dashboard.lock_screen') !!}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashbaord/css/login-modern.css') }}">
    <style>
        .lock-avatar-wrapper {
            margin: 0 auto 1.5rem;
            width: fit-content;
            padding: 6px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .lock-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .lock-user-name {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .lock-status {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
    </style>
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
                    @php
                        $user = user();
                        $photoUrl = $user->userPhoto();
                        $colors = ['#5A8DEE', '#FDAC41', '#FF5B5C', '#39DA8A', '#00CFDD', '#7117EA', '#272727'];
                        $charIndex = abs(crc32($user->name)) % count($colors);
                        $bgColor = $colors[$charIndex];
                    @endphp

                    <div class="lock-avatar-wrapper"
                        style="width: 85px; height: 85px; padding: 4px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); margin-bottom: 1.2rem;">
                        @if ($photoUrl)
                            <img src="{!! $photoUrl !!}" alt="User Avatar" class="lock-avatar">
                        @else
                            <div class="lock-avatar d-flex align-items-center justify-content-center text-white font-weight-bold"
                                style="background-color: {!! $bgColor !!}; font-size: 32px; text-transform: uppercase;">
                                {!! $user->initials !!}
                            </div>
                        @endif
                    </div>

                    <h2 class="login-title" style="font-size: 22px; margin-bottom: 4px;">
                        {{ $user ? $user->getTranslation('name', Lang()) : 'Admin' }}</h2>
                    <div class="lock-status" style="margin-bottom: 1.5rem;">
                        <span class="status-indicator"></span>
                        <span style="font-size: 13px; color: var(--text-muted);">{!! __('dashboard.active_session') ?? 'Secured Session' !!}</span>
                    </div>
                </div>

                <form id="lock-form" action="{{ route('dashboard.unlock.screen') }}" method="POST" novalidate
                    autocomplete="off" class="modern-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">{!! __('auth.enter_you_password') !!}</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control-modern" id="lock-password" name="password"
                                placeholder="••••••••" required autofocus autocomplete="new-password">
                            <i class="la la-lock input-icon"></i>
                        </div>
                        <div id="lock-error" class="error-text mt-2 d-none"></div>
                    </div>

                    <button type="submit" id="unlock-btn" class="login-btn">
                        <span>{!! __('auth.unlock') !!}</span>
                        <i class="la la-key"></i>
                    </button>

                    <div class="login-footer" style="margin-top: 1.5rem; text-align: center;">
                        <a href="{{ route('dashboard.logout') }}" class="forgot-password" style="font-size: 13px;">
                            <i class="la la-user-friends"></i>
                            {!! __('auth.sign_in_different_account') !!}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        window.LockScreenData = {
            routes: {
                lock: "{{ route('dashboard.lock.screen') }}",
                unlock: "{{ route('dashboard.unlock.screen') }}",
                dashboard: "{{ route('dashboard.index') }}"
            },
            labels: {
                unlock: "{{ __('auth.unlock') }}",
                unlocking: "{{ __('auth.unlocking') ?? 'Unlocking...' }}"
            },
            messages: {
                failed: "{{ __('auth.failed') }}"
            }
        };
    </script>
    <script src="{{ asset('assets/dashbaord/js/lock-screen-modern.js') }}"></script>
@endpush
