$(document).ready(
function (){
    /*Evento click al seleccionar un usuario */
    $("#AsigUsuario").change(function(){
        muestraBaja();
        validar();
    }); 
    $("#asigEqCel").change(function(){
        descripcionCel();
    });  
    /*Add formulario */
    $("#btnAsigCel").click(function(){
        Agregar();
    });   
    /*ver tabla reporte Todos */
    $("#generaAsigCelTod").click(function(){
        if(ocultaReporte()==true){
            reporteTodosVer();
            banderReporte++;
        }
    });  
    /*ver tabla reporte Periodo */
    $("#generaAsigCelPer").click(function(){
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
        $("#tablaReporteAsigCel").remove();
        banderReporte=1;
        return false;
    }else{return true;}
}
 
/*Valida si el usuario tiene asignado equipo */
function validar(){
    if($("#AsigUsuario").val()==0){
        inhabilitaBoton('btnAsigCel');
    }else{
    var userID=$("#AsigUsuario").val();
    var datos={Id_usuario:userID};
    $.ajax({
        type: "POST",
        async: false,
        data: datos,
        url: "asignaCel/procesoObtener.php",
        success: function(r) {
            //console.log("tabla :" + r);
            if (r == 0) {
                $("#btnAsigCel").css("display","inline");
                $("#btnAsigCel").removeClass("btn btn-primary btn-sm");
                $("#btnAsigCel").attr("class","btn btn-success btn-sm");
                $("#AsigIdUsuario").val(0);
                $("#btnAsigCel").html("Agregar");
                $("#asigEqCel").val(0);
                $('#asigDescripcion').empty();
                $("input:radio[name=Estatus][value='Activo']").prop("checked",true); //Por default es activo
                validaEstatus();
            } else {
                var array=JSON.parse(r);
                $("#btnAsigCel").css("display","inline");
                $("#btnAsigCel").removeClass("btn btn-success btn-sm");
                $("#btnAsigCel").attr("class","btn btn-primary btn-sm");
                $("#btnAsigCel").html("Actualizar");
                $("#asigEqCel").val(array['Id_celular']);
                $("input:radio[name=Estatus][value='"+array['Estatus']+"']").prop("checked",true);
                $("#AsigIdUsuario").val(array['Id_empleado']);
                descripcionCel();
                validaEstatus();
            }
        }
    });
}
}

/*funcion para sacar la descripcion del equipo celular */
function descripcionCel(){
var idEqCel=$("#asigEqCel").val();
var datosDesc={Id_celular:idEqCel};

$.ajax({
    type: "POST",
    async: false,
    data: datosDesc,
    url: "asignaCel/procesoObtener.php",
    success: function(r) {
        //console.log("tabla :" + r);
        if (r == 0) {
            alertify.error("Error :"+r);
        } else {
           // console.log(r);
            var array=JSON.parse(r);
          //  console.log("data :" , r);
            $('#asigDescripcion').empty();
            $.each(array, function(key, registro) {
              $("#asigDescripcion").append('Modelo: ' + registro.NombreModelo + ' Color: ' + registro.Color+' Accesorios: '+registro.Accesorio);
            });
            $("#asigEqCel").removeAttr("style");
            $("#asigEqCel").removeAttr("style");
            
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
      if($("#asigEqCel").val()==0){
        $("#asigEqCel").css("box-shadow","0 0 5px rgba(255,0,0,1)");
        $("#asigEqCel").css("border","1px solid rgba(255,0,0,0.8)");
        $("#asigEqCel").focus();
        return false;
    }

var formulario = $('#frmAsignaCel').serialize();
var idUser=$("#AsigIdUsuario").val();
var AsigCelEstatus=$('input:radio[name=Estatus]:checked').val();
var AsigURL="";

if(AsigCelEstatus=='Baja'){
    var frmMotivoBaja=$("#frmMotivoBaja").serialize();
    formulario=formulario+"&"+frmMotivoBaja;  // especifica el motivo de la baja
    AsigURL="asignaCel/procesoBaja.php"
}
if(idUser==0 & AsigCelEstatus!='Baja'){
    AsigURL="asignaCel/procesoAgrega.php"
}else if(AsigCelEstatus!='Baja'){
    AsigURL='asignaCel/procesoActualiza.php';
}
$.ajax({
    type: "POST",
    async: false,
    data: formulario,
    url: AsigURL,
    success: function(r) {
      //  console.log("res :" + r);
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
    $("#reporteAsigCel").load("asignaCel/reporteTabla.php");
}
/*funcion para visualizar reporte por periodos */
function reportePeriodosVer(){
    var fechaInicio=$("#fechaAsigInicio").val();
    var fechaFin=$("#fechaAsigFin").val();
    if((fechaInicio==null || fechaInicio=='')|(fechaFin==null || fechaFin=='')){
        alertify.error("Especifica un periodo de tiempo ");
    }else{
        $("#reporteAsigCel").load("asignaCel/reporteTabla.php?fechaAsigInicio="+fechaInicio+"&fechaAsigFin="+fechaFin);
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