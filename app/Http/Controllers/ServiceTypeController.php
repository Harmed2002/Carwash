<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use App\Models\ServiceTypeModel;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller {

    public function index() {
        $serviceTypes = ServiceType::orderBy('id', 'ASC')->get();
        return view('serviceTypes.index', ['serviceTypes' => $serviceTypes, 'services' => $serviceTypes]);
    }


    public function create(Request $request) {
        $serviceType = ServiceType::find($request->id);
        $services = ServiceType::orderBy('id', 'ASC')->get();

        if (isset($request->show) && $request->show == 'true') {
            return view('serviceTypes.show', compact('serviceType'));
        } else {
            //return view('serviceTypes.form', compact('serviceType'));
            return view('serviceTypes.form', compact('serviceType', 'services'));
        }
    }

    
    public function store(Request $request) {
        //dd($request->all());

        $serviceType                   = [];
        $serviceType['id']             = '';
        $serviceType['tise_nombre']    = strtoupper($request->nombre);
        $serviceType['tise_valor']     = $request->valor;

        $validate = ServiceTypeModel::getValidator($serviceType);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            // Guardo los datos en el maestro de servicios
            $serviceType = ServiceType::create($serviceType);

            // Guardo el detalle si es combo
            $idCombo = $serviceType->id;
            $details = $request->details;
            
            if (!empty($details)) {
                
                foreach ($details as $key => $value) {
                    // Aqui se pone el id de la cabecera

                    //Ese value ya trae la información estonces lo unico que hago es adicionar el id de la cabecera
                    $value['idcabecera'] =2; // Ese dos es el id de la cabecera que se cuardo me hago entender? si clro
                
                    //Detalle::create( $value); // Ejemplo y ya. Debes probar a ver. es más ya está la tabla de detalle ? no, debo hacerla A entonce hasta ahi gracias. Con gusto viejo harold. Para eso estamos
                    dump($value['id']);

                }
           }

            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

        

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $serviceTypes = ServiceType::orderBy('id', 'ASC')->get();
        return view('serviceTypes.trServiceType', ['serviceTypes' => $serviceTypes]);

    }


    public function update(Request $request) {
        //dd($request->all());
        $serviceTypeUpd                   = [];
        $serviceTypeUpd['id']             = $request->id;
        $serviceTypeUpd['tise_nombre']    = strtoupper($request->nombre);
        $serviceTypeUpd['tise_valor']     = $request->valor;

        $validate = ServiceTypeModel::getValidator($serviceTypeUpd);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            $serviceType = ServiceTypeModel::getServiceType($request->id);
            $serviceType->update($serviceTypeUpd);
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $serviceTypes = ServiceType::orderBy('id', 'ASC')->get();
        return view('serviceTypes.trServiceType', ['serviceTypes' => $serviceTypes]);

    }

    
    public function destroy(Request $request) {
        //dd($request->all());
        $serviceType = ServiceType::find($request->id);
        $serviceType->tise_estado ='I';

        try {
            $serviceType->save();
            $serviceType->delete();
        } catch (\Exception $e){
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $serviceTypes = ServiceType::orderBy('id', 'ASC')->get();
        return view('serviceTypes.trServiceType', ['serviceTypes' => $serviceTypes]);
    }


    public function trService(Request $request) {
        $detail = $request->all();

        $count = $request->count;

        return view('serviceTypes.trDetailServiceCombo', compact('detail', 'count'));
    }
}
