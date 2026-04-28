<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;

class SettingRepository
{
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Get settings for the specified company, or the current logged-in company.
     * If no settings exist, create a default record for them.
     */
    public function getSetting($companyId = null)
    {
        $id = $companyId ?: user()->company_id;

        return $this->model->where('company_id', $id)->firstOrCreate(
            ['company_id' => $id],
            ['site_name' => ['ar' => 'نظام التأجير', 'en' => 'Rental System']]
        );
    }

    /**
     * Update settings.
     */
    public function updateSettings($setting, $data)
    {
        return $setting->update($data);
    }
}
