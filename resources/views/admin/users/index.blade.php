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
                
            <form action="" method="post">    
        
                {{ csrf_field() }}
        
                    
                                                                                       
                        <div class="card-header">
                            <h4>Usuarios</h4>
                        </div>

                        <div class="card-body">
                                            
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Usuario</label>

                                <div class="col-md-4">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                           
                                <label for="email" class="col-md-2 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-4">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-4">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <label for="rol" class="col-md-2 col-form-label text-md-right">Tipo de usuario</label>
                                <div class="col-md-4">
                                    <select name="rol" class="form-control" required>
                                        <option value=1>Administrador</option>
                                        <option value=2>Responsable</option>
                                        <option value=3>Usuario / Técnico</option>
                                        <option value=4>Sólo consultas</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-2">
                                <button class="btn btn-primary">Registrar usuario</button>
                                </div>
                            </div>
                        </div>
               
                </form>
            
            
            
            
            <table class="table table-hover">
               
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Tipo usuario</th>
                        <th scope="col">Opciones</th>
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
                        
                        
                        <td>
                            
                            <a href="/usuario/{{ $user->id }}" class="btn btn-sm btn-primary" title="Editar">
                                <i class="far fa-edit"></i>
                            </a>
                            
                            <a href="/usuario/{{ $user->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                                <i class="fas fa-trash-alt"></i>
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
