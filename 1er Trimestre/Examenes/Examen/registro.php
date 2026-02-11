<?php
session_start();

require_once('usuario.ini.php');

$errores = [];
$exito = false;

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio';
        }

        if (empty($_POST['correo'])) {
            $errores['correo'] = 'El correo es obligatorio';
        } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'El correo no es válido';
        } else {
            $usuario = new Usuario();
            if ($usuario->existeCorreo($_POST['correo'])) {
                $errores['correo'] = 'Este correo ya está registrado';
            }
        }

        if (empty($_POST['contrasena'])) {
            $errores['contrasena'] = 'La contraseña es obligatoria';
        } elseif (strlen($_POST['contrasena']) < 6) {
            $errores['contrasena'] = 'La contraseña debe tener al menos 6 caracteres';
        }

        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] == UPLOAD_ERR_NO_FILE) {
            $errores['imagen'] = 'La imagen de perfil es obligatoria';
        } elseif ($_FILES['imagen']['error'] != UPLOAD_ERR_OK) {
            $errores['imagen'] = 'Error al subir la imagen';
        } else {
            $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
            
            if (!in_array($extension, $extensiones_permitidas)) {
                $errores['imagen'] = 'Solo se permiten imágenes JPG, PNG o GIF';
            } elseif ($_FILES['imagen']['size'] > 2097152) { // 2MB
                $errores['imagen'] = 'La imagen no puede superar los 2MB';
            }
        }

        if (empty($errores)) {
            $directorio_imagenes = 'uploads/';
            if (!file_exists($directorio_imagenes)) {
                mkdir($directorio_imagenes, 0777, true);
            }

            $nombre_imagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
            $ruta_imagen = $directorio_imagenes . $nombre_imagen;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
                $usuario = new Usuario();
                if ($usuario->registrar($_POST['nombre'], $_POST['correo'], $_POST['contrasena'], $ruta_imagen)) {
                    $exito = true;
                } else {
                    $errores['general'] = 'Error al registrar el usuario';
                    if (file_exists($ruta_imagen)) {
                        unlink($ruta_imagen);
                    }
                }
            } else {
                $errores['imagen'] = 'Error al guardar la imagen';
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
    <title>Registro - Gestión de Tareas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div>
        <h1>Registro de Usuario</h1>

        <?php if ($exito): ?>
            <div class="success">
                ¡Registro completado correctamente!<br>
                <a href="login.php">Inicia sesión aquí</a>
            </div>
        <?php else: ?>

        <?php if (isset($errores['general'])): ?>
            <div class="error">
                <?php echo htmlspecialchars($errores['general']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" 
                    value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" 
                    required>
                <?php if (isset($errores['nombre'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['nombre']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" 
                    value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>" 
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

            <div class="form-group">
                <label for="imagen">Imagen de perfil:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
                <?php if (isset($errores['imagen'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['imagen']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn">Registrarse</button>
        </form>

        <?php endif; ?>

        <div class="login-link">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
        </div>
    </div>
</body>
</html>
