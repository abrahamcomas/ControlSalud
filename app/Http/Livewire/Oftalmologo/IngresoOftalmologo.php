<?php

namespace App\Http\Livewire\Oftalmologo;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Models\Alumno; 
use App\Models\intermediaEscuela;  
use App\Models\InterCursoAlum; 
use App\Models\Oftalmologo; 
use App\Models\AlumOftalmologo; 

class IngresoOftalmologo extends Component
{

   use WithPagination;

    //RENDER
    public $ListaOftalmologo;
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
    public $ListaOftalmologosIngresadas;

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
    
    public $ID_Oftalmologo;
    public $Usuario;
    public $Estado;
    public $FechaVacunacion;
    public $ObservacionIngreso;

    protected $rules=[  'ID_Oftalmologo' => 'required',
                        'Estado' => 'required',
                        'FechaVacunacion' => 'required',
                        'ObservacionIngreso' => 'required'];

    protected $messages=[ 'ID_Oftalmologo.required' =>'El campo "Lista De Oftalmologos" es obligatorio.',
                            'Estado.required' =>'El campo "Estado" es obligatorio.',
                            'FechaVacunacion.required' =>'El campo "Fecha" es obligatorio.',
                            'ObservacionIngreso.required' =>'El campo "Observación" es obligatorio.'];
    
    public function IngresarResultado(){
        
        $this->validate(); 
        $this->IngresoDatos='0';
        $this->M_Detalles='0';
        $this->Usuario= Auth::user()->id_Funcionario;

        $AlumOftalmologo                   =new AlumOftalmologo; 
        $AlumOftalmologo->id_Alumno_T      = $this->id_AlumnoS;
        $AlumOftalmologo->id_Oftalmologo_T = $this->ID_Oftalmologo;
        $AlumOftalmologo->ID_Funcionario_T = $this->Usuario;
        $AlumOftalmologo->Aceptada         = $this->Estado;
        $AlumOftalmologo->Fecha            = $this->FechaVacunacion;
        $AlumOftalmologo->Observacion      = $this->ObservacionIngreso;
        $AlumOftalmologo->save();  

        $this->id_AlumnoS         ='';
        $this->ID_Oftalmologo     ='';
        $this->Usuario            ='';
        $this->Estado             ='';
        $this->FechaVacunacion    ='';
        $this->ObservacionIngreso ='';

        if ($AlumOftalmologo) { 
            
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

    public $id_OftalmologoEditar;
    public $NombresOftalmologoEditar;

    public $ED_Estado;
    public $ED_FechaVacunacion;
    public $ED_Observacion; 
    
    //EditarVacuna EditarResultado
    public $id_Oftalmologo_T;
    
    public function EditarOftalmologo($id_AlumO){
        $this->id_OftalmologoEditar=$id_AlumO;
        $this->IngresoDatos='2'; 
        $this->M_Detalles='2';
 
        $AlumOftalmologo =AlumOftalmologo::find($id_AlumO);
        $this->id_Oftalmologo_T         = $AlumOftalmologo->id_Oftalmologo_T; 
        $this->ED_Estado                = $AlumOftalmologo->Aceptada;
        $this->ED_FechaVacunacion       = $AlumOftalmologo->Fecha;
        $this->ED_Observacion           = $AlumOftalmologo->Observacion;
        $this->NombresOftalmologoEditar = $AlumOftalmologo->Oftalmologo->Nombre_O;

    }

    protected $Editar=[ 'ED_Estado' => 'required',
                        'ED_FechaVacunacion' => 'required',
                        'ED_Observacion' => 'required'];

    protected $Editarmessages=[
                            'ED_Estado.required' =>'El campo "Estado" es obligatorio.',
                            'ED_FechaVacunacion.required' =>'El campo "Fecha" es obligatorio.',
                            'ED_Observacion.required' =>'El campo "Observación" es obligatorio.'];

 
    public function EditarIngresoResultado(){

        $this->validate($this->Editar,$this->Editarmessages); 
        $this->IngresoDatos='0';
        $this->M_Detalles='0';   

        $AlumOftalmologo =AlumOftalmologo::find($this->id_OftalmologoEditar); 
        $AlumOftalmologo->id_Oftalmologo_T=$this->id_Oftalmologo_T;
        $AlumOftalmologo->Aceptada= $this->ED_Estado;
        $AlumOftalmologo->Fecha=$this->ED_FechaVacunacion;
        $AlumOftalmologo->Observacion=$this->ED_Observacion;
        $AlumOftalmologo->save();
        
        if ($AlumOftalmologo) { 
            
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
    	$this->ListaOftalmologosIngresadas =  DB::table('Alumno') 
        ->leftjoin('AlumOftalmologo', 'Alumno.id_Alumno', '=', 'AlumOftalmologo.id_Alumno_T')
        ->leftjoin('Oftalmologo', 'AlumOftalmologo.id_Oftalmologo_T', '=', 'Oftalmologo.id_oftalmologo')
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

        $this->ListaOftalmologo =  DB::table('Oftalmologo')
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
        return view('livewire.oftalmologo.ingreso-oftalmologo',[
            'ListaAlumnos'=>$ListaAlumnos
        ]);
    }
}
