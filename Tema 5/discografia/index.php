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

if (isset($_GET['mensaje'])) {
    echo '<p style="color: green;">' . htmlspecialchars($_GET['mensaje']) . '</p>';
}

echo '<h1>Discografía - Lista de Álbumes</h1>';
echo '<p><a href="albumnuevo.php">Añadir nuevo álbum</a> | <a href="canciones.php">Buscar canciones</a></p>';

try {
    $consulta = $dwes->query('SELECT codigo, titulo, discografica, formato, precio FROM album ORDER BY titulo');
    
    if ($consulta->rowCount() == 0) {
        echo '<p>No hay álbumes en la base de datos.</p>';
    } else {
        echo '<ul>';
        while ($album = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo '<li><a href="album.php?codigo=' . urlencode($album['codigo']) . '">';
            echo '<strong>' . htmlspecialchars($album['titulo']) . '</strong>';
            echo ' (' . htmlspecialchars($album['discografica']) . ' - ' . htmlspecialchars($album['formato']) . ' - ' . htmlspecialchars($album['precio']) . '€)</a></li>';
        }
        echo '</ul>';
    }
} catch (PDOException $e) {
    echo '<p>Error en la consulta: ' . $e->getMessage() . '</p>';
}

$dwes = null;
?>
</body>
</html>
