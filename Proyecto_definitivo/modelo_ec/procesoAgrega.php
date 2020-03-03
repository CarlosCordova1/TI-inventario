<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud(); 
    
	$datos=array(
		"Marca"       =>$_POST['Marca'], 
		"Modelo"      =>$_POST['Modelo'], 
		"Color"       =>$_POST['Color'], 
		"SKU"         =>$_POST['SKU'], 
		"NombreModelo"=>$_POST['NombreModelo']
	              );
	echo $obj->agregar($datos);
 ?>       