
function validaFormulario(IDformulario){
$("#"+IDformulario).validate({
    errorClass: 'alert-danger', 
    rules: {
        Serie:{required:true },
        IMEI:{required:true,digits: true },
        Modelo:{required:true },
        Color:{required:true },
        Cargador:{required:true },
        Equipo_anterior:{required:true },
        Descripcion:{required:false }, 
        EstatusU:{required:true},
        NumTel: {
        required: true,
        minlength: 10,
        maxlength:12,
        digits: true 
      },
    }, 
    messages: { 
        Serie:{required: "Este campo es obligatorio"},
        IMEI:{
          required: "Este campo es obligatorio",
         digits:"Solo numero"},

        Modelo:{required: "Este campo es obligatorio"},
        Color:{required: "Este campo es obligatorio"},
        Cargador:{required: "Este campo es obligatorio"},
        Equipo_anterior:{required: "Este campo es obligatorio"},
        EstatusU:{required:"Selecciona una opción"},
        NumTel:{required: "Este campo es obligatorio",
        minlength: jQuery.validator.format("Minimo {0} caracteres requeridos"),
        maxlength: jQuery.validator.format("Maximo {0} caracteres requeridos"),
        digits: "Solo numeros"
      }
    }
  });
}
  

    
  
