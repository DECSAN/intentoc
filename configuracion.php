<?php
include 'db.php';
session_start();
if(!isset($_SESSION['correo'])) {
header("location:LoginProyecto.html");

}

$correo = $_SESSION['correo'];
$sql = "SELECT NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO FROM registro WHERE correo = '$correo'";
$resultado = $conexion->query($sql);
$row =$resultado->fetch_assoc();

 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Configuracion</title>

	<div id="nombre_configuracion" > <span>
            	
            	<?php echo utf8_decode ($row['NOMBRE']); ?>
</span></div>
	<div id="apellidos_configuracion" > <span>

            	<?php echo utf8_decode ($row['APELLIDO_PATERNO']); ?>
            	<?php echo utf8_decode ($row['APELLIDO_MATERNO']); ?>
            	</span></div>
         <div id="correo_configuracion" > <span>

            	<?php echo utf8_decode ($row['CORREO']); ?>

            	</span></div>

</head>

<body>


  <?php
  if(isset($_POST['codigo'])) {
    include "db.php";


    $contraseña = $mysqli->real_escape_string($_POST['CONTRASEÑA']);
    $contraseña = md5($contraseña);

    $act = $mysqli->query("UPDATE registro SET CONTRASEÑA WHERE CORREO = '$correo'");

    if($act) {
      echo "Su contraseña se ha cambiado, ya puede ingresar";
      Header("Refresh: 0; URL=InicioProyecto.php");
      }
  }
  ?>


  <div class="main-content">
    <div class="header">
      <img src="images/logo.png" />
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="password" placeholder="Ingresa tu nueva contraseña" class="input" name="CONTRASEÑA" required />
        <input type="submit" value="Cambiar contraseña" class="btn" name="codigo" />
      </div>
    </form>
  </div>

</div>

</body>
</html>