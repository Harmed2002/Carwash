<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierModel;
use App\Models\State;
use App\Models\City;
use App\Models\Person;
use App\Models\PersonModel;
use App\Models\EconomicAct;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SupplierController extends Controller {
    /**
     * Creamos el constructor para inyectar la dependencia de la clase Supplier
     * para utilizarlo en los métodos de la clase SupplierController
     */
    protected $suppliers;
    protected $states;
    protected $cities;
    protected $economicacts;

    public function __construct(Supplier $suppliers, State $states, City $cities, EconomicAct $economicacts) {
        $this->suppliers = $suppliers;
        $this->states = $states;
        $this->cities = $cities;
        $this->economicacts = $economicacts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $suppliers = Supplier::orderBy('id', 'ASC')->get();

        // LLamo el mutator que me da el DV
        foreach ($suppliers as $supplier) {
            $supplier->codeVerification = $supplier->Person->pers_identif;
        }

        $states = State::all();
        $economicacts = $this->economicacts->getEconomicActs();
        //dd($economicacts);
        return view('suppliers.index', ['suppliers' => $suppliers, 'states' => $states, 'economicacts' => $economicacts]);
    }

    public function Cities($state_id) {
        $cities = $this->cities->getCities($state_id);

        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $supplier = Supplier::find($request->id);
        $person = null;

        if (isset($request->show) && $request->show == 'true') {
            return view('suppliers.show', compact('supplier'));

        } else {
            $states = State::all();
            $cities = City::all();
            $economicacts = $this->economicacts->getEconomicActs();
            if ($supplier) {
                $person = $supplier->Person;
            }
        
            return view('suppliers.form', compact('supplier', 'states', 'economicacts', 'person','cities'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
        // Creo los datos de Persona
        $person = [];
        $person['id']                   = '';
        $person['pers_identif']         = $request->idProv;
        $person['pers_tipoid']          = $request->TipoId;
        $person['pers_razonsocial']     = strtoupper($request->rSocial);
        $person['pers_primernombre']    = strtoupper($request->Nom1);
        $person['pers_segnombre']       = strtoupper($request->Nom2);
        $person['pers_primerapell']     = strtoupper($request->Apell1);
        $person['pers_segapell']        = strtoupper($request->Apell2);
        $person['pers_direccion']       = strtoupper($request->dir);
        $person['pers_telefono']        = strtoupper($request->tel);
        $person['ciud_id']              = (int) $request->ciudad;
        $person['dpto_id']              = (int) $request->dpto;
        $person['pers_email']           = strtoupper($request->eMail);
        $person['id_user']              = Auth::id();

        $validatePerson = PersonModel::getValidator($person, $request->TipoId);

        if ($validatePerson->fails()) {
            return response()->json(['errors' => $validatePerson->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {

            $person = Person::create($person);

            // Creo los datos de Supplier
            $supplier = [];
            $supplier['id_person']        = $person->id;
            $supplier['id_codactividad']  = $request->actEcon;

            $validate = SupplierModel::getValidator($supplier);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 500);
            }

            Supplier::create($supplier);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        
        // Obtengo los datos nuevamente para mostrarlos en el listado
        $suppliers = Supplier::orderBy('id', 'ASC')->get();
        $states = State::all();
        $economicacts = $this->economicacts->getEconomicActs();

        return view('suppliers.trSupplier', ['suppliers' => $suppliers, 'states' => $states, 'economicacts' => $economicacts]);
    }

    public function update(Request $request) {
        // Actualizo los datos de Persona
        $personUpd['id']                    = $request->idPerson;
        $personUpd['pers_identif']          = $request->idProv;
        $personUpd['pers_tipoid']           = $request->TipoId;
        $personUpd['pers_razonsocial']      = strtoupper($request->rSocial);
        $personUpd['pers_primernombre']     = strtoupper($request->Nom1);
        $personUpd['pers_segnombre']        = strtoupper($request->Nom2);
        $personUpd['pers_primerapell']      = strtoupper($request->Apell1);
        $personUpd['pers_segapell']         = strtoupper($request->Apell2);
        $personUpd['pers_direccion']        = strtoupper($request->dir);
        $personUpd['pers_telefono']         = strtoupper($request->tel);
        $personUpd['ciud_id']               = (int) $request->ciudad;
        $personUpd['dpto_id']               = (int) $request->dpto;
        $personUpd['pers_email']            = strtoupper($request->eMail);

        $validate = PersonModel::getValidator($personUpd, $request->TipoId);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        $person = PersonModel::getPerson($request->idPerson);

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            $person->update($personUpd);

            // Actualizo los datos del Proveedor
            $supplierUpd = [];
            $supplierUpd['id_person']        = $person->id;
            $supplierUpd['id_codactividad']  = $request->actEcon;

            $validate = SupplierModel::getValidator($supplierUpd);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 500);
            }

            $supplier = SupplierModel::getSupplier($request->idSupplier);
            $supplier->update($supplierUpd);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $suppliers = Supplier::orderBy('id', 'ASC')->get();
        $states = State::all();
        $economicacts = $this->economicacts->getEconomicActs();

        return view('suppliers.trSupplier', ['suppliers' => $suppliers, 'states' => $states, 'economicacts' => $economicacts]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $supplier = Supplier::find($request->idSupplier);
        $supplier->prov_estado = 'I';

        try {
            $supplier->save();
            $supplier->delete();
        } catch (\Exception $e){
            return response()->$e->getMessage();
        }

        $suppliers = Supplier::orderBy('id', 'ASC')->get();
        $states = State::all();
        $economicacts = $this->economicacts->getEconomicActs();

        return view('suppliers.trSupplier', ['suppliers' => $suppliers, 'states' => $states, 'economicacts' => $economicacts]);

    }

    public function searchEconomica(Request $request)
    {
        $actEconomic= EconomicAct::where('acte_nombre','like','%'.$request['search'].'%')->select('acte_nombre','id')->limit(10)->get();
        return response()->json($actEconomic);
    }

    public function  searchSupplier($idPerson) {
        $supl = Person::where("pers_identif", "=", $idPerson)->get();
        
        return response()->json(['data' => $supl]);
    }
}
