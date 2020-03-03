<?php
include 'CrudLogin.php';
// recuperamos las variables de logueo
$ObjCrud=new CrudLogin();

echo $ObjCrud->login($_POST['Cuenta'],$_POST['Password']);

?>