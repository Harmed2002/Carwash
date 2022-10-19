<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use App\Models\VehicleTypeModel;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller {

    public function index() {
        $vehicleTypes = VehicleType::orderBy('id', 'ASC')->get();

        return view('vehicleTypes.index', ['vehicleTypes' => $vehicleTypes]);
    }


    public function create(Request $request) {
        $vehicleType = VehicleType::find($request->id);

        if (isset($request->show) && $request->show == 'true') {
            return view('vehicleTypes.show', compact('vehicleType'));
        } else {
            return view('vehicleTypes.form', compact('vehicleType'));
        }
    }

    
    public function store(Request $request) {
        //dd($request->all());
        $vehicleType                   = [];
        $vehicleType['id']             = $request->id;
        $vehicleType['tive_nombre']    = strtoupper($request->nombre);

        $validate = VehicleTypeModel::getValidator($vehicleType);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            VehicleType::create($vehicleType);
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $vehicleTypes = VehicleType::orderBy('id', 'ASC')->get();
        return view('vehicleTypes.trVehicleType', ['vehicleTypes' => $vehicleTypes]);

    }


    public function update(Request $request) {
        //dd($request->all());
        $vehicleTypeUpd                   = [];
        $vehicleTypeUpd['id']             = $request->id;
        $vehicleTypeUpd['tive_nombre']    = strtoupper($request->nombre);

        $validate = VehicleTypeModel::getValidator($vehicleTypeUpd);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            $vehicleType = VehicleTypeModel::getVehicleType($request->id);
            $vehicleType->update($vehicleTypeUpd);
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $vehicleTypes = VehicleType::orderBy('id', 'ASC')->get();
        return view('vehicleTypes.trVehicleType', ['vehicleTypes' => $vehicleTypes]);

    }

    
    public function destroy(Request $request) {
        //dd($request->all());
        $vehicleType = VehicleType::find($request->id);
        $vehicleType->tive_estado ='I';

        try {
            $vehicleType->save();
            $vehicleType->delete();
        } catch (\Exception $e){
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $vehicleTypes = VehicleType::orderBy('id', 'ASC')->get();
        return view('vehicleTypes.trVehicleType', ['vehicleTypes' => $vehicleTypes]);
    }
}
