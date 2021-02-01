@extends('layouts.app')

@section('content')


   

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
    
            
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
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
                
                <div class="card-header text-md-center">
                    <h5>Recuperar usuarios eliminados</h5>
                </div>
                
            <table class="table table-hover">
               
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Tipo usuario</th>
                        <th style="text-align:center;" scope="col">Opciones</th>
                    </tr>
                </thead>
                
                
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if($user->rol==1)
                            <td >Administrador</td>
                        @endif
                        @if($user->rol==2)
                            <td >Responsable</td>
                        @endif
                        @if($user->rol==3)
                            <td >Usuario/Técnico</td>
                        @endif
                        @if($user->rol==4)
                            <td >Sólo consultas</td>
                        @endif
                        
                        
                        <td style="text-align:center;">
                            
                            
                            <a href='/recuperar/{{$user->id}}/usuarios' class="btn btn-sm btn-success" title="Recuperar usuario">
                                <i class="fas fa-user-plus"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                                       
                </tbody>
                
                
            </table>
                
                 
        
        </div>
            
            
            
            
            </div>
        </div>
    </div>

                
{{ $users->links() }}
  


@endsection
