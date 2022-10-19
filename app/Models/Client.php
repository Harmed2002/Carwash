<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'clients';
    protected $fillable = ['id_person', 'clie_dircorresp', 'clie_rutafoto', 'client_estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function getClientById($id)
    {
        //return Client::find($id);
        $client = Client::join("persons", "persons.id", "=", "id_person")
                    ->select("clients.*", "persons.id as idPerson", "pers_identif", "pers_tipoid", "pers_razonsocial", "pers_primernombre", "pers_segnombre",
                    "pers_primerapell", "pers_segapell", "pers_direccion", "pers_telefono", "pers_ciudad", "pers_dpto", "pers_email", "id_user")
                    ->where("clients.id", "=", $id)
                    ->get();

        return $client;

    }

    public function Person()
    {
        return $this->belongsTo('App\Models\Person', 'id_person', 'id');
    }

    public function Vehicle()
    {
        return $this->hasMany('App\Models\Vehicle', 'id', 'id_propietario');
    }

}
