<?php
require_once "../tabla/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion(); 
 
$sql = "SELECT * from usuario;";
$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" id="dataTableUsuario">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<td>Numero de empleado</td>
			<td>Nombre completo del responsable</td>
			<td>Gerencia</td>
			<td>Puesto</td>
			<td>Zona</td>
			<td>Ubicacion</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
	</thead>

	<tbody>
		<?php
		while ($mostrar = mysqli_fetch_array($result)) {

		?>
			<tr>
				<!-- usuario-->
				<td>
					<?php echo $mostrar["Num_empleado"] ?>
				</td>

				<td>
					<?php echo $mostrar["Usuario_r"] ?>
				</td>

				<td>
					<?php echo $mostrar["Gerencia"] ?>
				</td>

				<td>
					<?php echo $mostrar["Puesto"] ?>
				</td>

				<td>
				  <?php echo $mostrar["Zona"] ?>
				 
				</td>

				<td>
					<?php echo $mostrar["Ubicacion"] ?>
				</td>

				<td style="text-align: center;">
					<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar['Id_usuario'] ?>')">
						<span class="fa fa-pencil-square-o"></span>
					</span>
				</td>
				<td style="text-align: center;">
					<span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0] ?>')">
						<span class="fa fa-trash"></span>
					</span>
				</td>
			</tr>
		<?php
		}

		?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function() {
		$('#dataTableUsuario').DataTable();
	});
</script>