<?php

namespace App\Http\Controllers\Organismo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Organismo;
use App\Proyecto;
use App\User;
use App\Session;
use App\Exports\OrganismosExport;


class OrganismoController extends Controller
{
    //

    public function listadoOrganismos($id)
    {
        $organismos =  Organismo::where('proyecto_id', '=',  $id)->get();
        $nom_proyecto = Proyecto::where('id','=',$id)->value('nom_proyecto');
      
    
        return view ('organismos.lista')->with(compact('organismos','nom_proyecto','id')); 
        
    }

    
    public function getOrganismo($id)
    {
        return Organismo::where('id', $id)->get();
        
    }
    
    public function getProyecto($id)
    {
        return Proyecto::where('id', $id)->get();
      
    }
    
    
    public function index()
    {
      return view('organismos.index');
    }
    
    public function añadir($id)
    {
       $proyecto = Proyecto::find($id);
 
       return view ('organismos.añadir')->with(compact('proyecto'));
        
        
    }
    
    
    public function ver($id, Request $request)
    {
        
        $proyecto = Proyecto::where('id',$id)->get(['nom_proyecto']);
              
        $request->session()->flash('proyecto-id',$id);
        $request->session()->flash('proyecto-nombre',$proyecto[0]->nom_proyecto);
        
        
      
        return view ('organismos.index');
        
    }
    
    public function guardar(Request $request)
    {
       
        $rules = [
           'organismo'=>'required|string|min:1|max:50',
            'num-expediente'=>'required|string|min:1|max:50',
            'fec_presentacion' => 'date',
            'fec_requerimiento' => 'date',
            'fec_cont_requerimiento' => 'date',
            'fec_inicio_ip' => 'date',
            'fec_fin_ip' => 'date',
            'fec_resolucion' => 'date',
            'fec_publ_resolucion' =>'date', 
            'fec_caducidad' => 'date',
            'fec_solic_prorroga' => 'date',
            'fec_concesion_pror' => 'date',
            'fec_solic_apm' => 'date',
            'fec_conc_apm' => 'date',
        ];
        
        
        $this->validate($request, $rules);
                
             
        $organismo=new Organismo();
        
        
        $organismo->organismo = $request->input('organismo');
        $organismo->num_expediente = $request->input('num-expediente');
        $organismo->proyecto_id = $request->input('proyecto-id');
        $organismo->fec_presentacion = $request->input('fec-presentacion');
        $organismo->fec_requerimiento = $request->input('fec-requerimiento');
        $organismo->fec_cont_requerimiento = $request->input('fec-cont-requerimiento');
        $organismo->fec_inicio_ip = $request->input('fec-inicio-ip');
        $organismo->fec_fin_ip = $request->input('fec-fin-ip');
        $organismo->fec_resolucion = $request->input('fec-resolucion');
        $organismo->fec_publ_resolucion = $request->input('fec-publ-resolucion');
        $organismo->fec_caducidad = $request->input('fec-caducidad');
        $organismo->fec_solic_prorroga = $request->input('fec-solic-prorroga');
        $organismo->fec_concesion_pror = $request->input('fec-concesion-pror');
        $organismo->num_prorrogas = $request->input('num-prorrogas');
        $organismo->fec_solic_apm = $request->input('fec-solic-apm');
        $organismo->fec_conc_apm = $request->input('fec-conc-apm');
        $organismo->observaciones = $request->input('observaciones');
        $organismo->finalizado = 0;
        
        $organismo->save();
        
        
        return redirect ('/proyecto/'.$organismo->proyecto_id.'/ver')->with('status', 'Organismo '.$organismo->organismo.' dado de alta en el proyecto!');
        
      
    }
    
        
    
