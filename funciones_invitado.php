<?php
function obtenerProductosEnCarritoInvitado()
{
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
     $sentencia = $bd->prepare("SELECT catalogo.ID_PRODUCTO, catalogo.NOMBRE, catalogo.DESCRIPCION, catalogo.PRECIO ,catalogo.IMG ,carrito_usuarios.producto_cantidad, carrito_usuarios.nombre
     FROM catalogo
     INNER JOIN carrito_usuarios
     ON catalogo.ID_PRODUCTO = carrito_usuarios.id_producto
     WHERE carrito_usuarios.id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}


function obtenerCanProductosEnCarritoInvitado()
{
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
     $sentencia = $bd->prepare("SELECT producto_cantidad
     FROM carrito_usuarios
     INNER JOIN catalogo
     ON  carrito_usuarios.id_producto= catalogo.ID_PRODUCTO
     WHERE carrito_usuarios.id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}

function CantidadCarritoInvitado($value='')
{
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $idSesion = session_id();
    
    # code...
}
function quitarProductoDelCarritoInvitado($idProducto)
{
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $idSesion = session_id();
    $sentencia = $bd->prepare("DELETE FROM carrito_usuarios WHERE id_sesion = ? AND id_producto = ?");
    return $sentencia->execute([$idSesion, $idProducto]);
}
function ActualizarCantidadDeProductoDelCarritoInvitado($idProducto)
{ 
    include 'db.php';

    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $idSesion = session_id();

    $link =mysqli_connect("localhost","root","","floreria");
    // Chequea coneccion

    $Nomb=$_POST['Nombreee'];
$actC=$_POST['id_producto1'];
    if($link === false){
        die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
    }

    // Ejecuta la actualizacion del update
    $sql = "UPDATE carrito_usuarios SET producto_cantidad = '$actC'  WHERE nombre = '$Nomb' AND id_producto = id_producto AND id_sesion= '$idSesion'";
    if(mysqli_query($link, $sql)){

        echo "Registro actualizado.";
    } else {
        echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
    }
    // Cierra la conexion
    mysqli_close($link);


  

    #$actC = $_POST['id_producto1'];
    #$bd = obtenerConexion();
    #iniciarSesionSiNoEstaIniciada();
    #$idSesion = $_SESSION['correo'];
    #$sentencia = $bd->prepare("UPDATE carrito_usuarios SET producto_cantidad = $actC WHERE id_producto = ?");


}

function obtenerProductosInvitado()
{
    $bd = obtenerConexionInvitado();
    $sentencia = $bd->query("SELECT ID_PRODUCTO, NOMBRE, DESCRIPCION, PRECIO, IMG FROM catalogo");
    #r
    return $sentencia->fetchAll();
}
function productoYaEstaEnCarritoInvitado($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarritoInvitado();
    foreach ($ids as $id) {
        if ($id == $idProducto) return true;
    }
    return false;
}

function obtenerIdsDeProductosEnCarritoInvitado()
{
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $sentencia = $bd->prepare("SELECT id_producto FROM carrito_usuarios WHERE id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function obtenerCantidadDeProductosEnCarritoInvitado($cantidadProducto)
{
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $sentencia = $bd->prepare("SELECT carrito_usuarios.producto_cantidad FROM carrito_usuarios WHERE id_sesion = ? ");
    $idSesion = session_id();
    $sentencia->execute([$idSesion,$cantidadProducto]);
    return $sentencia->fetchAll();
}
function agregarProductoAlCarritoInvitado($idProducto)
{
    $Nomb=$_POST['Nombreee'];
    $cantidad=$_POST['cantidad_carrito'];
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $idSesion = session_id();
    $sentencia = $bd->prepare("INSERT INTO carrito_usuarios(id_sesion, id_producto, producto_cantidad, nombre) VALUES (?,?,$cantidad,'$Nomb')");
    return $sentencia->execute([$idSesion, $idProducto]);
}

function TerminarCompraInvitado($idProducto)
{
    include_once 'ver_carrito.php';
$ID_VENTA= 5;
$ID_PRODUCTO= 2;
$NOMBRE = $_POST['Nombreee'];
$CANTIDAD = $_POST['id_producto1'];
$PRECIO_TOTAL = $_POST['total'];
    $bd = obtenerConexionInvitado();
    iniciarSesionSiNoEstaIniciadaInvitado();
    $idSesion = session_id();
    $sentencia = $bd->prepare("INSERT INTO ventas (ID_VENTA,ID_PRODUCTO,NOMBRE,CANTIDAD,PRECIO_TOTAL)VALUES 
 ('$ID_VENTA','$ID_PRODUCTO','$NOMBRE,'$CANTIDAD','$PRECIO_TOTAL')");
    return $sentencia->execute([$idSesion, $idProducto]);
}


function iniciarSesionSiNoEstaIniciadaInvitado()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function eliminarProductoInvitado($id)
{
    $bd = obtenerConexionInvitado();
    $sentencia = $bd->prepare("DELETE FROM productos WHERE id = ?");
    return $sentencia->execute([$id]);
}

function guardarProductoInvitado($nombre, $precio, $descripcion)
{
    $bd = obtenerConexionInvitado();
    $sentencia = $bd->prepare("INSERT INTO productos(nombre, precio, descripcion) VALUES(?, ?, ?)");
    return $sentencia->execute([$nombre, $precio, $descripcion]);
}

function obtenerVariableDelEntornoInvitado($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}
function obtenerConexionInvitado()
{
    $password = obtenerVariableDelEntornoInvitado("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntornoInvitado("MYSQL_USER");
    $dbName = obtenerVariableDelEntornoInvitado("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}
