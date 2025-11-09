<?php
require_once 'config.php';

// Destruir sesión
session_destroy();

// Limpiar cookies de sesión
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirigir a login
header('Location: login.php');
exit();
