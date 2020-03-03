<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
   
	$datos=array(
		"Id_modelo"     =>$_POST['Id_modelo'], 
		"Marca_r"       =>$_POST['Marca_r'],  
		"Modelo_r"        =>$_POST['Modelo_r'],
		"NombreRadio"   =>$_POST['NombreRadio']
	              );
	echo $obj->actualizar($datos);  
 ?>     