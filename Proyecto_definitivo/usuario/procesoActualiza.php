<?php 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
	$obj= new crud();
   
	$datos=array( 
		"Id_usuario"   => $_POST['Id_usuario'],
		"Num_empleado" =>$_POST['Num_empleado'],
		"Usuario_r"    =>$_POST['Usuario_r'], 
		"Gerencia"     =>$_POST['Gerencia'],
		"Puesto"       =>$_POST['Puesto'],
		"Zona"         => $_POST['Zona'],
		"Ubicacion"    => $_POST['Ubicacion']
		);
	echo $obj->actualizar($datos); 
 ?>    