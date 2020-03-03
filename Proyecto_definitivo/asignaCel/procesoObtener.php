<?php 
	
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";

	$obj= new crud();
if(isset($_POST['Id_usuario'])){
	echo json_encode($obj->obtenDatos($_POST['Id_usuario']));
}
else if(isset($_POST['Id_celular'])){
	echo json_encode($obj->obtenerEquipoCel($_POST['Id_celular']));
}
 ?>    