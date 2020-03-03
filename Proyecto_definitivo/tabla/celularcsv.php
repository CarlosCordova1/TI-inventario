<?php
 
//incluir archivo de configuración de base de datos
include '../../tabla/clases/conexion.php';
include '../../tabla/clases/crud.php';

//obtener registros de la base de datos
/*crrea objeto */
$obj=new conectar();
$conexion=$obj->conexion();
/* */

$query = $conexion->query("SELECT * from equipo_celular as ec
left join Inf_linea as il on ec.Id_linea=il.Id_linea
left join modelo_ec as m on  m.Id_modelo=ec.Id_modelo;");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "celular_" . date('Y-m-d') . ".csv";
    
    //crear un puntero de archivo
    $f = fopen('php://memory', 'w');
    
    //establecer encabezados de columna
    $fields = array(
   'Id_celular',   'Modelo',   'Color', 
    'Cargador' ,   'Status',   'Num_telefono', 
    'Num_serie',   'Num_IMEI', 'Equipo_anterior', 
    'Accesorio',    'Descripcion');

    fputcsv($f, $fields, $delimiter);
    
    //generar cada fila de datos, formatear la línea como csv y escribir en el puntero del archivo
    while($row = $query->fetch_assoc()){
       // $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array(
        $row['Id_celular'],  
        $row['Modelo'],  
        $row['Color'], 
        $row['Cargador'], 
        $row['Status'],  
        $row['Num_telefono'],  
        $row['Num_serie'], 
        $row['Num_IMEI'],  
        $row['Equipo_anterior'], 
        $row['Accesorio'], 
        $row['Descripcion'] );

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