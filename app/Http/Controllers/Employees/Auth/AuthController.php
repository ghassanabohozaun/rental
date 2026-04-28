<?php

namespace App\Http\Controllers\Employees\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Services\Dashboard\EmployeeService;
use App\Services\Employees\Auth\AuthService;

class AuthController extends Controller implements HasMiddleware
{
    protected $employeeService ,  $authService;
    // __construct
    public function __construct(EmployeeService $employeeService ,AuthService $authService)
    {
        $this->employeeService = $employeeService;
        $this->authService = $authService;
    }

    // middleware
    public static function middleware()
    {
        return [new Middleware(middleware: 'guest:employee', except: ['logout'])];
    }

    //get login
    public function getLogin()
    {
        $title = __('auth.login');
        return view('employees.auth.login', compact('title'));
    }

    // post login
    public function postLogin(LoginRequest $request)
    {
        $credinatioals = $request->only(['personal_id', 'password']);
        $remmber = $request->has('remmber') ? true : false;

        $checkLogin = $this->authService->login($credinatioals, $remmber, 'employee');

        if (!$checkLogin) {
            flash()->error(__('general.login_faild'));
            return redirect()->back();
        } else {
            $employeeID = employee()->user()->id;

            $employee = $this->employeeService->getOne($employeeID);
            if (!$employee) {
                flash()->error(__('general.no_record_found'));
                return redirect()->back();
            }

            flash()->success(__('general.login_success'));
            return redirect()->route('employees.overview');
        }
    }

    // logout
    public function logout()
    {
        $this->authService->logout('employee');
        return redirect()->route('employees.get.login');
    }
}
