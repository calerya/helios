@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-primary mb-3">
                <div class="card-header text-md-center"><h4>Helios</h4></div>

                <div class="card-body">
                    
                    @if(auth()->check())
                    
                    <p>Bienvenido/a {{ auth()->user()->name }} a la aplicación de prueba <strong>Helios.</strong></p>

                    <p>Para cualquier incidencia con la aplicación, por favor, contacta con un administrador.</p>
                    
                    <p>Para la correcta visualización del contenido se recomienda usar el navegador <strong>Google Chrome</strong> debidamente actualizado.</p>
                    
                    <p>Si olvidas la contraseña, al iniciar sesión puedes pulsar en <strong>¿olvidaste la contraseña?</strong> para que la aplicación te envíe un correo con un link para resetearla. Es importante que tengas la dirección de e-mail de la aplicación <strong>helios@calerya.com.es</strong> añadida a tus contactos para que dicho mail entre en la bandeja de entrada de tu gestor de correo.</p>
                    
                    
                    @else
                    
                    <p>Para empezar a trabajar en la aplicación, tienes que loguearte.</p>

                    <p>Haz click en <strong>Inicia sesión</strong>, en la esquina superior derecha, e introduce tus datos.
                    <br>
                    <p>Para cualquier consulta acerca de la aplicación, por favor, contacta con un administrador.</p>
                    
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection