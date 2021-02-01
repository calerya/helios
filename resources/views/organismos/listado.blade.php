@extends('layouts.app')

@section('content')

    @if (session('busqueda'))
    <div class="alert alert-dismissible alert-warning">
        {{ session('busqueda') }}
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
    
        <a class="navbar-brand" href="#">Listado de organismos / expedientes: </a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
    <div class="collapse navbar-collapse" id="navbarColor03">
        
                <form id="listado_form" class="form-inline my-2 my-lg-0" method="GET">
                    
                        <div class="form-group mr-sm-2">  
                            <select class="form-control" id="selecciona_listado" name="selecciona_listado" title="Selecciona el listado que deseas obtener">
                            <option value='-1'>Selecciona listado</option>
                           
                            <option value="Todos" @if (session('seleccionado')=='Todos') selected  @endif>Todos los organismos / expedientes activos</option>
                                
                            <option value="Caducados" @if (session('seleccionado')=='Caducados') selected  @endif>Caducados o que caducan en 30 días</option>

                            <option value="Requerimiento" @if (session('seleccionado')=='Requerimiento') selected  @endif>Sin contestación del requerimiento</option>
                                
                            <option value="Prorroga" @if (session('seleccionado')=='Prorroga') selected  @endif>Pendientes de conceder la prórroga</option>
                                
                            <option value="APM" @if (session('seleccionado')=='APM') selected  @endif>Pendientes de APM</option>
                                
                            <option value="Con-resolucion" @if (session('seleccionado')=='Con-resolucion') selected  @endif>Con resolución</option>
                                
                            <option value="Sin-resolucion" @if (session('seleccionado')=='Sin-resolucion') selected  @endif>Pendientes de resolución</option>
                                
                            <option value="Finalizados" @if (session('seleccionado')=='Finalizados') selected  @endif>Organismos / expedientes finalizados</option>
                                
                            </select>
                                
                           
                        </div>
                    
                        <div class="form-group mr-sm-2">
                            <a id='enexcel' class="btn btn-sm btn-primary" title="Descargar EXCEL"><i class="fas fa-file-excel"></i></a>
                        </div>
                                                 
                        <!--
                        ANULAMOS LA DESCARGA EN PDF POR TARDAR DEMASIADO
                        <div class="form-group mr-sm-2">
                            <a id='enpdf' class="btn btn-sm btn-primary" title="Descargar en PDF"><i class="far fa-file-pdf fa-2x"></i></a>
                         </div>
                        -->
                    
                        
                        
                                                   
             </form>
      
          </div>
        
        
        
       
</nav>

     <br>    

    <div class="row justify-content-center align-items-center">
        <fieldset class="border p-2  col-md-12">
                    
                <div class="col-md-12">
                <div class="table-responsive">
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
            
            
                <thead>
                    <tr class="table-primary">
                        <th scope="col" width="8%"><small>Proyecto</small></th>
                        <th scope="col" width="8%"><small>Organismo</small></th>
                        <th scope="col" width="8%"><small>Expediente</small></th>
                        <th scope="col" width="7%"><small>Presentación</small></th>
                        <th scope="col" width="7%"><small>Requerimiento</small></th>
                        <th scope="col" width="7%"><small>Contest. req.</small></th>
                        <th scope="col" width="7%"><small>Resolución</small></th>
                        <th scope="col" width="7%"><small>Caducidad</small></th>
                        <th scope="col" width="7%"><small>Sol. prórroga</small></th>
                        <th scope="col" width="7%"><small>Concesión</small></th>
                        <th scope="col" width="7%"><small>Solic. APM</small></th>
                        <th scope="col" width="7%"><small>Conc. APM</small></th>
                        <th scope="col" width="13%"><small>Opciones</small></th>
                    </tr>
                </thead>
                
                <tbody>
                @if($organismos)
                
                    @foreach($organismos as $organismo)
                    <tr>
                        <td width="8%" class="text-danger"><a href="/proyecto/{{ $organismo->proyecto_id }}/ver">{{ $organismo->nombre }}</a></td>
                        <td width="8%"><small>{{ $organismo->organismo }}</small></td>
                        <td width="8%"><small>{{ $organismo->num_expediente }}</small></td>
                        <td width="7%"><small>@if($organismo->fec_presentacion) {{ $organismo->fec_presentacion->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_requerimiento) {{ $organismo->fec_requerimiento->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_cont_requerimiento) {{ $organismo->fec_cont_requerimiento->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_resolucion) {{ $organismo->fec_resolucion->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_caducidad) {{ $organismo->fec_caducidad->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_solic_prorroga) {{ $organismo->fec_solic_prorroga->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_concesion_pror) {{ $organismo->fec_concesion_pror->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_solic_apm) {{ $organismo->fec_solic_apm->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_conc_apm) {{ $organismo->fec_conc_apm->format('d/m/Y') }} @endif</small></td>
                        
                        <td width="13%">
                                                                              
                            <a href="/organismo/{{ $organismo->id }}" class="btn btn-sm btn-primary" title="Editar organismo"><i class="far fa-edit"></i>
                            </a>
                            
                            @if (session('seleccionado')!='Finalizados')
                            <a href="/organismo/{{ $organismo->id }}/finalizar" class="btn btn-sm btn-success" title="Dar el organismo/expediente por finalizado"><i class="fas fa-flag-checkered"></i>
                            </a>
                            @endif
                            
                            @if (session('seleccionado')=='Finalizados')
                            <a href="/organismo/{{ $organismo->id }}/activar" class="btn btn-sm btn-warning" title="Activar el organismo (Ya no estará finalizado)"><i class="fas fa-flag-checkered"></i>
                            </a>
                            @endif
                            
                                                      
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal" title="Eliminar el organismo"><i class="fas fa-trash-alt"></i></button>
                            
                            <div class="modal" id="exampleModal">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Eliminar organismo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="text-center">
                                        <span class="text-warning"><i style="font-size:70px" class="fas fa-exclamation-circle"></i></span>  
                                    </div>
                                    <p>Quiere eliminar el organismo {{$organismo->organismo}} perteneciente al proyecto {{$organismo->nombre}}?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      <a href="/organismo/{{ $organismo->id }}/eliminar"><button class="btn btn-danger">Eliminar</button></a>
                                  </div>
                                </div>
                              </div>
                            </div>                                
                   
                            
                            
                            <!--        <a href="/organismo/{{ $organismo->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar " onclick="return confirm('Eliminar el organismo?')">
                                <i class="fas fa-trash-alt"></i>
                            </a> -->
                      
                        </td>
                    </tr>
                    @endforeach
                   
                   @endif    
                 
              
                </tbody>      
                    
            </table>
            </div>
            </div>
            
    @if(!is_null($organismos))
        @if($organismos->count()==0)
      
        <div class="row justify-content-center align-items-center">
            <h5>No hay registros que cumplan con el criterio seleccionado</h5>
        </div>    
    @endif
    @endif        
            
        </fieldset>    
        
     
        
</div>

@if($organismos)
{{ $organismos->withQueryString()->links() }}
@endif

@endsection

@section('scripts')

    <script src="/js/admin/proyectos/listados.js"></script>
    

@endsection



