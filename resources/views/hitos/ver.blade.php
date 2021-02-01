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

    
    <div class="row justify-content-center align-items-center">
        <fieldset class="border p-1 col-md-12">
          <legend class="w-auto">Hitos de {{ $proyecto->nom_proyecto }}</legend>
                    
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
        </fieldset>
    </div>

@endsection

