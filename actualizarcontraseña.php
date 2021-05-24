<?php

    $conexion=mysqli_connect('localhost','root','','floreria') or die ('Error en la base de datos');

$id_cliente= null;

    $sql="UPDATE registro SET ('".$_POST["CONTRASEÑA"]."')";

    $resultado=mysqli_query($conexion,$sql) or die ('Error en el query');

    mysqli_close($conexion);


    echo  "Datos Guardados Correctamente<br><a href='InicioProyecyo.php'>Si</a>";
  
?>