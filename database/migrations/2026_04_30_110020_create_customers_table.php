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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->text('name'); // Translatable
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('id_number')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('tenant_type', ['individual', 'company'])->default('individual');
            $table->foreignId('guarantor_id')->nullable()->constrained('guarantors')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
