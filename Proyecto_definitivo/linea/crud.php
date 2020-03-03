<?php 
 
	class crud{ 
		 // table Inf_linea 
		public function agregar($datos){ 
			$obj= new conectar();
			$conexion=$obj->conexion();  
			//ingresar los datos Inf_liena  
			$sql="INSERT into inf_linea values (0,".$datos["Id_Sim"].",       ".$datos["Id_Compania"].",
												".$datos['Telefono'].",       '".$datos['Estado']."', '".$datos['Descripcion_L']."',   
												 '".$datos['Contrato']."',    '".$datos['Fecha_recepcion']."',   
												 '".$datos['Fecha_plazo_forzoso']."');";
			$insertSql=mysqli_query($conexion,$sql);
			return $insertSql;
		}

		public function obtenDatos($idlinea){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT il.Id_linea, il.Id_Sim, il.Id_Compania, il.Telefono, il.Estado, il.Descripcion_L, il.Contrato, il.Fecha_recepcion, il.Fin_plazo_forzoso,
			s.Sim, c.Compania
			from inf_linea as il
			inner join sim as s on il.Id_Sim=s.Id_Sim
			inner join compania as c on c.Id_Compania= il.Id_Compania where il.Id_linea='$idlinea'";

			$result=mysqli_query($conexion,$sql); 
			$ver=mysqli_fetch_array($result);

			$datos=array(
				'Id_linea' => $ver['Id_linea'],
				'Telefono'=>$ver['Telefono'],
				'Estado'=>$ver['Estado'],
				'Descripcion_L'=>$ver['Descripcion_L'],
				'Contrato'=>$ver['Contrato'],  
			    'Fecha_recepcion'=>$ver['Fecha_recepcion'],
				'Fin_plazo_forzoso'=>$ver['Fin_plazo_forzoso'],
				'Id_Sim' => $ver['Id_Sim'],
				'Sim' => $ver['Sim'],
				'Id_Compania' => $ver['Id_Compania'],
				'Compania' => $ver['Compania']);
			return $datos; 
		} 
 
		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();

			// quitar seguridad de clave foranea
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS=0'); 
			//actualizar los registros
			$sql="UPDATE inf_linea set
			Id_Sim=".$datos["Id_Sim"].",       Id_Compania=".$datos["Id_Compania"].", 
			Telefono=".$datos['Telefono'].",   Estado='".$datos['Estado']."',
			Descripcion_L='".$datos['Descripcion_L']."', Contrato='".$datos['Contrato']."',
			Fecha_recepcion='".$datos['Fecha_recepcion']."', Fin_plazo_forzoso='".$datos['Fin_plazo_forzoso']."'
			where Id_linea=".$datos['Id_linea'].";";
            // activar seguridad de clave foranea una vez insertado el equipo
			$resultSql=mysqli_query($conexion,$sql);
	    mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
			 return $resultSql;
		}

    //Eliminar los registro
		public function eliminar($Id_linea ){ 
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sqlConsulta="SELECT il.Id_linea,il.Telefono,
			ec.Serie 
		   from inf_linea as il 
		   inner join equipo_celular as ec on  il.Id_linea=ec.Id_linea 
		   where il.Id_linea=$Id_linea limit 1;";
			$sqlConsultaResult=mysqli_query($conexion, $sqlConsulta);
			$registroResult= mysqli_fetch_array($sqlConsultaResult);
			// Validamos si no tiene relaciones ese registro.
			if(isset($registroResult)){
 
				return "Tiene equipos vinculados <img src='../accesorios/x.gif' width='15%' />";
			}else{
				mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
				$sqlDelete="DELETE from Inf_linea where Id_linea='$Id_linea'";
				$resDeleteResult=mysqli_query($conexion, $sqlDelete);
				mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
				return $resDeleteResult;
			}
		}


		//ejecutar query
		public function executeQuery($query){
			$obj= new conectar ();
			return mysqli_query ($obj->conexion(),$query);
		}
	}

 ?> 