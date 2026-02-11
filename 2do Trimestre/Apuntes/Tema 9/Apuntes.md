# 📘 **Resumen del Tema – Laravel 12**

## 1. Introducción

Laravel es un **framework PHP moderno** basado en **MVC**, creado para facilitar tareas comunes como autenticación, rutas, sesiones y caché.  
Incluye:

- **Eloquent** (ORM)
- **Blade** (plantillas)
- **Artisan** (CLI)
- Requiere **PHP ≥ 8.2**, **Composer** y **Node.js** para npm.

---

## 2. Instalación y entorno

- Crear proyecto: `laravel new ejemplo`
- Ejecutar: `php artisan serve` o `composer run dev`
- Si falla `npm install`: `Set-ExecutionPolicy RemoteSigned`
- La carpeta **public/** es el punto de entrada.

---

## 3. Configuración

- Archivos en **config/**
- Variables en **.env**
- `env('VAR', 'default')` permite valores por entorno.

---

## 4. Estructura de directorios

- **app/** → controladores, middleware, modelos
- **routes/** → rutas
- **resources/views/** → vistas Blade
- **public/** → archivos accesibles
- **database/** → migraciones, seeders
- **storage/** → logs, caché, sesiones
- **vendor/** → dependencias Composer

---

## 5. Ciclo de vida de una petición

1. Petición entra por **public/index.php**
2. Kernel carga middleware
3. Se resuelve la ruta
4. Se ejecuta controlador/closure
5. Se genera respuesta
6. Se envía al navegador

---

## 6. Routing

- Define URL + método + acción
- Ver rutas: `php artisan route:list`

### Tipos de rutas

- Básica:
  ```php
  Route::get('/', fn() => 'Hola');
  ```
- Vista:
  ```php
  return view('welcome');
  ```
- Múltiples métodos: `match`, `any`
- Parámetros:
  ```php
  /user/{id}
  /user/{name?}
  ```
- Restricciones:
  ```php
  ->where('id', '[0-9]+')
  ```

---

## 7. Views (Vistas)

- Ubicación: **resources/views/**
- No contienen lógica de negocio
- Se llaman con `view('nombre', ['dato' => valor])`

### Blade

- Extensión: `.blade.php`
- Mostrar datos: `{{ $var }}`
- Comentarios: `{{-- ... --}}`
- Incluir vistas: `@include('vista')`
- Estructuras: `@if`, `@foreach`, etc.

---

## 8. Layouts

Permiten definir una **plantilla base** y rellenar secciones desde otras vistas.

### Directivas clave

- `@extends('layout')` → usar layout
- `@section('nombre')` → definir contenido
- `@yield('nombre')` → mostrar sección
- `@parent` → añadir sin sobrescribir

Ejemplo de layout:

```php
@section('menu')
@show
@yield('content')
```

---

## 9. Quickstart

Tutorial básico “Task List” (Laravel 5.2):

```bash
composer create-project laravel/laravel quickstart 5.2.*
```
