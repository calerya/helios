@extends('layouts.app')

@section('content')

    
    @if (session('status'))
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('status') }}
        </div>
    @endif

    @if (session('cancelado'))
        <div class="alert alert-dismissible alert-warning">
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

    <div class="card border-primary mb-3">
                
                <div class="card-header text-md-center">
                    <h5>Recuperar organismos eliminados</h5>
                </div>
                    
                <table class="table table-hover-2" style="text-align:center;">
            
            
                <thead>
                    <tr class="table-primary">
                        <th scope="col" width="8%"><small>Proyecto</small></th>
                        <th scope="col" width="8%"><small>Organismo</small></th>
                        <th scope="col" width="8%"><small>Expediente</small></th>
                        <th scope="col" width="7%"><small>Eliminado</small></th>
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
                        <td width="8%" class="text-danger">{{ $organismo->nombre }}</td>
                        <td width="8%"><small>{{ $organismo->organismo }}</small></td>
                        <td width="8%"><small>{{ $organismo->num_expediente }}</small></td>
                        <td width="7%"><small>@if($organismo->deleted_at) {{ $organismo->deleted_at->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_requerimiento) {{ $organismo->fec_requerimiento->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_cont_requerimiento) {{ $organismo->fec_cont_requerimiento->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_resolucion) {{ $organismo->fec_resolucion->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_caducidad) {{ $organismo->fec_caducidad->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_solic_prorroga) {{ $organismo->fec_solic_prorroga->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_concesion_pror) {{ $organismo->fec_concesion_pror->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_solic_apm) {{ $organismo->fec_solic_apm->format('d/m/Y') }} @endif</small></td>
                        <td width="7%"><small>@if($organismo->fec_conc_apm) {{ $organismo->fec_conc_apm->format('d/m/Y') }} @endif</small></td>
                        
                        <td width="13%">
                                                                              
                            <a href="/recuperar/{{ $organismo->id }}/organismos" class="btn btn-sm btn-success" title="Recuperar el organismo"><i class="fas fa-upload"></i>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                   
                   @endif    
                 
              
                </tbody>      
                    
            </table>
            
    @if(!is_null($organismos))
        @if($organismos->count()==0)
      
        <div class="row justify-content-center align-items-center">
            <h5>No hay registros que cumplan con el criterio seleccionado</h5>
        </div>    
    @endif
    @endif        
            
      
     
        
</div>

@if($organismos)
{{ $organismos->withQueryString()->links() }}
@endif

@endsection
