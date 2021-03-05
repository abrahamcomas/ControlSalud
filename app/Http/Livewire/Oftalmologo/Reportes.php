<?php

namespace App\Http\Livewire\Oftalmologo;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela; 
use App\Models\InterCursoAlum; 
 
class Reportes extends Component
{	public $ID_Curso='0';
    // public ListaAlumnos;
    public $ListaCursos;
    public $NombreEscuela;   
    public $Usuario;
    public $ID_Escuela;
    public $ListaOftalmologo;
    public $ID_Oftalmologo='0';

    public function render()
    {
    	//ID ESCUELA
        $this->Usuario= Auth::user()->id_Funcionario;
     
        //FIN ID ESCUELA
        $this->ListaCursos =  DB::table('Curso') 
        ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
        ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
        ->leftjoin('IntFuncEscuela', 'Escuela.id_Escuela', '=', 'IntFuncEscuela.ID_EscuTabl')
        ->where('IntFuncEscuela.ID_FuncTabl', '=', $this->Usuario)
        ->where('IntFuncEscuela.ActivoAct', '=', '1')->orderBy('Nombre','ASC')->get();

        //ID ESCUELA
        $this->ID_Escuela =  DB::table('IntFuncEscuela')->select('ID_EscuTabl') 
            ->where('ID_FuncTabl', '=', $this->Usuario)->get();
        foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
        } 
        //FIN ID ESCUELA

        $this->ListaOftalmologo =  DB::table('Oftalmologo')
        ->where('id_Escuela_T', '=', $this->ID_Escuela)->orderBy('Anio','DESC')->get();

        foreach ( $this->ListaCursos as $user){
            $this->NombreEscuela = $user->NombreEscuela;
        } 
        return view('livewire.oftalmologo.reportes');
    }
}
