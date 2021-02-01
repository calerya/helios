@extends('layouts.app')

@section('content')

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
    
        <a class="navbar-brand" href="#">Listado de proyectos por hitos</a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
            <div class="collapse navbar-collapse" id="navbarColor03">
            
        
                <form id="hitos_form" class="form-inline my-2 my-lg-0" method="GET">
                    
                        <div class="form-group mr-sm-2">  
                            <select class="form-control" id="selecciona_hito" name="selecciona_hito" title="Selecciona el hito que deseas consultar">
                            <option value='-1'>Selecciona hitos completados</option>
                           
                            <option value='0' @if (session('seleccionado')=='0') selected  @endif>0 hitos</option>
                            <option value='1' @if (session('seleccionado')=='1') selected  @endif>1 hito</option>
                            <option value='2' @if (session('seleccionado')=='2') selected  @endif>2 hitos</option>
                            <option value='3' @if (session('seleccionado')=='3') selected  @endif>3 hitos</option>
                            <option value='4' @if (session('seleccionado')=='4') selected  @endif>4 hitos</option>
                            <option value='5' @if (session('seleccionado')=='5') selected  @endif>5 hitos</option>
                                                                
                            </select>
                                
                           
                        </div>
                    
                        <div class="form-group mr-sm-2">
                            <a id='hitosexcel' class="btn btn-sm btn-primary" title="Descargar EXCEL"><i class="fas fa-file-excel"></i></a>
                        </div>
               
                </form>  
       </div>  
</nav>
     <br>    

    <div class="row justify-content-center align-items-center">
        <fieldset class="border p-2  col-md-12">
             <legend class="w-auto">Listado de proyectos</legend>        
               
       
                <div class="col-md-12">
                <div class="table-responsive">
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
            
            
                <thead>
                    <tr class="table-primary">
                        <div style="col-md-2"><th scope="col">Nombre</th></div>
                        <div style="col-md-2"><th scope="col">Provincia</th></div>
                        <div style="col-md-2"><th scope="col">Término municipal</th></div>
                        <div style="col-md-1"><th scope="col">Sociedad</th></div>
                        <div style="col-md-1"><th scope="col">Dado de alta</th></div>
                        <div style="col-md-1"><th scope="col">Tot / Fin</th></div>
                        <div style="col-md-1"><th scope="col">Hitos</th></div>
                        <div style="col-md-2"><th scope="col">Opciones</th></div>
                    </tr>
                </thead>
                
                
                <tbody>
                    @if($proyectos)
                    @foreach($proyectos as $proyecto)
                    <tr>
                        <div style="col-md-2"><td><a href="/proyecto/{{ $proyecto->id }}/ver">{{ $proyecto->nom_proyecto }}</a></td></div>
                        <div style="col-md-2"><td>{{ $proyecto->provincia }}</td></div>
                        <div style="col-md-2"><td>{{ $proyecto->term_municipal }}</td></div>
                        <div style="col-md-1"><td>{{ $proyecto->sociedad }}</td></div>
                        <div style="col-md-1"><td>{{ $proyecto->created_at->format('d/m/Y') }}</td></div>
                        <div style="col-md-1"><td>{{ $proyecto->tot }} / {{ $proyecto->fin }}</td></div>
                        <div style="col-md-1"><td>{{ $proyecto->hitos }}</td></div>
                        <div style="col-md-2"><td>
                            
                          <a href="/proyecto/{{ $proyecto->id }}/excel" class="btn btn-sm btn-primary" title="Descargar EXCEL del proyecto"><i class="fas fa-file-excel"></i></a>
                          
                            
                            <a href="/proyecto/{{ $proyecto->id }}" class="btn btn-sm btn-primary" title="Editar">
                                <i class="far fa-edit"></i>
                            </a>
                            
                                                        
                           
                            
                        </td></div>
                    </tr>
                    @endforeach
                   @endif 
                           
                </tbody>
                    
              
            </table>
                    </div>
            </div>
            
        @if((!is_null($proyectos)) 
        and ($proyectos->count()==0) 
        and ((session('seleccionado')=='0') or (session('seleccionado')=='1') or (session('seleccionado')=='2')
        or (session('seleccionado')=='3') or (session('seleccionado')=='4') or (session('seleccionado')=='5')))
             
        <div class="row justify-content-center align-items-center">
            <h5>No hay proyectos activos que tengan {{ session('seleccionado') }} hitos</h5>
        </div>    
        @endif
    
            
                  
        </fieldset>    
        
     
        
</div>

@if($proyectos)
{{ $proyectos->withQueryString()->links() }}
@endif

                  
   
@endsection

@section('scripts')

    <script src="/js/admin/proyectos/listados.js"></script>
    

@endsection


