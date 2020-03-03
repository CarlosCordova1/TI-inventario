<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
//pendiente 
	$datos=array(
		$_POST['Accesorio'],
		$_POST['Descripcion']
				);
	echo $obj->agregar($datos);
 ?>  