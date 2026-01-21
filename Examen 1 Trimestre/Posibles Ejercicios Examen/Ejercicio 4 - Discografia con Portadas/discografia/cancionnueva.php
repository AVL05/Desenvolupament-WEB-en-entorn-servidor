<?php
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: login.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
		include("datos.ini.php");
        include("conexion.ini.php");
        include("cancion.ini.php");
	?>
    <title>Document</title>
</head>
<body>
    <?php
        $albumCodigo = isset($_GET['cod']) ? $_GET['cod'] : '';
        $albumTitulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
        $cancion = new Cancion('',$albumCodigo,'','','');
        formularioCancion($cancion, $albumTitulo);
    ?>
</body>
</html>