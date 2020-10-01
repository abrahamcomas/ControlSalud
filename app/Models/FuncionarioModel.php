<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class FuncionarioModel extends Model
{
    //referencia a una tabla
    protected $table="Funcionario";
    protected $primaryKey="id_Funcionario";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
    	"Activo",
    	"Rut",
    	"Nombre",
        "Apellido", 
        "Email", 
        "password",
        "CorreoActivo"

    ]; 
    
    public $timestamps = false;
}
