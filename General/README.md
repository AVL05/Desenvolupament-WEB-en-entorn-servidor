# Desarrollo Web en Entorno Servidor — Ejercicios 📚

**Resumen:** Este repositorio contiene los ejercicios realizados durante la asignatura _Desarrollo Web en Entorno Servidor_. Está organizado por temas y proyectos prácticos en PHP y **Laravel** (con acceso a base de datos MySQL en varios ejercicios).

---

## Índice 🔎

- [Desarrollo Web en Entorno Servidor — Ejercicios 📚](#desarrollo-web-en-entorno-servidor--ejercicios-)
  - [Índice 🔎](#índice-)
  - [Requisitos ✅](#requisitos-)
  - [Cómo ejecutar los ejercicios 🛠️](#cómo-ejecutar-los-ejercicios-️)
  - [Estructura del repositorio y ejercicios 📁](#estructura-del-repositorio-y-ejercicios-)
  - [Bases de datos y scripts SQL 🗃️](#bases-de-datos-y-scripts-sql-️)

---

## Requisitos ✅

- PHP (versión 8.2 o superior recomendada para proyectos Laravel)
- Servidor web local (XAMPP, WAMP, Laragon, o usar `php -S localhost:8000`)
- MySQL / MariaDB
- Composer (para gestión de dependencias en Laravel)
- Navegador moderno

---

## Cómo ejecutar los ejercicios 🛠️

1. **Proyectos PHP Nativo**:
   - Instala un servidor local (por ejemplo XAMPP).
   - Copia la carpeta a `htdocs` o ejecuta `php -S localhost:8000` dentro de la carpeta.

2. **Proyectos Laravel** (Temas 9, 10, 11...):
   - Asegúrate de tener Composer instalado.
   - Dentro de la carpeta del proyecto, ejecuta:
     ```bash
     composer install
     cp .env.example .env
     php artisan key:generate
     php artisan migrate
     php artisan serve
     ```

3. **Base de Datos**:
   - Crea las bases de datos necesarias según los archivos `.sql` o las migraciones de Laravel.
   - Ajusta `.env` (Laravel) o `conexion.php` (Nativo) con tus credenciales.

---

## Estructura del repositorio y ejercicios 📁

A continuación un resumen por carpetas con los ejercicios incluidos:

- **Examen 1 Trimestre/**
  - Aplicación de gestión de tareas y ejercicios de examen.

- **Examen 2 Trimestre/**
  - `gestion-tareas/`: Proyecto completo en Laravel para gestión de tareas.
  - `Examen 1er Trimeste (Laravel)/`: Prácticas o recuperaciones relacionadas.

- **Tema 1/**
  - Ejercicios básicos de HTML (`principal.html`, `rrss.html`).

- **Tema 2/**
  - Introducción a PHP: ejemplos de sintaxis, includes y formularios.

- **Tema 3/Herencia de clases/**
  - Programación Orientada a Objetos (POO): Clases `CintaVideo`, `Dvd`, `Juego` y tests.

- **Tema 4/**
  - Acceso a bases de datos (PDO/MySQLi) y estructura de aplicaciones (`store/`, `discografia/`).

- **Tema 5/**
  - Proyecto Discografía: Gestión de discos, canciones y usuarios con PHP nativo.

- **Tema 6/**
  - **Ejercicio Obligatorio/**: Sistema de usuarios (Login/Registro/Perfil) en PHP puro.

- **Tema 7/**
  - **API Reservas Hotel/**: API REST básica y consumo de servicios.

- **Tema 8/**
  - Arquitectura MVC: Ejemplo práctico `ejemplo_mvc/`.

- **Tema 9/**
  - `videoclub/`: Trabajo/Proyecto en PHP.

- **Tema 10/** (Laravel: Controladores y Middleware)
  - `videoclub/`: Inicio del proyecto Videoclub en Laravel.
  - Apuntes y documentación sobre Laravel 12.

- **Tema 11/** (Laravel: Modelos y BD)
  - `videoclub - pt1/`: Evolución del proyecto Videoclub.
  - `videoclub - pt2/`: Funcionalidades avanzadas del Videoclub.
  - Apuntes sobre Eloquent ORM y acceso a datos.

---

## Bases de datos y scripts SQL 🗃️

- **Proyectos Nativos**: Busca archivos `.sql` dentro de las carpetas (ej. `database.sql`).
- **Proyectos Laravel**: Utiliza `php artisan migrate` para generar la estructura de la base de datos definida en `database/migrations/`.
