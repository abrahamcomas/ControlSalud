<?php

namespace App\Http\Livewire\Fluor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 

class RegistrarFluor extends Component
{
	public $AnioActual;
    public $NombreFluor;
    public $ResultadoVacunas;
    public $Resultado;

    //RENDER
	public $ListaFluor;
	public $ID_Escuela;
	public $Usuario;

	protected $rules = ['NombreFluor' => 'required'];

    protected $messages = [ 'NombreFluor.required' =>'El campo "Nombre Fluor" es obligatorio.'];


    public function Agregar(){

        $this->validate(); 

        //ID ESCUELA
    	$this->Usuario= Auth::user()->id_Funcionario;
    	$this->ID_Escuela =  DB::table('IntFuncEscuela')->where('ID_FuncTabl', '=', $this->Usuario)->get();
    	foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
        } 
        //FIN ID ESCUELA

        $this->AnioActual = date("Y");


        $Existe=DB::table('Fluor')->where('Nombre_F',$this->NombreFluor)
                ->where('Anio',$this->AnioActual)->exists();
  
        if ($Existe==0) 
        { 
	       	$this->ResultadoFluor = DB::insert('insert into Fluor (id_Escuela_T, Nombre_F, Anio) 
	       	values (?,?,?)', [$this->ID_Escuela, $this->NombreFluor, $this->AnioActual]);
	        
	        if ($this->ResultadoFluor) {
	        	$this->NombreFluor='';
	        	$this->Resultado='Vacuna Ingresada Correctamente';

	        }
	        else{
	        	$this->NombreFluor='';
	        	$this->Resultado='Error Ingreso';
	        }
	    }
	    else{
	    	
	    	$this->NombreFluor='';
	    	$this->Resultado='Error, Vacuna Ingresada anteriormente';
	    }    

    }
	
    public function render()
    {
    	//ID ESCUELA
    	$this->Usuario= Auth::user()->id_Funcionario;
    	$this->ID_Escuela =  DB::table('IntFuncEscuela')->where('ID_FuncTabl', '=', $this->Usuario)->get();
    	foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
        } 
        //FIN ID ESCUELA 

    	$this->ListaFluor =  DB::table('Fluor')
        ->where('id_Escuela_T', '=', $this->ID_Escuela)->orderBy('Anio','DESC')->get();

        $this->AnioActual = date("Y");

        return view('livewire.fluor.registrar-fluor');
    }
}
