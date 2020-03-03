<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
	$datos=array(
		"Telefono"=>$_POST['Telefono'], 
		"Estado"=>$_POST['Estado'],
		"Descripcion_L"=>$_POST['Descripcion_L'],
		"Contrato"=>$_POST['Contrato'], 
		"Fecha_recepcion"=> $_POST['Fecha_recepcion'],
		"Fecha_plazo_forzoso"=>$_POST['Fin_plazo_forzoso'],
	    "Id_Sim"=>$_POST['Sim'],
		"Id_Compania"=>$_POST['Compania']);
	echo $obj->agregar($datos);  
 ?>  