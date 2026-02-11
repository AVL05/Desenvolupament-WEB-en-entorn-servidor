# Security and Access Control - UD 5.1 DWES

## 1. Autenticación de usuarios y control de acceso

### HTTPS
- Para que un sistema de acceso sea efectivo, es necesario realizar conexiones HTTP usando un **protocolo seguro: HTTPS**
- Para usar HTTPS se necesita un **certificado válido** firmado por una entidad confiable
- De esta manera, la comunicación entre el cliente y el servidor estará completamente encriptada

### Métodos de autenticación

**Algo que el usuario tiene:**
- Certificados electrónicos de usuario (ejemplo: DNI electrónico)
- Requiere alto nivel de conocimiento técnico
- Los usuarios deben tener el hardware apropiado (lector de tarjetas)

**Algo que el usuario conoce:**
- Método más común: **usuario y contraseña**
- Más fácil de implementar
- No requiere hardware especial

---

## 2. Autenticación HTTP

### Características
- El navegador muestra una ventana para introducir credenciales
- Se usa una **lista de control de acceso** para definir usuarios y contraseñas
- Si el usuario no está autenticado, el servidor responde con código **401: "Unauthorized access"**

### En Apache
- Se utiliza **htpasswd**
- Se crea un archivo donde se almacenan usuarios y contraseñas (encriptadas)
- Se verá en detalle en DAW

### En PHP
Se puede acceder a las credenciales usando el array global `$_SERVER`:
- `$_SERVER['PHP_AUTH_USER']`
- `$_SERVER['PHP_AUTH_PW']`
- `$_SERVER['AUTH_TYPE']`

### Limitaciones
- Requiere introducir usuarios uno por uno en el archivo
- No es la mejor opción para aplicaciones grandes
- Dificulta que los usuarios se auto-registren en aplicaciones web
- **Este método NO es recomendado y no se verá en detalle**

---

## 3. Autenticación por PHP

### Mejor solución
Almacenar las credenciales en **almacenamiento externo**:
- Base de datos
- LDAP

### Almacenamiento
- Las credenciales pueden estar aisladas en su propia base de datos
- O dentro de una tabla a la que solo un usuario específico tiene permisos
- **Deben almacenarse encriptadas**

### Proceso de login
1. Durante el login, la contraseña introducida será encriptada
2. Se compara con la contraseña almacenada en la base de datos
3. Si coinciden → login válido
4. Si no coinciden → se informa del error

---

## 4. Encriptación de contraseñas

### Hash
- Una **función hash** convierte una entrada en una cadena de longitud finita
- El uso de hashes en contraseñas permite que la contraseña almacenada no sea conocida en caso de robo de datos
- **El hashing solo protege contraseñas almacenadas**
- No protege el proceso durante el registro o identificación (para eso usar HTTPS y evitar inyección de código)

### Algoritmos históricos
- **md5** y **sha1**: los más usados históricamente
- Hoy en día pueden ser rotos por fuerza bruta en relativamente poco tiempo
- **No recomendados**

### Evolución en PHP
- **PHP 4**: función `crypt()` para crear hashes de contraseñas
- **PHP 5.5+**: función `password_hash()` (soporta hashes creados con `crypt`)
- **Recomendación: usar `password_hash()`**

---

## 5. Función: crypt

### Sintaxis básica
```php
$hash = crypt($password, $salt);
```

### Conceptos clave

**Salt:**
- Pieza de datos calculada aleatoriamente
- Usada para generar el hash
- Hace los hashes más difíciles de crackear

**Cost (Coste):**
- Grado de complejidad al aplicar el algoritmo de encriptación
- Por defecto es 10
- Debe ajustarse según el hardware:
  - Muy bajo → hashes menos seguros
  - Muy alto → ralentiza el servidor

### Estructura del hash almacenado

```
$2y$10$6z7GKa9kpDN7KC3ICW1Hi.fd0/to7Y/x36WUKNP0IndHdkdR9Ae3K
│  │  │                      │
│  │  └─ Salt               └─ Contraseña hasheada
│  └─ Opciones algoritmo (ej: cost)
└─ Algoritmo
```

