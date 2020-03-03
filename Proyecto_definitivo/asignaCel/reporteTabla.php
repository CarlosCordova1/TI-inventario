<?php
require_once "../tabla/clases/conexion.php";
require_once "crud.php";
$obj= new crud();
$urlAsigCel='';
if(isset($_GET['fechaAsigInicio']) && isset($_GET['fechaAsigFin'])){
	$datosPeriodo=array(
		"fechaInicio"=>$_GET['fechaAsigInicio'],
		"fechaFin"=>$_GET['fechaAsigFin']
	);
	$lista=$obj->periodoEquiAsig($datosPeriodo);
	$urlAsigCel="asignaCel/reporte/reporteAsigCel.php?fechaInicio=".$_GET['fechaAsigInicio']."&fechaFin=".$_GET['fechaAsigFin'];
}else{
	$lista=$obj->todosEquiAsig();
	$urlAsigCel="asignaCel/reporte/reporteAsigCel.php";
}
if(count($lista)>0){
?>
<div class="container-fluid">
<div style="margin-top:34px; border-top-color: hsl(89, 43%, 51%);">
<a  class="btn btn-success float-right" href="<?php echo $urlAsigCel;?>" target="_blank">Imprimir csv</a>
<input id="BuscaCel" class="form-control col-sm-2 float-right" placeholder="Buscar..." />
<table class="table table-hover table-condensed table-bordered table-responsive" id="tablaReporteAsigCel">
	<thead style="background-color: #1C9FE5;color: white; font-weight: bold;">
		<tr>
			<th>Num_empleado</th>
			<th>Nombre_Empleado</th>
			<th>Gerencia</th>
			<th>Zona</th>
			<th>Nombre_Modelo</th>
			<th>Color</th>
			<th>NumTel</th>
			<th>EstatusCel</th>
			<th>FechaAsig</th>
			<th>FechaBaja</th>
		</tr>
	</thead> 

	<tbody>
		<?php
		
		for ($i=0;$i < count($lista);$i++) {
		?>
			<tr>
				<td>
					<?php echo $lista[$i]["NominaEmpleado"] ?>
				</td>
				<td>
					<?php echo $lista[$i]["NombreEmpleado"] ?>
				</td>

				<td>
					<?php echo $lista[$i]["Gerencia"] ?>
				</td>
				<td>
					<?php echo $lista[$i]["Zona"] ?>
				</td>
				<td>
					<?php echo $lista[$i]["NombreModelo"] ?>
				</td>

				<td>
					<?php echo $lista[$i]["Color"] ?>
				</td>
				<td>
					<?php echo $lista[$i]["NumTel"] ?>
				</td>
				<td>
					<?php echo $lista[$i]["EstatusCel"] ?>
				</td>
				<td style="text-align: center;">
					<?php echo $lista[$i]["FechaAsig"] ?>
				</td>
				<td style="text-align: center;">
					<?php echo $lista[$i]["FechaBaja"] ?>
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>
</div>
</div>
<?php 	}
else{
	echo "<div style='margin-top:59px;' class='alert alert-danger'>No hay registros</div>";
}
?>

<script>
$(document).ready(function(){
  $("#BuscaCel").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#reporteAsigCel tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
