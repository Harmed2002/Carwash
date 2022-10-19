<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    = 'vehicles';
    protected $fillable = ['vehi_placa', 'id_propietario', 'id_modelo', 'vehi_anio', 'vehi_obs', 'id_user'];
    protected $hidden   = ['id', 'vehi_estado', 'created_at', 'updated_at', 'deleted_at'];

    public function getVehicleById($id)
    {
        $vehicle = Vehicle::join("clients", "clients.id", "=", "vehicles.id_propietario")
                    ->join("persons", "persons.id", "=", "clients.id_person")
                    ->join("vehiclemodels", "vehiclemodels.id", "=", "vehicles.id_modelo")
                    ->select("vehicles.*", "vehiclemodels.*", "persons.id as idPerson", "pers_tipoid", "pers_identif", "pers_razonsocial", "pers_primernombre", "pers_segnombre",
                            "pers_primerapell", "pers_segapell")
                    ->where("vehicles.id", "=", $id)
                    ->get();

        return $vehicle;

    }

    public function Client()
    {
        return $this->belongsTo('App\Models\Client', 'id_propietario', 'id');
    }

    public function ModelsVehicle()
    {
        return $this->belongsTo('App\Models\ModelsVehicle', 'id_modelo', 'id');
    }

}
