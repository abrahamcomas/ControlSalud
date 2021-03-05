<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistentes extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Asistentes";
    protected $primaryKey="ID_Asistente";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"NombreAsistente",
    	"ApellidoAsistente",
    	"Rut"
    ]; 
    
    public $timestamps = false;
}
