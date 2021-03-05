<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Alumno";
    protected $primaryKey="id_Alumno";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Funcionario_T",
    	"Nombres",
    	"Apellidos",
    	"Rut",
    	"Telefono",
    	"FechaNac",
    	"Mama",
    	"NumeroMama",
    	"Papa",
    	"NumeroPapa",
    	"ObservacionA"
    ]; 
    
    public $timestamps = false;
}
