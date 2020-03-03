function validaFormularioSim(IDformulario){
    $("#"+IDformulario).validate({ 
        errorClass: 'alert-danger', 
        rules: {
            Sim :{required:true, digits: true}, //solo numeros         
            Estado:{required:true },
            Descripcion:{required:true },
        },
        messages: {
            Sim :{required:"Este campo es obligatorio",
            digits:"Solo numero" },                            //solo numeros 
            Estado:{required:"Este campo es obligatorio" },
            Descripcion:{required:"Este campo es obligatorio" },
    }
  });
}
  

     
  