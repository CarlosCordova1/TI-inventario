<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
	$datos=array(
		"Estatus"=>$_POST['Estatus'], 
		"Id_empleado"=>$_POST['idUsuario'],
		"MotivoBaja"=>$_POST['MotivoBaja'],
		"Id_celular"=>$_POST['EqCel']
	);

	echo $obj->Baja($datos);  
 ?>  