<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesoresJefes extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Profesores";
    protected $primaryKey="id_Profesores";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "Nombre_Prof",
        "Apellido_Prof",
        "Rut"
    ]; 
}
