<?php

namespace App\Http\Controllers\Proyecto;

use App\Hito;
use App\User;
use App\Finca;
use App\Session;




use App\Proyecto;
use App\Organismo;
use App\Exports\HitosExport;
use Illuminate\Http\Request;

use App\Exports\ProyectosExport;
use App\Http\Controllers\Controller;
//use App\Exports\OrganismosExport;
use App\Notifications\NuevoProyecto;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\proyectoDataTable;
use Illuminate\Support\Facades\Route;
use App\Exports\ProyectosBuscadosExport;
use App\Notifications\ProyectoEliminado;
use Yajra\DataTables\Facades\DataTables;

class ProyectoController extends Controller
{
    
    public function index()
    {
        if(auth()->user()->rol == 3){
            $proyectos = Proyecto::orderBy('created_at','desc')
            ->where(auth()->user()->id,'=','user_id')
            ->where('finalizado','=','0')->get();
        } else {
            $proyectos = Proyecto::orderBy('created_at','desc')
            ->where('finalizado','=','0')->get();
        }

        
        
        foreach($proyectos as $proyecto) {
            
            $proyecto->tot = Organismo::join('proyectos', 'proyectos.id','=', 'organismos.proyecto_id')
            ->where('proyectos.id','=',$proyecto->id)
            ->count();
            
            $proyecto->fin = Organismo::join('proyectos', 'proyectos.id','=', 'organismos.proyecto_id')
            ->where('proyectos.id','=',$proyecto->id)->where('organismos.finalizado','=','1')
            ->count();

            // $proyecto->usu = User::where('id','=','proyectos.users_id')
            // ->get('name');
            // $proyecto->usu = User::where($proyecto->users_id)->get('name');
            // dd($proyecto->usu);
        }
        
        return view('proyectos.index')->with(compact('proyectos'));
        
        
    }
    
    public function finalizados(Request $request)
    {
        $request->session()->forget('busqueda');

        $nom_proyecto=$request->get('nom_proyecto');
        $provincia=$request->get('provincia');
        $term_municipal=$request->get('term_municipal');
        
        if(auth()->user()->rol == 3){
            $proyectos = Proyecto::orderBy('created_at','desc')
            ->nom_proyecto($nom_proyecto)
            ->provincia($provincia)
            ->term_municipal($term_municipal)
            ->where('users_id','=',auth()->user()->id)
            ->where('finalizado','=', '1')->paginate(4);
        } else {
            $proyectos = Proyecto::orderBy('created_at','desc')
            ->nom_proyecto($nom_proyecto)
            ->provincia($provincia)
            ->term_municipal($term_municipal)
            ->where('finalizado','=','1')->paginate(4);
        }
        
        foreach($proyectos as $proyecto) {
            
            $proyecto->tot = Organismo::join('proyectos', 'proyectos.id','=', 'organismos.proyecto_id')
            ->where('proyectos.id','=',$proyecto->id)
            ->count();
            
        }
      
                
        if($proyectos->count()==0){
        $request->session()->flash('busqueda','No hay proyectos que cumplan con las condiciones de búsqueda');
        }
              
        return view ('proyectos.finalizados')->with(compact('proyectos'));
    }
    
    public function crearhitos($id){
            
            for ($i = 1; $i < 6; $i++) {

                $hito=new Hito();

                $hito->proyecto_id = $id;
                $hito->hito_numero = $i;
                $hito->fec_sol_ind = null;
                $hito->fec_obt_ind = null;
                $hito->fec_com_dis = null;
                $hito->fec_contest = null;



                $hito->save();
            }
        
    }
    
    public function ver($id)
    {
        $proyecto = Proyecto::find($id);
        
        $organismos = Organismo::where('proyecto_id', $proyecto->id)
        ->where('organismos.finalizado','=', '0')->get();
        
        $user = User::find($proyecto->users_id);
        
        $existe = Hito::where('proyecto_id', '=', $id)->exists();
        // Si no hay hitos con el id del proyecto, creamos los hitos a null
        if (!$existe) {
            $this->crearhitos($id);
        }
            
        $hitos = Hito::where('proyecto_id', $id)->get();

        $fincas = Finca::where('proyecto_id', $id)->get();
        
        
      return view('proyectos.ver')->with(compact('proyecto','organismos','user', 'hitos', 'fincas'));
        
        
    }
    
