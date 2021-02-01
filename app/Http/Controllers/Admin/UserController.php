<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Proyecto;
use App\Organismo;
use App\Hito;


class UserController extends Controller
{
    
    public function index()
    {
        $users = User::OrderBy('id','asc')->paginate(3);
        
        return view('admin.users.index')->with(compact('users'));
    }
    
     public function store(Request $request)
    {
         $rules=[
             'name' =>'required|max:255',
             'email' => 'required|email|max:255|unique:users',
             'password' => 'required|min:8'
             
         ];
         
         $messages=[
             'name.required' =>'Es necesario introducir el nombre de usuario.',
             'name.max' =>'El nombre es demasiado largo.',
             'email.required' =>'Es necesario introducir el e-mail de usuario.',
             'email.email' =>'El formato del e-mail no es válido.',
             'email.unique' =>'Este e-mail ya está dado de alta con un usuario.',
             'password.required' =>'Es necesario introducir una contraseña.',
             'password.min' =>'La contraseña debe ser de al menos 8 caracteres.'
             
         ];
         
         $this->validate($request, $rules, $messages);
         
         $user = new User();
         
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->password= bcrypt($request->input('password'));
         $user->rol = $request->input('rol');
         
         $user->save();
         
         return redirect ('/usuarios')->with('status', 'Usuario dado de alta!');
    }
    
     public function edit($id)
    {
      $user=User::find($id);
      return view ('admin.users.edit')->with(compact('user'));
    }
    
     public function update($id, Request $request)
    {
       
         $rules=[
             'name' =>'required|max:255',
             
             'password' => 'min:8'
             
         ];
         
         $messages=[
             'name.required' =>'Es necesario introducir el nombre de usuario.',
             'name.max' =>'El nombre es demasiado largo.',
            
             'password.required' =>'Es necesario introducir una contraseña.',
             'password.min' =>'La contraseña debe ser de al menos 8 caracteres.'
             
         ];
         $this->validate($request, $rules, $messages);
         
        
         $user = User::find($id);
         $user->name = $request->input('name');
         
         $password = $request->input('password');
         
         if($password)
             $user->password = bcrypt($password);
         
         $user->rol = $request->input('rol');
        
         
         $user->save();
         
         return redirect ('/usuarios')->with('status','Usuario actualizado correctamente');
    }
    
    public function delete($id)
    {
        //Localizamos el usuario y hacemos softDelete
        $user = User::find($id);
        $user->delete();
        
        return redirect ('/usuarios')->with('status','Usuario dado de baja correctamente');
        
    }
    
    // Gestión de elementos eliminados por parte del administrador
    
    public function proyectoseliminados(){
        
    //Muestra sólo los proyectos que están eliminados
                
       $proyectos = Proyecto::onlyTrashed()
        ->orderBy('deleted_at','desc')
        ->paginate(4);
       
        return view('admin.users.eliminados.proyectos')->with(compact('proyectos'));
        
    }//Fin de proyectoseliminados
    
    public function organismoseliminados(){
        
    //Muestra sólo los organismos que están eliminados   
        
       $organismos = Organismo::onlyTrashed()
                ->join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                ->select('proyectos.nom_proyecto as nombre','organismos.*')
                ->orderBy('deleted_at','desc')
                ->paginate(4);
                
                 
        return view('admin.users.eliminados.organismos')->with(compact('organismos'));
        
    }//Fin de organismoseliminados
    
    public function usuarioseliminados(){
        
        //Muestra sólo los usuarios que están eliminados
        
        $users = User::onlyTrashed()
        ->orderBy('deleted_at','desc')
        ->paginate(4);
       
        return view('admin.users.eliminados.usuarios')->with(compact('users'));
        
    }//Fin de proyectoseliminados
    
    public function recuperarproyectos($id){
       
        // Recupera el proyecto eliminado
        Proyecto::onlyTrashed()->find($id)->restore();
        
        // Recupera los organismos eliminados de el proyecto recuperado
        /* $organismos = Organismo::onlyTrashed()
        ->where('organismos.proyecto_id','=','$id')->restore();
        
        $hitos = Hito::onlyTrashed()
        ->where('hitos.proyecto_id','=','$id')->restore();*/
        
        Organismo::onlyTrashed()
        ->where('organismos.proyecto_id',$id)->restore();
        
        Hito::onlyTrashed()
        ->where('hitos.proyecto_id',$id)->restore();
        
           
        return back()->with('status','Proyecto, sus hitos y sus organismos recuperados correctamente');;
        
    }//Fin de recuperarproyectos
    
    public function recuperarorganismos($id){
        
        // Localizamos el organismo a recuperar
        $organismo = Organismo::onlyTrashed()->find($id);
        
        //Comprobamos si el proyecto está eliminado o no
        $proyecto = Proyecto::where('id',"=",$organismo->proyecto_id)->first();
        
        // Si no está eliminado el proyecto
        if(!is_null($proyecto)){
            
            $organismo->restore();
            $tipo = 'status';
            $mensaje = 'Organismo recuperado correctamente';
        
        // Si está eliminado el proyecto
        }else{
            
            $tipo = 'cancelado';
            $mensaje = 'El proyecto del organismo que intenta recuperar, está borrado de la base de datos. Recupere primero el proyecto eliminado antes de recuperar sus organismos.';
        }
          
        return back()->with($tipo,$mensaje);
        
    }//Fin de recuperarorganismos
    
    public function recuperarusuarios($id){
        
        // Recupera el usuario eliminado
        
       $user = User::onlyTrashed()->find($id)->restore();
          
        return back()->with('status','Usuario recuperado correctamente');
        
    }//Fin de recuperarusuarios
    
    
}//Fin de la clase
