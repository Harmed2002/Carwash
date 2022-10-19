<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'units';
    protected $fillable = ['unit_sigla', 'unit_descripcion', 'unit_estado'];
    protected $hidden = ['id'];

    public function getUnits()
    {
        $units = Unit::select("*")->where('unit_estado','A')
                        ->get();
        //dd($units);
        return $units;
    }

    public function getUnitById($id)
    {
        return Unit::find($id);
    }

    public function Machine()
    {
        return $this->hasMany('App\Models\Machine', 'id', 'maqn_idunidad');
    }

    public function RemissionDetail()
    {
        return $this->hasMany('App\Models\RemissionDetail', 'id', 'unit_id');
    }
}
