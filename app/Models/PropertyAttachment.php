<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyAttachment extends Model
{
    protected $fillable = ['property_id', 'name', 'file'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
