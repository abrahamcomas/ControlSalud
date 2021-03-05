<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
    <br>  
    <h3> 
      <center>
        <strong>AGREGAR PROFESORES JEFES DE CURSO</strong>
      </center>
    </h3>  
    <hr> 
    @include('messages') 
  	<div class="form-group">
    	<div class="form-label-group">
        <center><h5>LISTA DE PROFESORES</h5></center>
      	<select class="form-control" size="4" required>
        	@foreach ($Profesores as $row)
          	<option>{{ $row->Nombre_Prof }} {{ $row->Apellido_Prof }}</option>
        	@endforeach
      	</select> 
    	</div>                         
  	</div>    
    <center><h5>AGREGAR PROFESOR JEFE</h5></center>
    <br>
    <div class="form-group"> 
      <center><h6>RUT</h6></center>
      <div class="form-label-group">
      	<input class="form-control" type="text" wire:model="RutProfesor" 
        oninput="checkRut(this)" placeholder="Rut">
      </div>
    </div>
    <div class="form-group">
      <center><h6>NOMBRES</h6></center>
      <div class="form-label-group">
        <input class="form-control" type="text" wire:model="NombrePorfesor" 
        placeholder="Nombres">
      </div>
    </div>
    <div class="form-group">
      <center><h6>APELLIDOS</h6></center>
      <div class="form-label-group">
        <input class="form-control" type="text" wire:model="ApellidoProfesor" 
        placeholder="Apellidos">
      </div>
  	 </div> 
    <center>
      <button type="button" class="btn btn-info active" wire:click="Agregar">Agregar</button>
    </center> 
    <center>
    	<strong>
    		<br>
    		<h3><p style="color:#FF0000";>{{ $Resultado }}</p></h3>
    	</strong>  
    </center>
  </div>    
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

 
