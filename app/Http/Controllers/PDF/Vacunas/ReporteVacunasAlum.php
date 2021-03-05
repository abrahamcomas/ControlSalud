<?php

namespace App\Http\Controllers\PDF\Vacunas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReporteVacunasAlum extends Controller
{
    public function index(Request $request) 
    {
		 
	   $id_Alumno = $request->input('id_Alumno');

		$pdf = \PDF::loadView('PDF/Vacunas/ReporteVacunasAlum', compact('id_Alumno'));

		// return $pdf->download('ReporteVacunasAlumPDF.pdf');

		return $pdf->download('ReporteVacunasAlumPDF.pdf');
    }
}
