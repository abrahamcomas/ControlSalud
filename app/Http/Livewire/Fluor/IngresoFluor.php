<?php

namespace App\Http\Livewire\Fluor;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela; 
use App\Models\InterCursoAlum; 
use App\Models\AlumnoFluor; 
use App\Models\Fluor; 

class IngresoFluor extends Component
{
 use WithPagination;

    //RENDER
    public $ListaFluor;
    public $AnioActual;
  
    //Curso Seleccionado
    public $ID_Curso=0;
    
    // public ListaAlumnos;
    public $ListaCursos;
    public $ID_Escuela;
 
    //Uso General
    public $Resultado;  

    //public Detalles e ingreso resultado
    public $id_AlumnoS='0';
    
    //public Detalles
    public $Nombres;
    public $Apellidos;
    public $Rut;
    public $Direccion;
    public $Telefono;
    public $FechaNac;
    public $Mama;
    public $NumeroMama;
    public $Papa;
    public $NumeroPapa;
    public $Observacion;
    public $ListaFluorIngresadas;

    public function Detalles($id_Alumno){
        $this->id_AlumnoS=$id_Alumno; 
        $this->M_Detalles='1';
        $this->IngresoDatos='0'; 

        $DatosAlumno =Alumno::find($id_Alumno); 
        $this->Nombres    =$DatosAlumno->Nombres;
        $this->Apellidos  =$DatosAlumno->Apellidos;
        $this->Rut        =$DatosAlumno->Rut;
        $this->Direccion  =$DatosAlumno->Direccion;
        $this->Telefono   =$DatosAlumno->Telefono;
        $this->FechaNac   =$DatosAlumno->FechaNac;
        $this->Mama       =$DatosAlumno->Mama;
        $this->NumeroMama =$DatosAlumno->NumeroMama;
        $this->Papa       =$DatosAlumno->Papa;
        $this->NumeroPapa =$DatosAlumno->NumeroPapa;
        $this->Observacion=$DatosAlumno->ObservacionA; 
    } 
    
    public $ID_Vacunas;
    public $Usuario;
    public $Estado;
    public $FechaFluor;
    public $ObservacionIngreso;

    protected $rules=[  'ID_Vacunas' => 'required',
                        'Estado' => 'required',
                        'FechaFluor' => 'required',
                        'ObservacionIngreso' => 'required'];

    protected $messages=[ 'ID_Vacunas.required' =>'El campo "Lista De Fluor" es obligatorio.',
                            'Estado.required' =>'El campo "Estado" es obligatorio.',
                            'FechaFluor.required' =>'El campo "Fecha" es obligatorio.',
                            'Observacion.required' =>'El campo "Observación" es obligatorio.'];
    
    public function IngresarResultado(){
        
        $this->validate(); 
        $this->IngresoDatos='0';
        $this->M_Detalles='0';
        $this->Usuario= Auth::user()->id_Funcionario;

        $AlumnoFluor                   =new AlumnoFluor; 
        $AlumnoFluor->id_Alumno_T      = $this->id_AlumnoS;
        $AlumnoFluor->id_Fluor_T       = $this->ID_Vacunas;
        $AlumnoFluor->ID_Funcionario_T = $this->Usuario;
        $AlumnoFluor->Aceptada         = $this->Estado;
        $AlumnoFluor->Fecha            = $this->FechaFluor;
        $AlumnoFluor->Observacion      = $this->ObservacionIngreso;
        $AlumnoFluor->save();  

        $this->id_AlumnoS ='';
        $this->ID_Vacunas ='';
        $this->Usuario    ='';
        $this->Estado     ='';
        $this->FechaFluor ='';
        $this->ObservacionIngreso ='';

        if ($AlumnoFluor) { 
            
            $this->Resultado='Registro Ingresado';
                    $this->IngresoDatos='0';
        }
        else{
            $this->Resultado='ERROR, en registro';
                    $this->IngresoDatos='0';
        }
    }
    //CANCELAR INGRESO
    public $IngresoDatos = '0';
    public $M_Detalles = '0';
    
    public function CancelarIngreso(){

        $this->IngresoDatos='0';
        $this->M_Detalles='0';
    }

    public $id_vacunasEditar;
    public $NombresFluorEditar;

    public $ED_Estado;
    public $ED_FechaFluor;
    public $ED_Observacion; 
    
    //EditarVacuna EditarResultado
    public $id_AlumF;
    public $id_Fluor_T;
    
