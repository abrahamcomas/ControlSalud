<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumOftalmologo extends Model
{
    use HasFactory;

     //referencia a una tabla
    protected $table="AlumOftalmologo";
    protected $primaryKey="id_AlumO";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Alumno_T",
    	"id_Oftalmologo_T",
    	"id_Funcionario_T",
    	"Responsable_O",
    	"Aceptada", 
    	"Fecha", 
    	"Observacion"
    ];  
    
    public $timestamps = false;

    public function Oftalmologo()
    {
        return $this->hasOne(Oftalmologo::class,'id_oftalmologo','id_Oftalmologo_T');
    }
}
