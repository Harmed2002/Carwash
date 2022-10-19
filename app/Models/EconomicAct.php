<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EconomicAct extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'economicacts';
    protected $fillable = ['acte_codigo', 'acte_nombre', 'acte_estado'];
    protected $hidden = ['acte_id', 'created_at', 'updated_at', 'deleted_at'];


    public function getEconomicActs()
    {
        $economicacts = EconomicAct::select("id", "acte_nombre")->where('acte_estado','A')
                        ->get();
        return $economicacts;
    }

    public function getEconomicActsById($id)
    {
        return EconomicAct::find($id);
    }

}
