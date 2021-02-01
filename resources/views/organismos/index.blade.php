@extends('layouts.app')

@section('styles')
<link 
rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" 
integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" 
crossorigin="anonymous" />
@endsection

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
                
            <form action="/organismos/guardar" method="post">    
        
                {{ csrf_field() }}
        
                 <div class="card-header text-md-center">
                    <h5>Agregando organismo/expediente al proyecto {{session('proyecto-nombre')}}</h5>
                </div>                                                                      
                
              
             
                <input id="proyecto-id" type="hidden" class="form-control text-md-center" name="proyecto-id" value="{{session('proyecto-id')}}"> 
                
               

                                                                                        
                <div class="card-body">
                    
                <div class="col-md-12">
                <div class="table-responsive">
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
                        <tr>
                            <th scope="col">Organismo</th>
                            <th scope="col">Expediente</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Requerimiento</th>
                            <th scope="col">Cont. Requerimiento</th>
                            <th scope="col">Inf. pública</th>
                            
                        </tr>
                        
                        <tr>
                            <td><input title="Escribe el organismo" id="organismo" type="text" class="form-control text-md-center" maxlength="50" title="Tamaño máximo 50 caracteres" name="organismo" value="{{ old('organismo') }}" required autocomplete="organismo" autofocus>
                            </td>
                            
                            <td><input title="Escribe el número de expediente" id="num-expediente" type="text" class="form-control text-md-center" maxlength="50" title="Tamaño máximo 50 caracteres" name="num-expediente" required value="{{ old('num_expediente') }}">
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
                            <td><input title="Indique el número de prórrogas" id="num-prorrogas" type="number" 
                                class="form-control text-md-center" name="num-prorrogas" value="{{ old('num_prorrogas') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-solic-apm" type="date" class="form-control text-md-center" name="fec-solic-apm" value="{{ old('fec_solic_apm') }}">
                            </td>
                            
                            <td><input title="Elija fecha" id="fec-conc-apm" type="date" class="form-control text-md-center" name="fec-conc-apm" value="{{ old('fec_conc_apm') }}">
                            </td>
                        </tr>
                        
                    </table>
                    
                     
                    <div class="col-md-12 mt-3"><strong>Observaciones:</strong></div>
                    <div class="col-md-12 mt-2" style="text-align:left;">
                        <input title="Añada sus observaciones al expediente" id="observaciones" type="hidden"
                        name="observaciones" value="{{ old('observaciones') }}">
                        <trix-editor input="observaciones" class="form-control text-md-left"></trix-editor>
                    </div>
                    
                    </div>
                    </div>
                       
          
             </div>
                
                <div class="text-md-center">
                    <button class="btn btn-primary" title="Alta de organismo"><i class="fas fa-save"></i></button>

                    <button type="reset" class="btn btn-danger" title="Cancelar alta"><i class="fas fa-times"></i></button>

                    <a href="{{ URL::previous() }}" class="btn btn-primary" title="Volver sin guardar">
                    <i class="fas fa-reply"></i>
                    </a>
                </div>
                <br>     
          
            </form>
            
        
                        
                    
    </div>
                    

@endsection

@section('scripts')
<script 
    src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" 
    integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" 
    crossorigin="anonymous" defer>
</script>

@endsection