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
                    <h4>Editar Proyecto</h4>
                </div>

                        <div class="card-body">
                            
                            <table class="table table-hover" style="text-align:center;">
               
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Proyecto</th>
                                        <th scope="col">Provincia</th>
                                        <th scope="col">Término municipal</th>
                                        <th scope="col">Sociedad</th>
                                <!--        <th scope="col">Hitos</th> -->
                                        <th scope="col">Dado de alta</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                                    
                                <tr>
                                    <td><input title="Escribe para cambiar el nombre del proyecto" id="nom_proyecto" type="text" class="form-control text-md-center" maxlength="50" title="Tamaño máximo 50 caracteres" name="nom_proyecto" value="{{ old('nom_proyecto', $proyecto->nom_proyecto) }}" required autocomplete="nom_proyecto" autofocus>
                                    </td>
                              
                                    <td>
                                    <select name="provincia" class="form-control text-md-center" 
                                    value="{{ old('provincia', $proyecto->provincia) }}" required>
                                        
                                        @if (($proyecto->provincia) == 'A Coruña')
                                            <option value="A Coruña" selected>A Coruña</option>
                                        @else
                                            <option value="A Coruña">A Coruña</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Álava')
                                            <option value="Álava" selected>Álava</option>
                                        @else
                                            <option value="Álava">Álava</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Albacete')
                                            <option value="Albacete" selected>Albacete</option>
                                        @else
                                            <option value="Albacete">Albacete</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Alicante')
                                            <option value="Alicante" selected>Alicante</option>
                                        @else
                                            <option value="Alicante">Alicante</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Almería')
                                            <option value="Almería" selected>Almería</option>
                                        @else
                                            <option value="Almería">Almería</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Asturias')
                                            <option value="Asturias" selected>Asturias</option>
                                        @else
                                            <option value="Asturias">Asturias</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Ávila')
                                            <option value="Ávila" selected>Ávila</option>
                                        @else
                                            <option value="Ávila">Ávila</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Barcelona')
                                            <option value="Barcelona" selected>Barcelona</option>
                                        @else
                                            <option value="Barcelona">Barcelona</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Burgos')
                                            <option value="Burgos" selected>Burgos</option>
                                        @else
                                            <option value="Burgos">Burgos</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Cáceres')
                                            <option value="Cáceres" selected>Cáceres</option>
                                        @else
                                            <option value="Cáceres">Cáceres</option>
                                        @endif
                                    
                                        @if (($proyecto->provincia) == 'Cádiz')
                                            <option value="Cádiz" selected>Cádiz</option>
                                        @else
                                            <option value="Cádiz">Cádiz</option>
                                        @endif
                                     
                                        @if (($proyecto->provincia) == 'Cantabria')
                                            <option value="Cantabria" selected>Cantabria</option>
                                        @else
                                            <option value="Cantabria">Cantabria</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Castellón')
                                            <option value="Castellón" selected>Castellón</option>
                                        @else
                                            <option value="Castellón">Castellón</option>
                                        @endif
                                       
                                        @if (($proyecto->provincia) == 'Ciudad Real')
                                            <option value="Ciudad Real" selected>Ciudad Real</option>
                                        @else
                                            <option value="Ciudad Real">Ciudad Real</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Córdoba')
                                            <option value="Córdoba" selected>Córdoba</option>
                                        @else
                                            <option value="Córdoba">Córdoba</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Cuenca')
                                            <option value="Cuenca" selected>Cuenca</option>
                                        @else
                                            <option value="Cuenca">Cuenca</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Girona')
                                            <option value="Girona" selected>Girona</option>
                                        @else
                                            <option value="Girona">Girona</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Granada')
                                            <option value="Granada" selected>Granada</option>
                                        @else
                                            <option value="Granada">Granada</option>
                                        @endif
                                       
                                        @if (($proyecto->provincia) == 'Guadalajara')
                                            <option value="Guadalajara" selected>Guadalajara</option>
                                        @else
                                            <option value="Guadalajara">Guadalajara</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Guipúzcoa')
                                            <option value="Guipúzcoa" selected>Guipúzcoa</option>
                                        @else
                                            <option value="Guipúzcoa">Guipúzcoa</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Huelva')
                                            <option value="Huelva" selected>Huelva</option>
                                        @else
                                            <option value="Huelva">Huelva</option>
                                        @endif
                                   
                                        @if (($proyecto->provincia) == 'Huesca')
                                            <option value="Huesca" selected>Huesca</option>
                                        @else
                                            <option value="Huesca">Huesca</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Islas Baleares')
                                            <option value="Islas Baleares" selected>Islas Baleares</option>
                                        @else
                                            <option value="Islas Baleares">Islas Baleares</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Jaén')
                                            <option value="Jaén" selected>Jaén</option>
                                        @else
                                            <option value="Jaén">Jaén</option>
                                        @endif
                                    
                                        @if (($proyecto->provincia) == 'La Rioja')
                                            <option value="La Rioja" selected>La Rioja</option>
                                        @else
                                            <option value="La Rioja">La Rioja</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Las Palmas')
                                            <option value="Las Palmas" selected>Las Palmas</option>
                                        @else
                                            <option value="Las Palmas">Las Palmas</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'León')
                                            <option value="León" selected>León</option>
                                        @else
                                            <option value="León">León</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Lleida')
                                            <option value="Lleida" selected>Lleida</option>
                                        @else
                                            <option value="Lleida">Lleida</option>
                                        @endif
                                    
                                        @if (($proyecto->provincia) == 'Lugo')
                                            <option value="Lugo" selected>Lugo</option>
                                        @else
                                            <option value="Lugo">Lugo</option>
                                        @endif
                                       
                                        @if (($proyecto->provincia) == 'Madrid')
                                            <option value="Madrid" selected>Madrid</option>
                                        @else
                                            <option value="Madrid">Madrid</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Málaga')
                                            <option value="Málaga" selected>Málaga</option>
                                        @else
                                            <option value="Málaga">Málaga</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Murcia')
                                            <option value="Murcia" selected>Murcia</option>
                                        @else
                                            <option value="Murcia">Murcia</option>
                                        @endif
                                       
                                        @if (($proyecto->provincia) == 'Navarra')
                                            <option value="Navarra" selected>Navarra</option>
                                        @else
                                            <option value="Navarra">Navarra</option>
                                        @endif
                                    
                                        @if (($proyecto->provincia) == 'Ourense')
                                            <option value="Ourense" selected>Ourense</option>
                                        @else
                                            <option value="Ourense">Ourense</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Palencia')
                                            <option value="Palencia" selected>Palencia</option>
                                        @else
                                            <option value="Palencia">Palencia</option>
                                        @endif
                                       
                                        @if (($proyecto->provincia) == 'Pontevedra')
                                            <option value="Pontevedra" selected>Pontevedra</option>
                                        @else
                                            <option value="Pontevedra">Pontevedra</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Salamanca')
                                            <option value="Salamanca" selected>Salamanca</option>
                                        @else
                                            <option value="Salamanca">Salamanca</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'S. C. Tenerife')
                                            <option value="S. C. Tenerife" selected>S. C. Tenerife</option>
                                        @else
                                            <option value="S. C. Tenerife">S. C. Tenerife</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Segovia')
                                            <option value="Segovia" selected>Segovia</option>
                                        @else
                                            <option value="Segovia">Segovia</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Sevilla')
                                            <option value="Sevilla" selected>Sevilla</option>
                                        @else
                                            <option value="Sevilla">Sevilla</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Soria')
                                            <option value="Soria" selected>Soria</option>
                                        @else
                                            <option value="Soria">Soria</option>
                                        @endif
                                    
                                        @if (($proyecto->provincia) == 'Tarragona')
                                            <option value="Tarragona" selected>Tarragona</option>
                                        @else
                                            <option value="Tarragona">Tarragona</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Teruel')
                                            <option value="Teruel" selected>Teruel</option>
                                        @else
                                            <option value="Teruel">Teruel</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Toledo')
                                            <option value="Toledo" selected>Toledo</option>
                                        @else
                                            <option value="Toledo">Toledo</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Valencia')
                                            <option value="Valencia" selected>Valencia</option>
                                        @else
                                            <option value="Valencia">Valencia</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Valladolid')
                                            <option value="Valladolid" selected>Valladolid</option>
                                        @else
                                            <option value="Valladolid">Valladolid</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Vizcaya')
                                            <option value="Vizcaya" selected>Vizcaya</option>
                                        @else
                                            <option value="Vizcaya">Vizcaya</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Zamora')
                                            <option value="Zamora" selected>Zamora</option>
                                        @else
                                            <option value="Zamora">Zamora</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Zaragoza')
                                            <option value="Zaragoza" selected>Zaragoza</option>
                                        @else
                                            <option value="Zaragoza">Zaragoza</option>
                                        @endif
                                        
                                        @if (($proyecto->provincia) == 'Por definir')
                                            <option value="Por definir" selected>Por definir</option>
                                        @else
                                            <option value="Por definir">Por definir</option>
                                        @endif
                                        
                                    </select>
                                </td>
                                
                                <td>
                                    <input id="term_municipal" type="text" class="form-control text-md-center" maxlength="80" title="Tamaño máximo 80 caracteres" name="term_municipal" value="{{ old('term_municipal', $proyecto->term_municipal) }}" required autocomplete="term_municipal">
                                </td>
                                
                                <td>
                                    <input id="sociedad" type="text" class="form-control text-md-center" maxlength="80" title="Tamaño máximo 80 caracteres"name="sociedad" value="{{ old('sociedad', $proyecto->sociedad) }}" required autocomplete="sociedad">
                                </td>
                                    
                         <!--       <td>
                                    <select name="hitos" class="form-control text-md-center" 
                                    value="{{ old('hitos', $proyecto->hitos) }}" required>
                                        
                                        @if (($proyecto->hitos) == '0')
                                            <option value="0" selected>0 hitos</option>
                                        @else
                                            <option value="0">0 hitos</option>
                                        @endif
                                        
                                        @if (($proyecto->hitos) == '1')
                                            <option value="1" selected>1 hito</option>
                                        @else
                                            <option value="1">1 hito</option>
                                        @endif
                                        
                                        @if (($proyecto->hitos) == '2')
                                            <option value="2" selected>2 hitos</option>
                                        @else
                                            <option value="2">2 hitos</option>
                                        @endif
                                        
                                        @if (($proyecto->hitos) == '3')
                                            <option value="3" selected>3 hitos</option>
                                        @else
                                            <option value="3">3 hitos</option>
                                        @endif
                                        
                                        @if (($proyecto->hitos) == '4')
                                            <option value="4" selected>4 hitos</option>
                                        @else
                                            <option value="4">4 hitos</option>
                                        @endif
                                        
                                        @if (($proyecto->hitos) == '5')
                                            <option value="5" selected>5 hitos</option>
                                        @else
                                            <option value="5">5 hitos</option>
                                        @endif
                                    
                                    </select>
                                </td> -->
                                        
                                        
                                <td>
                                    <input title="La fecha de alta no se puede modificar" id="created_at" type="text" class="form-control text-md-center" name="created_at" value="{{ old('created_at', $proyecto->created_at->format('d/m/Y')) }}" disabled>
                                </td>
                                                                
                                
                                    
                                <td class="text-md-center">
                                    
                                    <button class="btn btn-primary" title="Guardar proyecto"><i class="fas fa-save"></i></button>

                                    <button type="reset" class="btn btn-danger" title="Cancelar edición"><i class="fas fa-times"></i></button>

                                    <a href="{{ URL::previous() }}" class="btn btn-primary" title="Volver atrás sin guardar datos">
                                    <i class="fas fa-reply"></i>
                                    </a>
                              
                                </td>
                                
                          
                            </tbody>
                        </table>
                </div>
            </form>
            
        
                        
                    
    </div>
                    

@endsection


