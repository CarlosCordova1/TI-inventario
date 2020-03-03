<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
    
	$datos=array(
		"Marca_r"       =>$_POST['Marca_r'], 
		"Modelo_r"        =>$_POST['Modelo_r'],
		"NombreRadio"   =>$_POST['NombreRadio']
	              );
	echo $obj->agregar($datos);
 ?>       