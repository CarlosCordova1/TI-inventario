<?php 
  
class crud{ 
     // table modelo 
    public function agregar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();   

        $sql="INSERT INTO modelo   VALUES (0,
        '".$datos['Marca_r']."',     '".$datos['Modelo_r']."',
        '".$datos['NombreRadio']."')";
        return mysqli_query($conexion,$sql);
    }
    public function obtenDatos($Idmodelo){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT Id_modelo, Marca_r, Modelo_r, NombreRadio
        from modelo where Id_modelo='$Idmodelo'";

        $result=mysqli_query($conexion,$sql);
        $ver=mysqli_fetch_row($result);

        $datos=array(
            'Id_modelo' => $ver[0],  
            'Marca_r' => $ver['Marca_r'],
            'Modelo_r' => $ver['Modelo_r'],
            'NombreRadio' => $ver['NombreRadio']
                    );
        return $datos; 
    }
    public function actualizar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();
        //actualizar los registros
        $sql="UPDATE modelo SET Marca_r='".$datos['Marca_r']."',         Modelo_r='".$datos['Modelo_r']. "',
                                NombreRadio='".$datos['NombreRadio']."' 
                                WHERE Id_modelo=".$datos['Id_modelo'].";";
                                return $sql;
                                
        return mysqli_query($conexion,$sql);
    }
//Eliminar los registro
    public function eliminar($id_modelo ){  
        $obj= new conectar();
        $conexion=$obj->conexion();
        mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
        $sql="DELETE from modelo where Id_modelo='$id_modelo'";
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
