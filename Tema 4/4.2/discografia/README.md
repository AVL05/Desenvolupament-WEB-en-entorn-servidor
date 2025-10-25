# Aplicación de Discografía

Aplicación web para gestionar una discografía personal usando PHP y MySQL con PDO.

## Requisitos
- XAMPP instalado
- PHP 7.4 o superior
- MySQL/MariaDB

## Instalación

### 1. Crear la base de datos
1. Abre XAMPP y inicia Apache y MySQL
2. Abre phpMyAdmin: `http://localhost/phpmyadmin`
3. Ejecuta el archivo `discografia.sql` en la pestaña SQL

### 2. Acceder a la aplicación
Abre: `http://localhost/discografia/index.php`

## Funcionalidades
- Ver lista de álbumes
- Ver detalle de álbum con canciones
- Añadir nuevos álbumes
- Añadir canciones a álbumes
- Buscar canciones por título, álbum o género
- Borrar álbumes (con transacciones)

## Tecnologías
- PHP con PDO
- MySQL
- Consultas preparadas
- Transacciones
- Manejo de excepciones
