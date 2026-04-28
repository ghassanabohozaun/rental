<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $mainCompany = Company::where('name->en', 'Main Rental Company')->first();
        $superRole = Role::where('name->en', 'Super User')->first();
        $adminRole = Role::where('name->en', 'Company Admin')->first();

        // 1. Super Admin
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => [
                    'en' => 'Super User',
                    'ar' => 'المستخدم الرئيسي',
                ],
                'password' => bcrypt('123456'),
                'company_id' => $mainCompany->id,
                'role_id' => $superRole->id,
                'status' => true,
            ]
        );

        // 2. Al Majed Admin
        $majedCompany = Company::where('name->en', 'AL Majed Rental Company')->first();
        if ($majedCompany) {
            User::firstOrCreate(
                ['email' => 'majed@admin.com'],
                [
                    'name' => [
                        'en' => 'Majed Admin',
                        'ar' => 'مدير شركة المجد',
                    ],
                    'password' => bcrypt('123456'),
                    'company_id' => $majedCompany->id,
                    'role_id' => $adminRole->id,
                    'status' => true,
                ]
            );
        }

        // 3. El Amal Admin
        $amalCompany = Company::where('name->en', 'El Amal Rental Comany')->first();
        if ($amalCompany) {
            User::firstOrCreate(
                ['email' => 'amal@admin.com'],
                [
                    'name' => [
                        'en' => 'Amal Admin',
                        'ar' => 'مدير شركة الامل',
                    ],
                    'password' => bcrypt('123456'),
                    'company_id' => $amalCompany->id,
                    'role_id' => $adminRole->id,
                    'status' => true,
                ]
            );
        }
    }
}
