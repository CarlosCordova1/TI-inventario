<?php 
  
class crud{ 

    public function obtenDatos($IdEmpleado){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT Id_celular,Id_empleado,registro,Estatus from celular_usuarios where Id_empleado=".$IdEmpleado.";";

        $result=mysqli_query($conexion,$sql);
        $ver=mysqli_fetch_array($result);
        if(isset($ver)){
            $datos=array(
                'Id_empleado' => $ver['Id_empleado'],
                'Id_celular' => $ver['Id_celular'],  
                'registro' => $ver['registro'],
                'Estatus' => $ver['Estatus']
                        );
            return $datos;
        }else{
            return 0;
        }
    }

    public function obtenerEquipoCel($IdCelular){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT 
        max(ec.Id_celular) as Id_celular, 			max(mec.NombreModelo) as NombreModelo, 			max(mec.Color) as Color, 
        max(ec.Serie) as Serie,                     max(ec.IMEI) as IMEI, 					        group_concat(acce.Accesorio) as Accesorio
        from equipo_celular as ec 
        inner join modelo_ec as mec on ec.Id_modelo=mec.Id_modelo
        left join asignaaccesorio as aac on aac.Id_celular=ec.Id_celular
        left join accesorios as acce on  acce.Id_Accesorios=aac.Id_Accesorios
       where ec.Id_celular=".$IdCelular." group by ec.Id_celular;";
       $conta=0;
       $lista=array();
        $result=mysqli_query($conexion,$sql);
        while($ver=mysqli_fetch_array($result)){
            $datos=array(
                'Id_celular' => $ver['Id_celular'],  
                'NombreModelo' => $ver['NombreModelo'],
                'Color' => $ver['Color'],
                'Serie' => $ver['Serie'],
                'Accesorio' => $ver['Accesorio'],
                        );
            $lista[$conta]=$datos;
            $conta++;
        };
            return $lista;
    }

    public function agregar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();  
        // Actualizamos el estatus del equipo a Asignado
        $sqlEqCel="update equipo_celular set Estado='Asignado' where Id_celular=".$datos['Id_celular'].";";
        mysqli_query($conexion,$sqlEqCel);
        $sql="INSERT INTO celular_usuarios(Id_celular,Id_empleado,Estatus)
        VALUES(".$datos['Id_celular'].",".$datos['Id_empleado'].",'".$datos['Estatus']."');";
        return mysqli_query($conexion,$sql);
    }
 
    public function actualizar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();
        $sql="UPDATE celular_usuarios SET Id_celular =".$datos['Id_celular'].",
        Estatus='".$datos['Estatus']."' 
        WHERE Id_empleado=".$datos['Id_empleadoUPDATE'].";";
        return mysqli_query($conexion,$sql);
    }

