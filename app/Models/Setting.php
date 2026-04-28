<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Contracts\MustBelongToCompany;
use App\Traits\BelongsToCompany;

class Setting extends Model implements MustBelongToCompany
{
    use HasTranslations, BelongsToCompany;
    protected $table = 'settings';
    protected $fillable = ['company_id', 'site_name', 'address', 'description', 'keywords', 'phone','mobile',
    'whatsapp', 'email', 'email_support', 'facebook', 'twitter', 'instegram', 'youtube', 'logo', 'favicon'];
    public $timestamps = false;
    public array $translatable = ['site_name', 'address', 'description', 'keywords'];



    // Improve the screen show
    public function getLogoUrlAttribute()
    {
        if ($this->logo && file_exists(public_path('uploads/settings/' . $this->logo))) {
            return asset('uploads/settings/' . $this->logo);
        }
        return asset('assets/dashbaord/images/logo.png');
    }

    public function getFaviconUrlAttribute()
    {
        if ($this->favicon && file_exists(public_path('uploads/settings/' . $this->favicon))) {
            return asset('uploads/settings/' . $this->favicon);
        }
        return asset('assets/dashbaord/images/favicon.png');
    }

    public function getSiteNameTranslatedAttribute()
    {
        return $this->site_name ?? 'Rental System';
    }
}
