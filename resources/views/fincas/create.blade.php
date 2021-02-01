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

    @if (session('finalizado'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('finalizado') }}
        </div>
    @endif

    <fieldset class="border col-md-12">
        <legend class="w-auto">Alta de finca en el proyecto {{ $proyecto->nom_proyecto }}</legend>  
            
            <datos-catastro></datos-catastro>
        
    
                 
        <form action="{{route('fincas.store',['id' => $proyecto->id]) }}" method="post" novalidate>
            {{ csrf_field() }}

            {{-- <fieldset class="border"> --}}
            {{-- <legend class="text-primary">Alta de finca en el proyecto {{ $proyecto->nom_proyecto }} </legend> --}}

            <div class="card-body">
                <div class="col-md-12">
                <div class="table-responsive form-group">
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
                        <tr class="table-active">
                            <th width="20%" scope="col">Ref Catastral</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Municipio</th>
                            <th scope="col">Zona</th>
                            <th width="9%" scope="col">Polígono</th>
                            <th width="9%" scope="col">Parcela</th>
                            <th width="9%" scope="col">Uso</th>
                        </tr>
                        
                        <tr>
                            
                            <td width="20%">
                                <input
                                    id="ref_catastral"
                                    type="text"
                                    class="form-control text-md-center @error('ref_catastral') is-invalid @enderror"
                                    placeholder="20 caracteres - Ref. Catastral"
                                    name="ref_catastral"
                                    value="{{ old('ref_catastral')}}"
                                    >
                                    
                                    @error('ref_catastral')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td>
                                <input
                                    id="provincia"
                                    type="text"
                                    class="form-control text-md-center @error('provincia') is-invalid @enderror"
                                    placeholder="Provincia"
                                    name="provincia"
                                    value="{{ old('provincia')}}"
                                    >
                                    @error('provincia')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td>
                                <input
                                    id="municipio"
                                    type="text"
                                    class="form-control text-md-center @error('municipio') is-invalid @enderror"
                                    placeholder="Municipio"
                                    name="municipio"
                                    value="{{ old('municipio')}}"
                                    >
                                    @error('municipio')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td>
                                <input
                                    id="zona"
                                    type="text"
                                    class="form-control text-md-center @error('zona') is-invalid @enderror"
                                    placeholder="Zona"
                                    name="zona"
                                    value="{{ old('zona')}}"
                                    >
                                    @error('zona')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td width="9%" >
                                <input
                                    id="poligono"
                                    type="text"
                                    class="form-control text-md-center @error('poligono') is-invalid @enderror"
                                    placeholder="Polígono"
                                    name="poligono"
                                    value="{{ old('poligono')}}"
                                   >
                                    @error('poligono')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td width="9%" >
                                <input
                                    id="parcela"
                                    type="text"
                                    class="form-control text-md-center @error('parcela') is-invalid @enderror"
                                    placeholder="Parcela"
                                    name="parcela"
                                    value="{{ old('parcela')}}"
                                    >
                                    @error('parcela')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td width="9%" >
                                <input
                                    id="uso"
                                    type="text"
                                    class="form-control text-md-center @error('uso') is-invalid @enderror"
                                    placeholder="Uso"
                                    name="uso"
                                    value="{{ old('uso')}}"
                                    >
                                    @error('uso')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                        </tr>
                        <tr  class="table-active">
                            <th scope="col">Venta / Alq</th>
                            <th scope="col">Sup. Cat. ha</th>
                            <th scope="col">Sup. Útil ha</th>
                        </tr>
                        <br>
                        <tr>
                            
                            <td>
                                <select 
                                    name="venta_alq" 
                                    class="form-control 
                                    @error('venta_alq') is-invalid @enderror" 
                                    title="Finca en venta o alquiler" 
                                    value="{{ old('venta_alq') }}">
                                        <option disabled selected>-- Seleccione --</option>
                                        <option value="venta" {{old('venta_alq') == "venta" ? 'selected' : ''}}>Venta</option>
                                        <option value="alquiler" {{old('venta_alq') == "alquiler" ? 'selected' : ''}}>Alquiler</option>
                                        <option value="otro" {{old('venta_alq') == "otro" ? 'selected' : ''}}>Otro</option>
                                </select>
                                    
                                @error('venta_alq')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </td>
                            
                            <td>
                                <input
                                    id="sup_catastral_ha"
                                    type="number" step="0.01" min="0" lang="es"
                                    
                                    class="form-control text-md-center @error('sup_catastral_ha') is-invalid @enderror"
                                    placeholder="formato x,xxxx"
                                    name="sup_catastral_ha"
                                    value="{{ old('sup_catastral_ha')}}"
                                    >
                                    @error('sup_catastral_ha')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                            
                            <td>
                                <input
                                    id="sup_util_ha"
                                    type="text"
                                    class="form-control text-md-center @error('sup_util_ha') is-invalid @enderror"
                                    placeholder="formato x,xxxx"
                                    name="sup_util_ha"
                                    value="{{ old('sup_util_ha')}}"
                                    >
                                    @error('sup_util_ha')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </td>
                        </tr>

                 </table>
                
                 <div class="card border-light mb-1">
                    <div class="card-body">
                      <div class="card-title"><strong>Observaciones:</strong>
                        <button class="btn btn-primary ml-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Mostrar / Ocultar observaciones
                            </button>
                      </div>
                                            
                 </div>
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        {{-- <div class="col-md-12 mt-2"><strong>Observaciones:</strong></div> --}}
                        <div class="col-md-12 mt-2" style="text-align:left;">
                            <input title="Añada sus observaciones al expediente" id="observaciones" type="hidden"
                            name="observaciones" value="{{ old('observaciones') }}">
                            <trix-editor input="observaciones" class="form-control text-md-left"></trix-editor>
                        </div>
                    </div>
                  </div>
                </div>

                 
                        
               
                    {{--  --}}
                    


                </div>
                </div>
            </div>
            <input
                    id="proyecto_id"
                    name="proyecto_id"
                    value={{$proyecto->id}}
                    type="hidden"
            >
            <div class="text-md-center mb-3 mt-1">
                <button class="btn btn-primary mr-2" title="Alta de Proyecto"><i class="fas fa-save"></i></button>
                <button type="reset" class="btn btn-danger" title="Limpiar campos"><i class="fas fa-times"></i></button>
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-2" title="Volver atrás sin guardar datos">
                    <i class="fas fa-reply"></i>
                </a>
            </div>
            </fieldset>

        </form>

                     
  @endsection

  @section('scripts')
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" 
        integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" 
        crossorigin="anonymous" defer>
    </script>

@endsection
