<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Auth\Middleware\Authenticate; 
use Illuminate\Http\Request; 
use App\Http\Controllers\Registro\RegistroController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\CerrarLoginController;
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

Route::get('/', function () {
    return view('Login/Login');
})->name('Index'); 

Route::get('Registro', function () {
    return view('Registro/Registrarse');
})->name('Registrarse');
 
// Registro
Route::patch('IngresoRegistro', [RegistroController::class, 'index'])->name('Registro');

////Cerrar Sesion 
Route::get('CerrarSesion', [CerrarLoginController::class, 'index'])->name('CerrarSesion');
Route::get('Sistema/Principal', [CerrarLoginController::class, 'NoLogin']);


Route::post('Principal', [LoginController::class, 'index'])->name('Login');

//Restaurar contraseña por correo
Route::patch('RestaurarC1','RecuperarContrasenia\IngresoNuevaC\RestaurarCon1Controller@Restaurar')->name('RestaurarC1');  

?>