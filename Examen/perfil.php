<?php
session_start();
require_once('cabecera.ini.php');
require_once('usuario.ini.php');

$errores = [];
$exito = false;

try {
    $usuario = new Usuario();
    $usuario->obtenerPorId($_SESSION['usuario_id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio';
        }

        if (empty($_POST['correo'])) {
            $errores['correo'] = 'El correo es obligatorio';
        } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'El correo no es válido';
        }

        $ruta_imagen_actual = $usuario->getRutaImg();
        $ruta_imagen_nueva = $ruta_imagen_actual;

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
            
            if (!in_array($extension, $extensiones_permitidas)) {
                $errores['imagen'] = 'Solo se permiten imágenes JPG, PNG o GIF';
            } elseif ($_FILES['imagen']['size'] > 2097152) {
                $errores['imagen'] = 'La imagen no puede superar los 2MB';
            } else {
                $directorio_imagenes = 'uploads/';
                if (!file_exists($directorio_imagenes)) {
                    mkdir($directorio_imagenes, 0777, true);
                }

                $nombre_imagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $ruta_imagen_nueva = $directorio_imagenes . $nombre_imagen;

                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen_nueva)) {
                    $errores['imagen'] = 'Error al guardar la imagen';
                    $ruta_imagen_nueva = $ruta_imagen_actual;
                }
            }
        }

        $contrasena_nueva = null;
        if (!empty($_POST['contrasena'])) {
            if (strlen($_POST['contrasena']) < 6) {
                $errores['contrasena'] = 'La contraseña debe tener al menos 6 caracteres';
            } else {
                $contrasena_nueva = $_POST['contrasena'];
            }
        }

        if (empty($errores)) {
            if ($usuario->actualizar($_SESSION['usuario_id'], $_POST['nombre'], $_POST['correo'], $ruta_imagen_nueva, $contrasena_nueva)) {
                $_SESSION['usuario_nombre'] = $_POST['nombre'];
                $_SESSION['usuario_correo'] = $_POST['correo'];
                $_SESSION['usuario_img'] = $ruta_imagen_nueva;


                if ($ruta_imagen_nueva != $ruta_imagen_actual && file_exists($ruta_imagen_actual)) {
                    unlink($ruta_imagen_actual);
                }

                $exito = true;

                $usuario->obtenerPorId($_SESSION['usuario_id']);
            } else {
                $errores['general'] = 'Error al actualizar el perfil';
            }
        }
    }
} catch (Exception $e) {
    $errores['general'] = 'Error en el sistema: ' . $e->getMessage();
}
?>

<div>
    <div>
        <h1>Mi Perfil</h1>

        <?php if ($exito): ?>
            <div class="success">
                ¡Perfil actualizado correctamente!
            </div>
        <?php endif; ?>

        <?php if (isset($errores['general'])): ?>
            <div class="error">
                <?php echo htmlspecialchars($errores['general']); ?>
            </div>
        <?php endif; ?>

        <div>
            <img src="<?php echo htmlspecialchars($usuario->getRutaImg()); ?>" 
                 alt="Perfil" 
                 width="150" height="150">
        </div>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" 
                    value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($usuario->getNombre()); ?>" 
                    required>
                <?php if (isset($errores['nombre'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['nombre']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" 
                    value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : htmlspecialchars($usuario->getCorreo()); ?>" 
                    required>
                <?php if (isset($errores['correo'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['correo']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="imagen">Cambiar imagen de perfil (opcional):</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                <small>Deja este campo vacío si no deseas cambiar la imagen</small>
                <?php if (isset($errores['imagen'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['imagen']); ?></div>
                <?php endif; ?>
            </div>

            <hr>

            <h3>Cambiar contraseña (opcional)</h3>
            
            <div class="form-group">
                <label for="contrasena">Nueva contraseña:</label>
                <input type="password" id="contrasena" name="contrasena">
                <small>Deja este campo vacío si no deseas cambiar la contraseña</small>
                <?php if (isset($errores['contrasena'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['contrasena']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn">Actualizar Perfil</button>
            <a href="index.php" class="btn">Volver</a>
        </form>
    </div>
</div>

</body>
</html>
