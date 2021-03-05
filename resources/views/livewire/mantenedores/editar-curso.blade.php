<div class="row"> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
		<br>
		<h3>
			<center> 
				<strong>EDITAR CURSO</strong>	
			</center>  
		</h3>
		<hr> 
		@include('messages')  
    	<div class="form-label-group">
    		<center><h5>LISTA DE CURSOS</h5></center>
      		<select class="form-control" size="4" wire:model="ID_Curso">
        		@foreach ($ListaCursos as $row)
          			<option value="{{ $row->id_Curso }}">{{ $row->Nombre  }} {{ $row->AnioCurso }} ({{ $row->Nombre_Prof }} {{ $row->Apellido_Prof }})</strong></option>
        		@endforeach
      		</select> 
      		<br>
      		<center>
            	<button type="button" class="btn btn-info active" wire:click="CursoSeleccionado">
               		seleccionar
            	</button>
          	</center>  
    	</div>  
		<hr>
		@if($Editar=='1') 
			<div class="panel-body">  
	       		<div class="form-group">
        			<center><h6>NOMBRE CURSO</h6></center>
		        	<div class="form-label-group">
		         		<input type="text" wire:model="Nombre" class="form-control" 
		            	placeholder="Nombre Curso" >
		        	</div>
      			</div>					                    
		       	<div class="form-group">
		          	<div class="form-label-group">
		          		<center><h6>PROFESOR JEFE</h6></center>
		          		<select class="form-control" size="4" wire:model="id_Profesores">
		            		@foreach ($Profesores as $row)
		              			<option value="{{ $row->id_Profesores }}">{{ $row->Nombre_Prof  }} {{ $row->Apellido_Prof }}</strong></option>
		            		@endforeach
		          		</select>  
					</div>
		       	</div>
	      		<hr>
		        <center>
					<button type="button" class="btn btn-info active" wire:click="UpdateCurso">Editar</button>
				</center>
			</div>
		@endif
		<center>
        	<strong>
        		<br>
        		<h3><strong>{{ $Resultado }}</strong></h3>
        	</strong>  
		</center>   
	</div> 
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
</div>

