<?php

namespace App\Http\Controllers\PDF\Oftalmologo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class OftalmologoReportePDF extends Controller
{
    public function index(Request $request) 
    {
		 
	   $ID_Curso = $request->input('ID_Curso');
	   $ID_Oftalmologo = $request->input('ID_Oftalmologo');
	   $NombreEscuela = $request->input('NombreEscuela'); 

		$pdf = \PDF::loadView('PDF/Oftalmologo/ReporteOftalmologo', compact('ID_Curso','NombreEscuela','ID_Oftalmologo'));
 
		return $pdf->download('ReporteOftalmologoPDF.pdf');
    }
}
