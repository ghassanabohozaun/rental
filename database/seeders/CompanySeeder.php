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
                'name->en' => 'Ghassan Rental Company',
            ],
            [
                'name' => [
                    'en' => 'Ghassan Rental Company',
                    'ar' => 'شركة غسان العقارية',
                ],
                'subscription_plan' => 'Premium',
                'status' => 'active',
                'email' => 'ghassan@rental.com',
                'phone' => '0590000000',
            ],
        );
    }
}
