<?php
include 'db.php';

session_start();
if(!isset($_SESSION['correo'])) {
header("location:LoginProyecto.html");

}
?>
 <link rel="stylesheet" href="css/ticket.css">
<?php
include_once "funciones.php";
$productos = obtenerProductosEnCarrito();
$correo = $_SESSION['correo'];
$sql = "SELECT NOMBRE, APELLIDO_PATERNO,CORREO FROM registro WHERE correo = '$correo'";
$resultado = $conexion->query($sql);
$row =$resultado->fetch_assoc();


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
        <div id="ticket" class="column">
            <h2>TICKET</h2>
              
            <h4>DECSAN Decoraciones Santiago</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal=0;
                    $total_compra = 0;
                    $iva=0;
                    $canti=0;

              foreach ($productos as $producto ): 
              $subtotal =$producto->PRECIO*$producto->producto_cantidad;
              $total_compra += $subtotal;
              $iva=$total_compra*0.15;
              $canti = $producto->producto_cantidad;
            ?>
                <div class="row">
                    <div class="col-md-2">
                    </div> 
                    <tr>  
                         
                            <td ><?php echo $producto->NOMBRE ?></td>
                            <input type="hidden" name="Nombreee" value="<?php echo $producto->NOMBRE ?>">
                            

                            
                            <td><p><?php echo number_format($producto->producto_cantidad) ?></p>
                            <input type="hidden" name="id_producto1" value="<?php echo number_format($producto->producto_cantidad) ?>"></td>
                            <td name="precio">$<?php echo number_format($producto->PRECIO)  ?></td>
                            <td cl>$<?php echo number_format($subtotal, 2) ?></td>
                           <td>
                            </td>
                        
                        <?php endforeach; ?>
                       
                    
                        </tr>
                
                
                    <tr>
                        <td><strong>IVA 15%</strong></td>
                        <td>
                            $<?php echo number_format($iva, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Subtotal</strong></td>
                        <td>
                            $<?php echo number_format($total_compra, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td class="hola">
                            $<?php echo number_format($total_compra+$iva, 2) ?>
                        </td>
                     </tr>
                    </tr>
                </tfoot>
            </table>
            <p>
Direccion:
Guillermo Prieto, Jamaica, Ciudad de México,
 CDMX Puerta #5 Local#
</p>

<p>
Correo empresarial:
decsan.flores@gmail.com</p>
            
        <button  class="oculto-impresion" onclick="window.print()">Imprimir Factura</button>
        
        </div>
        </div>
<?php } ?>