/*obtiene todos los registros*/
public function todosEquiAsig(){
        $obj= new conectar();
        $conexion=$obj->conexion();
        $sqlTodos="
        SELECT 0 Id_CelUserHis,
        max(celUser.Id_empleado) as Id_empleado,	max(celUser.Id_celular) as Id_equipoCel,       max(user.Num_empleado) as NominaEmpleado,   max(user.Usuario_r) as NombreEmpleado, 
        max(user.Gerencia) as Gerencia,             max(user.Puesto) as Puesto,                    max(user.Zona) as Zona,                     max(user.Ubicacion) as Ubicacion,        
        max(celUser.Estatus) as EstatusAsig,        max(modCel.NombreModelo) as NombreModelo,	   max(modCel.Color) as Color,		           max(eqCel.Imei) as Imei,                   
        max(eqCel.Serie) as Serie,					GROUP_CONCAT(accCel.Accesorio) as Accesorios,  max(infLin.Telefono) as NumTel,		    max(Comp.Compania) as Compania,
        max(sim.Sim) as Sim,						max(eqCel.Estado) as EstatusCel,			   max(infLin.Estado) as EstatusLinea, 		max(infLin.Fecha_recepcion) as FechaRecepLin,
        infLin.Fin_plazo_forzoso as FinPlanForzoLin, max(celUser.registro) as FechaAsig,           'Activo actualmente' as FechaBaja
        from  celular_usuarios as celUser
        inner join usuario   	   as user 			 on celUser.Id_empleado=user.Id_usuario	
        inner join equipo_celular  as eqCel 		 on celUser.Id_celular=eqCel.Id_celular
        inner join modelo_ec       as modCel		 on modCel.Id_modelo=eqCel.Id_modelo
        left join asignaaccesorio as asigAccCel	 on asigAccCel.Id_celular=eqCel.Id_celular
        left join accesorios      as accCel		 on asigAccCel.Id_Accesorios=accCel.Id_Accesorios
        inner join inf_linea	   as infLin		 on	infLin.Id_linea=eqCel.Id_linea
        inner join sim			   as sim			 on sim.Id_Sim=infLin.Id_Sim
        inner join compania		   as Comp			 on Comp.Id_Compania=infLin.Id_Compania
         group by celUser.Id_empleado
		union
         select * from cel_usuario_historico;       
        ";
        $result=mysqli_query($conexion,$sqlTodos);
        $conta=0;
        if(isset($result)){
        $lista=array();
        $result=mysqli_query($conexion,$sqlTodos);
        while($ver=mysqli_fetch_array($result)){
            $datos=array(
                'Id_celular'     => $ver['Id_equipoCel'],   
                'Id_empleado'    => $ver['Id_empleado'],
                'NominaEmpleado' => $ver['NominaEmpleado'],
                'NombreEmpleado' => $ver['NombreEmpleado'],
                'Gerencia'       => $ver['Gerencia'],
                'Puesto'         => $ver['Puesto'],
                'Zona'           => $ver['Zona'],
                'Ubicacion'      => $ver['Ubicacion'],
                'EstatusAsig'    => $ver['EstatusAsig'],
                'NombreModelo'   => $ver['NombreModelo'],
                'Color'          => $ver['Color'],
                'Imei'           => $ver['Imei'],
                'Serie'          => $ver['Serie'],
                'Accesorios'     => $ver['Accesorios'],
                'NumTel'         => $ver['NumTel'],
                'Compania'       => $ver['Compania'],
                'Sim'            => $ver['Sim'],
                'EstatusCel'     => $ver['EstatusCel'],
                'EstatusLinea'   => $ver['EstatusLinea'],
                'FechaRecepLin'  => $ver['FechaRecepLin'],
                'FinPlanForzoLin' => $ver['FinPlanForzoLin'],
                'FechaAsig'       => $ver['FechaAsig'],
                'FechaBaja'       => $ver['FechaBaja'] 
                        );
            $lista[$conta]=$datos;
            $conta++;
        }
        return $lista;
    }
}

