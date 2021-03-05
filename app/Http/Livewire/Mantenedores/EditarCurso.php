<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\CursosModel; 
use App\Models\intermediaEscuela; 
use App\Models\CursoProfesJefe; 

class EditarCurso extends Component
{
	//Curso Seleccionado
    public $ID_Curso;

    //Actualizacion Curso
    public $Nombre;
    public $id_Profesores;

    //Actualizacion Profesor Jefe
	public $ListaCursos;
    public $Usuario;
	public $Profesores; 
    public $Resultado;
    public $id_ingresado;
    public $ID_Escuela;

    public $Editar;
  

    protected $rules = ['Nombre' => 'required',
                        'id_Profesores' => 'required'];

    protected $messages = [ 'NombreCurso.required' =>'El campo "Nombre Curso" es obligatorio.',
                            'id_Profesores.required' =>'El campo "Profesor Jefe" es obligatorio.'];

   
    public function CursoSeleccionado()   
    {  
   
        $Alumno =CursosModel::find($this->ID_Curso);
        $this->Nombre          = $Alumno->Nombre;
        $this->Editar='1';
    }


    public function UpdateCurso(){

        $this->validate(); 

        $AnioActual = date("Y");

    
            $this->Curso           = CursosModel::find($this->ID_Curso);
            $this->Curso->Nombre    = $this->Nombre;
            $this->Curso->AnioCurso = $AnioActual;
            $this->Curso->save();

             $this->PorfeJefe =  DB::update('update CursoProfesJefe
                                            set Id_Profesor_Jefe = ?',[$this->id_Profesores],
                                            'where Id_Curso = ?',[$this->ID_Curso]);


            $this->Resultado='Ingreso correctamente';

   

    }

    public function render()
    {
    	$this->Usuario= Auth::user()->id_Funcionario;
          
        $this->ListaCursos =  DB::table('Curso') 
        ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
        ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
        ->leftjoin('IntFuncEscuela', 'Escuela.id_Escuela', '=', 'IntFuncEscuela.ID_EscuTabl')
        ->leftjoin('CursoProfesJefe', 'Curso.id_Curso', '=', 'CursoProfesJefe.Id_Curso')
        ->leftjoin('Profesores', 'CursoProfesJefe.Id_Profesor_Jefe', '=', 'Profesores.id_Profesores')
        ->where('IntFuncEscuela.ID_FuncTabl', '=', $this->Usuario)->get();

        $this->Profesores=DB::table('Profesores')->orderBy('Nombre_Prof','ASC')->get();

        return view('livewire.mantenedores.editar-curso');
    }
}
