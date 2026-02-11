<?php
session_start();
require_once('conexion.ini.php');

// Si ya hay sesión activa, redirigir a index
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$mensaje = '';
$usuarioCookie = isset($_COOKIE['usuario_recordado']) ? $_COOKIE['usuario_recordado'] : null;

// Manejar la respuesta de "recordar usuario"
if (isset($_POST['accion'])) {
    if ($_POST['accion'] === 'si' && isset($_POST['usuario_cookie'])) {
        $_SESSION['usuario'] = $_POST['usuario_cookie'];
        echo '<p>Access successful</p>';
        echo '<a href="index.php">Go to index</a>';
        exit();
    } elseif ($_POST['accion'] === 'no') {
        setcookie('usuario_recordado', '', time() - 3600, '/');
        $usuarioCookie = null;
    }
}

// Manejar el login normal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['accion'])) {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!empty($usuario) && !empty($password)) {
        $conexionObj = new Conexion('localhost', 'root', '', 'discografia');
        $conexion = $conexionObj->conectionPDO();
        
        try {
            $stmt = $conexion->prepare("SELECT usuario, password FROM tabla_usuarios WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario_db && password_verify($password, $usuario_db['password'])) {
                $_SESSION['usuario'] = $usuario_db['usuario'];
                setcookie('usuario_recordado', $usuario_db['usuario'], time() + (30 * 24 * 60 * 60), '/');
                $mensaje = 'Login successful';
            } else {
                $mensaje = 'Login failed';
            }
        } catch (PDOException $e) {
            $mensaje = 'Login failed';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <?php if ($mensaje): ?>
        <p><?= $mensaje ?></p>
        <?php if ($mensaje === 'Login successful'): ?>
            <a href="index.php">Go to index</a>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if ($usuarioCookie): ?>
        <p>Do you want to log in as <?= htmlspecialchars($usuarioCookie) ?>?</p>
        <form method="POST">
            <input type="hidden" name="usuario_cookie" value="<?= htmlspecialchars($usuarioCookie) ?>">
            <button type="submit" name="accion" value="si">Yes</button>
            <button type="submit" name="accion" value="no">No</button>
        </form>
        <hr>
    <?php endif; ?>
    
    <form method="POST">
        <label>Usuario: <input type="text" name="usuario" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
    
    <p><a href="registro.php">Register</a></p>
</body>
</html>
