<?php

namespace Database\Seeders;

use App\Models\PropertyStatus;
use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['en' => 'Available', 'ar' => 'متاح', 'color' => '#28C76F'], // Success Green
            ['en' => 'Rented', 'ar' => 'مؤجر', 'color' => '#00CFE8'],    // Info Cyan
            ['en' => 'Sold', 'ar' => 'مباع', 'color' => '#7367F0'],      // Primary Purple
            ['en' => 'Maintenance', 'ar' => 'صيانة', 'color' => '#FF9F43'], // Warning Orange
            ['en' => 'Reserved', 'ar' => 'محجوز', 'color' => '#EA5455'],  // Danger Red
        ];

        foreach ($statuses as $status) {
            PropertyStatus::updateOrCreate(
                ['name->en' => $status['en']],
                [
                    'name' => [
                        'en' => $status['en'],
                        'ar' => $status['ar'],
                    ],
                    'color' => $status['color'],
                    'company_id' => null, // Global
                    'status' => 1,
                ]
            );
        }
    }
}