### Creación de hash con Blowfish

**Recomendado:** algoritmo **Blowfish**

El salt para Blowfish debe comenzar con:
- `$2a$`
- `$2x$`
- `$2y$` → **recomendado por seguridad**

Seguido de:
- Coste de dos dígitos + `$`
- Salt de 22 caracteres del conjunto: `a-z A-Z 0-9 . /`

### Ejemplo: Crear hash aleatorio

```php
$pass = 'mi_Contraseña25';
$salt = '$2y$12$'; // blowfish con complejidad 12
$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9), array('/', '.'));
for($i=0; $i < 22; $i++) 
    $salt .= $salt_chars[array_rand($salt_chars)];

// Uso de función crypt
$hash = crypt($pass, $salt);
echo $hash;

// $2y$12$dqkCw9qJGDECKaG9aWj.deYbMI59h9FQVvt.4EGCkUKaNN00yaL6W
// Esto es lo que se guarda en la base de datos
```

### Cálculo del coste óptimo para el hardware

```php
$salt = '';
$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9), array('/', '.'));
for($i=0; $i < 22; $i++)
    $salt .= $salt_chars[array_rand($salt_chars)];

$timeTarget = 0.05; // 50 milisegundos - tiempo aceptable
$coste = 8;
do {
    $coste++;
    $saltOK = '$2y$'. $coste .'$'. $salt;
    $inicio = microtime(true);
    crypt('test', $saltOK);
    $fin = microtime(true);
} while (($fin - $inicio) < $timeTarget);

echo 'Coste apropiado encontrado: ' . $coste;
```

---

## 5. Función: hash_equals

### Verificación de contraseña

La verificación se realiza con la función `hash_equals()`:
- Compara el hash almacenado con el hash de la contraseña introducida

**Problema:** Para que el hash sea el mismo, debe usarse el mismo salt, pero el salt es aleatorio

**Solución:** La función `crypt()` permite usar el mismo salt usado previamente si se pasa un hash como parámetro salt

```php
hash_equals($hash_bbdd, crypt('mi_Contraseña81', $hash_bbdd));
```

### Ejemplo completo

```php
if(hash_equals($hash, crypt('mi_Contraseña25', $hash)))
    echo 'contraseña correcta';
else
    echo 'contraseña incorrecta';
```

---

## 6. Función: password_hash (RECOMENDADA)

### Descripción
- Crea un nuevo hash de contraseña usando un **algoritmo de hashing fuerte unidireccional**
- Hay diferentes algoritmos soportados
- Incluye toda la información necesaria para verificar el hash

### Parámetros
- **Contraseña**
- **Algoritmo de encriptación**
- **Array de opciones del algoritmo**

### password_verify()
- Verifica que una contraseña coincide con un hash
- **Parámetros:** contraseña y hash
- Retorna el algoritmo, coste y salt como parte del hash
- Por tanto, **toda la información necesaria para verificar el hash está incluida**

### ✅ Funciones recomendadas
**`password_hash()` y `password_verify()` son las funciones recomendadas**

### Ejemplo básico

```php
$pass = 'mi_Contraseña81';
$hash = password_hash($pass, PASSWORD_DEFAULT);
echo $hash;

if (password_verify($pass, $hash)) {
    echo 'La contraseña es válida';
} else {
    echo 'La contraseña no es válida';
}
```

### Cálculo del coste óptimo

```php
$timeTarget = 0.05; // 50 milisegundos - tiempo aceptable
$coste = 8;
do {
    $coste++;
    $inicio = microtime(true);
    password_hash('test', PASSWORD_BCRYPT, ['cost' => $coste]);
    $fin = microtime(true);
} while (($fin - $inicio) < $timeTarget);

echo 'Coste apropiado encontrado: ' . $coste;
```

---

## Ejercicio práctico

### 1. Crear tabla en base de datos

```sql
CREATE TABLE `discografia`.`tabla_usuarios` ( 
    `id` INT NOT NULL AUTO_INCREMENT, 
    `usuario` VARCHAR(50) NOT NULL , 
    `password` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
```

