<?php

namespace App\Http\Livewire\Otorrino;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 

class RegistrarOtorrino extends Component
{
	public $AnioActual;
    public $NombreOtorrino;
    public $ResultadoOtorrino;
    public $Resultado;

    //RENDER
	public $ListaOtorrinos;
	public $ID_Escuela;
	public $Usuario;

	protected $rules = ['NombreOtorrino' => 'required'];

    protected $messages = [ 'NombreOtorrino.required' =>'El campo "Nombre Otorrino" es obligatorio.'];


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


        $Existe=DB::table('Otorrino')->where('NombreOt',$this->NombreOtorrino)
                ->where('Anio',$this->AnioActual)->exists();
  
        if ($Existe==0) 
        { 
	       	$this->ResultadoOtorrino = DB::insert('insert into Otorrino (id_Escuela_T, NombreOt, Anio) 
	       	values (?,?,?)', [$this->ID_Escuela, $this->NombreOtorrino, $this->AnioActual]);
	        
	        if ($this->ResultadoOtorrino) {
	        	$this->NombreOtorrino='';
	        	$this->Resultado='Otorrino Ingresado Correctamente';

	        }
	        else{
	        	$this->NombreOtorrino='';
	        	$this->Resultado='Error Ingreso';
	        }
	    }
	    else{
	    	
	    	$this->NombreOtorrino='';
	    	$this->Resultado='Error, Otorrino Ingresado anteriormente';
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

    	$this->ListaOtorrinos =  DB::table('Otorrino')
        ->where('id_Escuela_T', '=', $this->ID_Escuela)->orderBy('Anio','DESC')->get();

        $this->AnioActual = date("Y");
        return view('livewire.otorrino.registrar-otorrino');
    }
}
