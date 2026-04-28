<?php
namespace App\Services\Employees\Auth;

 use App\Repositories\Employees\Auth\AuthRepository;

class AuthService
{
    protected $authRepository;

    // __construct
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    // login
    public function login($credinatioals, $remmber, $gaurd)
    {

        $checkLogin = $this->authRepository->login($credinatioals, $remmber, $gaurd);
        if (!$checkLogin) {
            return false;
        }
        return true;
    }

    // logout
    public function logout($gaurd)
    {
        return $this->authRepository->logout($gaurd);
    }
}
