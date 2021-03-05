 <div class="row"> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
	  	<br>
      	<center>  
        	<strong><h3>AGREGAR Asistentes</h3></strong>	
		</center> 
      	<hr>  
    	<div class="form-label-group">
    		<center><h5>LISTA DE FUNCIONARIOS</h5></center>
    		<select class="form-control" size="4" disabled>
            <option selected><strong>Seleccionar</strong></option>
      		@foreach ($ListaAsistentes as $row)
        			<option>{{ $row->NombreAsistente }} <strong>({{ $row->ApellidoAsistente }})</strong></option>
      		@endforeach
    		</select> 
    	</div>
    	<hr>
		<div class="panel-body"> 
			@include('messages')
			<div class="form-group">
	          <center><h6>RUT</h6></center>
	        	<div class="form-label-group">
	          		<input type="text" wire:model="Rut" 
	          		class="form-control" placeholder="Rut" oninput="checkRut(this)">
	        	</div>  
	       	</div>
			<div class="form-group">
            	<center><h6>NOMBRES</h6></center>
          		<div class="form-label-group">
            		<input type="text" wire:model="Nombres" 
            		class="form-control" placeholder="Nombres">
          		</div>
       		</div>  
			<div class="form-group">
            	<center><h6>APELLIDOS</h6></center>
          		<div class="form-label-group">
            		<input type="text" wire:model="Apellidos" 
            		class="form-control" placeholder="Apellidos">
            	</div>
          	</div>
       		<hr> 
        	<center>
   				<button type="button" class="btn btn-info active" wire:click="AgregarAsistentes">Agregar</button>
  			</center> 
  			<center>
        		<strong><br><h3><p>{{ $Resultado }}</p></h3></strong>  
  			</center>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div> 

