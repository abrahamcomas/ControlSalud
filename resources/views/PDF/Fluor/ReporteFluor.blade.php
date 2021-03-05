<?php
$fecha_hoy=date("d/m/Y");
$ID_Curso; 
$ID_Fluor; 
$DatosCurso =  DB::table('Curso') 
    ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
    ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
    ->leftjoin('IntFuncEscuela', 'Escuela.id_Escuela', '=', 'IntFuncEscuela.ID_EscuTabl')
    ->where('Curso.id_Curso', '=', $ID_Curso)->get();

    foreach ($DatosCurso as $user){
        $NombreCurso = $user->Nombre;
    } 
 
$DatosCurso1 =  DB::table('Alumno') 
        ->leftjoin('InterCursoAlum', 'Alumno.id_Alumno', '=', 'InterCursoAlum.id_Alumno_T')
        ->leftjoin('Curso', 'InterCursoAlum.id_Curso_T', '=', 'Curso.id_Curso')
        ->leftjoin('AlumFluor', 'Alumno.id_Alumno', '=', 'AlumFluor.id_Alumno_T')
        ->leftjoin('Fluor', 'AlumFluor.id_Fluor_T', '=', 'Fluor.id_Fluor')
        ->where('Curso.id_Curso', '=', $ID_Curso)
        ->where('Fluor.id_Fluor', '=', $ID_Fluor)->get();
?>
    <head>
        <meta charset="UTF-8">
        <title>Reporte Vacunas PDF </title>
    </head> 


     <head>
        <meta charset="UTF-8">
        <title>Documento PDF</title>
        <style>
            h4{
            text-align: center;
            text-transform: uppercase;

            }
            #ContenidoIzqHead { 
              margin-left: 00px;
              width: 300px; 
              font-size: 15px;
            }
            #FechaPrincipalHead { 
                width: 120px; 
                font-size: 13px;
                margin-left: 160px;
            }
            #ContenidoDercHead { 
                margin-right: 0px;
                margin-top: 0px;
            }

            #TablaIzq { 
              width: 400px; 
              font-size: 11px;
              margin-right: 0px;
              margin-top: 0px;
            }
            #TablaDer { 
              width: 300px; 
              font-size: 11px;
              margin-left: 0px;
              margin-top: 0px;
            }

            #TablaIzqF { 
              width: 350px; 
              font-size: 11px;
              margin-right: 0px;
              margin-top: 0px;
            }
            #TablaDerF { 
              width: 350px; 
              font-size: 11px;
              margin-left: 0px;
              margin-top: 0px;
            }
   
        </style>
    </head>
    <table width="100%" border="0">
        <tr>
          <td>
              <div id="ContenidoIzqHead"> 
                  <?php echo $NombreEscuela; ?><br>
                  SISTEMA CONTROL DE SALUD
              </div>
          </td>
            <td>
              <div id="FechaPrincipalHead">Fecha: <?php  echo $fecha_hoy;?></div>
          </td>
        </tr>
    </table>
    <center>  
          <h4>
            <strng>REPORTES FLUOR <?php echo $NombreCurso; ?></strong>
          </h4>
    </center> 
    <hr>
    <table  width="100%" border="1"  > 
        <thead>
            <tr> 
                <th>
                  <center>Fluor</center>
                </th>
                <th>
                  <center>Rut</center>
                </th>
                <th>
                  <center>Nombres</center>
                </th>
                <th>
                  <center>Apellidos</center>
                </th>
                <th>
                  <center>Fecha Nacimiento</center>
                </th>
                <th>
                  <center>Observación</center>
                </th>
                <th>
                  <center>Estado</center>
                </th>
            </tr> 
        </thead>
        <tbody>
    <?php   foreach ($DatosCurso1 as $row): ?>
      <tr>
              <td>
                <center><?php echo $row->Nombre_F; ?></center>
              </td>
              <td>
                <center><?php echo $row->Rut; ?></center>
              </td>
              <td>
                <center><?php echo $row->Nombres;  ?></center>
              </td>
                <td>
                  <center><?php echo $row->Apellidos;  ?></center>
                </td>
                <td>
                  <center><?php echo $row->FechaNac;  ?></center>
                </td>
                <td>
                  <center><?php echo $row->Observacion;  ?></center>
                </td>
    <?php 
          if($row->Aceptada==1)
          { ?>
                <td><center>Aceptada</center></td>
    <?php   }
            elseif($row->Aceptada==2)
            {   ?>
        <td><center>Rechazada</center></td>
    <?php   }
            else
            {   ?>
              <td><center>Consultorio</center></td>
    <?php } ?> 
            </tr>
    <?php   endforeach ?> 
        </tbody> 
    </table>
     
     
     
      
     

   

    
      




