$(function() {

$('#enexcel').on("click", function() {
 
          var seleccionado = $('#selecciona_listado option:selected').val();
      
         if(seleccionado != -1){
                  
            document.location.href = '/listados/excel/'+seleccionado; 
         }
      
      
  });
});

/*
$('#busqueda-en-excel').on("click", function() {
 
          var seleccionado = $('#selecciona_listado option:selected').val();
      
         if(seleccionado != -1){
                  
            document.location.href = '/listados/excel/'+seleccionado; 
         }
      
      
  });
});
*/

$(function() {

$('#hitosexcel').on("click", function() {
 
          var seleccionado = $('#selecciona_hito option:selected').val();
      
         if(seleccionado != -1){
                
            document.location.href = '/hitos/excel/'+seleccionado; 
         }
      
      
  });
});

/*

$(function() {

  $('#enpdf').on("click", function() {
 
          var seleccionado = $('#selecciona_listado option:selected').val();
      
         if(seleccionado != -1){
                          
               document.location.href = '/listados/pdf/'+seleccionado; 
            }
      
      
  });
}); */


$(function() {
    $('#selecciona_listado').on('change',function(){
      
        var seleccionado = $('#selecciona_listado option:selected').val();
      
        if(seleccionado != -1){
                
            $('#enexcel').prop("disabled", false);
            }
            
        else{
            
            $('#enexcel').prop("disabled", true);
            }
        
        document.getElementById("listado_form").submit();
        
        
        
    });
     });
    
    $(function() {
    $('#selecciona_hito').on('change',function(){
      
        var seleccionado = $('#selecciona_hito option:selected').val();
      
        if(seleccionado != -1){
                
            $('#hitosexcel').prop("disabled", false);
            
            }
            
        else{
            
            $('#hitosexcel').prop("disabled", true);
         
            }
        
        document.getElementById("hitos_form").submit();
        
        
        
   
    });
      });