### 2. Insertar usuarios
- Manualmente
- O crear un script PHP para hacerlo

### 3. Crear script login.php
- Mostrar pantalla de login
- Al introducir usuario y contraseña, comparar con el contenido de la tabla
- Si es correcto → mostrar "Login successful"
- Si no es correcto → mostrar "Login failed"

---

## Resumen de buenas prácticas

### ✅ Recomendado
- Usar **HTTPS** siempre
- Almacenar contraseñas en **base de datos** o LDAP
- Usar **`password_hash()`** y **`password_verify()`**
- Algoritmo: **PASSWORD_BCRYPT** o **PASSWORD_DEFAULT**
- Ajustar el **coste** según el hardware
- Contraseñas siempre **encriptadas** en base de datos

### ❌ No recomendado
- HTTP sin encriptación
- Algoritmos **md5** o **sha1**
- Autenticación HTTP con htpasswd (para aplicaciones grandes)
- Almacenar contraseñas en texto plano
- Coste muy bajo (inseguro) o muy alto (lento)

---

# UD 5.2 - Cookies

## 1. ¿Qué son las Cookies?

### Definición
- Las **cookies** son archivos de texto que las aplicaciones guardan en el cliente
- Se almacenan en el entorno del navegador web
- Están asociadas con un sitio web específico

### Uso típico
Almacenamiento de preferencias del usuario:
- Idioma
- Colores
- Tamaño de letra
- Otras preferencias personales

### Características
- Normalmente se guarda información **no muy sensible**
- Permite descargar algunas tareas al cliente
- Reduce la carga del servidor

---

## 2. Crear cookies en PHP: setcookie()

### Sintaxis

```php path=null start=null
setcookie(name, value, expire or [options], path, domain, secure, httponly);
```

### Parámetros
- **name**: único parámetro obligatorio
- **value**: valor de la cookie
- **expire**: tiempo de expiración
- **path**: ruta donde es válida
- **domain**: dominio donde es válida
- **secure**: solo HTTPS
- **httponly**: solo accesible por HTTP

### Ejemplo básico

```php path=null start=null
// Cookie que dura 1 hora
setcookie('nombre', 'valor', time()+3600);
```

### ⚠️ Importante sobre disponibilidad
- Las cookies **NO están disponibles** la primera vez que se accede a la página
- Se pueden leer desde la **siguiente petición** usando el array global `$_COOKIE`

---

## 3. Ejemplo completo de uso

```php path=null start=null
<!DOCTYPE html>
<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 día
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html>
```

---

## 4. Parámetro expire (expiración)

### Formato
- Se usa **tiempo UNIX** en segundos desde 1-1-1970 00:00:00

### Comportamiento
- **Vacío o 0**: la cookie expira al finalizar la sesión (al cerrar el navegador)
- **time() + segundos**: expira después de X segundos

### Modificar una cookie
Para modificar una cookie, se debe hacer un `setcookie` con los nuevos valores

### Eliminar una cookie
La fecha de expiración debe haber pasado:

```php path=null start=null
setcookie('nombre', 'valor', time()-3600);
setcookie('nombre', 'valor', 1); // recomendado
```

---

## 5. Opciones de seguridad

### Opciones importantes: secure y httponly

```php path=null start=null
<?php
$arr_cookie_options = array (
    'secure' => true,     // Solo se establece si existe conexión HTTPS
    'httponly' => true,   // Solo accesible mediante protocolo HTTP
    'samesite' => 'Lax'   // None || Lax || Strict
);
setcookie('MiCookie', 'ValorCookie', $arr_cookie_options);
?>
```

### Descripción de opciones
- **secure**: la cookie solo se enviará en conexiones HTTPS
- **httponly**: la cookie no será accesible mediante JavaScript (previene XSS)
- **samesite**: controla cuándo se envía la cookie en peticiones cross-site

### Consultar cookies
Para consultar las cookies recibidas por el servidor:

```php path=null start=null
$_COOKIE['nombre_cookie']
```

---

## 6. Arrays en cookies

### Crear array dentro de una cookie

