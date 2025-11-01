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

if (!isset($_GET['codigo'])) {
    echo '<p>No se ha especificado el código del álbum.</p>';
    echo '<p><a href="index.php">Volver a la lista</a></p>';
    exit;
}

$codigo_album = $_GET['codigo'];

try {
    $consulta = $dwes->prepare('SELECT titulo FROM album WHERE codigo = :codigo');
    $consulta->bindParam(':codigo', $codigo_album);
    $consulta->execute();
    
    if ($consulta->rowCount() == 0) {
        echo '<p>El álbum no existe.</p>';
        echo '<p><a href="index.php">Volver a la lista</a></p>';
        exit;
    }
    
    $album = $consulta->fetch(PDO::FETCH_ASSOC);
    $titulo_album = $album['titulo'];
    
} catch (PDOException $e) {
    echo '<p>Error en la consulta: ' . $e->getMessage() . '</p>';
    exit;
}

$mensaje_exito = '';
$mensaje_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo_cancion = $_POST['titulo'];
    $posicion = $_POST['posicion'];
    $duracion = $_POST['duracion'];
    $genero = $_POST['genero'];
    
    try {
        $consulta_insert = $dwes->prepare('INSERT INTO cancion (titulo, album, posicion, duracion, genero) VALUES (:titulo, :album, :posicion, :duracion, :genero)');
        $consulta_insert->bindParam(':titulo', $titulo_cancion);
        $consulta_insert->bindParam(':album', $codigo_album);
        $consulta_insert->bindParam(':posicion', $posicion);
        $consulta_insert->bindParam(':duracion', $duracion);
        $consulta_insert->bindParam(':genero', $genero);
        
        $consulta_insert->execute();
        
        $mensaje_exito = 'Canción añadida correctamente.';
        
    } catch (PDOException $e) {
        $mensaje_error = 'Error al añadir la canción: ' . $e->getMessage();
    }
}

echo '<h1>Añadir nueva canción</h1>';
echo '<h2>Álbum: ' . htmlspecialchars($titulo_album) . '</h2>';

if ($mensaje_exito) {
    echo '<p style="color: green;">' . htmlspecialchars($mensaje_exito) . '</p>';
}

if ($mensaje_error) {
    echo '<p style="color: red;">' . htmlspecialchars($mensaje_error) . '</p>';
}

?>

<form method="POST" action="">
    <label for="titulo">Título de la canción:</label><br>
    <input type="text" id="titulo" name="titulo" required maxlength="50" size="50"><br><br>
    
    <label for="posicion">Posición:</label><br>
    <input type="number" id="posicion" name="posicion" required min="1" max="99"><br><br>
    
    <label for="duracion">Duración (HH:MM:SS):</label><br>
    <input type="time" id="duracion" name="duracion" step="1" required><br><br>
    
    <label for="genero">Género:</label><br>
    <select id="genero" name="genero" required>
        <option value="">Selecciona un género</option>
        <option value="Clásica">Clásica</option>
        <option value="BSO">BSO</option>
        <option value="Blues">Blues</option>
        <option value="Electrónica">Electrónica</option>
        <option value="Jazz">Jazz</option>
        <option value="Metal">Metal</option>
        <option value="Pop">Pop</option>
        <option value="Rock">Rock</option>
    </select><br><br>
    
    <input type="submit" value="Añadir canción">
</form>

<p><a href="album.php?codigo=<?php echo urlencode($codigo_album); ?>">Volver al álbum</a></p>

<?php
$dwes = null;
?>
