<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;

class Company extends Model
{
    use HasFactory, HasTranslations, Filterable, SoftDeletes, HasCreatedBy, CanBeDeleted;

    protected $table = 'companies';

    protected $restrictiveRelations = [
        'users'             => 'companies.cannot_delete_has_users',
        'bankAccounts'      => 'companies.cannot_delete_has_bank_accounts',
        'properties'        => 'companies.cannot_delete_has_properties',
        'departments'       => 'companies.cannot_delete_has_departments',
        'propertyTypes'     => 'companies.cannot_delete_has_property_types',
        'propertyStatuses'  => 'companies.cannot_delete_has_property_statuses',
        'roles'             => 'companies.cannot_delete_has_roles',
        'guarantors'        => 'companies.cannot_delete_has_guarantors',
    ];

    protected $fillable = [
        'name',
        'subscription_plan',
        'status',
        'address',
        'phone',
        'email',
        'logo',
        'created_by'
    ];

    public array $translatable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(CompanyBankAccount::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function propertyTypes()
    {
        return $this->hasMany(PropertyType::class);
    }

    public function propertyStatuses()
    {
        return $this->hasMany(PropertyStatus::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function guarantors()
    {
        return $this->hasMany(Guarantor::class);
    }



    // Improve the screen show
    public function getLogoUrlAttribute()
    {
        if ($this->logo && file_exists(public_path('uploads/companies/' . $this->logo))) {
            return asset('uploads/companies/' . $this->logo);
        }
        return null;
    }

    public function getInitialsAttribute()
    {
        $name = $this->getTranslation('name', app()->getLocale()) ?: $this->name;
        $words = explode(' ', $name);
        if (count($words) >= 2) {
            return mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
        }
        return mb_strtoupper(mb_substr($name, 0, 1));
    }

    public function getAvatarColor()
    {
        $colors = ['#5A8DEE', '#FDAC41', '#FF5B5C', '#39DA8A', '#00CFDD', '#7117EA', '#272727'];
        $charIndex = abs(crc32($this->name)) % count($colors);
        return $colors[$charIndex];
    }
}
