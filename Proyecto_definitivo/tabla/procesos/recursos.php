<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";


/*funciones */
if($_POST['recurso']=='searchNumPhone'){

    echo searchNumPhone();
     
}

 function searchNumPhone(){
	$obj= new crud();
	 $sql="SELECT Telefono from inf_linea where Id_linea not in (select Id_linea from equipo_celular) and
	  Telefono like '".$_POST['numTel']."%' limit 6;";
	 $result=$obj->executeQuery($sql);
	 $array=[]; $i=0;
	 while($data=mysqli_fetch_array($result)){
		 $array[$i]=$data[0];
		 $i++; 
	 }
	 return  json_encode($array);
	 

}

?>