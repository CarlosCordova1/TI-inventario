<?php
require_once "../tabla/clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql = "
select * from accesorios;  
";


$result = mysqli_query($conexion, $sql);

?>
<table class="table table-hover table-condensed table-bordered" id="dataTableAccesorio">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<td>Accesorio</td>
			<td>Descripcion</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
	</thead>

	<tbody>
		<?php
		while ($mostrar = mysqli_fetch_array($result)) {

		?>
			<tr>
				<!-- -->
				<td>
					 <?php echo $mostrar["Accesorio"] ?>
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