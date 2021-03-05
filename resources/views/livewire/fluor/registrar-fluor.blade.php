<div class="row"> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
		<br>
		<h3>
			<center> 
				<strong>REGISTRAR FLUOR</strong>	
			</center>  
		</h3>
		@include('messages')  
		<hr>
    	<div class="form-label-group">
    		<center><h5>LISTA DE FLUOR</h5></center>
      		<select class="form-control" size="4" disabled >
        		@foreach ($ListaFluor as $row)
          			<option>
          				{{ $row->Nombre_F  }} <strong>({{ $row->Anio }})</strong>
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
	            	<input type="text" wire:model="NombreFluor" class="form-control" 
	            	placeholder="Ingresar Fluor {{ $AnioActual }}">
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

