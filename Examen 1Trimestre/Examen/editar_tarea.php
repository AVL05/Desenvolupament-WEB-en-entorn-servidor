<?php
session_start();
require_once('cabecera.ini.php');
require_once('tarea.ini.php');

$errores = [];
$exito = false;

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id_tarea = $_GET['id'];

try {
    $tarea = new Tarea();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['completar'])) {
            if ($tarea->completar($id_tarea, $_SESSION['usuario_id'])) {
                header('Location: index.php');
                exit();
            } else {
                $errores['general'] = 'Error al completar la tarea';
            }
        } else {
            if (empty($_POST['nombre'])) {
                $errores['nombre'] = 'El nombre de la tarea es obligatorio';
            }

            if (empty($_POST['descripcion'])) {
                $errores['descripcion'] = 'La descripción de la tarea es obligatoria';
            }

            if (empty($errores)) {
                if ($tarea->actualizar($id_tarea, $_POST['nombre'], $_POST['descripcion'], $_SESSION['usuario_id'])) {
                    $exito = true;
                    $tarea->obtenerPorId($id_tarea);
                } else {
                    $errores['general'] = 'Error al actualizar la tarea';
                }
            }
        }
    } else {
        if (!$tarea->obtenerPorId($id_tarea)) {
            header('Location: index.php');
            exit();
        }
    }
} catch (Exception $e) {
    $errores['general'] = 'Error en el sistema: ' . $e->getMessage();
}
?>

<div>
    <div>
        <h1>Editar Tarea</h1>

        <?php if ($exito): ?>
            <div class="success">
                ¡Tarea actualizada correctamente!
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
                    value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($tarea->getNombre()); ?>" 
                    required>
                <?php if (isset($errores['nombre'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['nombre']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : htmlspecialchars($tarea->getDescripcion()); ?></textarea>
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errores['descripcion']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn">Actualizar Tarea</button>
            <button type="submit" name="completar" value="1" class="btn" onclick="return confirm('¿Marcar esta tarea como completada?');">Completar Tarea</button>
            <a href="index.php" class="btn">Cancelar</a>
        </form>
    </div>
</div>

</body>
</html>
