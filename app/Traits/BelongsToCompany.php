<?php

namespace App\Traits;

use App\Scopes\CompanyScope;
use App\Services\TenantService;
use Exception;

trait BelongsToCompany
{
    /**
     * Boot the BelongsToCompany trait for a model.
     *
     * @return void
     */
    protected static function bootBelongsToCompany()
    {
        // 1. Apply the isolation scope automatically
        static::addGlobalScope(new CompanyScope);

        // 2. Automatically inject company_id on creation
        static::creating(function ($model) {
            $tenantService = app(TenantService::class);

            // If it's a super admin, we don't auto-inject. They must specify it or it stays null (global).
            if ($tenantService->isSuperAdmin()) {
                return;
            }

            // For regular users, inject their company ID if not provided
            if (empty($model->company_id) && $tenantService->hasTenant()) {
                $model->company_id = $tenantService->getTenantId();
            } else {
                // To ensure bulletproof multi-tenancy, if a company_id is required 
                // but no tenant is active, we should throw an exception (unless it's explicitly allowed).
                // If a model is created by super admin and company_id is manually provided, use that.
                if (empty($model->company_id) && !app()->runningInConsole() && !\App::environment('testing')) {
                   // Uncomment this for strict mode if you want to force error when tenant is missing:
                   // throw new Exception('Cannot create a tenant-aware record without an active company context.');
                }
            }
        });
    }

    /**
     * Define the relationship to the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
