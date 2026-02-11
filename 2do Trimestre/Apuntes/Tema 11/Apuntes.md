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
