<?php

namespace App\Http\Livewire\Vacunas;
 
use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 

class RegistrarVacuna extends Component
{

    public $AnioActual;
    public $NombreVacuna;
    public $ResultadoVacunas;
    public $Resultado;

    //RENDER
	public $ListaVacunas;
	public $ID_Escuela;
	public $Usuario;

	protected $rules = ['NombreVacuna' => 'required'];

    protected $messages = [ 'NombreVacuna.required' =>'El campo "Nombre Vacuna" es obligatorio.'];


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


        $Existe=DB::table('vacunas')->where('Nombre_V',$this->NombreVacuna)
                ->where('Anio',$this->AnioActual)->exists();
  
        if ($Existe==0) 
        { 
	       	$this->ResultadoVacunas = DB::insert('insert into vacunas (id_Escuela_T, Nombre_V, Anio) 
	       	values (?, ?,?)', [$this->ID_Escuela, $this->NombreVacuna, $this->AnioActual]);
	        
	        if ($this->ResultadoVacunas) {
	        	$this->NombreVacuna='';
	        	$this->Resultado='Vacuna Ingresada Correctamente';

	        }
	        else{
	        	$this->NombreVacuna='';
	        	$this->Resultado='Error Ingreso';
	        }
	    }
	    else{
	    	
	    	$this->NombreVacuna='';
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

    	$this->ListaVacunas =  DB::table('vacunas')
        ->where('id_Escuela_T', '=', $this->ID_Escuela)->orderBy('Anio','DESC')->get();

        $this->AnioActual = date("Y");
       
        return view('livewire.vacunas.registrar-vacuna');
    }
}
