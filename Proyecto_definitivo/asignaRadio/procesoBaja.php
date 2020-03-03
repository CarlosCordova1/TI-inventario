<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
	$datos=array(
		"Estatus"=>$_POST['Estatus'], 
		"idUsuario"=>$_POST['idUsuarioRad'],
		"MotivoBaja"=>$_POST['MotivoBaja'],
		"Id_radio"=>$_POST['asigEqRad']
	);

	echo $obj->Baja($datos);  
 ?>  