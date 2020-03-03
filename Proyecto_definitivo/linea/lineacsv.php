<?php
 
//incluir archivo de configuración de base de datos
include '../tabla/clases/conexion.php';

//obtener registros de la base de datos
/*crrea objeto */
$obj=new conectar();
$conexion=$obj->conexion();
/* */

$query = $conexion->query("SELECT *from inf_linea as il
left join sim as s on  il.Id_Sim=s.Id_Sim
left join compania as c on c.Id_Compania= il.Id_Compania;");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "linea_" . date('Y-m-d') . ".csv";
    
    //crear un puntero de archivo
    $f = fopen('php://memory', 'w');
    
    //establecer encabezados de columna
    $fields = array('Id_linea', 'Telefono', 'Contrato', 'Sim', 'Compania', 'Fecha_recepcion', 'Fin_plazo_forzoso');
    fputcsv($f, $fields, $delimiter);
    
    //generar cada fila de datos, formatear la línea como csv y escribir en el puntero del archivo
    while($row = $query->fetch_assoc()){
       // $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array($row['Id_linea'], $row['Telefono'], $row['Contrato'], $row['Sim'], $row['Compania'],  $row['Fecha_recepcion'],  $row['Fin_plazo_forzoso']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //volver al principio del archivo
    fseek($f, 0);
    
    //establecer encabezados para descargar el archivo en lugar de mostrarse
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //generar todos los datos restantes en un puntero de archivo
    fpassthru($f);
}
exit;



?>