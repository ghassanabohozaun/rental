<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\HasCreatedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractClauseTemplate extends Model
{
    use HasFactory, BelongsToCompany, HasCreatedBy, SoftDeletes;

    protected $fillable = [
        'company_id',
        'title',
        'content',
        'is_default',
        'order_num',
        'status',
        'created_by'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
