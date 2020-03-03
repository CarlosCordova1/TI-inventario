<?php   
	class crud{ 
		 // table Radio
		public function agregar($datos){
			$obj= new conectar();
 			$conexion=$obj->conexion();   

			//ingresar los datos Radio  
			$sql="INSERT into equipo_radio values (0,
			             ".$datos["Id_modelo"].",      ".$datos["Id_estado"].",
						 ".$datos['Num_radio'].",      '".$datos['Num_serie']."',
						 '".$datos['Num_sap']."',      '".$datos['Fecha_inicio']."', 
						 '".$datos['Fecha_final']."',  '".$datos['Descripcion']."');";
						 //return $sql;
			$insertSql=mysqli_query($conexion,$sql);
			return $insertSql;
		}

		public function obtenDatos($idradio){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT er.Id_radio, er.Id_modelo, er.Id_estado, er.Num_radio, er.Num_serie, er.Num_sap,er.Descripcion, er.Fecha_inicio, er.Fecha_final,
			m.NombreRadio, e.Estado_r
					   from equipo_radio as er
					   inner join modelo as m on er.Id_modelo=m.Id_modelo
					   inner join estado as e on e.Id_estado= er.Id_estado where er.Id_radio=$idradio";

			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_array($result);
//
			$datos=array(
				'Id_radio' => $ver['Id_radio'],
				'Num_radio'=>$ver['Num_radio'],
				'Num_serie'=>$ver['Num_serie'], 
			    'Num_sap'=>$ver['Num_sap'], 
				'Fecha_inicio' => $ver['Fecha_inicio'],
				'Fecha_final' => $ver['Fecha_final'],
				'Descripcion' => $ver['Descripcion'],
				'Id_modelo' => $ver['Id_modelo'],
				'NombreRadio' => $ver['NombreRadio'],
				'Id_estado' => $ver['Id_estado'],
				'Estado_r' => $ver['Estado_r']);
			return $datos; 
		} 
 
		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();
			
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS=0');
			//actualizar los registros 
			$sql="UPDATE equipo_radio set
						Id_modelo=".$datos["Id_modelo"].",       Id_estado=".$datos["Id_estado"].",
						Num_radio=".$datos['Num_radio'].",       Num_serie='".$datos['Num_serie']."', 
						Num_sap='".$datos['Num_sap']. "',        Fecha_inicio='".$datos['Fecha_inicio']."', Fecha_final='".$datos['Fecha_final']."', Descripcion='".$datos['Descripcion']."'
			            where Id_radio= ".$datos['Id_radio'].";";
            // activar seguridad de clave foranea una vez insertado el equipo
			$resultSql=mysqli_query($conexion,$sql);
	    mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
			 return $resultSql;
		}

    //Eliminar los registro
		public function eliminar($Id_radio ){ 
			$obj= new conectar();
			$conexion=$obj->conexion();
			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
			$sql="DELETE from equipo_radio where Id_radio='$Id_radio'";
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
