<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Inicia sesión</title>

  <!-- Favicons -->
  <link href="img/aguakan.png" rel="icon">
  <?php include "scripts.php";
	if(isset($_SESSION['user'])){
	header("Location: entrada.php");
	}
 ?> 

  

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
  
</head>

<body>
 
  <div id="login-page">
    <div class="container">
      <form id="formLogin" class="form-login" action="index.php" onsubmit="return false;">
        <h2 class="form-login-heading">Inicia sesión</h2>
        <div class="login-wrap">
          <input id="Cuenta" required name="Cuenta" type="text" class="form-control" placeholder="TuCuenta@.com" autofocus>
          <br>
          <input id="Password" required name="Password" type="password" class="form-control" placeholder="Password">
          <button id="IniciaSesion" class="btn btn-theme btn-block" href="index.php" type="submit"><i class="fa fa-lock"></i> Iniciar sesión</button>
          <hr>
        </div>
      </form>
    </div>
  </div>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>

  <script>
  $(document).ready(function(){
    
    $("#IniciaSesion").click(function(){
      Logueo();
    });

  });

  function Logueo(){
    if($("#Cuenta").val()!="" & $("#Password").val()!=""){
      let formularioLogin=$("#formLogin").serialize();
    $.ajax({
      method: 'POST',
      async: false,
      data: formularioLogin,
      url: 'login/procesoLogin.php',
      success: function(response){
        //alert(response);
        console.log(response);
        if (response==1){ 
        $(location).attr("href","entrada.php");
        }else{
          alertify.error("Credenciales Incorrectas...<img src='accesorios/x.gif' width='15%' />");
        }

      }

    });
    }
  }
  </script>
 
</body>

</html>
