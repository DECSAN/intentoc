<?php
?>
<?php
if (!isset($_POST["NOMBRE"]) || !isset($_POST["PRECIO"]) || !isset($_POST["DESCRIPCION"])) {
    exit("Faltan datos");
}
include_once "funciones.php";
guardarProducto($_POST["NOMBRE"], $_POST["PRECIO"], $_POST["DESCRIPCION"]);
header("Location: InicioProyecto.php");
