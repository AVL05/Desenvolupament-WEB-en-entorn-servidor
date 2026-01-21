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
	?>
    <title>Document</title>
</head>
<body>
    <?php
        echo '<button  onclick=location.href="./index.php">Volver</button>';
        $conectar = new Conexion('localhost','root','','discografia');
		$conexion = $conectar->conectionPDO();
        $titulo = isset($_GET['titulo']) ? $_GET['titulo'] : (isset($_GET['cod']) ? $_GET['cod'] : '');
        $album = new Album('',$titulo,'','','','','');
        $album->borrarDisco($conexion,$_GET['TC']);
    ?>
</body>
</html>