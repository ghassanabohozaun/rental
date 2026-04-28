<?php

namespace App\Services;

class TenantService
{
    protected ?int $currentCompanyId = null;

    protected bool $isSuperAdmin = false;

    /**
     * Set the current tenant (company) ID.
     *
     * @param int|null $companyId
     * @return void
     */
    public function setTenant(?int $companyId): void
    {
        $this->currentCompanyId = $companyId;
    }

    /**
     * Get the current tenant (company) ID.
     *
     * @return int|null
     */
    public function getTenantId(): ?int
    {
        return $this->currentCompanyId;
    }

    /**
     * Check if a tenant is currently set.
     *
     * @return bool
     */
    public function hasTenant(): bool
    {
        return $this->currentCompanyId !== null;
    }

    /**
     * Set the super admin status.
     *
     * @param bool $status
     * @return void
     */
    public function setSuperAdmin(bool $status): void
    {
        $this->isSuperAdmin = $status;
    }

    /**
     * Check if the current context is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->isSuperAdmin;
    }
}
