<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterCursoAlum extends Model
{
    use HasFactory;

     //referencia a una tabla
    protected $table="InterCursoAlum";
   	protected $primaryKey="id_intercurso";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Alumno_T",
    	"id_Curso_T"
    ]; 
    
    public $timestamps = false;
}