```php path=null start=null
setcookie("cookie[tres]", "valor tres");
setcookie("cookie[dos]", "valor dos");
setcookie("cookie[uno]", "valor uno");

// Imprimir valores
if (isset($_COOKIE['cookie'])) {
    foreach ($_COOKIE['cookie'] as $nombre => $valor) {
        $name = htmlspecialchars($nombre);
        $value = htmlspecialchars($valor);
        echo '$nombre: '. $valor .'<br>';
    }
}
```

---

## 7. Inspeccionar cookies

### En el navegador (Firefox)
**Para la aplicación actual:**
1. Click derecho → Inspeccionar
2. Pestaña **Storage** (Almacenamiento)
3. Seleccionar **Cookies**

### Inspeccionar todas las cookies en Firefox

1. Abrir menú de aplicación
2. En "Ayuda" → "Más información para solucionar problemas"
3. Abrir "Carpeta del perfil"
4. Abrir archivo `cookies.sqlite` (con DB Browser for SQLite)
5. Abrir pestaña "Datasheet"

### Información visible
En las herramientas de desarrollo se puede ver:
- **Nombre** de la cookie
- **Valor** de la cookie
- **Dominio**
- **Path** (ruta)
- **Expires / Max-Age** (expiración)

---

## 8. Buenas prácticas para el uso de cookies

### ❌ Preguntas de reflexión
- ¿Es buena práctica guardar contraseñas en cookies? **NO**
- ¿Y números de tarjeta de crédito? **NO**

### ✅ Recomendaciones de seguridad

**Evitar datos sensibles:**
- **Evitar guardar datos sensibles** tanto como sea posible
- Si es necesario, **encriptarlos** y usar **HTTPS**

**Consentimiento:**
- Antes de guardar una cookie, se debe **informar al usuario y obtener su consentimiento**

**Expiración:**
- Si la cookie solo se usará durante la sesión, hacerla expirar al cerrar el navegador (expire = 0)

**Opciones de seguridad:**
- Usar `secure => true` para conexiones HTTPS
- Usar `httponly => true` para prevenir acceso desde JavaScript
- Configurar `samesite` apropiadamente

---

## Ejercicio práctico: Login con cookies

Modificar la pantalla de login del ejercicio anterior para que:

### Requisitos

1. **Guardar usuario autenticado:**
   - Cuando un usuario se autentique correctamente, guardar su nombre en una cookie

2. **Verificar cookie al acceder:**
   - Al acceder a la pantalla de login, verificar si existe una cookie válida
   - Si existe un usuario previamente autenticado:
     - Mostrar mensaje: "¿Quieres iniciar sesión como $NOMBRE?"
     - Opciones: **Sí** o **No**

3. **Flujo según selección:**
   - **Si selecciona "Sí"**: mostrar "Acceso exitoso"
   - **Si selecciona "No"**: 
     - Eliminar la cookie
     - Mostrar formulario de login nuevamente

---

## Resumen de conceptos clave

### Cookies
- Archivos de texto guardados en el cliente
- Asociadas a un sitio web específico
- Útiles para preferencias de usuario

### Funciones principales
- `setcookie()`: crear/modificar cookies
- `$_COOKIE[]`: leer cookies

### Seguridad
- No guardar datos sensibles sin encriptar
- Usar HTTPS (`secure => true`)
- Usar `httponly => true`
- Obtener consentimiento del usuario
- Configurar expiración apropiada

---

# UD 5.3 - Sessions (Sesiones)

## 1. Introducción a las sesiones

### Problema de HTTP
- El protocolo **HTTP** no mantiene información sobre el estado de cada petición
- Las peticiones se tratan como **conexiones independientes**

### Soluciones a nivel de aplicación

**Dos técnicas principales:**
- **Navegador web (cookies)** - almacenamiento en el cliente
- **Servidor web (sessions)** - almacenamiento en el servidor

**En aplicaciones web modernas:** se suelen usar ambas técnicas juntas

---

## 2. Limitaciones de las cookies

### Desventajas del uso de cookies

Aunque muy útiles, las cookies tienen inconvenientes:

