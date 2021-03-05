<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="vacunas";
    protected $primaryKey="id_vacunas";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Escuela_T",
    	"Nombre_V",
    	"Anio"
    ]; 
    
    public $timestamps = false;

}
