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

# 📘 **Resumen del Tema – Laravel 12: Controllers, Middleware y Routing Avanzado**

---

# 1. Introducción

En esta unidad se incorporan **controladores** al flujo de trabajo de Laravel y se introduce el uso de **middleware**, **redirecciones** y **formularios**.  
Los modelos se verán en la siguiente unidad.

---

# 2. Controllers (Controladores)

### ✔️ Qué son

- Son **clases** que agrupan la lógica asociada a un recurso.
- Son el punto de entrada de las peticiones en el patrón **MVC**.
- Preparan datos, consultan modelos y devuelven vistas.

### ✔️ Ubicación

```
app/Http/Controllers/
```

### ✔️ Convenciones

- Nombre con sufijo **Controller** (UserController, MoviesController…).
- Deben **extender** la clase base `Controller`.

### ✔️ Ejemplo básico

```php
class UserController extends Controller {
    public function show($id) {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
```

### ✔️ Usar un controlador en rutas

```php
use App\Http\Controllers\UserController;

Route::get('user/{id}', [UserController::class, 'show']);
```

### ✔️ Crear controladores con Artisan

- Controlador vacío:
  ```bash
  php artisan make:controller NombreController
  ```
- Controlador CRUD:
  ```bash
  php artisan make:controller NombreController --resource
  ```

### ✔️ Controladores tipo resource

```php
Route::resource('uri', NombreController::class);
```

Genera rutas para: index, create, store, show, edit, update, destroy.

### ✔️ Generar URLs hacia acciones

```php
$url = action([UserController::class, 'show'], ['id' => 1]);
```

---

# 3. Middleware

### ✔️ Qué son

Clases que **filtran** o **inspeccionan** peticiones HTTP antes o después de ejecutarse.  
Sirven para:

- Autenticación
- Comprobaciones previas
- Redirecciones
- Validaciones

### ✔️ Ubicación

```
app/Http/Middleware/
```

### ✔️ Crear middleware

```bash
php artisan make:middleware NombreMiddleware
```

### ✔️ Estructura básica

```php
public function handle(Request $request, Closure $next) {
    if ($request->input('token') !== 'my-secret-token') {
        return redirect('home');
    }
    return $next($request);
}
```

### ✔️ Acciones posibles

- Continuar:
  ```php
  return $next($request);
  ```
- Redirigir:
  ```php
  return redirect('home');
  ```
- Lanzar error:
  ```php
  abort(403, 'Unauthorized');
  ```

### ✔️ Middleware antes o después

Antes:

```php
// acción
return $next($request);
```

Después:

```php
$response = $next($request);
// acción
return $response;
```

### ✔️ Registrar middleware

#### Global

En `bootstrap/app.php`:

```php
$middleware->append(EnsureTokenIsValid::class);
```

#### En rutas

```php
Route::get('/profile', fn() => ...)->middleware(EnsureTokenIsValid::class);
```

#### Varios middleware

```php
->middleware([First::class, Second::class])
```

#### Grupos

```php
$middleware->appendToGroup('web', [First::class, Second::class]);
```

---

# 4. Routing Avanzado

### ✔️ Redirecciones

```php
Route::redirect('/here', '/there');
return redirect('/home');
return redirect()->route('profile');
```

Volver atrás:

```php
return back();
```

Con datos del formulario:

```php
return back()->withInput();
```

### ✔️ Redirigir a acciones

```php
return redirect()->action([HomeController::class, 'index']);
```

### ✔️ Rutas con nombre

```php
Route::get('/user/profile', fn() => ...)->name('profile');
```

Generar URL:

```php
route('profile');
```

### ✔️ Grupos de rutas

Permiten compartir:

- Middleware
- Prefijos
- Nombres
- Controladores

Ejemplo:

```php
Route::middleware(['web'])->group(function () {
    Route::get('/', ...);
});
```

### ✔️ Controlador común para un grupo

```php
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
});
```

### ✔️ Subdominios

```php
Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', ...);
});
```

### ✔️ Prefijo de nombres

```php
Route::name('admin.')->group(function () {
    Route::get('/users', ...)->name('users');
});
```

---

# 5. Forms (Formularios)

### ✔️ Atributos básicos

```html
<form method="POST" action="/ruta"></form>
```

### ✔️ Usar URLs de Laravel

```html
<form action="{{ url('foo/bar') }}" method="POST"></form>
```

O hacia un controlador:

```html
<form
  action="{{ action([HomeController::class, 'getHome']) }}"
  method="POST"
></form>
```

### ✔️ CSRF obligatorio

```php
@csrf
```

### ✔️ Métodos PUT, PATCH, DELETE

```php
@method('PUT')
```

### ✔️ Rellenar campos con valores previos

```php
value="{{ old('nombre') }}"
```

# 📘 **Resumen del Tema – Laravel 12: Base de Datos, Migraciones, Query Builder, Input Data y Autenticación**

---

# 0. Introducción

Laravel facilita el uso de bases de datos como **MySQL, PostgreSQL, SQLite y SQL Server**.  
La configuración está en:

```
config/database.php
```

Los valores se gestionan desde **.env**:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Laravel permite usar **múltiples conexiones** simultáneamente.

---

# 1. Configuración de la base de datos

- `config/database.php` define conexiones y parámetros.
- `.env` permite cambiar valores sin modificar código.
- Conexión por defecto:
  ```php
  'default' => env('DB_CONNECTION', 'mysql')
  ```

