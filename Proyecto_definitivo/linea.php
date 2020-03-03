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
    <title>IT inventario-Linea</title>

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
								Linea
							</div>
                <div class="card-body  ">
                  <span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
                    Agregar nuevo <span class="fa fa-plus-circle"></span>
                  </span>
                  <hr>
                  <div id="dataTableInflinea"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal agregar nuevo linea-->
        <div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega una nueva linea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div id="idAgregaInflinea">
                  <form id="agregaInflinea">

                    <div class="col-sm-6">
                      <label>Num.Telefono</label>
                      <input type="text" minlength="10" maxlength="12" required placeholder="Telefono" value="" class="form-control input-sm" name="Telefono">
                    </div>

                    
                    <div class="col-sm-6">
                      <label>Contrato</label>
                      <input type="text"  placeholder="Contrato" value="" class="form-control input-sm" name="Contrato">
                    </div>

                   <!--Sim -->
                   <div class="col-sm-6">
                      <label>Sim</label> 
                      <?php
                      require_once "tabla/clases/conexion.php";
                      $obj = new conectar();
                      $conexion = $obj->conexion();
                      $sql = " SELECT Id_Sim,Sim from sim s where s.Id_Sim not in (SELECT Id_Sim from inf_linea); ";
                      $result = mysqli_query($conexion, $sql);
                      ?>
                      <select id="Sim" class="form-control input-sm" name="Sim">
                        <?php
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                          <option value="<?php echo $mostrar['Id_Sim'] ?>"><?php echo $mostrar['Sim'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>

                      <!--compañia -->
                      <div class="col-sm-6">
                      <label>Compañia</label>
                      <?php
                      require_once "tabla/clases/conexion.php";
                      $obj = new conectar();
                      $conexion = $obj->conexion();
                      $sql = " SELECT  Id_Compania, Compania from compania;";
                      $result = mysqli_query($conexion, $sql);
                      ?>
                      <select class="form-control input-sm" name="Compania">
                        <?php
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                          <option value="<?php echo $mostrar['Id_Compania'] ?>"><?php echo $mostrar['Compania'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
      
      
                    <div class="col-sm-6">
                      <label>Fecha de recepción</label>
                      <input type="date" min="" max="" required placeholder="Fecha de recepción" value="" class="form-control input-sm" name="Fecha_recepcion">
                    </div>
                    

                    <div class="col-sm-6">
                      <label>Fin de plazo forzoso</label>
                      <input type="date" min="" max=""  placeholder="Fin de plazo" value="" class="form-control input-sm" name="Fin_plazo_forzoso">
                    </div>
                  
                    <div class="col-sm-6">
									<label> Estado de la linea: </label>
									<div class="col-sm-6">
										<input id="Estado" type="radio" name="Estado" value="Activo" /> Activo
									</div>
									<div class="col-sm-6">
										<input id="Estado" type="radio" name="Estado" value="Inactivo" /> Inactivo
									</div>
                </div>
                
                <div class="col-sm-6">
			          <label>Descripción</label>
			          <textarea  type="text" required placeholder="Descripcion" value= "" class="form-control input-sm"  name="Descripcion_L"></textarea>
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
       


        <!-- Modal actualizar linea. -->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar els informe de linea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formActualizaInflinea">
                  <input type="hidden" id="Id_linea" name="Id_linea">
                  <div class="col-sm-6">
                    <label>Num.Telefono</label>
                    <input id="TelefonoU" type="text" required placeholder="Telefono" value="" class="form-control input-sm" name="Telefono">
                  </div>
                  

                  <div class="col-sm-6">
                    <label>Contrato</label>
                    <input id="ContratoU" type="text" required placeholder="Contrato" value="" class="form-control input-sm" name="Contrato">
                  </div>
                  


                  <!--Sim -->
                  <div class="col-sm-6">
                    <label>Sim</label>
                    <select id="SimU" class="form-control input-sm" name="Sim">
                      <!-- Se llena en automatico desde el js-->
                    </select>
                  </div>
              

                  <!--compañia -->
                  <div class="col-sm-6">
                    <label>Compañia</label>
                    <?php
                    require_once "tabla/clases/conexion.php";
                    $obj = new conectar();
                    $conexion = $obj->conexion();
                    $sql = " SELECT  Id_Compania, Compania from compania;";
                    $result = mysqli_query($conexion, $sql);
                    ?>
                    <select id="CompaniaU" class="form-control input-sm" name="Compania">
                      <?php
                      while ($mostrar = mysqli_fetch_array($result)) {
                      ?>
                        <option value="<?php echo $mostrar['Id_Compania'] ?>"><?php echo $mostrar['Compania'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  

                  <div class="col-sm-6">
                    <label>Fecha de recepción</label>
                    <input type="date" min="" max="" id="Fecha_recepcionU" type="text" required placeholder="Fecha de recepción" value="" class="form-control input-sm" name="Fecha_recepcion">
                  </div>
                  

                  <div class="col-sm-6">
                    <label>Fin de plazo forzoso</label>
                    <input type="date" min="" max="" id="Fin_plazo_forzosoU" type="text" placeholder="Fin de plazo" value="" class="form-control input-sm" name="Fin_plazo_forzoso">
                  </div>
                  

                  <div class="col-sm-6">
									<label>Estado de la linea: </label>
									<div class="col-sm-6">
										<input id="Estado" type="radio" name="Estado" value="Activo" /> Activo
                    <br>
                  </div>
									<div class="col-sm-6">
										<input id="Estado" type="radio" name="Estado" value="Inactivo" /> Inactivo
									</div>
                </div>
                
                
                <div class="col-sm-6">
			          <label>Descripción</label>
			          <textarea id="Descripcion_L" type="text" required placeholder="Descripcion" value= "" class="form-control input-sm"  name="Descripcion_L"></textarea>
              </div> 
              
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar </button>
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
          datos = $('#agregaInflinea').serialize();
          validaFormularioLinea('agregaInflinea');
          let validaForm = $("#agregaInflinea").valid();
          /* Agregar nuevo registro */
          if (validaForm == true) {
            $.ajax({
              type: "POST",
              data: datos,
              url: "linea/procesoAgrega.php",
              success: function(r) {
                console.log("devuelve->" + r);
                if (r == 1) {
                  $('#agregaInflinea')[0].reset();
                  $('#dataTableInflinea').load('linea/lineaTabla.php');
                  alertify.success("Agregado con exito :D");
                  getSim("Sim", 0);
                  // location.reload(true);
                } else {
                  alertify.error("Fallo al agregar :(" + r);
                }
              }
            });

          }
        });
        /* Actualizar los registros */
        $('#btnActualizar').click(function() {
          datos = $('#formActualizaInflinea').serialize();
          validaFormularioLinea('formActualizaInflinea');
          let validaFormAct = $("#formActualizaInflinea").valid();
          if (validaFormAct == true) {
            $.ajax({
              type: "POST",
              data: datos,
              url: "linea/procesoActualiza.php", 
              success: function(r) {
                console.log("actuliza: " + r);
                if (r == 1) {
                  $('#dataTableInflinea').load('linea/lineaTabla.php');
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
        $('#dataTableInflinea').load('../linea/lineatabla.php');
      });
    </script>

    <script type="text/javascript">
      function agregaFrmActualizar(Id_linea) {
        getSim("SimU", Id_linea);
        $.ajax({
          type: "POST",
          data: "Id_linea=" + Id_linea,
          url: "linea/procesoObtener.php",
          success: function(r) {
            //console.log("obtiene: -->"+r);
            datos = jQuery.parseJSON(r);
            $('#Id_linea').val(datos['Id_linea']);
            $('#TelefonoU').val(datos['Telefono']);
            $('#Descripcion_L').val(datos['Descripcion_L']);
            $('#ContratoU').val(datos['Contrato']);
            $('#Fecha_recepcionU').val(datos['Fecha_recepcion']);
            $('#Fin_plazo_forzosoU').val(datos['Fin_plazo_forzoso']);
            $('#SimU').val(datos['Id_Sim']);
            $('#CompaniaU').val(datos['Id_Compania']);

            let estado = document.getElementsByName("Estado");
					for (let i = 0; i < estado_c.length; i++) {
						if (estado[i].value == datos["Estado"]) {
							estado[i].checked = true;
						}
					}
          }
        });
      }
      /*Llena combo Sim Actualzar */
      function getSim(tag, Id_linea) {
        $.ajax({
          type: "POST",
          data: {
            "Id_linea": Id_linea
          },
          url: 'linea/combosLinea.php',
          success: function(r) {
            datos = jQuery.parseJSON(r);
            $('#' + tag)[0].options.length = 0;
            $.each(datos, function(key, registro) {
              $("#" + tag).append('<option value=' + registro.Id_Sim + '>' + registro.Sim + '</option>');
            });
          },
          error: function(r) {
            alert('error');
          }
        });
      } 
 
      /* Eliminar un registro */
      function eliminarDatos(Idlinea) {
        alertify.confirm('Eliminar una linea', '¿Seguro de eliminar una linea :(?', function() {
          $.ajax({
            type: "POST",
            data: "Id_linea=" + Idlinea,
            url: "linea/procesoElimina.php",
            success: function(r) {
              console.log("Esto elimina: " + r);
              if (r == 1) {
                $('#dataTableInflinea').load('linea/lineaTabla.php');
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