<?php

namespace App\Http\Controllers\PDF\Fluor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FluorReportePDF extends Controller
{
     public function index(Request $request) 
    {
		 
	   $ID_Curso = $request->input('ID_Curso');
	   $ID_Fluor = $request->input('ID_Fluor');
	   $NombreEscuela = $request->input('NombreEscuela');  

		$pdf = \PDF::loadView('PDF/Fluor/ReporteFluor', compact('ID_Curso','NombreEscuela','ID_Fluor'));

		return $pdf->download('ReporteFluorPDF.pdf');
    }
} 
