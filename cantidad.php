<?php
                    $subtotal=0;
                    $total_compra = 0;
                    $canti=0;
 $cant = obtenerCantidadDeProductosEnCarrito();
 $productos = obtenerProductosEnCarrito();
foreach ($cant as $cantidad ){

                           $canti = $cantidad->producto_cantidad;
                            }?>




                           <?php foreach ($productos as $producto ) {
 $subtotal =$producto->PRECIO;
$total_compra += $subtotal;

 }?>

                          