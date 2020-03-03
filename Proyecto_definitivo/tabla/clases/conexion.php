
 
<?php 
if(session_status() !== PHP_SESSION_ACTIVE){ session_start();}
//session_start();

	class conectar{
		private $respuesta=true;
		  function __construct(){
			if(!isset($_SESSION['user']) & !isset($_SESSION['invitado'])){
				$this->respuesta=false;
				echo '<script type="text/javascript">
				window.location.assign("index.php");
				</script>';
			}
		}

		public function conexion(){
			$conexion=false;
			if($this->respuesta){
			$conexion=mysqli_connect('localhost',
										'root',
										'1234',
										'equipos11');
									}
			return $conexion;
			 
		}
	}
	
	

 ?>
 