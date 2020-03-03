$(document).ready(
function (){
    /*Evento click al seleccionar un usuario */
    $("#AsigUsuarioRad").change(function(){
        muestraBaja();
        validar();
    }); 
    /*evento cambia select equipos de radio */
    $("#asigEqRad").change(function(){
        descripcionRad();
    });  
    /*Add formulario */
    $("#btnAsigRad").click(function(){
        Agregar();
    });   
    /*ver tabla reporte Todos */
    $("#generaAsigRadTod").click(function(){
        if(ocultaReporte()==true){
        reporteTodosVer();
        banderReporte++;
        }
    });  
    /*ver tabla reporte Periodo */
    $("#generaAsigRadPer").click(function(){
        if(ocultaReporte()==true){
        reportePeriodosVer();
        banderReporte++;
        }
    });
    /*Eventos para la función de Motivos de baja de asignación */
    $("#MotivoBajaContinuar").click(function(){
        validaMotivoBaja();
    });
    // validar si se continua o se cancela la baja
    $("#MotivoBajaModal").on("hidden.bs.modal", function () {
        if(banderaMotivoBaja==false){
            validar();// unicamente cuando no se haya sellecionado continuar
        }
    });
    // limpiar la bandera y formulario para una nueva peticion
    $("input:radio[name=Estatus][value='Baja']").click(function(){
        banderaMotivoBaja=false;
        resetFormMotivoBaja();
    });

}
);

// validacion oculta reporte doble clic
var banderReporte=1;
function ocultaReporte(){
    if(banderReporte==2){
        $("#tablaReporteAsigRad").remove();
        banderReporte=1;
        return false;
    }else{return true;}
}
 
/*Valida si el usuario tiene asignado equipo */
function validar(){
    if($("#AsigUsuarioRad").val()==0){
        inhabilitaBoton('btnAsigRad');
    }else{
    var userID=$("#AsigUsuarioRad").val();
    var datos={Id_usuario:userID};
    $.ajax({
        type: "POST",
        async: false,
        data: datos,
        url: "asignaRadio/procesoObtener.php",
        success: function(r) {
            //console.log("tabla :" + r);
            if (r == 0) {
                $("#btnAsigRad").css("display","inline");
                $("#btnAsigRad").removeClass("btn btn-primary btn-sm");
                $("#btnAsigRad").attr("class","btn btn-success btn-sm");
                $("#AsigIdUsuario").val(0);
                $("#btnAsigRad").html("Agregar");
                $("#asigEqRad").val(0);
                $('#asigDescripcion').empty();
                $("input:radio[name=Estatus][value='Activo']").prop("checked",true); //Por default es activo
                validaEstatus();
            } else {
                var array=JSON.parse(r);
                $("#btnAsigRad").css("display","inline");
                $("#btnAsigRad").removeClass("btn btn-success btn-sm");
                $("#btnAsigRad").attr("class","btn btn-primary btn-sm");
                $("#btnAsigRad").html("Actualizar");
                $("#asigEqRad").val(array['Id_radio']);
                $("input:radio[name=Estatus][value='"+array['Estatus']+"']").prop("checked",true);
                $("#AsigIdUsuario").val(array['Id_usuario']);  // para editar, campo invisible
                descripcionRad();
                validaEstatus();
            }
        }
    });
}
}

