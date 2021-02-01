@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('status') }}
        </div>
    @endif

    @if (session('eliminado'))
        <div class="alert alert-dismissible alert-danger">
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

    @if (session('activado'))
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('activado') }}
        </div>
    @endif

    @if (session('busqueda'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('busqueda') }}
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      
        <a class="navbar-brand" href="#">Buscar proyectos</a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor03">
               
            {{ Form::open(['route' => 'finalizados', 'method' => 'GET', 'class' => 'form-inline  float-right' ]) }}
          
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
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
                </div>
                 
            </div>
          
            {{ Form::close() }}
            
           
      </div>
    </nav>

     <br>    

   
    <div class="row justify-content-center align-items-center">
        <fieldset class="border p-2  col-md-12">
             <legend class="w-auto">Listado de proyectos finalizados</legend>        
               
       
                <div class="col-md-12">
                <div class="table-responsive">
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
            
            
                <thead>
                    <tr class="table-primary">
                        <div><th width="22%" scope="col">Nombre</th></div>
                        <div><th width="10%" scope="col">Provincia</th></div>
                        <div><th width="22%"scope="col">Término municipal</th></div>
                        <div><th width="17%" scope="col">Sociedad</th></div>
                        <div><th width="9%" scope="col">Alta</th></div>
                        <div><th width="10%" scope="col">Total org.</th></div>
                        <div><th width="10%" scope="col">Opciones</th></div>
                    </tr>
                </thead>
                
                
                <tbody>
                    @foreach($proyectos as $proyecto)
                    <tr>
                        <div><td width="22%"><a href="/proyecto/{{ $proyecto->id }}/ver">{{ $proyecto->nom_proyecto }}</a></td></div>
                        <div><td width="10%">{{ $proyecto->provincia }}</td></div>
                        <div><td width="22%">{{ $proyecto->term_municipal }}</td></div>
                        <div><td width="17%">{{ $proyecto->sociedad }}</td></div>
                        <div><td width="9%">{{ $proyecto->created_at->format('d/m/Y') }}</td></div>
                        <div><td width="10%">{{ $proyecto->tot }}</td></div>
                        <div><td width="10%">
                            
                            <a href="/proyecto/{{ $proyecto->id }}/excel" class="btn btn-sm btn-primary" title="Descargar EXCEL del proyecto"><i class="fas fa-file-excel"></i></a>
                            
                            <a href="/proyecto/{{ $proyecto->id }}/activar" class="btn btn-sm btn-warning" title="Volver a activar el proyecto">
                                <i class="fas fa-flag-checkered"></i>
                            </a>
                            
                            
                        </td></div>
                    </tr>
                    @endforeach
                   
                           
                </tbody>
                    
                   
                   {{ $proyectos->render() }}      
            </table>
            </div>       
            </div>
            
            @if(!is_null($proyectos))
        @if($proyectos->count()==0)
      
        <div class="row justify-content-center align-items-center">
            <h5>No hay registros que cumplan con el criterio seleccionado</h5>
        </div>    
    @endif
    @endif   
            
                  
        </fieldset>    
        
     
        
</div>

                  
   
@endsection

@section('scripts')

    <script src="/js/admin/proyectos/proy_buscador.js"></script>
    

@endsection