- **Número limitado** de cookies que el navegador puede almacenar
- **Tamaño máximo** de cada cookie limitado
- **Posible robo de identidad** (identity theft)
- Las cookies se **almacenan en el cliente** (menos seguro)
- **Tráfico generado** al enviar cookies en cada petición

### Solución: sesiones en el servidor

Para solucionar estos problemas, se usan **sesiones del lado del servidor**

---

## 3. Configuración de sesiones en PHP

### Soporte nativo
- **PHP incorpora soporte activo de sesiones por defecto**
- Se puede consultar la configuración activa usando `phpinfo()`

### Modificar configuración

**Opción 1: Archivo php.ini**
- Modificar el archivo `php.ini`
- Reiniciar el servidor web
- Documentación: http://php.net/manual/en/session.security.ini.php

**Opción 2: En tiempo de ejecución**
- Usar funciones correspondientes si no tienes acceso a `php.ini`
- Documentación: http://php.net/manual/es/session.configuration.php

### Parámetros configurables

**Por seguridad o configuración, se pueden cambiar:**
- **Nombre de sesión** → por defecto: `PHPSESSID`
- **Longitud del SID** (session ID)
- **Tiempo de vida de la cookie de sesión**
- **Expiración de caché de sesión**
- **httponly** (prevenir comportamiento no deseado con JavaScript)

---

## 4. Session ID (SID)

### Concepto fundamental
- Cada navegador de usuario tiene su **propia sesión**
- Las sesiones se distinguen por el **identificador de sesión (SID)**
- La información del usuario se almacena en el servidor asociada al SID
- El SID está disponible en el cliente/navegador del usuario

### Dos formas de usar el SID

**1. Propagar el SID en la URL**
```
http://localhost/index.php?PHPSESSID=4vjekic8fl7sqr0np45nfdrl6p
```

**2. Usar una cookie (método por defecto)**
- Automático y transparente

**Ambos métodos están automatizados con PHP**

---

## 5. Propagación del SID en la URL

### Funcionamiento

**Cuando no se usan cookies:**
- Se crea una variable global llamada `SID` en cada sesión
- Esta variable debe añadirse a todas las URLs de la aplicación

### Implementación

**Manual:**
- Programarlo en el código manualmente

**Automática:**
- Usar la opción PHP: `session.use_trans_sid`

### ⚠️ Riesgos de seguridad

**La administración de sesiones basada en URL tiene riesgos adicionales:**
- Los usuarios pueden enviar una URL con un ID de sesión activo por email
- Los usuarios pueden guardar una URL con ID de sesión en marcadores
- Accederán siempre con el mismo ID de sesión
- **Compartir una URL = compartir el SID**

