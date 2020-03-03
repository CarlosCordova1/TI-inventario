<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud(); 
  
	$datos=array(
		"Id_Sim"=>$_POST['Id_Sim'],
		"Sim"=>$_POST['Sim'], 
		"Descripcion"=>$_POST['Descripcion'],
		"Estado"=>$_POST['Estado']
				); 
	echo $obj->actualizar($datos);
 ?>    