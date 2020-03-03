<?php 
   
	class crud{
		 // sim
		public function agregar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();  
 
			/**/
			$sql="INSERT into sim values (0, ".$datos["Sim"].", 
											 '".$datos['Estado']."', 
											 '".$datos['Descripcion']."')";
											
			return  mysqli_query($conexion,$sql);
		}
 
		public function obtenDatos($idSim){
			$obj= new conectar();
			$conexion=$obj->conexion(); 
			$sql="SELECT Id_Sim, Sim,Descripcion,Estado
            from sim where Id_Sim=$idSim";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_array($result);

			$datos=array(
				'Id_Sim' => $ver['Id_Sim'],
				'Sim'=>$ver['Sim'], 
				'Descripcion' => $ver['Descripcion'],
				'Estado'=> $ver['Estado'] );
			return $datos; 
		}

		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();

			mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS=0');
			//actualizar los registros
			$sql="UPDATE sim set 
							Sim=".$datos['Sim'].",
							Descripcion='".$datos['Descripcion']."',
							Estado='".$datos['Estado']."'
			                where Id_Sim= ".$datos['Id_Sim'].";";
		//	return $sql;
			$resultSql=mysqli_query($conexion, $sql);
			mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS = 1');
			return ($resultSql);

		}

    //Eliminar los registro
		public function eliminar($Id_Sim ){ 
			$obj= new conectar();
			$conexion=$obj->conexion();
			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
			$sql="DELETE from sim where Id_Sim='$Id_Sim'";
			$res=mysqli_query($conexion, $sql);
			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
			return $res;
		}
			//ejecutar query
		public function executeQuery($query){
			$obj= new conectar ();
			return mysqli_query ($obj->conexion(),$query);
		}
	} 
 ?>  