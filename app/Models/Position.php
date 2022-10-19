<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'positions';
    protected $fillable = ['posi_nombre'];
    protected $hidden = ['id', 'posi_estado', 'created_at', 'updated_at', 'deleted_at'];

    public function getPositions()
    {
        //return Position::all();
        // $positions = Position::join("persons", "id", "=", "id_person")
        //             ->select("*")
        //             ->get();
        // return $positions;
    }

    public function getPositionById($id)
    {
        $position = Position::find($id);
        
        //dd($position);
        return $position;
    }

    public function Employee()
    {
        return $this->hasMany('App\Models\Employee', 'id', 'empl_cargo');
    }

}
