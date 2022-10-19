<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceList extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    =   'pricelists';
    protected $fillable =   ['id_obra', 'id_material', 'precio', 'id_unmedida','priceList_estado','id_user','iva'];
    protected $hidden   =   ['created_at', 'updated_at', 'deleted_at'];


    public function Construction()
    {
        return $this->belongsTo('App\Models\Construction', 'id_obra', 'id');
    }

    public function Material()
    {
        return $this->belongsTo('App\Models\Material', 'id_material', 'id');
    }
    public function Unit()
    {
        return $this->belongsTo('App\Models\Unit', 'id_unmedida', 'id');
    }

}
