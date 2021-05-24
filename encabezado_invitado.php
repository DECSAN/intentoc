<?php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<a href="ver_carrito_invitado.php" >
<strong>Ver carrito <?php
                                include_once "funciones_invitado.php";
                        $conteo = count(obtenerIdsDeProductosEnCarritoInvitado());
                                                if ($conteo > 0) {
                                                    printf("(%d)", $conteo);
                                                }
                                                ?>&nbsp;<i class="fa fa-shopping-cart"></i></strong>
                        </a>
                    </body>
                    </html>
              