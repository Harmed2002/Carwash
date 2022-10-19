<?php

namespace App\Models;

use App\Models\Vehicle;
use Validator;


class VehicleModel {

    /**
     * Get all Vehicle
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Vehicle
     */
    public static function listVehicles($paginate = 10, $search = null) {

        $vehicle = Vehicle::query();
        $vehicle->whereNull('deleted_at');
        $vehicle->orderBy('name');
        if ($search) {
            $vehicle->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $vehicle->paginate($paginate) : $vehicle->get();
    }

    /**
     * get a Vehicle by id
     * @param integer $vehicle id from database
     * @return Object Vehicle FormVehicle
     */
    public static function getVehicle($idVehicle) {
        $vehicle = Vehicle::find($idVehicle);
        return $vehicle;
    }

    /**
     * get validator for Vehicle
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        //dd($data);
        $validator  = null;
        $niceNames = array(
            'vehi_placa.required'       => 'La placa es requerida',
            'vehi_placa.max'            => 'La placa debe tener maximo 12 caracteres',
            'vehi_placa.unique'         => 'La placa debe ser única, la ingresada ya está asociada a un vehículo',
            'id_propietario.required'   => 'El propietario es requerido',
            'id_modelo.required'        => 'El modelo es requerido',
            'vehi_obs.max'              => 'La observación debe tener maximo 250 caracteres',
        );

        $valid = $data['id'] == '' ? '':',id,'.$data['id'] ;
        $validator = Validator::make($data, [
            'vehi_placa'    => 'required|max:12|unique:vehicles'.$valid,
            'id_propietario'=> 'required|max:12',
            'id_modelo'     => 'required|max:12',
            'vehi_obs'      => 'max:250',
        ], $niceNames);

        return $validator;
    }

}
