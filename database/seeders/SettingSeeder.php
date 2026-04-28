<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();

        Setting::firstOr(function () use ($company) {
            return Setting::create([
                'company_id' => $company->id,
                'site_name' => [
                    'en' => 'Rental',
                    'ar' => 'ايجار',
                ],
                'address' => [
                    'en' => '',
                    'ar' => '',
                ],
                'description' => [
                    'en' => '',
                    'ar' => '',
                ],
                'keywords' => [
                    'en' => '',
                    'ar' => '',
                ],
                'phone' => '',
                'mobile' => '',
                'whatsapp' => '',
                'email' => '',
                'email_support' => '',
                'facebook' => '',
                'twitter' => '',
                'instegram' => '',
                'youtube' => '',
                'logo' => '',
                'favicon' => '',
            ]);
        });
    }
}
