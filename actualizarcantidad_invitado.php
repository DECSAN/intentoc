<?php
 ?>
<?php
include_once "funciones_invitado.php";
if (!isset($_POST["id_producto1"])) {
    exit("No hay id_producto1");
}
ActualizarCantidadDeProductoDelCarritoInvitado($_POST["id_producto1"]);
# Saber si redireccionamos a tienda o al carrito, esto es porque
# llamamos a este archivo desde la tienda y desde el carrito
if (isset($_POST["redireccionar_carrito1_invitado"])) {
    header("Location: ver_carrito_invitado.php");
} else {
    header("Location: InicioProyectoInvitado.php");
}

