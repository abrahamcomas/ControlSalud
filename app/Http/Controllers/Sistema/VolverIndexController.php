<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FuncionarioModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class VolverIndexController extends Controller
{
    public function index(Request $request)
    { 

    	$Id_Funcionario = Auth::user()->id_Funcionario;
 		$RUN = Auth::user()->Rut;

        $idLogin=FuncionarioModel::Select('Id_Funcionario','Activo','Rut','password')->whereRut($RUN)->first();

        return view('Sistema/Principal');

          
    }
}
