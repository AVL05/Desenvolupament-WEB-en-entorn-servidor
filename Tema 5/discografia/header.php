<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Discografía</title>
</head>
<body>
    <div style="background-color: #f0f0f0; padding: 10px; margin-bottom: 20px;">
        <span>Usuario: <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></span>
        | <a href="logout.php">Cerrar sesión</a>
    </div>
