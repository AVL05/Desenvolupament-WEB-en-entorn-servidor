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
