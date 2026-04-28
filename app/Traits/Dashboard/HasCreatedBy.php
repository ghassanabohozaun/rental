<?php

namespace App\Traits\Dashboard;

use Illuminate\Support\Facades\Auth;

trait HasCreatedBy
{
    /**
     * Boot the HasCreatedBy trait for a model.
     *
     * @return void
     */
    protected static function bootHasCreatedBy()
    {
        static::creating(function ($model) {
            if (Auth::check() && empty($model->created_by)) {
                $model->created_by = Auth::id();
            }
        });
    }

    /**
     * Define the relationship to the user who created the record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
