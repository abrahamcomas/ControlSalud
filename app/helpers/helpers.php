<?php
use Illuminate\Support\Facades\DB;
use App\Models\IngCiudadanoModel;

function ID_Escuela($id_Funcionario) 
            { 
                  $datos=DB::table('IntFuncEscuela')->select('ID_EscuTabl')->where('ID_FuncTabl',$ID_Usuario)->get();

                  foreach ( $datos as $user){
                        $ID_Escuela = $user->ID_EscuTabl;
                  } 

                  return $ID_Escuela;
            }

function DatosCiudadano($Rut) 
		{ 
			$datos=DB::table('Ciudadanos')->Select('Rut','Nombres','Apellidos')->whereRut($Rut)->get();

			return $datos; 
		}

function IdPatente($Patente) 
            { 
                  $datos=DB::table('Vehiculos')->Select('id_Vehiculo')->where('PlacaPatente', $Patente)->get();
                  
                  foreach ($datos as $user) {
                        $datos = $user->id_Vehiculo;
                  }
                  return $datos;
            
            }

function ID_Ciudadano($Rut) 
            { 
                  $id_Ciudadano=DB::table('Ciudadanos')->Select('id_Ciudadano')->whereRut($Rut)->get();
                  
                  foreach ($id_Ciudadano as $user) {
                        $id_Ciudadano = $user->id_Ciudadano ;
                  }
                  return $id_Ciudadano;
              
            }

function IngresoCiudadano($Rut,$Nombres,$Apellidos,$Profesion,$ID_Nacionalidad,$FechaNacimiento,$Domicilio)
		{

            $datos = new IngCiudadanoModel;
            $datos->Rut = $Rut;
            $datos->Nombres = $Nombres;
            $datos->Apellidos = $Apellidos;
            $datos->Profesion = $Profesion;
            $datos->ID_Nacionalidad  = $ID_Nacionalidad;
            $datos->FechaNacimiento = $FechaNacimiento;
            $datos->Domicilio = $Domicilio;
            $datos->save();

            return $datos;
		}
 
?> 