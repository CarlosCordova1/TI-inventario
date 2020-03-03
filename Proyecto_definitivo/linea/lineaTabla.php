<?php 
require_once "../tabla/clases/conexion.php"; 
$obj= new conectar();
$conexion=$obj->conexion(); 

$sql="SELECT il.Id_linea, il.Id_Sim, il.Id_Compania, 
il.Telefono, il.Estado, il.Descripcion_L, 
il.Contrato, il.Fecha_recepcion, il.Fin_plazo_forzoso, 
s.Id_Sim, s.Sim,  c.Id_Compania, c.Compania
from inf_linea as il 
left join sim as s on  il.Id_Sim=s.Id_Sim
left join compania as c on c.Id_Compania= il.Id_Compania;";

$result=mysqli_query($conexion,$sql);
?>

<table class="table table-hover table-condensed table-bordered" id="dataTableInflinea">
		<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
			<tr>
				<td>Telefono</td>
				<td>Contrato</td>
				<td>Sim</td>
				<td>Compañia</td>
				<td>Estado</td>
				<td>Descripcion</td>
                <td>Fecha Agredo</td>
				<td>Editar</td>
				<td>Eliminar</td>  
			</tr>
		</thead> 
	 
		<tbody > 
			<?php 
			while ($mostrar=mysqli_fetch_array($result)) {
				
				?> 
				<tr >
					<!-- Linea-->
                    <td>
					<?php echo $mostrar["Telefono"] ?>
                    </td>

                    <td>
				    <?php echo $mostrar["Contrato"] ?>
					</td>

					<td>
				    <?php echo $mostrar["Sim"] ?>
					</td>

					<td>
				   <?php echo $mostrar["Compania"] ?>
					</td>

					<td>
				   <?php echo $mostrar["Estado"] ?>
					</td>

					<td> 
				   <?php echo $mostrar["Descripcion_L"] ?>
					</td>

				    <td>
				    <i class="fa fa-calendar" aria-hidden="true"><?php echo $mostrar["Fecha_recepcion"] ?></i>
				    <br>
                     <i class="fa fa-calendar" aria-hidden="true"><?php echo $mostrar["Fin_plazo_forzoso"] ?></i>
				    </td>

					<td style="text-align: center;">
						<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" 
						onclick="agregaFrmActualizar('<?php echo $mostrar['Id_linea'] ?>')">
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
		$('#dataTableInflinea').DataTable();
	} ); 
</script>