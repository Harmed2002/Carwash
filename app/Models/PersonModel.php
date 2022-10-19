<?php

namespace App\Models;

use App\Models\Person;
use Validator;
use Illuminate\Validation\Rule;
// app includes


// use App\Models\Admin\PersonSystem;

/**
 * Querys for Person Table
 */
class PersonModel {

    /**
     * Get all Persons
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Persons
     */
    public static function listPerson($paginate = 10, $search = null) {

        $person = Person::query();

        return  $person->orderBy('id','DESC')->paginate(7);
    }

    /**
     * get a Person by id
     * @param integer $person id from database
     * @return Object Person FormPerson
     */
    public static function getPerson($idPerson) {
        // Estas funcion se puede usar si necesitan una persona, se busca por id
        $person = Person::find($idPerson);

        return $person;
    }

    /**
     * get validator for Persons
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $tipoId) {
        $validator  = null;
        $niceNames = array(
            'pers_identif.required'     => 'El número de identificación es requerido',
            'pers_tipoid.required'      => 'El tipo de identificación es requerido',
            'pers_razonsocial.required' => 'El razón social es requerida',
            'pers_razonsocial.max'      => 'El razón social debe tener maximo 120 caracteres',
            'dpto_id.required'          => 'El dpto. es requerida',
            'ciud_id.required'          => 'El ciudad es requerida',
            'id_user.required'          => 'El id user es requerido',
            'pers_email.required'       => 'El email es requerido',
            'pers_email.unique'         => 'El email debe ser único, el ingresado ya está asociado a un cliente',
            'pers_email.email'          => 'El email ingresado, no corresponde al formato requerido',
            'pers_identif.pers_identif' => 'El número de identificación debe ser único, el ingresado ya está asociado a un cliente',
            'pers_identif.pers_telefono'=> 'El número télefonico debe tener maximo 50 caracteres',
            'pers_primernombre.required'=> 'El primer nombre es requerido',
            'pers_primerapell.required' => 'El primer apellido es requerido',
            'pers_primernombre.max'     => 'El primer nombre debe tener maximo 40',
            'pers_primerapell.max'      => 'El primer apellido debe tener maximo 40',
        );

      
        $valid = $data['id'] == '' ? '':',id,'.$data['id'] ;
        if($tipoId =='NIT'){
            $validator = Validator::make($data, [
                'pers_identif'      => 'required|max:12|unique:persons'.$valid,
                'pers_tipoid'       => 'required|max:3',
                'pers_razonsocial'  => 'required|max:120', //Bien
                'pers_direccion'    => 'max:50',
                'pers_telefono'     => 'max:50',
                'ciud_id'           => 'required',
                'dpto_id'           => 'required',
                'pers_email'        => 'max:50|email|unique:persons'.$valid,
            ],$niceNames);
        } else {
            $validator = Validator::make($data, [
                'pers_identif'      => 'required|max:12|unique:persons'.$valid,
                'pers_tipoid'       => 'required', 'max:3',
                'pers_razonsocial'  => 'max:120',
                'pers_direccion'    => 'max:50',
                'pers_telefono'     => 'max:50',
                'ciud_id'           => 'required',
                'dpto_id'           => 'required',
                'pers_primernombre' => 'required|max:40',
                'pers_primerapell'  => 'required|max:40',
                'pers_email'        => 'max:50|email|unique:persons'.$valid,
            ],$niceNames);
    
        }

        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
;

        // $validator->setAttributeNames($niceNames);

        return $validator;
    }

    
    public function savePerson($data)
    {
        $person =  Person::updateOrCreate($data);
        return $person ;
    }

}
