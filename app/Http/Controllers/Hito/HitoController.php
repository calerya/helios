<?php

namespace App\Http\Controllers\Hito;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hito;
use App\Proyecto;

class HitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
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
    
    
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ver($id)
    {
       
        $existe = Hito::where('proyecto_id', '=', $id)->exists();
        // Si no hay hitos con el id del proyecto, creamos los hitos a null
        if (!$existe) {
            $this->crearhitos($id);
        }
            
        $proyecto = Proyecto::find($id);
        
        $hitos = Hito::where('proyecto_id', $id)->get();
       
      return view('hitos.ver')->with(compact('proyecto','hitos'));
        
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
              
    $hito = Hito::find($id);
    $proyecto = Proyecto::where('id',$hito->proyecto_id)->get();
       
       
    return view('hitos.edit')->with(compact('hito','proyecto'));
        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = [
          
            'fec_sol_ind' => 'date',
            'fec_obt_ind' => 'date',
            'fec_com_dis' => 'date',
            'fec_contest' => 'date',
           
        ];
        
    //     $this->validate($request, $rules);
               
         $hito = Hito::find($id);
         
         $hito->fec_sol_ind = $request->input('fec_sol_ind');
         $hito->fec_obt_ind = $request->input('fec_obt_ind');
         $hito->fec_com_dis = $request->input('fec_com_dis');
         $hito->fec_contest = $request->input('fec_contest');
         
         
         $hito->save();
        
        
        
        return redirect ('/hito/'.$hito->proyecto_id.'/ver')->with('status','Hito '.$hito->hito_numero.' actualizado correctamente');
       
    }
    
    public function delete($id)
    {
        $hito = Hito::find($id);
        $proyecto = $hito->proyecto_id;
        $ruta = "/proyecto/".$proyecto."/ver";
        
        if($hito->delete()){
            $status="eliminado";
            $mensaje='Hito dado de baja correctamente';
        }
        else{
            $status="cancelado";
            $mensaje='Operación cancelada, el hito no ha sido dado de baja';
        }
        
        
        
        return redirect ($ruta)->with($status,$mensaje);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
