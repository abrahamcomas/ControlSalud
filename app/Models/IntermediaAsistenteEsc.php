<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermediaAsistenteEsc extends Model
{
    use HasFactory;

    //referencia a una tabla
    protected $table="IntermediaAsistenteEsc";
    protected $primaryKey="id";

    //pongo los caampos para permitir insert multiple
    protected $fillable=[
        "id_asistente",
    	"id_escuela"
    ]; 
    
    public $timestamps = false;
}
