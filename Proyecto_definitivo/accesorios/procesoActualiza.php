<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
  
	$datos=array(
		$_POST['Accesorio'],
		$_POST['Descripcion'],
		$_POST['Id_Accesorios']
				);
	echo $obj->actualizar($datos);
 ?>  