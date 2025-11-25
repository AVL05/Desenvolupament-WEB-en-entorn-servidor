<?php
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

// Calcular edad
$fecha_nacimiento = strtotime($usuario['fecha_nacimiento']);
$edad = date('Y') - date('Y', $fecha_nacimiento);
if (date('md') < date('md', $fecha_nacimiento)) {
    $edad--;
}

// Formatear fecha de registro
$fecha_registro_formateada = date('d/m/Y H:i', strtotime($usuario['fecha_registro']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario (MySQL)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .badge-mysql {
            background-color: #00758f;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 10px;
        }
        .perfil-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .bienvenida {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 30px;
            border-left: 4px solid #2e7d32;
            text-align: center;
        }
        .bienvenida h2 {
            margin: 0;
        }
        .info-grupo {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .info-valor {
            color: #333;
            font-size: 16px;
        }
        .btn-cerrar-sesion {
            display: block;
            width: 100%;
            background-color: #f44336;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }
        .btn-cerrar-sesion:hover {
            background-color: #da190b;
        }
        .icono-usuario {
            text-align: center;
            font-size: 80px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Perfil de Usuario <span class="badge-mysql">MySQL</span></h1>
    
    <div class="perfil-container">
        <div class="icono-usuario">👤</div>
        
        <div class="bienvenida">
            <h2>¡Bienvenido/a, <?php echo htmlspecialchars($usuario['username']); ?>!</h2>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">ID de Usuario:</div>
            <div class="info-valor"><?php echo htmlspecialchars($usuario['id']); ?></div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Nombre de usuario:</div>
            <div class="info-valor"><?php echo htmlspecialchars($usuario['username']); ?></div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Email:</div>
            <div class="info-valor"><?php echo htmlspecialchars($usuario['email']); ?></div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Edad:</div>
            <div class="info-valor"><?php echo $edad; ?> años</div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Fecha de nacimiento:</div>
            <div class="info-valor"><?php echo date('d/m/Y', $fecha_nacimiento); ?></div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Género:</div>
            <div class="info-valor"><?php echo ucfirst(htmlspecialchars($usuario['genero'])); ?></div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Publicidad:</div>
            <div class="info-valor"><?php echo $usuario['publicidad'] ? 'Sí' : 'No'; ?></div>
        </div>
        
        <div class="info-grupo">
            <div class="info-label">Miembro desde:</div>
            <div class="info-valor"><?php echo $fecha_registro_formateada; ?></div>
        </div>
        
        <a href="cerrar_sesion.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
    </div>
</body>
</html>
