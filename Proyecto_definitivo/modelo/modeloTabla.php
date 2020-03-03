<?php
require_once "../tabla/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion(); 

$sql = "SELECT * from modelo; 
";

$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" id="dataTableModelo">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<td>Marca</td>
			<td>Modelo</td>
			<td>Nombre_Radio</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
	</thead>

	<tbody>
		<?php
		while ($mostrar = mysqli_fetch_array($result)) {
		?>
			<tr>
				<!-- modelo-->
				<td>
					<?php echo $mostrar["Marca_r"] ?>
				</td>

				<td>
					<?php echo $mostrar["Modelo_r"] ?>
				</td>

				<td>
					<?php echo $mostrar["NombreRadio"] ?>
				</td>
				<td style="text-align: center;">
					<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar[0] ?>')">
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
		$('#iddatatable').DataTable();
	});
</script>