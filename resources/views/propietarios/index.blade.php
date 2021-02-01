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
                
            <form action="/propietarios/guardar" method="post">    
        
                {{ csrf_field() }}
        
            <div class="card-body">
            <fieldset class="border p-2">
            <legend class="w-auto">Añadiendo propietario al proyecto: {{session('proyecto-nombre')}}</legend>   
                                                                              
               
                <input id="proyecto-id" type="hidden" class="form-control text-md-center" name="proyecto-id" value="{{session('proyecto-id')}}"> 
                
               

                                                                                        
                <div class="card-body">
                    
                <div class="col-md-12">
                <div class="table-responsive">
          
                 <table class="table table-hover" style="text-align:center;">
                    <thead>
                        <tr class="table-primary">
                            <div><th width="11%" scope="col">Firmado</th></div>
                            <div><th width="21%" scope="col">Titular</th></div>
                            <div><th width="9%" scope="col">Polígono</th></div>
                            <div><th width="9%"scope="col">Parcela</th></div>
                            <div><th width="18%" scope="col">Ref. catastral</th></div>
                            <div><th width="12%" scope="col">Teléfono</th></div>
                            <div><th width="11%" scope="col">DNI/NIE</th></div>
                        <!--    <div><th width="9%" scope="col">Venta/alq</th></div> -->
                        </tr>
                    </thead>
                        
                    <tbody>

                        <tr>
                            <td width="13%">
                                
                                <select name="firmado" class="form-control text-md-center" 
                                    value="{{ old('firmado') }}" required>
                                      <option value="">Seleccione una opción</option>
                                      <option value="Firmado">Firmado</option>
                                      <option value="No firmado">No firmado</option>
                                      <option value="Desistimos">Desistimos</option>
                                </select>
                            </td>

                                                        
                            <td width="23%"><input title="Nombre del propietario titular, máximo 100 caracteres" id="titular" type="text" class="form-control text-md-center" maxlength="100" name="titular" value="{{ old('titular')}}" required autocomplete="titular">
                            </td>
                            
                            <td width="10%"><input title="Número de polígono, máximo 10 dígitos" id="poligono" type="number" class="form-control text-md-center" maxlength="10" name="poligono" value="{{ old('poligono') }}">
                            </td>
                            
                            <td width="10%"><input title="Número de parcela, máximo 10 dígitos" id="parcela" type="number" class="form-control text-md-center" maxlength="10" name="parcela" value="{{ old('parcela') }}">
                            </td>
                            
                            <td width="18%"><input title="Referencia catastral, máximo 40 caracteres" id="ref_catastral" type="text" class="form-control text-md-center" maxlength="40" name="ref_catastral" value="{{ old('ref_catastral') }}">
                            </td>
                            
                            <td width="14%"><input title="Teléfonos con 9 dígitos, para otro formato use el campo observaciones" id="telefono" type="tel" class="form-control text-md-center" maxlength="15" name="telefono" pattern="[0-9]{9}" value="{{ old('telefono') }}">
                            </td>
                            
                            <td width="12%"><input title="DNI, NIF ó NIE, máximo 15 caracteres" id="dni" type="text" class="form-control text-md-center" maxlength="15" name="dni" value="{{ old('dni') }}">
                            </td>
                            
                     <!--       <td width="9%">
                                <select name="venta_alq" class="form-control text-md-center" 
                                    value="{{ old('venta_alq') }}">
                                        <option value="">Seleccione</option>
                                        <option value="Venta">Venta</option>
                                        <option value="Alquiler">Alquiler</option>
                                 </select>
                            </td> -->

                        </tr>
                    </tbody>
                </table>
                     
                    <div class="col-md-12"><strong>Observaciones:</strong></div>
                   
                    <div class="col-md-12">
                        <input title="Añada sus observaciones" id="observaciones" type="textarea"  class="form-control text-md-left" name="observaciones" value="{{ old('observaciones') }}">
                    </div>
                    
                    </div>
                    </div>
            </div>
                
                <div class="text-md-center">
                    <button class="btn btn-primary" title="Alta de propietario"><i class="fas fa-save"></i></button>

                    <button type="reset" class="btn btn-danger" title="Cancelar alta"><i class="fas fa-times"></i></button>

                    <a href="{{ URL::previous() }}" class="btn btn-primary" title="Volver sin guardar">
                    <i class="fas fa-reply"></i>
                    </a>
                </div>
                <br>     
          
                </fieldset>
                </div>
            </form>
            
        
                        
                    
    </div>
                    

@endsection

