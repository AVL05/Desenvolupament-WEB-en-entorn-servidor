# Ejercicios PHP + MySQL - Guía Rápida para el Examen

## ⚙️ Configuración Inicial

### 1. Iniciar XAMPP
- Abrir Panel de Control XAMPP
- Iniciar **Apache** y **MySQL**

### 2. Crear Bases de Datos
- Abrir `http://localhost/phpmyadmin`
- Ir a pestaña **SQL**
- Copiar y ejecutar el contenido del archivo `database_setup.sql`

### 3. Configuración de Conexión
Archivo: `config.php`
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Sin contraseña en XAMPP
```

---

## 📚 Ejercicio 1: Gestión de Biblioteca (POO + MySQL)

**Base de datos:** `biblioteca_db`  
**Tabla:** `publicaciones`  
**Archivo:** `biblioteca.php`

### Conceptos Clave:
- **POO:** Clases `Libro` y `Revista` que heredan de `Publicacion`
- **Excepciones personalizadas:** `PublicacionYaPrestadaException`
- **MySQL:** INSERT, SELECT, UPDATE
- **Validación:** Formato de código (3 letras + 4 números)

### Operaciones SQL:
```sql
-- Insertar libro
INSERT INTO publicaciones (codigo, titulo, anio_publicacion, tipo, autor, num_paginas)
VALUES (?, ?, ?, 'libro', ?, ?)

-- Insertar revista
INSERT INTO publicaciones (codigo, titulo, anio_publicacion, tipo, numero, mes_publicacion)
VALUES (?, ?, ?, 'revista', ?, ?)

-- Consultar todas
SELECT * FROM publicaciones ORDER BY fecha_creacion DESC

-- Actualizar préstamo
UPDATE publicaciones SET prestado = TRUE WHERE id = ?
```

---

## 👤 Ejercicio 2: Sistema de Usuarios (MySQL)

**Base de datos:** `sistema_usuarios_db`  
**Tabla:** `usuarios`  
**Archivos:** `login.php`, `registro.php`, `perfil.php`

### Conceptos Clave:
- **Sesiones:** `$_SESSION['usuario']`
- **Seguridad:** `password_hash()` y `password_verify()`
- **Validación:** Email, contraseña segura, edad +18
- **MySQL:** INSERT, SELECT

### Operaciones SQL:
```sql
-- Registrar usuario
INSERT INTO usuarios (username, email, password_hash, fecha_nacimiento, genero, publicidad)
VALUES (?, ?, ?, ?, ?, ?)

-- Login
SELECT * FROM usuarios WHERE username = ?
```

### Código Importante:
```php
// Encriptar contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// Verificar contraseña
if (password_verify($password, $usuario['password_hash'])) {
    // Login correcto
}
```

---

## 🛒 Ejercicio 3: Catálogo de Productos (MySQL)

**Base de datos:** `catalogo_productos_db`  
**Tabla:** `productos`  
**Archivo:** `catalogo.php`

### Conceptos Clave:
- **Filtros GET:** `$_GET['categoria']`, `$_GET['busqueda']`
- **Prepared Statements:** Prevención de inyección SQL
- **Consultas dinámicas:** Construir SQL según filtros
- **Funciones:** `calcularValorTotal()`, `productoMasCaro()`

### Operaciones SQL:
```sql
-- Consulta base
SELECT * FROM productos WHERE 1=1

-- Con filtros
SELECT * FROM productos 
WHERE categoria = ? 
AND nombre LIKE ?
AND descuento = 1
ORDER BY precio ASC

-- Categorías únicas
SELECT DISTINCT categoria FROM productos ORDER BY categoria
```

---

## 🔑 Conceptos Clave del Examen

### 1. Conexión PDO
```php
$db = getDBConnection('nombre_bd');
```

### 2. Prepared Statements (Evitar SQL Injection)
```php
$stmt = $db->prepare("SELECT * FROM tabla WHERE campo = ?");
$stmt->execute([$valor]);
$resultado = $stmt->fetch();      // Un registro
$resultados = $stmt->fetchAll();  // Múltiples registros
```

### 3. INSERT en BD
```php
$stmt = $db->prepare("INSERT INTO tabla (campo1, campo2) VALUES (?, ?)");
$stmt->execute([$valor1, $valor2]);
```

### 4. UPDATE en BD
```php
$stmt = $db->prepare("UPDATE tabla SET campo = ? WHERE id = ?");
$stmt->execute([$nuevo_valor, $id]);
```

### 5. Sesiones
```php
session_start();                  // Al inicio del archivo
$_SESSION['clave'] = $valor;      // Guardar
$valor = $_SESSION['clave'];      // Leer
isset($_SESSION['clave']);        // Verificar
unset($_SESSION['clave']);        // Eliminar
```

### 6. Validación PHP
```php
// Vacío
if (empty($_POST['campo'])) { }

// Expresión regular
if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $codigo)) { }

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { }
```

### 7. Seguridad Contraseñas
```php
// Encriptar (registro)
$hash = password_hash($password, PASSWORD_DEFAULT);

// Verificar (login)
if (password_verify($password_plano, $hash_bd)) { }
```

---

## 📊 Estructura de las Bases de Datos

### biblioteca_db
- **publicaciones:** id, codigo, titulo, anio_publicacion, tipo, prestado, autor, num_paginas, numero, mes_publicacion

### sistema_usuarios_db
- **usuarios:** id, username, email, password_hash, fecha_nacimiento, genero, publicidad, fecha_registro

### catalogo_productos_db
- **productos:** id, nombre, categoria, precio, stock, descuento

---

## ⚠️ Errores Comunes a Evitar

1. ❌ Olvidar `session_start()` al inicio
2. ❌ No usar prepared statements (vulnerabilidad SQL)
3. ❌ Guardar contraseñas en texto plano
4. ❌ No validar datos del formulario
5. ❌ Usar `$_SESSION` sin verificar si existe
6. ❌ No escapar HTML: usar `htmlspecialchars()`
7. ❌ Olvidar `exit()` después de `header('Location: ...')`

---

## 🎯 Checklist para el Examen

- [ ] XAMPP (Apache + MySQL) iniciado
- [ ] Bases de datos creadas
- [ ] `config.php` configurado
- [ ] Entender prepared statements
- [ ] Saber usar `password_hash()` y `password_verify()`
- [ ] Conocer operaciones CRUD (Create, Read, Update, Delete)
- [ ] Entender sesiones PHP
- [ ] Validar datos de formularios

---

**¡Suerte en el examen! 🚀**
