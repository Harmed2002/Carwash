<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'employees';
    protected $fillable = ['id_person', 'empl_finicio', 'empl_ffin', 'empl_cargo', 'empl_tiposalario', 'empl_vlrsalario', 'empl_rutafoto', 'empl_estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function getEmployeeById($id)
    {
        //return Employee::find($id);
        $empl = Employee::join("persons", "persons.id", "=", "id_person")
                        ->join("positions", "positions.id", "=", "empl_cargos")
                        ->select("employees.*", "persons.id as idPerson", "pers_identif", "pers_tipoid", "pers_razonsocial", "pers_primernombre", "pers_segnombre",
                            "pers_primerapell", "pers_segapell", "pers_direccion", "pers_telefono", "pers_ciudad", "pers_dpto", "pers_email", "id_user", "posi_nombre")
                        ->where("employees.id", "=", $id)
                        ->get();

        return $empl;
    }

    
    public function Person()
    {
        return $this->belongsTo('App\Models\Person', 'id_person', 'id');
    }

    public function Position()
    {
        return $this->belongsTo('App\Models\Position', 'empl_cargo', 'id');
    }

}
