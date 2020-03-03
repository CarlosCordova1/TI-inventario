<!DOCTYPE html>
<html lang="en">  
<head>
<?php include "scripts.php"; ?>  
<style>
.city {display:none}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>IT inventario-Sim</title>
 
    <!-- Favicons -->
  <link href="img/aguakan.png" rel="icon">
   <!-- Bootstrap core CSS -->
   <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/style-responsive.css" rel="stylesheet">
  <script src="/lib/chart-master/Chart.js"></script>
</head>
<?php 
require('Menu/menu.php'); 
?> 

<body>
<!-- Modal-->
<section id="main-content" >
      <section class="wrapper site-min-height">      			  
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card" style="width: auto; height: auto;">
					<div class="card-header">
						Sim
					</div>
					<div class="card-body  ">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarnuevosdatosmodal">
							Agregar nuevo<span class="fa fa-plus-circle"></span>
						</span>
						<hr>
						<div id="dataTableSim"></div>
					</div>
					
				</div>
			</div>
		</div>
	</div> 

	<!-- Modal agregar nuevo sim-->
	<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo sim</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        </div> 
         <div class="modal-body">
		<form id="agregaSim">
		<div class="col-sm-12">
			<label>Num. Sim</label>
            <input type="text"  required placeholder="Sim" value= "" class="form-control input-sm" name="Sim">
		</div>

		<div class="col-sm-12">
			<label>Estado</label>
			<?php  require_once "tabla/clases/conexion.php";
			 $obj = new conectar();
			 $conexion = $obj->conexion();
			 $sql = "select * from cat_estatus;";
			 $result = mysqli_query($conexion, $sql);
			 ?>
			 <select id="Estado" class="form-control input-sm" name="Estado">
             <?php
            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                   <option value="<?php echo $mostrar['Estado'] ?>"><?php echo $mostrar['Estado'] ?></option>
            <?php
             }
            ?>
         </select>
		</div>

		<div class="col-sm-12">
			<label>Descripción</label>
			<textarea type="text" required placeholder="descripcion del sim" value= "" class="form-control input-sm"  name="Descripcion"></textarea>
		</div> 
		</form>	
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" id="btnAgregarnuevoSim" class="btn btn-primary">Agregar </button>
				</div>
		</div>
	</div>

  </div>
   
 
	<!-- Modal actualizar sim. --> 
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar sim</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
           
          <div class="modal-body">
			<form id="formActualizaSim">
			<input type="hidden" id="Id_Sim"  name="Id_Sim">

			<div class="col-sm-12">
			<label>Num. Sim</label>
			<input type="text" required placeholder="Sim" value= "" class="form-control input-sm" id ="Sim" name="Sim">
			</div>

			<div class="col-sm-12">
			<label>Estado</label>
			<?php  require_once "tabla/clases/conexion.php";
			 $obj = new conectar();
			 $conexion = $obj->conexion();
			 $sql = "select * from cat_estatus;";
			 $result = mysqli_query($conexion, $sql);
			 ?>
			 <select id="Estado_i" class="form-control input-sm" name="Estado">
             <?php
            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                   <option value="<?php echo $mostrar['Estado'] ?>"><?php echo $mostrar['Estado'] ?></option>
            <?php
             }
            ?>
         </select>
		</div> 

			<div class="col-sm-12">
            <label>Descripción</label>
			<textarea type="text" required placeholder="Descripcion"  value= "" class="form-control input-sm" id="Descripcion" name="Descripcion"></textarea>
			</div>
          </form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnActualizar" class="btn btn-primary">Actualizar </button>
				</div>
            	</div>
                </div>
	         </section> 
             </section>
<script src="tabla/librerias/codeEditUser/autoComplete.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAgregarnuevoSim').click(function(){
	  datos=$('#agregaSim').serialize();
	  validaFormularioSim('agregaSim');
	  let validaFsim = $("#agregaSim").valid();
/* Agregar nuevo registro */
           if (validaFsim ==true){
			$.ajax({
				type:"POST",
				data:datos,
				url:"sim/procesoAgrega.php",
				success:function(r){
         // console.log("sim :"+r);
					if(r==1){
						$('#agregaSim')[0].reset();
						$('#dataTableSim').load('sim/simTabla.php');
						alertify.success("Agregado con exito :D");
					}else{
						alertify.error("Fallo al agregar :("+r);
					}
				}
			});
        }
		});

/* Actualizar los registros */
		$('#btnActualizar').click(function(){
			datos=$('#formActualizaSim').serialize();
			validaFormularioSim('formActualizaSim');
			let validaFsim = $("#formActualizaSim"). valid();
			if (validaFsim == true){
			$.ajax({
				type:"POST",
				data:datos,
				url:"sim/procesoActualiza.php",
				success:function(r){
					//console.log("actualiza:" + r);
					if(r==1){
						$('#dataTableSim').load('sim/simTabla.php');
						alertify.success("Actualizado con exito :D");
					}else{
						alertify.error("Fallo al actualizar :(");
					}
				}
			});
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dataTableSim').load('sim/simTabla.php');
	});
</script>

<script type="text/javascript">
$(document).ready(function (){
    $('#dataTableSim').load('sim/simTabla.php');
});
</script>
<script type="text/javascript">
// esta funcion llena los campos del formulario del modal para actulizar, los filtra por id de la tabla.
	function agregaFrmActualizar(Id_Sim){
		$.ajax({
			type:"POST",
			data:"Id_Sim=" + Id_Sim, 
			url:"sim/procesoObtener.php",
			success:function(r){
            datos=jQuery.parseJSON(r); 
       // console.log("esto es la varible: ", datos);
        //console.log("descripcion: ", datos["Descripcion"]);
				$('#Id_Sim').val(datos['Id_Sim']);
				$('#Sim').val(datos['Sim']); 
                $('#Descripcion').val(datos['Descripcion']);
				$('#Estado_i').val(datos['Estado']);
			}
		});
	}
/* Eliminar un registro */
	function eliminarDatos(IdSim){
		alertify.confirm('Eliminar un sim', '¿Seguro de eliminar un sim :(?', function(){ 
			$.ajax({
				type:"POST",
				data:"Id_Sim=" +IdSim, 
				url:"sim/procesoElimina.php",
				success:function(r){
        
					if(r==1){
						$('#dataTableSim').load('sim/simTabla.php');
						alertify.success("Eliminado con exito !");
					}else{
						alertify.error("No se pudo eliminar..."+r);
					}
				}
			});
		}
		, function(){ 
		});
	}
</script>
<?php include 'script_body.php'; ?>
  </body>
</html>