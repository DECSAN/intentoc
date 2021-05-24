<!DOCTYPE html>
<html>
<head>
	<title>InicioProyecto</title>
</head>

<body>
<h1>PRODUCTOS</h1>
<div class="container">
	<?php
	include 'db.php';
	$query ="SELECT * FROM catalogo";
	$resultado=$conexion->query($query);
	while ($row=$resultado->fetch_assoc()){
		?>
		<div>
			<img src="data:image/jpg;base64, <?php echo base64_encode($row['IMG']);?>">
			<h4><?php echo $row['NOMBRE']; ?></h4>
			<p><?php echo $row['DESCRIPCION']; ?></p>
			<p>$<?php echo $row['PRECIO']; ?></p>
			<a href="#">Comprar</a>
		</div>

		<?php
	}
	?>
	}
</div>
</body>
</html>