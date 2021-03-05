<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoFluor extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="AlumFluor";
    protected $primaryKey="id_AlumF";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Alumno_T",
    	"id_Fluor_T",
    	"id_Funcionario_T",
    	"Responsable_F",
    	"Aceptada", 
    	"Fecha", 
    	"Observacion"
    ];  
     
    public $timestamps = false;

    public function Fluor()
    {
        return $this->hasOne(Fluor::class,'id_Fluor','id_Fluor_T');
    }
}
