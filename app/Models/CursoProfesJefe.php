<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoProfesJefe extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="CursoProfesJefe";
    protected $primaryKey="ID_CursoProfJefe";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "Activo",
    	"Anio",
    	"Id_Curso",
    	"Id_Profesor_Jefe"
    ]; 
    
    public $timestamps = false;
}
