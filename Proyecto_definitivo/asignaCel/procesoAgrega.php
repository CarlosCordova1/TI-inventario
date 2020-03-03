<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
	$datos=array(
		"Id_empleado"=>$_POST['AsigUsuario'], 
		"Estatus"=>$_POST['Estatus'], 
		"Id_celular"=>$_POST['EqCel']);

	echo $obj->agregar($datos);  
 ?>  