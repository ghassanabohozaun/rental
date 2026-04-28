<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller implements HasMiddleware
{
    protected $authService;
    // __construct  dependency injection
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public static function middleware()
    {
        return [new Middleware(middleware: 'guest:web', except: ['logout', 'lockScreen', 'unlock'])];
    }

    // get login function
    public function getLogin()
    {
        return view('dashboard.auth.login');
    }

    // post login function
    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') ? true : false;

        $checkLogin = $this->authService->login($credentials, $remember, 'web');
        if (!$checkLogin) {
            flash()->error(__('general.login_failed'));
            return redirect()->back();
        } else {
            // Check if user is disabled
            if (Auth::guard('web')->user()->status != 1) {
                $this->authService->logout('web');
                flash()->error(__('general.account_disabled_contact_admin'));
                return redirect()->route('dashboard.get.login');
            }

            session(['is_locked' => false]); // Reset lock on login
            flash()->success(__('general.login_success'));

            // Retrieve intended URL
            $intended = session()->get('url.intended');

            // If intended is the lock screen, fall back to dashboard home
            if ($intended && str_contains($intended, 'lock-screen')) {
                return redirect()->route('dashboard.index');
            }

            return redirect()->intended(route('dashboard.index'));
        }
    }
    public function logout()
    {
        $this->authService->logout('web');
        session(['is_locked' => false]);
        return redirect()->route('dashboard.get.login');
    }

    // lock screen function
    public function lockScreen()
    {
        // Save where we came from if it's not the lock screen or login
        $previous = url()->previous();
        if (!session()->has('url.intended') && !str_contains($previous, 'lock-screen') && !str_contains($previous, 'login')) {
            session()->put('url.intended', $previous);
        }

        session()->put('is_locked', true);
        session()->save();
        return view('dashboard.auth.lock-screen');
    }

    // unlock screen function
    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if (Hash::check($request->password, Auth::guard('web')->user()->password)) {
            session()->forget('is_locked');

            // Retrieve intended URL and fallback to dashboard home
            $redirectUrl = session()->pull('url.intended', route('dashboard.index'));

            // Safety check: if for some reason the intended URL is still the lock screen, go to home
            if (str_contains($redirectUrl, 'lock-screen')) {
                $redirectUrl = route('dashboard.index');
            }

            session()->save();
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'redirect' => $redirectUrl
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => __('auth.failed')
        ], 422);
    }
}
