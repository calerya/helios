<?php

namespace App\Http\Controllers\Finca;

use App\Finca;
use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FincaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fincas=Finca::where('proyecto_id','=', $id)->paginate(6);
        $proyecto=Proyecto::findOrFail($id);
        
        // dd($id, $fincas, $proyecto);
        return view ('fincas.index')
        ->with(compact('fincas',$fincas))
        ->with(compact('id'))
        ->with(compact('proyecto',$proyecto));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Obtiene el id actual de la ruta
        $id_proyecto = $request->route('id');
        // Obtiene el proyecto
        $proyecto = Proyecto::findOrFail($id_proyecto);



        return view ('fincas.create')
        ->with(compact('proyecto',$proyecto));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $rules=[
            'ref_catastral' => 'required|max:20',
            'proyecto_id' => 'required',
            'provincia' => 'required|max:100',
            'municipio' => 'required|max:100',
            'zona' => 'max:100',
            'poligono' => 'max:10',
            'parcela' => 'max:10',
            'uso' => 'max:50',
            'venta_alq' => 'required',
            'sup_catastral_ha' => 'max:9',
            'sup_util_ha' => 'max:9',
            'observaciones' => 'min:4',
        ];

        $this->validate($request, $rules);

        $finca=new Finca();
        $finca->ref_catastral = $request->get('ref_catastral');
        $finca->proyecto_id = $request->input('proyecto_id');
        $finca->provincia = $request->get('provincia');
        $finca->municipio = $request->get('municipio');
        $finca->zona = $request->get('zona');
        $finca->poligono = $request->get('poligono');
        $finca->parcela = $request->get('parcela');
        $finca->uso = $request->get('uso');
        $finca->venta_alq = $request->input('venta_alq');
        $finca->sup_catastral_ha = $request->input('sup_catastral_ha');
        $finca->sup_util_ha = $request->input('sup_util_ha');
        $finca->observaciones = $request->input('observaciones');
      
        $finca->save();

        $proyecto = Proyecto::findOrFail($finca->proyecto_id);
        // dd($proyecto);
      
        return redirect()->route('fincas.index', [$proyecto->id])
        ->with(compact('proyecto',$proyecto->id))
        ->with('status', 'Finca dada de alta en el proyecto '.$proyecto->nom_proyecto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finca  $finca
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
      
        $finca = Finca::findOrFail($id);
        $proyecto = Proyecto::findOrFail($finca->proyecto_id);
        
        return view ('fincas.show')
        ->with(compact('finca',$finca))
        ->with(compact('proyecto',$proyecto));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finca  $finca
     * @return \Illuminate\Http\Response
     */
    public function edit(Finca $finca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finca  $finca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finca $finca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finca  $finca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // $finca = Finca::where('id','=',$id)->get();
        $finca = Finca::findOrFail($id);
        // dd($finca, $id);
        $proyectoid = $finca->proyecto_id;
        // dd($finca, $id, $proyectoid);
        $finca->delete();

        return redirect ('/proyecto/'.$proyectoid.'/ver')
        ->with('status', 'Finca dada de baja del proyecto!');
    }

    // public function catastro(Request $request)
    // {
    //     $id_proyecto = $request->route('id');
    //     // Obtiene el proyecto
    //     $proyecto = Proyecto::findOrFail($id_proyecto);

    //     $base = 'http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/Consulta_DNPRC?Provincia=&Municipio=&RC=';
    //     $ref_catastral = $request->input('ref_catastral');
    //     $url= $base . $ref_catastral;
    //     $xmlString = file_get_contents(url($url)); 
    //     $xmlObject = simplexml_load_string($xmlString);
                   
    //     $json = json_encode($xmlObject);
    //     $phpArray = json_decode($json, true);

    //     if (array_key_exists('bico', $phpArray)) {
    //         $provincia = $phpArray['bico']['bi']['dt']['np'];
    //         $municipio = $phpArray['bico']['bi']['dt']['nm'];
    //         $zona = $phpArray['bico']['bi']['dt']['locs']['lors']['lorus']['npa'];
    //         $poligono = $phpArray['bico']['bi']['dt']['locs']['lors']['lorus']['cpp']['cpo'];
    //         $parcela = $phpArray['bico']['bi']['dt']['locs']['lors']['lorus']['cpp']['cpa'];
    //         $uso =  $phpArray['bico']['bi']['debi']['luso'];
    //         return view ('fincas.create')
    //     ->with(compact('ref_catastral'))
    //     ->with(compact('provincia'))
    //     ->with(compact('municipio'))
    //     ->with(compact('zona'))
    //     ->with(compact('poligono'))
    //     ->with(compact('parcela'))
    //     ->with(compact('uso'))
    //     ->with(compact('proyecto',$proyecto));
            
    //     } else {
            
    //         echo "The 'first' element is in the array";
    //         return view ('fincas.create')
    //         ->with(compact('proyecto',$proyecto))
    //         ->with('eliminado','No se han importado datos del Catastro');
    //     }

    //     // dd($phpArray);
        
        
        
   
       
        
    // }
}
