function validaFormualarioRadio(IDformulario){
    $("#"+IDformulario).validate({ 
        errorClass: 'alert-danger', 
        rules: {
            Num_radio :{required:true, digits: true}, //solo numeros
            Num_serie:{required:true },
            Marca:{required:true },
            Num_sap :{required:true, digits: true }, //solo numeros
            Modelo_r:{required:true },
            Estado_r:{required:true },
            Fecha_inicio:{required:true },
            Fecha_final:{required:true },
            Descripcion:{required:true },
        },
        messages: {
            Num_radio :{required:"Este campo es obligatorio",
            digits:"Solo numero" },                            //solo numeros
            Num_serie:{required:"Este campo es obligatorio" },
            Marca:{required:"Este campo es obligatorio" },
            Num_sap :{required:"Este campo es obligatorio",
            digits:"Solo numero" },                            //solo numeros
            Modelo_r:{required:"Este campo es obligatorio" }, 
            Estado_r:{required:"Este campo es obligatorio" },
            Fecha_inicio:{required:"Este campo es obligatorio" },
            Fecha_final:{required:"Este campo es obligatorio" },
            Descripcion:{required:"Este campo es obligatorio" },
    }
  });
}
  

    
  