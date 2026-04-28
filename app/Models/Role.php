<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\Dashboard\Filterable;
use App\Contracts\MustBelongToCompany;
use App\Traits\BelongsToCompany;
use App\Traits\Dashboard\HasCreatedBy;
use App\Traits\Dashboard\CanBeDeleted;

class Role extends Model implements MustBelongToCompany
{
    use SoftDeletes, HasTranslations, HasFactory, Filterable, BelongsToCompany, HasCreatedBy, CanBeDeleted;

    protected $table = 'roles';
    protected $fillable = ['company_id', 'name', 'description', 'created_by'];

    public $translatable = ['name'];

    protected $restrictiveRelations = [
        'users' => 'roles.cannot_delete_role_linked_to_users'
    ];

    // relations
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function users(){
        return $this->hasMany(User::class , 'role_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
