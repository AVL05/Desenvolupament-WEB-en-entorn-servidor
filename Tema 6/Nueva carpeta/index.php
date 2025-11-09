<?php
require_once 'config.php';
require_once 'functions.php';

// Si está logueado, redirigir al perfil
if (isLoggedIn()) {
    header('Location: profile.php');
    exit();
}

// Si no está logueado, redirigir al registro
header('Location: register.php');
exit();
