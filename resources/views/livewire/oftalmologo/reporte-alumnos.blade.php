<div class="row"> 
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
	  <br>
    <center>  
      <h4>
        REPORTE VACUNAS ALUMNOS
      </h4>
		</center> 
    <hr>
    <div class="form-label-group">
    	<center><h4>LISTA DE CURSOS</h4></center>
    	<select class="form-control" size="1" wire:model="ID_Curso">
        <option selected><strong>Seleccionar</strong></option>
      	@foreach ($ListaCursos as $row)
        	<option value="{{ $row->id_Curso }}">
            {{ $row->Nombre }} <strong>({{ $row->AnioCurso }})</strong>
          </option>
      	@endforeach
    	</select> 
    </div>
    <hr>
    <table table class="table table-hover"> 
      <thead>
        <tr> 
          <th><center>RUT</center></th>
          <th><center>NOMBRES</center></th>
          <th><center>APELLIDOS</center></th>
          <th><center>RESULTADO</center></th>
        </tr>  
      </thead>
      <tbody>
        @foreach($ListaAlumnos as $row) 
          <tr>
            <td>
              <center>{{ $row->Rut }}</center>
            </td>
            <td>
              <center>{{ $row->Nombres }}</center>
            </td> 
            <td>
              <center>{{ $row->Apellidos }}</center>   
            </td> 
            <td>   
              <center> 
                <a href="{{ route('OftalmologoReporteAlumnoPDF',['id_Alumno' => $row->id_Alumno]) }}" class="btn btn-success">Reporte PDF</a>
              </center>  
            </td> 
          </tr>
        @endforeach
      </tbody>
    </table> 
    {{ $ListaAlumnos->links() }}
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
</div> 


  

  
	

