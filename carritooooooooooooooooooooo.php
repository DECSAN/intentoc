<link rel="stylesheet" href="css/ver_carrito.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <script src="main.js"></script>
<?php
include 'db.php';

if(!isset($_SESSION['correo'])) {

}
?>
<?php
include_once "funciones.php";
$productos = obtenerProductosEnCarrito();
$cant = obtenerCantidadDeProductosEnCarrito();
if (count($productos) <= 0) {
?>

    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Todavía no hay productos
                </h1>
                <h2 class="subtitle">
                    Visita la tienda para agregar productos a tu carrito
                </h2>
                <a href="tienda.php" class="button is-warning">Ver tienda</a>
            </div>
        </div>
    </section>
<?php } else { ?>
    <div class="columns">
        <div class="column">
            <h2 class="is-size-2">Mi carrito de compras</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal=0;
                    $total_compra = 0;
                    $canti=0;



                    foreach ($productos as  $producto){
                        $subtotal =$producto->PRECIO;
                        $total_compra += $subtotal;
                   

                    
                        
                    ?>
                    <div class="row">
                            <div class="col-md-2">

                        </div> 
                   
                        <tr>  
                            <td> <img class="frontal" src="data:image/jpeg;base64,<?php 
                           echo base64_encode($producto->IMG );  ?> "width="100" height="100" /></td>
                            <td><?php echo $producto->NOMBRE ?></td>
                            <?php foreach ($cant as $cantidad) {
                                $canti = echo number_format ($cantidad->producto_cantidad);
                            } ?>
                            <td><?php echo number_format ($cantidad->producto_cantidad)  ?></td>
                            <td>$<?php echo number_format($producto->PRECIO)  ?></td>
                            <td>$<?php echo number_format($producto->PRECIO*$canti, 2) ?></td>
                            
                                <form action="eliminar_del_carrito.php" method="post">
                                    <input type="hidden" name="id_producto" value="<?php echo $producto->ID_PRODUCTO?>">
                                    <input type="hidden" name="redireccionar_carrito">
                                    <button class="button is-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        <?php } ?>
                        </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                        <td colspan="2" class="is-size-4">
                            $<?php echo number_format($total_compra*$canti, 2) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <a href="terminar_compra.php" class="button is-success is-large"><i class="fa fa-check"></i>&nbsp;Terminar compra</a>
        </div>
    </div>
<?php  }?>

-------------



<?php
include 'db.php';

if(!isset($_SESSION['correo'])) {
    session_start();


}
?>
<?php
function obtenerProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
     $sentencia = $bd->prepare("SELECT catalogo.ID_PRODUCTO, catalogo.NOMBRE, catalogo.DESCRIPCION, catalogo.PRECIO ,catalogo.IMG
     FROM catalogo
     INNER JOIN carrito_usuarios
     ON catalogo.ID_PRODUCTO = carrito_usuarios.id_producto
     WHERE carrito_usuarios.id_sesion = ?");
    $idSesion = $_SESSION['correo'];
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}
function CantidadCarrito($value='')
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion=$_SESSION['correo'];
    
    # code...
}
function quitarProductoDelCarrito($idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = $_SESSION['correo'];
    $sentencia = $bd->prepare("DELETE FROM carrito_usuarios WHERE id_sesion = ? AND id_producto = ?");
    return $sentencia->execute([$idSesion, $idProducto]);
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT ID_PRODUCTO, NOMBRE, DESCRIPCION, PRECIO, IMG FROM catalogo");
    #r
    return $sentencia->fetchAll();
}
function productoYaEstaEnCarrito($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarrito();
    foreach ($ids as $id) {
        if ($id == $idProducto) return true;
    }
    return false;
}

function obtenerIdsDeProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT id_producto FROM carrito_usuarios WHERE id_sesion = ?");
    $idSesion = $_SESSION['correo'];
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function obtenerCantidadDeProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT producto_cantidad FROM carrito_usuarios WHERE id_sesion = ?");
    $idSesion = $_SESSION['correo'];
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}
function agregarProductoAlCarrito($idProducto)
{
    $cantidad=$_POST['cantidad_producto'];
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = $_SESSION['correo'];
    $sentencia = $bd->prepare("INSERT INTO carrito_usuarios(id_sesion, id_producto, producto_cantidad) VALUES (?, ?,$cantidad)");
    return $sentencia->execute([$idSesion, $idProducto]);
}


function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM productos WHERE id = ?");
    return $sentencia->execute([$id]);
}

function guardarProducto($nombre, $precio, $descripcion)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productos(nombre, precio, descripcion) VALUES(?, ?, ?)");
    return $sentencia->execute([$nombre, $precio, $descripcion]);
}

function obtenerVariableDelEntorno($key)
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
function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}