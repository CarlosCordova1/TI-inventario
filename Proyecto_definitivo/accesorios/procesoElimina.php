<?php 
	 
	require_once "../tabla/clases/conexion.php";
	require_once "crud.php";

	$obj= new crud();   
 
		/*validar dependencias */

		$sql="SELECT ec.Id_celular,ec.Serie,acc.Accesorio,acc.Id_Accesorios from  equipo_celular as ec 
		inner join  asignaAccesorio as aAg on ec.Id_celular=aAg.Id_celular
		inner join accesorios as acc on aAg.id_accesorios=acc.Id_Accesorios 
				where acc.Id_Accesorios='".$_POST['Id_Accesorios']."'";
		$result=$obj->executeQuery($sql);

		if(mysqli_num_rows($result) > 0){
			echo 'El accesorio tiene asignados <img width="15%" src="accesorios/x.gif"/>';
		}else{
			echo $obj->eliminar($_POST['Id_Accesorios']); 
		}
		 

 ?> 