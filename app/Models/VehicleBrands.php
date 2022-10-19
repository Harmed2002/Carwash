<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Esta clase es para las marcas de vehiculos
class VehicleBrands extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    = 'vehiclebrands';
    protected $fillable = ['vebr_marca'];
    protected $hidden   = ['id', 'vebr_estado'];


    public function getBrandVehicleById($id)
    {
        $VehicleBrand = VehicleBrands
                    ::select("vehiclebrands.*")
                    ->where("id", "=", $id)
                    ->get();

        return $VehicleBrand;

    }

    public function vehiclemodels()
    {
        return $this->hasMany('App\Models\ModelsVehicle', 'id', 'id_marca');
    }

}
