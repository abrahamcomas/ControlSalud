<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosModel extends Model
{
    use HasFactory;

     //referencia a una tabla
    protected $table="Curso";
    protected $primaryKey="id_Curso";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"Nombre",
    	"AnioCurso"
    ]; 
    
    public $timestamps = false;
}
