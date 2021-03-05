<?php
$fecha_hoy=date("d/m/Y");
$id_Alumno; 

$DatosCurso =  DB::table('Alumno')->select('Nombre','NombreEscuela','Nombres','Apellidos','Rut')
    ->leftjoin('InterCursoAlum', 'Alumno.id_Alumno', '=', 'InterCursoAlum.id_Alumno_T')
  ->leftjoin('Curso', 'InterCursoAlum.id_Curso_T', '=', 'Curso.id_Curso')
    ->leftjoin('intermediaEscuela', 'Curso.id_Curso', '=', 'intermediaEscuela.Id_Curso_Esc')
    ->leftjoin('Escuela', 'intermediaEscuela.Tabla_Escuela', '=', 'Escuela.id_Escuela')
    ->where('Alumno.id_Alumno', '=', $id_Alumno)->get();
    
    foreach ($DatosCurso as $user){
        $NombreCurso    = $user->Nombre;
        $NombreEscuela    = $user->NombreEscuela;
        $NombreAlumno     = $user->Nombres;
        $ApellidosAlumno  = $user->Apellidos;
        $Rut  = $user->Rut;
    } 

$Vacunas =  DB::table('Alumno') 
        ->leftjoin('AlumFluor', 'Alumno.id_Alumno', '=', 'AlumFluor.id_Alumno_T')
        ->leftjoin('Fluor', 'AlumFluor.id_Fluor_T', '=', 'Fluor.id_Fluor')
        ->where('Alumno.id_Alumno', '=', $id_Alumno)->get();
?>
    <head>
        <meta charset="UTF-8">
        <title>Reporte Fluor PDF </title>
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
              <strng><u>Reporte Fluor Alumno</u></strng>
            </h4>
            <h4>
              <strng><?php echo $NombreCurso; ?></strong>
              <br>
              <strong><?php echo $NombreAlumno; ?> <?php echo $ApellidosAlumno; ?></strong>
              <br>
              <strong><?php echo $Rut; ?></strong>
            </h4>
    </center> 
    <hr>
    <table  width="100%" border="1"  > 
        <thead>
            <tr> 
                <th>
                  <center>Nombre Fluor</center>
                </th>
                <th>
                  <center>Fceha</center>
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
    <?php   foreach ($Vacunas as $row): ?>
      <tr>
              <td>
                <center><?php echo $row->Nombre_F; ?></center>
              </td>
              <td>
                <center><?php echo $row->Fecha;  ?></center>
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
     
     
     
      
     

   

    
      




