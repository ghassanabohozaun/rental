<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'floor')) {
                $table->string('floor')->nullable()->after('property_type_id');
            }
            if (!Schema::hasColumn('properties', 'zone_number')) {
                $table->string('zone_number')->nullable()->after('floor');
            }
            if (!Schema::hasColumn('properties', 'street_number')) {
                $table->string('street_number')->nullable()->after('zone_number');
            }
            if (!Schema::hasColumn('properties', 'building_number')) {
                $table->string('building_number')->nullable()->after('street_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('properties', 'floor')) { $columnsToDrop[] = 'floor'; }
            if (Schema::hasColumn('properties', 'zone_number')) { $columnsToDrop[] = 'zone_number'; }
            if (Schema::hasColumn('properties', 'street_number')) { $columnsToDrop[] = 'street_number'; }
            if (Schema::hasColumn('properties', 'building_number')) { $columnsToDrop[] = 'building_number'; }
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
