<?php
$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try {
    $dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '', $opc);
    $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<p>Error al conectar con la base de datos: ' . $e->getMessage() . '</p>';
    exit;
}

$mensaje_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $discografica = $_POST['discografica'];
    $formato = $_POST['formato'];
    $fechaLanzamiento = $_POST['fechaLanzamiento'];
    $fechaCompra = $_POST['fechaCompra'];
    $precio = $_POST['precio'];
    
    try {
        $consulta_insert = $dwes->prepare('INSERT INTO album (codigo, titulo, discografica, formato, fechaLanzamiento, fechaCompra, precio) VALUES (:codigo, :titulo, :discografica, :formato, :fechaLanzamiento, :fechaCompra, :precio)');
        $consulta_insert->bindParam(':codigo', $codigo);
        $consulta_insert->bindParam(':titulo', $titulo);
        $consulta_insert->bindParam(':discografica', $discografica);
        $consulta_insert->bindParam(':formato', $formato);
        $consulta_insert->bindParam(':fechaLanzamiento', $fechaLanzamiento);
        $consulta_insert->bindParam(':fechaCompra', $fechaCompra);
        $consulta_insert->bindParam(':precio', $precio);
        
        $consulta_insert->execute();
        
        header('Location: index.php?mensaje=' . urlencode('Álbum creado correctamente.'));
        exit;
        
    } catch (PDOException $e) {
        $mensaje_error = 'Error al añadir el álbum: ' . $e->getMessage();
    }
}

echo '<h1>Añadir nuevo álbum</h1>';

if ($mensaje_error) {
    echo '<p style="color: red;">' . htmlspecialchars($mensaje_error) . '</p>';
}

?>

<form method="POST" action="">
    <label for="codigo">Código (7 caracteres):</label><br>
    <input type="text" id="codigo" name="codigo" required maxlength="7" size="10"><br><br>
    
    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo" required maxlength="50" size="50"><br><br>
    
    <label for="discografica">Discográfica:</label><br>
    <input type="text" id="discografica" name="discografica" required maxlength="25" size="30"><br><br>
    
    <label for="formato">Formato:</label><br>
    <select id="formato" name="formato" required>
        <option value="">Selecciona un formato</option>
        <option value="vinilo">Vinilo</option>
        <option value="cd">CD</option>
        <option value="dvd">DVD</option>
        <option value="mp3">MP3</option>
    </select><br><br>
    
    <label for="fechaLanzamiento">Fecha de lanzamiento:</label><br>
    <input type="date" id="fechaLanzamiento" name="fechaLanzamiento" required><br><br>
    
    <label for="fechaCompra">Fecha de compra (opcional):</label><br>
    <input type="date" id="fechaCompra" name="fechaCompra"><br><br>
    
    <label for="precio">Precio (€):</label><br>
    <input type="number" id="precio" name="precio" step="0.01" min="0" required><br><br>
    
    <input type="submit" value="Añadir álbum">
</form>

<p><a href="index.php">Volver a la lista de álbumes</a></p>

<?php
$dwes = null;
?>
