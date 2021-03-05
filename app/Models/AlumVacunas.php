<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumVacunas extends Model
{
    use HasFactory;

     //referencia a una tabla
    protected $table="AlumVacunas";
    protected $primaryKey="id_AlumV";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Alumno_T",
    	"id_vacunas_T",
    	"id_Funcionario_T",
    	"Responsable_V",
    	"Aceptada", 
    	"Fecha",
    	"Observacion"
    ]; 
    
    public $timestamps = false;

    public function Vacunas()
    {
        return $this->hasOne(Vacunas::class,'id_vacunas','id_vacunas_T');
    }
}
