<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use App\Models\ProfesoresJefes; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 

class EditarProfesores extends Component
{
	public $ID_Seleccionado;
	public $Nombre_Prof;
	public $Apellido_Prof;
	public $Rut;

	public $Existe;
	
	protected $rules = ['Nombre_Prof' => 'required',
						'Apellido_Prof' => 'required',
						'Rut' => 'required'];

	protected $messages = [ 'Nombre_Prof.required' =>'El campo "Nombre" es obligatorio.',
							'Apellido_Prof.required' =>'El campo "Apellido" es obligatorio.',
							'Rut.required' =>'El campo "Rut" es obligatorio.'];




	protected $Update = ['ID_Seleccionado' => 'required'];
	
	protected $UpdateMessages = ['ID_Seleccionado.required' =>'El campo "Lista" es obligatorio.'];



 	public $Resultado; 
 	public $Profesores;
	
	public $Profesor; 
	
	
	public function update()   
    { 		$this->validate(); 
        	
  		$Existe=DB::table('Profesores')->where('Rut',$this->Rut)->count();
  
        if ($Existe<=1)  
        { 
        	$user =ProfesoresJefes::find($this->ID_Seleccionado);
			$user->Nombre_Prof		=$this->Nombre_Prof;
			$user->Apellido_Prof	=$this->Apellido_Prof;
			$user->Rut				=$this->Rut;
            $user->save();

            $this->Resultado='Actualización Ingresada';
	 	}
        else{
                $this->Resultado='Error en ingreso, "RUT Ingresado Anteriormente"';
        }
    } 

	public function ProfesorSeleccionado()   
    { 
    	$this->validate($this->Update,$this->UpdateMessages); 
   
	    $Profesor =ProfesoresJefes::find($this->ID_Seleccionado);
	    $this->Nombre_Prof	 =$Profesor->Nombre_Prof;
		$this->Apellido_Prof =$Profesor->Apellido_Prof; 
		$this->Rut		     =$Profesor->Rut;
    }

 

    public function render()
    {
    	$this->ID_Usuario= Auth::user()->id_Funcionario;

        $this->ID_Escuela=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$this->ID_Usuario)->get();

        foreach ( $this->ID_Escuela as $user){
            
            $this->ID_Escuela = $user->ID_EscuTabl;
        
        } 
 

    	$this->Profesores=DB::table('Profesores')
    	->leftjoin('IntermediaProfesorEsc', 'Profesores.id_Profesores', '=', 'IntermediaProfesorEsc.id_profesor')
    	->orderBy('Nombre_Prof','ASC')->get();
       
    	$this->Existe=DB::table('Profesores')->where('Rut',$this->Rut)->count();

        return view('livewire.mantenedores.editar-profesores');
    }
}
