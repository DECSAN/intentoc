<?php
include 'db.php';
$_SESSION=['correo'];
$conexion=mysqli_connect("localhost","root","","floreria");
$ID_VENTA= 6;
$ID_PRODUCTO=8;
$NOMBRE = $_POST['Nombreee'];
$CANTIDAD = $_POST['id_producto1'];
$PRECIO_TOTAL = $_POST['total'];
    $sentencia ="INSERT INTO ventas (ID_VENTA,ID_PRODUCTO,NOMBRE,CANTIDAD,PRECIO_TOTAL)VALUES 
                                  ('$ID_VENTA','$ID_PRODUCTO','$NOMBRE','$CANTIDAD','$PRECIO_TOTAL')";
        if(mysqli_query($conexion, $sentencia)){

         header("location:ticket.php");
    } else {
        echo "ERROR: No se ejecuto $sentencia. " . mysqli_error($conexion);
    }
    // Cierra la conexion
    mysqli_close($conexion);


    ?>
