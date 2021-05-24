<?php
include 'db.php';
session_start();
if(!isset($_SESSION['correo'])) {
header("location:LoginProyecto.html");

}
?>
   <?php
include_once "funciones.php";
$productos = obtenerProductos();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Tienda</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
            aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <header>
        <div class="container">
            <h1 class="text-center">TIENDA</h1>
            <hr>
        </div>
    </header>
     <?php foreach ($productos as $producto) { ?>
    <!-- START SECTION STORE -->
    <section class="store">
        <div class="container">
            <div class="items">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="item shadow mb-4">
                            <h3 class="item-title"><?php echo $producto->NOMBRE ?></h3>
                            <img class="item-image" src="data:image/jpeg;base64,<?php 
                 echo base64_encode($producto->IMG ); 
                     ?>" />
 
                            <div class="item-details">
                                <h4 class="item-price">$<?php echo number_format($producto->PRECIO, 2) ?></h4>
                                <button class="item-button btn btn-primary addToCart">AÑADIR AL CARRITO</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </section>
    <?php } ?>
    <!-- END SECTION STORE -->
    <!-- START SECTION SHOPPING CART -->
    <section class="shopping-cart">
        <div class="container">
            <h1 class="text-center">CARRITO</h1>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="shopping-cart-header">
                        <h6>Producto</h6>
                    </div>
                </div>
                <div class="col-2">
                    <div class="shopping-cart-header">
                        <h6 class="text-truncate">Precio</h6>
                    </div>
                </div>
                <div class="col-4">
                    <div class="shopping-cart-header">
                        <h6>Cantidad</h6>
                    </div>
                </div>
            </div>
            <!-- ? START SHOPPING CART ITEMS -->
            <div class="shopping-cart-items shoppingCartItemsContainer">
            </div>
            <!-- ? END SHOPPING CART ITEMS -->

            <!-- START TOTAL -->
            <div class="row">
                <div class="col-12">
                    <div class="shopping-cart-total d-flex align-items-center">
                        <p class="mb-0">Total</p>
                        <p class="ml-4 mb-0 shoppingCartTotal">$0</p>
                        <div class="toast ml-auto bg-info" role="alert" aria-live="assertive" aria-atomic="true"
                            data-delay="2000">
                            <div class="toast-header">
                                <span>✅</span>
                                <strong class="mr-auto ml-1 text-secondary">Elemento en el carrito</strong>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body text-white">
                                Se aumentó correctamente la cantidad
                            </div>
                        </div>
                        <button class="btn btn-success ml-auto comprarButton" type="button" data-toggle="modal"
                            data-target="#comprarModal">Comprar</button>
                    </div>
                </div>
            </div>
             </div>

            <!-- END TOTAL -->




        </div>

    </section>
    <!-- END SECTION SHOPPING CART -->


    <!-- START FOOTER -->
    <footer class="bg-dark p-3 mt-5">
        <p class="text-center m-0 text-muted">Tienda video juegos</p>
    </footer>
    <!-- END FOOTER -->




    <!-- SCRIPTS -->
  

    <script src="tienda.js"></script>

</body>

</html>