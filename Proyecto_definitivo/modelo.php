<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once "scripts.php";  ?>
	<style>
		.city {
			display: none
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title>IT inventario-Modelo</title>

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
								Modelo 
							</div>
							<div class="card-body  ">
								<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
								Agregar nuevo<span class="fa fa-plus-circle"></span>
								</span>
								<hr>
								<div id="dataTableModelo"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal agregar nuevo modelo-->
			<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo modelo</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="idAgregaModelo">
								<form id="agregaModelo">

								<div class="col-sm-12">
									<label>Marca</label>
									<input type="text" required placeholder="Modelo" value="" class="form-control input-sm" name="Marca_r">
								</div>

								<div class="col-sm-12">
									<label>Modelo</label>
									<input type="text" required placeholder="Modelo" value="" class="form-control input-sm" name="Modelo_r">
								</div>

								<div class="col-sm-12">
									<label>Nombre_Radio</label>
									<input type="text" required placeholder="Nombre Radio" value="" class="form-control input-sm" name="NombreRadio">
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

			<!-- Modal actualizar modelo. -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Actualizar el modelo</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="formActualizaModelo">
								<input type="hidden" id="Id_modelo" name="Id_modelo">
								
								<div class="col-sm-12">
									<label>Marca</label>
									<input id="Marca_r" type="text" required placeholder="Modelo" value="" class="form-control input-sm" name="Marca_r">
								</div>

								<div class="col-sm-12">
									<label>Modelo</label>
									<input id="Modelo_r" type="text" required placeholder="Modelo" value="" class="form-control input-sm" name="Modelo_r">
								</div>

								<div class="col-sm-12">
									<label>Nombre_Radio</label>
									<input id="NombreRadio" type="text" required placeholder="Nombre Radio" value="" class="form-control input-sm" name="NombreRadio">
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


	<!-- -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnAgregarnuevo').click(function() {
				datos = $('#agregaModelo').serialize();
				/* Agregar nuevo registro */
				$.ajax({
					type: "POST",
					data: datos,
					url: "modelo/procesoAgrega.php",
					success: function(r) {
						if (r == 1) {
							$('#agregaModelo')[0].reset();
							$('#dataTableModelo').load('modelo/modeloTabla.php');
							alertify.success("Agregado con exito :D");
						} else {
							alertify.error("Fallo al agregar :(" + r);
						}
					}
				});
			});
			/* Actualizar los registros */
			$('#btnActualizar').click(function() {
				datos = $('#formActualizaModelo').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "modelo/procesoActualiza.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableModelo').load('modelo/modeloTabla.php');
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
			$('#dataTableModelo').load('../modelo/modeloTabla.php');
		});
	</script>

	<script type="text/javascript">
		function agregaFrmActualizar(Id_modelo) {
			$.ajax({
				type: "POST",
				data: "Id_modelo=" + Id_modelo,
				url: "modelo/procesoObtener.php",
				success: function(r) {
					console.log("actuliza: " + r);
					datos = jQuery.parseJSON(r);
					$('#Id_modelo').val(datos['Id_modelo']);
					$('#Marca_r').val(datos['Marca_r']);
					$('#Modelo_r').val(datos['Modelo_r']);
					$('#NombreRadio').val(datos['NombreRadio']);
				}
			});
		}
		/* Eliminar un registro */
		function eliminarDatos(IdModelo) {
			alertify.confirm('Eliminar un modelo', '¿Seguro de eliminar un modelo :(?', function() {
				$.ajax({
					type: "POST",
					data: "Id_modelo=" + IdModelo,
					url: "modelo/procesoElimina.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableModelo').load('modelo/modeloTabla.php');
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
</body>

</html> 