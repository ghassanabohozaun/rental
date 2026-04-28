<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\TenantService;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $tenantService = app(TenantService::class);

            // 1. Handle Super Admin (id=1 or role_id=1)
            if ($user->id === 1 || $user->role_id === 1) {
                $tenantService->setSuperAdmin(true);
            }

            // 2. Set the tenant ID if available
            if ($user->company_id) {
                $tenantService->setTenant($user->company_id);
            }
        }

        return $next($request);
    }
}
