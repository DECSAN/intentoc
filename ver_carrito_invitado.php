<link rel="stylesheet" href="css/ver_carrito.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <script src="main.js"></script>
        
<?php
include 'db.php';


?>
<?php
include_once "funciones_invitado.php";

$productos = obtenerProductosEnCarritoInvitado();


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
   <link rel="stylesheet" href="css/carrito.css">
       
            <h2>Mi carrito de compras</h2>
            <table class="prueba">
                <thead>
                    <tr>
                        <th >Producto</th>
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
                    
                    <tr class="active-row">  
                         <td> <img class="frontal" src="data:image/jpeg;base64,<?php 
                           echo base64_encode($producto->IMG );  ?> "width="100" height="100" /></td>
                            <td name="name"><?php echo $producto->NOMBRE ?></td>
                            

                            <td>
                            <form action="actualizarcantidad_invitado.php" method="post">
                            <input type="number" min="1" pattern="^[0-9]+" name="id_producto1" value="<?php echo number_format($producto->producto_cantidad) ?>">
                            <input type="hidden" name="Nombreee" value="<?php echo $producto->NOMBRE ?>">   

                                        <button  class="button is-danger">Actualizar</button>

                                        <input type="hidden" name="redireccionar_carrito1_invitado">

                            </form>
                            </td>
                            <td name="precio">$<?php echo number_format($producto->PRECIO)  ?></td>
                            <td>$<?php echo number_format($subtotal, 2) ?></td>
                           <td>
                            <form action="eliminar_del_carrito_invitado.php" method="post">

                                    <input type="hidden" name="id_producto" value="<?php echo $producto->ID_PRODUCTO?>">
                                    <input type="hidden" name="redireccionar_carrito">
                                    <button class="button is-danger">
                                        <i class="fa fa-trash-o"></i>
                                
                                    </button>
                                
                                </form>
                            </td>
                        
                        <?php endforeach; ?>
                       
                    
                        </tr>
                
                
                    <tr>
                        <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                        <td name="total" colspan="2" class="is-size-4">
                            $<?php echo number_format($total_compra, 2) ?>
                        </td>

                    </tr>
                </tfoot>
            </table>

 </div> 
            <button onclick="location.href='confirmar_pedido_invitado.php'" type="button">Revisar Pedido</button>




<?php } ?>
