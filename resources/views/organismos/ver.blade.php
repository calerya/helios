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
                
            <form action="" method="post">    
        
                {{ csrf_field() }}
        
                                                                                       
                <div class="card-header text-md-center">
                    <h4>Agregando organismo/expediente al proyecto {{ $proyecto->nombre }}</h4>
                </div>

                <input  id="proyecto_id" type="number hidden" class="form-control" value="{{ $proyecto->id }}"> 
                
                <select name="proyecto-id" id="proyecto-id" >
                        <option value=" {{ $proyecto->id }} " selected> {{ $proyecto->id }} </option>
                    
                </select>
                
                
                <div class="card-body">
                    
                    <table class="table table-hover" style="text-align:center;">
                        <tr>
                            <th scope="col">Organismo</th>
                            <th scope="col">Expediente</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Requerimiento</th>
                            <th scope="col">Cont. Requerimiento</th>
                            <th scope="col">Inf. pública</th>
                            
                        </tr>
                        
                        <tr>
                            <td><input title="Escribe para cambiar el organismo" id="organismo" type="text" class="form-control text-md-center" name="organismo" value="{{ old('organismo') }}" required autocomplete="organismo" autofocus>
                            </td>
                            
                            <td><input title="Escribe para cambiar el número de expediente" id="num-expediente" type="text" class="form-control text-md-center" name="num-expediente" required value="{{ old('num_expediente') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-presentacion" type="date" class="form-control text-md-center" name="fec-presentacion" value="{{ old('fec_presentacion') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-requerimiento" type="date" class="form-control text-md-center" name="fec-requerimiento" value="{{ old('fec_requerimiento') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-cont-requerimiento" type="date" class="form-control text-md-center" name="fec-cont-requerimiento" value="{{ old('fec_cont_requerimiento') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-inicio-ip" type="date" class="form-control text-md-center" name="fec-inicio-ip" value="{{ old('fec_inicio_ip') }}">
                            </td>
                          
                        </tr>
                        
                        <tr>
                            <th scope="col">Fin inf. pública</th>
                            <th scope="col">Resolución</th>
                            <th scope="col">Publicación res.</th>
                            <th scope="col">Caducidad</th>
                            <th scope="col">Solicitud prórroga</th>
                            <th scope="col">Concesión prórroga</th>
                            
                            
                        </tr>
                        <tr>
                            <td><input title="Elija fecha" id="fec-fin-ip" type="date" class="form-control text-md-center" name="fec-fin-ip" value="{{ old('fec_fin_ip') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-resolucion" type="date" class="form-control text-md-center" name="fec-resolucion" value="{{ old('fec_resolucion') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-publ-resolucion" type="date" class="form-control text-md-center" name="fec-publ-resolucion" value="{{ old('fec_publ_resolucion') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-caducidad" type="date" class="form-control text-md-center" name="fec-caducidad" value="{{ old('fec_caducidad') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-solic-prorroga" type="date" class="form-control text-md-center" name="fec-solic-prorroga" value="{{ old('fec_solic_prorroga') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-concesion-pror" type="date" class="form-control text-md-center" name="fec-concesion-pror" value="{{ old('fec_concesion_pror') }}">
                            </td>
                            
                            
                            
                        </tr>
                        
                        <tr>
                            <th scope="col">Número prórrogas</th>
                            <th scope="col">Solicitud APM</th>
                            <th scope="col">Concesión APM</th>
                        </tr>
                        
                        <tr>
                            <td><input title="Indique el número de prórrogas" id="num-prorrogas" type="number"  class="form-control text-md-center" name="num-prorrogas" value="{{ old('num_prorrogas') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-solic-apm" type="date" class="form-control text-md-center" name="fec-solic-apm" value="{{ old('fec_solic_apm') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-conc-apm" type="date" class="form-control text-md-center" name="fec-conc-apm" value="{{ old('fec_conc_apm') }}">
                            </td>
                           
                        </tr>
                            
                    
                            
            </table>
                
                <div class="row">
                    <div class="col-md-2" style="text-align:center;"><strong>Observaciones: </strong></div>
                    <div class="col-md-10" style="text-align:left;" id="observaciones">
                        <input title="Añada sus observaciones al expediente" id="observaciones" type="textarea" class="form-control text-md-left" name="observaciones" value="{{old('observaciones')}}">
                        </div>
                    </div> 
                  
                    
                 
                     
          
             </div>
                
                <div class="text-md-center">
                    <a href="/organismos" class="btn btn-primary" title="Guardar organismo"><i class="fas fa-save"></i></a>

                    <button type="reset" class="btn btn-danger" title="Cancelar edición"><i class="fas fa-times"></i></button>

                  
                </div>
                       
          
            </form>
            
        
                        
                    
    </div>
                    

@endsection

