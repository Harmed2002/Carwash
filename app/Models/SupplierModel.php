<?php

namespace App\Models;

use App\Models\Supplier;
use Validator;
// app includes


class SupplierModel {

    /**
     * Get all Supplier
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Supplier
     */
    public static function listSuppliers($paginate = 10, $search = null) {

        $supplier = Supplier::query();

        return  $supplier->orderBy('id', 'ASC')->get();
    }

    /**
     * get a Supplier by id
     * @param integer $supplier id from database
     * @return Object Supplier 
     */
    public static function getSupplier($idSupplier) {
        $supplier = Supplier::find($idSupplier);

        return $supplier;
    }

    /**
     * get validator for Supplier
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            'actEcon' => ['max:3'],            
        ]);
    
        // 'reputationNotes',
        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'actEcon' => 'Cód. de Actividad',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    public static function getDV($nit) {
        $result = 0;
        $lengthNit = strlen($nit);
    
        if ($lengthNit >= 9){
            //$array          = $nit.split('');
            $array          = explode ('', $nit); //$array = Str_split($nit);
            $lengthArray    = count($array);
            $sum            = 0;
            $arraySeriel    = array(41, 37, 29, 23, 19, 17, 13, 7, 3);

            for ($index = 0; $index < $lengthArray; $index++) {
                //$element =  parseInt(array[$index]) * arraySeriel[$index];
                $element =  $array[$index] * $arraySeriel[$index];
                $sum += $element;
            }

            $div        =  $sum / 11;
            //$decPart    = parseFloat('0.' + ($div + "").split(".")[1]);
            $decPart    = $div - floor($div);
            $mul        = round($decPart * 11);
    
            if ($mul == 0 || $mul == 1) {
                $result = $mul;
            }else{
                $result = 11 - $mul;
            }
    
            return $result;
    
        }else{
    
            return '';
        }
    }

}
