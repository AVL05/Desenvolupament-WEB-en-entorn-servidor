<?php ob_start() ?>
<h2>Búsqueda combinada (nombre y energía)</h2>

<form name="formBusquedaCombinada" action="index.php?ctl=buscar_combinada" method="post">
    <label for="nombre">Nombre del alimento:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($params['nombre']) ?>">
    <span>(puedes utilizar '%' como comodín)</span>

    <label for="energia">Energía (Kcal por 100g):</label>
    <input type="number" name="energia" id="energia" value="<?php echo htmlspecialchars($params['energia']) ?>"
        step="0.1" min="0">
    <span>(deja vacío para buscar solo por nombre)</span>

    <input type="submit" value="Buscar" class="nav-btn">
</form>

<?php if (count($params['resultado']) > 0): ?>
    <table class="tabla-calida">
        <tr>
            <th>Alimento (por 100g)</th>
            <th>Energía (Kcal)</th>
            <th>Proteína (g)</th>
            <th>Grasa (g)</th>
        </tr>

        <?php foreach ($params['resultado'] as $alimento) : ?>
            <tr>
                <td><a href="index.php?ctl=ver&id=<?php echo $alimento['id'] ?>">
                        <?php echo htmlspecialchars($alimento['nombre']) ?></a>
                </td>
                <td><?php echo $alimento['energia'] ?></td>
                <td><?php echo $alimento['proteina'] ?></td>
                <td><?php echo $alimento['grasatotal'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <p>No se encontraron alimentos con esos criterios.</p>
<?php endif; ?>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>