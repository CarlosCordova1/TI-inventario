<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
   
	$datos=array(  
		"Id_radio"=>$_POST['Id_radio'], 
		"Num_radio"=>$_POST['Num_radio'], 
		"Num_serie"=>$_POST['Num_serie'],
        "Num_sap"=>$_POST['Num_sap'], 
		"Fecha_inicio"=>$_POST['Fecha_inicio'],
		"Fecha_final"=>$_POST['Fecha_final'],
		"Descripcion"=>$_POST['Descripcion'],
		"Id_modelo"=>$_POST['NombreRadio'],
		"Id_estado"=>$_POST['Estado_r']
		);
	echo $obj->actualizar($datos); 
 ?>    