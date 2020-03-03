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
    <title>IT inventario-Radio</title>

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
                                Radio
                            </div>
                            <div class="card-body  ">
                                <span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
                                    Agregar nuevo<span class="fa fa-plus-circle"></span>
                                </span>
                                <hr>
                                <div id="dataTableRadio"></div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo radio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div id="idAgregaRadio">
                                <form id="agregaRadio">
                                    <div class="col-sm-6">
                                        <label>Num.Radio</label>
                                        <input type="text" required placeholder="0001" value="" class="form-control input-sm" name="Num_radio">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Num.serie</label>
                                        <input type="text" required placeholder="A000000D000F001" value="" class="form-control input-sm" name="Num_serie">
                                    </div>

                                   

                                    <!--Modelo // pediente-->
                                    <div class="col-sm-6">
                                        <label>Nombre_Radio</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = " SELECT Id_modelo, NombreRadio from modelo;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <select class="form-control input-sm" name="NombreRadio">
                                            <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?php echo $mostrar['Id_modelo'] ?>"><?php echo $mostrar['NombreRadio'] ?></option>
                                            <?php
                                            } 
                                            ?>
                                        </select>
                                    </div>


                                    <div class="col-sm-6">
                                        <label>Num.sap</label>
                                        <input type="text" required placeholder="Número de sap" value="" class="form-control input-sm" name="Num_sap">
                                    </div>

                                    <!--Estado -->
                                    <div class="col-sm-6">
                                        <label>Estado</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = " SELECT  Id_estado, Estado_r from estado;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <select class="form-control input-sm" name="Estado_r">
                                            <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?php echo $mostrar['Id_estado'] ?>"><?php echo $mostrar['Estado_r'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Fecha</label>
                                        <input type="date" min="" max="" required placeholder="Fecha" value="" class="form-control input-sm" name="Fecha_inicio">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Fecha de proximo mantenimiento</label>
                                        <input type="date" min="" max="" required placeholder="Fecha de proximo mantenimiento" value="" class="form-control input-sm" name="Fecha_final">
                                    </div>

                                    <div class="col-sm-12">
                                        <label>Descripcion</label>
                                        <textarea type="text" required placeholder="Descripcion" value="" class="form-control input-sm" name="Descripcion"></textarea>
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
            </div>

            <!-- Modal actualizar radio. -->
            <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar el informe del radio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                        </div>
                        <div class="modal-body">
                            <form id="formActualizaRadio">
                                <input type="hidden" id="Id_radio" name="Id_radio">

                                <div class="col-sm-6">
                                    <label>Num.Radio</label>
                                    <input id="Num_radio" type="text" required placeholder="0001" value="" class="form-control input-sm" name="Num_radio">
                                </div>

                                <div class="col-sm-6">
                                    <label>Num.serie</label>
                                    <input id="Num_serie" type="text" required placeholder="A000000D000F001" value="" class="form-control input-sm" name="Num_serie">
                                </div>

                               
                                <!--Modelo // pediente-->
                                <div class="col-sm-6">
                                    <label>Modelo</label>
                                    <?php
                                    require_once "tabla/clases/conexion.php";
                                    $obj = new conectar();
                                    $conexion = $obj->conexion();
                                    $sql = " SELECT Id_modelo, NombreRadio from modelo;";
                                    $result = mysqli_query($conexion, $sql);
                                    ?>
                                    <select id="NombreRadio" class="form-control input-sm" name="NombreRadio">
                                        <?php
                                        while ($mostrar = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $mostrar['Id_modelo'] ?>"><?php echo $mostrar['NombreRadio'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label>Num.sap</label>
                                    <input id="Num_sap" type="text" required placeholder="Número de sap" value="" class="form-control input-sm" name="Num_sap">
                                </div>


                                <!--Estado -->
                                <div class="col-sm-6">
                                    <label>Estado</label>
                                    <?php
                                    require_once "tabla/clases/conexion.php";
                                    $obj = new conectar();
                                    $conexion = $obj->conexion();
                                    $sql = " SELECT  Id_estado, Estado_r from estado;";
                                    $result = mysqli_query($conexion, $sql);
                                    ?>
                                    <select id="Estado_r" class="form-control input-sm" name="Estado_r">
                                        <?php
                                        while ($mostrar = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $mostrar['Id_estado'] ?>"><?php echo $mostrar['Estado_r'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label>Fecha </label>
                                    <input id="Fecha_inicio" type="date" min="" max="" required placeholder="Fecha " value="" class="form-control input-sm" name="Fecha_inicio">
                                </div>

                                <div class="col-sm-6">
                                    <label>Fecha de proximo mantenimiento</label>
                                    <input id="Fecha_final" type="date" min="" max="" required placeholder="Fecha de proximo mantenimiento" value="" class="form-control input-sm" name="Fecha_final">
                                </div>

                                <div class="col-sm-12">
                                    <label>Descripcion</label>
                                    <textarea id="Descripcion" type="text" required placeholder="Descripcion" value="" class="form-control input-sm" name="Descripcion"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar</button>
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
                datos = $('#agregaRadio').serialize();
                validaFormualarioRadio('agregaRadio');
                let validaF = $("#agregaRadio"). valid();
                //console.log(datos);
                /* Agregar nuevo registro */
                if(validaF ==true){
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "radio/procesoAgrega.php",
                    success: function(r) {
                        console.log("devuelve->" + r);
                        if (r == 1) {
                            $('#agregaRadio')[0].reset();
                            $('#dataTableRadio').load('radio/radioTabla.php');
                            alertify.success("Agregado con exito :D");
                        } else {
                            alertify.error("Fallo al agregar :(" + r);
                        }
                    }
                });
              } 
            }); 
 
            /* Actualizar los registros // modificaciones */
            $('#btnActualizar').click(function() {
                datos = $('#formActualizaRadio').serialize();
                validaFormualarioRadio('formActualizaRadio');
                let validaFormA = $("#formActualizaRadio").valid();
                if (validaFormA == true) {
            $.ajax({
              type: "POST", 
              data: datos,
              url: "radio/procesoActualiza.php",
              success: function(r) {
               console.log("actuliza: " + r);
                if (r == 1) { 
                  $('#dataTableRadio').load('radio/radioTabla.php');
                  alertify.success("Actualizado con exito :D");
                } else {
                  alertify.error("Fallo al actualizar :(");
                }
              }
            });
          }
        });
      });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTableRadio').load('../radio/radiotabla.php');
        });
    </script>
    
