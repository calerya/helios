<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proyecto;
use App\User;
use App\Organismo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->rol==4){
            return view('listado');
        }
        else{
            return view('proyectos');
        }
            
        
    }
    
    public function consultas()
    {
        
        $proyectos = Proyecto::orderBy('id','asc')->paginate(5);
        return view('proyectos.consultas')->with(compact('proyectos'));
        
    }
    
    public function ver($id){
        
        $proyecto = Proyecto::find($id);
        $organismos = Organismo::where('proyecto_id', $proyecto->id)->get();
        $user = User::find($proyecto->users_id);
        
        
      return view('ver')->with(compact('proyecto','organismos', 'user'));
        
    }
    
}