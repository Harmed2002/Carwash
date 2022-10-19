<?php

namespace App\Models\Admin;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'model_has_roles';

    protected $fillable = ['role_id', 'model_type','model_id'];

    public function user() {
        return $this->belongsTo('App\Models\Admin\User', 'model_id', 'id');
    }
    public function role() {
        return $this->belongsTo('App\Models\Admin\RoleSystem', 'role_id', 'id');
    }
}
