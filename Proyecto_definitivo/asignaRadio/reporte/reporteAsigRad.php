<?php
 include '../../tabla/clases/conexion.php';
ob_clean(); // limpiar buffer
 require_once '../crud.php';
$obj =new crud();

//construir consulta segun sea el caso  --> Tipo de reporte --> periodo o todos
if(isset($_GET['fechaInicio']) && isset($_GET['fechaFin'])){
    $datosPeriodo=array(
		"fechaInicio"=>$_GET['fechaInicio'],
		"fechaFin"=>$_GET['fechaFin']
	);
    $datosAsigRad=$obj->periodoEquiAsig($datosPeriodo);
}else{
    $datosAsigRad=$obj->todosEquiAsig();
}

if(isset($datosAsigRad)){
    $delimiter = ",";
    $filename = "reporteEquipoRadio_" . date('Y-m-d') . ".csv";
    
    //crear un puntero de archivo
    $f = fopen('php://memory', 'w');
    
    //establecer encabezados de columna
    $fields = array( 
        'NominaEmpleado',  'NombreEmpleado',  'Gerencia', 
        'Puesto',          'Zona',            'Ubicacion',         
        'Serie',           'Modelo',          'Num_radio',                
        'Sap',             'Marca',           'FechaInicio',           
        'FechaFinal',      'Estatus',         'FechaAsignado',      
        'FechaBaja',
    );
    fputcsv($f, $fields, $delimiter);
    //generar cada fila de datos, formatear la línea como csv y escribir en el puntero del archivo
    for ($i=0;$i < count($datosAsigRad);$i++) {
        $lineData = array(
        $datosAsigRad[$i]['NominaEmpleado'], 
        $datosAsigRad[$i]['NombreUsuario'],
        $datosAsigRad[$i]['Gerencia'], 
        $datosAsigRad[$i]['Puesto'], 
        $datosAsigRad[$i]['Zona'], 
        $datosAsigRad[$i]['Ubicacion'],
        $datosAsigRad[$i]['Num_serie'], 
        $datosAsigRad[$i]['Modelo'],
        $datosAsigRad[$i]['Num_radio'],
        $datosAsigRad[$i]['Num_sap'],
        $datosAsigRad[$i]['Marca'],
        $datosAsigRad[$i]['Fecha_inicio'],
        $datosAsigRad[$i]['Fecha_final'],
        $datosAsigRad[$i]['Estatus'],
        $datosAsigRad[$i]['FechaAsig'],
        $datosAsigRad[$i]['FechaBaja']
        );

        fputcsv($f, $lineData, $delimiter);
         
    }
    
    //volver al principio del archivo
    fseek($f,0);
    
    //establecer encabezados para descargar el archivo en lugar de mostrarse
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //generar todos los datos restantes en un puntero de archivo
    fpassthru($f);
}
exit;

?>