    public function edit($id)
    {
        $organismo=Organismo::find($id);
        
         
                
        return view ('organismos.edit')->with(compact('organismo')); //,'nomproyecto'
    }
     
    
    public function delete($id)
    {
        $organismo = Organismo::find($id);
        $proyecto = $organismo->proyecto_id;
        $ruta = "/proyecto/".$proyecto."/ver";
        
        if($organismo->delete()){
            $status="eliminado";
            $mensaje='Organismo dado de baja correctamente';
        }
        else{
            $status="cancelado";
            $mensaje='Operación cancelada, el organismo no ha sido dado de baja';
        }
        
        
        
        return redirect ($ruta)->with($status,$mensaje);
        
    }
    
  
    
    //Para dar un organismo por finalizado. Campo finalizado de Organimos = 1
    public function finalizar($id)
    {
        $organismo = Organismo::find($id);
        $proyecto = $organismo->proyecto_id;
        $organismo->finalizado=1;
        
        if($organismo->finalizado==1){
            $organismo->save();
            $status="finalizado";
            $mensaje='Organismo dado por finalizado correctamente';
        }
        else{
            $status="cancelado";
            $mensaje='Operación cancelada, el organismo no ha sido dado por finalizado';
        }
        
        
        
        return back ()->with($status,$mensaje);
        
    }
    
    //Para activar un organismo finalizado. Campo finalizado de Organimos = 0
    public function activar($id)
    {
        $organismo = Organismo::find($id);
        // $proyecto = $organismo->proyecto_id;
        $proyecto = Proyecto::where('id',$organismo->proyecto_id)->first();
        $organismo->finalizado=0;
        $proyecto->finalizado=0;
        
        if($organismo->finalizado==0){
            $organismo->save();
            $proyecto->save();
            $status="activado";
            $mensaje='Organismo activado correctamente';
        }
        else{
            $status="cancelado";
            $mensaje='Operación cancelada, el organismo no ha sido activado';
        }
        
        
        
        return back ()->with($status,$mensaje);
        
    }
  
    public function update($id, Request $request)
    {
         $rules = [
            'organismo'=>'required|string|min:1|max:50',
            'num-expediente'=>'required|string|min:1|max:50',
            'fec_presentacion' => 'date',
            'fec_requerimiento' => 'date',
            'fec_cont_requerimiento' => 'date',
            'fec_inicio_ip' => 'date',
            'fec_fin_ip' => 'date',
            'fec_resolucion' => 'date',
            'fec_publ_resolucion' =>'date', 
            'fec_caducidad' => 'date',
            'fec_solic_prorroga' => 'date',
            'fec_concesion_pror' => 'date',
        ];
        
         $this->validate($request, $rules);
                 
         $organismo = Organismo::find($id);
         $organismo->organismo = $request->input('organismo');
         $organismo->num_expediente = $request->input('num-expediente');
         $organismo->fec_presentacion = $request->input('fec-presentacion');
         $organismo->fec_requerimiento = $request->input('fec-requerimiento');
         $organismo->fec_cont_requerimiento = $request->input('fec-cont-requerimiento');
         $organismo->fec_inicio_ip = $request->input('fec-inicio-ip');
         $organismo->fec_fin_ip = $request->input('fec-fin-ip');
         $organismo->fec_resolucion = $request->input('fec-resolucion');
         $organismo->fec_publ_resolucion = $request->input('fec-publ-resolucion');
         $organismo->fec_caducidad = $request->input('fec-caducidad');
         $organismo->fec_solic_prorroga = $request->input('fec-solic-prorroga');
         $organismo->fec_concesion_pror = $request->input('fec-concesion-pror');
         $organismo->num_prorrogas = $request->input('num-prorrogas');
         $organismo->fec_solic_apm = $request->input('fec-solic-apm');
         $organismo->fec_conc_apm = $request->input('fec-conc-apm');
         $organismo->observaciones = $request->input('observaciones');
         
         
         $organismo->save();
         
         return redirect ('/proyecto/'.$organismo->proyecto_id.'/ver')->with('status','Organismo '.$organismo->organismo.' actualizado correctamente');
    }
    
     
    public function listado(Request $request)
    {
        
        $fechamas30=today()->addDays(30);
        $listado_seleccionado=$request->input('selecciona_listado');
        $organismos=NULL;


        
          switch ($listado_seleccionado) {
            case "Caducados":
                $request->session()->flash('seleccionado','Caducados');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->where('fec_caducidad','<',$fechamas30)
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->where('fec_caducidad','<',$fechamas30)
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }
     
                break;
            
            case "Requerimiento":
                $request->session()->flash('seleccionado','Requerimiento');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->whereNotNull('fec_requerimiento')
                    ->whereNull('fec_cont_requerimiento')
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->whereNotNull('fec_requerimiento')
                        ->whereNull('fec_cont_requerimiento')
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }

