 <?php session_start();
 $url=$_SERVER["REQUEST_URI"];
if($url=='/' || $url=='/index.php'){

}else{
    if(!isset($_SESSION['user'])){
      echo '<script type="text/javascript">
      window.location.assign("index.php");
      </script>';
   }
}

 ?>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="tabla/librerias/bootstrap/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="tabla/librerias/datatable/bootstrap.css">
<link rel="stylesheet" type="text/css" href="tabla/librerias/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="tabla/librerias/alertify/css/alertify.css">
<link rel="stylesheet" type="text/css" href="tabla/librerias/alertify/css/themes/bootstrap.css">
<link rel="stylesheet" type="text/css" href="tabla/librerias/fontawesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="tabla/librerias/w3.css">

<script src="tabla/librerias/jquery.min.js"></script> 
<script src="tabla/librerias/bootstrap/popper.min.js"></script>
<script src="tabla/librerias/bootstrap/bootstrap.min.js"></script>
<script src="tabla/librerias/datatable/jquery.dataTables.min.js"></script>
<script src="tabla/librerias/datatable/dataTables.bootstrap4.min.js"></script>
<script src="tabla/librerias/alertify/alertify.js"></script> 

<!--jquery campos obligatorios -->
<script src="tabla/librerias/datatable/jquery.validate.js"></script>
<script src="tabla/librerias/datatable/jquery-1.11.1.min.js"></script>


   <!-- Bootstrap core CSS -->
   <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
   <!--Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
 <!-- <script src="lib/common-scripts.js"></script>-->
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>  






  