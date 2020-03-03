<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
   
	$datos=array(
		$_POST['Compania'], 
		$_POST['Id_Compania']
	              );
	echo $obj->actualizar($datos);  
 ?>   