<?php
session_start();

require_once('usuario.ini.php');

$errores = [];
$mensaje = '';

// Verificar si hay una cookie de recordar usuario
if (isset($_COOKIE['usuario_recordado'])) {
    $mensaje = '¿Deseas continuar con el usuario anterior?';
    $correo_recordado = $_COOKIE['usuario_recordado'];
}

// Si ya está logueado, redirigir
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validaciones
        if (empty($_POST['correo'])) {
            $errores['correo'] = 'El correo es obligatorio';
        } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'El correo no es válido';
        }

        if (empty($_POST['contrasena'])) {
            $errores['contrasena'] = 'La contraseña es obligatoria';
        }

        if (empty($errores)) {
            $usuario = new Usuario();
            
            if ($usuario->autenticar($_POST['correo'], $_POST['contrasena'])) {
                // Guardar datos en sesión
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuario_nombre'] = $usuario->getNombre();
                $_SESSION['usuario_correo'] = $usuario->getCorreo();
                $_SESSION['usuario_img'] = $usuario->getRutaImg();

                // Recordar usuario si está marcado
                if (isset($_POST['recordar'])) {
                    setcookie('usuario_recordado', $_POST['correo'], time() + (86400 * 30), '/');
                } else {
                    // Eliminar cookie si no está marcado
                    if (isset($_COOKIE['usuario_recordado'])) {
                        setcookie('usuario_recordado', '', time() - 3600, '/');
                    }
                }

                header('Location: index.php');
                exit();
            } else {
                $errores['general'] = 'Correo o contraseña incorrectos';
            }
        }
    } catch (Exception $e) {
        $errores['general'] = 'Error en el sistema: ' . $e->getMessage();
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Gestión de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div>
        <h1>Iniciar Sesión</h1>
        
        <?php if (!empty($mensaje)): ?>
            <div class="mensaje">
                <?php echo htmlspecialchars($mensaje); ?>
                <br>
                <small><?php echo htmlspecialchars($correo_recordado); ?></small>
            </div>
        <?php endif; ?>

        <?php if (isset($errores['general'])): ?>
            <div class="error">
                <?php echo htmlspecialchars($errores['general']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" 
                    value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : (isset($correo_recordado) ? htmlspecialchars($correo_recordado) : ''); ?>" 
                    required>
                <?php if (isset($errores['correo'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['correo']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                <?php if (isset($errores['contrasena'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['contrasena']); ?></div>
                <?php endif; ?>
            </div>

            <div>
                <input type="checkbox" id="recordar" name="recordar" 
                    <?php echo isset($correo_recordado) ? 'checked' : ''; ?>>
                <label for="recordar">Recordar usuario</label>
            </div>

            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>

        <div class="registro-link">
            ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
        </div>
    </div>
</body>
</html>
