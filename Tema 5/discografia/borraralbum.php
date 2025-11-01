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
    header('Location: index.php');
    exit;
}

$codigo_album = $_GET['codigo'];

$ok = true;

try {
    $dwes->beginTransaction();
    
    $consulta_canciones = $dwes->prepare('DELETE FROM cancion WHERE album = :album');
    $consulta_canciones->bindParam(':album', $codigo_album);
    
    if (!$consulta_canciones->execute()) {
        $ok = false;
    }
    
    if ($ok) {
        $consulta_album = $dwes->prepare('DELETE FROM album WHERE codigo = :codigo');
        $consulta_album->bindParam(':codigo', $codigo_album);
        
        if (!$consulta_album->execute()) {
            $ok = false;
        }
    }
    
    if ($ok) {
        $dwes->commit();
        header('Location: index.php?mensaje=' . urlencode('Álbum borrado correctamente.'));
        exit;
    } else {
        $dwes->rollback();
        header('Location: album.php?codigo=' . urlencode($codigo_album) . '&error=' . urlencode('Error al borrar el álbum.'));
        exit;
    }
    
} catch (PDOException $e) {
    $dwes->rollback();
    header('Location: album.php?codigo=' . urlencode($codigo_album) . '&error=' . urlencode('Error: ' . $e->getMessage()));
    exit;
}

$dwes = null;
?>
