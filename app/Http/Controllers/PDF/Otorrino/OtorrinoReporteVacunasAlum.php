<?php

namespace App\Http\Controllers\PDF\Otorrino;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtorrinoReporteVacunasAlum extends Controller
{
    public function index(Request $request) 
    {
		 
	   $id_Alumno = $request->input('id_Alumno');

		$pdf = \PDF::loadView('PDF/Otorrino/ReporteOtorrinoAlum', compact('id_Alumno'));

		// return $pdf->download('ReporteVacunasAlumPDF.pdf');

		return $pdf->download('ReporteOtorrinoAlumPDF.pdf');
    }
}
