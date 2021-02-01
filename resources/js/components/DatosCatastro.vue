<template>
    <div class="row col-8 justify-content-center align-items-center float-right">
        <h5 class="font-weight-bold text-primary mr-2">Descarga datos catastrales no protegidos</h5>
       <input type="text" class="form-control-inline bg-light col-4" placeholder="20 caracteres - Ref. Catastral" id="refCat" v-model="refCat">
      <button class="btn btn-primary ml-2" v-on:click="consultaCatastro()">Obtener</button>
   </div>
</template>

<script>

export default {

    data: function() {
         return  {
           inputs: [],
           refCat: '',
           baseurl: 'http://ovc.catastro.meh.es/ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/Consulta_DNPRC?Provincia=&Municipio=&RC=',
         }
        },
    methods:  {
        consultaCatastro(){
            var rc = this.refCat;
            if(this.refCat.length!=20){
                alert("FORMATO ERRÓNEO DE REFERENCIA CATASTRAL\n\nLa referencia catastral está formada por 20 caracteres alfanuméricos");
  		        } else {
                       $.ajax({
                            url: this.baseurl+this.refCat,
                            type: 'get',
                            dataType: "xml",
                            success: function(response){
                                if(response.getElementsByTagName("np")[0] != null){
                                    var provincia = response.getElementsByTagName("np")[0].childNodes[0].nodeValue;
                                    var municipio = response.getElementsByTagName("nm")[0].childNodes[0].nodeValue;
                                    var zona = response.getElementsByTagName("npa")[0].childNodes[0].nodeValue;
                                    var poligono = response.getElementsByTagName("cpo")[0].childNodes[0].nodeValue;
                                    var parcela = response.getElementsByTagName("cpa")[0].childNodes[0].nodeValue;
                                    var uso = response.getElementsByTagName("luso")[0].childNodes[0].nodeValue;
                                    document.getElementById("ref_catastral").value = rc;
                                    document.getElementById("ref_catastral").style.backgroundColor = "#F6F6F6";
                                    document.getElementById("provincia").value = provincia;
                                    document.getElementById("provincia").style.backgroundColor = "#F6F6F6";
                                    document.getElementById("municipio").value = municipio;
                                    document.getElementById("municipio").style.backgroundColor = "#F6F6F6";
                                    document.getElementById("zona").value = zona;
                                    document.getElementById("zona").style.backgroundColor = "#F6F6F6";
                                    document.getElementById("poligono").value = poligono;
                                    document.getElementById("poligono").style.backgroundColor = "#F6F6F6";
                                    document.getElementById("parcela").value = parcela;
                                    document.getElementById("parcela").style.backgroundColor = "#F6F6F6";
                                    document.getElementById("uso").value = uso;
                                    document.getElementById("uso").style.backgroundColor = "#F6F6F6";
                                }
                                else{
                                    alert('DATOS NO DESCARGADOS\n\nNo se han obtenido datos del Catastro con esa Ref Catastral\nSi la Referencia Catastral introducida es correcta,\npor favor, contacte con un administrador.');
                                }
                            
                            },
                            

                        });
                  }
       
        }


       

                       
       }
    }

</script>