<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'grace_period',
        'first_party_data',
        'second_party_data',
        'property_data',
        'utilities_data',
        'financial_data',
        'contract_clauses',
    ];

    protected $casts = [
        'first_party_data' => 'array',
        'second_party_data' => 'array',
        'property_data' => 'array',
        'utilities_data' => 'array',
        'financial_data' => 'array',
        'contract_clauses' => 'array',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
