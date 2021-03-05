<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fluor extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Fluor";
    protected $primaryKey="id_Fluor"; 

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Escuela_T",
    	"Nombre_F",
    	"Anio",
    	"Observacion_f"
    ]; 
    
    public $timestamps = false;

}
