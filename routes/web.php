<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Auth\Middleware\Authenticate; 
use Illuminate\Http\Request; 
use App\Http\Controllers\Registro\RegistroController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\CerrarLoginController;
use App\Http\Controllers\Email\RContraseniaController;
use App\Http\Controllers\Email\ResetearContraseniaController;
use App\Http\Controllers\Email\RestaurarContController;
use App\Http\Controllers\Sistema\VolverIndexController;
use App\Http\Controllers\Sistema\CambiarContController;
use App\Http\Controllers\Sistema\CambiarCorreoControler;

/*  
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////RESTAURACION, REGISTRO, LOGIN///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/', function () {
    return view('Login/Login');
})->name('Index'); 

//VOLVER A PRINCIPAL SI NO ESTA AUTENTICADO
Route::get('Sistema', function (){ 
    return view('Login/Login');
})->name('LoginVolver'); 

//PAGINA PRINCIPAL LOGIN 
Route::post('Sistema', [LoginController::class, 'index'])->name('Login'); 

// REGISTRO
Route::patch('IngresoRegistro', [RegistroController::class, 'index'])->name('Registro');
Route::get('Registro', function () {
    return view('Registro/Registrarse');
})->name('Registrarse');

//CERRAR SESION 
Route::get('CerrarSesion', [CerrarLoginController::class, 'index'])->name('CerrarSesion');
Route::get('Sistema/Principal', [CerrarLoginController::class, 'NoLogin']);
 
//RESTAURAR CONTRASEÑA POR CORREO
Route::patch('Restaurar', [RestaurarContController::class, 'index'])->name('Restaurar');
Route::post('Login/RecuperarContrasenia', [RContraseniaController::class, 'index'])->name('ContraseniaEnviada');
Route::get('ResetearContrasenia', [ResetearContraseniaController::class, 'index'])->name('RestaurarC');
Route::get('RecuperarContrasenia', function (){ 
    return view('Email/RecuperarContrasenia');
})->name('Recuperar');  
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////SISTEMA PRINCIPAL//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//Volver Index
Route::get('SistemaPrincipal', [VolverIndexController::class, 'index'])->middleware('auth')->name('VolverIndex');

//Cambiar Contrasenia 
Route::get('Sistema/ConfirmarCambioContrasenia', function () {
    return view('Sistema/CambiarContrasenia/CambiarContrasenia');
})->middleware('auth')->name('CambiarContrasenia'); 

Route::post('Sistema/ConfirmarCambioContrasenia', [CambiarContController::class, 'index'])->name('FormContrasenia');

//Cambiar Correo
Route::get('Sistema/CambiarCorreo', function () {
    return view('Sistema/CambiarCorreo/CambiarCorreo');
})->middleware('auth')->name('CambiarCorreo'); 

Route::post('Sistema/CambiarCorreo', [CambiarCorreoControler::class, 'index'])->name('FormCorreo');



?>  