/*funcion para sacar la descripcion del equipo radio */
function descripcionRad(){
var idEqRad=$("#asigEqRad").val();
var datosDesc={Id_radio:idEqRad};

$.ajax({
    type: "POST",
    async: false,
    data: datosDesc,
    url: "asignaRadio/procesoObtener.php",
    success: function(r) {
        //console.log("tabla :" + r);
        if (r == 0) {
            alertify.error("Error :"+r);
        } else {
          //  console.log("--> "+r);
            var array=JSON.parse(r);
          //  console.log("data :" , r);
            $('#asigDescripcion').empty();
            $.each(array, function(key, registro) {
              $("#asigDescripcion").append('Núm. Radio: '+registro.Num_radio+' Modelo: ' + registro.Modelo_r +
               ' Marca: ' + registro.Marca+' Descripción: '+registro.Descripcion);
            });
            $("#asigEqRad").removeAttr("style");
            $("#asigEqRad").removeAttr("style");
        }
    }
});
}
/*Para validar el estatus de baja .- solo aplica a usuarios con equipo asignado */
function validaEstatus(){
    if($("#AsigIdUsuario").val()==0){
     $("input:radio[name=Estatus][value='Baja']").css("display","none");
     $("#EstatusBaja").css("display","none");
    }else{
     $("input:radio[name=Estatus][value='Baja']").css("display","inline");
     $("#EstatusBaja").css("display","inline");
    }
}

/*Funcion Agregar */
function Agregar(){
    // valida si hay sellecionado un equipo
    if($("#asigEqRad").val()==0){
        $("#asigEqRad").css("box-shadow","0 0 5px rgba(255,0,0,1)");
        $("#asigEqRad").css("border","1px solid rgba(255,0,0,0.8)");
        $("#asigEqRad").focus();
        return false;
    }
var formulario = $('#frmAsignaRad').serialize();
var idUser=$("#AsigIdUsuario").val();
var AsigRadEstatus=$('input:radio[name=Estatus]:checked').val();
var AsigURL="";
if(AsigRadEstatus=='Baja'){
    var frmMotivoBaja=$("#frmMotivoBaja").serialize();
    formulario=formulario+"&"+frmMotivoBaja;  // especifica el motivo de la baja
        AsigURL="asignaRadio/procesoBaja.php";
}
if(idUser==0 & AsigRadEstatus!='Baja'){
    AsigURL="asignaRadio/procesoAgrega.php";
}else if(AsigRadEstatus!='Baja'){
    AsigURL='asignaRadio/procesoActualiza.php';
}
$.ajax({
    type: "POST",
    async: false,
    data: formulario,
    url: AsigURL,
    success: function(r) {
        console.log("res :" + r);
        if (r == 1) {
            alertify.success("Asignación exitosa... :)");
            validar();
        } else {
            alertify.error("Error ;)"+r);
        }
    }
});
}
/*funcion para visualiza reporte de todos */
function reporteTodosVer(){
    //cargar la tabla con la informacion
    $("#reporteAsigRad").load("asignaRadio/reporteTabla.php");
}
/*funcion para visualizar reporte por periodos */
function reportePeriodosVer(){
    var fechaInicio=$("#fechaAsigInicio").val();
    var fechaFin=$("#fechaAsigFin").val();
    if((fechaInicio==null || fechaInicio=='')|(fechaFin==null || fechaFin=='')){
        alertify.error("Especifica un periodo de tiempo ");
    }else{
        $("#reporteAsigRad").load("asignaRadio/reporteTabla.php?fechaAsigInicio="+fechaInicio+"&fechaAsigFin="+fechaFin);
    }

}

/*funcion para inahabilitar un boton */
function inhabilitaBoton(tag){
    $("#"+tag).css("display","none");
}

//codigo para motivo de baja

/*Validar que se seleccionó un motivo de la baja*/
var banderaMotivoBaja=false;
function validaMotivoBaja(){
    banderaMotivoBaja=false;
    var MotivoBajaValor=$('input:radio[name=MotivoBaja]:checked').val();
    if(MotivoBajaValor=='' || MotivoBajaValor==null){
        alert("Selecciona un motivo de la baja");
   }else{
    banderaMotivoBaja=true;
    document.getElementById('MotivoBajaCancelar').click();
   }
}

function resetFormMotivoBaja(){
    $("#frmMotivoBaja")[0].reset();
}

function muestraBaja(){
    $("input:radio[name=Estatus][value='Baja']").css("display","inline");
    $("#EstatusBaja").css("display","inline");
}