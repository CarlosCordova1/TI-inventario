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
    $datosAsigCel=$obj->periodoEquiAsig($datosPeriodo);
}else{
    $datosAsigCel=$obj->todosEquiAsig();
}

if(isset($datosAsigCel)){ 
    $delimiter = ",";
    $filename = "reporteEquipoCelular_" . date('Y-m-d') . ".csv";
    
    //crear un puntero de archivo
    $f = fopen('php://memory', 'w');
    
    //establecer encabezados de columna
    $fields = array( 
        'NominaEmpleado',  'NombreEmpleado',  'Gerencia', 
        'Puesto',          'Zona',            'Ubicacion',      
        'IMEI',            'Serie',           'ModeloCel',
        'Color',           'Accesorios',      'NumTel',     
        'Compania',        'SIM',             'EstatusCel',   
        'EstatusLin',      'FechaRecepLin',   'FinPlanForzoLin', 
        'FechaAsig',        'FechaBaja'
    );
    fputcsv($f, $fields, $delimiter);

    //generar cada fila de datos, formatear la línea como csv y escribir en el puntero del archivo
    for ($i=0;$i < count($datosAsigCel);$i++) {
        
        $lineData = array(
        $datosAsigCel[$i]['NominaEmpleado'],
        $datosAsigCel[$i]['NombreEmpleado'], 
        $datosAsigCel[$i]['Gerencia'],
        $datosAsigCel[$i]['Puesto'],
        $datosAsigCel[$i]['Zona'],
        $datosAsigCel[$i]['Ubicacion'],
        $datosAsigCel[$i]['Imei'],
        $datosAsigCel[$i]['Serie'],
        $datosAsigCel[$i]['NombreModelo'],
        $datosAsigCel[$i]['Color'],
        $datosAsigCel[$i]['Accesorios'],
        $datosAsigCel[$i]['NumTel'],
        $datosAsigCel[$i]['Compania'],
        $datosAsigCel[$i]['Sim'],
        $datosAsigCel[$i]['EstatusCel'],
        $datosAsigCel[$i]['EstatusLinea'],
        $datosAsigCel[$i]['FechaRecepLin'],
        $datosAsigCel[$i]['FinPlanForzoLin'],
        $datosAsigCel[$i]['FechaAsig'],
        $datosAsigCel[$i]['FechaBaja']);

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