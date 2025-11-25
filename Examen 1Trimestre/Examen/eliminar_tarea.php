<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

require_once('tarea.ini.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id_tarea = $_GET['id'];

try {
    $tarea = new Tarea();
    
    if ($tarea->eliminar($id_tarea)) {
        header('Location: index.php?eliminada=1');
    } else {
        header('Location: index.php?error=1');
    }
} catch (Exception $e) {
    header('Location: index.php?error=1');
}
exit();
?>
