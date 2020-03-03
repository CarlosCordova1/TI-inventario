
function validaFormularioLinea(IDformulario){
$("#"+IDformulario).validate({
    errorClass: 'alert-danger', 
    rules: {
      Telefono:{required:true, digits: true, maxlength:10,minlength:10 },
      //Contrato:{required:true },
      Sim:{required:true },
      Compania:{required:true },
      Fecha_recepcion:{required:true },
      Descripcion_L:{required: true},
      //Fin_plazo_forzoso:{required:true }
      },
      messages: {
      Telefono:{
        required: "Este campo es obligatorio ",  
        digits:"Solo numero",
        minlength: jQuery.validator.format("Minimo {0} caracteres requeridos"),
        maxlength: jQuery.validator.format("Maximo {0} caracteres requeridos")},
      //Contrato:{required: "Este campo es obligatorio"},
      Sim:{required: "Este campo es obligatorio"},
      Compania:{required: "Este campo es obligatorio"},
      Fecha_recepcion:{required: "Este campo es obligatorio"},
      //Fin_plazo_forzoso:{required: "Este campo es obligatorio"},  
      Descripcion_L:{required: "Este campo es obligatorio"},     
      }
    });
}

  

    
  
