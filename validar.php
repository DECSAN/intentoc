<?php
include('db.php');
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];

session_start();
$_SESSION['correo']=$correo;



$conexion=mysqli_connect("localhost","root","","floreria");

$consulta="SELECT*FROM registro where correo='$correo' and contraseña='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:InicioProyecto.php");

}else{
    ?>
    <?php
    include("LoginProyecto.html");

  ?>
  <h1 class="bad">DATOS INCORRECTOS</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);