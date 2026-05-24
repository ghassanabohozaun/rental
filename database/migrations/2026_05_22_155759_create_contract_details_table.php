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
        Schema::create('contract_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');
            
            $table->string('grace_period')->nullable();
            
            // Snapshot data
            $table->json('first_party_data')->nullable(); // Snapshot of Company/Owner
            $table->json('second_party_data')->nullable(); // Snapshot of Customer
            $table->json('property_data')->nullable(); // Snapshot of Property
            $table->json('utilities_data')->nullable(); // Snapshot of Electricity/Water numbers
            $table->json('financial_data')->nullable(); // Snapshot of amounts, dates, etc
            
            // Editable contract clauses
            $table->longText('contract_clauses')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_details');
    }
};
