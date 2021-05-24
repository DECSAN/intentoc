<?php
?>
<?php
include_once "funciones_invitado.php";
if (!isset($_POST["id_producto"])) {
    exit("No hay id_producto");
}
agregarProductoAlCarritoInvitado($_POST["id_producto"]);
header("Location: InicioProyectoInvitado.php");
