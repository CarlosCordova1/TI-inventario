<?php  
require_once "tabla/clases/conexion.php";
$obj= new conectar(); 
$conexion=$obj->conexion();  

$sql=" SELECT 
max(ec.Id_celular) as Id_celular,			max(ec.Id_linea) as Id_linea,				max(ec.Id_modelo) as Id_modelo,
max(ec.Serie) as Serie,						max(ec.IMEI) as IMEI,						max(ec.Cargador) as Cargador,
max(ec.Estado) as Estado,					max(ec.Descripcion) as Descripcion,			max(ec.Equipo_anterior) as Equipo_anterior,
max(il.Id_Compania) as Id_Compania,			max(il.Telefono) as Telefono,				max(il.Descripcion_L) as Descripcion_L,
max(il.Contrato) as Contrato,				max(il.Fecha_recepcion) as Fecha_recepcion, max(il.Fin_plazo_forzoso) as Fin_plazo_forzoso,
max(m.NombreModelo) as NombreModelo, 		max(m.Color) as Color,						group_concat(acce.Accesorio) as Accesorio
from equipo_celular as ec 
left join Inf_linea as il on ec.Id_linea=il.Id_linea
left join modelo_ec as m on  m.Id_modelo=ec.Id_modelo
left join asignaaccesorio as asigAccCel	 on asigAccCel.Id_celular=ec.Id_celular
left join accesorios as acce on acce.Id_Accesorios=asigAccCel.Id_Accesorios
group by ec.Id_celular;
";
 
  
$result=mysqli_query($conexion,$sql);

?>
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">
		<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
			<tr>
				<td>Num.Serie</td>
				<td>Núm.IMEI</td>
				<td>Modelo</td>
				<td>Cargador</td>
				<td>Equipo anterior</td>
				<td>Estado</td>
				<td>Num.Tel</td>
				<td>Accesorios:</td>
				<td>Descripción</td> 
				<td>Editar</td>
				<td>Eliminar</td>
				
			</tr>
		</thead> 
	
		<tbody >
			<?php 
			while ($mostrar=mysqli_fetch_array($result)) {
				
				?> 
				<tr > 
					
                <td >
					<?php echo $mostrar["Serie"] ?>
				</td>
	
				<td>										  
					<?php echo $mostrar["IMEI"] ?>
				</td>

				<td>                                                
					<?php echo $mostrar["NombreModelo"] ?> ->
					<?php echo $mostrar["Color"] ?>
				</td>

				<td>
					<?php echo $mostrar["Cargador"] ?>
			    </td>
					
				<td>
					<?php echo $mostrar["Equipo_anterior"] ?>
				</td>

				<td>					
					<?php echo $mostrar["Estado"] ?>
				</td>

                <td>
					<?php echo $mostrar["Telefono"] ?>
				</td>
				<!-- <br>
				<i class="fa fa-signal" aria-hidden="true"> <?php // echo $mostrar["Compania"] ?></i>-->
				<td>
					<?php echo $mostrar["Accesorio"] ?>
				</td>
				<td>
					<?php echo $mostrar["Descripcion"] ?>
				</td>

					<td style="text-align: center;">
						<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" 
						onclick="agregaFrmActualizar('<?php echo $mostrar['Id_celular'] ?>')">
							<span class="fa fa-pencil-square-o"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar['Id_celular'] ?>')">
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
	} ); 
</script>