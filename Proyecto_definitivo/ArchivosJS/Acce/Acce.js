function validaFormualarioAcce(IDformulario){
    $("#"+IDformulario).validate({ 
        errorClass: 'alert-danger', 
        rules: { 
            Modelo:{required:true },
            Num_serie:{required:true },
            Marca:{required:true },
            Num_sap :{required:true, digits: true }, //solo numeros
            Estado:{required:true },
            Descripcion:{required:true },
        },
        messages: {
            Modelo:{required:"Este campo es obligatorio" },               
            Num_serie:{required:"Este campo es obligatorio" },
            Marca:{required:"Este campo es obligatorio" },
            Num_sap :{required:"Este campo es obligatorio",
            digits:"Solo numero" },                            //solo numeros
            Estado:{required:"Este campo es obligatorio" },
            Descripcion:{required:"Este campo es obligatorio" },
    }
  });
}
  

    
  