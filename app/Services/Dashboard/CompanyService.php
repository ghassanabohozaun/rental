<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CompanyRepository;
use App\Utils\ImageManagerUtils;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class CompanyService
{
    protected $repository, $imageManagerUtils;

    public function __construct(CompanyRepository $repository, ImageManagerUtils $imageManagerUtils)
    {
        $this->repository = $repository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function store(array $data)
    {
        if (isset($data['logo'])) {
            $data['logo'] = $this->imageManagerUtils->uploadSingleImage('', $data['logo'], 'companies');
        }
        
        $company = $this->repository->create($data);

        if ($company) {
            $this->syncCompanySettings($company);
        }

        return $company;
    }

    public function update($id, array $data)
    {
        $company = $this->repository->find($id);
        if (!$company) {
            return false;
        }

        if (isset($data['logo'])) {
            if ($company->logo) {
                $this->imageManagerUtils->removeImageFromLocal($company->logo, 'companies');
            }
            $data['logo'] = $this->imageManagerUtils->uploadSingleImage('', $data['logo'], 'companies');
        }

        $updatedCompany = $this->repository->update($id, $data);
        
        if ($updatedCompany) {
            $this->syncCompanySettings($updatedCompany);
        }

        return $updatedCompany;
    }

    /**
     * Synchronize company data with its settings.
     * Creates settings if they don't exist, or updates them if they do.
     */
    protected function syncCompanySettings($company)
    {
        $settingData = [
            'site_name' => $company->getTranslations('name'),
            'email'     => $company->email,
            'phone'     => $company->phone,
            'address'   => [
                'ar' => $company->address,
                'en' => $company->address,
            ],
        ];

        // Handle Logo Synchronization
        if ($company->logo) {
            $sourcePath = public_path('uploads/companies/' . $company->logo);
            $destPath = public_path('uploads/settings/' . $company->logo);
            
            if (File::exists($sourcePath)) {
                if (!File::isDirectory(public_path('uploads/settings'))) {
                    File::makeDirectory(public_path('uploads/settings'), 0755, true);
                }
                File::copy($sourcePath, $destPath);
                $settingData['logo'] = $company->logo;
                $settingData['favicon'] = $company->logo;
            }
        }

        // Use updateOrCreate to handle both new and existing companies
        return Setting::updateOrCreate(
            ['company_id' => $company->id],
            $settingData
        );
    }

    public function delete($id)
    {
        $company = $this->repository->find($id);
        if (!$company) {
            return false;
        }

        if ($company->logo) {
            $this->imageManagerUtils->removeImageFromLocal($company->logo, 'companies');
        }
        return $this->repository->delete($id);
    }

    public function updateStatus($id, $status)
    {
        $company = $this->repository->find($id);
        if (!$company) {
            return false;
        }

        $newStatus = ($status == 1) ? 'active' : 'inactive';
        return $this->repository->updateStatus($id, $newStatus);
    }

    public function autocomplete($searchValue)
    {
        return $this->repository->autocomplete($searchValue);
    }
}
