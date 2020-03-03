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
	<title>IT inventario-Accesorios</title>

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
								Accesorios
							</div>
							<div class="card-body  ">
								<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
									Agregar nuevo <span class="fa fa-plus-circle"></span>
								</span>
								<hr>
								<div id="dataTableAccesorio"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
 
			<!-- Modal agregar nuevo accesorio-->
			<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo accesorio</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<div id="idAgregaAccesorio">
								<form id="agregaAccesorio">
								<div class="col-sm-12">	
								<label>Accesorio</label>
									<input type="text" required placeholder="Accesorio..." value="" class="form-control input-sm" name="Accesorio">
								</div>	
								<div class="col-sm-12">	
									<label>Descripcion</label>
									<textarea type="text" required placeholder="Descripcion del accesorio" value="" class="form-control input-sm" name="Descripcion"></textarea>
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


			<!-- Modal actualizar accesorio. -->
			<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Actualizar el accesorio</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="formActualizaAccesorio">
								<input type="hidden" id="Id_Accesorios" name="Id_Accesorios">
							   
								<div class="col-sm-12">
								<label>Accesorio</label>
								<input id="Accesorio" type="text" required placeholder="Accesorio..." class="form-control input-sm" name="Accesorio">
								</div>

								<div class="col-sm-12">
								<label>Descripcion</label>
								<textarea type="text" id="Descripcion" required placeholder="Descripcion del accesorio" value="" class="form-control input-sm" name="Descripcion"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" id="btnActualizar" class="btn btn-primary">Editar </button>
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
				datos = $('#agregaAccesorio').serialize();
				validaFormualarioAcceCel('agregaAccesorio');
                let validaAc = $("#agregaAccesorio"). valid();
				/* Agregar nuevo registro */
				if(validaAc == true){
				$.ajax({
					type: "POST",
					data: datos, 
					url: "accesorios/procesoAgrega.php",
					success: function(r) {
						if (r == 1) {
							$('#agregaAccesorio')[0].reset();
							$('#dataTableAccesorio').load('accesorios/accesorioTabla.php');
							alertify.success("Agregado con exito :D");
						} else {
							alertify.error("Fallo al agregar :(" + r);
						}
					}
				});
				}
			});
			/* Actualizar los registros */
			$('#btnActualizar').click(function() {
				datos = $('#formActualizaAccesorio').serialize();
				validaFormualarioAcceCel('formActualizaAccesorio');
				let validaAc = $("#formActualizaAccesorio"). valid();
				if(validaAc ==true){
				$.ajax({ 
					type: "POST",
					data: datos,
					url: "accesorios/procesoActualiza.php",
					success: function(r) {
						console.log("actuliza: " + r);
						if (r == 1) {
							$('#dataTableAccesorio').load('accesorios/accesorioTabla.php');
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
			$('#dataTableAccesorio').load('/accesorios/accesoriotabla.php');
		});
	</script>

	<script type="text/javascript">
		function agregaFrmActualizar(Id_Accesorios) {
			$.ajax({
				type: "POST",
				data: "Id_Accesorios=" + Id_Accesorios,
				url: "accesorios/procesoObtener.php",
				success: function(r) {
					datos = jQuery.parseJSON(r);
					$('#Id_Accesorios').val(datos['Id_Accesorios']);
					$('#Accesorio').val(datos['Accesorio']);
					$('#Descripcion').val(datos['Descripcion']);
				} 
			});
		}
		/* Eliminar un registro */
		function eliminarDatos(IdAccesorios) {
			alertify.confirm('Eliminar un accesorio', '¿Seguro de eliminar un accesorio :(?', function() {
				$.ajax({
					type: "POST",
					data: "Id_Accesorios=" + IdAccesorios,
					url: "accesorios/procesoElimina.php",
					success: function(r) {
						if (r == 1) {
							$('#dataTableAccesorio').load('accesorios/accesorioTabla.php');
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