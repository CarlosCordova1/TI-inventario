<?php
    require_once '../tabla/clases/conexion.php';
class CrudLogin{

    function login($cuenta,$pass){
        /*Seactiva la sesion para invitado */
        //session_start();
        $_SESSION['invitado']='Active';
        $ObjetoConex = new conectar();
        $Conexion=$ObjetoConex->conexion();
        $sql="SELECT  UserLog, Cuenta,Password from UserSeccion where Cuenta='".$cuenta."' and Password='".$pass."';";
        
        $Execute=mysqli_query($Conexion,$sql);
        if(mysqli_num_rows($Execute) >0){
        $resultado=mysqli_fetch_array($Execute);
            /*Destruimos la sesion de invitado */
           // session_unset();
           unset($_SESSION['invitado']);
        $_SESSION['user']=$resultado['UserLog'];
		/*retornamos uno para el caso de logueado y cero no logueado */	  
        return 1;
        }else{
            return 0;
        }
    }
    
}
?>