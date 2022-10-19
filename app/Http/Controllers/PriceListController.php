<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Construction;
use App\Models\Material;
use App\Models\MaterialModel;
use App\Models\PriceList;
use App\Models\PriceListModel;
use App\Models\Unit;
use Auth;
use Illuminate\Http\Request;

class PriceListController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $priceLists =  PriceList::orderBy('id','DESC')->get();
        return view('priceLists.index', compact('priceLists'));
    }

    public function getPriceList($idObra, $idMaterial) {
        $pricelist = $this->pricelist->getPriceListById($idObra, $idMaterial);
        //dd($pricelist);
        return $pricelist;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $priceList = PriceList::find($request->priceList_id);
        $constructions =  Construction::all();
        if (isset($request->show) && $request->show == 'true') {

            return view('priceLists.show', compact('priceList'));
        } else {
            $materials = Material::where('mate_estado','A')->get();
            $clients = Client::where('client_estado','A')->get();
            $units = Unit::where('unit_estado','A')->get();
            return view('priceLists.form', compact('priceList', 'materials', 'clients', 'units','constructions'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Creo los datos de Persona
        $arrayErrors = [];
        $id_user = Auth::id();

        if(!isset($request->priceLists) && is_null($request->id)){
            return response()->json(['message' => "No se puede guardar, sin antes crear una lista de precios"], 500);
  
        }


        if (!is_null($request->id)) {
         
            $data  = $request->all();

            $data['id_user'] =  $id_user;
            // return response()->json(['datas' =>  $data], 500);
            $validate = PriceListModel::getValidator($data);

            if ($validate->fails()) {

                return response()->json(['errors' => $validate->errors()], 500);
            }
            $priceList = PriceListModel::savePriceList($data);
        } else {

            $priceLists  = $request->priceLists;
            $id_obra =  $request->id_obra;
            foreach ($priceLists as $priceList) {

                $priceList['id_user'] =  $id_user;
                $priceList['id_obra'] =  $id_obra;


                $validate = PriceListModel::getValidator($priceList);
                if ($validate->fails()) {

                    return response()->json(['errors' => $validate->errors()], 500);
                }

                $arrayPriceList = PriceListModel::savePriceList($priceList);

                if ($arrayPriceList  === false) {
                    $meterial = MaterialModel::getMaterial($priceList['id_material']);
                    array_push($arrayErrors, "El meterial  $meterial->mate_descripcion ya ha sido asociado a está obra");
                }
            }
        }

        if (count($arrayErrors) > 0) {
            return response()->json(['errors' => $arrayErrors], 500);
        }


        $priceLists =  PriceList::orderBy('id','DESC')->paginate(7);
        return view('priceLists.trPriceList', compact('priceLists'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function  searchMaterial(Request $request) {
        // PersonModel::getPerson('paso el id de persona'); me retorna la persona

        $material = Material::find($request->material_id);
        // dd($material);
        $units = Unit::all();
        $count = $request->count;
        return view('priceLists.trMaterial', compact('material', 'units', 'count'));
    }




    public function destroy(Request $request) {
        $priceList = PriceListModel::getPriceList($request->priceList_id);
        $priceList->priceList_estado = 'I';
        $priceList->save();

        $priceLists =  PriceList::orderBy('id','DESC')->paginate(7);
        return view('priceLists.trPriceList', compact('priceLists'));
    }
}
