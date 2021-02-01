$(function() {
    $('#select-organismo').on('change',onSelectOrganismoChange);
});

$(function() {
    $('#boton-editar-org').on('click',onClickEditarOrganismo);
});

$(function() {
    $('#boton-finalizar-org').on('click',onClickFinalizarOrganismo);
});

$(function() {
    $('#boton-alta-org').on('click',onClickAltaOrganismo);
});

$(function() {
    $('#boton-eliminar-org').on('click',onClickEliminarOrganismo);
  
});

function onClickEditarOrganismo() {
    var organismo_id = $('#select-organismo option:selected').val();
    document.location.href = '/organismo/'+organismo_id;
    }

function onClickAltaOrganismo() {
    var proy_id = $('#proyecto-id option:selected').val();

    document.location.href = '/organismo/'+proy_id+'/ver';
 //  document.location.href = '/organismos';
   
    }


function onClickEliminarOrganismo() {
 
    var organismo_id = $('#select-organismo option:selected').val();
    
    var x = confirm("Quiere dar de baja el organismo?");
    if(x) {
        document.location.href = '/organismo/'+organismo_id+'/eliminar';
    }
    
     
} 

function onClickFinalizarOrganismo() {
 
    var organismo_id = $('#select-organismo option:selected').val();
    
    var x = confirm("Quiere dar por finalizado el organismo?");
    if(x) {
        document.location.href = '/organismo/'+organismo_id+'/finalizar';
        
    
    }
}
    
function onSelectOrganismoChange() {
    var organismo_id = $(this).val();
    var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
    
    if (organismo_id == -1) {
        $('#organismo').html("Datos del organismo:");
        $('#num-expediente').html("-");
        $('#fec-presentacion').html("-");
        $('#fec-requerimiento').html("-");
        $('#fec-cont-requerimiento').html("-");
        $('#fec-inicio-ip').html("-");
        $('#fec-fin-ip').html("-");
        $('#fec-resolucion').html("-");
        $('#fec-publ-resolucion').html("-");
        $('#fec-caducidad').html("-");
        $('#fec-solic-prorroga').html("-");
        $('#fec-concesion-pror').html("-");
        $('#num-prorrogas').html("-");
        $('#fec-solic-apm').html("-");
        $('#fec-conc-apm').html("-");
        $('#observaciones').html("");
        $("#boton-editar-org").removeAttr("style").hide();
        $("#boton-eliminar-org").removeAttr("style").hide();
        $("#boton-finalizar-org").removeAttr("style").hide();
        $('#boton-alta-org').show();
} else {
    $.get('/api/proyecto/'+organismo_id+'/organismo',function (data){
        
        $("#boton-editar-org").show();
        $("#boton-eliminar-org").show();
        $("#boton-finalizar-org").show();
        $('#boton-alta-org').removeAttr("style").hide();
        
        if(data[0].organismo == null) {
        $('#organismo').html("Datos del organismo");}
        else { $('#organismo').html("Datos del organismo: "+data[0].organismo);}
        
        if(data[0].num_expediente == null) {
        $('#num-expediente').html("-");}
        else { $('#num-expediente').html(data[0].num_expediente);}
       
        if(data[0].fec_presentacion == null) {
        $('#fec-presentacion').html("-");}
        else { 
            var from = new Date(data[0].fec_presentacion);
            var fechapresentacion=from.toLocaleDateString("es-ES", options);
            $('#fec-presentacion').html(fechapresentacion);}
             
        if(data[0].fec_requerimiento == null) {
        $('#fec-requerimiento').html("-");}
        else { 
            var from = new Date(data[0].fec_requerimiento);
            var requerimiento=from.toLocaleDateString("es-ES", options);
            $('#fec-requerimiento').html(requerimiento);}
        
        if(data[0].fec_cont_requerimiento == null) {
        $('#fec-cont-requerimiento').html("-");}
        else { 
            var from = new Date(data[0].fec_cont_requerimiento);
            var contestacion=from.toLocaleDateString("es-ES", options);
            $('#fec-cont-requerimiento').html(contestacion);}
        
        if(data[0].fec_inicio_ip == null) {
        $('#fec-inicio-ip').html("-");}
        else { 
            var from = new Date(data[0].fec_inicio_ip);
            var inicio_ip=from.toLocaleDateString("es-ES", options);
            $('#fec-inicio-ip').html(inicio_ip);}
        
        if(data[0].fec_fin_ip == null) {
        $('#fec-fin-ip').html("-");}
        else { 
            var from = new Date(data[0].fec_fin_ip);
            var fin=from.toLocaleDateString("es-ES", options);
            $('#fec-fin-ip').html(fin);}
        
        if(data[0].fec_resolucion == null) {
        $('#fec-resolucion').html("-");}
        else { 
            var from = new Date(data[0].fec_resolucion);
            var resolucion=from.toLocaleDateString("es-ES", options);
            $('#fec-resolucion').html(resolucion);}
        
        if(data[0].fec_publ_resolucion == null) {
        $('#fec-publ-resolucion').html("-");}
        else { 
            var from = new Date(data[0].fec_publ_resolucion);
            var publ_resolucion=from.toLocaleDateString("es-ES", options);
            $('#fec-publ-resolucion').html(publ_resolucion);}
        
        if(data[0].fec_caducidad == null) {
        $('#fec-caducidad').html("-");}
        else { 
            var from = new Date(data[0].fec_caducidad);
            var caducidad=from.toLocaleDateString("es-ES", options);
            $('#fec-caducidad').html(caducidad);}
        
        if(data[0].fec_solic_prorroga == null) {
        $('#fec-solic-prorroga').html("-");}
        else { 
            var from = new Date(data[0].fec_solic_prorroga);
            var solicprorroga=from.toLocaleDateString("es-ES", options);
            $('#fec-solic-prorroga').html(solicprorroga);}
        
        if(data[0].fec_concesion_pror == null) {
        $('#fec-concesion-pror').html("-");}
        else { 
            var from = new Date(data[0].fec_concesion_pror);
            var concprorroga=from.toLocaleDateString("es-ES", options);
            $('#fec-concesion-pror').html(concprorroga);}
        
        if(data[0].fec_solic_apm == null) {
        $('#fec-solic-apm').html("-");}
        else { 
            var from = new Date(data[0].fec_solic_apm);
            var solicapm=from.toLocaleDateString("es-ES", options);
            $('#fec-solic-apm').html(solicapm);}
        
        if(data[0].fec_conc_apm == null) {
        $('#fec-conc-apm').html("-");}
        else { 
            var from = new Date(data[0].fec_conc_apm);
            var concapm=from.toLocaleDateString("es-ES", options);
            $('#fec-conc-apm').html(concapm);}
        
        if(data[0].num_prorrogas == null) {
        $('#num-prorrogas').html("-");}
        else { $('#num-prorrogas').html(data[0].num_prorrogas);}
            
        if(data[0].observaciones == null) {
        $('#observaciones').html("");}
        else { $('#observaciones').html(data[0].observaciones);}
     
    
    });
    
}
}