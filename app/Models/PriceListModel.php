<?php

namespace App\Models;

use App\Models\PriceList;
use Validator;
// app includes


class PriceListModel {

    /**
     * Get all PriceList
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object PriceList
     */
    public static function listPriceLists($paginate = 10, $search = null) {

        $priceList = PriceList::query();


        return $priceList->orderBy('id','DESC')->paginate(7);
    }

    /**
     * get a PriceList by id
     * @param integer $PriceList id from database
     * @return Object PriceList 
     */
    public static function getPriceList($idPriceList) {
        // Estas funcion se puede usar si necesitan un PriceList, se busca por id
        $priceList = PriceList::find($idPriceList);

        return $priceList;
    }

    /**
     * get validator for PriceList
     * @param array $data information from form
     * @return Object Validator
     */

    public static function getValidator($data) {
        // Con esto se cambia el mensaje, que muestra la validacion
        $niceNames = array(
            'id_material.required'           => 'El material es requerido',
            'id_user.required'    => 'El usuario es requerido',
            'id_obra.required'      => 'La obra es requerida',
            'id_unmedida.required'      => 'La unidad es requerida',
            'precio.required'      => 'Eñ precio es requerido',
            'id_material.max'           => 'El id material supera la longitud establecidad',
            'id_user.max'    => 'El id usuario supera la longitud establecidad',
            'id_obra.max'      => 'El id obra supera la longitud establecidad',
            'id_unmedida.max'      => 'El id unidad supera la longitud establecidad',
            'precio.max'      => 'El precio supera la longitud establecidad',
        );
        $validator = Validator::make($data, [
            'id_material'           => ['required', 'max:12'],
            'id_user'    => ['required', 'max:12'],
            'id_obra'      => ['required', 'max:12'],
            'id_unmedida'      => ['required', 'max:12'],
            'precio'      => ['required', 'max:12'],
        ], $niceNames);


        return $validator;
    }

    public static function savePriceList($data) {

        $priceList = PriceList::find($data['id']??'');


        if ($priceList) {
          
           
            $priceList->id_obra = $data['id_obra'];
            $priceList->id_material = $data['id_material'];
            $priceList->id_unmedida = $data['id_unmedida'];
            $priceList->precio = $data['precio'];
            $priceList->iva = $data['iva'];
            $priceList->id_user =$data['id_user'];
            $priceList->save();
            
        } else {
            $price = PriceList::where('id_obra', $data['id_obra'])->where('id_material', $data['id_material'])->first();
            if (is_null($price)) {
                $priceList = PriceList::create($data);
            }else{
                $priceList = false;

            }
        }
        return $priceList;
    }
}
