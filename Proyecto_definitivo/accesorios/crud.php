<?php 
 
	class crud{
		 // table accesorio  
		public function agregar($datos){ 
			$obj= new conectar();
			$conexion=$obj->conexion();  

			/* accesorio*/
			$sql="INSERT into accesorios (Accesorio, Descripcion)
									values ('$datos[0]',
											'$datos[1]')";
			return mysqli_query($conexion,$sql);
		}
 
		public function obtenDatos($idAccesorio){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT Id_Accesorios, Accesorio, Descripcion
					from accesorios where Id_Accesorios='$idAccesorio'";

			
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'Id_Accesorios' => $ver[0],
				'Accesorio'=>$ver[1], 
				'Descripcion' => $ver[2]);
			return $datos; 
		}

		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();
			//actualizar los registros
			$sql="UPDATE accesorios set Accesorio='$datos[0]',
										Descripcion='$datos[1]'
										 where Id_Accesorios='$datos[2]'";
			//return $sql;
			return mysqli_query($conexion,$sql);
		}


 

    //Eliminar los registro
		public function eliminar($Id_Accesorios ){ 
			$obj= new conectar();
			$conexion=$obj->conexion();

			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
			$sql="DELETE from accesorios where Id_Accesorios='$Id_Accesorios'";
			$res=mysqli_query($conexion,$sql);
			$res=mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
			return $res;
		}

		//ejecuta query

		public function executeQuery($query){
			$obj= new conectar();
			return mysqli_query($obj->conexion(),$query);
		}
	}

 ?> 