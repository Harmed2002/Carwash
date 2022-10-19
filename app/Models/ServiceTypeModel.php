<?php

namespace App\Models;

use App\Models\ServiceType;
use Validator;


class ServiceTypeModel {

    /**
     * Get all ServiceTypes
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object ServiceType
     */
    public static function listServiceType($paginate = 10, $search = null) {

        $serviceTypes = ServiceType::query();
        $serviceTypes->whereNull('deleted_at');
        $serviceTypes->orderBy('name');
        if ($search) {
            $serviceTypes->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $serviceTypes->paginate($paginate) : $serviceTypes->get();
    }

    /**
     * get a ServiceType by id
     * @param integer $ServiceType id from database
     * @return Object ServiceType FormServiceType
     */
    public static function getServiceType($id) {
        $serviceType = ServiceType::find($id);
        return $serviceType;
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
            'tise_nombre.required'       => 'El nombre es requerido',
            'tise_nombre.max'            => 'El nombre debe tener maximo 100 caracteres',
            'tise_nombre.unique'         => 'El nombre debe ser único, el ingresado ya existe',
        );

        $valid = $data['tise_nombre'] == '' ? '':',tise_nombre,'.$data['tise_nombre'] ;
        $validator = Validator::make($data, [
            'tise_nombre'    => 'required|max:100|unique:servicetypes'.$valid,
        ], $niceNames);

        return $validator;
    }

}
