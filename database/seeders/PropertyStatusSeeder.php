<?php

namespace Database\Seeders;

use App\Models\PropertyStatus;
use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            [
                'en' => 'Available', 
                'ar' => 'متاح', 
                'color' => '#10B981' // Emerald Green - Modern & Fresh
            ],
            [
                'en' => 'Rented', 
                'ar' => 'مؤجر', 
                'color' => '#3B82F6' // Royal Blue - Professional & Clear
            ],
            [
                'en' => 'Maintenance', 
                'ar' => 'صيانة', 
                'color' => '#F59E0B' // Amber/Orange - Warm & Noticeable
            ],
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
