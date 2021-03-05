 <div class="row"> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
	  <br>
    <h3>
      <center>  
        <strong>AGREGAR ALUMNOS</h3></strong>	
			</center> 
      <hr> 
    	<div class="form-label-group">
    		<center><h4>LISTA DE CURSOS</h4></center>
    		<select class="form-control" size="1" wire:model="ID_Curso">
            <option selected><strong>Seleccionar</strong></option>
      		@foreach ($ListaCursos as $row)
        			<option value="{{ $row->id_Curso }}">{{ $row->Nombre }} <strong>({{ $row->AnioCurso }})</strong></option>
      		@endforeach
    		</select> 
    	</div>
    	<hr>
    	<div class="form-label-group">
    			<center><h4>LISTA DE ALUMNOS DE <strong>({{ $NombreCursoSel }})</strong></h4></center>
      		<select class="form-control" size="4">
        		@foreach ($ListaAlumnos as $row)
          			<option>{{ $row->Nombres  }} <strong>({{ $row->Apellidos }})</strong></option>
        		@endforeach
      		</select> 
    	</div>
			<hr>
			<div class="panel-body"> 
				@include('messages')   
				<div class="form-group">
          <center><h6>RUT</h6></center>
        	<div class="form-label-group">
          	<input type="text" wire:model="Rut" class="form-control" 
          	placeholder="Rut" oninput="checkRut(this)">
        	</div>  
       	</div>	
			  <div class="form-group">
          <center><h6>NOMBRES</h6></center>
        	<div class="form-label-group">
          	<input type="text" wire:model="Nombres" class="form-control" 
          	placeholder="Nombres" >
        	</div> 
     	  </div>					                    
       	<div class="form-group">
            <center><h6>APELLIDOS</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="Apellidos" class="form-control" 
            	placeholder="Apellidos">
          	</div>
       	</div> 
       	<div class="form-group">
            <center><h6>DIRECCIÓN</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="Direccion" class="form-control" 
            	placeholder="Direccion" >
          	</div> 
       	</div>		
       	<div class="form-group">
            <center><h6>TELÉFONO</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="Telefono" class="form-control" 
            	placeholder="Teléfono" >
          	</div> 
       	</div>		
       	<div class="form-group">
            <center><h6>FECHA NACIMIENTO</h6></center>
          	<div class="form-label-group">
            	<input type="date" wire:model="FechaNacimiento" class="form-control">
          	</div> 
       	</div>		
       	<div class="form-group">
            <center><h6>APODERADA</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="Apoderada" class="form-control" 
            	placeholder="Apoderada" >
          	</div> 
       	</div>		
       	<div class="form-group"> 
            <center><h6>NUMERO APODERADA</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="NumeroApoderada" class="form-control" 
            	placeholder="Numero Teléfono Apoderada">
          	</div> 
       	</div>		
       	<div class="form-group">
            <center><h6>APODERADO</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="Apoderado" class="form-control" 
            	placeholder="Apoderado" >
          	</div> 
       	</div>		
       	<div class="form-group">
            <center><h6>NUMERO APODERADO</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="NumeroApoderado" class="form-control" 
            	placeholder="Numero Teléfono Apoderado" >
          	</div> 
       	</div>		 
       	<div class="form-group">
            <center><h6>OBSERVACIÓN</h6></center>
          	<div class="form-label-group">
            	<input type="text" wire:model="Observacion" class="form-control" 
            	placeholder="Abservación" >
          	</div> 
       	</div>		
       	<hr> 
        <center>
   				<button type="button" class="btn btn-info active" wire:click="AgregarAlumno">Agregar</button>
  			</center> 
  			<center>
        	<strong>
        		<br>
        		<h3><p>{{ $Resultado }}</p></h3>
        	</strong>  
  			</center>   
			</div> 
		</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div> 

