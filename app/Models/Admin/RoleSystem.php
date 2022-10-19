<?php

namespace App\Models\Admin;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleSystem extends Model
{
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'roles';

    protected $fillable = ['name','guard_name'];


}
