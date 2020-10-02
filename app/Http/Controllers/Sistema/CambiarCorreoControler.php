<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use App\Models\FuncionarioModel;

class CambiarCorreoControler extends Controller
{
    public function index(Request $request)
    {

    	$rules = [
            'passwordActual' => 'required',
            'Correo' => 'required',
        ];

        $messages = [
            'passwordActual.required' =>'El campo contraseña actual es obligatorio.',
            'Correo.required' =>'El campo Email es obligatorio.'
        ];
 
        $this->validate($request, $rules, $messages);
  		
  		$passwordActual = $request->input('passwordActual'); 
        $Correo = $request->input('Correo'); 

        $Rut = Auth::user()->Rut;
        $Id_Funcionario = Auth::user()->id_Funcionario;

        $FuncionarioPassword=FuncionarioModel::select('password')->whereRut($Rut)->get()->first();

		if(Hash::check($passwordActual, $FuncionarioPassword->password)){
		        
                $FuncionarioCorreo=DB::table('Funcionario')->where('Email', $Correo)->exists();
                
                if ($FuncionarioCorreo==0) {
                    
                    $user = FuncionarioModel::find($Id_Funcionario);
                    $user->Email = $request->Correo;
                    $user->save();

                    $resultado='Email Actualizado Correctamente';
                }
                else
                {
                    $resultado='Error, Email Registrado Anteriormente';
                }  
		}
		else{

			return back()
                ->withErrors(['Contraseña actual es incorrecta'])
                ->withInput(request(['RUN']));
		}
   		
   		return view('Sistema/MostrarResultadoCambios')->with('resultado', $resultado);


    }
}

 