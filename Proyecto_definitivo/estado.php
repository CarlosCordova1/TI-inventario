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
	<title>IT inventario-Estado</title>

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
								Estado
							</div>
							<div class="card-body  ">
								<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
									Agregar nuevo<span class="fa fa-plus-circle"></span>
								</span>
								<hr>
								<div id="dataTableEstado"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal agregar nuevo estado-->
			<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo estado</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="idAgregaEstado">
								<form id="agregaEstado">
									<label>Estado</label>
									<input type="text" required placeholder="Estado" value="" class="form-control input-sm" name="Estado_r">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<button type="button" id="btnAgregarnuevo" class="btn btn-primary">Agregar </button>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Modal actualizar estado. -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Actualizar el estado</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="formActualizaEstado">
								<input type="hidden" id="Id_estado" name="Id_estado">
								<label>Estado</label>
								<input id="Estado_r" type="text" required placeholder="Madelo" value="" class="form-control input-sm" name="Estado_r">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" id="btnActualizar" class="btn btn-primary">Actualizar </button>
						</div>
					</div>
				</div>

		</section>
	</section>


	<!-- -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnAgregarnuevo').click(function() {
				datos = $('#agregaEstado').serialize();
				/* Agregar nuevo registro */
				$.ajax({
					type: "POST",
					data: datos,
					url: "estado/procesoAgrega.php",
					success: function(r) {
						if (r == 1) {
							$('#agregaEstado')[0].reset();
							$('#dataTableEstado').load('estado/estadoTabla.php');
							alertify.success("Agregado con exito :D");
						} else {
							alertify.error("Fallo al agregar :(" + r);
						}
					}
				});
			});
			/* Actualizar los registros */
			$('#btnActualizar').click(function() {
				datos = $('#formActualizaEstado').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "estado/procesoActualiza.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableEstado').load('estado/estadoTabla.php');
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
			$('#dataTableEstado').load('../estado/estadoTabla.php');
		});
	</script>

	<script type="text/javascript">
		function agregaFrmActualizar(Id_estado) {
			$.ajax({
				type: "POST",
				data: "Id_estado=" + Id_estado,
				url: "estado/procesoObtener.php",
				success: function(r) {
					datos = jQuery.parseJSON(r);
					$('#Id_estado').val(datos['Id_estado']);
					$('#Estado_r').val(datos['Estado_r']);
				}
			});
		}
		/* Eliminar un registro */
		function eliminarDatos(IdEstado) {
			alertify.confirm('Eliminar un estado', '¿Seguro de eliminar un estado :(?', function() {
				$.ajax({
					type: "POST",
					data: "Id_estado=" + IdEstado,
					url: "estado/procesoElimina.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableEstado').load('estado/estadoTabla.php');
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