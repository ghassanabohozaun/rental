<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['en' => 'Apartment', 'ar' => 'شقة'],
            ['en' => 'Villa', 'ar' => 'فيلا'],
            ['en' => 'Office', 'ar' => 'مكتب'],
            ['en' => 'Shop', 'ar' => 'محل تجاري'],
            ['en' => 'Land', 'ar' => 'أرض'],
            ['en' => 'Building', 'ar' => 'عمارة'],
        ];

        foreach ($types as $type) {
            PropertyType::firstOrCreate(
                ['name->en' => $type['en']],
                [
                    'name' => [
                        'en' => $type['en'],
                        'ar' => $type['ar'],
                    ],
                    'company_id' => null, // Global
                    'status' => 1,
                ]
            );
        }
    }
}
