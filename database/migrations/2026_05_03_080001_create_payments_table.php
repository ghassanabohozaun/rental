<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->cascadeOnDelete();
            
            $table->decimal('amount', 15, 2);
            $table->date('payment_date');
            $table->string('method')->default('cash'); // cash, bank, cheque, online
            $table->string('status')->default('paid'); // paid, pending, bounced
            
            $table->string('reference_number')->nullable(); // For bank/online transfers
            $table->foreignId('cheque_id')->nullable()->constrained('cheques')->nullOnDelete();
            
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
