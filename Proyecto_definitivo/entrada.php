<!DOCTYPE html>
<html lang="en"> 
<head>
<?php include "scripts.php"; ?> 

<style>
.city {display:none}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>IT inventario</title>
 
    <!-- Favicons -->
  <link href="img/aguakan.png" rel="icon">
   <!-- Bootstrap core CSS -->
   <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet"> 
  <script src="lib/chart-master/Chart.js"></script>
</head>

<?php include 'Menu/menu.php'; ?>

<body>   
<section id="main-content">
		<section class="wrapper site-min-height">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card" style="width: auto; height: auto;">
							<div class="card-header">

              <h1 class="float-right">Hola <span style="color:#34EAE7"><?php echo $_SESSION['user']; ?></span></h1>
              <h3>	BIENVENIDO </h3>
							</div>
							<div class="card-body" align="center">
              <img src="logo.png" />
							</div>

						</div>
					</div>
				</div>
			</div>
      </section>
      </section>
</body>
</html>