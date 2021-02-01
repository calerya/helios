@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('status') }}
        </div>
    @endif

    @if (session('eliminado'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('eliminado') }}
        </div>
    @endif

    @if (session('cancelado'))
        <div class="alert alert-dismissible alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('cancelado') }}
        </div>
    @endif

    @if (session('finalizado'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('finalizado') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-dismissible alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach
            </ul>
            
        </div>
    @endif

  <div class="card border-primary mb-3">  
    <div class="card-body">
        <fieldset class="border p-2">
        <legend class="w-auto"> Propietarios del proyecto: {{ $proyecto->nom_proyecto }} </legend>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
      
        <a class="navbar-brand" href="#">Buscar propietarios</a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor03">
               
            {{ Form::open(['route' => 'buscar', 'method' => 'GET', 'class' => 'form-inline  float-right' ]) }}
          
             <div class="navbar-nav">
                 <div class="form-group mr-sm-2">
                    {{ Form::text('nom_proyecto',null,['class' => 'form-control','placeholder' => 'Seleccionar polígono']) }}
                </div>
                <div class="form-group mr-sm-2">
                    {{ Form::text('provincia',null,['class' => 'form-control','placeholder' => 'Seleccionar parcela']) }}
                </div>
                <div class="form-group mr-sm-2">
                    {{ Form::text('term_municipal',null,['class' => 'form-control','placeholder' => 'Buscar texto']) }}
                </div>
                            
                 <div class="form-group mr-sm-2">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" title="Deshabilitado" disabled>Buscar</button>
                </div>
                
                <div class="form-group mr-sm-2">
                  <a href="/propietario/{{ $proyecto->id }}/añadir" class="btn btn-secondary my-2 my-sm-0" title="Añadir propietario">Añadir</a>
                </div>
                
                <div class="form-group mr-sm-2">
                  <a href="/proyecto/{{ $proyecto->id }}/ver" class="btn btn-secondary my-2 my-sm-0" title="Volver al proyecto {{ $proyecto->nom_proyecto }}">Volver</a>
                </div>

            </div>
          
            {{ Form::close() }}
            
           
      </div>
    </nav>
            <br>

            <div class="col-md-12">
                <div class="table-responsive">
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
               
                <thead>
                    <tr class="table-primary">
                        <div><th width="10%" scope="col">Firmado</th></div>
                        <div><th width="23%" scope="col">Titular</th></div>
                        <div><th width="9%" scope="col">Polígono</th></div>
                        <div><th width="9%"scope="col">Parcela</th></div>
                        <div><th width="14%" scope="col">Ref. catastral</th></div>
                        <div><th width="10%" scope="col">Teléfono</th></div>
                        <div><th width="10%" scope="col">DNI/NIE</th></div>
                        <div><th width="15%" scope="col">Opciones</th></div>
                    </tr>
                </thead>
                
                
                <tbody>
                    @if(($propietarios->count())==0)
                        <div class="text-md-center">
                            <h5>Aún no hay propietarios grabados en este proyecto</h5>
                        </div>
                    
                    @else
                    @foreach($propietarios as $propietario)
                    <tr>
                        <div><td width="10%">{{ $propietario->firmado }}</td></div>
                        <div><td width="23%">{{ $propietario->titular }}</td></div>
                        <div><td width="9%">{{ $propietario->poligono }}</td></div>
                        <div><td width="9%">{{ $propietario->parcela }}</td></div>
                        <div><td width="14%">{{ $propietario->ref_catastral }}</td></div>
                        <div><td width="10%" >{{ $propietario->telefono }}</td></div>
                        <div><td width="10%" >{{ $propietario->dni }}</td></div>
                                                
                        
                        <div><td width="15%">
                            
                        
                            
                            <!--
                            <a href="/proyecto/{{ $proyecto->id }}/ver" class="btn btn-sm btn-primary" title="Ver">
                                <i class="far fa-eye"></i>
                            </a> -->
                            
                            
                            <a href="/propietario/{{ $propietario->id }}" class="btn btn-sm btn-primary" title="Editar el propietario">
                                <i class="far fa-edit"></i>
                            </a>
                            
                                                        
                             
                            
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal" title="Eliminar el propietario"><i class="fas fa-trash-alt"></i></button>
                            
                            <div class="modal" id="exampleModal">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Eliminar propietario</h5>
                                      
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                    
                                    
                                    
                                  <div class="modal-body">
                                    <div class="text-center">
                                        <span class="text-warning"><i style="font-size:70px" class="fas fa-exclamation-circle"></i></span>  
                                    </div>
                                    <p>Quiere eliminar el propietario {{$propietario->titular}} ?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      <a href="/propietario/{{ $propietario->id }}/eliminar"><button class="btn btn-danger">Eliminar</button></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                                                      
            
                        </td></div>
                    </tr>
                    @endforeach
                               
                </tbody>
              </table>  
             @endif       
        </div>  
        </div>
     </fieldset>        
    </div>
                    
</div>
                    
     {{ $propietarios->links() }}

@endsection


  

