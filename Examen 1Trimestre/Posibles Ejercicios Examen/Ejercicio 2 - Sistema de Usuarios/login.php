<?php
// ========================================
// EJERCICIO 2: SISTEMA DE LOGIN (MYSQL)
// ========================================

session_start();  // Iniciar sesión
require_once('config.php');  // Conexión a BD

// --- CONECTAR A LA BASE DE DATOS ---
$db = getDBConnection('sistema_usuarios_db');

// --- REDIRIGIR SI YA ESTÁ LOGUEADO ---
if (isset($_SESSION['usuario'])) {
    header('Location: perfil.php');
    exit();
}

$error = '';  // Variable para mensaje de error

// ==========================================
// PROCESAR LOGIN (MÉTODO POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            throw new Exception('Por favor, complete todos los campos');
        }
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // --- BUSCAR USUARIO EN LA BD ---
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $usuario = $stmt->fetch();
        
        if (!$usuario) {
            throw new Exception('Usuario no encontrado');
        }
        
        // --- VERIFICAR CONTRASEÑA (HASH) ---
        if (password_verify($password, $usuario['password_hash'])) {
            
            // --- GUARDAR DATOS EN SESIÓN ---
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'username' => $usuario['username'],
                'email' => $usuario['email'],
                'fecha_nacimiento' => $usuario['fecha_nacimiento'],
                'genero' => $usuario['genero'],
                'publicidad' => $usuario['publicidad'],
                'fecha_registro' => $usuario['fecha_registro']
            ];
            
            header('Location: perfil.php');
            exit();
        } else {
            throw new Exception('Contraseña incorrecta');
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión (MySQL)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 100px auto;
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
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
        }
        .link-registro {
            text-align: center;
            margin-top: 20px;
        }
        .link-registro a {
            color: #4CAF50;
            text-decoration: none;
        }
        .link-registro a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Iniciar Sesión <span class="badge-mysql">MySQL</span></h1>
    
    <?php if ($error): ?>
        <div class="error">
            <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <div class="form-container">
        <form method="post" action="#">
            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                       required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required>
            </div>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        
        <div class="link-registro">
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
