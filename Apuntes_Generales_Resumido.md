# 📚 Programación Web en Entorno Servidor - Resumen

---

## UD 1 - Introducción a la Programación Web

### Arquitectura Cliente-Servidor
El navegador solicita un archivo al servidor web, que lo busca y envía al cliente. Si es necesario, el cliente descarga recursos complementarios (CSS, JavaScript, imágenes).

### Páginas Estáticas vs Dinámicas

**Estáticas (.html):**
- Contenido fijo almacenado en el servidor
- No varían a menos que se modifiquen manualmente
- Mejor posicionamiento SEO

**Dinámicas (.php, .asp, .cgi):**
- Contenido generado según diferentes factores (hora, usuario, acciones previas)
- Más flexibles pero más complejas
- Pueden acceder a bases de datos

### Aplicaciones Web
Son programas que se ejecutan en Internet aprovechando el poder de las páginas dinámicas. Ejemplos: Gmail, Suites ofimáticas online.

**Ventajas:** Solo se instalan en el servidor, fácil mantenimiento, accesible desde cualquier lugar.

### Front-end vs Back-end
- **Front-end:** Interfaz visible en el navegador (HTML, CSS, JavaScript)
- **Back-end:** Panel de administración y gestión (no visible para usuarios finales)

### Plataformas Disponibles
- **AMP:** Apache, MySQL, PHP/Perl/Python (Open Source)
- **JavaEE:** Java, JSP, servlets (Oracle)
- **.Net:** Microsoft, Visual Basic, C#, IIS
- **Python:** Flask, Django (Open Source)

---

## UD 2 - Introducción a PHP

### Integración PHP en HTML
PHP se integra dentro de HTML usando tags `<?php ... ?>`. El servidor ejecuta el código PHP y envía solo HTML al cliente.

### Variables y Tipos de Datos
- Comienzan con `$`, diferencian mayúsculas/minúsculas
- **Tipado débil:** Las variables pueden cambiar de tipo

**Tipos básicos:**
- `boolean` (TRUE/FALSE)
- `integer` (números enteros)
- `float` (números decimales)
- `string` (cadenas de texto)
- `null` (sin valor)

### Operadores Principales
- **Asignación:** `=`
- **Aritméticos:** `+`, `-`, `*`, `/`, `%`, `++`, `--`
- **Comparación:** `>`, `<`, `>=`, `<=`, `==`, `===`, `!=`, `!==`
- **Lógicos:** `&&`, `||`, `!`

### Variables Superglobales
Accesibles en cualquier ámbito:
- `$_GET` - parámetros de URL
- `$_POST` - datos del formulario
- `$_SERVER` - información del servidor
- `$_COOKIE` - cookies del cliente
- `$_SESSION` - variables de sesión
- `$_FILES` - archivos subidos

### Funciones Básicas
```php
strlen()              // Longitud de string
strtoupper()          // Convertir a mayúsculas
strtolower()          // Convertir a minúsculas
date()                // Formato de fecha
time()                // Timestamp actual
isset()               // Verificar si existe variable
empty()               // Verificar si está vacío
is_numeric()          // Verificar si es numérico
is_string()           // Verificar si es string
define()              // Definir constante
```

### Cadenas de Texto
- **Comillas dobles:** Permiten interpolación de variables
- **Comillas simples:** No interpolan variables
- **Concatenación:** Operador `.`

### Echo y Print
Envían salida al cliente. No son funciones, no necesitan paréntesis.

### Inclusión de Archivos
```php
include()        // Incluir archivo (warning si falla)
require()        // Incluir archivo (error fatal si falla)
include_once()   // Incluir solo una vez
require_once()   // Require solo una vez
```

### Constantes de Clase
```php
const NOMBRE = 'valor';  // Siempre públicas
```

### Operador Ternario
```php
(condicion) ? valor_verdadero : valor_falso
```

Útil para asignaciones simples y valores por defecto.

---

## UD 3 - Estructuras de Control

### If/Else
```php
if ($condicion) {
    // código
} else if ($otra_condicion) {
    // código
} else {
    // código
}
```

### Switch
```php
switch ($variable) {
    case valor1:
        // código
        break;
    default:
        // código
}
```

