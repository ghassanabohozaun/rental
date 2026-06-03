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
        Schema::table('contracts', function (Blueprint $table) {
            $table->integer('contract_duration_months')->default(0)->after('end_date');
            $table->decimal('total_rent_amount', 15, 2)->default(0)->after('rent_amount');
        });

        // Backfill existing contracts
        $contracts = \App\Models\Contract::all();
        foreach ($contracts as $contract) {
            if ($contract->start_date && $contract->end_date) {
                $months = (int) round($contract->start_date->floatDiffInMonths($contract->end_date->copy()->addDay()));
                $contract->contract_duration_months = $months;
                $contract->total_rent_amount = $months * (float) $contract->rent_amount;
                $contract->saveQuietly();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn(['contract_duration_months', 'total_rent_amount']);
        });
    }
};
