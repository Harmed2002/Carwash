<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\State;
use App\Models\City;
use App\Models\Person;
use App\Models\PersonModel;
use App\Models\EmployeeModel;
use App\Models\Position;
/*use Auth;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller {
    /**
     * Creamos el constructor para inyectar la dependencia de la clase City
     * para utilizarlo en los métodos de la clase EmployeeController
     */

     protected $cities;

     public function __construct(City $cities, Position $positions) {

        $this->cities = $cities;
        $this->positions = $positions;

     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = Employee::orderBy('id', 'ASC')->get();
        $states = State::all();
        $positions = Position::all();

        return view('employees.index', ['employees' => $employees, 'states' => $states, 'positions' => $positions]);
    }

    public function Cities($state_id) {
        //return City::where('ciud_coddpto', '=', $state_id)->get();

        $cities = $this->cities->getCities($state_id);
        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $employee = Employee::find($request->id);
        $person = null;

        if (isset($request->show) && $request->show == 'true') {
            return view('employees.show', compact('employee'));

        } else {
            $states = State::all();
            $cities = City::all();
            $positions = Position::all();

            if ($employee) {
                $person =  $employee->Person;
            }

            return view('employees.form', compact('employee', 'states', 'person', 'cities', 'positions'));
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
        $person['pers_identif']         = $request->idEmployee;
        $person['pers_tipoid']          = $request->TipoId;
        $person['pers_razonsocial']     = strtoupper($request->pers_razonsocial);
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

        $validate = PersonModel::getValidator($person, $request->TipoId);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 500);
        }

        // Comienzo la transacción
        DB::beginTransaction();
        try {
            $person = Person::create($person);

            // Creo los datos de Employees
            $employee = [];
            $employee['id_person']          = $person->id;
            $employee['empl_finicio']       = $request->fInicio;
            $employee['empl_ffin']          = $request->fFin;
            $employee['empl_cargo']         = $request->cargo;
            $employee['empl_tiposalario']   = $request->tiposal;
            $salary                         = str_replace(',', '', $request->salario);
            $employee['empl_vlrsalario']    = (int) $salary;

            // Valido si la imagen se cargó
            if($request->hasFile("photo")){
                $photo = $request->file("photo")->store('/employees/');
                $url = Storage::url($photo);

                // Asigno la url al arreglo
                $employee['empl_rutafoto'] = $url;
            }

            //$employee['empl_estado']  = 'A';

            $validate = EmployeeModel::getValidator($employee);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 500);
            }

            Employee::create($employee);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            //return "Error de actulización de datos";
            return $e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $employees = Employee::orderBy('id', 'ASC')->get(); #->paginate(7);
        $states = State::all();
        return view('employees.trEmployee', ['employees' => $employees, 'states' => $states]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $empl
     * @return \Illuminate\Http\Response
     */
    public function  searchEmployee($idPerson) {
        //$empl = Employee::find($request->id);
        $empl = Person::where("pers_identif", "=", $idPerson)->get();
        
        return response()->json(['data' => $empl]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        // Actualizo los datos de Persona
        $personUpd['id']                    = $request->idPerson;
        $personUpd['pers_identif']          = $request->idEmployee;
        $personUpd['pers_tipoid']           = $request->TipoId;
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

            // Actualizo los datos del Empleado
            $employeeUpd = [];
            $employeeUpd['id']                  = $request->idEmpl;
            $employeeUpd['id_person']           = $request->idPerson;
            $employeeUpd['empl_finicio']        = $request->fInicio;
            $employeeUpd['empl_ffin']           = $request->fFin;
            $employeeUpd['empl_cargo']          = $request->cargo;
            $employeeUpd['empl_tiposalario']    = $request->tiposal;
            $salary                             = str_replace(',', '', $request->salario);
            $employeeUpd['empl_vlrsalario']     = (int) $salary;

            // Valido si la imagen se cargó
            if($request->hasFile("photo")){
                $photo = $request->file("photo")->store('/employees/');
                $url = Storage::url($photo);

                // Asigno la url al arreglo
                $employeeUpd['empl_rutafoto'] = $url;
            }

            $validate = EmployeeModel::getValidator($employeeUpd);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 500);
            }

            $employee = EmployeeModel::getEmployee($request->idEmpl);
            $employee->update($employeeUpd);

            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            //return "Error de actulización de datos";
            //return $e->getMessage();
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado
        $employees = Employee::orderBy('id', 'ASC')->get(); #->paginate(7);
        $states = State::all();
        return view('employees.trEmployee', ['employees' => $employees, 'states' => $states]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        //dd($request->all());
        $empl = Employee::find($request->id);
        $empl->empl_estado ='I';

        try {
            $empl->save();
            $empl->delete();
        } catch (\Exception $e){
            return response()->$e->getMessage();
        }

        // Obtengo los datos nuevamente para mostrarlos en el listado de empleados
        $employees = Employee::orderBy('id', 'ASC')->get();

        $states = State::all();
        $positions = Position::all();
        return view('employees.trEmployee', ['employees' => $employees, 'states' => $states, 'positions' => $positions]);
    }
}
