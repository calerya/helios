
 

    
   <style>
        header { background:#99CCCC; color:#FFFFFF; padding:15px; }
        footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
        p { page-break-after: always; }
        p:last-child { page-break-after: never; }
       
        body {font-family: Arial, Helvetica, sans-serif;}

        table {font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                font-size: 13px; margin 25px; width: 100%; text-align:center;border-collapse: collapse; }

        th {font-size: 13px;font-weight: normal;padding: 8px;text-align:center;background: #b9c9fe;
            border-top: 5px solid #aabcfe;border-bottom: 1px solid #fff; color: #039; }

        td {padding: 8px;background: #e8edff;text-align:center;border-bottom: 1px solid #fff;
            color: #669;border-top: 1px solid transparent; }

        tr:hover td { background: #d0dafd; color: #339; }
    </style>
  

    
<body>
    


            <table class="table" style="text-align:center">
            
            
                <thead>
                    <tr>
                        <th scope="col">Proyecto</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Sociedad</th>
                        <th scope="col">Organismo</th>
                        <th scope="col">Hitos</th>
                        <th scope="col">Final.</th>
                        <th scope="col">Expediente</th>
                        <th scope="col">Presentación</th>
                        <th scope="col">Requerim.</th>
                        <th scope="col">Contestación</th>
                        <th scope="col">Inicio IP</th>
                        <th scope="col">Fin IP</th>
                        <th scope="col">Resolución</th>
                        <th scope="col">Publicación</th>
                        <th scope="col">Caducidad</th>
                        <th scope="col">Solicitud pr</th>
                        <th scope="col">Concesión pr</th>
                        <th scope="col">Solic. APM</th>
                        <th scope="col">Conc. APM</th>
                        <th scope="col">Observaciones</th>
                        
                    </tr>
                </thead>
                
                
                
                <tbody>
                    @foreach($organismos as $organismo)
                    <tr>
                        <td>{{ $organismo->nombre }}</td>
                        <td>{{ $organismo->provincia }}</td>
                        <td>{{ $organismo->municipio }}</td>
                        <td>{{ $organismo->sociedad }}</td>
                        <td>{{ $organismo->organismo }}</td>
                        <td>{{ $organismo->hitos }}</td>
                        <td>@if($organismo->finalizado) Si @else No @endif</td>
                        <td>{{ $organismo->num_expediente }}</td>
                        <td>@if($organismo->fec_presentacion){{ $organismo->fec_presentacion->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_requerimiento){{ $organismo->fec_requerimiento->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_cont_requerimiento){{ $organismo->fec_cont_requerimiento->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_inicio_ip){{ $organismo->fec_inicio_ip->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_fin_ip){{ $organismo->fec_fin_ip->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_resolucion){{ $organismo->fec_resolucion->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_publ_resolucion){{ $organismo->fec_publ_resolucion->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_caducidad){{ $organismo->fec_caducidad->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_solic_prorroga){{ $organismo->fec_solic_prorroga->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_concesion_pror){{ $organismo->fec_concesion_pror->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_solic_apm){{ $organismo->fec_solic_apm->format('d/m/Y') }} @endif</td>
                        <td>@if($organismo->fec_conc_apm){{ $organismo->fec_conc_apm->format('d/m/Y') }} @endif</td>
                        <td>{!! $organismo->observaciones !!}</td>

                       
                       
                    </tr>
                    @endforeach
                   
                           
                </tbody>
                    
            </table>
    
   
    @if(!is_null($organismos))
        @if($organismos->count()==0)
      
        <div style="text-align:center">
            <h5>No hay registros que cumplan con el criterio seleccionado</h5>
        </div>  
    
    @endif
    @endif
    
    
               
      
</body>

</html>
 