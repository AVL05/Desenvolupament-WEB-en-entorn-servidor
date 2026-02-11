<?php
// ========================================
// CONFIGURACIÓN DE BASE DE DATOS MYSQL
// ========================================

// --- DATOS DE CONEXIÓN ---
define('DB_HOST', 'localhost');  // Servidor (siempre localhost en XAMPP)
define('DB_USER', 'root');        // Usuario por defecto de XAMPP
define('DB_PASS', '');            // Sin contraseña por defecto en XAMPP

// --- FUNCIÓN: CONECTAR A BASE DE DATOS ---
// Uso: $db = getDBConnection('nombre_base_datos');
function getDBConnection($dbname) {
    try {
        // Crear conexión PDO
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . $dbname . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        
        // Configurar PDO para mostrar errores
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Obtener resultados como array asociativo
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>
