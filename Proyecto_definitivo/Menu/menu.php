<section id="container">
  <header class="header black-bg">
    <div class="sidebar-toggle-box">
      <div class="fa fa-bars tooltips" aria-hidden="true" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <a href="entrada.php" class="logo"><b>AGUA<span>KAN</span></b></a>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
        <li><a class="logo" href="#"><?php echo $_SESSION['user']; ?></a></li>
        <li><a class="logout" href="login/cierraSession.php">Salir</a></li>
      </ul>
    </div>
  </header>
  <aside>
    <div id="sidebar" class="nav-collapse ">
      <!-- inicio del menú de la barra lateral-->
      <ul class="sidebar-menu" id="nav-accordion">
        <h5 class="centered">CATÁLAGO DE TI</h5>

        <!-- usuario-->
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
            <span>Usuario</span>
          </a>
          <ul class="sub">
          <li><a href="usuario1.php">Usuario </a></li>
          </ul>
        </li>

        <!-- celular -->
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-mobile fa-5x" aria-hidden="true"></i>
            <span>Celular</span>
          </a> 
          <ul class="sub">
            <li><a href="asignaCel.php">Asigna equipo Cel</a></li>
            <li><a href="Alta.php">Alta equipo celular</a></li>
            <li><a href="modelo_ec.php">Modelo</a></li>
            <li><a href="accesorio.php">Accesorios</a></li>
            <li><a href="linea.php">Linea</a></li>
            <li><a href="sim.php">Sim</a></li>
            <li><a href="compania.php">Compañia</a></li>
          </ul>
        </li>
        <!-- radio -->
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-rss" aria-hidden="true"></i>
            <span>Radio</span>
          </a>
          <ul class="sub">
          <li><a href="asignaRadio.php">Asigna Radio</a></li>
            <li><a href="radio.php">Alta equipo radio</a></li>
            <li><a href="modelo.php">Modelo</a></li>
            <li><a href="estado.php">Estado</a></li>
          </ul>
        </li>
        

        <!-- historial
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <span>Historial</span>
          </a>
          <ul class="sub">
            <li><a href="">Historial</a></li>
            
          </ul>
        </li>-->

      </ul>
    </div>
  </aside>
</section>
<!-- final del menú de la barra lateral-->

<!-- js colocado al final del documento para que las páginas se carguen más rápido -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="lib/jquery.scrollTo.min.js"></script>
<script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="lib/jquery.sparkline.js"></script>
<!--secuencia de comandos común para todas las páginas-->
<script src="lib/common-scripts.js"></script>
<script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="lib/gritter-conf.js"></script>
<!--guión para esta página-->
<script src="lib/sparkline-chart.js"></script>
<script src="lib/zabuto_calendar.js"></script>
<script type="application/javascript">
  $(document).ready(function() {
    $("#date-popover").popover({
      html: true,
      trigger: "manual"
    });
    $("#date-popover").hide();
    $("#date-popover").click(function(e) {
      $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
      action: function() {
        return myDateFunction(this.id, false);
      },
      action_nav: function() {
        return myNavFunction(this.id);
      },
      ajax: {
        url: "show_data.php?action=1",
        modal: true
      },
      legend: [{
          type: "text",
          label: "Special event",
          badge: "00"
        },
        {
          type: "block",
          label: "Regular event",
        }
      ]
    });
  });

  function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
  }
</script>