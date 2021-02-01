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

    @if (session('finalizado'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('finalizado') }}
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


   
        <div class="card-body">
          <div class="card-header row justify-content-center">
            <h4 class="col-9 text-center">Proyecto: <strong>{{ $proyecto->nom_proyecto }}</strong></h4>
            <div class="col-3 justify-content-center align-items-center float-right">
              <div class="btn btn btn-primary" 
                    title="Añadir organismo" 
                    id="boton-alta-org">
                    <i class="fas fa-university"></i>
              </div>
              
              <a href="{{route('fincas.index', ['proyecto' => $proyecto->id] )}}" 
                class="btn btn btn-primary" 
                title="Añadir finca">
                <i class="fas fa-map-marked-alt"></i>
              </a>
              
              <a href="/buscador" class="btn btn btn-primary" title="Volver al buscador de proyectos">
                <i class="fas fa-solar-panel"></i>
              </a>
            </div>
          </div>
        </div>

        <select name="proyecto-id" id="proyecto-id" style="visibility:hidden">
                <option value=" {{ $proyecto->id }} " selected> {{ $proyecto->id }} </option>

        </select>
                    
                    
          <div class="col-md-12">
            <div class="table-responsive">

              <table class="table table-hover table-bordered" style="text-align:center;">
                
                          <thead>
                              <tr class="table-active">
                                  <th scope="col">Nombre del proyecto</th>
                                  <th scope="col">Provincia</th>
                                  <th scope="col">Term. Municipal</th>
                                  <th scope="col">Técnico</th>
                                  <th scope="col">Nº exp</th>
                                  <th scope="col">Nº fincas</th>
                              
                              </tr>
                          </thead>               
                          
                          <tbody>
                    
                              <tr>
                                  <td>{{ $proyecto->nom_proyecto }}</td>
                                  <td>{{ $proyecto->provincia }}</td>
                                  <td>{{ $proyecto->term_municipal }}</td>
                                  <td>{{ $user->name }}</td>
                                  <td>{{ $organismos->count() }}</td>
                                  <td>{{ $fincas->count() }}</td>
                                                                  
                              </tr>
                                                                                        
                          </tbody>   
                              
              </table>
            </div>
          </div>
        


    <br>

  <fieldset class="border p-1 col-md-12">
      <legend class="w-auto">Fincas del proyecto {{$proyecto->nom_proyecto}}</legend>
      <div class="card-body">
        <button class="btn btn-primary ml-3" type="button" data-toggle="collapse" data-target="#collapseFincas" aria-expanded="false" aria-controls="collapseFincas">
            Mostrar / Ocultar fincas
        </button>
      </div>
      
      <div class="collapse" id="collapseFincas">
        <div class="card card-body">
                      
           <table class="table table-hover table-bordered" style="text-align:center;">
         
          <thead>
              <tr class="table-active">
                  <div><th width="20%" scope="col">Ref. catastral</th></div>
                  <th scope="col">Provincia</th>
                  <th scope="col">Municipio</th>
                  <th scope="col">Zona</th>
                  <th width="8%" scope="col">Polígono</th>
                  <th width="8%" scope="col">Parcela</th>
                  <th width="12%" scope="col">Opc</th>
              </tr>
          </thead>
          
          
          <tbody>
              @foreach($fincas as $finca)
              <tr>
                  <div><td width="20%">{{ $finca->ref_catastral }}</td></div>
                  <div><td>{{ $finca->provincia }}</td></div>
                  <div><td>{{ $finca->municipio }}</td></div>
                  <div><td>{{ $finca->zona }}</td></div>                       
                  <div><td width="8%">{{ $finca->poligono }}</td></div>
                  <div><td width="8%">{{ $finca->parcela }}</td></div>
                  <div><td width="12%">
                      <a href="{{route('fincas.show',['id' => $finca->id])}}" 
                          class="btn btn-sm btn-success"
                          title="Ver los datos de la finca">
                          <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{route('fincas.show', $finca->id)}}" 
                          class="btn btn-sm btn-primary" 
                          title="Editar los datos de la finca">
                          <i class="far fa-edit"></i>
                      </a>
                      <button 
                          type="button" 
                          class="btn btn-sm btn-danger" 
                          data-toggle="modal" 
                          data-target="#exampleModal" 
                          title="Eliminar la finca y sus propietarios">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                      
                      <div class="modal" id="exampleModal">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Eliminar finca</h5>
                                
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="text-center">
                                  <span class="text-warning"><i style="font-size:70px" class="fas fa-exclamation-circle"></i></span>  
                              </div>
                              <p>Quiere eliminar la finca y sus propietarios?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="{{route('fincas.destroy', ['id' => $finca->id])}}"><button class="btn btn-danger">Eliminar</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                          
                  </td>
                </div>
              </tr>
              @endforeach
                                 
          </tbody>
 
          </table>
        </div>
      </div>
  </fieldset>    
      
  
