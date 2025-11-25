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
		<title>Discografía</title>
		<?php
			include("datos.ini.php");
			include("conexion.ini.php");
			include("album.ini.php");
		?>
	</head>
	<body>
		<p>User: <?= htmlspecialchars($_SESSION['usuario']) ?> | <a href="logout.php">Logout</a></p>
		<?php
			datosDiscografia();
		?>
	</body>
</html>
