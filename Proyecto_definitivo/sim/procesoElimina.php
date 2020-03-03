<?php 
	
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";

	$obj= new crud();  
 
	$sql="SELECT Id_linea, Id_Sim, Telefono 
	from inf_linea where Id_Sim='".$_POST['Id_Sim']."' limit 1";
	$result=$obj->executeQuery($sql);

	if(mysqli_num_rows($result) >0){
		echo 'El sim tiene asignado <img width="15%" src="../accesorios/x.gif"/>';
	}else{
		echo $obj->eliminar($_POST['Id_Sim']); 
	}
 
  
 ?>   