    public function getOrganismo($id)
    {
        return Organismo::where('id', $id)->get();
        
        
    }
    
    public function store(Request $request)
    {
       
        $rules = [
           'nom_proyecto'=>'required|string|min:1|max:50',
            'provincia' =>'required',
            'term_municipal' =>'required|string|min:1|max:80',
            'sociedad' =>'required|string|min:1|max:80',
           
            
            
        ];
        
        
        $this->validate($request, $rules);
                
        //Damos de alta primero el proyecto
        
        $proyecto=new Proyecto();
                
        $proyecto->nom_proyecto = $request->input('nom_proyecto');
        $proyecto->users_id= auth()->user()->id;
        $proyecto->provincia = $request->input('provincia');
        $proyecto->term_municipal = $request->input('term_municipal');
        $proyecto->sociedad = $request->input('sociedad');
      
        
        $proyecto->save();

        $notificaciones = User::whereIn('rol', array(1,2))->get();
        
        foreach ($notificaciones as $notificacion) {
            $notificacion->notify( new NuevoProyecto($proyecto->nom_proyecto, $proyecto->id, Auth()->user()->name) );
        }
        
        
        
        return redirect ('/proyectos')->with('status', 'Proyecto '.$proyecto->nom_proyecto.' dado de alta!');
        
      
    }
    
        
    public function edit($id)
    {
        $proyecto=Proyecto::find($id);
        return view ('proyectos.edit')->with(compact('proyecto'));
    }
    
    public function update($id, Request $request)
    {
       
         $rules = [
          'nom_proyecto'=>'required|string|min:1|max:50',
            'provincia' =>'required',
            'term_municipal' =>'required|string|min:1|max:80',
            'sociedad' =>'required|string|min:1|max:80',
          
            
        ];
        
         $this->validate($request, $rules);
         
        
         $proyecto = Proyecto::find($id);
         $proyecto->nom_proyecto = $request->input('nom_proyecto');
         $proyecto->provincia = $request->input('provincia');
         $proyecto->term_municipal = $request->input('term_municipal');         
         $proyecto->sociedad = $request->input('sociedad');
        
         
         $proyecto->save();
         
         return redirect ('/proyectos')->with('status','Proyecto actualizado correctamente');
    }
    
    public function delete($id)
    {
        $proyecto = Proyecto::find($id);
        $nom_proyecto = $proyecto->nom_proyecto;
        $user_name = Auth()->user()->name;
   
        
        $notificaciones = User::whereIn('rol', array(1,2))
        ->orWhere('id','=',$proyecto->users_id)
        ->get();

        $proyecto->delete();
        
        
        $organismo = Organismo::where('proyecto_id',$id);
        $organismo->delete();
        
        
     
        $hito = Hito::where('proyecto_id',$id);
        $hito->delete();

        
        foreach ($notificaciones as $notificacion) {
            $notificacion->notify( new ProyectoEliminado ($nom_proyecto, $user_name ));
        }

        
        
        
        
        return redirect ('/buscador')->with('eliminado','El proyecto, sus hitos y sus organismos se han dado de baja correctamente');
     
    }
    
      
    public function buscador()
    {
        
        // $request->session()->forget('busqueda');

        // $nom_proyecto=$request->get('nom_proyecto');
        // $provincia=$request->get('provincia');
        // $term_municipal=$request->get('term_municipal');

        
     
      
                
        // if($todosproyectos->count()==0){
        //     $request->session()->flash('busqueda','No hay proyectos que cumplan con las condiciones de búsqueda');
        // }
        // else if($request->get('excel')){
        //         $hoy=today()->format('d-m-Y');
        //         $ruta='Proyectos_buscados_'.$hoy;
        //         $rutafichero=preg_replace('/[^A-Za-zá-ú0-9\-]/', '-', $ruta);
        //         $ruta=$rutafichero.'.xlsx';
        //         return Excel::download(new ProyectosBuscadosExport($todosproyectos), $ruta);
        //     }
                      
        // return view ('proyectos.buscador')->with(compact('proyectos'));

        // $proyectos = Proyecto::all();
        // dd($proyectos);
        
        //return $dataTable->render('proyectos.buscador',$proyectos);
        
        //return $dataTable->render('proyectos.buscador');

        return view('proyectos.buscador');
        
    }

