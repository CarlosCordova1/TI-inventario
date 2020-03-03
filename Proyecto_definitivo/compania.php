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
	<title>IT inventario-Compañia</title>

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
								Compañia
							</div>
							<div class="card-body  ">
								<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
									Agregar nuevo<span class="fa fa-plus-circle"></span>
								</span>
								<hr>
								<div id="dataTableCompania"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal agregar nuevo compañia-->
			<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Agregar una nueva compañia</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="idAgregaCompania">
								<form id="agregaCompania">
									<label>Compañia</label>
									<input type="text" required placeholder="Compañia" value="" class="form-control input-sm" name="Compania">
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


			<!-- Modal actualizar compañia. -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Actualizar compañia</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="formActualizaCompania">
								<input type="hidden" id="Id_Compania" name="Id_Compania">
								<label>Compañia</label>
								<input id="Compania" type="text" required placeholder="Compañia" value="" class="form-control input-sm" name="Compania">
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


	<!-- -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnAgregarnuevo').click(function() {
				datos = $('#agregaCompania').serialize();
				/* Agregar nuevo registro */
				$.ajax({
					type: "POST",
					data: datos,
					url: "compania/procesoAgrega.php",
					success: function(r) {
						if (r == 1) {
							$('#agregaCompania')[0].reset();
							$('#dataTableCompania').load('compania/companiaTabla.php');
							alertify.success("Agregado con exito :D");
						} else {
							alertify.error("Fallo al agregar :(" + r);
						}
					}
				});
			});
			/* Actualizar los registros */
			$('#btnActualizar').click(function() {
				datos = $('#formActualizaCompania').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "compania/procesoActualiza.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableCompania').load('compania/companiaTabla.php');
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
			$('#dataTableCompania').load('../compania/companiaTabla.php');
		});
	</script>

	<script type="text/javascript">
		function agregaFrmActualizar(Id_Compania) {
			$.ajax({
				type: "POST",
				data: "Id_Compania=" + Id_Compania,
				url: "compania/procesoObtener.php",
				success: function(r) {
					datos = jQuery.parseJSON(r);
					$('#Id_Compania').val(datos['Id_Compania']);
					$('#Compania').val(datos['Compania']);
				}
			});
		}
		/* Eliminar un registro */
		function eliminarDatos(IdCompania) {
			alertify.confirm('Eliminar una compania', '¿Seguro de eliminar una compañia :(?', function() {
				$.ajax({
					type: "POST",
					data: "Id_Compania=" + IdCompania,
					url: "compania/procesoElimina.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableCompania').load('compania/companiaTabla.php');
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