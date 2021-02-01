@extends('layouts.app')

@section('content')


    @if(session('notificacion'))
        <div class="alert alert-dismissible alert-success">
           
            {{ session('notificacion') }}
            
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-primary mb-3">
                
            <form action="" method="POST">    
        
                {{ csrf_field() }}
        
                    
                                                                                       
                        <div class="card-header">
                            <h4>Editar usuario</h4>
                        </div>

                        <div class="card-body">
                                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de usuario</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" 
                                    value="{{ old('name', $user->name) }}" required autofocus>
                                </div>
                            </div>
                    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    Dirección de E-mail</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" readonly value="{{ old('email', $user->email) }}">

                                    
                                </div>
                            </div>
                    
                                                  
                            
                            <div class="form-group row">
                                
                                <label for="rol" class="col-md-4 col-form-label text-md-right">Tipo de usuario</label>
                                <div class="col-md-6">
                                    <select name="rol" class="form-control" value="{{ old('rol', $user->rol) }}" required>
                                        
                                        @if (($user->rol) == 1)
                                            <option value=1 selected>Administrador</option>
                                        @else
                                            <option value=1>Administrador</option>
                                        @endif
                                        
                                        @if (($user->rol) == 2)
                                            <option value=2 selected>Responsable</option>
                                        @else
                                            <option value=2>Responsable</option>
                                        @endif
                                        
                                        @if (($user->rol) == 3)
                                            <option value=3 selected>Usuario / Técnico</option>
                                        @else
                                            <option value=3>Usuario / Técnico</option>
                                        @endif
                                        
                                        @if (($user->rol) == 4)
                                            <option value=4 selected>Sólo consultas</option>
                                        @else
                                            <option value=4>Sólo consultas</option>
                                        @endif
                                        
                                    </select>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                                <div class="col-md-6">
                                    <button class="btn btn-primary" title="Guardar proyecto"><i class="fas fa-save"></i></button>

                                    <button type="reset" class="btn btn-danger" title="Cancelar edición"><i class="fas fa-times"></i></button>

                                    <a href="/proyectos" class="btn btn-primary" title="Volver a usuarios sin guardar">
                                    <i class="fas fa-reply"></i>
                                    </a>
                               </div>
                            
                            
                            
                        </div>
               
                </form>
            
            
            
            
            
        
        </div>
            
            
            
            
            </div>
        </div>
    </div>

                
     
  


@endsection
