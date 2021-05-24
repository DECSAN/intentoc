<?php
include 'db.php';

session_start();
if(!isset($_SESSION['correo'])) {
header("location:LoginProyecto.html");

}
?>

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

              foreach ($productos as $producto ): 
              $subtotal =$producto->PRECIO*$producto->producto_cantidad;
              $total_compra += $subtotal;
              $canti = $producto->producto_cantidad;
            ?>
                <div class="row">
                    <div class="col-md-2">
                    </div> 
                    <form action="terminar_compra.php" method="POST">
                    <tr>  
                         <td> <img class="frontal" src="data:image/jpeg;base64,<?php 
                           echo base64_encode($producto->IMG );  ?> "width="100" height="100" /></td>
                            <td ><?php echo $producto->NOMBRE ?></td>
                            <input type="hidden" name="Nombreee" value="<?php echo $producto->NOMBRE ?>">
                            

                            <td>
                            
                            <p><?php echo number_format($producto->producto_cantidad) ?></p>
                            <input type="hidden" name="id_producto1" value="<?php echo number_format($producto->producto_cantidad) ?>">   



                            
                            </td>
                            <td name="precio">$<?php echo number_format($producto->PRECIO)  ?></td>
                            <td>$<?php echo number_format($subtotal, 2) ?></td>
                           <td>
                            </td>
                        
                        <?php endforeach; ?>
                       
                    
                        </tr>
                
                
                    <tr>
                        <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                        <td  colspan="2" class="is-size-4">
                            $<?php echo number_format($total_compra, 2) ?>
                            <input type="hidden" name="total" value="<?php echo number_format($total_compra, 2) ?>">

                        </td>

                    </tr>
                    </th>

                </tfoot>
            </table>
            <div>
                <h1>DETALLES DE ENVIO</h1>
                        <p>Nombre: <?php echo utf8_decode ($row['NOMBRE']); ?></p> 
                   <p>Apellidos: <?php echo utf8_decode ($row['APELLIDO_PATERNO']); ?></p> 
                    <p>Correo: <?php echo ($row['CORREO']); ?></p> 
         </div>
        </div>
       
  
     <input type="submit" name="terminar_compra" value="Terminar Compra">
       </form>
    </div>
<?php } ?>