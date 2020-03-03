<?php
require_once "../tabla/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql="SELECT Id_Sim, Sim,Descripcion,Estado from sim;"; 

$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" id="dataTableSim">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<td>Num. Sim</td>
			<td>Status</td>
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
				<!-- Sim-->
				<td>
					<?php echo $mostrar["Sim"] ?>
				</td>
 
				<td>
					<?php echo $mostrar["Estado"] ?>
				</td>

				<td>
					<?php echo $mostrar["Descripcion"] ?>
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