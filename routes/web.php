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

use App\Http\Controllers\PDF\Vacunas\ReportePDF;
use App\Http\Controllers\PDF\Vacunas\ReporteVacunasAlum;

use App\Http\Controllers\PDF\Oftalmologo\OftalmologoReportePDF;
use App\Http\Controllers\PDF\Oftalmologo\OftalmologoReporteVacunasAlum;

use App\Http\Controllers\PDF\Otorrino\OtorrinoReportePDF;
use App\Http\Controllers\PDF\Otorrino\OtorrinoReporteVacunasAlum;

use App\Http\Controllers\PDF\Fluor\FluorReportePDF;
use App\Http\Controllers\PDF\Fluor\FluorReporteVacunasAlum;
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






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Mantenedores///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Agregar Alumnos
Route::get('Sistema/AgregarAlumnos', function () {
    return view('Posts/Mantenedores/AgregarAlumnos');
})->middleware('auth')->name('AgregarAlumnos'); 

//Editar Alumnos
Route::get('Sistema/EditarAlumnos', function () {
    return view('Posts/Mantenedores/EditarAlumnos');
})->middleware('auth')->name('EditarAlumnos'); 

//Agregar Asistentes
Route::get('Sistema/AgregarAsistentes', function () {
    return view('Posts/Mantenedores/AgregarAsistentes');
})->middleware('auth')->name('AgregarAsistentes'); 

//Editar Asistentes
Route::get('Sistema/EditarAsistentes', function () {
    return view('Posts/Mantenedores/EditarAsistentes');
})->middleware('auth')->name('EditarAsistentes'); 

//Agregar Curso
Route::get('Sistema/AgregarCurso', function () {
    return view('Posts/Mantenedores/AgregarCursos');
})->middleware('auth')->name('AgregarCursos'); 

//Editar Curso
Route::get('Sistema/EditarCurso', function () {
    return view('Posts/Mantenedores/EditarCursos');
})->middleware('auth')->name('EditarCursos');  

//Agregar Profesores
Route::get('Sistema/AgregarProfesores', function () {
    return view('Posts/Mantenedores/AgregarProfesoresjefes');
})->middleware('auth')->name('AgregarProfesores'); 

//Editar Profesores
Route::get('Sistema/EditarProfesores', function () {
    return view('Posts/Mantenedores/EditarProfesores');
})->middleware('auth')->name('EditarProfesores'); 


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Ingreso Reportes///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Ingresar Vacunas 
Route::get('Sistema/IngresarVacunas', function () {
    return view('Posts/Vacunas/IngresoVacunas');
})->middleware('auth')->name('IngresarVacunas'); 

//Registrar Vacunas
Route::get('Sistema/RegistrarVacunas', function () {
    return view('Posts/Vacunas/RegistroVacuna');
})->middleware('auth')->name('RegistrarVacuna'); 

//Reporte Vacunas
Route::get('Sistema/ReporteVacunas', function () {
    return view('Posts/Vacunas/ReporteVacunas'); 
})->middleware('auth')->name('ReporteVacunas'); 

Route::get('Sistema/ReporteVacunasAlumnos', function () {
    return view('Posts/Vacunas/ReporteVacunasAlumnos'); 
})->middleware('auth')->name('ReporteVacunasAlumnos'); 

//Reportes PDF Vacunas
Route::get('Sistema/VacunasPDF', [ReportePDF::class, 'index'])->middleware('auth')->name('CrearPDF'); 
Route::get('Sistema/VacunasPDFAlumno', [ReporteVacunasAlum::class, 'index'])->middleware('auth')->name('ReporteAlumnoPDF');  



//Registrar Oftalmologo
Route::get('Sistema/RegistroOftalmologo', function () {
    return view('Posts/Oftalmologo/RegistroOftalmologo');
})->middleware('auth')->name('RegistrarOftalmologo'); 

//Ingresar Oftalmologo
Route::get('Sistema/IngresarOftalmologo', function () {
    return view('Posts/Oftalmologo/IngresoOftalmologo');
})->middleware('auth')->name('IngresarOftalmologo'); 

//Reporte Oftalmologo
Route::get('Sistema/ReporteOftalmologo', function () {
    return view('Posts/Oftalmologo/ReporteOftalmologo'); 
})->middleware('auth')->name('ReporteOftalmologo'); 

Route::get('Sistema/ReporteOftalmologoAlumnos', function () {
    return view('Posts/Oftalmologo/ReporteOftalmologoAlumnos'); 
})->middleware('auth')->name('ReporteOftalmologoAlumnos'); 

//Reportes PDF Vacunas
Route::get('Sistema/OftalmologoPDF', [OftalmologoReportePDF::class, 'index'])->middleware('auth')->name('OftalmologoCrearPDF'); 
Route::get('Sistema/OftalmologoPDFAlumno', [OftalmologoReporteVacunasAlum::class, 'index'])->middleware('auth')->name('OftalmologoReporteAlumnoPDF'); 


 
//Registrar Otorrino 
Route::get('Sistema/RegistrarOtorrino', function () {
    return view('Posts/Otorrino/RegistroOtorrino');
})->middleware('auth')->name('RegistrarOtorrino'); 

//Ingresar Otorrino
Route::get('Sistema/IngresarOtorrino', function () {
    return view('Posts/Otorrino/IngresoOtorrino');
})->middleware('auth')->name('IngresarOtorrino'); 

//Reporte Otorrino 
Route::get('Sistema/ReporteOtorrino', function () {
    return view('Posts/Otorrino/ReporteOtorrino');
})->middleware('auth')->name('ReporteOtorrino'); 

Route::get('Sistema/ReporteOtorrinoAlumnos', function () {
    return view('Posts/Otorrino/ReporteOtorrinoAlumnos'); 
})->middleware('auth')->name('ReporteOtorrinoAlumnos'); 

//Reportes PDF Vacunas
Route::get('Sistema/OtorrinoPDF', [OtorrinoReportePDF::class, 'index'])->middleware('auth')->name('OtorrinoCrearPDF'); 
Route::get('Sistema/OtorrinoPDFAlumno', [OtorrinoReporteVacunasAlum::class, 'index'])->middleware('auth')->name('OtorrinoReporteAlumnoPDF'); 


//Registrar Fluor 
Route::get('Sistema/RegistrarFluor', function () {
    return view('Posts/Fluor/RegistroFluor');
})->middleware('auth')->name('RegistrarFluor'); 
//Ingresar Fluor
Route::get('Sistema/IngresarFluor', function () {
    return view('Posts/Fluor/IngresoFluor');
})->middleware('auth')->name('IngresarFluor'); 

//Reporte Fluor
Route::get('Sistema/ReporteFluor', function () {
    return view('Posts/Fluor/ReporteFluor');
})->middleware('auth')->name('ReporteFluor'); 

Route::get('Sistema/ReporteFluorAlumnos', function () {
    return view('Posts/Fluor/ReporteFluorAlumnos'); 
})->middleware('auth')->name('ReporteFluorAlumnos'); 


//Reportes PDF Fluor
Route::get('Sistema/FluorPDF', [FluorReportePDF::class, 'index'])->middleware('auth')->name('FluorCrearPDF'); 
Route::get('Sistema/FluorPDFAlumno', [FluorReporteVacunasAlum::class, 'index'])->middleware('auth')->name('FluorReporteAlumnoPDF'); 

?>     