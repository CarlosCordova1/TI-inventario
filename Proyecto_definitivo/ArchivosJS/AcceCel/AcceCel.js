function validaFormualarioAcceCel(IDformulario){
    $("#"+IDformulario).validate({ 
        errorClass: 'alert-danger', 
        rules: {
            
            Accesorio:{required:true }, 
            Descripcion:{required:true },
        },
        messages: {
           
            Accesorio :{required:"Este campo es obligatorio"  },
            Descripcion :{required:"Este campo es obligatorio"  },
    }
  });
}
   

    
  