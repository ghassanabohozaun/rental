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
        Schema::disableForeignKeyConstraints();
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->string('name');
            $table->string('location')->nullable();
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->onDelete('set null');
            $table->string('area')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->foreignId('property_status_id')->nullable()->constrained('property_statuses')->onDelete('set null');
            
            $table->text('description')->nullable();
            
            $table->string('property_number')->nullable();
            $table->string('title_deed_number')->nullable();
            $table->string('electricity_account_number')->nullable();
            $table->string('water_account_number')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
