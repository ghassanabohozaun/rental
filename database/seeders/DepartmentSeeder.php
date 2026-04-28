<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('id', 1)->first();

        $departments = [
            [
                'name' => [
                    'ar' => 'الإدارة',
                    'en' => 'Managment',
                ],
                'company_id' => $company->id,
            ],

            [
                'name' => [
                    'ar' => 'قسم المالية',
                    'en' => 'Finance department',
                ],
                'company_id' => $company->id,
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
