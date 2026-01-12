# Desarrollo Web en Entorno Servidor — Ejercicios 📚

**Resumen:** Este repositorio contiene los ejercicios realizados durante la asignatura _Desarrollo Web en Entorno Servidor_. Está organizado por temas y proyectos prácticos en PHP (con acceso a base de datos MySQL en varios ejercicios).

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

- PHP (versión 7.4 o superior recomendada)
- Servidor web local (XAMPP, WAMP, Laragon, o usar `php -S localhost:8000` para prácticas sencillas)
- MySQL / MariaDB para los ejercicios que lo requieran
- Navegador moderno

---

## Cómo ejecutar los ejercicios 🛠️

1. Instala un servidor local (por ejemplo XAMPP).
2. Copia la carpeta del ejercicio que quieras ejecutar a la carpeta pública (por ejemplo `htdocs` en XAMPP) o ejecuta el servidor embebido desde la carpeta del ejercicio:

```bash
cd ruta/al/ejercicio
php -S localhost:8000
```

3. Crea la base de datos importando los scripts SQL correspondientes (ver la sección "Bases de datos y scripts SQL").
4. Revisa los archivos de configuración de conexión (ej.: `conexion.ini.php`, `db.php`) y ajusta las credenciales (usuario, contraseña, host, nombre de BD).

> ⚠️ Si el ejercicio usa archivos `.ini` para configuración, comprueba que estén protegidos o fuera de la raíz pública en entorno real.

---

## Estructura del repositorio y ejercicios 📁

A continuación un resumen por carpetas con los ejercicios incluidos:

- **Examen 1Trimestre/**

  - Aplicación de gestión de tareas: `index.php`, `login.php`, `registro.php`, `nueva_tarea.php`, `editar_tarea.php`, `eliminar_tarea.php`, `perfil.php`.
  - Archivos de configuración: `cabecera.ini.php`, `conexion.ini.php`, `tarea.ini.php`, `usuario.ini.php`.
  - Subcarpeta: `Posibles Ejercicios Examen/` con `database_setup.sql` y ejercicios ejemplo.

- **Tema 1/**

  - Ejercicios de HTML: `principal.html`, `rrss.html`, `tecnologias.html`.

- **Tema 2/**

  - Múltiples ejemplos de PHP distribuidos en subcarpetas `2.1`, `2.2`, `2.3`, `2.4` con ficheros como `archivo.php`, `cabecera.inc.php`, `info.php`, `prueba.php`, `rrss.php`, `server.php` y ejemplos de formularios y includes.

- **Tema 3/Herencia de clases/**

  - Ejercicios de POO y herencia: `testCintaVideo.php`, `testCompleto.php`, `testDvd.php`, `testJuego.php`, `testSoporte.php`.

- **Tema 4/**

  - Prácticas de acceso a bases de datos y aplicaciones (carpeta `store/`, `discografia/` en otras subcarpetas).

- **Tema 5/**

  - Proyecto de discografía: `album.ini.php`, `borrardisco.php`, `canciones.php`, `cancionnueva.php`, `conexion.ini.php`, `disco.php`, `index.php`, `login.php`, `registro.php`.

- **Tema 6/**

  - **Ejercicio Obligatorio/**: sistema de gestión de usuarios con `database.sql`, `db.php`, `index.php`, `register.php`, `profile.php`, `logout.php`, `style.css`.

- **Tema 7/**

  - **API Reservas Hotel/**: `database.sql`, `index.php`, `credenciales.txt`, `README.md` (específico del ejercicio). También trabajos como `Trabajo Pokemon`.

- **Tema 8/**

  - `ejemplo_mvc/` (ejemplo de arquitectura MVC).

- **Tema 9/**
  - `godoy/` (ejercicio o trabajo final relacionado).

---

## Bases de datos y scripts SQL 🗃️

Archivos SQL incluidos (importar con phpMyAdmin o con `mysql`):

- `Examen 1Trimestre/Posibles Ejercicios Examen/database_setup.sql`
- `Tema 6/Ejercicio Obligatorio/database.sql`
- `Tema 7/API Reservas Hotel/database.sql`

Ajusta las credenciales en los archivos de conexión antes de ejecutar la aplicación.
