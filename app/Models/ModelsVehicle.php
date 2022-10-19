<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Esta clase es para los modelos de vehiculos
class ModelsVehicle extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    = 'vehiclemodels';
    protected $fillable = ['id_marca', 'vemo_modelo', 'id_tipovehiculo', 'id_user'];
    protected $hidden   = ['id', 'vemo_estado', 'created_at', 'updated_at', 'deleted_at'];


    public function getModelVehicleById($id)
    {
        $ModelVehicle = ModelsVehicle
                    ::join("vehiclebrands", "vehiclebrands.id", "=", "vehiclemodels.id_marca")
                    ->join("vehiclestype", "vehiclestype.id", "=", "vehiclemodels.id_tipovehiculo")
                    ->select("ModelsVehicle.*", "vebr_marca", "tive_nombre")
                    ->where("vehiclemodels.id", "=", $id)
                    ->get();

        return $ModelVehicle;

    }
    

    public function Brands()
    {
        return $this->belongsTo('App\Models\VehicleBrands', 'id_marca', 'id');
    }

    public function VehicleType()
    {
        return $this->belongsTo('App\Models\VehicleType', 'id_tipovehiculo', 'id');
    }

}
