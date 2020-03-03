<?php 

	class crud{
  //Eliminar los registro
  public function eliminar($datos ){ 
	$obj= new conectar();
	$conexion=$obj->conexion(); 
	//Eliminamos el equipo
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
	  	$sqlDeleteEquipo="DELETE FROM equipo_celular WHERE Id_celular=$datos";
		  $resultDeleteEquipo=mysqli_query($conexion,$sqlDeleteEquipo);
		  mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
	//Eliminamos accesorios asignados
	//Consulta para validar si tiene accesorios registrados en base de datos
	$sqlGetAcc="SELECT asig.Id_celular,Id_Accesorios from equipo_celular as ec inner join asignaaccesorio asig
	on ec.Id_celular=asig.Id_celular
	where ec.Id_celular=".$datos." limit 1;";
	$resultGetAcc=mysqli_query($conexion,$sqlGetAcc);	
	$listGetAcc =mysqli_fetch_assoc($resultGetAcc);

//Si tiene accesorios los elimina para crear unos nuevos como actulización
	if(isset($listGetAcc)){
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
		$sqlDeleteAcc=" delete from asignaaccesorio where Id_celular=".$datos.";";
		$resultDeleteAcc=mysqli_query($conexion,$sqlDeleteAcc);
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
		return $resultDeleteAcc;
	}else{
		return $resultDeleteEquipo;
	}
	} 

public function agregar($datos){
	$obj= new conectar();
	$conexion=$obj->conexion();
//buscar el id_linea por el numero de telefono 	
		$obtenID_inf_linea="SELECT Id_linea from inf_linea where Telefono=".$datos['NumTel']." limit 1;";
		$id_inf_result=mysqli_query($conexion,$obtenID_inf_linea);
		$id_inf =mysqli_fetch_assoc($id_inf_result);
// mandamos mensaje si el numero no se encuentra registrado en la base de datos
		if(!isset($id_inf)){return "El numero de telefono no esta registrado <img width='15%' src='accesorios/x.gif'>";}

// quitar seguridad de clave foranea
		mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS=0');
//inserta equipo celular 
		$insertaEquipoCel="INSERT into equipo_celular values (0, 
						  ".$id_inf["Id_linea"].",          ".$datos["Id_modelo"].",   
						  '".$datos['Serie']."',            ".$datos['IMEI'].",         
						  '".$datos['Cargador']."',         '".$datos['Estado']."',     
						  '".$datos['Equipo_anterior']."', '".$datos['Descripcion']."');";
		$insert=mysqli_query($conexion,$insertaEquipoCel);
// activar seguridad de clave foranea una vez insertado el equipo
	mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
	
//obtiene id insertado 
		$ObtieneID_Insert="SELECT Id_celular from equipo_celular  order by Id_celular desc limit 1";
		$idEquipoCel_result=mysqli_query($conexion,$ObtieneID_Insert);
		$idEquipoCel=mysqli_fetch_assoc($idEquipoCel_result);
		
	if(isset($datos['Accesorios'])){
		if($insert==1){
			for($contador=0; $contador < count($datos['Accesorios']); $contador++ ){
			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
			$insertAcc="INSERT into asignaaccesorio values(0,".$idEquipoCel['Id_celular'].",". $datos['Accesorios'][$contador]." )";
			$insertAccResult=mysqli_query($conexion,$insertAcc);
			mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
			}
			return $insertAccResult;
		}
	}else{
		
		return $insert;
	}
}

		public function obtenDatos($Idcelular){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT ec.Id_celular,ec.Id_linea, ec.Id_modelo,  ec.Serie,ec.IMEI,
			 ec.Cargador, ec.Estado, ec.Equipo_anterior, ec.Descripcion,
			il.Telefono, m.NombreModelo
			FROM equipo_celular as ec
			inner join Inf_linea as il on ec.Id_linea=il.Id_linea 
			inner join Modelo_ec as m on m.Id_modelo=ec.Id_modelo 
		                             where ec.Id_celular=$Idcelular";

			$result=mysqli_query($conexion,$sql); 
			$ver=mysqli_fetch_array($result);

			$datos=array(
				'Id_celular'      => $ver['Id_celular'],
				'Serie'           => $ver['Serie'],
				'IMEI'            => $ver['IMEI'],
				'Cargador'        => $ver['Cargador'],
				'Estado'          => $ver['Estado'],
				'Equipo_anterior' => $ver['Equipo_anterior'],
				'NumTel'          => $ver['Telefono'], 
				'Descripcion'     => $ver['Descripcion'], 
				'Id_modelo'       => $ver['Id_modelo'],
				'NombreModelo'    => $ver['NombreModelo']);

			$ConsultaAcc="SELECT ac.Id_Accesorios,ac.Accesorio from equipo_celular ec inner join  asignaaccesorio asig
			on ec.Id_celular=asig.Id_celular
			inner join accesorios ac on asig.Id_Accesorios=ac.Id_Accesorios
			where ec.Id_celular=$Idcelular";
			$resultAcc=mysqli_query($conexion,$ConsultaAcc);
			$accesorios=[]; $cont=0;
			while($filaAcc=mysqli_fetch_array($resultAcc)){
					$accesorios[$cont]=$filaAcc;
					$cont++;
			}
			$datos["ListaAccesorio"]=$accesorios;
			return $datos; 
		}

		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();

		//buscar el id_linea por el numero de telefono 	
				$obtenID_inf_linea="SELECT Id_linea from inf_linea where Telefono=".$datos['NumTel']." limit 1;";
				$id_inf_result=mysqli_query($conexion,$obtenID_inf_linea);
				$id_inf =mysqli_fetch_assoc($id_inf_result);
				
		// mandamos mensaje si el numero no se encuentra registrado en la base de datos
				if(!isset($id_inf)){return "El numero de telefono no esta registrado <img width='15%' src='accesorios/x.gif'>";}


		//Actualiza Equipos de accesorios				
				$sqlUpdateEquipos="UPDATE equipo_celular set
					Id_linea=".$id_inf["Id_linea"].",                 Id_modelo=".$datos["Id_modelo"].",   
					Serie='".$datos['Serie']."',                      IMEI=".$datos['IMEI'].",                  
					Cargador='".$datos['Cargador']."',                Estado='".$datos['Estado']."',      
					Equipo_anterior='".$datos['Equipo_anterior']."',  Descripcion='".$datos['Descripcion']."'
								   where Id_celular=".$datos['Id_celular'].";";	
				$resultUpEqui=mysqli_query($conexion,$sqlUpdateEquipos);
					

			if($resultUpEqui==1){  // valida si la actualizacion de equipo sale exitosa

		// Consulta para validar si tiene accesorios registrados en base de datos
				$sqlGetAcc="SELECT asig.Id_celular,Id_Accesorios from equipo_celular as ec inner join asignaaccesorio asig
				on ec.Id_celular=asig.Id_celular
				where ec.Id_celular=".$datos['Id_celular']." limit 1;";
				$resultGetAcc=mysqli_query($conexion,$sqlGetAcc);	
				$listGetAcc =mysqli_fetch_assoc($resultGetAcc); 

		//Si tiene accesorios los elimina para crear unos nuevos como actulización
				if(isset($listGetAcc)){
					mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
					$sqlDeleteAcc=" delete from asignaaccesorio where Id_celular=".$datos['Id_celular'].";";
					$resultDeleteAcc=mysqli_query($conexion,$sqlDeleteAcc);
					mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
				}
				if(isset($_POST['AccesoriosU'])){
		//insertamos los accesorios en caso de haber..
				for($contador=0; $contador < count($datos['Accesorios']); $contador++ ){
					mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
					$insertAcc="insert into asignaaccesorio values(0,".$datos['Id_celular'].",". $datos['Accesorios'][$contador]." )";
					$insertAccResult=mysqli_query($conexion,$insertAcc);
					mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 1');
					}
					return $insertAccResult;
				}else{
					return $resultUpEqui;
				}
		}else{
			return $resultUpEqui;
		}
	}

		//ejecuta query
		public function executeQuery($query){
			$obj= new conectar();
			return mysqli_query($obj->conexion(),$query);
		}
		public function uno (){
			return 1;
		}
}
