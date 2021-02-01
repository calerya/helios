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
    
    <div class="card border-primary mb-1">
        <div class="card-body">
            <div class="col-md-12">
            <div class="card-header row justify-content-center">
                <h4 class="col-9 text-center">Mostrando finca del proyecto <strong>{{ $proyecto->nom_proyecto }}</strong></h4>
                <div class="col-3 justify-content-center align-items-center float-right">
                    <button class="btn btn-primary mr-2" title="Editar finca"><i class="fas fa-edit"></i></button>
                    <a href="{{ URL::previous() }}" class="btn btn-primary ml-2" title="Volver atrás sin guardar datos">
                        <i class="fas fa-reply"></i>
                    </a>
                </div>
            </div>
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
                        <td width="20%">{{ $finca->ref_catastral}}</td>
                        <td>{{ $finca->provincia}}</td>
                        <td>{{ $finca->municipio}}</td>
                        <td>{{ $finca->zona}}</td>
                        <td width="9%">{{ $finca->poligono}}</td>
                        <td width="9%">{{ $finca->parcela}}</td>
                        <td width="9%">{{ $finca->uso}}</td>
                    </tr>

                    <tr  class="table-active">
                        <th scope="col">Venta / Alq</th>
                        <th scope="col">Sup. Cat. ha</th>
                        <th scope="col">Sup. Útil ha</th>
                    </tr>
                    <br>
                    <tr>
                        <td>{{ $finca->venta_alq}}</td>
                        <td>{{ $finca->sup_catastral_ha}}</td>
                        <td>{{ $finca->sup_util_ha}}</td>
                    </tr>
                </table>
            
                <div class="card border-light mb-1">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Observaciones:</strong>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2" style="text-align:left;">
                        {!! $finca->observaciones !!}
                    </div>
                
              
                </div>
               
              
            </div>
        </div>
    </div>
    </div>
            
                <input
                    id="proyecto_id"
                    name="proyecto_id"
                    value={{$proyecto->id}}
                    type="hidden"
                >
            <br>
            
            
    
                     
  @endsection

 