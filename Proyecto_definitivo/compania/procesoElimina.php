<?php 
	
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
 
	$obj= new crud();   
 
	/* Validar la dependencia*/

	
	$sql="SELECT Id_linea, Id_Compania, Telefono 
	from inf_linea where Id_Compania= '".$_POST['Id_Compania']."' limit 1";
   $result=$obj->executeQuery($sql);
 
 if (mysqli_num_rows($result) > 0){
	echo 'La compañia tiene asignados <img width="15%" src="../accesorios/x.gif"/>';
 }else{
	echo $obj->eliminar($_POST['Id_Compania']); 
} 
 ?>  