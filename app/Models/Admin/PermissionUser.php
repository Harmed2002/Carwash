<?php

namespace App\Models\Admin;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'model_has_permissions';

    protected $fillable = ['permission_id','model_type' ,'nodel_id'];


}
