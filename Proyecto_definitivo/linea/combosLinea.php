<?php
require_once "../tabla/clases/conexion.php";
require_once "crud.php";


 
if(isset($_POST['Id_linea'])!=0){
   echo json_encode(comboSimActualiza($_POST['Id_linea']));
}
else if($_POST['Id_linea']==0){
    echo json_encode(comboSimAgrega());
}

function comboSimActualiza($Id_linea){
    $obj= new conectar();
 $conexion=$obj->conexion();  
 $sql="SELECT s.Id_Sim, s.Sim from sim s 
 where s.Id_Sim not in(SELECT Id_Sim from inf_linea where Id_linea <> $Id_linea )";
$ejectuta=mysqli_query($conexion,$sql);
$cont=0;
while($result=mysqli_fetch_array($ejectuta)){
    $lista[$cont]['Id_Sim']=$result['Id_Sim'];
    $lista[$cont]['Sim']=$result['Sim'];
    $cont++;
}
return $lista;
}

function comboSimAgrega(){
    $obj= new conectar();
 $conexion=$obj->conexion();  
    $sql="SELECT Id_Sim,Sim from sim s where s.Id_Sim not in (SELECT Id_Sim from inf_linea);";
    $ejectuta=mysqli_query($conexion,$sql);
    $cont=0;

    while($result=mysqli_fetch_array($ejectuta)){
        $lista[$cont]['Id_Sim']=$result['Id_Sim'];
    $lista[$cont]['Sim']=$result['Sim'];
    $cont++;
    }
    return $lista;
    }

?>