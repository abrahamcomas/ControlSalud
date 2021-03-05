<?php

namespace App\Http\Controllers\PDF\Oftalmologo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OftalmologoReporteVacunasAlum extends Controller
{
    public function index(Request $request) 
    {
		 
	   $id_Alumno = $request->input('id_Alumno');

		$pdf = \PDF::loadView('PDF/Oftalmologo/ReporteOftalmologoAlum', compact('id_Alumno'));

		// return $pdf->download('ReporteVacunasAlumPDF.pdf');

		return $pdf->download('ReporteOftalmologoAlumPDF.pdf');
    }
}