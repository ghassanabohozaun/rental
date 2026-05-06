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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('property_id')->constrained('properties')->onDelete('restrict');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');

            $table->date('start_date');
            $table->date('end_date');

            $table->decimal('rent_amount', 15, 2);
            $table->decimal('deposit_amount', 15, 2)->default(0);
            $table->string('deposit_type')->default('cash'); // cash, cheque
            $table->string('deposit_status')->default('held'); // held, returned, used

            $table->string('payment_cycle')->default('monthly'); // monthly, yearly
            $table->string('status')->default('active'); // active, ended, cancelled

            $table->longText('contract_text')->nullable();
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('contracts');
    }
};
