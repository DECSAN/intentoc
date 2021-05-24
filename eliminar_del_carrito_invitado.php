<?php
 ?>
<?php
include_once "funciones_invitado.php";
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}
quitarProductoDelCarritoInvitado($_POST["id_producto"]);
# Saber si redireccionamos a tienda o al carrito, esto es porque
# llamamos a este archivo desde la tienda y desde el carrito
if (isset($_POST["redireccionar_carrito"])) {
    header("Location: ver_carrito_invitado.php");
} else {
    header("Location: InicioProyectoInvitado.php");
}
