<?php

namespace App\Models;

/*use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    /*use HasFactory;*/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'suppliers';
    protected $fillable = ['id_person', 'id_codactividad', 'prov_estado', 'codeVerification'];
    protected $hidden = ['prov_id', 'created_at', 'updated_at', 'deleted_at'];


    public function getSupplierById($id)
    {
        return Supplier::find($id);
    }


    /* Mutator for Digito de verificación */
    public function setCodeVerificationAttribute($nit)
    {
        $result = 0;
        $lengthNit = strlen($nit);

        if ($lengthNit >= 9){
            //$array          = $nit.split('');
            $array          = str_split($nit);
            $lengthArray    = count($array);
            $sum            = 0;
            $arraySeriel    = array(41, 37, 29, 23, 19, 17, 13, 7, 3);

            for ($index = 0; $index < $lengthArray; $index++) {

                $element =  $array[$index] * $arraySeriel[$index];
                $sum += $element;
            }

            $div        =  $sum / 11;
            $decPart    = $div - floor($div);
            $mul        = round($decPart * 11);

            if ($mul == 0 || $mul == 1) {
                $result = $mul;
            }else{
                $result = 11 - $mul;
            }

            $this->attributes['codeVerification'] = $result;
    
        }else{
    
            $this->attributes['codeVerification'] = '';
        }
    }


    public function Person()
    {
        return $this->belongsTo('App\Models\Person', 'id_person', 'id');
    }

}