**Desde PHP 7.1.0:**
- Una ruta URL completa (ej: https://php.net/) es manejada por la característica trans sid
- Versiones anteriores solo manejaban rutas relativas

---

## 6. SID mediante cookies

### Funcionamiento

**Cuando se usan sesiones mediante cookies:**
- El servidor web guarda automáticamente una cookie en el cliente con el SID
- Las cookies se envían automáticamente en cada petición del cliente
- **Es transparente para el usuario y el programador**

### Ventajas sobre propagación en URL

**Ambos métodos tienen desventajas, pero la propagación en URL tiene más:**
- ❌ No puede mantener SID entre diferentes sesiones
- ❌ Compartir una URL comparte el SID (riesgo de seguridad)

### Configuración por defecto en Apache

**Apache usa cookies por defecto:**
- Se establece una cookie llamada `PHPSESSID`
- El valor es una cadena de identificación única

---

## 7. Inicio de sesión: session_start()

### Dos formas de iniciar sesiones

**1. Automáticamente:**
- Configurar parámetro `session.auto_start` en `php.ini`
- Por defecto está en `Off` (deshabilitado)

**2. Manualmente:**
- Usar la función `session_start()`

### Variable superglobal $_SESSION

**Mientras una sesión está abierta:**
- Se puede usar `$_SESSION` para almacenar información
- O para recuperar información previamente almacenada

### ⚠️ Importante: ubicación de session_start()

**Dado que las sesiones requieren el uso de cookies:**
- Las cookies se envían en las **cabeceras HTTP**
- La llamada debe ocurrir **antes de mostrar información en pantalla**
- Debe estar **antes de la línea `<!doctype html>`**

**La llamada `session_start()` debe hacerse:**
- En **todos los archivos** de la aplicación web que necesiten información de sesión

---

## 8. Fin de sesión

### Gestión automática
- **Apache gestiona automáticamente** la creación y destrucción de sesiones
- Se puede cambiar la configuración usando `php.ini`

### Cerrar sesión manualmente

**Puede ser necesario cerrar sesión en cierto momento:**
- Por ejemplo: cuando el usuario decide cerrar sesión (logout)
- Si las sesiones almacenan información de login

### Funciones para cerrar sesión

#### session_unset()
- **Elimina todas las variables de sesión creadas**
- **Mantiene el identificador de sesión** (SID)

#### session_destroy()
- **Elimina completamente la información de sesión**
- Destruye toda la sesión

---

## 9. Uso de variables de sesión

### Ejemplo 1: Contador de visitas

```php path=null start=null
<?php
// Se inicia la sesión o se recupera la sesión existente previa
session_start();

// Comprueba si la variable ya existe
if (isset($_SESSION['visitas']))
    $_SESSION['visitas']++;
else
    $_SESSION['visitas'] = 0;
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Ejemplo</title>
</head>
<body>
    Has visitado esta página <?=$_SESSION['visitas']?> veces
</body>
</html>
```

### Ejemplo 2: Array de visitas con timestamp

```php path=null start=null
<?php
// Se inicia la sesión o se recupera la sesión existente previa
session_start();

// En cada visita se añade un valor al array "visitas"
$_SESSION['visitas'][] = mktime();
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Ejemplo</title>
</head>
<body>
    Has visitado esta página <?=count($_SESSION['visitas'])?> veces
</body>
</html>
```

### Ejemplo 3: Cambiar configuración con ini_set

```php path=null start=null
<?php
// Cambiar configuración por defecto (php.ini)
ini_set('session.name', 'miSesion');
ini_set('session.cookie_httponly', 1);

// Se inicia la sesión o se recupera la sesión existente previa
session_start();

// ... resto del código
?>
```

---

## 10. Ejercicio práctico: Modificar aplicación discografía

### Requisitos

Modificar la aplicación Discografía para que tenga:

**1. Página de registro**
- Permitir a nuevos usuarios registrarse

**2. Página de login y logout**
- Login para autenticarse
- Opción de logout en el header

**3. Control de acceso**
- **Ninguna página puede accederse sin autenticación previa**
- Se recomienda el uso de **sesiones** para esto

**4. Historial de búsquedas**
- Las últimas búsquedas se guardan
- Se muestran en pantalla en la página de búsqueda
- Se recomienda el uso de **cookies** para esto

---

## Resumen de conceptos clave: Sessions

### Diferencias entre Cookies y Sessions

| Aspecto | Cookies | Sessions |
|---------|---------|----------|
| **Almacenamiento** | Cliente (navegador) | Servidor |
| **Seguridad** | Menos seguro | Más seguro |
| **Tamaño** | Limitado (~4KB) | Mayor capacidad |
| **Persistencia** | Puede ser permanente | Temporal (sesión) |
| **Velocidad** | Más rápido (local) | Requiere servidor |

### Funciones principales de sesión

- `session_start()` - iniciar o recuperar sesión
- `$_SESSION[]` - almacenar/recuperar datos de sesión
- `session_unset()` - eliminar variables de sesión
- `session_destroy()` - destruir sesión completamente
- `ini_set()` - cambiar configuración de sesión

### Buenas prácticas

**✅ Recomendado:**
- Usar sesiones para información sensible (datos de login)
- Llamar `session_start()` antes de cualquier salida HTML
- Configurar `httponly` para prevenir acceso desde JavaScript
- Usar cookies para preferencias del usuario
- Implementar logout para cerrar sesión correctamente

**❌ Evitar:**
- Propagar SID en la URL (riesgo de compartir sesión)
- Almacenar datos sensibles en cookies sin encriptar
- No cerrar sesión al hacer logout
