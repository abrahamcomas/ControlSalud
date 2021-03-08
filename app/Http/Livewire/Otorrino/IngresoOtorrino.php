<?php

namespace App\Http\Livewire\Otorrino;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela; 
use App\Models\InterCursoAlum; 
use App\Models\AlumnoOtorrino; 
use App\Models\Otorrino;

class IngresoOtorrino extends Component
{

use WithPagination;

    //RENDER
    public $ListaOtorrino;
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
    public $ListaOtorrinoIngresadas;

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
    
    public $ID_Otorrino;
    public $Usuario;
    public $Estado;
    public $FechaOtorrino;
    public $ObservacionIngreso;

    protected $rules=[  'ID_Otorrino' => 'required',
                        'Estado' => 'required',
                        'FechaOtorrino' => 'required',
                        'ObservacionIngreso' => 'required'];

    protected $messages=[ 'ID_Otorrino.required' =>'El campo "Lista De Otorrinos" es obligatorio.',
                            'Estado.required' =>'El campo "Estado" es obligatorio.',
                            'FechaOtorrino.required' =>'El campo "Fecha" es obligatorio.',
                            'Observacion.required' =>'El campo "Observación" es obligatorio.'];
    
    public function IngresarResultado(){
        
        $this->validate(); 
        $this->IngresoDatos='0';
        $this->M_Detalles='0';
        $this->Usuario= Auth::user()->id_Funcionario;

        $AlumOtorrino                   =new AlumnoOtorrino; 
        $AlumOtorrino->id_Alumno_T      = $this->id_AlumnoS;
        $AlumOtorrino->id_Otorrino_T    = $this->ID_Otorrino;
        $AlumOtorrino->ID_Funcionario_T = $this->Usuario;
        $AlumOtorrino->Aceptada         = $this->Estado;
        $AlumOtorrino->Fecha            = $this->FechaOtorrino;
        $AlumOtorrino->Observacion      = $this->ObservacionIngreso;
        $AlumOtorrino->save();  

        $this->id_AlumnoS         ='';
        $this->ID_Otorrino        ='';
        $this->Usuario            ='';
        $this->Estado             ='';
        $this->FechaOtorrino      ='';
        $this->ObservacionIngreso ='';

        if ($AlumOtorrino) { 
            
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

    public $id_OtorrinoEditar;
    public $NombresOtorrinoEditar;

    public $ED_Estado;
    public $ED_FechaOtorrino;
    public $ED_Observacion; 
    
    //EditarVacuna EditarResultado
    public $id_Otorrino_T;
    
    public function EditarOtorrino($id_AlumOt){
        $this->id_OtorrinoEditar=$id_AlumOt;
        $this->IngresoDatos='2';
        $this->M_Detalles='2';

        $AlumnoOtorrino =AlumnoOtorrino::find($id_AlumOt);
        $this->id_Otorrino_T          = $AlumnoOtorrino->id_Otorrino_T; 
        $this->ED_Estado              = $AlumnoOtorrino->Aceptada;
        $this->ED_FechaOtorrino       = $AlumnoOtorrino->Fecha;
        $this->ED_Observacion         = $AlumnoOtorrino->Observacion;
        $this->NombresOtorrinoEditar  = $AlumnoOtorrino->Otorrino->NombreOt;

    }

    protected $Editar=[ 'ED_Estado' => 'required',
                        'ED_FechaOtorrino' => 'required',
                        'ED_Observacion' => 'required'];

    protected $Editarmessages=[
                            'ED_Estado.required' =>'El campo "Estado" es obligatorio.',
                            'ED_FechaOtorrino.required' =>'El campo "Fecha" es obligatorio.',
                            'ED_Observacion.required' =>'El campo "Observación" es obligatorio.'];

    public function EditarIngresoResultado(){

        $this->validate($this->Editar,$this->Editarmessages); 
        $this->IngresoDatos='0';
        $this->M_Detalles='0';   

        $AlumnoOtorrino =AlumnoOtorrino::find($this->id_OtorrinoEditar); 
        $AlumnoOtorrino->id_Otorrino_T=$this->id_Otorrino_T;
        $AlumnoOtorrino->Aceptada= $this->ED_Estado;
        $AlumnoOtorrino->Fecha=$this->ED_FechaOtorrino;
        $AlumnoOtorrino->Observacion=$this->ED_Observacion;
        $AlumnoOtorrino->save();
        
        if ($AlumnoOtorrino) { 
            
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
    	$this->ListaOtorrinoIngresadas =  DB::table('Alumno') 
            ->leftjoin('AlumnoOtorrino', 'Alumno.id_Alumno', '=', 'AlumnoOtorrino.id_Alumno_T')
            ->leftjoin('Otorrino', 'AlumnoOtorrino.id_Otorrino_T', '=', 'Otorrino.id_Otorrino')
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

        $this->ListaOtorrino =  DB::table('Otorrino')
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
        
        return view('livewire.otorrino.ingreso-otorrino',[
            'ListaAlumnos'=>$ListaAlumnos
        ]);
    }
}
