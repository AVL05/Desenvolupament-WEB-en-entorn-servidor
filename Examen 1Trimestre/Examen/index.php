<?php
session_start();
require_once('cabecera.ini.php');
require_once('tarea.ini.php');

$mensaje = '';

try {
    $tarea = new Tarea();
    $tareas = $tarea->listarTodas();
} catch (Exception $e) {
    $mensaje = 'Error al cargar las tareas: ' . $e->getMessage();
    $tareas = [];
}
?>

<div>
    <h1>Lista de Tareas</h1>
    
    <?php if (!empty($mensaje)): ?>
        <div class="error"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['eliminada'])): ?>
        <div class="success">Tarea eliminada correctamente</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha Creación</th>
                <th>Creador</th>
                <th>Última Modificación</th>
                <th>Modificado por</th>
                <th>Completada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tareas)): ?>
                <tr>
                    <td colspan="9">No hay tareas registradas</td>
                </tr>
            <?php else: ?>
                <?php foreach ($tareas as $t): ?>
                    <tr class="<?php echo $t['completada'] ? 'completada' : ''; ?>">
                        <td><?php echo htmlspecialchars($t['id']); ?></td>
                        <td><?php echo htmlspecialchars($t['nombre']); ?></td>
                        <td><?php echo htmlspecialchars(substr($t['descripcion'], 0, 50)) . (strlen($t['descripcion']) > 50 ? '...' : ''); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($t['fecha_creacion'])); ?></td>
                        <td><?php echo htmlspecialchars($t['nombre_creador']); ?></td>
                        <td><?php echo $t['fecha_modificacion'] ? date('d/m/Y', strtotime($t['fecha_modificacion'])) : '-'; ?></td>
                        <td><?php echo $t['nombre_modificador'] ? htmlspecialchars($t['nombre_modificador']) : '-'; ?></td>
                        <td><?php echo $t['completada'] ? '✓ Sí' : '✗ No'; ?></td>
                        <td>
                            <?php if (!$t['completada']): ?>
                                <a href="editar_tarea.php?id=<?php echo $t['id']; ?>" class="btn">Editar</a>
                                <a href="eliminar_tarea.php?id=<?php echo $t['id']; ?>" class="btn" onclick="return confirm('¿Estás seguro de eliminar esta tarea?');">Eliminar</a>
                            <?php else: ?>
                                <span>Completada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
