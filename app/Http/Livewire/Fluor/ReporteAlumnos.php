<?php

namespace App\Http\Livewire\Fluor;

use Livewire\Component;
use Livewire\WithPagination; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela; 
use App\Models\InterCursoAlum; 

class ReporteAlumnos extends Component
{
	use WithPagination;

    //Curso Seleccionado
    public $ID_Curso;

    // public ListaAlumnos;
    public $ListaCursos;
    public $Usuario; 
    public $ID_Escuela;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
    	  //ID ESCUELA
        $this->Usuario= Auth::user()->id_Funcionario;

        $this->ListaCursos =  DB::table('Curso') 
        ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
        ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
        ->leftjoin('IntFuncEscuela', 'Escuela.id_Escuela', '=', 'IntFuncEscuela.ID_EscuTabl')
        ->where('IntFuncEscuela.ID_FuncTabl', '=', $this->Usuario)
        ->where('IntFuncEscuela.ActivoAct', '=', '1')->orderBy('Nombre','ASC')->get();
        return view('livewire.fluor.reporte-alumnos',[
        'ListaAlumnos' =>  DB::table('Alumno') 
        ->leftjoin('InterCursoAlum', 'Alumno.id_Alumno', '=', 'InterCursoAlum.id_Alumno_T')
        ->leftjoin('Curso', 'InterCursoAlum.id_Curso_T', '=', 'Curso.id_Curso')
        ->where('Curso.id_Curso', '=', $this->ID_Curso)
        ->paginate(4) 
        ]);
    }
}
