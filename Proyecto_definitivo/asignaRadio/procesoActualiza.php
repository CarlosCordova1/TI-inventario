<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
   
	$datos=array(
		"Id_usuario"=>$_POST['idUsuarioRad'], 
		"Id_radio"=>$_POST['asigEqRad'], 
		"Estatus"=>$_POST['Estatus']);
	echo $obj->actualizar($datos); 
 ?>    