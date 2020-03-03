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
  <link rel="stylesheet" href="ArchivosJS/RecursosJS/style.css">
  <link rel="stylesheet" href="ArchivosJS/RecursosJS/prism.css">
  <link rel="stylesheet" href="ArchivosJS/RecursosJS/chosen.css">
</head>
<?php
require('Menu/menu.php');
?>
<body>
	<section id="main-content">
		<section class="wrapper site-min-height">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card" style="width: auto; height: auto;">
							<div class="card-header">
								Asignar Equipos a Usuarios
							</div>
							<div class="card-body"  style="border-style: solid; border-radius: 3px; border-widht:1px; border-color:#BEE7FF;" >
								<form id="frmAsignaCel" >
									<input type="hidden" name="idUsuario" id="AsigIdUsuario" value="0"/>
									<div class="col-sm-6">
                                        <label>Usuario</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = "SELECT * from usuario;";
                                        $result = mysqli_query($conexion, $sql);
										?>
                                        <select id="AsigUsuario" class="form-control input-sm chosen-select" tabindex="2"
										name="AsigUsuario">
                                           <option value="0" label="selecciona..." />
										    <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?php echo $mostrar['Id_usuario'] ?>"><?php echo $mostrar['Num_empleado']." | ".$mostrar['Usuario_r'] ?></option>
                                            <?php
                                            }
                                            ?>
										</select>
                                    </div>
                                    
									<div class="col-sm-6">
                                        <label>Equipos</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = "SELECT ec.Id_celular, mec.NombreModelo, mec.Color, 
										ec.Serie,ec.IMEI 
										from equipo_celular as ec 
										inner join modelo_ec as mec on ec.Id_modelo=mec.Id_modelo
										where ec.Estado in('Asignado','Disponible')
										;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <!--<select id="asigEqCel" class="form-control input-sm" name="EqCel"  >-->
                                        <select id="asigEqCel" class="form-control input-sm" name="EqCel"  >
										<option value="0" label="selecciona..." />
										    <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                         <option value="<?php echo $mostrar['Id_celular'] ?>">
                                         <?php echo $mostrar['NombreModelo']. "-". $mostrar['Color'] ?>  Serie :
                                         <?php echo $mostrar['Serie'] ?>   IMEI :
                                        <?php echo $mostrar['IMEI'] ?>
                                         </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
									<!-- Campo estado del equipo -->
									<div class="col-sm-6">
										<label>Estatus: </label>
										<div class="input-sm">
											<input id="Estatus" type="radio" name="Estatus" value="Activo" checked /><label id="EstatusActivo"> Activo</label>
                                    		<input id="Estatus" type="radio" name="Estatus" value="Inactivo" /><label id="EstatusInactivo"> Inactivo</labe>
                                    		<input id="Estatus" style="display: none;" type="radio" name="Estatus" value="Baja"  data-toggle="modal" data-target="#MotivoBajaModal" /><label style="display: none;" id="EstatusBaja"> Baja</label>
										</div>
									</div>
									<div class="col-sm-6">
										<label>Descripcion </label>
										<textarea id="asigDescripcion" type="text" required placeholder="Descripcion del equipo" class="form-control input-sm"  name="Descripcion">
                                    	</textarea>
									</div>
							   		<button style="display:none" type="button" id="btnAsigCel" class="btn btn-primary btn-sm" >Agregar </button>
								</form>
							</div>
							<div class="card-body">
								<div class="col-sm-7">
									<b>Genera reporte: </b>
									<fieldset> 
									<b>de: </b>
								 		<input id="fechaAsigInicio" class="input-sm" type="date" name="fechaInicio"/> 
									<b>a: </b>
								 		<input id="fechaAsigFin" class="input-sm" type="date" name="fechaFin" />
									<button id="generaAsigCelPer" class="btn" type="button" >Generar</button>
									<button id="generaAsigCelTod" class="btn btn-default" type="button" >Todos</button>
									</fieldset>
								</div><div class="col-sm-5"></div>
								<div class="cols-sm-12">
								<div id="reporteAsigCel"></div>
								</div>
							</div>
							<!-- modal baja -->
							<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 							 Launch demo modal
							</button>-->
								<!-- Modal -->
								<div class="modal fade" id="MotivoBajaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Motivo de la baja</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form id="frmMotivoBaja" onsubmit="return false">
										<input required type="radio" value="Dañado" name="MotivoBaja"/>
										<label>Equipo Dañado</label>
										<br>
										<input required type="radio" value="Extraviado" name="MotivoBaja"/>
										<label>Equipo Extraviado</label>
										<br>
										<input required type="radio" value="Disponible" name="MotivoBaja"/>
										<label>Baja Usuario</label>
										</form>
									</div>
									<div class="modal-footer">
										<button id="MotivoBajaCancelar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										<button id="MotivoBajaContinuar" type="button" class="btn btn-primary">Continuar</button>
									</div>
									</div>
								</div>
								</div>
							<!--  fin modal baja -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
 
	<script src="tabla/librerias/codeEditUser/autoComplete.js"></script>
	<script src="ArchivosJS/RecursosJS/chosen.jquery.js" type="text/javascript"></script>
	<script src="ArchivosJS/RecursosJS/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="ArchivosJS/RecursosJS/init.js" type="text/javascript" charset="utf-8"></script>
	<?php include 'script_body.php'; ?>
	<script src="ArchivosJS/asignaCel/asignaCel.js"></script>

</body>
</html>