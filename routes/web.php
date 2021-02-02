<?php

//use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes(['register' => false]);



// Route::get('/buscar', 'HomeController@index');
Route::get('/consultas', 'HomeController@consultas');
// Route::get('/ver/{id}', 'HomeController@ver');

Route::get('/home', function () {
    if( Auth::user() ) //se valida si esta logueado
        if( Auth::user()->rol =='4' ) //se valida el tipo de usuario
            return redirect('/consultas');
        else
            return redirect('/');
    else
        return redirect('/login');
});


Route::group(['middleware'=>'proyecto', 'namespace'=>'Proyecto'], function(){
    
    Route::get('/proyectos', 'ProyectoController@index');
    Route::post('/proyectos', 'ProyectoController@store');

    Route::get('/proyecto/{id}/ver', 'ProyectoController@ver');
    
    Route::get('/proyecto/{id}', 'ProyectoController@edit');
    Route::post('/proyecto/{id}', 'ProyectoController@update');
    
    Route::get('/proyecto/{id}/eliminar', 'ProyectoController@delete');
    
    
    Route::get('/buscador', 'ProyectoController@buscador')->name('buscar');
    Route::get('/buscador/proyectos', 'ProyectoController@tablaproyectos')->name('buscar.proyectos');
    
    Route::get('/listados/pdf/{id}','ProyectoController@createorganismoPDF');
    
    Route::get('/proyecto/{id}/excel','ProyectoController@createproyectoXLSX');
      
    Route::get('/proyecto/{id}/finalizar','ProyectoController@finalizar');
    
    Route::get('/finalizados','ProyectoController@finalizados')->name('finalizados');
    
    Route::get('/proyecto/{id}/activar','ProyectoController@activar');
    
    
      
    
    
});

Route::group(['middleware'=>'organismo', 'namespace'=>'Organismo'], function(){
    
    Route::get('/organismos', 'OrganismoController@index');
    Route::post('/organismos/guardar', 'OrganismoController@guardar');
    
    Route::get('/organismo/{id}', 'OrganismoController@edit');
    Route::post('/organismo/{id}', 'OrganismoController@update');
    
    Route::get('/organismo/{id}/eliminar', 'OrganismoController@delete');
    Route::get('/organismo/{id}/finalizar', 'OrganismoController@finalizar');
    Route::get('/organismo/{id}/activar', 'OrganismoController@activar');
    
    Route::get('/organismo/{id}/ver', 'OrganismoController@ver');
    
    Route::get('/organismo/{id}/añadir', 'OrganismoController@añadir');
    
    Route::get('/listados', 'OrganismoController@listado');

    Route::get('/organismo/lista/{id}', 'OrganismoController@listadoOrganismos');
    
    Route::get('/listados/excel/{id}','OrganismoController@createorganismoEXCEL');
    
});

Route::group(['middleware'=>'hito', 'namespace'=>'Hito'], function(){
    
    Route::get('/hito/{id}', 'HitoController@edit');
    Route::post('/hito/{id}', 'HitoController@update');
    
    Route::get('/hito/{id}/ver', 'HitoController@ver');
    
});

Route::group(['middleware'=>'propietario', 'namespace'=>'Propietario'], function(){
    
    Route::get('/propietarios', 'PropietarioController@index');
    Route::post('/propietarios/guardar', 'PropietarioController@guardar');
    
    Route::get('/propietario/{id}/añadir', 'PropietarioController@añadir');
    
    Route::get('/propietarios/{id}', 'PropietarioController@ver');
    
    Route::get('/propietario/{id}/eliminar', 'PropietarioController@delete');
    
    Route::get('/propietario/{id}', 'PropietarioController@edit');
    Route::post('/propietario/{id}', 'PropietarioController@update');
    
});  

Route::group(['middleware'=>'finca', 'namespace'=>'Finca'], function(){
    
    Route::get('/fincas/{id}', 'FincaController@index')->name('fincas.index');

    Route::get('/fincas/create/{id}', 'FincaController@create')->name('fincas.create');
    Route::post('/fincas', 'FincaController@store')->name('fincas.store');

    Route::get('/fincas/show/{id}', 'FincaController@show')->name('fincas.show');

    Route::get('/fincas/destroy/{id}', 'FincaController@destroy')->name('fincas.destroy');

    //Route::post('/fincas/catastro/{id}', 'FincaController@catastro')->name('fincas.catastro');

    


    
    

    // Route::post('/propietarios/guardar', 'PropietarioController@guardar');
    
    // Route::get('/propietario/{id}/añadir', 'PropietarioController@añadir');
    
    // Route::get('/propietarios/{id}', 'PropietarioController@ver');
    
    // Route::get('/propietario/{id}/eliminar', 'PropietarioController@delete');
    
    // Route::get('/propietario/{id}', 'PropietarioController@edit');
    // Route::post('/propietario/{id}', 'PropietarioController@update');
    
});  



Route::group(['middleware'=>'admin', 'namespace'=>'Admin'], function(){
    
    Route::get('/usuarios', 'UserController@index');
    Route::post('/usuarios', 'UserController@store');
    
    Route::get('/usuario/{id}', 'UserController@edit');
    Route::post('/usuario/{id}', 'UserController@update');
    
    Route::get('/usuario/{id}/eliminar', 'UserController@delete');
    
    Route::get('/eliminados/proyectos', 'UserController@proyectoseliminados');
    Route::get('/eliminados/organismos', 'UserController@organismoseliminados');
    Route::get('/eliminados/usuarios', 'UserController@usuarioseliminados');
    
    Route::get('/recuperar/{id}/proyectos', 'UserController@recuperarproyectos');
    Route::get('/recuperar/{id}/organismos', 'UserController@recuperarorganismos');
    Route::get('/recuperar/{id}/usuarios', 'UserController@recuperarusuarios');

});

