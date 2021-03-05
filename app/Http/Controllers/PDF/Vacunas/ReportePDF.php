<?php

namespace App\Http\Controllers\PDF\Vacunas;

use Illuminate\Http\Request;  
use App\Http\Controllers\Controller;

class ReportePDF extends Controller
{ 
    public function index(Request $request) 
    {
		 
	   $ID_Curso = $request->input('ID_Curso');
	   $ID_Vacunas = $request->input('ID_Vacunas');
	   
	   $NombreEscuela = $request->input('NombreEscuela'); 

		$pdf = \PDF::loadView('PDF/Vacunas/ReporteVacunas', compact('ID_Curso','NombreEscuela','ID_Vacunas'));

		return $pdf->download('ReporteVacunasPDF.pdf');
    }
}
