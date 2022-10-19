<?php

namespace App\Models\Admin;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'role_has_permissions';

    protected $fillable = ['permission_id', 'role_id'];

    public function role() {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'role_id', 'id');
    }
    public function permission() {
        return $this->belongsTo('Spatie\Permission\Models\Permission', 'permission_id', 'id');
    }
    // public function contactSocialNetworks() {
    //     return $this->hasMany('App\Http\Models\Contact\ContactSocialNetwork', 'idContact', 'idContact');
    // }
}
