<?php

namespace App\Http\Livewire\Oftalmologo;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 

class RegistrarOftalmologo extends Component
{
    public $AnioActual;
    public $Resultado; 
  	public $NombreOftalmologo;
  	public $ResultadoOftalmologo;
  	public $ObservacionOftalmologo;
	
	protected $rules = ['NombreOftalmologo' => 'required'];

    protected $messages = [ 'NombreOftalmologo.required' =>'El campo "Nombre Oftalmologo" es obligatorio.'];

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


        $Existe=DB::table('Oftalmologo')->where('Nombre_O',$this->NombreOftalmologo)
                ->where('Anio',$this->AnioActual)->exists();
  
        if ($Existe==0) 
        { 
	       	$this->ResultadoOftalmologo = DB::insert('insert into Oftalmologo (id_Escuela_T, Nombre_O, Anio,Observacion_O) 
	       	values (?,?,?,?)', [$this->ID_Escuela, $this->NombreOftalmologo, $this->AnioActual,$this->ObservacionOftalmologo]);
	        
	        if ($this->ResultadoOftalmologo) {
	        	$this->NombreOftalmologo='';
	        	$this->ObservacionOftalmologo='';
	        	$this->Resultado='Oftalmologo Ingresado Correctamente';

	        }
	        else{
	        	$this->NombreOftalmologo='';
	        	$this->ObservacionOftalmologo='';
	        	$this->ResultadoOftalmologo='Error Ingreso';
	        }
	    }
	    else{
	    	
	    	$this->NombreOftalmologo='';
	    	$this->ObservacionOftalmologo='';
	    	$this->ResultadoOftalmologo='Error, Oftalmologo Ingresado anteriormente';
	    }

            

    }
	
	
	
	//RENDER
	public $ListaOftalmologos;
	public $ID_Escuela;
	public $Usuario;
    public function render()
    {
    	//ID ESCUELA
    	$this->Usuario= Auth::user()->id_Funcionario;
    	$this->ID_Escuela =  DB::table('IntFuncEscuela')->where('ID_FuncTabl', '=', $this->Usuario)->get();
    	foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
        } 
        //FIN ID ESCUELA

    	$this->ListaOftalmologos =  DB::table('Oftalmologo')
        ->where('id_Escuela_T', '=', $this->ID_Escuela)->orderBy('Anio','DESC')->get();

        $this->AnioActual = date("Y");
       
        return view('livewire.oftalmologo.registrar-oftalmologo');
    }
}