    public function EditarFluor($id_Fluor_T){
        $this->id_vacunasEditar=$id_Fluor_T;
        $this->IngresoDatos='2';
        $this->M_Detalles='2';

        $ID =  DB::table('AlumFluor')->select('id_AlumF') 
            ->where('id_Fluor_T', '=', $id_Fluor_T)->get();
        
        foreach ( $ID as $user){
            $this->id_AlumF = $user->id_AlumF;
        } 

        $AlumnoFluor =AlumnoFluor::find($this->id_AlumF);
        $this->id_Fluor_T          = $AlumnoFluor->id_Fluor_T; 
        $this->ED_Estado          = $AlumnoFluor->Aceptada;
        $this->ED_FechaFluor        = $AlumnoFluor->Fecha;
        $this->ED_Observacion     = $AlumnoFluor->Observacion;
        $this->NombresFluorEditar =$AlumnoFluor->Fluor->Nombre_F;

    }

    protected $Editar=[ 'ED_Estado' => 'required',
                        'ED_FechaFluor' => 'required',
                        'ED_Observacion' => 'required'];

    protected $Editarmessages=[
                            'ED_Estado.required' =>'El campo "Estado" es obligatorio.',
                            'ED_FechaFluor.required' =>'El campo "Fecha" es obligatorio.',
                            'ED_Observacion.required' =>'El campo "Observación" es obligatorio.'];

 
    public function EditarIngresoResultado(){

        $this->validate($this->Editar,$this->Editarmessages); 
        $this->IngresoDatos='0';
        $this->M_Detalles='0';   

        $AlumVacunas =AlumnoFluor::find($this->id_AlumF); 
        $AlumVacunas->id_Fluor_T=$this->id_Fluor_T;
        $AlumVacunas->Aceptada= $this->ED_Estado;
        $AlumVacunas->Fecha=$this->ED_FechaFluor;
        $AlumVacunas->Observacion=$this->ED_Observacion;
        $AlumVacunas->save();
        
        if ($AlumVacunas) { 
            
            $this->Resultado='Registro Editado';
                    $this->IngresoDatos='0';
        }
        else{
            $this->Resultado='ERROR, en registro';
                    $this->IngresoDatos='0';
        }
    }
    

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
    	 $this->ListaFluorIngresadas =  DB::table('Alumno') 
            ->leftjoin('AlumFluor', 'Alumno.id_Alumno', '=', 'AlumFluor.id_Alumno_T')
            ->leftjoin('Fluor', 'AlumFluor.id_Fluor_T', '=', 'Fluor.id_Fluor')
            ->where('Alumno.id_Alumno', '=', $this->id_AlumnoS)
            ->get();
   
        $this->AnioActual = date("Y");
 
        //ID ESCUELA
        $this->Usuario= Auth::user()->id_Funcionario;
        $this->ID_Escuela =  DB::table('IntFuncEscuela')->select('ID_EscuTabl') 
            ->where('ID_FuncTabl', '=', $this->Usuario)->get();
        foreach ( $this->ID_Escuela as $user){
            $this->ID_Escuela = $user->ID_EscuTabl;
        } 
        //FIN ID ESCUELA

        $this->ListaFluor =  DB::table('Fluor')
        ->where('id_Escuela_T', '=', $this->ID_Escuela)->orderBy('Anio','DESC')->get();

        $ListaAlumnos =  DB::table('Alumno') 
            ->leftjoin('InterCursoAlum', 'Alumno.id_Alumno', '=', 'InterCursoAlum.id_Alumno_T')
            ->leftjoin('Curso', 'InterCursoAlum.id_Curso_T', '=', 'Curso.id_Curso')
            ->where('Curso.id_Curso', '=', $this->ID_Curso)
            ->paginate(4);
 
        $this->ListaCursos =  DB::table('Curso') 
        ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
        ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
        ->leftjoin('IntFuncEscuela', 'Escuela.id_Escuela', '=', 'IntFuncEscuela.ID_EscuTabl')
        ->where('IntFuncEscuela.ID_FuncTabl', '=', $this->Usuario)
        ->where('Curso.AnioCurso', '=', $this->AnioActual)
        ->where('IntFuncEscuela.ActivoAct', '=', '1')->orderBy('Nombre','ASC')->get();
        return view('livewire.fluor.ingreso-fluor',[
            'ListaAlumnos'=>$ListaAlumnos
        ]);
    }
}
