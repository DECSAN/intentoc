<?php

    $conexion=mysqli_connect('localhost','root','','floreria') or die ('Error en la base de datos');
    
$id_cliente= null;
$nombre =$_POST['NOMBRE'];
$apellido_paterno =$_POST['APELLIDO_PATERNO'];
$apellido_materno =$_POST['APELLIDO_MATERNO'];
$correo =$_POST['CORREO'];
$telefono =$_POST['TELEFONO'];
$contraseña =$_POST['CONTRASEÑA'];




 $sql="INSERT INTO registro (ID_REGISTRO,NOMBRE,APELLIDO_PATERNO,APELLIDO_MATERNO,CORREO,TELEFONO,CONTRASEÑA)VALUES ('$id_cliente','$nombre','$apellido_paterno','$apellido_materno','$correo','$telefono','$contraseña')";

    $resultado=mysqli_query($conexion,$sql) or die ('Error en el query');

    mysqli_close($conexion);


    echo  "Datos Guardados Correctamente<br><a href='LoginProyecto.html'>Volver</a>";
  
?>

