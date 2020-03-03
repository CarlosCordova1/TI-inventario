<?php
require_once "../tabla/clases/conexion.php";
require_once "crud.php";

$obj= new crud();

echo $obj->apiConecta('USUARIOS',$_POST['Id_usuario']);  //no hace falta encodificarlo a json, la api lo devuelve en json

?>