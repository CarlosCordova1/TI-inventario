<?php  
	class crud{  
		 // table usuario
		public function agregar($datos){ 
			$obj= new conectar();
 			$conexion=$obj->conexion();  

			//ingresar los datos usuario  ".$datos["IdUser_linea"].",  
			$sql="INSERT into usuario values (0,  ".$datos['Num_empleado'].",  
			  '".$datos['Usuario_r']."',   '".$datos["Gerencia"]."',
			  '".$datos['Puesto']."',      '".$datos['Zona']."',
			  '".$datos['Ubicacion']."');";
			$insertSql=mysqli_query($conexion,$sql);
			return $insertSql;
		}

		public function obtenDatos($idusuario){
			$obj= new conectar();
			$conexion=$obj->conexion();
                                      
			$sql="SELECT us.Id_usuario, us.Num_empleado, us.Usuario_r, us.Gerencia, us.Puesto, 
			us.Zona, us.Ubicacion
			from usuario as us where us.Id_usuario=$idusuario"; 

			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_array($result);

			$datos=array(
				'Id_usuario' => $ver['Id_usuario'],
				'Num_empleado'=>$ver['Num_empleado'],
		        'Usuario_r'=>$ver['Usuario_r'], 
		        'Gerencia'=>$ver['Gerencia'],
		        'Puesto'=>$ver['Puesto'],
		        'Zona' => $ver['Zona'],
		        'Ubicacion' => $ver['Ubicacion']
				);
			return $datos; 
		} 
  
		public function actualizar($datos){
			$obj= new conectar(); 
			$conexion=$obj->conexion();
			
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS=0');
			//actualizar los registros    
			$sql="UPDATE usuario set
			Num_empleado=".$datos['Num_empleado'].",  Usuario_r='".$datos['Usuario_r']."', 
			Gerencia='".$datos['Gerencia']."',        Puesto='".$datos['Puesto']."',
			Zona='".$datos['Zona']."',                Ubicacion='".$datos['Ubicacion']."' 
			where Id_usuario= ".$datos['Id_usuario'].";";
			//return $sql;
			// activar seguridad de clave foranea una vez insertado el equipo
		//return $sql;
			$resultSql=mysqli_query($conexion,$sql);
	    mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
			 return $resultSql;
		} 

    //Eliminar los registro
		public function eliminar($Id_usuario ){ 
			$obj= new conectar();
			$conexion=$obj->conexion();
			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
			$sql="DELETE from usuario where Id_usuario='$Id_usuario'";
			$res=mysqli_query($conexion, $sql);
			mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
			return $res;
		}
		//ejecutar query
		public function executeQuery($query){
			$obj= new conectar ();
			return mysqli_query ($obj->conexion(),$query);
		}

		//
		// consulta ApiConexion
		public function apiConecta($recurso,$valorEnvia=''){
			$obj= new conectar();
			$conexion=$obj->conexion();  

		   //ingresar los datos usuario  
		   $sql="SELECT Recurso,Url,Metodo,Action,Tkn,CampoEnvia from cat_apiconex
			where Recurso='".$recurso."';";
		   $resSql=mysqli_query($conexion,$sql);
		   if($resSql->num_rows >0){
			$datosApi=mysqli_fetch_array($resSql);
				$url=$datosApi['Url'];
				$metodo=$datosApi['Metodo'];
				$action=$datosApi['Action'];
				$tkn=$datosApi['Tkn'];
				$campoEnvia=$datosApi['CampoEnvia'];
				// envia peticion
					
				// se valida si la api registrada require clave y contraseña
					if(isset($action) && isset($campoEnvia) && isset($valorEnvia)){
						$data = array("action" => $action,$campoEnvia=>$valorEnvia,"tkn"=>$tkn);
					
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// se evia el metodo del api a emplear
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);
					//enviamos el array data
					curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
					//obtenemos la respuesta
					$response = curl_exec($ch);
					// Se cierra el recurso CURL y se liberan los recursos del sistema
					curl_close($ch);
					}
					// si la api no requiere clave y contraseña, es publica
					else{
					$response = file_get_contents($url);
					}
					if(!$response) {
						return false;
					}else{
						return $response;
					}
			}

		 //  return $datosApi;
	   }
	}
