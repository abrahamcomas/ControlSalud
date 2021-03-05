<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Asistentes; 
use App\Models\IntermediaAsistenteEsc; 
 
class AgregarAsistentes extends Component
{
	//Curso Seleccionado
	public $ID_Curso;
	public $NombreCursoSel;
	
	//Alumnos Asistentes
	public $Rut;
    public $Nombres;
	public $Apellidos;

	public $ListaAsistentes;

    public $Resultado;

    
    public $ID_Escuela;

    protected $rules = ['Rut' => 'required',
                        'Nombres' => 'required',
                        'Apellidos' => 'required'];

    protected $messages = [ 'Rut.required' =>'El campo "Rut" es obligatorio.',
                            'Nombres.required' =>'El campo "Nombres" es obligatorio.',
                            'Apellidos.required' =>'El campo "Apellidos" es obligatorio.'];

    public function AgregarAsistentes(){

    // $this->validate(); 

    $Existe=DB::table('Asistentes')->where('Rut',$this->Rut)->exists();
  
        if ($Existe==0)  
        { 

            $this->Asistentes                		= new Asistentes;  
            $this->Asistentes->NombreAsistente 		= $this->Nombres;
            $this->Asistentes->ApellidoAsistente    = $this->Apellidos;
            $this->Asistentes->Rut  				= $this->Rut;
            $this->Asistentes->save();       

            $this->id_ingresado = $this->Asistentes->ID_Asistente; 

            $this->ID_Usuario= Auth::user()->id_Funcionario;

       		$this->ID_Escuela=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$this->ID_Usuario)->get();

            foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
            } 
 
            $this->CursoAlumno              = new IntermediaAsistenteEsc; 
            $this->CursoAlumno->id_asistente = $this->id_ingresado;
            $this->CursoAlumno->id_escuela  = $this->ID_Escuela;
            $this->CursoAlumno->save();  

            $this->Nombres="";
            $this->Apellidos="";
   			$this->Rut="";


            $this->Resultado='Ingreso correctamente';

        
        }
        else{
            $this->Resultado='Error en ingreso';
        }

    }
	
    public function render()
    {  

    	$this->ID_Usuario= Auth::user()->id_Funcionario;

       		$this->ID_Escuela=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$this->ID_Usuario)->get();

            foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
            } 
    

  $this->ListaAsistentes =  DB::table('Asistentes') 
				->leftjoin('IntermediaAsistenteEsc', 'Asistentes.ID_Asistente', '=', 'IntermediaAsistenteEsc.id_asistente')
				->leftjoin('Escuela', 'IntermediaAsistenteEsc.id_escuela', '=', 'Escuela.id_Escuela')
    			->where('Escuela.id_Escuela', '=', $this->ID_Escuela)->get();

        return view('livewire.mantenedores.agregar-asistentes');
    }
}
