<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractAttachment extends Model
{
    protected $fillable = ['contract_id', 'name', 'file'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
