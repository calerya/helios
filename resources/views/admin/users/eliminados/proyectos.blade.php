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
                
                <div class="card-header text-md-center">
                    <h5>Recuperar proyectos eliminados</h5>
                </div>
                
                            
                <table class="table table-hover" style="text-align:center;">
               
                <thead>
                    <tr class="table-primary">
                        <div><th width="20%" scope="col">Nombre</th></div>
                        <div><th width="10%" scope="col">Provincia</th></div>
                        <div><th width="20%"scope="col">Término municipal</th></div>
                        <div><th width="17%" scope="col">Sociedad</th></div>
                        <div><th width="6%" scope="col">Eliminado</th></div>
                        <div><th width="6%" scope="col">Hitos</th></div>
                        <div><th width="10%" scope="col">Opciones</th></div>
                    </tr>
                </thead>
                
                
                <tbody>
                    @foreach($proyectos as $proyecto)
                    <tr>
                        <div><td width="20%"><a href="/proyecto/{{ $proyecto->id }}/ver">{{ $proyecto->nom_proyecto }}</a></td></div>
                        <div><td width="10%">{{ $proyecto->provincia }}</td></div>
                        <div><td width="20%">{{ $proyecto->term_municipal }}</td></div>
                        <div><td width="17%">{{ $proyecto->sociedad }}</td></div>
                        <div><td width="6%">{{ $proyecto->deleted_at->format('d/m/Y') }}</td></div>
                        <div><td width="6%">{{ $proyecto->hitos }}</td></div>
                        <div><td width="10%">
                                                                               
                            <a href="/recuperar/{{ $proyecto->id }}/proyectos" class="btn btn-sm btn-success" title="Recuperar el proyecto">
                                <i class="fas fa-upload"></i>
                            </a></td></div>
                         
                      
                        
                    </tr>
                    @endforeach
                                       
                </tbody>
                
                
            </table>  
                        
                        
                    
                </div>
                    
     {{ $proyectos->links() }}

@endsection


  

