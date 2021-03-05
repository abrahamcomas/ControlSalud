<div>
  @if($IngresoDatos==0 AND $M_Detalles==0)
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <br>
        <center>  
          <h4>
            INGRESAR FLUOR <strong>{{ $AnioActual }}</strong>
          </h4>
        </center> 
        <div class="form-label-group">
          <center><h5>LISTA DE CURSOS</h5></center>
          <select class="form-control" size="1" wire:model="ID_Curso">
            <option selected><strong>Seleccionar</strong></option>
            @foreach ($ListaCursos as $row)
              <option value="{{ $row->id_Curso }}">
                {{ $row->Nombre }} <strong>({{ $row->AnioCurso }})</strong>
              </option>
            @endforeach
          </select> 
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4"></div>
    </div>
    <br>
    <center>
      <strong>
        <h3><strong>{{ $Resultado }}</strong></p></h3>
      </strong>  
    </center> 
    {{--LISTA DE ALUMNOS --}}
    @if($ID_Curso!=0)
      <div class="row"> 
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
          <table table class="table table-hover"> 
            <thead>
              <tr> 
                <th><center>RUT</center></th>
                <th><center>NOMBRES</center></th>
                <th><center>APELLIDOS</center></th>
                <th><center>Detalles</center></th>
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
                      <button type="button" class="btn btn-success active" 
                          wire:click="Detalles({{ $row->id_Alumno }})">
                          Detalles
                      </button>
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
    @endif
  @endif
  {{-- DETALLES ALUMNOS --}}
  @if($M_Detalles==1)
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <br>
        <center>  
          <h4>
            <strong>DETALLES ALUMNO <br>
            </strong>
          </h4>
        </center>
        <hr> 
        <div class="form-group">
          <center>
            <strong>
              <h6>NOMBRE: {{ $Nombres }} {{ $Apellidos }}</h6>
              <h6>RUT: {{ $Rut }}</h6>
              <h6>DIRECCIÓN: {{ $Direccion }}</h6>
              <h6>TELÉFONO ALUMNO: {{ $Telefono }}</h6>
              <h6>FECHA NACIMIENTO: {{ $FechaNac }}</h6>
              <h6>APODERADA: {{ $Mama }}</h6>
              <h6>TELÉFONO APODERADA: {{ $NumeroMama }}</h6>
              <h6>APODERADO: {{ $Papa }}</h6>
              <h6>TELÉFONO APODERADO: {{ $NumeroPapa }}</h6>
              <h6>OBSERVACION:</h6>
              <textarea class="md-textarea form-control" wire:model="Observacion" rows="2" disabled></textarea>
            </strong>
          </center>
        </div> 
        <hr>
        <center>  
          <h4>
            <strong>LISTA FLUOR</strong>
          </h4>
        </center>
        <table table class="table table-hover"> 
          <thead>
            <tr> 
              <th><center>ESTADO</center></th>
              <th><center>NOMBRE</center></th>
              <th><center>FECHA</center></th>
              <th><center>OBSERVACIÓN</center></th>
            </tr> 
          </thead>
          <tbody>
            @foreach($ListaFluorIngresadas as $row) 
              <tr>
                @if($row->Aceptada==1)
                    <td>
                      <div class="progress" style="height: 40px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                          role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" 
                          aria-valuemax="100">
                          <strong>Aprobada</strong> 
                        </div>
                      </div>
                    </td>
                @elseif($row->Aceptada==2)
                    <td>
                      <div class="progress" style="height: 40px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" 
                          role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                          <strong>Rechazada</strong> 
                        </div>
                      </div>
                    </td>
                @elseif($row->Aceptada==3)
                    <td>
                      <div class="progress" style="height: 40px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" 
                          role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                          <strong>Consultorio</strong> 
                        </div>
                      </div>
                    </td>
                @endif 
                    <td>
                      <center>{{ $row->Nombre_F }}</center>
                    </td>
                    <td>
                      <center>{{ $row->Fecha }}</center>
                    </td>  
                    <td>
                      <center>{{ $row->Observacion }}</center>
                    </td> 
                @if($row->Aceptada==1 || $row->Aceptada==2 || $row->Aceptada==3)
                    <td> 
                      <center>
                        <button type="button" class="btn btn-success active" 
                          wire:click="EditarFluor({{ $row->id_Fluor_T }})">
                          Editar
                        </button>
                      </center>  
                    </td>
                @endif 
              </tr>
            @endforeach
          </tbody>
        </table> 
        <hr> 
        <center>  
          <h4>
            <strong>INGRESAR FLUOR</strong>
          </h4>
        </center>
        @include('messages')   
        <div class="form-group">
          <select class="form-control" wire:model="ID_Vacunas">
            <option selected><strong>Lista Vacunas</strong></option>
            @foreach ($ListaFluor as $row)
              <option value="{{ $row->id_Fluor }}">
                {{ $row->Nombre_F }} <strong>({{ $row->Anio }})</strong>
              </option>
            @endforeach
          </select> 
        </div> 
        <div class="form-group">
          <center><h6>ESTADO</h6></center>
          <select class="form-control" wire:model="Estado">
            <option selected><strong>Seleccionar</strong></option>
            <option value="1">SI</option>
            <option value="2">NO</option>
            <option value="3">Consultorio</option>
          </select> 
        </div>  
        <div class="form-group">
          <center><h6>FECHA</h6></center>
          <div class="form-label-group">
            <input type="date" wire:model="FechaFluor" class="form-control">
          </div> 
        </div> 
        <div class="form-group">
          <center><h6>OBSERVACIÓN</h6></center>
          <div class="form-label-group">
            <textarea class="md-textarea form-control" wire:model="ObservacionIngreso" rows="3" maxlength="200" placeholder="Máximo 500 caracteres"></textarea>
          </div> 
        </div> 
        <hr>
        <div class="row"> 
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <center>
              <button type="button" class="btn btn-danger active" wire:click="CancelarIngreso">
                Cancelar
              </button>
            </center> 
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <center>
              <button type="button" class="btn btn-info active" wire:click="IngresarResultado">
                Aceptar
              </button>
            </center> 
          </div>
        </div>
        <hr>
      </div> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
  @endif

  @if($IngresoDatos==2 AND $M_Detalles==2)
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <br>
        <center>  
          <h4>
            <strong>EDITAR DATOS {{ $NombresFluorEditar}}</strong>
          </h4>
        </center>
        <hr> 
        @include('messages')   
        <div class="form-group">
          <center><h6>ESTADO</h6></center>
          <select class="form-control" wire:model="ED_Estado">
            <option value="1">SI</option>
            <option value="2">NO</option>
            <option value="3">Consultorio</option>
          </select> 
        </div>  
         <div class="form-group">
          <center><h6>FECHA</h6></center>
          <div class="form-label-group">
            <input type="date" wire:model="ED_FechaFluor" class="form-control">
          </div> 
        </div> 
        <div class="form-group">
          <center><h6>OBSERVACIÓN</h6></center>
          <div class="form-label-group">
            <textarea class="md-textarea form-control" wire:model="ED_Observacion" rows="3" maxlength="200" placeholder="Máximo 500 caracteres"></textarea>
          </div> 
        </div> 
        <hr>
        <div class="row"> 
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <center>
              <button type="button" class="btn btn-danger active" wire:click="CancelarIngreso">
                Cancelar
              </button> 
            </center> 
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <center>
              <button type="button" class="btn btn-info active" 
                  wire:click="EditarIngresoResultado">
                Editar
              </button>
            </center> 
          </div>
        </div>  
      </div> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
    </div>
  @endif
</div> 


  

  
  