<script type="text/javascript">
$(document).ready(function (){
    $('#dataTableRadio').load('../radio/radiotabla.php');
});
</script>

    <script type="text/javascript">
        function agregaFrmActualizar(Id_radio) {
            
            $.ajax({
                type: "POST",
                data: "Id_radio=" + Id_radio,
                url: "radio/procesoObtener.php",
                success: function(r) {
                    //console.log("obtiene: -->"+r);
                    datos = jQuery.parseJSON(r);
                    $('#Id_radio').val(datos['Id_radio']);
                    $('#Num_radio').val(datos['Num_radio']);
                    $('#Num_serie').val(datos['Num_serie']);
                    $('#Num_sap').val(datos['Num_sap']);
                    $('#Fecha_inicio').val(datos['Fecha_inicio']);
                    $('#Fecha_final').val(datos['Fecha_final']);
                    $('#Descripcion').val(datos['Descripcion']);
                    $('#NombreRadio').val(datos['Id_modelo']);
                    $('#Estado_r').val(datos['Id_estado']);
                }
            });
        }
        /* Eliminar un registro */
        function eliminarDatos(Idradio) {
            alertify.confirm('Eliminar una radio', '¿Seguro de eliminar una radio :(?', function() {
                $.ajax({
                    type: "POST",
                    data: "Id_radio=" + Idradio,
                    url: "radio/procesoElimina.php",
                    success: function(r) {

                        if (r == 1) {
                            $('#dataTableRadio').load('radio/radioTabla.php');
                            alertify.success("Eliminado con exito !");
                        } else {
                            alertify.error("No se pudo eliminar..." + r);
                        }
                    }
                });

            }, function() {});
        }
    </script>
    <!-- -->
    <?php include 'script_body.php'; ?>
</body>

</html>