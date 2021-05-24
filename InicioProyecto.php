<?php
include 'db.php';
session_start();
if(!isset($_SESSION['correo'])) {
header("location:LoginProyecto.html");

}

$correo = $_SESSION['correo'];
$sql = "SELECT NOMBRE, APELLIDO_PATERNO FROM registro WHERE correo = '$correo'";
$resultado = $conexion->query($sql);
$row =$resultado->fetch_assoc();

 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="SHORTCUT ICON" href="https://drive.google.com/uc?id=1v3uNYAY_ScSMDl-LYJNA81eVE-zKLmH6">
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/IP.css">
    <link rel="stylesheet" href="css/nuevosestilos.css">
</head>
<body>
</script></div><div class=»n»><div class=»n»> <a href=»#» title=»Ir arriba»><img alt=»Ir arriba» border=»0″ src=»http://2.bp.blogspot.com/_qgZA1ny_dAs/S0QFsV1WD7I/AAAAAAAADhs/ZBKrnpzqBrk/s200/arrow8a.png» style=position:fixed;bottom:0;right:0;/></a> </div>
<!--menudesplegable izquierdo-->

    <header class="header">
        <div class="container">
        <div class="btn-menu">
            <label for="btn-menu">☰</label>
        </div>
            <div class="logo">
                <h1>Menu</h1>

            </div>
            <nav class="menu">
            <!-- menu derecho-->
                <a href="#">Inicio</a>
                <a href="#">Categorias</a>
                <a href="#">Arreglos</a>
  
                
            </nav>
        </div>

    </header>
  <br>
  <br>
  <br>
  <br>
  <br>
      <!--menudesplegable izquierdo-->
      <?php
     include_once "encabezado.php";
include_once "funciones.php";
    
    include 'db.php';
    include_once "funciones.php";
    $query ="SELECT * FROM catalogo";

    $resultado=$conexion->query($query);
    while ($row=$resultado->fetch_assoc()){
        ?>
        <div class="container">
        <div class="card">
            <img src="data:image/jpg;base64, <?php echo base64_encode($row['IMG']);?>">
            <h4><?php echo $row['NOMBRE']; ?></h4>
            <input type="hidden" name="Nombreee" value="<?php echo $row['NOMBRE']; ?>">
            <p><?php echo $row['DESCRIPCION']; ?></p>
            <p>$<?php echo $row['PRECIO']; ?>.00</p>
            <?php if (productoYaEstaEnCarrito($row['ID_PRODUCTO'])) { ?>
                        <form action="eliminar_del_carrito.php" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $row['ID_PRODUCTO']; ?>">
                            <span class="button is-success">
                                <i class="fa fa-check"></i>&nbsp;En el carrito
                            </span>
                            <button class="button is-danger">
                                <i class="fa fa-trash-o"></i>&nbsp;Quitar
                            </button>
                        </form>
                    <?php } else { ?>
                         <form action="agregar_al_carrito.php" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $row['ID_PRODUCTO']; ?>">
                            <input type="hidden" name="cantidad_carrito" value="1">
                            <input type="hidden" name="Nombreee" value="<?php echo $row['NOMBRE']; ?>">
                         
                            <button class="add-cart">
                     
                                <i class="fa fa-cart-plus"></i>&nbsp;Agregar al carrito
                            </button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
<?php  ?>
        </div>

        <?php
    }
    ?>
<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  
   
    <!---->
<!--    --------------->
<input type="checkbox" id="btn-menu">
<div class="container-menu">

    <div class="cont-menu">
        <nav>
        <!--imagen De perfil-->
        <div id="perfil">
            <img src="https://holatelcel.com/wp-content/uploads/2020/09/instagram-foto-de-perfil-4.jpg" width="50%"   ></div>    
            <div id="name" > <span>
                
                <?php echo utf8_decode ($row['NOMBRE']); ?>
                <?php echo utf8_decode ($row['APELLIDO_PATERNO']); ?>

            </span></div>
            <!--menu desplegable-->
            <a href="#">Ofertas</a>
            <a href="#">Contactanos</a>
            <a href="#">Ayuda</a>
            <a href="salir.php">Cerrar sesion</a>

            <a href="configuracion.php">Configuracion</a>
            
        </nav>
        <label for="btn-menu">✖️</label>

    </div>
</div>

    


</body>
</html>