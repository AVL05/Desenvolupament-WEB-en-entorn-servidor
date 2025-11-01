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

if (isset($_GET['error'])) {
    echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
}

if (!isset($_GET['codigo'])) {
    echo '<p>No se ha especificado el código del álbum.</p>';
    echo '<p><a href="index.php">Volver a la lista</a></p>';
    exit;
}

$codigo_album = $_GET['codigo'];

try {
    $consulta = $dwes->prepare('SELECT * FROM album WHERE codigo = :codigo');
    $consulta->bindParam(':codigo', $codigo_album);
    $consulta->execute();
    
    if ($consulta->rowCount() == 0) {
        echo '<p>El álbum no existe.</p>';
        echo '<p><a href="index.php">Volver a la lista</a></p>';
        exit;
    }
    
    $album = $consulta->fetch(PDO::FETCH_ASSOC);
    
    echo '<h1>Álbum: ' . htmlspecialchars($album['titulo']) . '</h1>';
    echo '<h2>Información del álbum</h2>';
    echo '<ul>';
    echo '<li><strong>Código:</strong> ' . htmlspecialchars($album['codigo']) . '</li>';
    echo '<li><strong>Discográfica:</strong> ' . htmlspecialchars($album['discografica']) . '</li>';
    echo '<li><strong>Formato:</strong> ' . htmlspecialchars($album['formato']) . '</li>';
    echo '<li><strong>Fecha de lanzamiento:</strong> ' . htmlspecialchars($album['fechaLanzamiento']) . '</li>';
    echo '<li><strong>Fecha de compra:</strong> ' . htmlspecialchars($album['fechaCompra'] ?? 'No especificada') . '</li>';
    echo '<li><strong>Precio:</strong> ' . htmlspecialchars($album['precio']) . '€</li>';
    echo '</ul>';
    
    $consulta_canciones = $dwes->prepare('SELECT * FROM cancion WHERE album = :album ORDER BY posicion');
    $consulta_canciones->bindParam(':album', $codigo_album);
    $consulta_canciones->execute();
    
    echo '<h2>Canciones</h2>';
    
    if ($consulta_canciones->rowCount() == 0) {
        echo '<p>Este álbum no tiene canciones.</p>';
    } else {
        echo '<table border="1" cellpadding="5">';
        echo '<tr><th>Posición</th><th>Título</th><th>Duración</th><th>Género</th></tr>';
        
        while ($cancion = $consulta_canciones->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($cancion['posicion']) . '</td>';
            echo '<td>' . htmlspecialchars($cancion['titulo']) . '</td>';
            echo '<td>' . htmlspecialchars($cancion['duracion']) . '</td>';
            echo '<td>' . htmlspecialchars($cancion['genero']) . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    }
    
    echo '<h3>Opciones</h3>';
    echo '<p><a href="cancionnueva.php?codigo=' . urlencode($codigo_album) . '">Añadir nueva canción</a></p>';
    echo '<p><a href="borraralbum.php?codigo=' . urlencode($codigo_album) . '" onclick="return confirm(\'¿Estás seguro de que quieres borrar este álbum y todas sus canciones?\')">Borrar álbum</a></p>';
    echo '<p><a href="index.php">Volver a la lista de álbumes</a></p>';
    
} catch (PDOException $e) {
    echo '<p>Error en la consulta: ' . $e->getMessage() . '</p>';
}

$dwes = null;
?>
</body>
</html>
