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
								Asignar Radio a Usuarios
							</div>
							<div class="card-body"  style="border-style: solid; border-radius: 3px; border-widht:1px; border-color:#BEE7FF;" >
								<form id="frmAsignaRad" >
									<input type="hidden" name="idUsuarioRad" id="AsigIdUsuario" value="0"/>
									<div class="col-sm-6">
                                        <label>Usuario</label>
                                        <?php
                                        require_once "tabla/clases/conexion.php";
                                        $obj = new conectar();
                                        $conexion = $obj->conexion();
                                        $sql = "select * from usuario;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <select id="AsigUsuarioRad" class="form-control input-sm chosen-select" tabindex="2" 
										name="AsigUsuario" >
                                           <option value="0" label="selecciona..." />
										    <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                                <option value="<?php echo $mostrar['Id_usuario'] ?>"><?php echo $mostrar['Num_empleado']. " | ". $mostrar['Usuario_r'] ?></option>
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
                                        $sql = "select er.Id_radio,mo.Id_modelo,er.Num_radio,mo.Modelo_r,mo.Marca_r as Marca,er.Num_serie,
                                        er.Num_sap,er.Fecha_inicio,er.Fecha_final,er.Descripcion
                                        from equipo_radio as er
                                        inner join modelo as mo on er.Id_modelo=mo.Id_modelo
										inner join estado as est on est.Id_estado=er.Id_estado
                                        where est.Estado_r not in('Extraviado','Dañado','Robado')
										;";
                                        $result = mysqli_query($conexion, $sql);
                                        ?>
                                        <select id="asigEqRad" class="form-control input-sm" name="asigEqRad">
										<option value="0" label="selecciona..." />
										    <?php
                                            while ($mostrar = mysqli_fetch_array($result)) {
                                            ?>
                                         <option value="<?php echo $mostrar['Id_radio'] ?>">
                                         <?php echo $mostrar['Modelo_r']." ".$mostrar['Marca'] ?> --> Serie :
                                         <?php echo $mostrar['Num_serie'] ?>  -->  SAP :
                                        <?php echo $mostrar['Num_sap'] ?>
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
											<input  id="Estatus" type="radio" name="Estatus" value="Activo" checked /><label id="EstatusActivo"> Activo</label>
											<input  id="Estatus" type="radio" name="Estatus" value="Inactivo" /><label id="EstatusInactivo"> Inactivo</labe>
                                    		<input  id="Estatus" style="display: none;" type="radio" name="Estatus" value="Baja"  data-toggle="modal" data-target="#MotivoBajaModal"/><label style="display: none;" id="EstatusBaja"> Baja</label>
										</div>
									</div>
									<div class="col-sm-6">
										<label>Descripcion </label>
										<textarea id="asigDescripcion" type="text" required placeholder="Descripcion del equipo" class="form-control input-sm"  name="Descripcion">
                                    	</textarea>
									</div>
							   		<button style="display:none" type="button" id="btnAsigRad" class="btn btn-primary btn-sm" >Agregar </button>
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
									<button id="generaAsigRadPer" class="btn" type="button" >Generar</button>
									<button id="generaAsigRadTod" class="btn btn-default" type="button" >Todos</button>
									</fieldset>
								</div><div class="col-sm-5"></div>
								<div class="cols-sm-12">
								<div id="reporteAsigRad"></div>
								</div>
							</div>
							<!--  Inicio modal baja -->
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
	<?php include 'script_body.php'; ?>
	<script src="ArchivosJS/asignaRadio/asignaRadio.js"></script>
	<script src="ArchivosJS/RecursosJS/chosen.jquery.js" type="text/javascript"></script>
	<script src="ArchivosJS/RecursosJS/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="ArchivosJS/RecursosJS/init.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>