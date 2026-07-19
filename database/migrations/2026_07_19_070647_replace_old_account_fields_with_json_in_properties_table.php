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
            $table->json('additional_numbers')->nullable()->after('property_status_id');
            
            $columnsToDrop = [];
            if (Schema::hasColumn('properties', 'property_number')) $columnsToDrop[] = 'property_number';
            if (Schema::hasColumn('properties', 'title_deed_number')) $columnsToDrop[] = 'title_deed_number';
            if (Schema::hasColumn('properties', 'electricity_account_number')) $columnsToDrop[] = 'electricity_account_number';
            if (Schema::hasColumn('properties', 'water_account_number')) $columnsToDrop[] = 'water_account_number';
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('additional_numbers');
            
            $table->string('property_number')->nullable();
            $table->string('title_deed_number')->nullable();
            $table->string('electricity_account_number')->nullable();
            $table->string('water_account_number')->nullable();
        });
    }
};
