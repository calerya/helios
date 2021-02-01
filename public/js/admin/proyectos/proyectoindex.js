$(function() {
    $('#select-organismo').on('change',onSelectOrganismoChange);
});

$(function() {
    $('#boton-editar-org').on('click',onClickEditarOrganismo);
});

$(function() {
    $('#boton-alta-org').on('click',onClickAltaOrganismo);
});

$(function() {
    $('#boton-eliminar-org').on('click',onClickEliminarOrganismo);
  
});

function onClickEditarOrganismo() {
  //
    }

function onClickAltaOrganismo() {
    var proyecto_id = $('#proyecto-id option:selected').val();

    document.location.href = '/organismo/'+proy_id+'/ver';
 //  document.location.href = '/organismos';
   
    }

function onClickEliminarOrganismo() {
 //
    }
}
    
function onSelectOrganismoChange() {
   //
    
    });
    
}
}