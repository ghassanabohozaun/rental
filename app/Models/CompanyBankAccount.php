<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Dashboard\HasCreatedBy;

class CompanyBankAccount extends Model implements MustBelongToCompany
{
    use HasFactory, BelongsToCompany, Filterable, HasTranslations, SoftDeletes, HasCreatedBy;

    public $translatable = ['bank_name', 'account_holder_name'];

    protected $fillable = [
        'company_id',
        'bank_name',
        'account_number',
        'account_holder_name',
        'iban',
        'is_default',
        'created_by'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];

    /**
     * Ensure only one default bank account per company.
     */
    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->is_default) {
                // Unset other default accounts for the same company
                static::where('company_id', $model->company_id)
                    ->where('id', '!=', $model->id)
                    ->update(['is_default' => false]);
            }
        });
    }

    /**
     * Get the formatted IBAN with spaces every 4 characters.
     */
    public function getFormattedIbanAttribute()
    {
        if (!$this->iban) return null;
        return trim(chunk_split(str_replace(' ', '', $this->iban), 4, ' '));
    }
}
