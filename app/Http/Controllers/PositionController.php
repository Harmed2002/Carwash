<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\PositionModel;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PositionController extends Controller {

    public function index() {
        $positions = Position::orderBy('id', 'ASC')->get();

        return view('positions.index', ['positions' => $positions]);
    }


    public function create(Request $request) {
        $position = Position::find($request->id);

        if (isset($request->show) && $request->show == 'true') {
            return view('positions.show', compact('position'));
        } else {
            return view('positions.form', compact('position'));
        }
    }

    
    public function store(Request $request) {
        //dd($request->all());
        $position                   = [];
        $position['id']             = $request->id;
        $position['posi_nombre']    = strtoupper($request->nombre);

        $validate = PositionModel::getValidator($position);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            Position::create($position);
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $positions = Position::orderBy('id', 'ASC')->get();
        return view('positions.trPosition', ['positions' => $positions]);

    }


    public function update(Request $request) {
        //dd($request->all());
        $positionUpd                   = [];
        $positionUpd['id']             = $request->id;
        $positionUpd['posi_nombre']    = strtoupper($request->nombre);

        $validate = PositionModel::getValidator($positionUpd);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            $position = PositionModel::getPosition($request->id);
            $position->update($positionUpd);
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $positions = Position::orderBy('id', 'ASC')->get();
        return view('positions.trPosition', ['positions' => $positions]);

    }

    
    public function destroy(Request $request) {
        //dd($request->all());
        $position = Position::find($request->id);
        $position->posi_estado ='I';

        try {
            $position->save();
            $position->delete();
        } catch (\Exception $e){
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $positions = Position::orderBy('id', 'ASC')->get();
        return view('positions.trPosition', ['positions' => $positions]);
    }
}
