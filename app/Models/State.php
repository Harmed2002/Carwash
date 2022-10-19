<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'states';

    protected $fillable = ['dpto_nombre', 'country_id', 'dpto_estado'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['dpto_id', 'created_at', 'updated_at', 'deleted_at'];


    public function getStateById($id)
    {
        return State::find($id);
    }

    public function Cities()
    {
        return $this->hasMany('App\Models\City', 'dpto_id', 'id' );
    }

}
