<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    = 'servicetypes';
    protected $fillable = ['tise_nombre', 'tise_valor'];
    protected $hidden   = ['id', 'tise_estado', 'created_at', 'updated_at', 'deleted_at'];


    public function getServiceTypeById($id)
    {
        $serviceType = ServiceType::find($id);
        
        return $serviceType;
    }

    public function Service()
    {
        return $this->hasMany('App\Models\Service', 'id', 'id_tiposervicio');
    }

}
