-- Crear base de datos
CREATE DATABASE IF NOT EXISTS user_profiles_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE user_profiles_db;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_image_big VARCHAR(255) DEFAULT NULL,
    profile_image_small VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
