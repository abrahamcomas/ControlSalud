<div class="row"> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
		<br>
		<h3>
			<center> 
				<strong>REGISTRAR VACUNAS</strong>	
			</center>  
		</h3>
		@include('messages')  
		<hr>
    	<div class="form-label-group">
    		<center><h5>LISTA DE VACUNAS</h5></center>
      		<select class="form-control" size="4" disabled >
        		@foreach ($ListaVacunas as $row)
          			<option value="{{ $row->id_vacunas }}">
          				{{ $row->Nombre_V  }} <strong>({{ $row->Anio }})</strong>
          			</option>
        		@endforeach
      		</select> 
    	</div> 
		<br>   
		{{-- <hr style="width:100%; border-color: blue;"> --}}
		<hr>
		<div class="panel-body"> 
			 <div class="form-group">
	          	<div class="form-label-group">
	            	<input type="text" wire:model="NombreVacuna" class="form-control" 
	            	placeholder="Ingresar Vacuna {{ $AnioActual }}">
	          	</div> 
	       	</div>					                    
	      <hr>
	        <center>
					<button type="button" class="btn btn-info active" wire:click="Agregar">Agregar</button>
			</center> 
			<center>
	        	<strong>
	        		<br>
	        		<h3><strong>{{ $Resultado }}</strong></p></h3>
	        	</strong>  
			</center>   
		</div>
	</div> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

