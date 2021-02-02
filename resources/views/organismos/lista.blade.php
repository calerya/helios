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

 
    <div class="card col-md-12">
        <div class="card-header row justify-content-center">
            <h4 class="col-9 text-center"><i class="fas fa-university"></i> Listado de organismos del proyecto {{$nom_proyecto}}</h4>   
             <div class="col-3 justify-content-center align-items-center float-right">
                <div class="btn btn btn-primary" 
                      title="Añadir organismo" 
                      id="boton-alta-org">
                      <i class="fas fa-plus"></i>
                </div>
                <a href="/proyecto/'{{$id}}'/ver" 
                    class="btn btn-primary"
                    title="Volver al proyecto">
                    <i class="fas fa-solar-panel"></i></a>
                
                <a href="/buscador" class="btn btn btn-primary"
                 title="Volver al buscador de proyectos">
                  <i class="fas fa-search"></i>
                </a>
              </div>
        </div>
             
             
             
            <div class="card-body col-md-12">
            <div class="table-responsive">
          
            <table class="table table-hover table-bordered" style="text-align:center;">
            
            
                <thead>
                    <tr class="table-primary">
                        {{-- <th scope="col" width="8%"><small>Proyecto</small></th> --}}
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
                        {{-- <td width="8%" class="text-danger"><a href="/proyecto/{{ $organismo->proyecto_id }}/ver">{{ $organismo->nombre }}</a></td> --}}
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

                            <a href="/organismo/{{ $organismo->id }}" class="btn btn-sm btn-primary" title="Ver / Editar organismo"><i class="far fa-edit"></i>
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
            
     
     
        </div> 



@endsection

@section('scripts')

    <script src="/js/admin/proyectos/listados.js"></script>
    

@endsection