### Bucles
- **while:** Ejecuta mientras la condición sea verdadera
- **do/while:** Ejecuta al menos una vez
- **for:** Bucle con contador
- **foreach:** Recorre arrays

### Funciones
```php
function nombre_funcion($param1, $param2 = valor_defecto) {
    return resultado;
}
```

**Características:**
- Parámetros con valores por defecto van al final
- No es necesario definirlas antes de usarlas
- Paso por valor (defecto) o por referencia (`&`)

### Arrays
- **Numéricos:** Índices son números (0, 1, 2...)
- **Asociativos:** Índices son strings (claves)
- **Multidimensionales:** Arrays dentro de arrays

**Recorrido:**
```php
foreach ($array as $clave => $valor) {
    // procesar
}
```

**Funciones útiles:**
- `count()` - número de elementos
- `array_values()` - reindexar array
- `unset()` - eliminar elemento

---

## UD 4 - Formularios Web

### Métodos GET vs POST

| Característica | GET | POST |
|---|---|---|
| **Ubicación** | URL (visible) | Cuerpo (oculto) |
| **Tamaño** | Limitado (~2KB) | Sin límite práctico |
| **Uso** | Búsquedas, filtros | Datos sensibles, ficheros |
| **Seguridad** | Menos seguro | Más seguro |

### Validación de Datos
Debe hacerse en 3 capas:
1. **Navegador:** Tipos input, atributo `required`
2. **Cliente:** JavaScript
3. **Servidor:** PHP con `isset()`, `empty()`, `is_numeric()`

### Funciones de Validación
```php
isset()                          // Variable definida y no null
empty()                          // Variable vacía
is_numeric()                     // Es número
filter_var($email, FILTER_VALIDATE_EMAIL)  // Email válido
preg_match($patron, $cadena)     // Expresión regular
```

### Almacenar Valores en Formulario
```php
<input type="text" name="campo" 
    value="<?php echo isset($_POST['campo']) ? htmlspecialchars($_POST['campo']) : ''; ?>">
```

Usar `htmlspecialchars()` para prevenir XSS.

---

## UD 5 - Manejo de Excepciones

### Try-Catch
```php
try {
    // código que puede fallar
    if (!$condicion_ok)
        throw new Exception('Mensaje de error');
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### Métodos de Exception
```php
getMessage()    // Mensaje de excepción
getCode()       // Código de error
getFile()       // Archivo donde ocurrió
getLine()       // Línea donde ocurrió
```

### Excepciones Personalizadas
```php
class MiException extends Exception {
    public function errorMessage() {
        return "Error personalizado: " . $this->getMessage();
    }
}
```

### Manejo de Warnings
```php
set_error_handler("funcionManejadora");
// ... código
restore_error_handler();
```

### Logging de Errores
```php
error_log("Mensaje de error", 3, "ruta/archivo.log");
```

---

## UD 6 - Programación Orientada a Objetos

### Clases y Objetos
```php
class MiClase {
    public $atributo;
    private $privado;
    protected $protegido;
    
    public function __construct() {
        // Se ejecuta al crear el objeto
    }
    
    public function metodo() {
        return $this->atributo;
    }
}

$objeto = new MiClase();
```

### Niveles de Acceso
- **public:** Acceso desde cualquier lugar
- **private:** Solo dentro de la clase
- **protected:** Dentro de la clase y subclases

### Métodos Mágicos
```php
__construct()      // Constructor
__destruct()       // Destructor
__toString()       // Convertir a string
__get()            // Acceso a propiedad no existente
__set()            // Asignar a propiedad no existente
```

### Atributos y Métodos Estáticos
```php
public static $contador = 0;

public static function metodoEstatico() {
    return self::$contador;
}

// Acceso
Clase::$contador;
Clase::metodoEstatico();
```

### Herencia
```php
class Subclase extends Superclase {
    public function __construct() {
        parent::__construct();
    }
}
```

### Clases Abstractas
```php
abstract class ClaseAbstracta {
    abstract public function metodoObligan();
}
```

- No se pueden instanciar
- Sus métodos abstractos deben implementarse en subclases

### Interfaces
```php
interface MiInterfaz {
    public function metodo1();
}

