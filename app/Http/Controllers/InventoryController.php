<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\MachineTanking;
use App\Models\Production;
use Session;
use Illuminate\Http\Request;


class InventoryController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }


    public function index(Request $request) {
        Session::forget('info_message');
        $machines = Machine::all();
        $inventories = MachineTanking::query();

         if (isset($request->search)) {

            $inventories ->whereHas('Machine', function ($query) use ( $request) {
                $query->where("maqn_placa",  $request->search);
                
            });
        }
        if (isset($request->searchOrigin)) {

            $inventories ->whereHas('MachineCub', function ($query) use ( $request) {
                $query->where("maqn_placa",  $request->searchOrigin);
                
            });
        }

        
        if (isset($request->dateStart)){
            $inventories->whereDate('created_at', $request->dateStart);

        }
        if (isset($request->dateStart) && isset($request->dateEnd)) {
            $inventories->whereBetween('created_at', [$request->dateStart, $request->dateEnd]);
        }

        if (isset($request->tanq_origen)) {
            $inventories->where('tanq_origen', $request->tanq_origen);
        }
        if (isset($request->tanq_unidad)) {
            $inventories->where('tanq_unidad', $request->tanq_unidad);
        }
       
        // $maqn_tipo = 7;

        // dd($inventories->get());
      
        
         $count =$inventories->orderBy('id','DESC')->get();
         $inventories =$inventories->orderBy('id','DESC')->get();
        if (count($count) == 0) {
            Session::flash('info_message', 'No encontramos tados asociados a los parametros establecidos en la busqueda');
           
         }else{
            Session::forget('info_message');
         }
         
            return view('inventories.index', compact('inventories','machines'));
         
      
    }

    public function apiInventory() {

        $inventories = MachineTanking::all();
        return  $inventories;
    }

    public function inventoryControl(Request $request){
        $materialInventory  = Production::query();

        if (isset($request->typeProduction)) {
            $materialInventory->where('typeProduction', $request->typeProduction)->get();
            # code...
        }
        // dd( );
       
        $materialInventory =  $materialInventory->get();
        return view('inventories.inventoryControl',compact('materialInventory'));

    }
}
