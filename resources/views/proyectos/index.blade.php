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

    @if (session('finalizado'))
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Info: </strong>{{ session('finalizado') }}
        </div>
    @endif

    
    <div class="card border-primary col-md-6 mb-3 mx-auto">
                
        <form action="" method="post" novalidate>
            {{ csrf_field() }}
        
               <div class="card-body">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Alta de proyecto</legend>
                                              
{{--                          
                                
                                
                                
                                <label for="opciones" class="col-md-2 col-form-label text-md-center">Opciones</label> --}}
                          
                            <div class="form-group col-md-8 mx-auto">
                                <label for="nom_proyecto" class="col-form-label text-md-center">Nombre del proyecto</label>
                                <input id="nom_proyecto" type="text" class="form-control @error('nom_proyecto') is-invalid @enderror" title="Tamaño máximo 50 caracteres" name="nom_proyecto" value="{{ old('nom_proyecto') }}" autocomplete="nom_proyecto" autofocus>
                                @error('nom_proyecto')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                                
                            <div class="form-group col-md-8 mx-auto">
                                <label for="provincia" class="col-form-label text-md-center">Provincia</label>
                                <select name="provincia" class="form-control @error('provincia') is-invalid @enderror" title="Selecciona la provincia del proyecto" value="{{ old('provincia') }}" autocomplete="provincia">
                                        <option disabled selected>Seleccione provincia</option>
                                        <option value="A Coruña" {{old('provincia') == "A Coruña" ? 'selected' : ''}}>A Coruña</option>
                                        <option value="Álava" {{old('provincia') == "Álava" ? 'selected' : ''}}>Álava</option>
                                        <option value="Albacete" {{old('provincia') == "Albacete" ? 'selected' : ''}}>Albacete</option>
                                        <option value="Alicante" {{old('provincia') == "Alicante" ? 'selected' : ''}}>Alicante</option>
                                        <option value="Almería" {{old('provincia') == "Almería" ? 'selected' : ''}}>Almería</option>
                                        <option value="Asturias" {{old('provincia') == "Asturias" ? 'selected' : ''}}>Asturias</option>
                                        <option value="Ávila" {{old('provincia') == "Ávila" ? 'selected' : ''}}>Ávila</option>
                                        <option value="Barcelona" {{old('provincia') == "Barcelona" ? 'selected' : ''}}>Barcelona</option>
                                        <option value="Burgos" {{old('provincia') == "Burgos" ? 'selected' : ''}}>Burgos</option>
                                        <option value="Cáceres" {{old('provincia') == "Cáceres" ? 'selected' : ''}}>Cáceres</option>
                                        <option value="Cádiz" {{old('provincia') == "Cádiz" ? 'selected' : ''}}>Cádiz</option>
                                        <option value="Cantabria" {{old('provincia') == "Cantabria" ? 'selected' : ''}}>Cantabria</option>
                                        <option value="Castellón" {{old('provincia') == "Castellón" ? 'selected' : ''}}>Castellón</option>
                                        <option value="Ciudad Real" {{old('provincia') == "Ciudad Real" ? 'selected' : ''}}>Ciudad Real</option>
                                        <option value="Córdoba" {{old('provincia') == "Córdoba" ? 'selected' : ''}}>Córdoba</option>
                                        <option value="Cuenca" {{old('provincia') == "Cuenca" ? 'selected' : ''}}>Cuenca</option>
                                        <option value="Girona" {{old('provincia') == "Girona" ? 'selected' : ''}}>Girona</option>
                                        <option value="Granada" {{old('provincia') == "Granada" ? 'selected' : ''}}>Granada</option>
                                        <option value="Guadalajara" {{old('provincia') == "Guadalajara" ? 'selected' : ''}}>Guadalajara</option>
                                        <option value="Guipúzcoa" {{old('provincia') == "Guipúzcoa" ? 'selected' : ''}}>Guipúzcoa</option>
                                        <option value="Huelva" {{old('provincia') == "Huelva" ? 'selected' : ''}}>Huelva</option>
                                        <option value="Huesca" {{old('provincia') == "Huesca" ? 'selected' : ''}}>Huesca</option>
                                        <option value="Islas Baleares" {{old('provincia') == "Islas Baleares" ? 'selected' : ''}}>Islas Baleares</option>
                                        <option value="Jaén" {{old('provincia') == "Jaén" ? 'selected' : ''}}>Jaén</option>
                                        <option value="La Rioja" {{old('provincia') == "La Rioja" ? 'selected' : ''}}>La Rioja</option>
                                        <option value="Las Palmas" {{old('provincia') == "Las Palmas" ? 'selected' : ''}}>Las Palmas</option>
                                        <option value="León" {{old('provincia') == "León" ? 'selected' : ''}}>León</option>
                                        <option value="Lleida" {{old('provincia') == "Lleida" ? 'selected' : ''}}>Lleida</option>
                                        <option value="Lugo" {{old('provincia') == "Lugo" ? 'selected' : ''}}>Lugo</option>
                                        <option value="Madrid" {{old('provincia') == "Madrid" ? 'selected' : ''}}>Madrid</option>
                                        <option value="Málaga" {{old('provincia') == "Málaga" ? 'selected' : ''}}>Málaga</option>
                                        <option value="Murcia" {{old('provincia') == "Murcia" ? 'selected' : ''}}>Murcia</option>
                                        <option value="Navarra" {{old('provincia') == "Navarra" ? 'selected' : ''}}>Navarra</option>
                                        <option value="Ourense" {{old('provincia') == "Ourense" ? 'selected' : ''}}>Ourense</option>
                                        <option value="Palencia" {{old('provincia') == "Palencia" ? 'selected' : ''}}>Palencia</option>
                                        <option value="Pontevedra" {{old('provincia') == "Pontevedra" ? 'selected' : ''}}>Pontevedra</option>
                                        <option value="Salamanca" {{old('provincia') == "Salamanca" ? 'selected' : ''}}>Salamanca</option>
                                        <option value="S. C. Tenerife" {{old('provincia') == "S. C. Tenerife" ? 'selected' : ''}}>S. C. Tenerife</option>
                                        <option value="Segovia" {{old('provincia') == "Segovia" ? 'selected' : ''}}>Segovia</option>
                                        <option value="Sevilla" {{old('provincia') == "Sevilla" ? 'selected' : ''}}>Sevilla</option>
                                        <option value="Soria" {{old('provincia') == "Soria" ? 'selected' : ''}}>Soria</option>
                                        <option value="Tarragona" {{old('provincia') == "Tarragona" ? 'selected' : ''}}>Tarragona</option>
                                        <option value="Teruel" {{old('provincia') == "Teruel" ? 'selected' : ''}}>Teruel</option>
                                        <option value="Toledo" {{old('provincia') == "Toledo" ? 'selected' : ''}}>Toledo</option>
                                        <option value="Valencia" {{old('provincia') == "Valencia" ? 'selected' : ''}}>Valencia</option>
                                        <option value="Valladolid" {{old('provincia') == "Valladolid" ? 'selected' : ''}}>Valladolid</option>
                                        <option value="Vizcaya" {{old('provincia') == "Vizcaya" ? 'selected' : ''}}>Vizcaya</option>
                                        <option value="Zamora" {{old('provincia') == "Zamora" ? 'selected' : ''}}>Zamora</option>
                                        <option value="Zaragoza" {{old('provincia') == "Zaragoza" ? 'selected' : ''}}>Zaragoza</option>
                                        <option value="PD" {{old('provincia') == "PD" ? 'selected' : ''}}>Por definir</option>
                                    </select>
                                    @error('provincia')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                                </div>
                                
                                <div class="form-group col-md-8 mx-auto">
                                    <label for="term_municipal" class="col-form-label text-md-center">Término municipal</label>
                                    <input id="term_municipal" type="text" class="form-control @error('term_municipal') is-invalid @enderror" title="Tamaño máximo 80 caracteres" name="term_municipal" value="{{ old('term_municipal') }}" autocomplete="term_municipal">
                                    @error('term_municipal')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-8 mx-auto">
                                    <label for="sociedad" class="col-form-label text-md-center">Sociedad</label>
                                    <input id="sociedad" type="text" class="form-control @error('sociedad') is-invalid @enderror" title="Tamaño máximo 80 caracteres"name="sociedad" value="{{ old('sociedad') }}" autocomplete="sociedad">
                                    @error('sociedad')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                
                                <div class="form-group row col-md-8 mx-auto">
                                    <button class="btn btn-primary mx-auto d-block" title="Alta de Proyecto"><i class="fas fa-save"></i></button>
                                    <button type="reset" class="btn btn-danger mx-auto d-block" title="Limpiar campos"><i class="fas fa-times"></i></button>
                                    <a href="{{ URL::previous() }}" class="btn btn-primary mx-auto d-block" title="Volver atrás sin guardar datos">
                                        <i class="fas fa-reply"></i>
                                    </a>
                                </div>
                                
                                
                            </div>
                        </fieldset>   
                          
                    </div>
                      
               
                </form>
            
        
             
            

@endsection


  