                  break;
                  
            case "Prorroga":
                $request->session()->flash('seleccionado','Prorroga');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->whereNotNull('fec_solic_prorroga')
                    ->whereNull('fec_concesion_pror')
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->whereNotNull('fec_solic_prorroga')
                        ->whereNull('fec_concesion_pror')
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }
                
                  break;
                  
            case "APM":
                $request->session()->flash('seleccionado','APM');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->whereNotNull('fec_solic_apm')
                    ->whereNull('fec_conc_apm')
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->whereNotNull('fec_solic_apm')
                        ->whereNull('fec_conc_apm')
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }
                
                  break;
                  
            case "Con-resolucion":
                $request->session()->flash('seleccionado','Con-resolucion');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->whereNotNull('fec_resolucion')
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->whereNotNull('fec_resolucion')
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }
               
                  break;
                  
            case "Sin-resolucion":
                $request->session()->flash('seleccionado','Sin-resolucion');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->whereNull('fec_resolucion')
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->whereNull('fec_resolucion')
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }
                
                
                  break;
                  
            case "Todos":
                
                $request->session()->flash('seleccionado','Todos');
                
                if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                {
                    $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                    ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                    ->where('organismos.finalizado','=', '0')
                    ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                    ->paginate(5);
                } else { 
                    if(auth()->user()->rol == 3)
                    {
                        $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                        ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                        ->where('organismos.finalizado','=', '0')
                        ->where('proyectos.users_id','=',auth()->user()->id)
                        ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                        ->paginate(5);
                    }

                }
                
                  break;
                  
             case "Finalizados":
                
                  $request->session()->flash('seleccionado','Finalizados');
                
                  if((auth()->user()->rol == 2) || (auth()->user()->rol == 1))
                  {
                      $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                      ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                      ->where('organismos.finalizado','=', '1')
                      ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                      ->paginate(5);
                  } else { 
                      if(auth()->user()->rol == 3)
                      {
                          $organismos = Organismo::join('proyectos', 'proyectos.id', '=', 'organismos.proyecto_id')
                          ->select('proyectos.users_id as user','proyectos.nom_proyecto as nombre','proyectos.provincia as provincia','proyectos.term_municipal as term_municipal', 'organismos.*')
                          ->where('organismos.finalizado','=', '1')
                          ->where('proyectos.users_id','=',auth()->user()->id)
                          ->orderBy('proyectos.nom_proyecto','ASC','fec_presentacion','ASC')
                          ->paginate(5);
                      }
  
                  }

                  break;
            
            default:
                $request->session()->forget('seleccionado');
                break;
                
            } 

        
        return view ('organismos.listado')->with(compact('organismos'));
     
    }
    
        
    public function createorganismoEXCEL($seleccionado) {
          
        $hoy=today()->format('d-m-Y');
        $ruta='Organismos_'.$seleccionado.'_'.$hoy.'.xlsx';
        return Excel::download(new OrganismosExport($seleccionado), $ruta);
      
    
    } // FIN DE LA function createorganismoEXCEL
    
    
} //FIN DE LA CLASE
