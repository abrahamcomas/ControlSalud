<?php

namespace App\Http\Livewire\Mantenedores;
 
use Livewire\Component; 
use App\Models\ProfesoresJefes; 
use App\Models\IntermediaProfesoresEsc; 
use App\Models\Escuela; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class AgregarProfesoresJefes extends Component
{
	public $Profesores;
	
	public $NombrePorfesor;
	public $ApellidoProfesor;
	public $RutProfesor;

	public $ID_Usuario;
	public $ID_Escuela;
	
	public $Profesor; 
	public $id_ingresado;

	public $Resultado; 
 
	protected $rules = ['NombrePorfesor' => 'required',
						'ApellidoProfesor' => 'required',
						'RutProfesor' => 'required'];

	protected $messages = [ 'NombrePorfesor.required' =>'El campo "Nombre" es obligatorio.',
							'ApellidoProfesor.required' =>'El campo "Apellido" es obligatorio.',
							'RutProfesor.required' =>'El campo "Rut" es obligatorio.'];

 

	public function Agregar(){

		$this->validate(); 
		
		$Existe=DB::table('Profesores')->where('Rut', $this->RutProfesor)->exists();
  
   		if ($Existe==0) 
        {
        	
			$this->Profesor 				= new ProfesoresJefes;
	        $this->Profesor->Nombre_Prof 	= $this->NombrePorfesor;
	        $this->Profesor->Apellido_Prof  = $this->ApellidoProfesor;
	        $this->Profesor->Rut 			= $this->RutProfesor;
	        $this->Profesor->save();

	        $this->id_ingresado = $this->Profesor->id_Profesores; 

	        $this->ID_Usuario= Auth::user()->id_Funcionario;

			$this->ID_Escuela=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$this->ID_Usuario)->get();



        	foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl; 
        	} 

	        $this->IntermediaProfesoresEsc 				= new IntermediaProfesoresEsc;
	        $this->IntermediaProfesoresEsc->id_profesor = $this->id_ingresado;
	        $this->IntermediaProfesoresEsc->id_escuela  = $this->ID_Escuela;
	        $this->IntermediaProfesoresEsc->save();	

	        $this->Resultado='Ingreso correctamente';

	        $this->RutProfesor='';
	        $this->NombrePorfesor='';
	        $this->ApellidoProfesor='';
		}
		else{
				$this->Resultado='Error en ingreso';
		}

			$this->ProfesorIngr='';

	}

    public function render()
    {
    	$this->Profesores=DB::table('Profesores')->orderBy('Nombre_Prof','ASC')->get();


			


        
        return view('livewire.mantenedores.agregar-profesores-jefes');
    }
}
