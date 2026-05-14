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
                'auth_welcome_title' => [
                    'ar' => 'التميز في الاستثمار',
                    'en' => 'Excellence in Investment',
                ],
                'auth_welcome_desc' => [
                    'ar' => 'رؤية طموحة لمستقبل واعد. نحن نبني النجاح معاً من خلال الالتزام والابتكار.',
                    'en' => 'An ambitious vision for a promising future. We build success together through commitment and innovation.',
                ],
                'auth_welcome_badge' => [
                    'ar' => 'MJK-ALTHANI GROUP',
                    'en' => 'MJK-ALTHANI GROUP',
                ],
                'auth_welcome_footer' => [
                    'ar' => 'MJK-ALTHANI Portal',
                    'en' => 'MJK-ALTHANI Portal',
                ],
            ]);
        });
    }
}