<br>
      
  
    <fieldset class="border p-1 col-md-12">
      <legend class="w-auto">Hitos de {{ $proyecto->nom_proyecto }}</legend>
      <div class="card-body">
        <button class="btn btn-primary ml-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Mostrar / Ocultar hitos
        </button>
      </div>
      
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="col-md-12 mt-2" style="text-align:left;">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" style="text-align:center;">
                  <tr class="table-active">
                    <th scope="col">Hitos</th>
                    <th scope="col">Solicitud Ind.</th>
                    <th scope="col">Obtención Ind.</th>
                    <th scope="col">Comunicación Dist.</th>
                    <th scope="col">Contestación</th>
                  </tr>
  
                  @foreach($hitos as $hito)
                  <tr>
                      
                      <td width="10%"><a href="/hito/{{ $hito->id }}">Nº {{$hito->hito_numero}} </a></td>
  
                      
                      <td>@if ($hito->fec_sol_ind)<div style="background-color: rgb(242, 243, 243); color: grey;" type="date" class="form-control text-md-center">{{$hito->fec_sol_ind->format('d-m-Y')}}</div>@else<div class="form-control text-md-center">-</div>@endif
                      </td>
                      
                      <td>@if ($hito->fec_obt_ind)<div style="background-color: rgb(242, 243, 243); color: grey;" type="date" class="form-control text-md-center">{{$hito->fec_obt_ind->format('d-m-Y')}}</div>@else<div class="form-control text-md-center">-</div>@endif
                      </td>
                      
                      <td>@if ($hito->fec_com_dis)<div style="background-color: rgb(242, 243, 243); color: grey;" type="date" class="form-control text-md-center">{{$hito->fec_com_dis->format('d-m-Y')}}</div>@else<div class="form-control text-md-center">-</div>@endif
                      </td>
                      
                      <td>@if ($hito->fec_contest)<div style="background-color: rgb(242, 243, 243); color: grey;" type="date" class="form-control text-md-center">{{$hito->fec_contest->format('d-m-Y')}}</div>@else<div class="form-control text-md-center">-</div>@endif
                      </td>
                    
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>     
  </fieldset>
     
    <br>
  
     <fieldset class="border p-1 col-md-12">
        <legend class="w-auto"><div id="organismo">Datos del organismo:</div></legend>                                 
            <div class="card-body">
                <div class="col-md-12">
                    <select class="form-control w-auto mb-2" id="select-organismo" name="select-organismo">
                        <option value="-1" selected disabled>Selecciona organismo</option>
                        @foreach($organismos as $org)
                         <option value=" {{ $org->id }} "> {{ $org->organismo }} </option>
                        @endforeach
                    </select>

                <div class="table-responsive">
                <table class="table table-hover table-bordered" style="text-align:center;">
                        <tr class="table-active">
                            <th scope="col">Expediente</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Requerimiento</th>
                            <th scope="col">Cont. Requerimiento</th>
                            <th scope="col">Inf. pública</th>
                            <th scope="col">Fin inf. pública</th>
                            <th scope="col">Resolución</th>
                        </tr>
                        <tr>
                            <td><div id="num-expediente">-</div></td>
                            <td><div id="fec-presentacion">-</div></td>
                            <td><div id="fec-requerimiento">-</div></td>
                            <td><div id="fec-cont-requerimiento">-</div></td>
                            <td><div id="fec-inicio-ip">-</div></td>
                            <td><div id="fec-fin-ip">-</div></td>
                            <td><div id="fec-resolucion">-</div></td>
                        </tr>
                        <tr class="table-active">
                            
                            <th scope="col">Publicación res.</th>
                            <th scope="col">Caducidad</th>
                            <th scope="col">Solicitud prórroga</th>
                            <th scope="col">Concesión prórroga</th>
                            <th scope="col">Nº prórrogas</th>
                            <th scope="col">Solicitud APM</th>
                            <th scope="col">Concesión APM</th>
                        </tr>
                        <tr>
                            
                            <td><div id="fec-publ-resolucion">-</div></td>
                            <td><div id="fec-caducidad">-</div></td>
                            <td><div id="fec-solic-prorroga">-</div></td>
                            <td><div id="fec-concesion-pror">-</div></td>
                            <td><div id="num-prorrogas">-</div></td>
                            <td><div id="fec-solic-apm">-</div></td>
                            <td><div id="fec-conc-apm">-</div></td>
                        </tr>
            
                      </table>
            </div>
        </div>
                    
            <table class="table table-bordered" style="text-align:center;">  
                <tr class="table-active">
                    <th scope="col" width="100%" style="text-align:left;">Observaciones: </th>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-12" style="text-align:left;" id="observaciones">-</div>
                    </td>
                </tr>
                
            </table>
                    
            <br>
                
            <div style="text-align:center;">
                <div class="btn btn btn-primary" title="Editar organismo/expediente" id="boton-editar-org" style="display:none">
                    <i class="far fa-edit" ></i>
                </div>
                
                <div class="btn btn btn-success" id="boton-finalizar-org" title="Dar el organismo/expediente por finalizado" style="display:none">
                    <i class="fas fa-flag-checkered"></i>
                </div>

                <div class="btn btn btn-danger" id="boton-eliminar-org" title="Dar de baja organismo/expediente" style="display:none">
                    <i class="fas fa-trash-alt"></i>
                </div> 
            </div>
        </div>
                       
</fieldset>
<br>
                    
                    
        

                        
     

@endsection

@section('scripts')

    <script src="/js/admin/proyectos/ver.js"></script>
   

@endsection
  