<div> 
    <div class="row"> 
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
    	  	<br>
        	<center>    
          		<h4>
            		REPORTES OTORRINO
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
	        @if($ID_Curso!=0)
		        <div class="form-label-group">
		        	<center><h4>LISTA DE OTORRINOS</h4></center>
	          		<select class="form-control" wire:model="ID_Otorrino">
	            		<option selected><strong>Lista Otorrino</strong></option>
	    				@foreach ($ListaOtorrinos as $row)
	          				<option value="{{ $row->id_Otorrino }}">
	            				{{ $row->NombreOt  }} <strong>({{ $row->Anio }})</strong>
	          				</option>
	        			@endforeach
	      			</select> 
	        	</div> 
	        	<hr> 
	        	@if($ID_Otorrino!=0)
					<center> 
						<a href="{{ route('OtorrinoCrearPDF',['ID_Curso' => $ID_Curso,'NombreEscuela' => $NombreEscuela, 'ID_Otorrino'=> $ID_Otorrino]) }}" class="btn btn-success">Reporte PDF</a>
					
					</center>   
				@endif 
			@endif          
      	</div>
      	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
	</div>
</div>