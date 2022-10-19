<?php

namespace App\Models;

use App\Models\Position;
use Validator;


class PositionModel {

    /**
     * Get all Positions
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Position
     */
    public static function listPositions($paginate = 10, $search = null) {

        $position = Position::query();
        $position->whereNull('deleted_at');
        $position->orderBy('name');
        if ($search) {
            $position->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $position->paginate($paginate) : $position->get();
    }

    /**
     * get a Position by id
     * @param integer $position id from database
     * @return Object Position FormPosition
     */
    public static function getPosition($id) {
        $position = Position::find($id);
        return $position;
    }

    /**
     * get validator for Position
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        //dd($data);
        $validator  = null;
        $niceNames = array(
            'posi_nombre.required'       => 'El nombre del cargo es requerido',
            'posi_nombre.max'            => 'El nombre del cargo debe tener maximo 120 caracteres',
            'posi_nombre.unique'         => 'El nombre del cargo debe ser único, el ingresado ya existe',
        );

        $valid = $data['posi_nombre'] == '' ? '':',posi_nombre,'.$data['posi_nombre'] ;
        $validator = Validator::make($data, [
            'posi_nombre'    => 'required|max:120|unique:positions'.$valid,
        ], $niceNames);

        return $validator;
    }

}
