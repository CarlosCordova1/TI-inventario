<?php 
	
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";
 
	$obj= new crud();   
 
	/* Validar la dependencia*/

$sql="SELECT Id_radio,Id_estado,Marca  
	from equipo_radio where Id_estado= '".$_POST['Id_estado']."'limit 1"  ;
   $result=$obj->executeQuery($sql);
 
 if (mysqli_num_rows($result) > 0){
	echo 'El estado tiene asignados <img width="15%" src="../accesorios/x.gif"/>';
 }else{
	echo $obj->eliminar($_POST['Id_estado']); 
}   
 ?>   