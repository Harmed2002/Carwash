<?php

namespace App\Models;

use App\Models\VehicleType;
use Validator;


class VehicleTypeModel {

    /**
     * Get all VehicleTypes
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object VehicleType
     */
    public static function listVehicleType($paginate = 10, $search = null) {

        $vehicleTypes = VehicleType::query();
        $vehicleTypes->whereNull('deleted_at');
        $vehicleTypes->orderBy('name');
        if ($search) {
            $vehicleTypes->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $vehicleTypes->paginate($paginate) : $vehicleTypes->get();
    }

    /**
     * get a VehicleType by id
     * @param integer $VehicleType id from database
     * @return Object VehicleType FormVehicleType
     */
    public static function getVehicleType($id) {
        $vehicleType = VehicleType::find($id);
        return $vehicleType;
    }

    /**
     * get validator for VehicleType
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        //dd($data);
        $validator  = null;
        $niceNames = array(
            'tive_nombre.required'       => 'El nombre es requerido',
            'tive_nombre.max'            => 'El nombre debe tener maximo 100 caracteres',
            'tive_nombre.unique'         => 'El nombre debe ser único, el ingresado ya existe',
        );

        $valid = $data['tive_nombre'] == '' ? '':',tive_nombre,'.$data['tive_nombre'] ;
        $validator = Validator::make($data, [
            'tive_nombre'    => 'required|max:100|unique:vehicletypes'.$valid,
        ], $niceNames);

        return $validator;
    }

}
