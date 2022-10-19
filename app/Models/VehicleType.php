<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    = 'vehicletypes';
    protected $fillable = ['tive_nombre'];
    protected $hidden   = ['id', 'tive_estado', 'created_at', 'updated_at', 'deleted_at'];


    public function getVehicleTypeById($id)
    {
        $vehicleType = VehicleType::find($id);
        
        return $vehicleType;
    }

    public function ModelsVehicle()
    {
        return $this->hasMany('App\Models\ModelsVehicle', 'id', 'id_tipovehiculo');
    }

}
