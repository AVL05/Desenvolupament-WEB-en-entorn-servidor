<?php
session_start();

$host = 'localhost';
$dbname = 'discografia';
$db_user = 'root';
$db_pass = '';

$message = '';
$show_form = true;
$show_cookie_prompt = false;
$saved_user = '';

if (isset($_GET['action']) && $_GET['action'] === 'delete_cookie') {
    setcookie('remember_user', '', 1, '/');
    unset($_COOKIE['remember_user']);
    $show_form = true;
}

if (isset($_GET['action']) && $_GET['action'] === 'confirm_cookie') {
    if (isset($_COOKIE['remember_user'])) {
        $_SESSION['usuario'] = $_COOKIE['remember_user'];
        header('Location: index.php');
        exit();
    }
}

if (isset($_COOKIE['remember_user']) && !isset($_GET['action'])) {
    $saved_user = htmlspecialchars($_COOKIE['remember_user']);
    $show_cookie_prompt = true;
    $show_form = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($usuario) && !empty($password)) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("SELECT id, usuario, password FROM tabla_usuarios WHERE usuario = :usuario");
            $stmt->execute([':usuario' => $usuario]);
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['usuario'] = $user['usuario'];
                
                setcookie('remember_user', $user['usuario'], time() + (86400 * 30), '/');
                
                header('Location: index.php');
                exit();
            } else {
                $message = 'Login failed';
            }
            
        } catch (PDOException $e) {
            $message = 'Error de conexión: ' . htmlspecialchars($e->getMessage());
        }
    } else {
        $message = 'Por favor, complete todos los campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <?php if ($show_cookie_prompt): ?>
        <p>Do you want to log in as <?php echo $saved_user; ?>?</p>
        <form method="GET" action="">
            <button type="submit" name="action" value="confirm_cookie">Yes</button>
            <button type="submit" name="action" value="delete_cookie">No</button>
        </form>
    <?php endif; ?>
    
    <?php if ($show_form): ?>
        <form method="POST" action="">
            <div>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        
        <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
    <?php endif; ?>
</body>
</html>
