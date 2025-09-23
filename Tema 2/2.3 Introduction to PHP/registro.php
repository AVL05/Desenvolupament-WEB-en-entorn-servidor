<?php
$errores = [];
$datos = [];
$registroExitoso = false;

function limpiarDato($dato) {
    return htmlspecialchars(strip_tags(trim($dato)));
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarNombre($nombre) {
    return preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre);
}

function validarUsuario($usuario) {
    return preg_match("/^[a-zA-Z0-9_]+$/", $usuario);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y limpiar datos
    $datos['nombre'] = limpiarDato($_POST['nombre'] ?? '');
    $datos['apellidos'] = limpiarDato($_POST['apellidos'] ?? '');
    $datos['usuario'] = limpiarDato($_POST['usuario'] ?? '');
    $datos['password'] = $_POST['password'] ?? '';
    $datos['password_confirm'] = $_POST['password_confirm'] ?? '';
    $datos['email'] = limpiarDato($_POST['email'] ?? '');
    $datos['fecha_nacimiento'] = $_POST['fecha_nacimiento'] ?? '';
    $datos['genero'] = $_POST['genero'] ?? '';
    $datos['condiciones'] = isset($_POST['condiciones']);
    $datos['publicidad'] = isset($_POST['publicidad']);

    if (empty($datos['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio';
    } elseif (!validarNombre($datos['nombre'])) {
        $errores['nombre'] = 'El nombre solo puede contener letras y espacios';
    }

    if (empty($datos['apellidos'])) {
        $errores['apellidos'] = 'Los apellidos son obligatorios';
    } elseif (!validarNombre($datos['apellidos'])) {
        $errores['apellidos'] = 'Los apellidos solo pueden contener letras y espacios';
    }

    if (empty($datos['usuario'])) {
        $errores['usuario'] = 'El nombre de usuario es obligatorio';
    } elseif (!validarUsuario($datos['usuario'])) {
        $errores['usuario'] = 'El usuario solo puede contener letras, números y guiones bajos';
    } elseif (strlen($datos['usuario']) < 3) {
        $errores['usuario'] = 'El usuario debe tener al menos 3 caracteres';
    }

    if (empty($datos['password'])) {
        $errores['password'] = 'La contraseña es obligatoria';
    } elseif (strlen($datos['password']) < 6) {
        $errores['password'] = 'La contraseña debe tener al menos 6 caracteres';
    }

    if (empty($datos['password_confirm'])) {
        $errores['password_confirm'] = 'Debe confirmar la contraseña';
    } elseif ($datos['password'] !== $datos['password_confirm']) {
        $errores['password_confirm'] = 'Las contraseñas no coinciden';
    }

    if (empty($datos['email'])) {
        $errores['email'] = 'El email es obligatorio';
    } elseif (!validarEmail($datos['email'])) {
        $errores['email'] = 'El formato del email no es válido';
    }

    if (empty($datos['fecha_nacimiento'])) {
        $errores['fecha_nacimiento'] = 'La fecha de nacimiento es obligatoria';
    } else {
        $fecha = DateTime::createFromFormat('Y-m-d', $datos['fecha_nacimiento']);
        $hoy = new DateTime();
        if (!$fecha || $fecha > $hoy) {
            $errores['fecha_nacimiento'] = 'La fecha de nacimiento no es válida';
        } elseif ($fecha->diff($hoy)->y < 13) {
            $errores['fecha_nacimiento'] = 'Debe ser mayor de 13 años';
        }
    }

    if (empty($datos['genero'])) {
        $errores['genero'] = 'Debe seleccionar un género';
    }

    if (!$datos['condiciones']) {
        $errores['condiciones'] = 'Debe aceptar los términos y condiciones';
    }

    if (empty($errores)) {
        $registroExitoso = true;
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
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #28a745;
            padding-bottom: 10px;
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
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .input-error {
            border-color: #dc3545;
            background-color: #fff5f5;
        }
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        .radio-group, .checkbox-group {
            margin: 15px 0;
        }
        .radio-group label, .checkbox-group label {
            display: inline;
            margin-left: 10px;
            margin-right: 20px;
            font-weight: normal;
        }
        .checkbox-single {
            margin: 15px 0;
        }
        .checkbox-single label {
            display: inline;
            margin-left: 10px;
            font-weight: normal;
        }
        .submit-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #218838;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            text-align: center;
        }
        .user-data {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            border-left: 4px solid #28a745;
            margin-top: 20px;
        }
        .data-item {
            margin-bottom: 10px;
            padding: 8px;
            background-color: white;
            border-radius: 3px;
        }
        .data-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            min-width: 140px;
        }
        .new-registration-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }
        .new-registration-btn:hover {
            background-color: #0056b3;
            text-decoration: none;
            color: white;
        }
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Registro de Usuario</h1>
        </header>
        
        <main>
            <?php if ($registroExitoso): ?>
                <div class="success-message">
                    <h2>¡Registro completado exitosamente! ✅</h2>
                    <p>Su cuenta ha sido creada correctamente con los siguientes datos:</p>
                </div>
                
                <div class="user-data">
                    <h3 style="color: #28a745; margin-top: 0;">Datos registrados:</h3>
                    <div class="data-item">
                        <span class="data-label">Nombre completo:</span>
                        <?php echo $datos['nombre'] . ' ' . $datos['apellidos']; ?>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Usuario:</span>
                        <?php echo $datos['usuario']; ?>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Email:</span>
                        <?php echo $datos['email']; ?>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Fecha de nacimiento:</span>
                        <?php 
                        $fecha = DateTime::createFromFormat('Y-m-d', $datos['fecha_nacimiento']);
                        echo $fecha->format('d/m/Y');
                        ?>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Género:</span>
                        <?php 
                        $generos = ['masculino' => 'Masculino', 'femenino' => 'Femenino', 'otro' => 'Otro'];
                        echo $generos[$datos['genero']];
                        ?>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Publicidad:</span>
                        <?php echo $datos['publicidad'] ? 'Acepta recibir publicidad' : 'No desea recibir publicidad'; ?>
                    </div>
                </div>
                
                <div style="text-align: center;">
                    <a href="registro.php" class="new-registration-btn">Nuevo Registro</a>
                </div>
                
            <?php else: ?>
                <form action="registro.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" id="nombre" name="nombre" 
                               value="<?php echo htmlspecialchars($datos['nombre'] ?? ''); ?>"
                               class="<?php echo isset($errores['nombre']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['nombre'])): ?>
                            <span class="error-message"><?php echo $errores['nombre']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellidos">Apellidos <span class="required">*</span></label>
                        <input type="text" id="apellidos" name="apellidos" 
                               value="<?php echo htmlspecialchars($datos['apellidos'] ?? ''); ?>"
                               class="<?php echo isset($errores['apellidos']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['apellidos'])): ?>
                            <span class="error-message"><?php echo $errores['apellidos']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="usuario">Nombre de usuario <span class="required">*</span></label>
                        <input type="text" id="usuario" name="usuario" 
                               value="<?php echo htmlspecialchars($datos['usuario'] ?? ''); ?>"
                               class="<?php echo isset($errores['usuario']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['usuario'])): ?>
                            <span class="error-message"><?php echo $errores['usuario']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña <span class="required">*</span></label>
                        <input type="password" id="password" name="password"
                               class="<?php echo isset($errores['password']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['password'])): ?>
                            <span class="error-message"><?php echo $errores['password']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirm">Confirmar contraseña <span class="required">*</span></label>
                        <input type="password" id="password_confirm" name="password_confirm"
                               class="<?php echo isset($errores['password_confirm']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['password_confirm'])): ?>
                            <span class="error-message"><?php echo $errores['password_confirm']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo htmlspecialchars($datos['email'] ?? ''); ?>"
                               class="<?php echo isset($errores['email']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['email'])): ?>
                            <span class="error-message"><?php echo $errores['email']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento <span class="required">*</span></label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" 
                               value="<?php echo htmlspecialchars($datos['fecha_nacimiento'] ?? ''); ?>"
                               class="<?php echo isset($errores['fecha_nacimiento']) ? 'input-error' : ''; ?>">
                        <?php if (isset($errores['fecha_nacimiento'])): ?>
                            <span class="error-message"><?php echo $errores['fecha_nacimiento']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Género <span class="required">*</span></label>
                        <div class="radio-group">
                            <input type="radio" id="masculino" name="genero" value="masculino" 
                                   <?php echo (($datos['genero'] ?? '') === 'masculino') ? 'checked' : ''; ?>>
                            <label for="masculino">Masculino</label>
                            
                            <input type="radio" id="femenino" name="genero" value="femenino"
                                   <?php echo (($datos['genero'] ?? '') === 'femenino') ? 'checked' : ''; ?>>
                            <label for="femenino">Femenino</label>
                            
                            <input type="radio" id="otro" name="genero" value="otro"
                                   <?php echo (($datos['genero'] ?? '') === 'otro') ? 'checked' : ''; ?>>
                            <label for="otro">Otro</label>
                        </div>
                        <?php if (isset($errores['genero'])): ?>
                            <span class="error-message"><?php echo $errores['genero']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox-single">
                            <input type="checkbox" id="condiciones" name="condiciones" 
                                   <?php echo (($datos['condiciones'] ?? false)) ? 'checked' : ''; ?>>
                            <label for="condiciones">Acepto los términos y condiciones <span class="required">*</span></label>
                        </div>
                        <?php if (isset($errores['condiciones'])): ?>
                            <span class="error-message"><?php echo $errores['condiciones']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <div class="checkbox-single">
                            <input type="checkbox" id="publicidad" name="publicidad"
                                   <?php echo (($datos['publicidad'] ?? false)) ? 'checked' : ''; ?>>
                            <label for="publicidad">Deseo recibir información publicitaria</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-btn">Registrarse</button>
                </form>
            <?php endif; ?>
        </main>
        
        <footer>
            <p style="text-align: center; margin-top: 30px; color: #666; border-top: 1px solid #e9ecef; padding-top: 20px;">
                © 2024 Sistema de Registro - PHP Exercise<br>
                <small><span class="required">*</span> Campos obligatorios</small>
            </p>
        </footer>
    </div>
</body>
</html>