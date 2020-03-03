<?php 
  
class crud{ 

    public function obtenDatos($IdEmpleado){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT Id_usuario,Id_radio,Estatus,Registro  from radio_usuarios where Id_usuario=".$IdEmpleado.";";

        $result=mysqli_query($conexion,$sql);
        $ver=mysqli_fetch_array($result);
        if(isset($ver)){
            $datos=array(
                'Id_usuario' => $ver['Id_usuario'],  
                'Id_radio' => $ver['Id_radio'],
                'Estatus' => $ver['Estatus'],
                'Registro' => $ver['Registro']
                        );
            return $datos;
        }else{
            return 0;
        }
    }

    public function obtenerEquipoRad($IdRadio){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT er.Id_radio,mo.Id_modelo,er.Num_radio,mo.Modelo_r,mo.Marca_r as Marca,er.Num_serie,
        er.Num_sap,er.Fecha_inicio,er.Fecha_final,er.Descripcion
        from equipo_radio as er
        inner join modelo as mo on er.Id_modelo=mo.Id_modelo
        where er.Id_radio=".$IdRadio.";";
       $conta=0;
       $lista=array();
        $result=mysqli_query($conexion,$sql);
        while($ver=mysqli_fetch_array($result)){
            $datos=array(
                'Id_radio' => $ver['Id_radio'],  
                'Id_modelo' => $ver['Id_modelo'],
                'Num_radio' => $ver['Num_radio'],
                'Modelo_r' => $ver['Modelo_r'],
                'Marca' => $ver['Marca'],
                'Num_serie' => $ver['Num_serie'],
                'Num_sap' => $ver['Num_sap'],
                'Fecha_inicio' => $ver['Fecha_inicio'],
                'Fecha_final' => $ver['Fecha_final'],
                'Descripcion' => $ver['Descripcion'],
                        );
            $lista[$conta]=$datos;
            $conta++;
        };
            return $lista;
    }

    public function agregar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();  
         // actualiza el estatus del equipo
         $sqlEqRad="update equipo_radio set Id_estado=2 where Id_radio=".$datos['Id_radio'].";";
         mysqli_query($conexion,$sqlEqRad);
        $sql="INSERT INTO radio_usuarios(Id_usuario,Id_radio,Estatus)
        VALUES(".$datos['Id_usuario'].",".$datos['Id_radio'].",'".$datos['Estatus']."');";
        return mysqli_query($conexion,$sql);
    }

    public function actualizar($datos){
        $obj= new conectar();
        $conexion=$obj->conexion();
        $sql="UPDATE radio_usuarios SET Id_radio=".$datos['Id_radio'].",
        Estatus='".$datos['Estatus']."' 
        WHERE Id_usuario=".$datos['Id_usuario'].";";
        return mysqli_query($conexion,$sql);
    }

