<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela; 
use App\Models\InterCursoAlum; 
 
class EditarAlumno extends Component
{

	//Curso Seleccionado
	public $ID_Curso;
	public $NombreCursoSel;
	
	//Alumno Seleccionado
	public $ID_Alumno_S;

	//EditarExiste
	public $Editar='0';
	
	//Alumnos Datos
	public $ID_Usuario;
	public $Rut;
    public $Nombres;
	public $Apellidos;
	public $Direccion;
    public $Telefono; 
	public $FechaNacimiento;
	public $Apoderada;
    public $NumeroApoderada;
	public $Apoderado;
	public $NumeroApoderado;
    public $Observacion;
    public $id_ingresado;


	public $ListaAlumnos;
	public $ListaCursos;
    public $Usuario;
	public $Profesores; 
    public $NombreCurso;
    public $Resultado;

    
    public $ID_Escuela;

    protected $rules = ['Rut' => 'required',
						'Nombres' => 'required',
						'Apellidos' => 'required'];

    protected $messages = [ 'Rut.required' =>'El campo "RUT" es obligatorio.',
							'Nombres.required' =>'El campo "Nombres" es obligatorio.',
							'Apellidos.required' =>'El campo "Apellidos" es obligatorio.'];

    
    public function AlumnoSeleccionado()   
    {  
   
	    $Alumno =Alumno::find($this->ID_Alumno_S);
    	
        $this->Nombres          = $Alumno->Nombres;
        $this->Apellidos        = $Alumno->Apellidos;
        $this->Rut  			= $Alumno->Rut;
        $this->Direccion  		= $Alumno->Direccion;
        $this->Telefono         = $Alumno->Telefono;
        $this->FechaNacimiento  = $Alumno->FechaNac;
        $this->Apoderada  		= $Alumno->Mama;
        $this->NumeroApoderada  = $Alumno->NumeroMama;
        $this->Apoderado        = $Alumno->Papa;
        $this->NumeroApoderado  = $Alumno->NumeroPapa;
        $this->Observacion      = $Alumno->ObservacionA;  

		$this->Editar='1';
    }



    public function UpdateAlumno(){

   		$this->validate(); 

        $this->ID_Usuario= Auth::user()->id_Funcionario;

        $this->Alumno                	= Alumno::find($this->ID_Alumno_S);
        $this->Alumno->id_Funcionario_T = $this->ID_Usuario;
        $this->Alumno->Nombres          = $this->Nombres;
        $this->Alumno->Apellidos        = $this->Apellidos;
        $this->Alumno->Rut  			= $this->Rut;
        $this->Alumno->Direccion  		= $this->Direccion;
        $this->Alumno->Telefono         = $this->Telefono;
        $this->Alumno->FechaNac         = $this->FechaNacimiento;
        $this->Alumno->Mama             = $this->Apoderada;
        $this->Alumno->NumeroMama       = $this->NumeroApoderada;
        $this->Alumno->Papa             = $this->Apoderado;
        $this->Alumno->NumeroPapa       = $this->NumeroApoderado;
        $this->Alumno->ObservacionA     = $this->Observacion; 
        $this->Alumno->save();       


        $this->ID_Usuario="";
        $this->Nombres="";
        $this->Apellidos="";
		$this->Rut="";
        $this->Telefono="";
        $this->FechaNacimiento="";
        $this->Apoderada="";
        $this->NumeroApoderada="";
        $this->Apoderado="";
        $this->NumeroApoderado="";
        $this->Observacion="";

        $this->Resultado='Ingreso correctamente';  
        $this->Editar='0';

    }


    public function render()
    {
    	//Mostrar Curso Seleccionado

    	$this->NombreCursoSel =  DB::table('Curso') ->where('id_Curso', '=', $this->ID_Curso)->get();
		
		foreach ( $this->NombreCursoSel as $user){
            $this->NombreCursoSel = $user->Nombre;
        } 


    	$this->ID_Usuario= Auth::user()->id_Funcionario;

        $this->ID_Escuela=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$this->ID_Usuario)->get();

            foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
            } 

    	$this->Usuario= Auth::user()->id_Funcionario;
         
        $this->ListaCursos =  DB::table('Curso') 
        ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
        ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
        ->leftjoin('IntFuncEscuela', 'Escuela.id_Escuela', '=', 'IntFuncEscuela.ID_EscuTabl')
        ->where('IntFuncEscuela.ID_FuncTabl', '=', $this->Usuario)
        ->where('IntFuncEscuela.ActivoAct', '=', '1')->orderBy('Nombre','ASC')->get();

        $this->ListaAlumnos =  DB::table('Alumno') 
        ->leftjoin('InterCursoAlum', 'Alumno.id_Alumno', '=', 'InterCursoAlum.id_Alumno_T')
        ->leftjoin('Curso', 'InterCursoAlum.id_Curso_T', '=', 'Curso.id_Curso')
        ->where('Curso.id_Curso', '=', $this->ID_Curso)->get();

        return view('livewire.mantenedores.editar-alumno');
    }
} 
