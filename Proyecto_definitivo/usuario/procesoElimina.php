<?php 
	
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";

	$obj= new crud();  

	echo $obj->eliminar($_POST['Id_usuario']); 
 ?>  