/*obtiene equipos celulares asigandos -- filtro por periodo*/
public function periodoEquiAsig($periodo){
    $obj= new conectar();
    $conexion=$obj->conexion();
    $sql="
    select 0 Id_CelUserHis,
        max(celUser.Id_empleado) as Id_empleado,	max(celUser.Id_celular) as Id_equipoCel,       max(user.Num_empleado) as NominaEmpleado,    max(user.Usuario_r) as NombreEmpleado, 
        max(user.Gerencia) as Gerencia,             max(user.Puesto) as Puesto,                    max(user.Zona) as Zona,                      max(user.Ubicacion) as Ubicacion,        
        max(celUser.Estatus) as EstatusAsig,        max(modCel.NombreModelo) as NombreModelo,	   max(modCel.Color) as Color,		            max(eqCel.Imei) as Imei,                   
        max(eqCel.Serie) as Serie,					GROUP_CONCAT(accCel.Accesorio) as Accesorios,  max(infLin.Telefono) as NumTel,		        max(Comp.Compania) as Compania,
        max(sim.Sim) as Sim,						max(eqCel.Estado) as EstatusCel,			   max(infLin.Estado) as EstatusLinea, 		    max(infLin.Fecha_recepcion) as FechaRecepLin,
        infLin.Fin_plazo_forzoso as FinPlanForzoLin, max(celUser.registro) as FechaAsig,           'Activo actualmente' as FechaBaja
    from celular_usuarios as celUser
    inner join usuario   	   as user 			 on celUser.Id_empleado=user.Id_usuario	
    inner join equipo_celular  as eqCel 		 on celUser.Id_celular=eqCel.Id_celular
    inner join modelo_ec       as modCel		 on modCel.Id_modelo=eqCel.Id_modelo
    left join asignaaccesorio as asigAccCel	 on asigAccCel.Id_celular=eqCel.Id_celular
    left join accesorios      as accCel		 on asigAccCel.Id_Accesorios=accCel.Id_Accesorios
    inner join inf_linea	   as infLin		 on	infLin.Id_linea=eqCel.Id_linea
    inner join sim			   as sim			 on sim.Id_Sim=infLin.Id_Sim
    inner join compania		   as Comp			 on Comp.Id_Compania=infLin.Id_Compania
    where 
        celUser.registro between '".$periodo['fechaInicio']."' and '".$periodo['fechaFin']."'
    group by celUser.Id_empleado
    union
    select * from cel_usuario_historico as cuh where
    cuh.FechaAsig between '".$periodo['fechaInicio']."' and '".$periodo['fechaFin']."'
    ;
    ";
    $result=mysqli_query($conexion,$sql);
    $conta=0;
    if(isset($result)){
    $lista=array();
    $result=mysqli_query($conexion,$sql);
    while($ver=mysqli_fetch_array($result)){
        $datos=array(
            'Id_celular'     => $ver['Id_equipoCel'],  
            'Id_empleado'    => $ver['Id_empleado'],
            'NominaEmpleado' => $ver['NominaEmpleado'],
            'NombreEmpleado' => $ver['NombreEmpleado'],
            'Gerencia'       => $ver['Gerencia'],
            'Puesto'         => $ver['Puesto'],
            'Zona'           => $ver['Zona'],
            'Ubicacion'      => $ver['Ubicacion'],
            'EstatusAsig'    => $ver['EstatusAsig'],
            'NombreModelo'      => $ver['NombreModelo'],
            'Color'          => $ver['Color'],
            'Imei'           => $ver['Imei'],
            'Serie'          => $ver['Serie'],
            'Accesorios'     => $ver['Accesorios'],
            'NumTel'         => $ver['NumTel'],
            'Compania'       => $ver['Compania'],
            'Sim'            => $ver['Sim'],
            'EstatusCel'     => $ver['EstatusCel'],
            'EstatusLinea'   => $ver['EstatusLinea'],
            'FechaRecepLin'  => $ver['FechaRecepLin'],
            'FinPlanForzoLin' => $ver['FinPlanForzoLin'],
            'FechaAsig'       => $ver['FechaAsig'],
            'FechaBaja'       => $ver['FechaBaja']
                    );
        $lista[$conta]=$datos;
        $conta++;
    }
    return $lista;
}
}

