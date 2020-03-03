<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php"; 
	$obj= new crud();
//  
	$datos=array(
		"Sim"=>$_POST['Sim'],
		"Descripcion"=>$_POST['Descripcion'],
		"Estado"=>$_POST['Estado']
				);   
	echo $obj->agregar($datos);  
 ?>   