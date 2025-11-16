<?php
// ========================================
// EJERCICIO 2: REGISTRO DE USUARIOS (MYSQL)
// ========================================

session_start();  // Iniciar sesión
date_default_timezone_set('Europe/Madrid');  // Zona horaria
require_once('config.php');  // Conexión a BD

// --- CONECTAR A LA BASE DE DATOS ---
$db = getDBConnection('sistema_usuarios_db');

// --- VARIABLES PARA EL FORMULARIO ---
$errores = [];  // Array de errores
$registro_exitoso = false;  // Flag de éxito

// ==========================================
// PROCESAR REGISTRO (MÉTODO POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // --- VALIDACIÓN: NOMBRE DE USUARIO ---
    if (empty($_POST['username'])) {
        $errores['username'] = 'El nombre de usuario es obligatorio';
    } elseif (!preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['username'])) {
        $errores['username'] = 'El nombre de usuario debe tener mínimo 5 caracteres (solo letras y números)';
    }
    
    // --- VALIDACIÓN: EMAIL ---
    if (empty($_POST['email'])) {
        $errores['email'] = 'El email es obligatorio';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El formato del email no es válido';
    }
    
    // --- VALIDACIÓN: CONTRASEÑA ---
    if (empty($_POST['password'])) {
        $errores['password'] = 'La contraseña es obligatoria';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $_POST['password'])) {
        $errores['password'] = 'La contraseña debe tener mínimo 8 caracteres, al menos una mayúscula, una minúscula y un número';
    }
    
    // Validar confirmación de contraseña
    if (empty($_POST['password2'])) {
        $errores['password2'] = 'Debe confirmar la contraseña';
    } elseif ($_POST['password'] !== $_POST['password2']) {
        $errores['password2'] = 'Las contraseñas no coinciden';
    }
    
    // Validar fecha de nacimiento
    if (empty($_POST['fecha_nacimiento'])) {
        $errores['fecha_nacimiento'] = 'La fecha de nacimiento es obligatoria';
    } else {
        $fecha_nacimiento = strtotime($_POST['fecha_nacimiento']);
        $fecha_actual = time();
        $edad = date('Y', $fecha_actual) - date('Y', $fecha_nacimiento);
        
        // Ajustar edad si aún no ha cumplido años este año
        if (date('md', $fecha_actual) < date('md', $fecha_nacimiento)) {
            $edad--;
        }
        
        if ($edad < 18) {
            $errores['fecha_nacimiento'] = 'Debes ser mayor de 18 años para registrarte';
        }
    }
    
    // Validar género
    if (empty($_POST['genero'])) {
        $errores['genero'] = 'Debe seleccionar un género';
    }
    
    // Validar términos y condiciones
    if (!isset($_POST['terminos'])) {
        $errores['terminos'] = 'Debe aceptar los términos y condiciones';
    }
    
    // --- SI NO HAY ERRORES, INSERTAR EN BD ---
    if (empty($errores)) {
        try {
            // Verificar usuario/email no duplicados
            $stmt = $db->prepare("SELECT id FROM usuarios WHERE username = ? OR email = ?");
            $stmt->execute([$_POST['username'], $_POST['email']]);
            
            if ($stmt->fetch()) {
                // Verificar específicamente cuál ya existe
                $stmt = $db->prepare("SELECT username FROM usuarios WHERE username = ?");
                $stmt->execute([$_POST['username']]);
                if ($stmt->fetch()) {
                    throw new Exception('El nombre de usuario ya está registrado');
                }
                
                $stmt = $db->prepare("SELECT email FROM usuarios WHERE email = ?");
                $stmt->execute([$_POST['email']]);
                if ($stmt->fetch()) {
                    throw new Exception('El email ya está registrado');
                }
            }
            
            // --- ENCRIPTAR CONTRASEÑA (IMPORTANTE) ---
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // --- INSERT USUARIO EN BD ---
            $stmt = $db->prepare("
                INSERT INTO usuarios (username, email, password_hash, fecha_nacimiento, genero, publicidad)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([
                $_POST['username'],
                $_POST['email'],
                $password_hash,
                $_POST['fecha_nacimiento'],
                $_POST['genero'],
                isset($_POST['publicidad']) ? 1 : 0
            ]);
            
            $registro_exitoso = true;
            
        } catch (Exception $e) {
            $errores['general'] = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario (MySQL)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
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
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input.error {
            border-color: #c62828;
        }
        .error-message {
            color: #c62828;
            font-size: 13px;
            margin-top: 5px;
        }
        .radio-group {
            margin: 10px 0;
        }
        .radio-group label {
            display: inline;
            margin-right: 20px;
            font-weight: normal;
        }
        .checkbox-group {
            margin: 10px 0;
        }
        .checkbox-group label {
            font-weight: normal;
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
        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid #2e7d32;
            text-align: center;
        }
        .error-general {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
        }
        .link-login {
            text-align: center;
            margin-top: 20px;
        }
        .link-login a {
            color: #4CAF50;
            text-decoration: none;
        }
        .link-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Registro de Usuario <span class="badge-mysql">MySQL</span></h1>
    
    <?php if ($registro_exitoso): ?>
        <div class="success">
            <h2>¡Registro completado con éxito!</h2>
            <p>Tu cuenta ha sido creada correctamente en la base de datos.</p>
            <p><a href="login.php" style="color:#2e7d32; font-weight:bold;">Iniciar sesión</a></p>
        </div>
    <?php else: ?>
        
        <?php if (isset($errores['general'])): ?>
            <div class="error-general">
                <strong>Error:</strong> <?php echo htmlspecialchars($errores['general']); ?>
            </div>
        <?php endif; ?>
        
        <div class="form-container">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           class="<?php echo isset($errores['username']) ? 'error' : ''; ?>"
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                           placeholder="Mínimo 5 caracteres">
                    <?php if (isset($errores['username'])): ?>
                        <div class="error-message"><?php echo $errores['username']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="<?php echo isset($errores['email']) ? 'error' : ''; ?>"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                           placeholder="usuario@ejemplo.com">
                    <?php if (isset($errores['email'])): ?>
                        <div class="error-message"><?php echo $errores['email']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="<?php echo isset($errores['password']) ? 'error' : ''; ?>"
                           placeholder="Mínimo 8 caracteres, 1 mayúscula, 1 minúscula, 1 número">
                    <?php if (isset($errores['password'])): ?>
                        <div class="error-message"><?php echo $errores['password']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password2">Confirmar contraseña:</label>
                    <input type="password" 
                           id="password2" 
                           name="password2" 
                           class="<?php echo isset($errores['password2']) ? 'error' : ''; ?>"
                           placeholder="Repite la contraseña">
                    <?php if (isset($errores['password2'])): ?>
                        <div class="error-message"><?php echo $errores['password2']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="date" 
                           id="fecha_nacimiento" 
                           name="fecha_nacimiento" 
                           class="<?php echo isset($errores['fecha_nacimiento']) ? 'error' : ''; ?>"
                           value="<?php echo isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : ''; ?>">
                    <?php if (isset($errores['fecha_nacimiento'])): ?>
                        <div class="error-message"><?php echo $errores['fecha_nacimiento']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label>Género:</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="genero" value="masculino"
                                   <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'masculino') ? 'checked' : ''; ?>>
                            Masculino
                        </label>
                        <label>
                            <input type="radio" name="genero" value="femenino"
                                   <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'femenino') ? 'checked' : ''; ?>>
                            Femenino
                        </label>
                        <label>
                            <input type="radio" name="genero" value="otro"
                                   <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'otro') ? 'checked' : ''; ?>>
                            Otro
                        </label>
                    </div>
                    <?php if (isset($errores['genero'])): ?>
                        <div class="error-message"><?php echo $errores['genero']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="terminos"
                                   <?php echo isset($_POST['terminos']) ? 'checked' : ''; ?>>
                            Acepto los términos y condiciones *
                        </label>
                        <?php if (isset($errores['terminos'])): ?>
                            <div class="error-message"><?php echo $errores['terminos']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="publicidad"
                                   <?php echo isset($_POST['publicidad']) ? 'checked' : ''; ?>>
                            Acepto recibir publicidad (opcional)
                        </label>
                    </div>
                </div>
                
                <button type="submit">Registrarse</button>
            </form>
            
            <div class="link-login">
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
