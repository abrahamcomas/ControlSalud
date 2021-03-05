<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermediaProfesoresEsc extends Model
{
    use HasFactory;
     //referencia a una tabla
    protected $table="IntermediaProfesorEsc";
    protected $primaryKey="id";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "id_profesor",
        "id_escuela"
    ]; 
}
