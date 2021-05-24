<?php
 ?>
<?php
include_once "funciones.php";
if (!isset($_POST["id_producto1"])) {
    exit("No hay id_producto1");
}
ActualizarCantidadDeProductoDelCarrito($_POST["id_producto1"]);
# Saber si redireccionamos a tienda o al carrito, esto es porque
# llamamos a este archivo desde la tienda y desde el carrito
if (isset($_POST["redireccionar_carrito1"])) {
    header("Location: ver_carrito.php");
} else {
    header("Location: InicioProyecto.php");
}






//--<?php 
//include 'db.php';

//$conexion=mysqli_connect("localhost","root","","floreria");

//$actC=$_POST['actualizar_cantidad'];

//$actualizarCantidad="UPDATE carrito_usuarios SET producto_cantidad = '$actC'  WHERE id_producto= id_producto AND producto_cantidad = producto_cantidad";

  //  $resultado=mysqli_query($conexion,$actualizarCantidad) or die ('Error en el query');

    //mysqli_close($conexion);


//header("location:ver_carrito.php");
  
//