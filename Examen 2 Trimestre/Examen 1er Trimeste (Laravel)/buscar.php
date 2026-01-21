<?php
session_start();
require_once('cabecera.ini.php');
require_once('tarea.ini.php');

$resultados = [];
$ultimas = [];
$filtros_activos = false;


$termino = isset($_GET['termino']) ? $_GET['termino'] : '';

?>

<div>
    <div>
        <h1>Buscar Tareas</h1>
        <!--
        <?php if (isset($mensaje_error)): ?>
            <div class="error">
                <?php echo htmlspecialchars($mensaje_error); ?>
            </div>
        <?php endif; ?> 
        
        <form method="GET" action="">
            <div class="form-group">
                <label for="termino">Buscar por nombre o descripción:</label>
                <input type="text" id="termino" name="termino" 
                    value="" 
                    placeholder="Introduce término de búsqueda...">
            </div>
            -->

            <div class="form-group">
                <label for="busqueda">Buscar por nombre:</label>
                <input type="text" 
                       id="busqueda" 
                       name="busqueda" 
                       placeholder="Ej: Samsung"
                       >
            </div>

        
        <?php if (empty($resultados)): ?>
            <div>
                <p>No se encontraron tareas que coincidan con los filtros aplicados.</p>
            </div>
        <?php else: ?>
            <p><strong>Se encontraron <?php echo count($resultados); ?> tarea(s)</strong></p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha Creación</th>
                        <th>Creador</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $t): ?>
                        <tr class="<?php echo $t['completada'] ? 'completada' : ''; ?>">
                            <td><?php echo htmlspecialchars($t['id']); ?></td>
                            <td><?php echo htmlspecialchars($t['nombre']); ?></td>
                            <td><?php echo htmlspecialchars(substr($t['descripcion'], 0, 80)) . (strlen($t['descripcion']) > 80 ? '...' : ''); ?></td>
                            <td><?php echo $t['completada'] ? '✓ Completada' : '○ Pendiente'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    <h2>Últimas 5 tareas actualizadas</h2>
    
    <?php if (empty($ultimas)): ?>
        <div>
            <p>No hay tareas registradas en el sistema.</p>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ultimas as $u): ?>
                    <tr class="<?php echo $u['completada'] ? 'completada' : ''; ?>">
                        <td><?php echo htmlspecialchars($u['id']); ?></td>
                        <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                        <td>
                            <?php 
                            if ($u['accion'] == 'completada') {
                                echo '✓ Completada';
                            } elseif ($u['accion'] == 'modificada') {
                                echo '✏ Modificada';
                            } else {
                                echo '+ Creada';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($u['usuario_accion']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($u['fecha_accion'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
