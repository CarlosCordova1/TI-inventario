<?php 
	
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";

	$obj= new crud();

	echo json_encode($obj->obtenDatos($_POST['Id_usuario']));

 ?>     