class MiClase implements MiInterfaz {
    public function metodo1() {
        // Implementación obligatoria
    }
}
```

### Traits
```php
trait MiTrait {
    public function metodo() {
        return "Desde trait";
    }
}

class MiClase {
    use MiTrait;
}
```

Permiten reutilizar código sin herencia múltiple.

---

## UD 7 - Acceso a Bases de Datos

### MySQLi (MySQL Improved)

**Conexión:**
```php
$conexion = new mysqli('localhost', 'usuario', 'pass', 'bd');

if ($conexion->connect_errno) {
    echo 'Error: ' . $conexion->connect_error;
    exit();
}
```

**Consultas sin retorno (INSERT, UPDATE, DELETE):**
```php
$resultado = $conexion->query('DELETE FROM tabla WHERE id=1');
echo $conexion->affected_rows . ' registros afectados';
```

**Consultas con retorno (SELECT):**
```php
$resultado = $conexion->query('SELECT * FROM tabla');

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo $fila['columna'];
    }
}
```

**Métodos de obtención:**
- `fetch_assoc()` - array asociativo
- `fetch_row()` - array numérico
- `fetch_object()` - objeto
- `fetch_all()` - todos los registros

**Consultas Preparadas:**
```php
$stmt = $conexion->stmt_init();
$stmt->prepare('INSERT INTO tabla (col1, col2) VALUES (?, ?)');
$stmt->bind_param('ss', $var1, $var2);
$stmt->execute();
```

**Transacciones:**
```php
$conexion->autocommit(false);

try {
    $conexion->query($sql1);
    $conexion->query($sql2);
    $conexion->commit();
} catch (Exception $e) {
    $conexion->rollback();
}
```

### PDO (PHP Data Objects)

**Conexión:**
```php
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$pdo = new PDO('mysql:host=localhost;dbname=bd', 'usuario', 'pass', $opciones);
```

**Consultas sin retorno:**
```php
$pdo->exec('DELETE FROM tabla WHERE id=1');
```

**Consultas con retorno:**
```php
$resultado = $pdo->query('SELECT * FROM tabla');
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    echo $fila['columna'];
}
```

**Consultas Preparadas:**
```php
$stmt = $pdo->prepare('SELECT * FROM tabla WHERE id=?');
$stmt->bindParam(1, $id);
$stmt->execute();
```

**Transacciones:**
```php
$pdo->beginTransaction();
try {
    $pdo->exec($sql1);
    $pdo->exec($sql2);
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollback();
}
```

### Ventajas PDO vs MySQLi
- PDO soporta múltiples DBMS
- MySQLi tiene interfaz orientada a objetos y mejor rendimiento en MySQL
- PDO es más fácil para cambiar de DBMS

---

## UD 8 - Seguridad

### Autenticación
- **HTTPS:** Protocolo seguro (certificado válido requerido)
- **Almacenamiento:** BD o LDAP, nunca en texto plano
- **Encriptación:** Usar `password_hash()` y `password_verify()`

### Funciones de Encriptación

**password_hash() - Recomendada:**
```php
$hash = password_hash('contraseña', PASSWORD_DEFAULT);

if (password_verify('contraseña', $hash)) {
    echo 'Contraseña correcta';
}
```

**crypt() - Alternativa:**
```php
$salt = '$2y$12$' . generar_salt_aleatorio();
$hash = crypt('contraseña', $salt);

