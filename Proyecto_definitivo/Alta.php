<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "scripts.php"; ?> 
	<style>
		.city {
			display: none  
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title>IT inventario</title>

	<!-- Favicons -->
	<link href="img/aguakan.png" rel="icon">
	<!-- Bootstrap core CSS -->
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!--external css-->
	<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
	<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/style-responsive.css" rel="stylesheet">
	<script src="lib/chart-master/Chart.js"></script>
	<style>
		.autoC:hover {
			background: steelblue;
			color: black;
			border: 1px;
			border-radius: 3px;
		}

		.autocomplete-items:hover {
			cursor: pointer;
			background: #FAFAFA;
			border: 2px;
			border-width: 20px;
			border-color: red;
			margin: 5px;
		}

		.autocomplete-items {
			background: #E9F7FF;
			border-radius: 3px;
		}
	</style>
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
							<!--
							<div class="card-header">
								Alta
								<a href=" tabla/celularcsv.php" class="btn btn-success pull-right">Reporte CSV</a>
							</div>-->
							<div class="card-body  ">
								<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
									Agregar nuevo <span class="fa fa-plus-circle"></span>
								</span>
								<hr>
								<div id="tablaDatatable"></div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<!-- Modal agregar nuevo celular-->
			<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo celular</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="frmnuevo">
								<div class=" col-sm-6">
									<label>Núm. Serie</label>
									<input type="text" required placeholder="Numero de serie" class="form-control input-sm"  name="Serie">
								</div>
								<div class=" col-sm-6">
									<label>Núm. IMEI</label>
									<input type="text" required placeholder="00000000000001" value="" class="form-control input-sm"  name="IMEI">
								</div>

								<!--Modelo // pediente-->
								<div class="col-sm-6">
                                        <label>Modelo</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = " SELECT Id_modelo, NombreModelo, Color from modelo_ec;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <select class="form-control input-sm" name="NombreModelo">
                                            <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?php echo $mostrar['Id_modelo'] ?>"><?php echo $mostrar['NombreModelo'] ?>
												->
												<?php echo $mostrar['Color'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

								
								<div class="col-sm-6">
									<label>Cargador</label>
									<input type="text" required placeholder="Cargador" value="" class="form-control input-sm"  name="Cargador">
								</div>
								<div class="col-sm-6">
									<label>Equipo anterior</label>
									<input type="text" required placeholder="Equipo anterior" value="" class="form-control input-sm"  name="Equipo_anterior">
								</div>
  
								<!--Estado de telefono que es  -->
								<div class="col-sm-6">
								<label>Estado</label>
			                    <?php  require_once "tabla/clases/conexion.php";
			                     $obj = new conectar();
			                     $conexion = $obj->conexion();
			                     $sql = "select * from cat_estatus;";
			                     $result = mysqli_query($conexion, $sql);
			                     ?>
			                     <select id="Estado" class="form-control input-sm" name="Estado">
                                 <?php
                                 while ($mostrar = mysqli_fetch_array($result)) {
                                 ?>
                                        <option value="<?php echo $mostrar['Estado'] ?>"><?php echo $mostrar['Estado'] ?></option>
                                 <?php
                                   }
                                 ?>
                              </select>
		                     </div>

								<!--Telefono -->
								<div class="col-sm-6">
									<label>Num. Tel.</label>
									<div class="autocomplete">
										<input type="text" maxlength="12" id="NumTel" name="NumTel" class="form-control input-sm" type="text" placeholder="Num. Telefono">
									</div>
								</div>
								<div class="col-sm-12">
									<label>Descripcion </label>
									<textarea type="text" required placeholder="Descripcion del equipo" class="form-control input-sm"  name="Descripcion"></textarea>
								</div>
								<!--Accesorios -->
								<div class="container-fluid">
									<label> Accesorios: </label>
									<?php
									require_once "tabla/clases/conexion.php";
									$obj = new conectar();
									$conexion = $obj->conexion();
									$sql = "SELECT Id_Accesorios, Accesorio, Descripcion from accesorios";
									$result = mysqli_query($conexion, $sql);
									?>
									<div class="card" style="width: auto;height: auto;">
										<div class="card-body">
											<p class="card-text">
												<div class="row">
													<?php
													while ($mostrar = mysqli_fetch_array($result)) {
													?>
														<label class="col-md-6"><input type="checkbox" name="Accesorios[]" value="<?php echo $mostrar["Id_Accesorios"]; ?>"> <?php echo $mostrar["Accesorio"]; ?></label><br>
													<?php
													}
													?>
												</div>
											</p>
										</div>
									</div>
								</div>

							</form>
						</div>
						<div class="modal-footer">
							<button type="button" id="btnAddClose" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar </button>
						</div>
					</div>
				</div>
			</div>


			<!-- Modal actualizar equipo. -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Actualizar equipo celular</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="frmActualizar">
								<input type="hidden" id="Id_celular" name="Id_celular" />

								<div class=" col-sm-6">
									<label>Núm. Serie</label>
									<input type="text" required placeholder="Numero de serie" value="" class="form-control input-sm" id="SerieU" name="Serie">
								</div>
								<div class=" col-sm-6">
									<label>Núm. IMEI</label>
									<input type="text" required placeholder="00000000000001" value="" class="form-control input-sm" id="IMEIU" name="IMEI">
								</div>

								<!--Modelo // pediente-->
								<div class="col-sm-6">
                                        <label>Modelo</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = " SELECT Id_modelo, NombreModelo, Color from modelo_ec;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <select id="NombreModeloU"  class="form-control input-sm" name="NombreModelo">
                                            <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?php echo $mostrar['Id_modelo'] ?>">
												<?php echo $mostrar['NombreModelo'] ?>
												-><?php echo $mostrar['Color'] ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
									</div>
									
								
								<div class="col-sm-6">
									<label>Cargador</label>
									<input type="text" required placeholder="Cargador" value="" class="form-control input-sm" id="CargadorU" name="Cargador">
								</div>
								<div class="col-sm-6">
									<label>Equipo anterior</label>
									<input type="text" required placeholder="Equipo anterior" value="" class="form-control input-sm" id="Equipo_anteriorU" name="Equipo_anterior">
								</div>

								<!--Estado de telefono que es  -->
								<div class="col-sm-6">
								<label>Estado</label>
			                    <?php  require_once "tabla/clases/conexion.php";
			                     $obj = new conectar();
			                     $conexion = $obj->conexion();
			                     $sql = " SELECT  * from cat_estatus;";
			                     $result = mysqli_query($conexion, $sql);
			                     ?>
			                     <select id="EstadoU" class="form-control input-sm" name="Estado">
                                 <?php
                                 while ($mostrar = mysqli_fetch_array($result)) {
                                 ?>
                                        <option value="<?php echo $mostrar['Estado'] ?>"><?php echo $mostrar['Estado'] ?></option>
                                 <?php
                                   }
                                 ?>
                              </select>
		                     </div>

								<!--Telefono -->
								<div class="col-sm-6">
									<label>Num. Tel.</label>
									<div class="autocomplete">
										<input type="text" maxlength="12" id="NumTelU" name="NumTel" class="form-control input-sm" type="text" placeholder="Num. Telefono">
									</div>
								</div>
								<div class="col-sm-12">
									<label>Descripcion </label>
									<textarea type="text" required placeholder="Descripcion del equipo" class="form-control input-sm" id="DescripcionU" name="Descripcion"></textarea>
								</div>
								<!--Accesorios -->
								<div class="container-fluid">
									<label> Accesorios: </label>

									<?php
									require_once "tabla/clases/conexion.php";
									$obj = new conectar();
									$conexion = $obj->conexion();
									$sql = "SELECT Id_Accesorios, Accesorio, Descripcion from accesorios";
									$result = mysqli_query($conexion, $sql);
									?>
									<div class="card" style="width: auto;height: auto;">
										<div class="card-body">
											<p class="card-text">
												<div class="row">
													<?php
													while ($mostrar = mysqli_fetch_array($result)) {
													?>
														<label class="col-md-6"><input type="checkbox" name="AccesoriosU[]" value="<?php echo $mostrar["Id_Accesorios"]; ?>"> <?php echo $mostrar["Accesorio"]; ?></label><br>
													<?php
													}
													?>
												</div>
											</p>
										</div>
									</div>
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
			<!--Fin modal actualizar -->
		</section>

	</section>
 

	<script src="tabla/librerias/codeEditUser/autoComplete.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnAgregarnuevo').click(function() {
				validaFormulario('frmnuevo');
				let valida = $("#frmnuevo").valid();

				if (valida == true) {
					datos = $('#frmnuevo').serialize();
					/* Agregar nuevo registro */
					$.ajax({
						type: "POST",
						data: datos,
						url: "tabla/procesos/agregar.php",
						success: function(r) {
							console.log("tabla :" + r);
							if (r == 1) {
								$('#frmnuevo')[0].reset();
								$('#tablaDatatable').load('tabla.php');
								alertify.success("Agregado con exito :D");
							} else {
								alertify.error("Fallo al agregar :(" + r);
							}
						}
					});
				}
			});


			/*Recursos */
			$('#NumTel').keyup(function() {
				busquedaNum("NumTel", "searchNumPhone");
			});
			$('#NumTelU').keyup(function() {
				busquedaNum("NumTelU", "searchNumPhone");
			});
		});
		/*funcion busqueda */
		function busquedaNum(idTag, funcionName) {
			var opcion = funcionName;
			var data = $('#' + idTag).val();
			let datos = {
				recurso: opcion,
				numTel: data
			};
			if (data != '') {
				$.post("tabla/procesos/recursos.php", datos, function(resultado) {
					var list = JSON.parse(resultado);
					autocomplete(document.getElementById(idTag), list);
				});
			}
		}

		/* Actualizar los registros */
		$('#btnActualizar').click(function() {
			validaFormulario('frmActualizar');
			let valida = $("#frmActualizar").valid();

			if (valida == true) {
				datos = $('#frmActualizar').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "tabla/procesos/actualizar.php",
					success: function(r) {
						console.log("actualizar: "+r);
						if (r == 1) {
							$('#tablaDatatable').load('tabla.php');
							alertify.success("Actualizado con exito :D");
						} else {
							alertify.error("Fallo al actualizar :(");
						}
					}
				});
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaDatatable').load('tabla.php');
		});
	</script> 

	<script type="text/javascript">
		function agregaFrmActualizar(IdCelular) {
			let obj = {
				Idcelular: IdCelular
			};
			$.ajax({
				type: "POST",
				data: obj,
				url: "tabla/procesos/obtenDatos.php",
				success: function(r) { 

					//console.log("actualizar: "+r);
					datos = jQuery.parseJSON(r);
					$('#Id_celular').val(datos['Id_celular']);
					$('#SerieU').val(datos['Serie']);
					$('#IMEIU').val(datos['IMEI']);
					$('#NombreModeloU').val(datos['NombreModelo']);
					$('#CargadorU').val(datos['Cargador']); 
					$('#EstadoU').val(datos['Estado']);
					$('#Equipo_anteriorU').val(datos['Equipo_anterior']);
					$('#DescripcionU').val(datos['Descripcion']);
					$('#NumTelU').val(datos['NumTel']);
					$('#NombreModeloU').val(datos['Id_modelo']);
					
					/*Accesorios */
					let accesorios = document.getElementsByName("AccesoriosU[]");
					/*limpiar checkbox */
					//console.log(datos + r);
					for (let l = 0; l < accesorios.length; l++) {
						accesorios[l].checked = false;
					}

					/* Asigna checkbox */
					for (let j = 0; j < accesorios.length; j++) {
						accesorios[j].checked = false;
						for (let k = 0; k < datos.ListaAccesorio.length; k++) {
							if (accesorios[j].value == datos.ListaAccesorio[k]["Id_Accesorios"]) {
								accesorios[j].checked = true;
							}
						}

					}
				}
			});
		}
		/* Eliminar un registro */
		function eliminarDatos(Idcelular) {
			alertify.confirm('Eliminar un equipo celular', '¿Seguro de eliminar un equipo celular :(?', function() {
				$.ajax({
					type: "POST",
					data: "Idcelular="+Idcelular,
					url: "tabla/procesos/eliminar.php",
					success: function(r) {
						//console.log("delete : "+r);
						if (r == 1) {
							$('#tablaDatatable').load('tabla.php');
							alertify.success("Eliminado con exito !");
						} else {
							alertify.error("No se pudo eliminar...");
						}
					}
				});
			}, function(){ 
		});
		}
	</script>
	<!-- -->
	<?php include 'script_body.php'; ?>
</body>
</html>