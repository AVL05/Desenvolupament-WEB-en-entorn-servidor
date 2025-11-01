<?php
$host = 'localhost';
$dbname = 'discografia';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $users = [
        ['usuario' => 'admin', 'password' => 'admin123'],
        ['usuario' => 'user1', 'password' => 'password1'],
        ['usuario' => 'user2', 'password' => 'password2'],
        ['usuario' => 'test', 'password' => 'test123']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO tabla_usuarios (usuario, password) VALUES (:usuario, :password)");
    
    foreach ($users as $user) {
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        $stmt->execute([
            ':usuario' => $user['usuario'],
            ':password' => $hashedPassword
        ]);
        echo "Usuario '{$user['usuario']}' insertado correctamente.<br>";
    }
    
    echo "<br>Todos los usuarios han sido insertados exitosamente.";
    
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
