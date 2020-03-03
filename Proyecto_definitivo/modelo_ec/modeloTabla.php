<?php
require_once "../tabla/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql = "SELECT * from modelo_ec;"; 

$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" id="dataTableModelo">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<td>Marca</td>
			<td>Modelo</td>
			<td>Color</td>
			<td>SKU</td>
			<td>Nombre_Modelo</td>
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
					<?php echo $mostrar["Marca"] ?>
				</td>

				<td>
					<?php echo $mostrar["Modelo"] ?>
				</td>

				<td>
					<?php echo $mostrar["Color"] ?>
				</td>

				<td>
					<?php echo $mostrar["SKU"] ?>
				</td>

				<td>
					<?php echo $mostrar["NombreModelo"] ?>
				</td>

				<td style="text-align: center;">
					<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar['Id_modelo'] ?>')">
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