---

# 2. Migraciones

### ✔️ Qué son

Sistema de **control de versiones** para la base de datos.  
Permiten crear, modificar y eliminar tablas mediante PHP.

### ✔️ Comandos básicos

- Instalar sistema de migraciones:
  ```bash
  php artisan migrate:install
  ```
- Ejecutar migraciones:
  ```bash
  php artisan migrate
  ```
- Ver estado:
  ```bash
  php artisan migrate:status
  ```

### ✔️ Crear migraciones

- Crear tabla:
  ```bash
  php artisan make:migration create_users_table --create=users
  ```
- Modificar tabla:
  ```bash
  php artisan make:migration add_phone_to_users_table --table=users
  ```

### ✔️ Métodos importantes

Cada migración tiene:

- `up()` → crea o modifica
- `down()` → revierte cambios

### ✔️ Ejecutar sin aplicar (simulación)

```bash
php artisan migrate --pretend
```

### ✔️ Revertir migraciones

- Último batch:
  ```bash
  php artisan migrate:rollback
  ```
- Todas:
  ```bash
  php artisan migrate:reset
  ```
- Refrescar (rollback + migrate):
  ```bash
  php artisan migrate:refresh
  ```
- Fresh (elimina tablas + migrate):
  ```bash
  php artisan migrate:fresh
  ```

### ✔️ Crear tablas

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

### ✔️ Modificar tablas

```php
Schema::table('users', function (Blueprint $table) {
    $table->integer('votes');
});
```

### ✔️ Tipos de columnas

- `string`, `text`, `integer`, `boolean`, `float`, `enum`, `tinyInteger`, etc.

### ✔️ Modificadores

- `nullable()`
- `default()`
- `unique()`

### ✔️ Índices

- `primary()`
- `unique()`
- `index()`
- `fullText()`
- `spatialIndex()`

### ✔️ Claves foráneas

```php
$table->foreign('user_id')->references('id')->on('users');
```

---

# 3. Database Seeding

### ✔️ Qué es

Permite **insertar datos de prueba** automáticamente.

### ✔️ Crear un seeder

```bash
php artisan make:seeder UserSeeder
```

### ✔️ Insertar datos

```php
DB::table('users')->insert([
    'name' => Str::random(10),
    'email' => Str::random(10).'@example.com'
]);
```

### ✔️ Ejecutar seeders

```bash
php artisan db:seed
php artisan db:seed --class=UserSeeder
```

### ✔️ Re-crear BD + seed

```bash
php artisan migrate:fresh --seed
```

---

# 4. Query Builder

### ✔️ Obtener datos

```php
$users = DB::table('users')->get();
```

### ✔️ Obtener un registro

```php
$user = DB::table('users')->where('name', 'John')->first();
```

### ✔️ Obtener un valor

```php
$email = DB::table('users')->value('email');
```

### ✔️ Where

```php
->where('votes', 100)
->where('age', '>', 35)
```

### ✔️ Where con array

```php
->where([
    ['status', '=', 1],
    ['subscribed', '<>', 1]
])
```

### ✔️ Operadores

`=`, `>`, `<`, `<>`, `like`, etc.

### ✔️ orWhere

```php
->orWhere('name', 'John')
```

### ✔️ Agrupación de condiciones

```php
->orWhere(function($q){
    $q->where('name', 'Abigail')->where('votes', '>', 50);
})
```

### ✔️ whereNot

```php
->whereNot(function($q){ ... })
```

### ✔️ Otros where

- `whereBetween`
- `whereIn`
- `whereNull`
- `whereDate`
- `whereColumn`
- `whereExists`

### ✔️ Subconsultas

```php
->where('amount', '<', function($q){
    $q->selectRaw('avg(amount)')->from('incomes');
})
```

### ✔️ Ordenación

```php
->orderBy('name', 'desc')
->latest()
->inRandomOrder()
```

### ✔️ Agrupación

```php
->groupBy('customer_id')
->havingBetween('number_of_orders', [5, 15])
```

---

# 6. Input Data (Datos de entrada)

### ✔️ Obtener datos del Request

```php
public function store(Request $request) {
    $name = $request->input('nombre');
}
```

### ✔️ Métodos útiles

- `input('campo', 'valor_por_defecto')`
- `has('campo')`
- `all()`
- `only()`
- `except()`

### ✔️ Arrays en formularios

```php
$request->input('products.0.name');
$request->input('products.*.name');
```

### ✔️ Archivos subidos

```php
$file = $request->file('photo');
$request->hasFile('photo');
$file->isValid();
```

### ✔️ Guardar archivos

```php
$path = $request->photo->store('images');
$path = $request->photo->storeAs('images', 'nombre.jpg');
```

---

# 7. User Control (Autenticación)

### ✔️ Breeze (sistema recomendado)

```bash
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install
npm run dev
```

Crea:

- Controladores en `App\Http\Controllers\Auth`
- Rutas en `routes/auth.php`
- Vistas en `resources/views/auth`

### ✔️ Obtener usuario autenticado

```php
Auth::user();
Auth::id();
```

O desde Request:

```php
$request->user();
```

### ✔️ Comprobar autenticación

```php
Auth::check();
```

### ✔️ Proteger rutas

```php
Route::get('/flights', fn() => ...)->middleware('auth');
```

### ✔️ Login manual

```php
if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    return redirect()->intended('dashboard');
}
```

### ✔️ Logout

```php
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
```

---
