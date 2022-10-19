<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'persons';
    protected $fillable = ['pers_identif', 'id_user', 'pers_tipoid', 'pers_primernombre', 'pers_segnombre', 'pers_primerapell', 'pers_segapell', 
                            'pers_direccion', 'pers_telefono', 'ciud_id', 'dpto_id', 'pers_email', 'pers_razonsocial'];
    protected $hidden = ["id",'created_at', "updated_at", "deleted_at"];

    public function getPersonById($id)
    {
        return Person::find($id);
    }

    public function Employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'id_person');
    }

    public function City()
    {
        return $this->belongsTo('App\Models\City', 'ciud_id', 'id');
    }

    public function State()
    {
        return $this->belongsTo('App\Models\State', 'dpto_id', 'id');
    }

    public function Client()
    {
        return $this->hasOne('App\Models\Client', 'id', 'id_person');
    }
  
}
