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

    @if (session('busqueda'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('busqueda') }}
        </div>
    @endif

    @if (session('cancelado'))
        <div class="alert alert-dismissible alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('cancelado') }}
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

    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
      
        <a class="navbar-brand" href="#">Buscar proyectos</a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> --}}

      {{-- <div class="collapse navbar-collapse" id="navbarColor03">
               
            {!! Form::model(Request::all(),['route' => 'buscar', 'method' => 'GET', 'class' => 'form-inline  float-right' ] )!!}
          
             <div class="navbar-nav">
                 <div class="form-group mr-sm-2">
                    {{ Form::text('nom_proyecto',null,['class' => 'form-control','placeholder' => 'Nombre proyecto']) }}
                </div>
                <div class="form-group mr-sm-2">
                    {{ Form::text('provincia',null,['class' => 'form-control','placeholder' => 'Provincia']) }}
                </div>
                <div class="form-group mr-sm-2">
                    {{ Form::text('term_municipal',null,['class' => 'form-control','placeholder' => 'Término municipal']) }}
                </div>
                            
                <div class="form-group mr-sm-2">
                    <button title="Busca!!!"type="submit" class="btn btn-secondary my-2 my-sm-0" 
                    name="submit" value="submit"><i class="fas fa-search"></i></button>
                </div>
                
                <div class="form-group mr-sm-2">
                    <button title="Descargar excel de los proyectos seleccionados" type="submit" 
                    class="btn btn-success my-2 my-sm-0" name="excel" value="excel">
                    <i class="fas fa-file-excel"></i></button>
                </div>
                
                 
                 
            </div>
          
            {{ Form::close() }}
          
         
          
            
           
      </div>
    </nav>

     <br>    --}}

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

      
        <div class="w-auto row justify-content-center align-items-center bg-light mb-2 p-2">
            
                <h4 class="col-9 text-center"><i class="fas fa-solar-panel"></i> Gestión de proyectos</h4>   
                <div class="col-3 justify-content-center align-items-center float-right">
               
                <a href="/proyectos" 
                    class="btn btn-primary btn-sm"
                    title="Añadir nuevo proyecto">
                    <i class="fas fa-plus"></i></a>
{{--                 
                <a href="/buscador" class="btn btn-sm btn-primary"
                 title="Volver al buscador de proyectos">
                  <i class="fas fa-search"></i>
                </a> --}}
              </div>
            </div>

            <div class="table-responsive">
                {{-- <table class="table table-hover table-bordered yajra-datatable" style="text-align:center;"> --}}
            <table class="table table-striped yajra-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <div><th width="19%" scope="col">Nombre</th></div>
                        <div><th width="12%" scope="col">Provincia</th></div>
                        <div><th width="15%"scope="col">Término municipal</th></div>
                        <div><th width="14%" scope="col">Sociedad</th></div>
                        <div><th width="9%" scope="col">Técnico</th></div>
                        <div><th width="9%" scope="col">Alta</th></div>
                        <div><th width="4%" scope="col"><a class="btn btn-primary btn-sm" title="Organismos">
                            <i class="fas fa-university"></i></a></th></div>
                        <div><th width="4%" scope="col"><a class="btn btn-primary btn-sm" title="Fincas">
                            <i class="fas fa-map-marked-alt"></i>
                            </a></th></div>
                        <div><th width="14%" scope="col">Opciones</th></div>
                    </tr>
                </thead>
                                
                <tbody>
                    {{-- @foreach($proyectos as $proyecto)
                    <tr>
                        <div><td width="19%"><a href="/proyecto/{{ $proyecto->id }}/ver">{{ $proyecto->nom_proyecto }}</a></td></div>
                        <div><td width="11%">{{ $proyecto->provincia }}</td></div>
                        <div><td width="17%">{{ $proyecto->term_municipal }}</td></div>
                        <div><td width="14%">{{ $proyecto->sociedad}}</td></div>
                        <div><td width="8%">{{ $proyecto->usu}}</td></div>
                        <div><td width="8%" title="Fecha de alta en el programa del proyecto">{{ $proyecto->created_at->format('d/m/Y') }}</td></div>
                        
                                                
                        <div><td width="8%" title="Organismos totales / organismos finalizados">{{ $proyecto->tot }} / {{ $proyecto->fin }}</td></div>
                        <div><td width="15%">
                            
                            
                                                        
                            <a href="/proyecto/{{ $proyecto->id }}/excel" class="btn btn-sm btn-primary" title="Descargar EXCEL del proyecto"><i class="fas fa-file-excel"></i></a>
                            
                            <a href="/proyecto/{{ $proyecto->id }}" class="btn btn-sm btn-primary" title="Editar el proyecto">
                                <i class="far fa-edit"></i>
                            </a>
                            
                            <a href="/organismo/{{$proyecto->id}}/ver" class="btn btn-sm btn-primary" title="Añadir organismo al proyecto" 
                                id="boton-alta-org" ><i class="fas fa-plus-square"></i>
                            </a>
                            
                             @if (($proyecto->tot>0)and($proyecto->tot==$proyecto->fin))
                            <a href="/proyecto/{{ $proyecto->id }}/finalizar" class="btn btn-sm btn-success" title="Dar por finalizado el proyecto">
                                <i class="fas fa-flag-checkered"></i>
                            </a>
                            @endif
                            
                            
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal" title="Eliminar el proyecto, sus organismos y sus hitos"><i class="fas fa-trash-alt"></i></button>
                            
                            <div class="modal" id="exampleModal">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Eliminar proyecto</h5>
                                      
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="text-center">
                                        <span class="text-warning"><i style="font-size:70px" class="fas fa-exclamation-circle"></i></span>  
                                    </div>
                                    <p>Quiere eliminar el proyecto {{$proyecto->nom_proyecto}} sus hitos y sus organismos?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      <a href="/proyecto/{{ $proyecto->id }}/eliminar"><button class="btn btn-danger">Eliminar</button></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                                                      
            
                        </td></div>
                    </tr>
                    @endforeach
                                        --}}
                
                </tbody>
                 
            </table>
            </div>
          
                  
      
     
    {{-- {!! $proyectos->appends(Request::except('page'))->render() !!}  
         <h6>Total {{ $proyectos->total() }} proyecto(s).</h6> --}}


            
   
@endsection


@section('scripts')



<script type="text/javascript">

    $(function () {
        var table = $('.yajra-datatable').DataTable({
          "language":  {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
          processing: true,
          serverSide: true,
          ajax: "{{ route('buscar.proyectos') }}",
          columns: [
              {data: 'nom_proyecto', name: 'nom_proyecto'},
              {data: 'provincia', name: 'provincia'},
              {data: 'term_municipal', name: 'term_municipal'},
              {data: 'sociedad', name: 'sociedad'},
              {data: 'usu', name: 'usu'},
              {data: 'created_at', name: 'created_at'},
              {data: 'link', name: 'link'},
              {data: 'fin', name: 'fin'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: false, 
                  searchable: false
              },
          ],
          columnDefs: [ 
              {'targets': [5,6,7], // column index (start from 0)
               'orderable': false, // set orderable false for selected columns
               'searchable': false,
               //'className': 'text-center',
              },
               {
                'targets': [5,6,7,8],
                'className': 'text-center ',
               
              },
             
          ],
      });
      
    });
  </script>
  
@endsection 
  

