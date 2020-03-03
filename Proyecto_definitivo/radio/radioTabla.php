<?php
require_once "../tabla/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion(); 
 
$sql = "SELECT * from equipo_radio as er
left join modelo as m on  er.Id_modelo=m.Id_modelo
left join estado as e on e.Id_estado= er.Id_estado;";
$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" id="dataTableRadio">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<td>Número de radio</td>
			<td>Número de serie</td>
			<td>Nombre_Radio</td>
			<td>Estado</td>
			<td>Número de sap</td>
			<td>Fecha de mantenimiento</td>
			<td>Descripción</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
	</thead>

	<tbody>
		<?php
		while ($mostrar = mysqli_fetch_array($result)) {

		?>
			<tr>
				<!-- radio-->
				<td>
					<?php echo $mostrar["Num_radio"] ?>
				</td>

				<td>
					<?php echo $mostrar["Num_serie"] ?>
				</td>

				<td>
					<?php echo $mostrar["NombreRadio"] ?>
				</td>

				<td>
					<?php echo $mostrar["Estado_r"] ?>
				</td>

				<td>
					<?php echo $mostrar["Num_sap"] ?>
				</td>

				<td>
					<i class="fa fa-calendar" aria-hidden="true"><?php echo $mostrar["Fecha_inicio"] ?></i>
					<br>
					<i class="fa fa-calendar" aria-hidden="true"><?php echo $mostrar["Fecha_final"] ?></i>
				</td>

				<td>
				    <?php echo $mostrar["Descripcion"] ?>
				</td>

				<td style="text-align: center;">
					<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $mostrar['Id_radio'] ?>')">
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
		$('#dataTableRadio').DataTable();
	});
</script>