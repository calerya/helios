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

        <div class="col-md-12">
            <div class="table-responsive">

            <div class="justify-content-center align-items-center">
                <fieldset class="border p-2">
                    <legend class="w-auto">Fincas del proyecto {{$proyecto->nom_proyecto}}
                        <a href="{{route('fincas.create',['id' => $proyecto->id])}}"
                            class="btn btn-primary ml-3">
                            Añadir finca
                         </a>
                    </legend>
               
                   
          
                 <table class="table table-hover table-bordered" style="text-align:center;">
               
                <thead>
                    <tr class="table-active">
                        <div><th width="20%" scope="col">Ref. catastral</th></div>
                        <th scope="col">Provincia</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Zona</th>
                        <th width="8%" scope="col">Polígono</th>
                        <th width="8%" scope="col">Parcela</th>
                        <th width="12%" scope="col">Opc</th>
                    </tr>
                </thead>
                
                
                <tbody>
                    @foreach($fincas as $finca)
                    <tr>
                        <div><td width="20%">{{ $finca->ref_catastral }}</td></div>
                        <div><td>{{ $finca->provincia }}</td></div>
                        <div><td>{{ $finca->municipio }}</td></div>
                        <div><td>{{ $finca->zona }}</td></div>                       
                        <div><td width="8%">{{ $finca->poligono }}</td></div>
                        <div><td width="8%">{{ $finca->parcela }}</td></div>
                        <div><td width="12%">
                            <a href="{{route('fincas.show',['id' => $finca->id])}}" 
                                class="btn btn-sm btn-success"
                                title="Ver los datos de la finca">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{route('fincas.show', $finca->id)}}" 
                                class="btn btn-sm btn-primary" 
                                title="Editar los datos de la finca">
                                <i class="far fa-edit"></i>
                            </a>
                            <button 
                                type="button" 
                                class="btn btn-sm btn-danger" 
                                data-toggle="modal" 
                                data-target="#exampleModal" 
                                title="Eliminar la finca y sus propietarios">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            
                            <div class="modal" id="exampleModal">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Eliminar finca</h5>
                                      
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="text-center">
                                        <span class="text-warning"><i style="font-size:70px" class="fas fa-exclamation-circle"></i></span>  
                                    </div>
                                    <p>Quiere eliminar la finca y sus propietarios?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      <a href="/finca/destroy"><button class="btn btn-danger">Eliminar</button></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                                
                        </td></div>
                    </tr>
                    @endforeach
                                       
                </tbody>
                    
                 
                 
                </table>
            </fieldset>    
            </div>
        </div>
           
        <br>
            <div class="row justify-content-center align-items-center">
                {!! $fincas->appends(Request::except('page'))->render() !!}  
                <h6>Total {{ $fincas->total() }} finca(s).</h6>
            </div>
          
</div>

                  
   
@endsection



