<?php

namespace App\Models\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
class PermissionSystem extends Model 
{
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'permissions';

    protected $fillable = ['name','guard_name'];


}
