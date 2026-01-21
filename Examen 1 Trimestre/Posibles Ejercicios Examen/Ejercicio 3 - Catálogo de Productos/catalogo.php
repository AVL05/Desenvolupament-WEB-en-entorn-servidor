<?php
// ========================================
// EJERCICIO 3: CATÁLOGO DE PRODUCTOS (MYSQL)
// ========================================

date_default_timezone_set('Europe/Madrid');  // Zona horaria
require_once('config.php');  // Conexión a BD

// --- CONECTAR A LA BASE DE DATOS ---
$db = getDBConnection('catalogo_productos_db');

// ==========================================
// FUNCIONES AUXILIARES
// ==========================================

// --- FUNCIÓN: MOSTRAR TABLA DE PRODUCTOS ---
function mostrarCatalogo($productos) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nombre</th>';
    echo '<th>Categoría</th>';
    echo '<th>Precio</th>';
    echo '<th>Stock</th>';
    echo '<th>Descuento</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    foreach ($productos as $producto) {
        echo '<tr>';
        echo '<td>' . $producto['id'] . '</td>';
        echo '<td>' . htmlspecialchars($producto['nombre']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['categoria']) . '</td>';
        echo '<td>' . number_format($producto['precio'], 2) . ' €</td>';
        echo '<td>' . $producto['stock'] . '</td>';
        echo '<td>' . ($producto['descuento'] ? '<span class="badge-descuento">✓ Sí</span>' : 'No') . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
}

// --- FUNCIÓN: CALCULAR VALOR TOTAL DEL INVENTARIO ---
function calcularValorTotal($productos) {
    $total = 0;
    foreach ($productos as $producto) {
        $total += $producto['precio'] * $producto['stock'];
    }
    return $total;
}

// --- FUNCIÓN: ENCONTRAR PRODUCTO MÁS CARO ---
function productoMasCaro($productos) {
    if (empty($productos)) {
        return 'No hay productos';
    }
    
    $max_precio = $productos[0]['precio'];
    $nombre_producto = $productos[0]['nombre'];
    
    foreach ($productos as $producto) {
        if ($producto['precio'] > $max_precio) {
            $max_precio = $producto['precio'];
            $nombre_producto = $producto['nombre'];
        }
    }
    
    return $nombre_producto;
}

// ==========================================
// CONSTRUIR CONSULTA SQL CON FILTROS
// ==========================================

$sql = "SELECT * FROM productos WHERE 1=1";  // Consulta base
$params = [];  // Parámetros para prepared statement

// --- OBTENER FILTROS DEL FORMULARIO (MÉTODO GET) ---
$categoria_seleccionada = $_GET['categoria'] ?? '';
$busqueda = $_GET['busqueda'] ?? '';
$solo_descuento = isset($_GET['solo_descuento']);

// --- APLICAR FILTRO: CATEGORÍA ---
if (!empty($categoria_seleccionada) && $categoria_seleccionada !== 'todas') {
    $sql .= " AND categoria = ?";
    $params[] = $categoria_seleccionada;
}

// --- APLICAR FILTRO: NOMBRE (LIKE) ---
if (!empty($busqueda)) {
    $sql .= " AND nombre LIKE ?";
    $params[] = '%' . $busqueda . '%';
}

// --- APLICAR FILTRO: SOLO CON DESCUENTO ---
if ($solo_descuento) {
    $sql .= " AND descuento = 1";
}

// --- ORDENAR POR PRECIO ---
$sql .= " ORDER BY precio ASC";

// --- EJECUTAR CONSULTA ---
$stmt = $db->prepare($sql);
$stmt->execute($params);
$productos_filtrados = $stmt->fetchAll();

// --- OBTENER CATEGORÍAS ÚNICAS PARA EL SELECT ---
$stmt_categorias = $db->query("SELECT DISTINCT categoria FROM productos ORDER BY categoria");
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_COLUMN);

// Incluir header
require_once('header.inc.php');
?>

<style>
    .badge-mysql {
        background-color: #00758f;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        margin-left: 10px;
    }
    .filtros-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    .form-row {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        flex-wrap: wrap;
    }
    .form-group {
        flex: 1;
        min-width: 200px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    input[type="text"],
    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .checkbox-group input[type="checkbox"] {
        width: auto;
    }
    .checkbox-group label {
        margin-bottom: 0;
        font-weight: normal;
    }
    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }
    button:hover {
        background-color: #45a049;
    }
    .btn-limpiar {
        background-color: #ff9800;
    }
    .btn-limpiar:hover {
        background-color: #e68900;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .badge-descuento {
        background-color: #ff9800;
        color: white;
        padding: 3px 8px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: bold;
    }
    .info-box {
        background-color: #e3f2fd;
        border-left: 4px solid #2196F3;
        padding: 15px;
        margin: 20px 0;
        border-radius: 4px;
    }
    .info-box strong {
        color: #1976D2;
    }
    .no-resultados {
        text-align: center;
        padding: 40px;
        background-color: white;
        border-radius: 8px;
        color: #666;
    }
</style>

<h2>Catálogo de Productos <span class="badge-mysql">MySQL</span></h2>

<h3>Filtrar Productos</h3>

<div class="filtros-container">
    <form method="get" action="#">
        <div class="form-row">
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria">
                    <option value="todas" <?php echo ($categoria_seleccionada === '' || $categoria_seleccionada === 'todas') ? 'selected' : ''; ?>>
                        Todas las categorías
                    </option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat); ?>" 
                                <?php echo $categoria_seleccionada === $cat ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="busqueda">Buscar por nombre:</label>
                <input type="text" 
                       id="busqueda" 
                       name="busqueda" 
                       placeholder="Ej: Samsung"
                       value="<?php echo htmlspecialchars($busqueda); ?>">
            </div>
            
            <div class="form-group checkbox-group">
                <input type="checkbox" 
                       id="solo_descuento" 
                       name="solo_descuento"
                       <?php echo $solo_descuento ? 'checked' : ''; ?>>
                <label for="solo_descuento">Solo productos con descuento</label>
            </div>
        </div>
        
        <div style="margin-top: 15px; display: flex; gap: 10px;">
            <button type="submit">Filtrar</button>
            <a href="catalogo.php" style="text-decoration: none;">
                <button type="button" class="btn-limpiar">Limpiar filtros</button>
            </a>
        </div>
    </form>
</div>

<?php if (empty($productos_filtrados)): ?>
    <div class="no-resultados">
        <h3>No se encontraron productos</h3>
        <p>Intenta modificar los filtros de búsqueda</p>
    </div>
<?php else: ?>
    <?php mostrarCatalogo($productos_filtrados); ?>
    
    <div class="info-box">
        <p><strong>Valor total del inventario:</strong> <?php echo number_format(calcularValorTotal($productos_filtrados), 2); ?> €</p>
        <p><strong>Producto más caro:</strong> <?php echo htmlspecialchars(productoMasCaro($productos_filtrados)); ?></p>
        <p><strong>Total de productos mostrados:</strong> <?php echo count($productos_filtrados); ?></p>
    </div>
<?php endif; ?>

<?php
// Incluir footer
require_once('footer.inc.php');
?>
