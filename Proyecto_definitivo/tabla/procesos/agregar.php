<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();
//optimizar  
	$datos=array(
		"Serie"=>$_POST['Serie'],  
		"IMEI"=>$_POST['IMEI'],
		"NombreModelo"=>$_POST['NombreModelo'],
		"Cargador"=>$_POST['Cargador'], 
		
		"Equipo_anterior"=>$_POST['Equipo_anterior'],
		"Descripcion"=>$_POST['Descripcion'],
		"NumTel"=>$_POST['NumTel'], 
		"Id_modelo"=>$_POST['NombreModelo'],
		"Estado"=>$_POST['Estado'],
		"Id_estatus"=>$_POST['Estado'],
		"Accesorios"=>(isset($_POST['Accesorios']) ? $_POST['Accesorios'] :null)
				);
		echo $obj->agregar($datos);
 ?>  