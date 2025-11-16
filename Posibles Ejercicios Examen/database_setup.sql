-- =====================================================
-- Script SQL para crear las bases de datos y tablas
-- de los ejercicios PHP
-- =====================================================

-- =====================================================
-- EJERCICIO 1: GESTIÓN DE BIBLIOTECA
-- =====================================================

CREATE DATABASE IF NOT EXISTS biblioteca_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE biblioteca_db;

CREATE TABLE IF NOT EXISTS publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(10) UNIQUE NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    anio_publicacion INT NOT NULL,
    tipo ENUM('libro', 'revista') NOT NULL,
    prestado BOOLEAN DEFAULT FALSE,
    -- Campos específicos para Libro
    autor VARCHAR(255) NULL,
    num_paginas INT NULL,
    -- Campos específicos para Revista
    numero INT NULL,
    mes_publicacion VARCHAR(50) NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_tipo (tipo),
    INDEX idx_prestado (prestado)
) ENGINE=InnoDB;

-- =====================================================
-- EJERCICIO 2: SISTEMA DE USUARIOS
-- =====================================================

CREATE DATABASE IF NOT EXISTS sistema_usuarios_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE sistema_usuarios_db;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    genero ENUM('masculino', 'femenino', 'otro') NOT NULL,
    publicidad BOOLEAN DEFAULT FALSE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB;

-- =====================================================
-- EJERCICIO 3: CATÁLOGO DE PRODUCTOS
-- =====================================================

CREATE DATABASE IF NOT EXISTS catalogo_productos_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE catalogo_productos_db;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    descuento BOOLEAN DEFAULT FALSE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_categoria (categoria),
    INDEX idx_descuento (descuento),
    INDEX idx_precio (precio)
) ENGINE=InnoDB;

-- Insertar productos de ejemplo
INSERT INTO productos (nombre, categoria, precio, stock, descuento) VALUES
('Smartphone Samsung Galaxy S23', 'Electrónica', 899.99, 15, TRUE),
('Camiseta Adidas Original', 'Ropa', 29.99, 50, FALSE),
('Aceite de Oliva Virgen Extra', 'Alimentación', 12.50, 100, TRUE),
('Portátil HP Pavilion', 'Electrónica', 749.00, 8, FALSE),
('Pantalones Vaqueros Levi''s', 'Ropa', 79.99, 30, TRUE),
('Pasta Italiana Premium', 'Alimentación', 3.99, 200, FALSE),
('Auriculares Sony WH-1000XM5', 'Electrónica', 399.99, 12, TRUE),
('Zapatillas Nike Air Max', 'Ropa', 129.99, 25, FALSE);

-- =====================================================
-- Verificación de las bases de datos creadas
-- =====================================================

-- Para verificar:
-- SHOW DATABASES;
-- USE biblioteca_db; SHOW TABLES;
-- USE sistema_usuarios_db; SHOW TABLES;
-- USE catalogo_productos_db; SHOW TABLES;
