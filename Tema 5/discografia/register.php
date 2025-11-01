<?php
session_start();

$host = 'localhost';
$dbname = 'discografia';
$db_user = 'root';
$db_pass = '';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (!empty($usuario) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $db_user, $db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $pdo->prepare("SELECT id FROM tabla_usuarios WHERE usuario = :usuario");
                $stmt->execute([':usuario' => $usuario]);
                
                if ($stmt->fetch()) {
                    $message = 'El usuario ya existe';
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO tabla_usuarios (usuario, password) VALUES (:usuario, :password)");
                    $stmt->execute([
                        ':usuario' => $usuario,
                        ':password' => $hashedPassword
                    ]);
                    
                    $message = 'Usuario registrado correctamente';
                }
                
            } catch (PDOException $e) {
                $message = 'Error de conexión: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $message = 'Las contraseñas no coinciden';
        }
    } else {
        $message = 'Por favor, complete todos los campos';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div>
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit">Registrarse</button>
    </form>
    
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</body>
</html>
