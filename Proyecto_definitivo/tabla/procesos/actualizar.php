<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();
    
	$datos=array( 
		"Id_celular"=>$_POST['Id_celular'],
		"Serie"=>$_POST['Serie'],  
		"IMEI"=>$_POST['IMEI'],
		"NombreModelo"=>$_POST['NombreModelo'],
		"Cargador"=>$_POST['Cargador'], 
		"Id_estatus"=>$_POST['Estado'],
		"Equipo_anterior"=>$_POST['Equipo_anterior'],
		"Descripcion"=>$_POST['Descripcion'],
		"NumTel"=>$_POST['NumTel'], 
		"Id_modelo"=>$_POST['NombreModelo'],
		"Estado"=>$_POST['Estado'],
		"Accesorios"=>(isset($_POST['AccesoriosU']) ? $_POST['AccesoriosU'] :null)
				);

		echo $obj->actualizar($datos); 
 ?> 