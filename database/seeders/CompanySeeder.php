<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::firstOrCreate(
            [
                'name->en' => 'Main Rental Company',
            ],
            [
                'name' => [
                    'en' => 'Main Rental Company',
                    'ar' => 'شركة الايجارات الرئيسية',
                ],
                'subscription_plan' => 'Basic',
                'status' => 'active',
                'email' => 'main-company@rental.com',
                'phone' => '01000000000',
            ],
        );

        Company::firstOrCreate(
            [
                'name->en' => 'AL Majed Rental Company',
            ],
            [
                'name' => [
                    'en' => 'AL Majed Rental Company',
                    'ar' => 'شركة المجد العقارية',
                ],
                'subscription_plan' => 'Premium',
                'status' => 'active',
                'email' => 'majed@rental.com',
                'phone' => '01111111111',
            ],
        );

        Company::firstOrCreate(
            [
                'name->en' => 'El Amal Rental Comany',
            ],
            [
                'name' => [
                    'en' => 'El Amal Rental Comany',
                    'ar' => 'شركة الامل العقارية',
                ],
                'subscription_plan' => 'Basic',
                'status' => 'active',
                'email' => 'amal@rental.com',
                'phone' => '02222222222',
            ],
        );
    }
}
