-- Script para agregar el campo 'portada' a la tabla album
-- Ejecutar este script en tu base de datos MySQL

USE discografia;

-- Agregar columna portada a la tabla album
ALTER TABLE album 
ADD COLUMN portada VARCHAR(255) DEFAULT '' AFTER precio;

-- Verificar que se agregó correctamente
DESCRIBE album;
