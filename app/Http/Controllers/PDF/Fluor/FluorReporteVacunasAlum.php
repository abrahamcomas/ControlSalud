<?php

namespace App\Http\Controllers\PDF\Fluor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FluorReporteVacunasAlum extends Controller
{
     public function index(Request $request) 
    {
		 
	   $id_Alumno = $request->input('id_Alumno');

		$pdf = \PDF::loadView('PDF/Fluor/ReporteFluorAlum', compact('id_Alumno'));

		// return $pdf->download('ReporteVacunasAlumPDF.pdf');

		return $pdf->download('ReporteFluorAlumPDF.pdf');
    }
}
