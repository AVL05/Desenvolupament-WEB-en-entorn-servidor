<?php
require_once 'header.php';

$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try {
    $dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '', $opc);
    $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<p>Error al conectar con la base de datos: ' . $e->getMessage() . '</p>';
    exit;
}

echo '<h1>Búsqueda de canciones</h1>';

$recent_searches = [];
if (isset($_COOKIE['recent_searches'])) {
    $recent_searches = json_decode($_COOKIE['recent_searches'], true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto_buscar = $_POST['texto'];
    $tipo_busqueda = $_POST['tipo_busqueda'];
    $genero = $_POST['genero'];
    
    if (!empty($texto_buscar)) {
        array_unshift($recent_searches, [
            'texto' => $texto_buscar,
            'tipo' => $tipo_busqueda,
            'genero' => $genero
        ]);
        
        $recent_searches = array_slice($recent_searches, 0, 5);
        
        setcookie('recent_searches', json_encode($recent_searches), time() + (86400 * 30), '/');
    }
    
    try {
        $sql = 'SELECT c.titulo, c.posicion, c.duracion, c.genero, a.titulo AS album_titulo 
                FROM cancion c 
                INNER JOIN album a ON c.album = a.codigo 
                WHERE 1=1';
        
        $params = array();
        
        if (!empty($genero)) {
            $sql .= ' AND c.genero = :genero';
            $params[':genero'] = $genero;
        }
        
        if (!empty($texto_buscar)) {
            if ($tipo_busqueda == 'titulo') {
                $sql .= ' AND c.titulo LIKE :texto';
                $params[':texto'] = '%' . $texto_buscar . '%';
            } elseif ($tipo_busqueda == 'album') {
                $sql .= ' AND a.titulo LIKE :texto';
                $params[':texto'] = '%' . $texto_buscar . '%';
            } elseif ($tipo_busqueda == 'ambos') {
                $sql .= ' AND (c.titulo LIKE :texto OR a.titulo LIKE :texto)';
                $params[':texto'] = '%' . $texto_buscar . '%';
            }
        }
        
        $sql .= ' ORDER BY a.titulo, c.posicion';
        
        $consulta = $dwes->prepare($sql);
        
        foreach ($params as $key => $value) {
            $consulta->bindValue($key, $value);
        }
        
        $consulta->execute();
        
        echo '<h2>Resultados de la búsqueda</h2>';
        
        if ($consulta->rowCount() == 0) {
            echo '<p>No se encontraron canciones con los criterios especificados.</p>';
        } else {
            echo '<table border="1" cellpadding="5">';
            echo '<tr><th>Título Canción</th><th>Álbum</th><th>Posición</th><th>Duración</th><th>Género</th></tr>';
            
            while ($cancion = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($cancion['titulo']) . '</td>';
                echo '<td>' . htmlspecialchars($cancion['album_titulo']) . '</td>';
                echo '<td>' . htmlspecialchars($cancion['posicion']) . '</td>';
                echo '<td>' . htmlspecialchars($cancion['duracion']) . '</td>';
                echo '<td>' . htmlspecialchars($cancion['genero']) . '</td>';
                echo '</tr>';
            }
            
            echo '</table>';
            echo '<p>Total de canciones encontradas: ' . $consulta->rowCount() . '</p>';
        }
        
    } catch (PDOException $e) {
        echo '<p style="color: red;">Error en la búsqueda: ' . $e->getMessage() . '</p>';
    }
    
    echo '<hr>';
}

?>

<?php if (!empty($recent_searches)): ?>
<h2>Últimas búsquedas</h2>
<ul>
    <?php foreach ($recent_searches as $search): ?>
        <li>
            Texto: "<?php echo htmlspecialchars($search['texto']); ?>" - 
            Tipo: <?php echo htmlspecialchars($search['tipo']); ?>
            <?php if (!empty($search['genero'])): ?>
                - Género: <?php echo htmlspecialchars($search['genero']); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<h2>Formulario de búsqueda</h2>

<form method="POST" action="">
    <label for="texto">Texto a buscar:</label><br>
    <input type="text" id="texto" name="texto" size="40" value="<?php echo isset($_POST['texto']) ? htmlspecialchars($_POST['texto']) : ''; ?>"><br><br>
    
    <label>Buscar en:</label><br>
    <input type="radio" id="tipo_titulo" name="tipo_busqueda" value="titulo" <?php echo (!isset($_POST['tipo_busqueda']) || $_POST['tipo_busqueda'] == 'titulo') ? 'checked' : ''; ?>>
    <label for="tipo_titulo">Títulos de canción</label><br>
    
    <input type="radio" id="tipo_album" name="tipo_busqueda" value="album" <?php echo (isset($_POST['tipo_busqueda']) && $_POST['tipo_busqueda'] == 'album') ? 'checked' : ''; ?>>
    <label for="tipo_album">Nombres de álbum</label><br>
    
    <input type="radio" id="tipo_ambos" name="tipo_busqueda" value="ambos" <?php echo (isset($_POST['tipo_busqueda']) && $_POST['tipo_busqueda'] == 'ambos') ? 'checked' : ''; ?>>
    <label for="tipo_ambos">Ambos campos</label><br><br>
    
    <label for="genero">Género musical:</label><br>
    <select id="genero" name="genero">
        <option value="">Todos los géneros</option>
        <option value="Clásica" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Clásica') ? 'selected' : ''; ?>>Clásica</option>
        <option value="BSO" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'BSO') ? 'selected' : ''; ?>>BSO</option>
        <option value="Blues" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Blues') ? 'selected' : ''; ?>>Blues</option>
        <option value="Electrónica" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Electrónica') ? 'selected' : ''; ?>>Electrónica</option>
        <option value="Jazz" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Jazz') ? 'selected' : ''; ?>>Jazz</option>
        <option value="Metal" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Metal') ? 'selected' : ''; ?>>Metal</option>
        <option value="Pop" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Pop') ? 'selected' : ''; ?>>Pop</option>
        <option value="Rock" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'Rock') ? 'selected' : ''; ?>>Rock</option>
    </select><br><br>
    
    <input type="submit" value="Buscar">
</form>

<p><a href="index.php">Volver a la página principal</a></p>

<?php
$dwes = null;
?>
</body>
</html>
