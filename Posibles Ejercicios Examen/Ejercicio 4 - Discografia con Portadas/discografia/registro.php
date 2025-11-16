<?php
require_once('conexion.ini.php');

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    
    if (!empty($usuario) && !empty($password) && $password === $password2) {
        $conexionObj = new Conexion('localhost', 'root', '', 'discografia');
        $conexion = $conexionObj->conectionPDO();
        
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conexion->prepare("INSERT INTO tabla_usuarios (usuario, password) VALUES (?, ?)");
            
            if ($stmt->execute([$usuario, $passwordHash])) {
                $mensaje = 'Registration successful';
            } else {
                $mensaje = 'Registration failed';
            }
        } catch (PDOException $e) {
            $mensaje = 'Registration failed';
        }
    } else {
        $mensaje = 'Invalid data';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    
    <?php if ($mensaje): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <label>Usuario: <input type="text" name="usuario" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>Repeat Password: <input type="password" name="password2" required></label><br>
        <button type="submit">Register</button>
    </form>
    
    <p><a href="login.php">Login</a></p>
</body>
</html>
