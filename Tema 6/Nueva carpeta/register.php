<?php
require_once 'config.php';
require_once 'functions.php';

$error = '';
$success = '';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar campos requeridos
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            throw new Exception('Todos los campos son obligatorios.');
        }
        
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        
        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('El formato del email no es válido.');
        }
        
        // Validar que se subió un archivo
        if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] === UPLOAD_ERR_NO_FILE) {
            throw new Exception('Debes subir una imagen de perfil.');
        }
        
        // Conectar a la base de datos
        $db = getConnection();
        
        // Verificar si el usuario ya existe
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            throw new Exception('El nombre de usuario o email ya están registrados.');
        }
        
        // Procesar imagen
        $imagePaths = processUploadedImage($_FILES['profile_image'], $username);
        
        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar usuario en la base de datos
        $stmt = $db->prepare("
            INSERT INTO users (username, email, password, profile_image_big, profile_image_small) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $username,
            $email,
            $hashedPassword,
            $imagePaths['big'],
            $imagePaths['small']
        ]);
        
        $success = 'Usuario registrado exitosamente. <a href="login.php">Iniciar sesión</a>';
        
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
    <title>Registro de Usuario</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .info {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
        }
        
        .error {
            background: #fee;
            color: #c33;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #c33;
        }
        
        .success {
            background: #efe;
            color: #3c3;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #3c3;
        }
        
        .success a {
            color: #2a2;
            font-weight: bold;
        }
        
        .link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .link a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
        
        <?php if ($error): ?>
            <div class="error"><?php echo e($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php else: ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">
                
                <div class="form-group">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo isset($_POST['username']) ? e($_POST['username']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo isset($_POST['email']) ? e($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="profile_image">Imagen de perfil:</label>
                    <input type="file" id="profile_image" name="profile_image" accept="image/png,image/jpeg" required>
                    <div class="info">Solo PNG o JPG. Tamaño máximo: 360x480px</div>
                </div>
                
                <button type="submit">Registrarse</button>
            </form>
            
            <div class="link">
                ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
