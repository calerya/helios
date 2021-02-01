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
                
        <form action="" method="post">    
        
                {{ csrf_field() }}
        
                                                                                       
                <fieldset class="border p-2">
                    <legend class="w-auto">Estás editando el organismo {{ $organismo->organismo }}</legend> 
                                
                <div class="col-md-12">
                <div class="table-responsive">
          
                    <table class="table table-bordered" style="text-align:center;">
                
                        <tr class="table-primary">
                            <th width="15%" scope="col">Organismo</th>
                            <th width="15%" scope="col">Expediente</th>
                            <th width="15%" scope="col">Presentación</th>
                            <th width="15%" scope="col">Requerimiento</th>
                            <th width="15%" scope="col">Cont. Requerimiento</th>
                            <th width="15%" scope="col">Inf. pública</th>
                            
                        </tr>
                
                        
                        <tr>
                            <td width="15%"><input title="Escribe para cambiar el organismo" id="organismo" type="text" class="form-control text-md-center" maxlength="50" title="Tamaño máximo 50 caracteres" name="organismo" value="{{ old('organismo', $organismo->organismo) }}" required autocomplete="organismo" autofocus>
                            </td>
                            
                            <td width="15%"><input title="Escribe para cambiar el número de expediente" id="num-expediente" type="text" class="form-control text-md-center" maxlength="50" title="Tamaño máximo 50 caracteres" name="num-expediente" required value="{{ old('num_expediente', $organismo->num_expediente) }}">
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_presentacion)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-presentacion" type="date" class="form-control text-md-center" name="fec-presentacion" value="{{ old('fec_presentacion', $organismo->fec_presentacion->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-presentacion" type="date" class="form-control text-md-center" name="fec-presentacion" value="{{ old('fec_presentacion', $organismo->fec_presentacion) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_requerimiento)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-requerimiento" type="date" class="form-control text-md-center" name="fec-requerimiento" value="{{ old('fec_requerimiento', $organismo->fec_requerimiento ->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-requerimiento" type="date" class="form-control text-md-center" name="fec-requerimiento" value="{{ old('fec_requerimiento', $organismo->fec_requerimiento) }}">@endif</td>
                            
                            <td width="15%">@if ($organismo->fec_cont_requerimiento)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-cont-requerimiento" type="date" class="form-control text-md-center" name="fec-cont-requerimiento" value="{{ old('fec_cont_requerimiento', $organismo->fec_cont_requerimiento->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-cont-requerimiento" type="date" class="form-control text-md-center" name="fec-cont-requerimiento" value="{{ old('fec_cont_requerimiento', $organismo->fec_cont_requerimiento) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_inicio_ip)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-inicio-ip" type="date" class="form-control text-md-center" name="fec-inicio-ip" value="{{ old('fec_inicio_ip', $organismo->fec_inicio_ip->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-inicio-ip" type="date" class="form-control text-md-center" name="fec-inicio-ip" value="{{ old('fec_inicio_ip', $organismo->fec_inicio_ip) }}">@endif
                            </td>
                          
                        </tr>
                        
                        <tr class="table-primary">
                            <th width="15%" scope="col">Fin inf. pública</th>
                            <th width="15%" scope="col">Resolución</th>
                            <th width="15%" scope="col">Publicación res.</th>
                            <th width="15%" scope="col">Caducidad</th>
                            <th width="15%" scope="col">Solicitud prórroga</th>
                            <th width="15%" scope="col">Concesión prórroga</th>
                            
                            
                        </tr>
                        <tr>
                            <td width="15%">@if ($organismo->fec_fin_ip)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-fin-ip" type="date" class="form-control text-md-center" name="fec-fin-ip" value="{{ old('fec_fin_ip', $organismo->fec_fin_ip->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-fin-ip" type="date" class="form-control text-md-center" name="fec-fin-ip" value="{{ old('fec_fin_ip', $organismo->fec_fin_ip) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_resolucion)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-resolucion" type="date" class="form-control text-md-center" name="fec-resolucion" value="{{ old('fec_resolucion', $organismo->fec_resolucion->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-resolucion" type="date" class="form-control text-md-center" name="fec-resolucion" value="{{ old('fec_resolucion', $organismo->fec_resolucion) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_publ_resolucion)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-publ-resolucion" type="date" class="form-control text-md-center" name="fec-publ-resolucion" value="{{ old('fec_publ_resolucion', $organismo->fec_publ_resolucion->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-publ-resolucion" type="date" class="form-control text-md-center" name="fec-publ-resolucion" value="{{ old('fec_publ_resolucion', $organismo->fec_publ_resolucion) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_caducidad)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-caducidad" type="date" class="form-control text-md-center" name="fec-caducidad" value="{{ old('fec_caducidad', $organismo->fec_caducidad->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-caducidad" type="date" class="form-control text-md-center" name="fec-caducidad" value="{{ old('fec_caducidad', $organismo->fec_caducidad) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_solic_prorroga)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-solic-prorroga" type="date" class="form-control text-md-center" name="fec-solic-prorroga" value="{{ old('fec_solic_prorroga', $organismo->fec_solic_prorroga->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-solic-prorroga" type="date" class="form-control text-md-center" name="fec-solic-prorroga" value="{{ old('fec_solic_prorroga', $organismo->fec_solic_prorroga) }}">@endif
                            </td>
                            
                            <td width="15%">@if ($organismo->fec_concesion_pror)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-concesion-pror" type="date" class="form-control text-md-center" name="fec-concesion-pror" value="{{ old('fec_concesion_pror', $organismo->fec_concesion_pror->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-concesion-pror" type="date" class="form-control text-md-center" name="fec-concesion-pror" value="{{ old('fec_concesion_pror', $organismo->fec_concesion_pror) }}">@endif
                            </td>
                            
                            
                            
                        </tr>
                        
                        <tr class="table-primary">
                            <th scope="col">Número prórrogas</th>
                            <th scope="col">Solicitud APM</th>
                            <th scope="col">Concesión APM</th>
                            
                        </tr>
                        
                        <tr>
                            <td><input title="Indique el número de prórrogas" id="num-prorrogas" type="number"  class="form-control text-md-center" name="num-prorrogas" value="{{ old('num_prorrogas', $organismo->num_prorrogas) }}">
                            </td>
                            
                            <td>@if ($organismo->fec_solic_apm)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-solic-apm" type="date" class="form-control text-md-center" name="fec-solic-apm" value="{{ old('fec_solic_apm', $organismo->fec_solic_apm->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-solic-apm" type="date" class="form-control text-md-center" name="fec-solic-apm" value="{{ old('fec_solic_apm', $organismo->fec_solic_apm) }}">@endif
                            </td>
                            
                            <td>@if ($organismo->fec_conc_apm)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec-conc-apm" type="date" class="form-control text-md-center" name="fec-conc-apm" value="{{ old('fec_conc_apm', $organismo->fec_conc_apm->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec-conc-apm" type="date" class="form-control text-md-center" name="fec-conc-apm" value="{{ old('fec_conc_apm', $organismo->fec_conc_apm) }}">@endif
                            </td>
                            
                        </tr>
                    </table>       
                    
                    <table class="table table-bordered" style="text-align:center;">
                    
                        <tr class="table-primary">
                            <th scope="col" width="100%" style="text-align:left;">Observaciones: </th>
                        </tr>
                        <tr>
                            <td>
                                <input title="Añada sus observaciones al expediente" id="observaciones" type="hidden"
                                name="observaciones" value="{{ old('observaciones', $organismo->observaciones) }}">
                                <trix-editor input="observaciones" class="text-md-left"></trix-editor>
                            </td>
                        </tr>
                    </table>
                       
                </div>
                </div>
        
                
                <div class="text-md-center">
                    <button class="btn btn-primary" title="Guardar organismo"><i class="fas fa-save"></i></button>

                    <button type="reset" class="btn btn-danger" title="Cancelar edición"><i class="fas fa-times"></i></button>
                    
                    
                    <a href="{{ URL::previous() }}" class="btn btn-primary" title="Volver atrás sin guardar datos">
                    <i class="fas fa-reply"></i>
                    </a>
                  
                </div>
                       
                </fieldset>
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

