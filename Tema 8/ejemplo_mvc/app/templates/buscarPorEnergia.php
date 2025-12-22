<?php ob_start() ?>
<h2>Buscar alimentos por energía (Kcal)</h2>

<form name="formBusquedaEnergia" action="index.php?ctl=buscar_energia" method="post">
    <label for="energia">Energía (Kcal por 100g):</label>
    <input type="number" name="energia" id="energia" value="<?php echo htmlspecialchars($params['energia']) ?>"
        step="0.1" min="0" required>
    <span>(introduce un valor numérico)</span>

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
    <p>No se encontraron alimentos con esa energía.</p>
<?php endif; ?>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>