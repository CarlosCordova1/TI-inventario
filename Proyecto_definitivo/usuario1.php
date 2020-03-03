<!DOCTYPE html> 
<html lang="en">
<head>
    <?php require_once "scripts.php"; ?>
    <style>
        .city {
            display: none
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>IT inventario-Usuario1</title>

    <!-- Favicons -->
    <link href="img/aguakan.png" rel="icon">
    <!-- Bootstrap core CSS -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/lib/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">
    <script src="/lib/chart-master/Chart.js"></script>
</head>
<?php
require('Menu/menu.php');
?>


<body>
    <!-- Modal-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="width: auto; height: auto;">
                            <div class="card-header">
                                Usuario 
                            </div>
                            <div class="card-body  ">
                                <span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
                                    Agregar nuevo<span class="fa fa-plus-circle"></span>
                                </span>
                                <hr>
                                <div id="dataTableUsuario"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            <!-- Modal agregar nuevo radio-->
            <div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agrega nuevo usuario </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                        <div id="idAgregaUsuario">
                                <form id="agregaUsuario">
                                    <div class="col-sm-6">
                                        <label>Num.Empleado</label>
                                        <input onkeyup="ValidNumEmpleado(this.value,'Usuario_rAlt')" id="Num_empleadoAlt" type="text" required placeholder="0001" value="" class="form-control input-sm" name="Num_empleado">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Nombre completo del responsable </label>
                                        <input id="Usuario_rAlt" type="text" required placeholder=" Jeronimo Burgos Toledo" value="" class="form-control input-sm" name="Usuario_r">
                                    </div>

                                    <div class="col-sm-6">
                                    <label>Gerencia</label>
                                    <input type="text" required placeholder="Gerencia" value="" class="form-control input-sm" name="Gerencia">
                                </div>

                                <div class="col-sm-6">
                                    <label>Puesto</label>
                                    <input type="text" required placeholder="Puesto" value="" class="form-control input-sm" name="Puesto">
                                </div>

                                    <div class="col-sm-6">
                                        <label>Zona</label>
                                        <input type="text" required placeholder="Zona" value="" class="form-control input-sm" name="Zona">
                                    </div>
  
                                    <div class="col-sm-6">
                                        <label>Ubicacion </label>
                                        <input type="text" required placeholder="Ubicacion" value="" class="form-control input-sm" name="Ubicacion">
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar </button>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Modal actualizar radio. -->
            <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar informe de usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                        </div>
                        <div class="modal-body">
                            <form id="formActualizaUsuario">
                                <input type="hidden" id="Id_usuario" name="Id_usuario">

                                <div class="col-sm-6">
                                        <label>Num.Empleado</label>
                                        <input  onkeyup="ValidNumEmpleado(this.value,'Usuario_r')" id="Num_empleado" type="text" required placeholder="0001" value="" class="form-control input-sm" name="Num_empleado">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Nombre completo del responsable </label>
                                        <input id="Usuario_r" type="text" required placeholder=" Jeronimo Burgos Toledo" value="" class="form-control input-sm" name="Usuario_r">
                                    </div>

                                 
                                    <div class="col-sm-6">
                                    <label>Gerencia</label>
                                    <input id="Gerencia" type="text" required placeholder="Gerencia" value="" class="form-control input-sm" name="Gerencia">
                                </div>

                                <div class="col-sm-6">
                                    <label>Puesto</label>
                                    <input id="Puesto" type="text" required placeholder="Puesto" value="" class="form-control input-sm" name="Puesto">
                                </div>

                                    <div class="col-sm-6">
                                        <label>Zona</label>
                                        <input id="Zona" type="text" required placeholder="Zona" value="" class="form-control input-sm" name="Zona">
                                    </div>
  
                                    <div class="col-sm-6">
                                        <label>Ubicacion </label>
                                        <input id="Ubicacion" type="text" required placeholder="Ubicacion" value="" class="form-control input-sm" name="Ubicacion">
                                    </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>


    <script src="tabla/librerias/codeEditUser/autoComplete.js"></script>
    <!-- -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnAgregarnuevo').click(function() {
                datos = $('#agregaUsuario').serialize();
                //console.log(datos);
                /* Agregar nuevo registro */ 
               
                $.ajax({
                    type: "POST", 
                    data: datos,
                    url: "usuario/procesoAgrega.php",
                    success: function(r) {
                        console.log("devuelve->" + r);
                        if (r == 1) {
                            $('#agregaUsuario')[0].reset();
                            $('#dataTableUsuario').load('usuario/usuarioTabla.php');
                            alertify.success("Agregado con exito :D");
                        } else {
                            alertify.error("Fallo al agregar :(" + r);
                        }
                    }
                });
               
            }); 
 
            /* Actualizar los registros // modificaciones */
            $('#btnActualizar').click(function() {
                datos = $('#formActualizaUsuario').serialize();
            $.ajax({
              type: "POST",
              data: datos,
              url: "usuario/procesoActualiza.php",
              success: function(r) { 
               console.log("actuliza: " + r);
                if (r == 1) { 
                  $('#dataTableUsuario').load('usuario/usuarioTabla.php');
                  alertify.success("Actualizado con exito :D");
                } else {
                  alertify.error("Fallo al actualizar :(");
                }
              }
            }); 
          
        });
      });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTableUsuario').load('../usuario/usuarioTabla.php');
        });
    </script>
    
<script type="text/javascript">
$(document).ready(function (){
    $('#dataTableUsuario').load('../usuario/usuarioTabla.php');
}); 
</script> 

    <script type="text/javascript">
        function agregaFrmActualizar(Id_usuario) {
            
            $.ajax({
                type: "POST",
                data: "Id_usuario=" + Id_usuario,
                url: "usuario/procesoObtener.php",
                success: function(r) {
                    //console.log("obtiene: -->"+r); 
                    datos = jQuery.parseJSON(r);
                    $('#Id_usuario').val(datos['Id_usuario']);
                    $('#Num_empleado').val(datos['Num_empleado']);
                    $('#Usuario_r').val(datos['Usuario_r']);
                    $('#Gerencia').val(datos['Gerencia']);
                    $('#Puesto').val(datos['Puesto']);
                    $('#Zona').val(datos['Zona']);
                    $('#Ubicacion').val(datos['Ubicacion']);
                }
            });
        }
        /* Eliminar un registro */
        function eliminarDatos(Idusuario) {
            alertify.confirm('Eliminar un usuario', '¿Seguro de eliminar un usuario :(?', function() {
                $.ajax({
                    type: "POST",
                    data: "Id_usuario=" + Idusuario,
                    url: "usuario/procesoElimina.php", 
                    success: function(r) {

                        if (r == 1) {
                            $('#dataTableUsuario').load('usuario/usuarioTabla.php');
                            alertify.success("Eliminado con exito !");
                        } else {
                            alertify.error("No se pudo eliminar..." + r);
                        }
                    }
                });

            }, function() {});
        }
        // validar user
        function ValidNumEmpleado(NumEmpl,tagActualiza){
            $.ajax({
                    type: "POST",
                    data: "Id_usuario="+NumEmpl,
                    url: "usuario/procesoConsulta.php", 
                    success: function(r) {
                       // console.log("-->"+r);
                        $datos=JSON.parse(r);
                            $('#'+tagActualiza).val($datos.valor);
                    }
                });
        }
    </script>
    <!-- -->
    <?php include 'script_body.php'; ?>
</body>

</html>