/*obtiene todos los registros*/
public function todosEquiAsig(){
        $obj= new conectar();
        $conexion=$obj->conexion();
        //$sql="select * from celular_usuarios;";
        $sqlTodos="
        SELECT 
        0 as Id_radUserHistorico,         er.Id_radio,		           ru.Id_usuario,	      user.Num_empleado as NominaEmpleado,	
        user.Usuario_r as NombreUsuario,  user.Gerencia as Gerencia,   user.Puesto as Puesto,  user.Zona as Zona, 
        user.Ubicacion as Ubicacion,      mo.Modelo_r as Modelo,	   er.Num_radio,		   er.Num_serie,		
        er.Num_sap,                       mo.Marca_r as Marca,		   er.Fecha_inicio,	       er.Fecha_final,		
        ru.Estatus,	                       ru.Registro as FechaAsig,   'Activo actualmente' as FechaBaja 
        from equipo_radio as er
        inner join modelo as mo on er.Id_modelo=mo.Id_modelo
        inner join radio_usuarios as ru on ru.Id_radio=er.Id_radio
        inner join usuario as user on user.Id_usuario=ru.Id_usuario
        union
        select * from radio_usuario_historico;
        ";
        $result=mysqli_query($conexion,$sqlTodos);
        $conta=0;
        if(isset($result)){
        $lista=array();
        $result=mysqli_query($conexion,$sqlTodos);
        while($ver=mysqli_fetch_array($result)){
            $datos=array(
                'Id_radUserHistorico'  => $ver['Id_radUserHistorico'],  
                'Id_radio'      => $ver['Id_radio'],
                'Id_usuario'    => $ver['Id_usuario'],
                'NominaEmpleado'=> $ver['NominaEmpleado'],
                'NombreUsuario' => $ver['NombreUsuario'],
                'Gerencia'      => $ver['Gerencia'],
                'Puesto'        => $ver['Puesto'],
                'Zona'          => $ver['Zona'],
                'Ubicacion'     => $ver['Ubicacion'],
                'Modelo'        => $ver['Modelo'],
                'Num_radio'     => $ver['Num_radio'],
                'Num_serie'     => $ver['Num_serie'],
                'Num_sap'       => $ver['Num_sap'],
                'Marca'         => $ver['Marca'],
                'Fecha_inicio'  => $ver['Fecha_inicio'],
                'Fecha_final'   => $ver['Fecha_final'],
                'Estatus'       => $ver['Estatus'],
                'FechaAsig'      => $ver['FechaAsig'],
                'FechaBaja'      => $ver['FechaBaja']
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
    SELECT 
    0 as Id_radUserHistorico,         er.Id_radio,		           ru.Id_usuario,	      user.Num_empleado as NominaEmpleado,	
    user.Usuario_r as NombreUsuario,  user.Gerencia as Gerencia,   user.Puesto as Puesto,  user.Zona as Zona, 
    user.Ubicacion as Ubicacion,      mo.Modelo_r as Modelo,	   er.Num_radio,		   er.Num_serie,		
    er.Num_sap,                        mo.Marca_r as Marca,		   er.Fecha_inicio,	       er.Fecha_final,		
    ru.Estatus,	                       ru.Registro as FechaAsig,   'Activo actualmente' as FechaBaja 
    from equipo_radio as er
    inner join modelo as mo on er.Id_modelo=mo.Id_modelo
    inner join radio_usuarios as ru on ru.Id_radio=er.Id_radio
    inner join usuario as user on user.Id_usuario=ru.Id_usuario
    where
    ru.Registro between '".$periodo['fechaInicio']."' and '".$periodo['fechaFin']."'
    union
    select * from radio_usuario_historico as ruh
    where 
    ruh.FechaAsig between  '".$periodo['fechaInicio']."' and '".$periodo['fechaFin']."';";
    $result=mysqli_query($conexion,$sql);
    $conta=0;
    if(isset($result)){
    $lista=array();
    $result=mysqli_query($conexion,$sql);
    while($ver=mysqli_fetch_array($result)){
        $datos=array(
            'Id_radUserHistorico'  => $ver['Id_radUserHistorico'],  
                'Id_radio'      => $ver['Id_radio'],
                'Id_usuario'    => $ver['Id_usuario'],
                'NominaEmpleado'=> $ver['NominaEmpleado'],
                'NombreUsuario' => $ver['NombreUsuario'],
                'Gerencia'      => $ver['Gerencia'],
                'Puesto'        => $ver['Puesto'],
                'Zona'          => $ver['Zona'],
                'Ubicacion'     => $ver['Ubicacion'],
                'Modelo'        => $ver['Modelo'],
                'Num_radio'     => $ver['Num_radio'],
                'Num_serie'     => $ver['Num_serie'],
                'Num_sap'       => $ver['Num_sap'],
                'Marca'         => $ver['Marca'],
                'Fecha_inicio'  => $ver['Fecha_inicio'],
                'Fecha_final'   => $ver['Fecha_final'],
                'Estatus'       => $ver['Estatus'],
                'FechaAsig'      => $ver['FechaAsig'],
                'FechaBaja'      => $ver['FechaBaja']
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
            $UsrMismoEquipo="select Id_radio,Id_usuario from radio_usuarios where Id_radio=".$datos['Id_radio'].";";
            $resMisEqui=mysqli_query($conexion,$UsrMismoEquipo);
            while($usuario=mysqli_fetch_array($resMisEqui)){ 
                $pasoHist=$this->paseHistorico($usuario['Id_usuario'],$datos['MotivoBaja']);
               if($pasoHist){
                 // actualiza el estatus del equipo
                $sqlEqRad="update equipo_radio set Id_estado=(
                    select Id_estado from estado where Estado_r='".$datos['MotivoBaja']."'
                    )
                    where Id_radio=".$usuario['Id_radio'].";";
                mysqli_query($conexion,$sqlEqRad);
                $sqlDeleteAsigRad="delete from radio_usuarios where Id_usuario=".$usuario['Id_usuario'].";";
                 mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
                $resDelete=mysqli_query($conexion,$sqlDeleteAsigRad);
                mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
               }
            }return $resDelete;
        }
       else{
        $pasoHist=$this->paseHistorico($datos['idUsuario'],$datos['MotivoBaja']);
           // actualiza el estatus del equipo
         $sqlEqRad="
        update equipo_radio as  eqRad inner join 
        (select count(*) as NumRegRad, max(radUser.Id_radio) as Id_radio 
        from radio_usuarios as radUser 
        where radUser.Id_radio=".$datos['Id_radio']." group by radUser.Id_radio) as repitEquUSer
        on repitEquUSer.Id_radio=eqRad.Id_radio and repitEquUSer.NumRegRad=1
        set 
        eqRad.Id_estado=(select Id_estado from estado where Estado_r='".$datos['MotivoBaja']."');
         ";
         mysqli_query($conexion,$sqlEqRad);
         // Elimina registro de asignacion
         $sqlDeleteAsigRad="delete from radio_usuarios where Id_usuario=".$datos['idUsuario'];
         mysqli_query($conexion,'SET FOREIGN_KEY_CHECKS = 0');
         $resDelete=mysqli_query($conexion,$sqlDeleteAsigRad);
         mysqli_query($conexion, 'SET FOREIGN_KEY_CHECKS =1');
         return $resDelete;

       }
    }
    //ejecutar query
    public function executeQuery($query){
        $obj= new conectar ();
        return mysqli_query ($obj->conexion(),$query);
    }
    function paseHistorico($Id_usuario,$MotivoBaja){
        $obj= new conectar();
        $conexion=$obj->conexion();

        // inserta a historico
        $sqlHistAsigRad="
        insert into radio_usuario_historico
        select 
              0 as Id_radUserHistorico		,er.Id_radio,		ru.Id_usuario,	user.Num_empleado as NominaEmpleado,	user.Usuario_r as NombreUsuario, user.Gerencia as Gerencia,   user.Puesto as Puesto,  user.Zona as Zona,  user.Ubicacion as Ubicacion, 
              mo.Modelo_r as Modelo,		 er.Num_radio,		er.Num_serie,		er.Num_sap,
              mo.Marca_r as Marca,			er.Fecha_inicio,	er.Fecha_final,'".$MotivoBaja."',	
              ru.Registro as FechaAsig, now() 
        from equipo_radio as er
        inner join modelo as mo on er.Id_modelo=mo.Id_modelo
        inner join radio_usuarios as ru on ru.Id_radio=er.Id_radio
        inner join usuario as user on user.Id_usuario=ru.Id_usuario
        where ru.Id_usuario=".$Id_usuario.";";
       $resAgreHis= mysqli_query($conexion,$sqlHistAsigRad);
       if($resAgreHis){
            return true;
        }else{
            return false;
        }

    }
}

?> 