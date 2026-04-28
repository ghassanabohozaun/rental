<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SettingRepository;
use App\Utils\ImageManagerUtils;

class SettingService
{
    protected $settingRepository, $imageManagerUtils;

    public function __construct(SettingRepository $settingRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->settingRepository = $settingRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    /**
     * Get settings for the current company or a specific company.
     */
    public function getSetting($companyId = null)
    {
        return $this->settingRepository->getSetting($companyId);
    }

    /**
     * Update settings.
     */
    public function updateSettings($data)
    {
        $setting = $this->getSetting();

        if (isset($data['logo']) && $data['logo'] != null) {
            if ($setting->logo) {
                $this->imageManagerUtils->removeImageFromLocal($setting->logo, 'settings');
            }
            $data['logo'] = $this->imageManagerUtils->saveResizeImage($data['logo'], 'settings', 500, 500);
        }

        if (isset($data['favicon']) && $data['favicon'] != null) {
            if ($setting->favicon) {
                $this->imageManagerUtils->removeImageFromLocal($setting->favicon, 'settings');
            }
            $data['favicon'] = $this->imageManagerUtils->saveResizeImage($data['favicon'], 'settings', 500, 500);
        }

        return $this->settingRepository->updateSettings($setting, $data);
    }
}
