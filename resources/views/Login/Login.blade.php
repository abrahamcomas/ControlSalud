@extends('App')
@section('content')
<div class="container-fluid">  
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
			<br>
			@include('messages')
			<div class="panel panel-default">
				<div class="panel-heading">
					<center><h3><strong>INICIAR SESIÓN</strong></h3></center> 
					<hr style="width:100%; border-color: blue;">
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('Login') }}">  
						@csrf   
						<div class="form-group">
	                      	<div class="form-label-group">
	                        	<input type="text" class="form-control" name="RUN" id="RUN" oninput="checkRut(this)" placeholder="Rut" value="{{ old('RUN') }}">
	                      	</div>
	                    </div>
	                    <div class="form-group">
	                      	<div class="form-label-group">
	                        	<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" autocomplete="on">
	                      	</div>
	                   	</div>
	                   	<hr style="width:100%; border-color: blue;">
	                   	<center><button type="submit" class="btn btn-success active btn-info">Aceptar</button></center>
					</form>
				</div>
			</div> 
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
	</div>
</div>
@endsection