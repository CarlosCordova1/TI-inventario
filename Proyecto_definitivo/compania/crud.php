<?php 
  
class crud{ 
     // table Compañia
    public function agregar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();  

        $sql="INSERT INTO compania ( Compania)  VALUES ('$datos[0]')";
        return mysqli_query($conexion,$sql);
    }
    public function obtenDatos($Idcompania){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT Id_Compania, Compania 
                from compania where Id_Compania='$Idcompania'";

        $result=mysqli_query($conexion,$sql);
        $ver=mysqli_fetch_row($result);

        $datos=array(
            'Id_Compania' => $ver[0],  
            'Compania' => $ver[1]
                    );
        return $datos; 
    }

    public function actualizar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();
        //actualizar los registros
        $sql="UPDATE compania SET Compania ='$datos[0]' WHERE Id_Compania ='$datos[1]'";
        return mysqli_query($conexion,$sql);
    }

//Eliminar los registro
    public function eliminar($id_Compania ){ 
        $obj= new conectar();
        $conexion=$obj->conexion();
        mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
        $sql="DELETE from Compania where Id_Compania='$id_Compania'";
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

?> 