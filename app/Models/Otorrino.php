<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otorrino extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="Otorrino";
    protected $primaryKey="id_Otorrino";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"id_Escuela_T",
    	"Nombre_Ot",
    	"Anio"
    ]; 
    
    public $timestamps = false;
}
