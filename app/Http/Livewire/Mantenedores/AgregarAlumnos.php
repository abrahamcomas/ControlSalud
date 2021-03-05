<?php

namespace App\Http\Livewire\Mantenedores;
 
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela; 
use App\Models\InterCursoAlum; 

class AgregarAlumnos extends Component
{

	//Curso Seleccionado
	public $ID_Curso;
	public $NombreCursoSel;
	
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
    public $NombreCurso;
    public $Anio;
    public $id_Profesores;
    public $Resultado;
    public $ID_Escuela;

    protected $rules = ['Rut' => 'required',
                        'Nombres' => 'required',
                        'Apellidos' => 'required'];

    protected $messages = [ 'Rut.required' =>'El campo "Rut" es obligatorio.',
                            'Nombres.required' =>'El campo "Nombres" es obligatorio.',
                            'Apellidos.required' =>'El campo "Apellidos" es obligatorio.'];

    public function AgregarAlumno(){

    $this->validate(); 

    $Existe=DB::table('Alumno')->where('Rut',$this->Rut)->where('Vigente','1')->exists();
  
        if ($Existe==0)  
        { 
            $this->ID_Usuario= Auth::user()->id_Funcionario;

            $this->Alumno                	= new Alumno; 
            $this->Alumno->id_Funcionario_T = $this->ID_Usuario;
            $this->Alumno->Nombres          = $this->Nombres;
            $this->Alumno->Apellidos        = $this->Apellidos;
            $this->Alumno->Rut  			= $this->Rut;
            $this->Alumno->Direccion        = $this->Direccion;
            $this->Alumno->Telefono         = $this->Telefono;
            $this->Alumno->FechaNac         = $this->FechaNacimiento;
            $this->Alumno->Mama             = $this->Apoderada;
            $this->Alumno->NumeroMama       = $this->NumeroApoderada;
            $this->Alumno->Papa             = $this->Apoderado;
            $this->Alumno->NumeroPapa       = $this->NumeroApoderado;
            $this->Alumno->ObservacionA      = $this->Observacion; 
            $this->Alumno->Vigente          = '1';
            $this->Alumno->save();       

            $this->id_ingresado = $this->Alumno->id_Alumno; 
 
            $this->CursoAlumno              = new InterCursoAlum; 
            $this->CursoAlumno->id_Alumno_T = $this->id_ingresado;
            $this->CursoAlumno->id_Curso_T  = $this->ID_Curso;
            $this->CursoAlumno->save();  

            $this->ID_Usuario="";
            $this->Nombres="";
            $this->Apellidos="";
   			$this->Rut="";
            $this->Direccion="";
            $this->Telefono="";
            $this->FechaNacimiento="";
            $this->Apoderada="";
            $this->NumeroApoderada="";
            $this->Apoderado="";
            $this->NumeroApoderado="";
            $this->Observacion="";

             $this->Resultado='Ingreso correctamente';

        
        }
        else{
                $this->Resultado='Error en ingreso';
        }

            $this->ProfesorIngr='';

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

        return view('livewire.mantenedores.agregar-alumnos');
    }
}
