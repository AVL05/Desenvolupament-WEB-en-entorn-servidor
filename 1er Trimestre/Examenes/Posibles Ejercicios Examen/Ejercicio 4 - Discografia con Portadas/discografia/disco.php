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
        include("album.ini.php");
        include("cancion.ini.php");
	?>
    <title>Document</title>
</head>
<body>
    <?php
        $titulo = isset($_GET['cod']) ? $_GET['cod'] : (isset($_GET['titulo']) ? $_GET['titulo'] : '');
        $album = new Album('',$titulo,'','','','','');
        datosDisco($album);
    ?>
</body>
</html>