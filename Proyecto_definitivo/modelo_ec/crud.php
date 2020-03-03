<?php 
  
class crud{ 
     // table modelo 
    public function agregar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();   

        $sql="INSERT INTO modelo_ec   VALUES (0,
        '".$datos['Marca']."',     '".$datos['Modelo']."',
        '".$datos['Color']."',     '".$datos['SKU']."',
        '".$datos['NombreModelo']."'
        );";
        return mysqli_query($conexion,$sql);
    }
    public function obtenDatos($Idmodelo){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT Id_modelo, Marca, Modelo, Color, SKU, NombreModelo 
                from modelo_ec where Id_modelo=$Idmodelo";
              
        $result=mysqli_query($conexion,$sql);
        $ver=mysqli_fetch_array($result);

        $datos=array(
            'Id_modelo' => $ver['Id_modelo'],  
            'Marca' => $ver['Marca'],
            'Modelo' => $ver['Modelo'],
            'Color' => $ver['Color'],
            'SKU' => $ver['SKU'],
            'NombreModelo' => $ver['NombreModelo']);
        return $datos; 
    }
    public function actualizar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();
        //actualizar los registros
        $sql="UPDATE modelo_ec SET 
                     Marca='".$datos['Marca']."',             Modelo='".$datos['Modelo']. "',
                     Color='".$datos['Color']."',             SKU='".$datos['SKU']."',
                     NombreModelo='".$datos['NombreModelo']."'
                     where Id_modelo=".$datos['Id_modelo'].";";
                     //return $sql;
        return mysqli_query($conexion,$sql);
    }
//Eliminar los registro
    public function eliminar($id_modelo ){  
        $obj= new conectar();
        $conexion=$obj->conexion();
        mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
        $sql="DELETE from modelo_ec where Id_modelo='$id_modelo'";
        $res=mysqli_query($conexion, $sql);
        mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
        return $res;
    }
    //ejecutar query
    public function executeQuery($query){
        $obj= new conectar ();
        return mysqli_query ($obj->conexion(),$query);
    }
}
