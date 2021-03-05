<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
    <br> 
    <h3> 
      <center>
        <strong>EDITAR PROFESORES JEFES DE CURSO</strong>
      </center>
    </h3>  
    <hr> 
    @include('messages') 
  	<div class="form-group">
    	<div class="form-label-group">
        <center><h5>LISTA DE PROFESORES</h5></center>
      	<select class="form-control" size="4" wire:model="ID_Seleccionado">
        	@foreach ($Profesores as $row)
          	<option value="{{ $row->id_Profesores }}">
              {{ $row->Nombre_Prof }} {{ $row->Apellido_Prof }}
            </option>
        	@endforeach
      	</select> 
    	</div>
      <hr>
      <center>
        <button type="button" class="btn btn-info active" wire:click="ProfesorSeleccionado">
          seleccionar
        </button>
      </center>                         
  	</div>        
    <center><h5>EDITAR PROFESOR JEFE</h5></center>
    <br>
  	<div class="form-group">
      <center><h6>RUT</h6></center>
      <div class="form-label-group">
        <input class="form-control" type="text" wire:model="Rut" 
        oninput="checkRut(this)" placeholder="Rut" disabled>
      </div>
    </div> 
    <div class="form-group">
      <center><h6>NOMBRES</h6></center>
      <div class="form-label-group">
        <input class="form-control" type="text" wire:model="Nombre_Prof" 
        placeholder="Nombres">
      </div>
    </div> 
    <div class="form-group">
      <center><h6>APELLIDOS</h6></center>
      <div class="form-label-group">
        <input class="form-control" type="text" wire:model="Apellido_Prof" 
        placeholder="Apellidos">
      </div> 
    </div>  
    <hr>
    <center>
       <button type="button" class="btn btn-info active" wire:click="update">Actualizar</button>
    </center> 
    <center>
    	<strong>
    		<br>
    		<h3><p><strong>{{ $Resultado }}</strong></p></h3>
    	</strong>  
    </center>    
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

 
 