<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intermediaEscuela extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="intermediaEscuela";
    protected $primaryKey="id_Escuela_int";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "Id_Curso_Esc",
        "Tabla_Escuela"
    ]; 
}