//Eliminar los registro
    public function Baja($datos ){ 
        $obj= new conectar();
        $conexion=$obj->conexion();
        if($datos['MotivoBaja']=='Dañado' || $datos['MotivoBaja']=='Extraviado'){
            $EmplMismoEquipo="select Id_celular,Id_empleado from celular_usuarios where Id_celular=".$datos['Id_celular'].";";
            $resMisEqui=mysqli_query($conexion,$EmplMismoEquipo);
            while($empleado=mysqli_fetch_array($resMisEqui)){ 
                $pasoHist=$this->paseHistorico($empleado['Id_empleado'],$datos['MotivoBaja']);
               if($pasoHist){
                 // actualiza el estatus del equipo
                $sqlEqCel="update equipo_celular  set  Estado='".$datos['MotivoBaja']."' where Id_celular=".$empleado['Id_celular'].";";
                mysqli_query($conexion,$sqlEqCel);
                $sqlDeleteAsigCel="delete from celular_usuarios where Id_empleado=".$empleado['Id_empleado'];
                 mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
                $resDelete=mysqli_query($conexion,$sqlDeleteAsigCel);
                mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
               }
            }
            return $resDelete;
        }else{
            $pasoHist=$this->paseHistorico($datos['Id_empleado'],$datos['MotivoBaja']);
            //$sqlEqCel="update equipo_celular  set  Estado='".$datos['MotivoBaja']."' where Id_celular=".$datos['Id_celular'].";";
            $sqlEqCel="update equipo_celular as  eqCel inner join 
            (select count(*) as NumRegCel, max(celUser.Id_celular) as Id_celular 
            from celular_usuarios as celUser where celUser.Id_celular=".$datos['Id_celular']." group by celUser.Id_celular) as repitEquEmpl
            on repitEquEmpl.Id_celular=eqCel.Id_celular and repitEquEmpl.NumRegCel=1
            set eqCel.Estado='".$datos['MotivoBaja']."';";
            mysqli_query($conexion,$sqlEqCel);
            $sqlDeleteAsigCel="delete from celular_usuarios where Id_empleado=".$datos['Id_empleado'];
             mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
            $resDelete=mysqli_query($conexion,$sqlDeleteAsigCel);
            mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
            return $resDelete;
        }
       }
    //ejecutar query
    public function executeQuery($query){
        $obj= new conectar ();
        return mysqli_query ($obj->conexion(),$query);
    }
    // funcion pase a historico
    function paseHistorico($Id_empleado,$MotivoBaja){
        $obj= new conectar();
        $conexion=$obj->conexion();

        // inserta a historico
        $sqlHistAsigCel="
        insert into cel_usuario_historico
        SELECT 0 Id_CelUserHis,
        max(celUser.Id_empleado) as Id_empleado,	max(celUser.Id_celular) as Id_equipoCel,       max(user.Num_empleado) as NominaEmpleado,   max(user.Usuario_r) as NombreEmpleado, 
        max(user.Gerencia) as Gerencia,             max(user.Puesto) as Puesto,                    max(user.Zona) as Zona,                     max(user.Ubicacion) as Ubicacion,        
        max(celUser.Estatus) as EstatusAsig,        max(modCel.NombreModelo) as NombreModelo,	   max(modCel.Color) as Color,		            max(eqCel.Imei) as Imei,                   
        max(eqCel.Serie) as Serie,					GROUP_CONCAT(accCel.Accesorio) as Accesorios,  max(infLin.Telefono) as NumTel,		    max(Comp.Compania) as Compania,
        max(sim.Sim) as Sim,						'".$MotivoBaja."' as EstatusCel,			   max(infLin.Estado) as EstatusLinea, 		max(infLin.Fecha_recepcion) as FechaRecepLin,
        infLin.Fin_plazo_forzoso as FinPlanForzoLin, max(celUser.registro) as FechaAsig,           now() as FechaBaja
        from
        celular_usuarios as celUser
        inner join usuario   	   as user 			 on celUser.Id_empleado=user.Id_usuario	
        inner join equipo_celular  as eqCel 		 on celUser.Id_celular=eqCel.Id_celular
        inner join modelo_ec       as modCel		 on modCel.Id_modelo=eqCel.Id_modelo
        left join asignaaccesorio as asigAccCel	 on asigAccCel.Id_celular=eqCel.Id_celular
        left join accesorios      as accCel		 on asigAccCel.Id_Accesorios=accCel.Id_Accesorios
        inner join inf_linea	   as infLin		 on	infLin.Id_linea=eqCel.Id_linea
        inner join sim			   as sim			 on sim.Id_Sim=infLin.Id_Sim
        inner join compania		   as Comp			 on Comp.Id_Compania=infLin.Id_Compania
        where celUser.Id_empleado=".$Id_empleado."
        group by celUser.Id_empleado;
        ";
       $resAgreHis= mysqli_query($conexion,$sqlHistAsigCel);
       if($resAgreHis){
            return true;
        }else{
            return false;
        }
    }
}

?> 