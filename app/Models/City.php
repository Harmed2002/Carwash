<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cities';

    protected $fillable = ['dpto_id','ciud_nombre', 'dpto_id', 'ciud_estado'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['ciud_id', 'created_at', 'updated_at', 'deleted_at'];


    public function getCities($idState)
    {
        $cities = City::where('dpto_id',$idState)->get();
         return $cities;
    }

    public function getCityById($id)
    {
        return City::find($id);
    }

    public function State()
    {
        return $this->belongsTo('App\Models\State', 'dpto_id', 'id');
    }

}
