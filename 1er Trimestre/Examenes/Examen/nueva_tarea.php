<?php
session_start();
require_once('cabecera.ini.php');
require_once('Tarea.ini.php');

$errores = [];
$exito = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validaciones
        if (empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre de la tarea es obligatorio';
        }

        if (empty($_POST['descripcion'])) {
            $errores['descripcion'] = 'La descripción de la tarea es obligatoria';
        }

        if (empty($errores)) {
            $tarea = new Tarea();
            if ($tarea->crear($_POST['nombre'], $_POST['descripcion'], $_SESSION['usuario_id'])) {
                $exito = true;
            } else {
                $errores['general'] = 'Error al crear la tarea';
            }
        }
    } catch (Exception $e) {
        $errores['general'] = 'Error en el sistema: ' . $e->getMessage();
    }
}
?>

<div>
    <div>
        <h1>Nueva Tarea</h1>

        <?php if ($exito): ?>
            <div class="success">
                ¡Tarea creada correctamente!<br>
            </div>
        <?php endif; ?>

        <?php if (isset($errores['general'])): ?>
            <div class="error">
                <?php echo htmlspecialchars($errores['general']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre de la tarea:</label>
                <input type="text" id="nombre" name="nombre" 
                    value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" 
                    required>
                <?php if (isset($errores['nombre'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['nombre']); ?></div>
                </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="decripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['descripcion']); ?></div>
                <?php endif; ?>
            </div>  
            <button type="submit" class="btn">Crear Tarea</button>
            <a href="index.php" class="btn">Cancelar</a>
        </form>
    </div>
</div>

</body>
</html>