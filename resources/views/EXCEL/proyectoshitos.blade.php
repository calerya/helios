
 

    
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
                        <th scope="col">Fecha de alta</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Sociedad</th>
                      
                        
                                                
                    </tr>
                </thead>
                
                
                
                <tbody>
                    @foreach($proyectos as $proyecto)
                    <tr>
                        
                        <td>{{ $proyecto->nom_proyecto }}</td>
                        <td>{{ $proyecto->created_at->format('d/m/Y') }}</td>
                        <td>{{ $proyecto->provincia }}</td>
                        <td>{{ $proyecto->term_municipal }}</td>
                        <td>{{ $proyecto->sociedad }}</td>
                        
                                       
                    </tr>
                    @endforeach
                   
                           
                </tbody>
                    
            </table>
    
   
    @if(!is_null($proyectos))
        @if($proyectos->count()==0)
      
        <div style="text-align:center">
            <h5>No hay proyectos que cumplan con el criterio seleccionado</h5>
        </div>  
    
    @endif
    @endif
    
    
               
      
</body>

</html>
 