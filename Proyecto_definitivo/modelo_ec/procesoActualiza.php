<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
    
	$datos=array( 
		"Id_modelo"   =>$_POST['Id_modelo'], 
		"Marca"       =>$_POST['Marca'],  
		"Modelo"      =>$_POST['Modelo'], 
		"Color"       =>$_POST['Color'], 
		"SKU"         =>$_POST['SKU'], 
		"NombreModelo"=>$_POST['NombreModelo']
	              ); 
	echo $obj->actualizar($datos);  
 ?>    