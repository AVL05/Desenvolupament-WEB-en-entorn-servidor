<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h2>Gestión de Tareas</h2>
        <nav>
            <a href="index.php">Lista Tareas</a> | 
            <a href="nueva_tarea.php">Nueva Tarea</a> | 
            <a href="buscar.php">Buscar</a> | 
            <a href="perfil.php">Mi Perfil</a>
        </nav>
        <div>
            <img src="<?php echo htmlspecialchars($_SESSION['usuario_img']); ?>" alt="Perfil" width="40" height="40">
            <span><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </header>
    <hr>
