<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oftalmologo extends Model
{
    use HasFactory;
     //referencia a una tabla
    protected $table="Oftalmologo";
    protected $primaryKey="id_oftalmologo";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Escuela_T",
    	"Nombre_O",
    	"Anio",
    	"Observacion_O"
    ]; 
    
    public $timestamps = false;
}
