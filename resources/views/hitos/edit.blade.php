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
        
        
        <div class="col-md-12">
            <div class="table-responsive">
                <div class="card-header text-md-center">
                    <h5>Editando hito nº {{ $hito->hito_numero }} del proyecto: {{ $proyecto[0]->nom_proyecto }}</h5>
                </div>
                <table class="table table-hover table-bordered" style="text-align:center;">
                
                <tr>

                    <th scope="col">Hito nº</th>
                    <th scope="col">Solicitud Industria</th>
                    <th scope="col">Obtención Industria</th>
                    <th scope="col">Comunicación Distr.</th>
                    <th scope="col">Contestación</th>


                </tr>

              
                <tr>
                    
                 

                    <td><input title="El número de Hito no se puede modificar" id="hito_numero" type="text" class="form-control text-md-center" name="hito_numero" value="{{ old('hito_numero', $hito->hito_numero) }}" disabled>
                    </td>
                    
                    <td>@if ($hito->fec_sol_ind)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec_sol_ind" type="date" class="form-control text-md-center" name="fec_sol_ind" value="{{ old('fec_sol_ind', $hito->fec_sol_ind->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec_sol_ind" type="date" class="form-control text-md-center" name="fec_sol_ind" value="{{ old('fec_sol_ind', $hito->fec_sol_ind) }}">@endif
                    </td>
           
                    
                    <td>@if ($hito->fec_obt_ind)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec_obt_ind" type="date" class="form-control text-md-center" name="fec_obt_ind" value="{{ old('fec_obt_ind', $hito->fec_obt_ind->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec_obt_ind" type="date" class="form-control text-md-center" name="fec_obt_ind" value="{{ old('fec_obt_ind', $hito->fec_obt_ind) }}">@endif
                    </td>
                    
                    <td>@if ($hito->fec_com_dis)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec_com_dis" type="date" class="form-control text-md-center" name="fec_com_dis" value="{{ old('fec_com_dis', $hito->fec_com_dis->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec_com_dis" type="date" class="form-control text-md-center" name="fec_com_dis" value="{{ old('fec_com_dis', $hito->fec_com_dis) }}">@endif
                    </td>
                    
                    <td>@if ($hito->fec_contest)<input style="background-color: rgb(242, 243, 243); color: grey;" title="Elija fecha" id="fec_contest" type="date" class="form-control text-md-center" name="fec_contest" value="{{ old('fec_contest', $hito->fec_contest->format('Y-m-d')) }}">@else<input title="Elija fecha" id="fec_contest" type="date" class="form-control text-md-center" name="fec_contest" value="{{ old('fec_contest', $hito->fec_contest) }}">@endif
                    </td>
                    

                </tr>
            
                        
                
            </table>
            </div>
        </div>
                
                <div class="text-md-center">
                    <button class="btn btn-primary" title="Guardar cambios"><i class="fas fa-save"></i></button>

                    <button type="reset" class="btn btn-danger" title="Cancelar edición"><i class="fas fa-times"></i></button>
                    
                    
                    <a href="/proyecto/{{$proyecto[0]->id}}/ver" class="btn btn btn-primary" title="Volver al proyecto actual">
                    <i class="fas fa-reply"></i>
                    </a>
                    
                    <a href="/buscador" class="btn btn btn-primary" title="Volver al buscador de proyectos">
                    <i class="fas fa-solar-panel"></i>
                    </a>
                    
                    
                  
                </div>
                       
          
            </form>
                   
    </div>
                    

@endsection