    public function tablaproyectos(Request $request)
    {
        if(auth()->user()->rol == 3){
            $proyectos = Proyecto::orderBy('created_at','desc')
            ->where('users_id','=',auth()->user()->id)
            ->where('finalizado','=', '0')->get();
        } else {
            $proyectos = Proyecto::orderBy('created_at','desc')
            ->where('finalizado','=','0')->get();
        }

              
        foreach($proyectos as $proyecto) {
        
            $proyecto->tot = Organismo::join('proyectos', 'proyectos.id','=', 'organismos.proyecto_id')
            ->where('proyectos.id','=',$proyecto->id)
            ->count();
            
            $proyecto->fin = Finca::join('proyectos', 'proyectos.id','=', 'fincas.proyecto_id')
            ->where('proyectos.id','=',$proyecto->id)
            ->count();

            $proyecto->usu = User::where('id','=',$proyecto->users_id)->value('name');
            
        }


        if ($request->ajax()) {
           return DataTables::of($proyectos)
                ->addIndexColumn()
                ->editColumn('created_at', function ($proyecto) 
                    {       
                    return date('d/m/y', strtotime($proyecto->created_at));
                    })
                ->addColumn('link', function($proyecto){
                    $actionBtn = 
                    '<a href="/organismo/lista/'.$proyecto->id.'" 
                    class="btn btn-info btn-sm rounded-circle"
                    title="Ver organismos del proyecto">'.$proyecto->tot.'
                   </a>';
                   return $actionBtn;
                })
                ->addColumn('fin', function($proyecto){
                    $actionBtn = 
                    '<a href="/fincas/'.$proyecto->id.'" 
                    class="btn btn-info btn-sm rounded-circle"
                    title="Ver fincas del proyecto">'.$proyecto->fin.'
                   </a>';
                   return $actionBtn;
                })
                ->addColumn('action', function($proyecto){
                    $actionBtn = 
                    '<a href="/proyecto/'.$proyecto->id.'/ver" 
                    class="btn btn-success btn-sm"
                    title="Ver el proyecto">
                    <i class="far fa-eye"></i></a>
                    <a href="/proyecto/'.$proyecto->id.'" 
                    class="btn btn-primary btn-sm"
                    title="Editar el proyecto">
                    <i class="far fa-edit"></i></a>
                    <button type="button" 
                    class="btn btn btn-danger btn-sm" 
                    data-toggle="modal" data-target="#exampleModal" 
                    title="Eliminar el proyecto, sus organismos y sus hitos">
                    <i class="fas fa-trash-alt"></i></button>
                    <a class="btn btn-info btn-sm"
                    title="Más opciones"
                    href="#" role="button" 
                    id="dropdownMenuLink" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/organismo/'.$proyecto->id.'/ver">Crear organismo</a>
                        <a class="dropdown-item" href="/hito/'.$proyecto->id.'/ver">Ver hitos</a>
                        <a class="dropdown-item" href="#">Crear finca</a>
                        <a class="dropdown-item" href="#">Exportar a Excel</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['link','fin','action'])
                ->make(true);
        }

    }

    // '<a href="/proyecto/".$proyecto->id 
                    // class="btn btn-sm btn-primary" 
                    // title="Editar el proyecto">
                    // <i class="far fa-edit"></i>
                    // </a>

    
    public function hitos(Request $request)
    {
        $hito_seleccionado=$request->input('selecciona_hito');
        $proyectos=NULL;
        
               
        if($hito_seleccionado!='-1'){
            $proyectos = Proyecto::orderBy('created_at','DESC')
                ->where('hitos','=',$hito_seleccionado)
                ->where('finalizado','=','0')
                ->paginate(5);

            foreach($proyectos as $proyecto) {

                $proyecto->tot = Organismo::join('proyectos', 'proyectos.id','=', 'organismos.proyecto_id')
                ->where('proyectos.id','=',$proyecto->id)
                ->count();

                $proyecto->fin = Organismo::join('proyectos', 'proyectos.id','=', 'organismos.proyecto_id')
                ->where('proyectos.id','=',$proyecto->id)->where('organismos.finalizado','=','1')
                ->count();
            }
            
            $request->session()->flash('seleccionado',$hito_seleccionado); 
        }
        
        
        else{
        $request->session()->forget('seleccionado');  
        }
        
        return view ('proyectos.hitos')->with(compact('proyectos'));
    }
    
    public function finalizar($id)
    {
        $proyecto = Proyecto::find($id);
                
        $proyecto->finalizado=1;
        $proyecto->save();
        $status="finalizado";
        $mensaje='Proyecto dado por finalizado correctamente!';
        
        return redirect ('/proyectos')->with($status,$mensaje);
        
    }
    
     public function activar($id)
    {
        $proyecto = Proyecto::find($id);
                
        $proyecto->finalizado=0;
        $proyecto->save();
        $status="activado";
        $mensaje='Proyecto activado correctamente!';
        
        return redirect ('/finalizados')->with($status,$mensaje);
        
    }
    
        
    // public function createorganismoPDF($seleccionado) 
    // {
        
    //     $hoy=today()->format('d-m-Y');
    //     $fechamas30=today()->addDays(30);
  
    //     switch ($seleccionado) {
    //         case "Caducados":
                          
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->where('fec_caducidad','<',$fechamas30)
    //             ->where('organismos.finalizado','=', '0')
    //             ->orderBy('fec_caducidad','ASC')
    //             ->get();
                
    //             break;
            
    //         case "Requerimiento":
                
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->whereNotNull('fec_requerimiento')
    //             ->whereNull('fec_cont_requerimiento')
    //             ->where('organismos.finalizado','=', '0')
    //             ->orderBy('fec_caducidad','ASC')
    //             ->get();
                
    //             break;
                
    //         case "Con-resolucion":
              
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->whereNotNull('fec_resolucion')
    //             ->where('organismos.finalizado','=', '0')
    //             ->orderBy('fec_resolucion','ASC')
    //             ->get();
                
    //               break;
                  
    //         case "Sin-resolucion":
                                
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->whereNull('fec_resolucion')
    //             ->where('organismos.finalizado','=', '0')
    //             ->orderBy('fec_presentacion','ASC')
    //             ->get();
                
    //               break;
            
    //         case "Prorroga":
                                
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->whereNotNull('fec_solic_prorroga')
    //             ->whereNull('fec_concesion_pror')
    //             ->where('organismos.finalizado','=', '0')
    //             ->orderBy('fec_solic_prorroga','ASC')
    //             ->get();
                
    //               break;
                
    //         case "Todos":
                                
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->where('organismos.finalizado','=', '0')
    //             ->orderBy('fec_presentacion','ASC')
    //             ->get();
                
    //               break;
            
    //         case "Finalizados":
                                
    //             $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
    //             ->select('proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
    //             ->where('organismos.finalizado','=', '1')
    //             ->orderBy('fec_presentacion','ASC')
    //             ->get();
                
    //               break;
            
    //         default:
                
               
    //         break;
                
    //         } 

       
    // $pdf = \PDF::loadView('PDF.organismos', compact('organismos','seleccionado'))->setPaper('a4', 'landscape');
        
    // $ruta='Listado_'.$seleccionado.'_'.$hoy.'.pdf';
    
    // return $pdf->download($ruta);
    
    // } // Fin createorganimosPDF    
    
    
   
    
    public function createproyectoXLSX($id) 
    {
         
        $nom_proyecto= Proyecto::where('id', '=', $id)
        ->value('nom_proyecto');

        $hoy=today()->format('d-m-Y');
        $ruta='Proyecto_'.$nom_proyecto.'_'.$hoy;
        $rutafichero=preg_replace('/[^A-Za-zá-ú0-9\-]/', '-', $ruta);
        $ruta=$rutafichero.'.xlsx';
        return Excel::download(new ProyectosExport($id), $ruta);   
     
     
 } // Fin de createproyectoXLSX 
    
    public function hitosEXCEL($seleccionado) 
    {
         
        $hoy=today()->format('d-m-Y');
        $ruta='Proyectos_con_'.$seleccionado.'_hitos_'.$hoy.'.xlsx';
        return Excel::download(new HitosExport($seleccionado), $ruta);
       
     
     
 } // Fin de createproyectoXLSX 
    
} //fin de la clase
