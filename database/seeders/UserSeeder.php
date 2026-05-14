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
        $superRole = Role::where('name->en', 'Super User')->first();
        $adminRole = Role::where('name->en', 'Company Manager')->first();

        // 1. Super Admin
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => [
                    'en' => 'Super User',
                    'ar' => 'المستخدم الرئيسي',
                ],
                'password' => bcrypt('123456'),
                'company_id' => 1,
                'role_id' => $superRole->id,
                'status' => true,
            ],
        );

        // 1.2 Haitham Super Admin
        User::firstOrCreate(
            ['email' => 'haitham@admin.com'],
            [
                'name' => [
                    'en' => 'Haitham Admin',
                    'ar' => 'هيثم - مدير النظام',
                ],
                'password' => bcrypt('123123'),
                'company_id' => 1,
                'role_id' => $superRole->id,
                'status' => true,
            ],
        );
        // 2. Ghassan Admin (Company Manager)
        $ghassanCompany = Company::where('name->en', 'Ghassan Rental Company')->first();
        if ($ghassanCompany) {
            User::firstOrCreate(
                ['email' => 'ghassan@admin.com'],
                [
                    'name' => [
                        'en' => 'Ghassan Admin',
                        'ar' => 'غسان - مدير الشركة',
                    ],
                    'password' => bcrypt('123456'),
                    'company_id' => $ghassanCompany->id,
                    'role_id' => $adminRole->id,
                    'status' => true,
                ]
            );
        }
    }
}