if (hash_equals($hash, crypt('contraseña', $hash))) {
    echo 'Contraseña correcta';
}
```

### Medidas de Seguridad
- ✅ Usar HTTPS siempre
- ✅ Encriptar contraseñas en BD
- ✅ Validar entrada del usuario
- ✅ Usar consultas preparadas (prevenir inyección SQL)
- ✅ Sanitizar salida con `htmlspecialchars()`
- ❌ No usar md5, sha1 (inseguros)
- ❌ No almacenar en texto plano

---

## UD 9 - Cookies

### Crear Cookies
```php
setcookie('nombre', 'valor', time() + 3600);  // Expira en 1 hora
```

**Con opciones de seguridad:**
```php
setcookie('nombre', 'valor', [
    'expires' => time() + 3600,
    'path' => '/',
    'secure' => true,      // Solo HTTPS
    'httponly' => true,    // No accesible desde JavaScript
    'samesite' => 'Lax'    // Prevenir ataques cross-site
]);
```

### Leer Cookies
```php
echo $_COOKIE['nombre'];
```

### Eliminar Cookies
```php
setcookie('nombre', '', time() - 3600);  // Expira en el pasado
```

### Características
- Se almacenan en el cliente
- Útiles para preferencias de usuario
- No guardar datos sensibles
- Máximo ~4KB por cookie

---

## UD 10 - Sesiones

### Iniciar Sesión
```php
session_start();  // Debe ir antes de cualquier salida HTML
```

### Almacenar Datos
```php
$_SESSION['usuario'] = 'Alex';
$_SESSION['carrito'] = ['item1', 'item2'];
```

### Leer Datos
```php
echo $_SESSION['usuario'];
```

### Cerrar Sesión
```php
session_unset();      // Elimina todas las variables
session_destroy();    // Destruye la sesión
```

### Características
- Almacenamiento en servidor (más seguro)
- Session ID (SID) único por usuario
- Se mantiene mediante cookie (PHPSESSID)
- Temporal (expira al cerrar navegador o timeout)

### Session ID
- **En URL:** `?PHPSESSID=abc123` (riesgo de seguridad)
- **En Cookie:** Automático y transparente (recomendado)

---

## UD 11 - Subida de Archivos

### Formulario
```html
<form action="procesar.php" method="post" enctype="multipart/form-data">
    <input type="file" name="archivo">
    <input type="submit" value="Enviar">
</form>
```

Atributo obligatorio: `enctype="multipart/form-data"`

### Acceso a Archivos
```php
echo $_FILES['archivo']['name'];        // Nombre
echo $_FILES['archivo']['type'];        // Tipo MIME
echo $_FILES['archivo']['size'];        // Tamaño
echo $_FILES['archivo']['tmp_name'];    // Ruta temporal
echo $_FILES['archivo']['error'];       // Código de error
```

### Validación
```php
// Verificar que es una subida real
if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
    // Validar tipo MIME
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipo = $finfo->file($_FILES['archivo']['tmp_name']);
    
    if ($tipo === 'image/jpeg') {
        move_uploaded_file(
            $_FILES['archivo']['tmp_name'],
            'uploads/' . basename($_FILES['archivo']['name'])
        );
    }
}
```

### Seguridad
- Validar tipo MIME con `finfo`
- Verificar con `is_uploaded_file()`
- Renombrar archivos para evitar conflictos
- Almacenar fuera del directorio web si es posible
- Limitar tamaño máximo
- Manejar errores: `UPLOAD_ERR_OK`, `UPLOAD_ERR_NO_FILE`, etc.

### Procesamiento de Imágenes
```php
$imagen = imagecreatefromjpeg($_FILES['archivo']['tmp_name']);
imagescale($imagen, 360, 480);  // Redimensionar
imagejpeg($imagen, 'uploads/foto.jpg');  // Guardar
imagedestroy($imagen);  // Liberar memoria
```

---

## 📌 Cheatsheet Rápido

### Conexión a BD (MySQLi)
```php
$db = new mysqli('localhost', 'user', 'pass', 'dbname');
```

### Conexión a BD (PDO)
```php
$db = new PDO('mysql:host=localhost;dbname=dbname', 'user', 'pass');
```

### Consulta SELECT
```php
// MySQLi
$result = $db->query('SELECT * FROM tabla');
while ($row = $result->fetch_assoc()) { }

// PDO
$result = $db->query('SELECT * FROM tabla');
while ($row = $result->fetch(PDO::FETCH_ASSOC)) { }
```

### Iniciar Sesión
```php
session_start();
$_SESSION['dato'] = 'valor';
```

### Crear Cookie
```php
setcookie('nombre', 'valor', time() + 3600);
```

### Encriptar Contraseña
```php
$hash = password_hash('password', PASSWORD_DEFAULT);
if (password_verify('password', $hash)) { }
```

### Validar Email
```php
if (filter_var($email, FILTER_VALIDATE_EMAIL)) { }
```

### Sanitizar Salida
```php
echo htmlspecialchars($variable);
```

---

**Última actualización:** 13 de noviembre de 2025
