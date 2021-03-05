<?php

namespace App\Http\Controllers\PDF\Otorrino;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtorrinoReportePDF extends Controller
{
     public function index(Request $request) 
    {
		 
	   $ID_Curso = $request->input('ID_Curso');
	   $ID_Otorrino = $request->input('ID_Otorrino');
	   
	   $NombreEscuela = $request->input('NombreEscuela'); 

		$pdf = \PDF::loadView('PDF/Otorrino/ReporteOtorrino', compact('ID_Curso','NombreEscuela','ID_Otorrino'));

		return $pdf->download('ReporteOtorrinoPDF.pdf');
    }
}
