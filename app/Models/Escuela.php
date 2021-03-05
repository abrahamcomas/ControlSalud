<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

     //referencia a una tabla
    protected $table="Escuela";
    protected $primaryKey="id_Escuela";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"NombreEscuela",
    	"Direccion",
    	"Region"
    ]; 
    
    public $timestamps = false;
}
