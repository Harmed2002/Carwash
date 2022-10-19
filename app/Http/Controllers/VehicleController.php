<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\Person;
use App\Models\PersonModel;
use App\Models\Client;
use App\Models\ModelsVehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleType;
use Illuminate\Support\Facades\DB;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VehicleController extends Controller {
    
    public function index() {
        $vehicles = Vehicle::orderBy('id', 'DESC')->get();

        return view('vehicles.index', ['vehicles' => $vehicles]);
    }


    public function create(Request $request) {
        $vehicle = Vehicle::find($request->id);
        $person = null;
        $clients = Client::all();
        $models = ModelsVehicle::all();

        if (isset($request->show) && $request->show == 'true') {
            return view('vehicles.show', compact('vehicle'));
        } else {
            if ($vehicle) {
                $person =  $vehicle->Client->Person;
                //dd($person);
            }

            return view('vehicles.form', compact('vehicle', 'person', 'clients', 'models'));
        }
    }

    
    public function store(Request $request) {
        //dd($request->all());

        $vehicle = [];
        $vehicle['id']              = '';
        $vehicle['vehi_placa']      = strtoupper($request->placa);
        $vehicle['id_propietario']  = $request->prop;
        $vehicle['id_modelo']       = $request->modelo;
        $vehicle['vehi_anio']       = $request->year;
        $vehicle['vehi_obs']        = strtoupper($request->obs);
        $vehicle['id_user']         = Auth::id();

        $validate = VehicleModel::getValidator($vehicle);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }
        
        // Comienzo la transacción
        DB::beginTransaction();
        try {

            Vehicle::create($vehicle);
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            //return "Error de actulización de datos";
            return $e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $vehicles = Vehicle::orderBy('id', 'DESC')->get(); #->paginate(7);

        return view('vehicles.trVehicle', ['vehicles' => $vehicles]);

    }


    public function update(Request $request) {
        $vehicleUpd = [];
        $vehicleUpd['id']              = $request->id;
        $vehicleUpd['vehi_placa']      = strtoupper($request->placa);
        $vehicleUpd['id_propietario']  = $request->prop;
        $vehicleUpd['id_modelo']       = $request->modelo;
        $vehicleUpd['vehi_anio']       = $request->year;
        $vehicleUpd['vehi_obs']        = strtoupper($request->obs);
        $vehicleUpd['id_user']         = Auth::id();

        $validate = VehicleModel::getValidator($vehicleUpd);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            $vehicle = VehicleModel::getVehicle($request->id);
            $vehicle->update($vehicleUpd);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $vehicles = Vehicle::orderBy('id', 'DESC')->get(); #->paginate(7);

        return view('vehicles.trVehicle', ['vehicles' => $vehicles]);

    }

    
    public function destroy(Request $request) {
        //dd($request->all());
        $vehicle = Vehicle::find($request->id);
        $vehicle->vehi_estado ='I';

        try {
            $vehicle->update();
            $vehicle->delete();
        } catch (\Exception $e){
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $vehicles = Vehicle::orderBy('id', 'DESC')->get(); #->paginate(7);

        return view('vehicles.trVehicle', ['vehicles' => $vehicles]);
    }
}
