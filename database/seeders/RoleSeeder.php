<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Company;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super User (System Admin) - Assigned to Company 1 (Main) for isolation
        $superRole = Role::firstOrCreate(
            ['name->en' => 'Super User'],
            [
                'company_id' => 1, // Private to System Company
                'name' => [
                    'en' => 'Super User',
                    'ar' => 'المستخدم الرئيسي',
                ],
                'description' => 'System Super Administrator',
            ]
        );

        // Assign all permissions to Super Admin
        $allPermissions = Permission::all();
        $superRole->permissions()->sync($allPermissions->pluck('id'));

        // 2. Company Manager - Global (Visible to all companies)
        $adminRole = Role::firstOrCreate(
            ['name->en' => 'Company Manager'],
            [
                'company_id' => null, // Global Role
                'name' => [
                    'en' => 'Company Manager',
                    'ar' => 'مدير الشركة',
                ],
                'description' => 'Full access to company modules except company management',
            ]
        );

        // Assign all permissions except companies_* to Company Admin
        $companyAdminPermissions = Permission::where('name', 'not like', 'companies_%')->get();
        $adminRole->permissions()->sync($companyAdminPermissions->pluck('id'));
    }
}
