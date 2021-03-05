<?php

namespace App\Http\Livewire\Mantenedores;

use Livewire\Component; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\CursosModel; 
use App\Models\intermediaEscuela; 
use App\Models\CursoProfesJefe; 

class AgregarCurso extends Component
{


    //Datos Curso
    public $NombreCurso;
    public $id_Profesores;

	public $ListaCursos;
    public $Usuario;
	public $Profesores; 
    public $Resultado;
    public $id_ingresado;
    public $ID_Escuela;

    protected $rules = ['NombreCurso' => 'required',
                        'id_Profesores' => 'required'];

    protected $messages = [ 'NombreCurso.required' =>'El campo "Nombre Curso" es obligatorio.',
                            'id_Profesores.required' =>'El campo "Profesor Jefe" es obligatorio.'];

    public function Agregar(){

        $this->validate(); 

        $AnioActual = date("Y");

        $Existe=DB::table('Curso')->where('Nombre',$this->NombreCurso)
                ->where('AnioCurso',$AnioActual)->exists();
  
        if ($Existe==0) 
        { 
            
            $this->Curso                = new CursosModel;
            $this->Curso->Nombre        = $this->NombreCurso;
            $this->Curso->AnioCurso     = $AnioActual;
            $this->Curso->save();

            $this->id_ingresado = $this->Curso->id_Curso; 

            $this->PorfeJefe                  = new CursoProfesJefe;
            $this->PorfeJefe->Activo          = "1";
            $this->PorfeJefe->Anio            = $AnioActual;
            $this->PorfeJefe->Id_Curso        = $this->id_ingresado;
            $this->PorfeJefe->Id_Profesor_Jefe= $this->id_Profesores;
            $this->PorfeJefe->save();


            $this->ID_Usuario= Auth::user()->id_Funcionario;

            $this->ID_Escuela=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$this->ID_Usuario)->get();

            foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
            } 

            $this->intermediaEscuela                 = new intermediaEscuela;
            $this->intermediaEscuela->Id_Curso_Esc   = $this->id_ingresado;
            $this->intermediaEscuela->Tabla_Escuela  = $this->ID_Escuela;
            $this->intermediaEscuela->save(); 

            $this->Resultado='Ingreso correctamente';

            $this->NombreCurso='';
            $this->id_Profesores='';
        }
        else{
                $this->Resultado='"Error en ingreso"';
        }

            $this->ProfesorIngr='';

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
        
        return view('livewire.mantenedores.agregar-curso');
    }
}
