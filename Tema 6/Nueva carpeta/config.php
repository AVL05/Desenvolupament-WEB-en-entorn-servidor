<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'user_profiles_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de rutas
define('BASE_PATH', __DIR__);
define('IMG_PATH', BASE_PATH . '/img/users');
define('IMG_URL', '/img/users');

// Configuración de imágenes
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png']);
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png']);
define('BIG_IMAGE_WIDTH', 360);
define('BIG_IMAGE_HEIGHT', 480);
define('SMALL_IMAGE_WIDTH', 72);
define('SMALL_IMAGE_HEIGHT', 96);

// Conexión a la base de datos
function getConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
