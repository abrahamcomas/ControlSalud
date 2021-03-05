<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoOtorrino extends Model
{
    use HasFactory;
    
    //referencia a una tabla
    protected $table="AlumnoOtorrino";
    protected $primaryKey="id_AlumOt";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Alumno_T",
    	"id_Otorrino_T",
    	"id_Funcionario_T",
    	"Responsable_OT",
    	"Aceptada", 
    	"Fecha", 
    	"Observacion"
    ];  
     
    public $timestamps = false;

    public function Otorrino()
    {
        return $this->hasOne(Otorrino::class,'id_Otorrino','id_Otorrino_T');
    }
}
