<?php 
  
class crud{ 
     // table estado 
    public function agregar($datos){ 
        $obj= new conectar();
        $conexion=$obj->conexion();  

        $sql="INSERT INTO estado ( Estado_r)  VALUES ('$datos[0]')";
        return mysqli_query($conexion,$sql);
    }
    public function obtenDatos($Idestado){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT Id_estado, Estado_r 
                from estado where Id_estado='$Idestado'";

        $result=mysqli_query($conexion,$sql);
        $ver=mysqli_fetch_row($result);

        $datos=array(
            'Id_estado' => $ver[0],  
            'Estado_r' => $ver[1]
                    );
        return $datos; 
    }

    public function actualizar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();
        //actualizar los registros
        $sql="UPDATE estado SET Estado_r ='$datos[0]' WHERE Id_estado ='$datos[1]'";
        return mysqli_query($conexion,$sql);
    }
 
//Eliminar los registro
    public function eliminar($id_estado ){ 
        $obj= new conectar();
        $conexion=$obj->conexion();
        mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
        $sql="DELETE from estado where Id_estado='$id_estado'";
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