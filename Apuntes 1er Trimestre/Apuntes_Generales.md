# UD 1 - Introducción a la Programación Web

**DWES** - Desarrollo Web en Entorno Servidor

---

## 1. Características de la Programación Web

### ¿Qué ocurre cuando introduces una URL en el navegador?

**Arquitectura Cliente-Servidor:**
- **Cliente web** → Internet → **Servidor web** → Programa servidor → Repositorio de páginas (.html, .php, .jsp, .asp)

**Proceso paso a paso:**

1. Se solicita el archivo html al servidor (.html, .php, .asp, .cgi...)
2. El servidor busca el archivo en el directorio indicado por la URL
3. Si encuentra el archivo, el servidor lo envía al cliente
4. El cliente analiza el archivo recibido
5. Si es necesario, se solicitarán archivos complementarios (css, javascript, imágenes...)
6. El archivo html se muestra en la ventana del navegador

---

### Páginas Web Estáticas

**Características:**
- Almacenadas en su forma final
- Solo varían si el desarrollador altera el contenido
- Su utilidad se basa en mostrar información específica
- Consumen menos recursos
- Extensión de archivo: `.html`

**¿Son útiles hoy en día?** Sí, pero limitadas.

---

### Páginas Web Dinámicas

**Características:**
- El contenido cambia según diferentes factores:
  - Día y hora de acceso
  - Si se accede con usuario
  - Acciones realizadas previamente

- El cliente recibe un archivo cuyo contenido es HTML (igual que en páginas estáticas), pero el contenido NO está dentro de un archivo inalterable

- La extensión del archivo NO es .html, sino la del lenguaje de programación web dinámico que entiende el servidor: `.php`, `.asp`, `.cgi`...

**Ejemplos comunes:**
- Gmail
- Blogs
- Marca
- Twitter
- Sitios web en general

---

### Pasos en el servidor al recibir una petición de página dinámica

El código se analiza línea por línea:
- Si es código HTML → permanece igual
- Si es código del lenguaje de programación del servidor → se ejecuta

La ejecución del lenguaje de programación del servidor típicamente incluye:
- Acceso a base de datos
- Acceso a otros archivos

La ejecución del lenguaje de programación del servidor puede o no crear código HTML. Si se crea código HTML, se agregará en ese punto del documento.

Una vez analizadas todas las líneas de código, el documento generado se envía al cliente. Este documento **solo contendrá código HTML**.

---

### Páginas Estáticas vs Dinámicas: Ventajas y Desventajas

**Estáticas:**
- ✅ No es necesario saber programar
- ✅ Su contenido nunca varía, los enlaces siempre muestran lo mismo
- ✅ Mejor posicionamiento SEO al tener siempre el mismo contenido
- ❌ Actualización manual por el desarrollador web

**Dinámicas:**
- ✅ Más flexibilidad
- ❌ Mayor dificultad en desarrollo
- ❌ Mayor consumo de recursos
- ❌ Hay que tener cuidado con el posicionamiento SEO
- ❌ Menor velocidad
- ❌ Mayor coste de mantenimiento de recursos

---

### Páginas Mixtas (Estáticas + Dinámicas)

Hoy en día, la mayoría de páginas web contienen partes estáticas y partes dinámicas. Por ejemplo:
- Contacto
- Términos y Condiciones
- Ubicación

Esto ocurre porque no todo se almacena en una base de datos ni necesita procesarse para mostrar contenido.

**El poder está en la unión.**

---

### Aplicaciones Web

Gracias al aumento de la velocidad de Internet y el incremento del rendimiento del equipo actual, desde hace años muchas empresas han aprovechado el poder de las páginas web dinámicas para desarrollar aplicaciones que se ejecutan sobre Internet.

**Ejemplos:**
- Gmail
- Suites ofimáticas
- ...

#### Ventajas:
- Solo se "instalan" en un ordenador: el servidor
- Debido a lo anterior, es fácil gestionarlas (backups, actualizaciones...)
- No se necesita HW especial para los clientes, solo un cliente web
- Si tenemos conexión a Internet, se pueden usar desde cualquier lugar

#### Desventajas:
- La interfaz de la aplicación está limitada a la interfaz del cliente web
- Depende de una conexión a Internet para usarlas
- La información debe transmitirse entre servidor y cliente, lo que hace imposible crear aplicaciones web cuando los datos a procesar son muy grandes, por ejemplo: edición de vídeo

---

### Front-end vs Back-end

**Front-end:** Lo que ve el usuario final (interfaz visible en el navegador)

**Back-end:** Panel de administración y gestión de contenidos (no visible para usuarios finales)

---

## 2. Tecnologías para Programación Web - Servidor

Para desarrollar páginas web dinámicas y aplicaciones web necesitas:
- Servidor web
- Lenguaje de programación
- Módulo responsable de ejecutar el código
- Base de datos

---

### Arquitectura de Diseño

También es necesario decidir la arquitectura de diseño, que no es más que la forma en que se organizará el código.

Generalmente se usan arquitecturas por **capas** o **niveles**. Por ejemplo, usando una arquitectura de 3 capas:

- **Capa de cliente:** se define la interfaz de la aplicación
- **Capa de funcionalidad:** se incluirán todos los procedimientos para generar las páginas
- **Capa de acceso a datos:** será responsable de almacenar y recuperar datos

---

### Arquitecturas y Plataformas

**JavaEE** → Java. Sun & Oracle. Existen muchas librerías. JSP y servlets.

**AMP** → Apache MySQL PHP/Perl/Python. Open Source. PostgreSQL, MariaDB

**CGI/Perl** → Perl + CGI (estándar para ejecutar programas en el servidor web de cualquier lenguaje). Lento.

**.Net** → Microsoft. .Net genera páginas web dinámicas. Visual Basic, C#. Microsoft IIS. Incluye IDE.

**Python** → Open Source. Tiene frameworks como Flask o Django

---

### ¿Qué arquitectura/plataforma elegir?

Considera:
- ¿Qué tan grande será el proyecto?
- ¿Qué lenguajes de programación conozco? ¿Vale la pena aprender uno nuevo?
- Herramientas públicas o propietarias
- Coste de soluciones comerciales
- Número de personas en el equipo de desarrollo
- ¿Ya tengo un servidor web o gestor de base de datos o puedo elegirlos?

---

## 3. Lenguajes de Programación

La diferencia entre los lenguajes de programación web del lado del servidor radica en cómo se ejecutan estos lenguajes en el servidor.

### Tipos de ejecución:

**Scripting:** se almacenan en un archivo de texto con instrucciones. El servidor usará un intérprete que procesa las instrucciones generando una página web.
- PHP, Perl, Python, ASP

**Código nativo:** el código se compila y traduce a lenguaje máquina dependiente del procesador (binario). Se ejecuta directamente.
- CGI → C

**Código intermedio:** compilado en código intermedio independiente del procesador. Se requiere interpretar ese código. Independiente de la plataforma.
- Java, ASP.Net

---

### IDE - Integrated Development Environment

Existen muchos IDEs para desarrollar páginas web, aunque NO son necesarios y un simple editor de texto es suficiente.

**Características de un IDE:** 
- Resaltado y autocompletado de código
- Comprobación de errores al editar
- Ejecución y depuración
- Gestión de versiones

Existen editores de texto preparados para programar en cualquier lenguaje de programación, con características adicionales que tienen muchas de las funciones de los IDEs.

**Ejemplos:**
Visual Studio, Eclipse, NetBeans, IntelliJ IDEA, Brackets, Sublime, Notepad++...

---

### Programación Web con PHP

PHP es un lenguaje de scripting de propósito general diseñado para el desarrollo de páginas web dinámicas.

**Características:**
- Sintaxis basada en C y C++ (similar a Java)
- Los archivos PHP tienen extensión `.php`
- Los archivos PHP contienen código HTML (que ya conoces) junto con instrucciones PHP
- La configuración de PHP se encuentra en el archivo `php.ini` del servidor

**¿Instalamos el entorno?**

---

## Ejercicios

### Ejercicio 1: Relacionar pasos del proceso cliente-servidor

**Diagrama con 6 pasos a ordenar:**

A. Si es una página web dinámica, el servidor la envía al módulo responsable de ejecutar el código

B. El servidor busca esa página y la recupera

C. El cliente web solicita una página web

D. Durante la ejecución de la página dinámica se puede acceder a una base de datos

E. El servidor envía el resultado obtenido al navegador que lo mostrará en pantalla

F. El resultado de la ejecución será un documento con código HTML

**Orden correcto:** C → B → A → D → F → E

---

### Ejercicio 2: Instalación de XAMPP

**XAMPP = Apache + MariaDB + PHP + Perl**

1. Accede a la [web oficial de XAMPP](https://www.apachefriends.org)
2. Descarga la última versión
3. Durante la instalación puedes desmarcar los módulos que no usaremos:
   - FileZilla FTP Server
   - Mercury Mail Server
   - Tomcat
   - Perl
   - Webalizer
   - Fake Sendmail

4. Al final de la instalación, NO iniciar XAMPP automáticamente

5. Configurar servicios:
   - Ir a la carpeta de instalación `c:/xampp`
   - Ejecutar `xampp-control.exe` como administrador
   - Para Apache y MySQL, marcar la casilla "Service"
   - Reiniciar los servidores

6. Verificar que ambos servicios estén corriendo (checkmarks verdes)

---

### Ejercicio 3: Instalación de Visual Studio Code

1. Accede a la [web oficial de Visual Studio Code](https://code.visualstudio.com/)
2. Descarga e instala la última versión
3. Puedes cambiar el idioma y personalizar según tus preferencias

---

### Ejercicio 4: Crear cuenta en Github

1. Accede a [Github](https://github.com/)
2. Regístrate con tu email

---

## Resumen

- Las páginas web pueden ser **estáticas** (contenido fijo) o **dinámicas** (contenido variable)
- Las páginas dinámicas requieren un **servidor web**, **lenguaje de programación**, **módulo de ejecución** y **base de datos**
- Existen múltiples plataformas: **AMP**, **JavaEE**, **.Net**, **Python**, etc.
- Los lenguajes se ejecutan de diferentes formas: **scripting**, **código nativo** o **código intermedio**
- **PHP** es un lenguaje de scripting muy popular para desarrollo web
- Las **aplicaciones web** combinan front-end y back-end
- Los **IDEs** facilitan el desarrollo, pero no son obligatorios
# PHP Introduction - DWES UD2

## 1. Introducción

### Páginas estáticas vs dinámicas

- Las páginas web estáticas con extensión `.html` pueden ejecutarse sin servidor web
- El navegador interpreta directamente el código de estos archivos
- Se pueden abrir haciendo doble clic en el archivo

### Archivos PHP

- Para ejecutar archivos `.php`, el servidor web debe procesarlos primero
- Los proyectos deben guardarse en el repositorio de páginas web del servidor
- En Apache, el directorio es **htdocs**
- Se trabaja asumiendo un proyecto por servidor web

**Ejercicio práctico:**
- Entrar en el directorio htdocs
- Cortar todos los elementos y pegarlos en una carpeta llamada `htdocs_original` en el directorio principal de XAMPP
- Esto permite recuperar archivos en caso de error

### Hosts virtuales

- Cuando se vean hosts virtuales en el módulo DAW (Despliegue de Aplicaciones Web)
- Se podrán tener diferentes proyectos simultáneamente en el mismo servidor web

---

## 2. Integración de PHP en HTML

### Uso de PHP para páginas web dinámicas

- PHP se usa como lenguaje de programación para páginas web dinámicas
- Los archivos tienen extensión `.php` pero contienen HTML + PHP
- Se puede integrar PHP dentro de HTML y viceversa

### PHP dentro de HTML

```html path=null start=null
<article>
<?php
    //código con instrucciones PHP
?>
</article>
```

### HTML dentro de PHP

```php path=null start=null
<?php
    echo '<h1>Bienvenido a mi página web</h1>';
?>
```

### Ejemplo básico

**Ejercicio:** Crear archivo `prueba.php` en htdocs:

```html path=null start=null
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Primera prueba php</title>
</head>
<body>
    Este es un archivo php que se encuentra en el servidor.
</body>
</html>
```

Acceder a: `http://localhost/prueba.php`

### Ejemplo con phpinfo

**Ejercicio:** Crear archivo `info.php`:

```php path=null start=null
<?php
    phpinfo();
?>
```

Acceder a: `http://localhost/info.php`

### Documentación oficial

- **URL:** https://www.php.net/manual/es/
- Siempre actualizada
- La mayoría en español
- Indica versiones compatibles con cada función
- Especifica si el uso está desaconsejado

---

## 3. Características Básicas de PHP

### Comentarios

**Una línea:**
```php path=null start=null
// Función para loguearse
```

**Múltiples líneas:**
```php path=null start=null
/* Script desarrollado por:
   Daniel Godoy
   fecha: 7-9-25 */
```

⚠️ **Importante:** 
- Los comentarios PHP NO aparecen en el HTML final
- Los comentarios HTML `<!-- -->` SÍ aparecen

---

### Variables y Tipos de Datos

#### Reglas para nombres de variables

- Siempre comienzan con `$`
- Después del `$` debe ir una letra o `_`
- El resto pueden ser letras, números o `_`
- **Son case sensitive** (distinguen mayúsculas/minúsculas)

**Válidos:**
```php path=null start=null
$edad
$nombreCalle
$_piso
$i
$variable2
$primer_apellido
```

**NO válidos:**
```php path=null start=null
$cantidad pelotas
$3tipos
$valor?
$direccion.usuario
```

#### Tipado débil

- PHP es un lenguaje de **tipado débil**
- No se especifica el tipo de dato
- Las variables pueden cambiar de tipo

```php path=null start=null
$variable = 5;
$variable = "Federico";
$variable = TRUE;
```

#### Tipos de datos

| Tipo | Descripción |
|------|-------------|
| `boolean` | TRUE/FALSE (0 = false, otros números = true) |
| `integer` | Número sin decimales |
| `float` | Número con decimales |
| `string` | Cadena de caracteres entre comillas |
| `null` | Variable sin valor |

**Ejemplos:**
```php path=null start=null
$booleano = FALSE;
$edad = 58;
$kilos = 5.3;
$nombreCompleto = "Ana Gómez Parra";
$otro = null;
```

#### Casting (conversión de tipos)

**Automático:**
```php path=null start=null
$cantidad = 3;
$precio = 1.6;
$total = $cantidad * $precio;
```

**Forzado:**
```php path=null start=null
$cantidad = 3;
$precio = 1.6;
$total = $cantidad * (int)$precio; // $total valdrá 3
```

---

### Expresiones y Operadores

#### Operadores principales

**Asignación:**
- `=`

**Aritméticos:**
- `+` `-` `*` `/` `%` `++` `--`

**Comparación:**
- `>` `<` `>=` `<=` `==` `===` `!=` `!==`
- `===` y `!==` comparan tipo y valor

**Lógicos:**
- `&&` `||` `!`

📚 **Documentación:** Consultar tipos de operadores completos

---

### Ámbito de Variables (Scope)

#### Variables locales vs globales

- Las variables se crean al usarse por primera vez
- Si aparecen dentro de una función, son **locales**
- Al terminar la función, las variables locales desaparecen

```php path=null start=null
$a = 1;
$b = 2;

function prueba() {
    $c = $a;  // Error: $a no es visible aquí
    
    global $b;  // Ahora $b es accesible
    $c = $b;
}
```

#### Variables estáticas

```php path=null start=null
function contador() {
    static $a = 0;
    $a++;
}
```

---

### Generación de Código HTML

#### Instrucciones echo y print

```php path=null start=null
<?php
    $modulo = "DWES";
    echo "<p>Módulo";
    print $modulo;
    print "</p>";
?>
```

⚠️ **Nota:** `echo` y `print` no son funciones, no necesitan paréntesis

#### Concatenación

Usando el operador `.`:

```php path=null start=null
<?php
    $modulo = "DWES";
    echo "<p>Módulo" . $modulo . "</p>";
?>
```

#### printf (formato)

```php path=null start=null
<?php
    $ciclo = "DAW";
    $modulo = "DWES";
    printf("%s es un módulo de %d curso de %s", $modulo, 2, $ciclo);
?>
```

📚 **Documentación:** Consultar sección "format" para especificadores

---

### Cadenas de Texto (Strings)

#### Comillas dobles vs simples

**Comillas dobles:** Permiten interpolación de variables

```php path=null start=null
<?php
    $edad = 24;
    echo "Edad: $edad";
    echo "<br>";
    echo "Juan tiene ${edad} años";
?>
```

#### 💡 Consejo de programación

Como HTML usa muchas comillas dobles:

```html path=null start=null
<a href="fotos.php"><img src="camara.png" alt="Galería fotográfica"></a>
```

**Se recomienda usar comillas simples en PHP:**

```php path=null start=null
<?php
    echo '<a href="fotos.php"><img src="camara.png" alt="Galería fotográfica"></a>';
?>
```

Para imprimir una comilla simple: `\'`

#### Operadores de cadenas

**Concatenar:** `.`
```php path=null start=null
$a = "Módulo";
$b = $a . " DWES";
```

**Concatenar y asignar:** `.=`
```php path=null start=null
$a = "Módulo";
$a .= " DWES";  // $a ahora es "Módulo DWES"
```

#### Funciones para cadenas

```php path=null start=null
<?php
    $nombre = "Antonio";
    echo strlen($nombre);  // Longitud
    
    $nombreMayus = strtoupper($nombre);  // A mayúsculas
?>
```

📚 **Documentación oficial:** Gran conjunto de funciones disponibles

---

### Funciones para Tipos de Datos

#### Consultar tipo de dato

```php path=null start=null
string gettype($variable)
```

Retorna: `array`, `boolean`, `double`, `integer`, `object`, `string`, `null`, `resource`, `unknown type`

#### Verificar tipo específico

```php path=null start=null
boolean is_array($variable)
boolean is_numeric($variable)
boolean is_bool($variable)
boolean is_integer($variable)
boolean is_string($variable)
```

#### Comprobar existencia de variable

```php path=null start=null
<?php
    $a = 25;
    $existe = isset($a);      // TRUE
    
    unset($a);
    $existe = isset($a);      // FALSE
?>
```

---

### Constantes

Valores que no pueden cambiar durante la ejecución:

```php path=null start=null
<?php
    define("PI", 3.141592);
    define("NOMBRE", "Luisa", true);  // Case insensitive
    
    $radio = 5;
    $superficie = PI * $radio * $radio;
?>
```

**Características:**
- No llevan `$` como prefijo
- Tipos permitidos: `integer`, `float`, `string`, `boolean`, `null`
- Tercer parámetro `true` = case insensitive

---

### Fechas y Horas

#### Zona horaria

```php path=null start=null
<?php
    date_default_timezone_set('Europe/Madrid');
?>
```

#### Función time()

Retorna fecha/hora actual en formato UNIX (segundos desde 1/1/1970):

```php path=null start=null
<?php
    $start = time();
    
    /* Muchas instrucciones php */
    
    echo "Esta página se ha generado en " . time()-$start . " segundos";
?>
```

#### Función getdate()

Retorna array asociativo con información de fecha/hora:

```php path=null start=null
<?php
    $hoy = getdate();
    print_r($hoy);
?>
```

Parámetro opcional: timestamp (por defecto usa `time()`)

#### Función date()

Formatea una fecha:

```php path=null start=null
<?php
    // Las dos instrucciones almacenan lo mismo
    $hoy = date("l, d M Y");
    $hoy = date("l, d M Y", time());
?>
```

📚 **Documentación:** Opciones de formato de fecha

#### Función mktime()

Genera una fecha específica:

```php path=null start=null
// mktime(hora, minutos, segundos, mes, dia, año)
$examen = mktime(18, 5, 0, 11, 8, 2023);
```

---

### Superglobales

Variables disponibles en **cualquier ámbito** sin `global`:

#### $_SERVER
Información sobre el servidor:

```php path=null start=null
<?php
    print_r($_SERVER);
    var_dump($_SERVER);
?>
```

#### $_GET, $_POST, $_COOKIE
Variables recibidas por estos métodos

#### $_REQUEST
Combina datos de GET, POST y COOKIE

#### $_FILES
Información de archivos enviados por POST

#### $_SESSION
Variables de sesión (se verá más adelante)

---

### Inclusión de Archivos Externos

Permite añadir contenido de otros archivos:

#### Instrucciones

| Función | Descripción |
|---------|-------------|
| `include` | Si no encuentra el archivo, da warning y continúa |
| `require` | Si no encuentra el archivo, error fatal |
| `include_once` | Incluye solo una vez |
| `require_once` | Require solo una vez |

```php path=null start=null
include("ruta_archivo_php");
require("ruta_archivo_php");
include_once("ruta_archivo_php");
require_once("ruta_archivo_php");
```

#### Convención de nomenclatura

Archivos diseñados para ser incluidos: extensión `.inc.php`

```text path=null start=null
formulario.inc.php
```

#### Ejercicio práctico

**1. Crear `prueba.inc.php`:**
```html path=null start=null
<h1>Esto viene de otro archivo php</h1>
```

**2. Modificar `prueba.php`:**
```php path=null start=null
<?php
    include("archivo.php");
    include_once("otro.php");
    require("prueba.inc.php");
    require_once("inventado.php");
?>
```

---

## Ejercicio de Repaso

| Descripción | Función/Palabra |
|-------------|-----------------|
| Usado para definir constantes | `define` |
| Retorna un string en formato | `date` |
| Indica si una variable está definida y su valor no es null | `isset` |
| Establece el tipo de una variable | `settype` |
| Obtiene un string de texto desde una fecha/hora | `date` |
| Indica si una variable es de tipo string | `is_string` |
| Obtiene un array con información de fecha/hora actual | `getdate` |
| Establece la zona horaria | `date_default_timezone_set` |

---

## Práctica Obligatoria Entregable

**Objetivo:** Modularizar la cabecera de tu aplicación web HTML5

**Pasos:**

1. Mover el código HTML de la cabecera a un archivo nuevo: `cabecera.inc.php`

2. Usar instrucciones de inclusión de archivos para añadir esta cabecera a todas las páginas web de tu aplicación

**Resultado:** Todas las páginas compartirán la misma cabecera de forma centralizada

---

## Resumen de Conceptos Clave

✅ PHP requiere servidor web para ejecutarse  
✅ Se integra con HTML usando `<?php ... ?>`  
✅ Variables comienzan con `$`  
✅ Tipado débil (no se declara el tipo)  
✅ Usar comillas simples para strings con HTML  
✅ `echo` y `print` para salida  
✅ Superglobales accesibles en cualquier ámbito  
✅ `include/require` para modularizar código  
✅ Documentación oficial: https://www.php.net/manual/es/

---

## 3. Características Básicas de PHP (Continuación)

### Bloques de Instrucciones

En PHP se usan llaves `{ }` para agrupar sentencias.

Usando estructuras de control, es posible decidir si un bloque de instrucciones se ejecuta o no, o si la ejecución de dicho bloque debe repetirse.

---

### Estructuras de Control

PHP, aunque es un lenguaje de programación de **script**, tiene, como cualquier otro lenguaje de programación de alto nivel, sentencias que permiten alterar el flujo de ejecución predefinido (instrucción por instrucción de arriba a abajo).

Estas sentencias ya se conocen de otros lenguajes de programación como Java:

- `if` / `else if` / `else`
- `switch`
- `while`
- `do/while`
- `for`

#### if / else

**Sintaxis sin llaves (una instrucción):**

```php path=null start=null
<?php
if ($a < $b)
    echo "a es menor que b";
else if ($a > $b)
    echo "a es mayor que b";
else
    echo "a es igual a b";
?>
```

**Sintaxis con llaves (múltiples instrucciones):**

```php path=null start=null
<?php
if ($a < $b) {
    echo "a es menor que b";
} else if ($a > $b) {
    echo "a es mayor que b";
} else {
    echo "a es igual a b";
}
?>
```

**Llaves en línea separada:**

```php path=null start=null
<?php
if ($a < $b)
{
    echo "a es menor que b";
}
else if ($a > $b)
{
    echo "a es mayor que b";
}
else
{
    echo "a es igual a b";
}
?>
```

#### switch

**Con break (ejecución normal):**

```php path=null start=null
<?php
$a = 0;
switch ($a) {
    case 0: echo "a vale 0";
            break;
    case 1: echo "a vale 1";
            break;
    default: echo "a no vale 0 ni 1";
}
?>
```

**Sin break (fall-through):**

```php path=null start=null
<?php
$a = 0;
switch ($a) {
    case 0: echo "a vale 0";
    case 1: echo "a vale 1";
    case 2: echo "a vale 2";
            break;
    default: echo "a no vale 0 ni 1";
}
// Si $a = 0, imprime: "a vale 0a vale 1a vale 2"
?>
```

#### while

```php path=null start=null
<?php
$a = 1;
while ($a < 8) {
    $a += 3;
}
echo $a; // Imprime: 10
?>
```

#### do/while

```php path=null start=null
<?php
$a = 5;
do {
    $a -= 3;
} while ($a > 10);
echo $a; // Imprime: 2
?>
```

#### for

**Ejemplo básico (0-9):**

```php path=null start=null
<?php
for ($a = 0; $a < 10; $a++) {
    echo $a;
    echo "<br>";
}
?>
```

**Ejemplo con incremento personalizado:**

```php path=null start=null
<?php
for ($a = 5; $a < 10; $a += 3) {
    echo $a;      // Imprime: 5, 8
    echo "<br>";
}
?>
```

---

### Funciones

Las funciones son bloques de código que, estando definidos en otro lugar, pueden ser ejecutados mediante lo que se conoce como una **llamada a función**.

#### Funciones predefinidas

Ya hemos usado funciones predefinidas de PHP:

```php path=null start=null
<?php
    phpinfo();
?>
```

Puedes consultar todas las funciones predefinidas en la documentación oficial de PHP.

#### Funciones propias

Además de las funciones predefinidas, puedes crear tus propias funciones.

**Características importantes:**
- **NO** es necesario definir las funciones antes de usarlas
- Deben estar en el mismo script o en un archivo incluido con `include`/`require`

**Ejemplo básico (sin parámetros, usando global):**

```php path=null start=null
<?php
$precio = 10;
precio_con_iva();

function precio_con_iva() {
    global $precio;
    $precio_iva = $precio * 1.21;
    echo "El precio con IVA es ". $precio_iva;
}
?>
```

⚠️ **Nota:** El uso de `global` como en este ejemplo **NO está recomendado**.

#### Argumentos/Parámetros

Puedes pasar valores a funciones mediante argumentos.

**Características:**
- Los argumentos son una lista de variables separadas por comas
- **No se indica** el tipo de dato de la variable
- Opcionalmente, la función puede **retornar un valor**

**Ejemplo con parámetro:**

```php path=null start=null
<?php
function precio_con_iva($precio) {
    $precio_iva = $precio * 1.21;
    echo "El precio con IVA es ". $precio_iva;
}

$precio = 10;
precio_con_iva($precio);
?>
```

**Ejemplo con return:**

```php path=null start=null
<?php
function precio_con_iva($precio) {
    $precio_iva = $precio * 1.21;
    return $precio_iva;
}

$precio = 10;
$precio_final = precio_con_iva($precio);
echo "El precio con IVA es ". $precio_final;
?>
```

**Uso directo del return:**

```php path=null start=null
<?php
function precio_con_iva($precio) {
    $precio_iva = $precio * 1.21;
    return $precio_iva;
}

$precio = 10;
echo "El precio con IVA es ". precio_con_iva($precio);
?>
```

#### Valores por defecto

Puedes establecer valores por defecto para los argumentos. Si no se proporciona un valor en la llamada, se usará el valor por defecto.

Se puede ver este comportamiento con la función `date()`:

```php path=null start=null
<?php
echo date("Y");              // Usa time() por defecto
echo date("Y", time());      // Equivalente al anterior
?>
```

**Regla importante:** Los argumentos con valores por defecto deben ir **al final**.

**Ejemplo:**

```php path=null start=null
<?php
function precio_con_iva($precio, $iva = 0.21) {
    $precio = $precio * (1 + $iva);
    return $precio;
}

$precio = 10;
$precio_iva = precio_con_iva($precio);  // Usa IVA 0.21
echo "El precio con IVA es ". $precio_iva;
?>
```

#### Paso por valor vs paso por referencia

**Paso por valor (por defecto):**
- La variable original **no cambia** su valor

**Paso por referencia (con `&`):**
- La variable original **puede cambiar** su valor
- **No recomendado** sin un conocimiento avanzado del lenguaje

```php path=null start=null
<?php
function precio_con_iva(&$precio, $iva = 0.21) {
    $precio = $precio * (1 + $iva);  // Modifica la variable original
}

$precio = 10;
$precio_iva = precio_con_iva($precio);
echo "El precio con IVA es ". $precio_iva;
// Ahora $precio también ha cambiado
?>
```

---

### Arrays (Arreglos)

Los arrays permiten almacenar varios valores del mismo tipo de dato. Cada miembro del array se almacena en una posición.

#### Tipos de arrays

1. **Numéricos:** Todos los índices son enteros (números)
2. **Asociativos:** Todos los índices son strings (cadenas)
3. **Mixtos:** Tiene índices enteros y strings

#### Declaración de arrays

**Array numérico (índices automáticos):**

```php path=null start=null
$colores = array("rojo", "verde", "azul");
$colores = ["rojo", "verde", "azul"];  // Sintaxis alternativa
```

**Array asociativo:**

```php path=null start=null
$ciclos = array("DAW" => "Desarrollo web", "DAM" => "Desarrollo multiplataforma");
```

**Array con índices personalizados:**

```php path=null start=null
$colores = [1 => "rojo", 5 => "verde", "0" => "azul"];
```

**Añadir elementos:**

```php path=null start=null
$colores[] = "azul";  // Añade al final con índice automático
```

#### Características importantes

- Si no se indica el índice, será numérico y empezará en **0**
- Si se declara un array asociativo, no se puede acceder con posiciones numéricas
- Se pueden mezclar claves numéricas y asociativas
- Si la clave asociativa es un número, el elemento puede accederse con el número

**Array dual (numérico + asociativo):**

```php path=null start=null
$ciclos = array(
    0 => "Desarrollo web", 
    "DAW" => "Desarrollo web",
    1 => "Desarrollo multiplataforma", 
    "DAM" => "Desarrollo multiplataforma"
);
```

Algunas funciones del sistema retornan arrays de esta forma.

#### Añadir elementos a un array

**Al final del array:**

```php path=null start=null
$personajes = ["Luke", "Leia"];
$personajes[] = "Han Solo";  // Se asigna la clave 2
```

**Con clave específica:**

```php path=null start=null
$personajes[3] = "Darth Vader";
```

#### Acceso a elementos

Se usa la notación de corchetes `[]`:

```php path=null start=null
$colores = ["rojo", "verde", "azul"];
echo $colores[0];  // Imprime: rojo
```

#### Flexibilidad de arrays en PHP

PHP es muy flexible con arrays:

```php path=null start=null
$colores[0] = "rojo";
$colores[1] = "azul";
$colores[5] = "marron";
$colores[] = "verde";  // ¿Qué clave tiene "verde"? -> 6

$numeros[] = "uno";    // clave 0
$numeros[] = "dos";    // clave 1
```

#### Funciones útiles

**print_r() y var_dump():**

```php path=null start=null
print_r($array);   // Muestra estructura del array
var_dump($array);  // Muestra estructura + tipos
```

⚠️ **Nota:** Estas funciones solo se recomiendan para **depuración**.

**count():**

```php path=null start=null
$cantidad = count($array);  // Retorna el número de elementos
```

#### Recorrer un array con for

```php path=null start=null
<?php
$colores = ["rojo", "verde", "azul"];

for ($i = 0; $i < count($colores); $i++) {
    echo $colores[$i] . "<br>";
}
?>
```

#### Recorrer un array con foreach

**Solo valores:**

```php path=null start=null
<?php
$numeros = ["uno", "dos", "tres"];

foreach($numeros as $valor) {
    echo $valor . "<br>";
}
?>
```

**Clave y valor:**

```php path=null start=null
<?php
foreach($numeros as $clave => $valor) {
    echo "[" . $clave . "]" . $valor . "<br>";
}
?>
```

#### Arrays multidimensionales

La operación es exactamente igual que con arrays normales.

**Array numérico 2D:**

```php path=null start=null
$array = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

echo $array[1][0];  // Imprime: 4
```

**Array mixto multidimensional:**

```php path=null start=null
$array = [
    ["Ana", "Luis", "Marta"],
    "colores" => ["amarillo", "verde"],
    ["saludo" => "hola", "despedida" => "adiós", "¿Qué tal estás?"]
];
```

**Consideraciones:**
- No se declara el tamaño de las dimensiones
- Las claves pueden ser mixtas (índice o asociativas)

#### Eliminar elementos

**Función unset():**

```php path=null start=null
unset($array[2]);
unset($personaje["nombre"]);
```

**Reindexar array numérico:**

```php path=null start=null
$array = array_values($array);
```

Esto evita problemas al recorrer el array después de eliminar elementos.

---

## Ejercicios

### Ejercicio 1: Footer con fecha en español

**Objetivo:** Modularizar el pie de página con fecha en español.

**Requisitos:**
1. El footer debe estar en `footer.inc.php`
2. Incluir tu nombre y apellido
3. Mostrar la fecha actual con días y meses en español
4. Usar `switch` para convertir números de día/mes a español

**Formato esperado:**
```
Miércoles, 20 de septiembre de 2023
```

### Ejercicio 2: Página count.php

**Objetivo:** Crear una página con bucles.

**Requisitos:**
1. Usar el mismo header y footer que el resto de archivos
2. Mostrar una lista de números del 1 al 30 (usar bucle `for`)
3. Calcular y mostrar el factorial de 5 usando un bucle

**Formato esperado del factorial:**
```
5! = 5 x 4 x 3 x 2 x 1 = 120
```

### Ejercicio 3: Corrección de función

**Pregunta:** ¿Es correcta la definición de esta función? Indica por qué y corrígela si no lo es.

```php path=null start=null
function calculo_numerico($a, $b = 5, $c) {
    $resultado = $a * $b * $c;
    return $resultado;
}
```

**Respuesta:** No es correcta. Los parámetros con valores por defecto deben ir **al final**.

**Corrección:**
```php path=null start=null
function calculo_numerico($a, $c, $b = 5) {
    $resultado = $a * $b * $c;
    return $resultado;
}
```

### Ejercicio 4: Página server.php

**Objetivo:** Mostrar el contenido de `$_SERVER` en una tabla.

**Requisitos:**
1. Usar el mismo header y footer
2. Mostrar todo el contenido de `$_SERVER` dentro de una tabla HTML
3. **NO usar** `print_r` ni `var_dump`
4. Usar un bucle para recorrer el array

### Ejercicio 5: Optimizar fecha con arrays

**Objetivo:** Modificar `footer.inc.php` para usar arrays en lugar de `switch`.

**Requisitos:**
1. Almacenar nombres de días y meses en un array multidimensional
2. Acceder a la posición correspondiente según el número de día/mes
3. Eliminar el `switch` usado anteriormente

---

## Resumen - Estructuras de Control, Funciones y Arrays

✅ Usar `{ }` para agrupar instrucciones  
✅ Estructuras de control: `if`, `switch`, `while`, `do/while`, `for`  
✅ Funciones: bloques de código reutilizables  
✅ No es necesario definir funciones antes de usarlas  
✅ Parámetros con valores por defecto van al final  
✅ Paso por valor vs paso por referencia (`&`)  
✅ Arrays: numéricos, asociativos y mixtos  
✅ Usar `foreach` para recorrer arrays  
✅ `count()` para obtener el tamaño de un array  
✅ Arrays multidimensionales para datos complejos  
✅ `unset()` para eliminar elementos, `array_values()` para reindexar

---

## 3.3 Formularios Web (Web Forms)

### Introducción a los Formularios Web

Los formularios web son las herramientas que permiten recopilar y procesar datos introducidos por el usuario en el servidor.

### Consideraciones importantes

- **Method:** Es importante elegir bien el método (`method`) con el que se enviará el formulario: `get` o `post`
- **Action:** En el atributo `action` del formulario se debe indicar el script que recibirá los datos
- **Name:** Para que un campo de formulario sea enviado, debe tener el atributo `name`

### Ejemplo básico de formulario

```html path=null start=null
<form action="procesa.php" method="post">
    Nombre del alumno: <input type="text" name="nombre" id="nombre"><br>
    Apellidos del alumno: <input type="text" name="apellidos" id="apellidos"><br>
    Ciclo que cursa:<br>
    <input type="radio" name="ciclo" value="DAW"> Des. de ap. web<br>
    <input type="radio" name="ciclo" value="DAM"> Des. de ap. multiplataforma<br><br>
    <input type="submit" value="Enviar">
</form>
```

### Checkboxes con múltiples valores

Cuando un checkbox puede enviar varios valores, se debe indicar en el atributo `name` que es un array usando corchetes `[]`:

```html path=null start=null
<form name="input" action="#" method="post">
    Nombre del alumno: <input type="text" name="nombre"><br>
    Ciclos que cursa:<br>
    <input type="checkbox" name="modulos[]" value="DWES">
    Desarrollo web en entorno servidor<br>
    <input type="checkbox" name="modulos[]" value="DWEC">
    Desarrollo web en entorno cliente<br>
    <br>
    <input type="submit" value="Enviar">
</form>
```

---

### GET vs POST

#### Tabla comparativa

| Característica | GET | POST |
|----------------|-----|------|
| **Uso principal** | Recuperar datos | Enviar datos |
| **Ubicación de datos** | Parámetros URL | Cuerpo de la petición |
| **Visibilidad de datos** | Visible en URL | Oculto en el cuerpo de la petición |
| **Tamaño máximo** | Limitado (~2048 caracteres) | Sin límite práctico |
| **Caché** | Puede ser cacheado | No se cachea |
| **Marcadores** | Soportado | No soportado |
| **Historial del navegador** | Se guarda | No se guarda |
| **Seguridad** | Menos seguro | Más seguro |
| **Idempotencia** | Sí (mismo resultado) | No (puede cambiar) |

#### Consideraciones de seguridad

La seguridad debe ser siempre tu preocupación principal al elegir entre GET y POST. Aunque HTTPS encripta todos los datos en tránsito para ambos métodos, las peticiones POST ofrecen una capa adicional de privacidad al mantener los datos fuera de las URLs.

**Esto importa porque:**
- Las URLs a menudo se registran en logs del servidor, historiales del navegador y servidores proxy
- Las URLs pueden compartirse accidentalmente en capturas de pantalla o marcadores
- Las claves API o tokens en URLs podrían exponerse a través de cabeceras referrer
- Las extensiones del navegador pueden leer y modificar parámetros de URL

#### Cuándo usar GET

- **Funcionalidad de búsqueda**
- **Listados de productos**
- **Páginas de artículos**
- **Perfiles de usuario**
- **Vistas de dashboard**

✅ Usa GET cuando quieras que la petición sea marcable, compartible y cacheable

#### Cuándo usar POST

- **Formularios de Login/Registro**
- **Subidas de archivos**
- **Envío de comentarios**
- **Creación de nuevo contenido**
- **Actualización de configuración de usuario**

✅ Usa POST cuando trabajes con datos sensibles, subidas de archivos, o creación/actualización de recursos

#### Resumen de consideraciones

- Considera la **visibilidad**, **seguridad** y **tamaño** de tus datos al elegir entre GET y POST
- GET: cuando quieras que la petición sea marcable, compartible y cacheable
- POST: cuando trabajes con datos sensibles, subidas de archivos, o creación/actualización de recursos

---

### Procesamiento de Formularios con GET

**Formulario HTML:**

```html path=null start=null
<form name="input" action="procesa_get.php" method="get">
    Nombre del alumno: <input type="text" name="nombre" id="nombre"><br>
    Apellidos del alumno: <input type="text" name="apellidos" id="apellidos"><br>
    Ciclo que cursa:<br>
    <input type="radio" name="ciclo" value="DAW"> Des. de ap. web<br>
    <input type="radio" name="ciclo" value="DAM"> Des. de ap. multiplataforma<br><br>
    <input type="submit" value="Enviar">
</form>
```

**Archivo procesa_get.php:**

```php path=null start=null
<?php
    echo 'El alumno ';
    echo $_GET['nombre'] .' '. $_GET['apellidos'];
    echo '<br>Se encuentra cursando el ciclo: ';
    echo $_GET['ciclo'];
?>
```

**Resultado:**
- La información introducida se muestra en pantalla
- Los parámetros que se han pasado al formulario **se muestran en la URL**
- Ejemplo URL: `localhost/UD2/form/procesa_get.php?nombre=Pepito&apellidos=Perez&ciclo=DAW`

---

### Procesamiento de Formularios con POST

**Formulario HTML:**

```html path=null start=null
<form name="input" action="procesa_post.php" method="post">
    Nombre del alumno: <input type="text" name="nombre" id="nombre"><br>
    Apellidos del alumno: <input type="text" name="apellidos" id="apellidos"><br>
    Ciclo que cursa:<br>
    <input type="radio" name="ciclo" value="DAW"> Des. de ap. web<br>
    <input type="radio" name="ciclo" value="DAM"> Des. de ap. multiplataforma<br><br>
    <input type="submit" value="Enviar">
</form>
```

**Archivo procesa_post.php:**

```php path=null start=null
<?php
    echo 'El alumno ';
    echo $_POST['nombre'] .' '. $_POST['apellidos'];
    echo '<br>Se encuentra cursando el ciclo: ';
    echo $_POST['ciclo'];
?>
```

**Resultado:**
- La información introducida se muestra en pantalla
- Los parámetros que se han pasado al formulario **NO se muestran en la URL**
- Ejemplo URL: `localhost/UD2/form/procesa_post.php`

---

### Variables enviadas como Arrays

A veces puede ser interesante que las variables enviadas sean arrays:

```html path=null start=null
<form name="input" action="#" method="post">
    Nombre: <input type="text" name="propio[nombre]"><br>
    Apellidos: <input type="text" name="propio[apellidos]"><br>
    Nombre: <input type="text" name="conyuge[nombre]"><br>
    Apellidos: <input type="text" name="conyuge[apellidos]"><br>
    <br>
    <input type="submit">
</form>
```

Esto permite organizar los datos relacionados en estructuras de arrays en PHP:

```php path=null start=null
<?php
    // $_POST['propio'] será un array con 'nombre' y 'apellidos'
    // $_POST['conyuge'] será un array con 'nombre' y 'apellidos'
    echo $_POST['propio']['nombre'];
    echo $_POST['conyuge']['apellidos'];
?>
```

---

### Validación de Datos en Formularios

La validación de datos es **muy importante** y debe hacerse en **3 lugares**:

#### 1. Navegador (Browser)

Usando los tipos correctos en los campos `input` y el atributo `required`:

```html path=null start=null
<input type="email" name="correo" required>
<input type="number" name="edad" min="18" max="99" required>
<input type="date" name="fecha" required>
```

#### 2. Cliente (JavaScript)

Antes de que los datos sean enviados, para evitar sobrecargar el servidor:

```javascript path=null start=null
function validarFormulario() {
    let nombre = document.getElementById('nombre').value;
    if (nombre.length < 3) {
        alert('El nombre debe tener al menos 3 caracteres');
        return false;
    }
    return true;
}
```

#### 3. Servidor (PHP)

Para evitar suplantación de identidad, por ejemplo si alguien crea su propio formulario. Esto se hace usando JavaScript y PHP juntos, a menudo con un `input type="hidden"`.

**Funciones útiles para validación:**
- `isset()` - Verifica si una variable está definida
- `is_numeric()` - Verifica si es numérico
- `strcmp()` - Compara cadenas
- `empty()` - Verifica si está vacío

---

### Formularios Autoprocesados

Es común que la misma página que muestra el formulario sea la que procese los datos que envía usando `action="#"`.

**Flujo de trabajo:**

1. Si todos los datos son correctos → se toma la acción apropiada
2. Si hay campos con errores → se muestra el formulario de nuevo con:
   - Los campos rellenados con los valores introducidos
   - Indicación de qué campos contienen errores

**Para lograr esto:**
- Se usa el atributo `value` de los `input`
- Se usa el atributo `checked` de los checkboxes/radios
- Se usa la función `isset()` para saber si llegan variables del método usado

**Ejemplo de validación:**

```php path=null start=null
<?php
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar campos
    if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
        $errores[] = 'El nombre es obligatorio';
    }
    
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Email inválido';
    }
    
    // Si no hay errores, procesar
    if (empty($errores)) {
        // Procesar datos...
        echo '<p>Registro completado correctamente</p>';
    } else {
        // Mostrar errores
        foreach ($errores as $error) {
            echo '<p style="color: red;">' . $error . '</p>';
        }
    }
}
?>
```

**Validación con location (redireccionamiento):**

Si un campo específico no llega, recargar la página sin datos (posible suplantación):

```php path=null start=null
<?php
if (!isset($_POST['campo_obligatorio'])) {
    header('Location: formulario.php');
    exit();
}
?>
```

---

### Expresiones Regulares en PHP

#### Función preg_match()

```php path=null start=null
preg_match($expresion, $cadena)
```

Busca en `$cadena` una coincidencia con la expresión regular `$expresion`.

**Retorna:**
- `1` si coincide
- `0` si no coincide
- `false` si ocurre un error

**Ejemplo:**

```php path=null start=null
<?php
$patron = '/^[A-Z][a-z]+$/';
$nombre = 'Juan';

if (preg_match($patron, $nombre)) {
    echo 'Nombre válido';
} else {
    echo 'Nombre inválido';
}
?>
```

#### Validación de Email con filter_var()

⚠️ **No se recomienda** usar expresiones regulares para validar direcciones de email.

En su lugar, es recomendable usar `filter_var()`, que retorna `false` si el filtro aplicado falla, con el filtro de email `FILTER_VALIDATE_EMAIL`:

```php path=null start=null
<?php
$email = 'usuario@ejemplo.com';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Formato de correo no válido';
} else {
    echo 'Email válido';
}
?>
```

**Ventajas de filter_var():**
- Más simple y legible
- Mantenido por PHP
- Cumple con estándares RFC
- Menos propenso a errores

---

## Ejercicios - Formularios Web

### Ejercicio 1: Formulario de consulta

En el proyecto, añade un formulario en el que pruebes los diferentes tipos de datos y con el que el usuario pueda enviar una consulta.

**Requisitos:**
- Si no lo tienes, añade un campo tipo `checkbox` y un campo `input type="date"`
- Crea un archivo llamado `consulta.php` que muestre los datos recibidos del formulario
- Este documento debe tener la misma cabecera y pie de página que el resto de archivos

---

### Ejercicio 2: Formulario de registro con validación

Crea un archivo llamado `registro.php` en el proyecto. Este documento debe tener la misma cabecera y pie de página que el resto de archivos.

**Campos del formulario:**
- Nombre
- Apellidos
- Nombre de usuario
- Contraseña (duplicado para verificación)
- Email
- Fecha de nacimiento
- Género
- Aceptación de condiciones
- Aceptación de envío de publicidad

**Requisitos de validación:**

1. El formulario debe enviarse a sí mismo (`action="#"`)
2. Si se encuentran errores:
   - Mostrar el formulario con los datos enviados
   - Indicar qué campos tienen errores
3. Si todo es correcto:
   - Mostrar un mensaje de registro completado
   - No mostrar el formulario

**Validaciones necesarias:**
- Todos los campos son obligatorios excepto el campo de publicidad
- Los campos deben contener el tipo de dato correcto
- Las contraseñas deben coincidir
- El email debe contener una dirección válida (usar expresiones regulares o `filter_var()`)
- Debe contener `@` y dominio

**Ejemplo de estructura:**

```php path=null start=null
<?php
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validaciones
    if (empty($_POST['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio';
    }
    
    if ($_POST['password'] !== $_POST['password2']) {
        $errores['password'] = 'Las contraseñas no coinciden';
    }
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Email no válido';
    }
    
    // Si no hay errores, procesar
    if (empty($errores)) {
        echo '<p class="exito">Registro completado correctamente</p>';
    }
}

// Si hay errores o no se ha enviado, mostrar formulario
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($errores)) {
    // Mostrar formulario con valores previos y errores
}
?>
```

---

## Resumen - Formularios Web

✅ Los formularios son herramientas para recopilar datos del usuario  
✅ Usar `method="get"` para búsquedas y datos no sensibles  
✅ Usar `method="post"` para datos sensibles y envíos de información  
✅ Todo campo debe tener el atributo `name` para ser enviado  
✅ Usar `name="campo[]"` para arrays en checkboxes  
✅ Variables recibidas: `$_GET`, `$_POST`, `$_REQUEST`  
✅ Validar en 3 capas: navegador, cliente (JS), servidor (PHP)  
✅ Usar `isset()`, `empty()`, `is_numeric()` para validaciones  
✅ Usar `filter_var()` con `FILTER_VALIDATE_EMAIL` para emails  
✅ Formularios autoprocesados con `action="#"`  
✅ Preservar valores con `value` y `checked` en caso de error  
✅ Usar `$_SERVER['REQUEST_METHOD']` para detectar método de envío

---

## 4. Exception Handling (Manejo de Excepciones)

### 4.1 Introducción a las Excepciones

#### ¿Qué es una excepción?

Una excepción en PHP ocurre cuando la aplicación intenta realizar una tarea y no puede hacerlo.

**Características principales:**
- La excepción **detendrá la ejecución** a menos que la capturemos y manejemos
- Al capturar y manejar una excepción, podemos:
  - **Evitar mostrar mensajes de error no deseados** al usuario final
  - **Prevenir que la aplicación se cierre abruptamente**

---

### 4.2 Clases de Excepciones en PHP

#### PHP 5: Clase Exception

En PHP 5 existe la clase `Exception` (también disponible en PHP 7 y PHP 8):

```php path=null start=null
try {
    // ...
}
catch (Exception $e) {
    echo $e->getMessage();
}
```

#### PHP 7 y PHP 8: Clase Throwable

En PHP 7 y PHP 8 (no disponible en PHP 5), tenemos la clase `Throwable`:
- Cubre tanto **excepciones** como **errores internos**
- Es más completa que `Exception`

```php path=null start=null
try {
    // ...
}
catch (Throwable $t) {
    echo $t->getMessage();
}
```

#### Compatibilidad entre versiones PHP 5 y PHP 7

Si no estamos seguros de la versión de PHP del servidor, podemos usar **ambas cláusulas**:

```php path=null start=null
try {
    // Code that may cause an Exception or Error.
}
catch (Throwable $t) {
    // Executed only in PHP 7, will not match in PHP 5
}
catch (Exception $e) {
    // Only in PHP 5, won't be reached in PHP 7
}
```

---

### 4.3 Ejemplo Básico de Excepciones

#### Sin manejo de excepciones

**Código con error de división por cero:**

```php path=null start=null
<body>
<?php
$number = 10;
$anverseNumber = 1 / $number;
echo "<h2>The inverse of $number is $anverseNumber</h2>";
?>
</body>
```

**Salida:** `The inverse of 10 is 0.1`

**Si cambiamos `$number` a 0:**

```php path=null start=null
<?php
$number = 0;
$anverseNumber = 1 / $number;
echo "<h2>The inverse of $number is $anverseNumber</h2>";
?>
```

**Salida:** `Fatal error: Uncaught DivisionByZeroError: Division by zero`

#### Con manejo de excepciones

```php path=null start=null
<?php
$number = 0;
try {
    $anverseNumber = 1 / $number;
    echo "<h2>The inverse of $number is $anverseNumber</h2>";
}
catch (Throwable $t) {
    echo "An error happened";
}
?>
```

**Resultado:**
- Si ocurre un error dentro de la sección `try`, la ejecución **NO se detendrá**
- Se redirigirá a la sección `catch` en su lugar
- **Salida:** `An error happened`

💡 **Importante:** Si un error ocurre dentro del bloque `try`, la ejecución se redirige al `catch` y **NO se ejecutan** las líneas restantes del `try`.

---

### 4.4 Métodos de Exception/Throwable

Tanto `Throwable` como `Exception` ofrecen métodos útiles:

📚 **Documentación oficial:** https://www.php.net/manual/en/class.exception.php

#### Métodos principales

```php path=null start=null
getMessage();   // Retorna el mensaje de excepción

getCode();      // Retorna el código de excepción

getFile();      // Obtiene el nombre del archivo donde se creó la excepción

getLine();      // Obtiene el número de línea donde se creó la excepción

__toString();   // Retorna la representación en string de la excepción
```

#### Ejemplo de uso

```php path=null start=null
<?php
$number = 0;
try {
    $anverseNumber = 1 / $number;
    echo "<h2>The inverse of $number is $anverseNumber</h2>";
}
catch (Throwable $t) {
    echo "An error {$t->getMessage()} happened<br/>";
    echo "In line {$t->getLine()} of file {$t->getFile()}<br/>";
}
?>
```

**Salida:**
```text path=null start=null
An error Division by zero happened
In line 17 of file C:\xampp\htdocs\ProvesPHP\exceptions\exceptions01.php
```

---

### 4.5 Lanzar Excepciones (throw)

Podemos **lanzar excepciones manualmente** dentro de nuestra aplicación usando `throw`.

#### Ejemplo completo

```php path=null start=null
<?php
// Create function with an exception
function checkNum($number) {
    if ($number > 1) {
        throw new Exception("Value must be 1 or below");
    }
    return true;
}

// Trigger exception in a "try" block
try {
    checkNum(2);
    // If the exception is thrown, this text will not be shown
    echo 'If you see this, the number is 1 or below';
}

// Catch exception
catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
?>
```

**Salida:** `Message: Value must be 1 or below`

⚠️ **Nota:** Cuando se lanza una excepción con `throw`, el código posterior dentro del `try` **NO se ejecuta**.

---

### 4.6 Excepciones Personalizadas

Podemos crear clases de excepciones personalizadas **extendiendo** la clase `Exception`.

**Características:**
- La clase personalizada hereda las propiedades de la clase `Exception` de PHP
- Podemos agregar **funciones personalizadas**
- Permite crear mensajes de error más específicos

#### Ejemplo de excepción personalizada

```php path=null start=null
<?php
class customException extends Exception {
    public function errorMessage() {
        // Error message
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
                  . ': <b>' . $this->getMessage() . '</b> is not a valid E-Mail address';
        return $errorMsg;
    }
}

$email = "someone@example...com";

try {
    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        // Throw exception if email is not valid
        throw new customException($email);
    }
}

catch (customException $e) {
    // Display custom message
    echo $e->errorMessage();
}
?>
```

---

### 4.7 Warnings (Advertencias)

#### ¿Qué es un Warning?

Un **Warning** es un error no fatal que:
- Genera un mensaje
- **NO detiene la ejecución** del script
- **NO puede ser manejado** por una estructura `try...catch`

#### Ejemplo de Warning

```php path=null start=null
<?php
function anverse($number) {
    $anverseNumber = 1 / $number;
    return $anverseumber;  // ERROR: variable mal escrita
}

try {
    $number = 10;
    echo "<h2>The inverse of $number is" . anverse($number) . "</h2>";
}
catch (Throwable $t) {
    echo "An error {$t->getMessage()} happened<br/>";
}
?>
```

**Resultado:**
```text path=null start=null
Warning: Undefined variable $anverseumber in C:\xampp\htdocs\ProvesPHP\exceptions\exceptions01.php on line 5

The inverse of 10 is
```

#### Deshabilitar Warnings

Los Warnings pueden deshabilitarse:
- En el archivo de configuración `php.ini`
- Usando la función `error_reporting(E_ERROR)`

⚠️ **Nota:** Manejar los warnings es considerado **buena práctica de programación**.

---

### 4.8 Manejo de Warnings

Podemos manejar warnings usando `set_error_handler()` para definir qué función manejará **tanto errores como excepciones**.

#### Definir el manejador de errores

```php path=null start=null
set_error_handler("handleErrors");
```

#### Definición de la función manejadora

```php path=null start=null
function handleErrors($eLevel, $eMessage, $eFile, $eLine) {
    throw new Exception("Error " . $eMessage . " in line " .
        $eLine . " of " . $eFile);
}
```

**Parámetros de la función:**
- `$eLevel`: Nivel del error
- `$eMessage`: Mensaje del error
- `$eFile`: Archivo donde ocurrió el error
- `$eLine`: Línea donde ocurrió el error

#### Restaurar manejo automático

Al final del script, debemos restaurar el manejo automático de excepciones:

```php path=null start=null
restore_error_handler();
```

#### Ejemplo completo

```php path=null start=null
<?php
function handleErrors($eLevel, $eMessage, $eFile, $eLine) {
    throw new Exception("Error " . $eMessage . " in line " .
        $eLine . " of " . $eFile);
    // Both warnings and exceptions will be thrown
}

function anverse($number) {
    $anverseNumber = 1 / $number;
    return $anverseumber;
}

set_error_handler("handleErrors");

try {
    $number = 10;
    echo "<h2>The inverse of $number is " . anverse($number) . "</h2>";
}
catch (Throwable $t) {
    echo "An error {$t->getMessage()} happened<br/>";
}

restore_error_handler();
?>
```

**Resultado:** Ahora los warnings también son capturados por el `catch`.

---

### 4.9 Registro de Errores en Archivo Log

Podemos enviar mensajes de error a un archivo de log personalizado.

#### Consideraciones importantes

- El nombre del archivo **NO debe ser** `error.log` (ya existe y es gestionado por Apache)
- Se puede añadir información adicional:
  - Usuario: `get_current_user()`
  - IP del cliente: `$_SERVER['REMOTE_ADDR']`
  - Fecha: `date()`
  - Otra información disponible

#### Función básica para logging

```php path=null start=null
function handlingErrors($eLevel, $eMessage, $eFile, $eLine) {
    error_log("$eMessage in $eFile, line $eLine",
              3,
              "c:/xampp/apache/logs/user_errors");
}
```

**Parámetros de `error_log()`:**
- Primer parámetro: mensaje a guardar
- Segundo parámetro: `3` = modo append (añadir al final del archivo)
- Tercer parámetro: ruta/nombre del archivo de log

#### Función avanzada con información adicional

```php path=null start=null
function handleErrors($eLevel, $eMessage, $eFile, $eLine) {
    $newMessage = "Date: " . date("H:i d-m-Y ") . $eMessage .
                  " in file " . $eFile . " line " . $eLine .
                  " User: " . get_current_user() . " from IP: " .
                  $_SERVER['REMOTE_ADDR'];
    
    error_log("$newMessage in $eFile, line $eLine",
              3,
              "c:/xampp/apache/logs/user_errors");
}
```

**Ventajas del registro en log:**
- Permite analizar errores posteriormente
- No muestra información sensible al usuario
- Facilita el debugging en producción
- Mantiene un historial de errores

---

### 4.10 Árbol de Excepciones en PHP

Podemos verificar las excepciones disponibles en diferentes versiones de PHP usando scripts específicos.

#### Script para listar excepciones

📚 **Script GitHub:** https://gist.github.com/mlocati/249f07b074a0de339d4d1ca980848e6a

#### Ver output de excepciones

📚 **Output en 3v4l.org:** https://3v4l.org/sDMsv

Este recurso permite ver el árbol de excepciones disponibles en cada versión de PHP.

---

## Ejercicios - Exception Handling

### Ejercicio 1: Función de suma con validación

**Objetivo:** Crear un script que valide parámetros numéricos.

**Requisitos:**
- Crear una función que sume dos números pasados como parámetros
- Dentro de la función, verificar que los parámetros recibidos son números
- Si no son números, lanzar una excepción
- Manejar la excepción en el programa principal

```php path=null start=null
<?php
function sumar($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Los parámetros deben ser numéricos");
    }
    return $a + $b;
}

try {
    echo sumar(5, 10);  // Correcto
    echo sumar(5, "texto");  // Lanzará excepción
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
```

### Ejercicio 2: División con excepción personalizada

**Objetivo:** Crear una clase de excepción personalizada y validar división.

**Requisitos:**
1. Crear una clase que extienda `Exception` y modifique el mensaje mostrado
2. Crear una función que divida dos números pasados como parámetros
3. Dentro de la función, verificar que:
   - Los parámetros recibidos son números
   - El divisor no es cero
4. Si no se cumplen las condiciones, lanzar una excepción
5. Manejar la excepción en el programa principal

```php path=null start=null
<?php
class DivisionException extends Exception {
    public function errorMessage() {
        return "<b>Error en línea {$this->getLine()}</b>: {$this->getMessage()}";
    }
}

function dividir($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new DivisionException("Los parámetros deben ser números");
    }
    if ($b == 0) {
        throw new DivisionException("No se puede dividir por cero");
    }
    return $a / $b;
}

try {
    echo dividir(10, 2);   // Correcto
    echo dividir(10, 0);   // Lanzará excepción
}
catch (DivisionException $e) {
    echo $e->errorMessage();
}
?>
```

---

## Resumen - Exception Handling

✅ Las excepciones ocurren cuando la aplicación no puede completar una tarea  
✅ Usar `try...catch` para capturar y manejar excepciones  
✅ PHP 5: clase `Exception`  
✅ PHP 7/8: clase `Throwable` (más completa, cubre excepciones y errores)  
✅ Métodos útiles: `getMessage()`, `getCode()`, `getFile()`, `getLine()`  
✅ Usar `throw new Exception()` para lanzar excepciones personalizadas  
✅ Crear excepciones personalizadas extendiendo `Exception`  
✅ Los Warnings NO se capturan con `try...catch` (son errores no fatales)  
✅ Usar `set_error_handler()` para manejar warnings como excepciones  
✅ Usar `error_log()` para registrar errores en archivos log personalizados  
✅ Restaurar manejo automático con `restore_error_handler()` al finalizar  
✅ Siempre validar entradas para evitar excepciones inesperadas  
✅ El manejo de excepciones mejora la robustez y UX de la aplicación  
✅ Nunca mostrar errores técnicos al usuario final (seguridad)  
✅ Registrar errores con información contextual (usuario, IP, fecha)

---

## 5. Operador Ternario

### 5.1 Introducción al Operador Ternario

El operador ternario, **`?:`**, es un **operador condicional** que permite escribir condicionales de forma compacta.

### 5.2 Sintaxis

```php path=null start=null
(condicion) ? valor_si_verdadero : valor_si_falso
```

**Componentes:**
- **Condición:** Expresión que se evalúa a `true` o `false`
- **`?`:** Separador entre condición y valor verdadero
- **Valor si verdadero:** Se retorna/asigna si la condición es `true`
- **`:`:** Separador entre valor verdadero y valor falso
- **Valor si falso:** Se retorna/asigna si la condición es `false`

### 5.3 Ejemplo Básico

```php path=null start=null
<?php
$edad = 20;
$mensaje = ($edad >= 18) ? 'Mayor de edad' : 'Menor de edad';
echo $mensaje; // Esto imprimirá "Mayor de edad"
?>
```

**Equivalente con if-else:**

```php path=null start=null
<?php
$edad = 20;
if ($edad >= 18) {
    $mensaje = 'Mayor de edad';
} else {
    $mensaje = 'Menor de edad';
}
echo $mensaje;
?>
```

### 5.4 Cuándo Usar el Operador Ternario

✅ **Usar para:**
- Asignaciones condicionales simples
- Condicionales de una línea
- Valores por defecto

❌ **NO usar para:**
- Lógica extensa o compleja
- Múltiples operaciones
- Cuando dificulta la legibilidad

⚠️ **Importante:** Es una **alternativa** a `if-else` para asignar valores a variables, pero **no es adecuado** para lógica de programación extensa.

### 5.5 Aplicación en Formularios

El operador ternario es especialmente útil para manejar valores de formularios.

#### Verificar si un campo ha sido enviado

```html path=null start=null
<label for="username">Usuario:</label>
<input type="text" id="username" name="username" 
    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
    required>
```

**Explicación del ejemplo:**

1. **Evaluación:** Se verifica si existe `$_POST['username']` usando `isset()`
2. **Si es verdadero:** Se sanitiza el valor con `htmlspecialchars()` y se asigna al campo
3. **Si es falso:** Se asigna una cadena vacía `''`

#### ¿Por qué usar htmlspecialchars()?

**Función:** `htmlspecialchars()` convierte caracteres especiales en entidades HTML.

**Previene:**
- Ataques XSS (Cross-Site Scripting)
- Inyección de código HTML/JavaScript malicioso

**Conversiones comunes:**
- `<` → `&lt;`
- `>` → `&gt;`
- `"` → `&quot;`
- `'` → `&#039;`
- `&` → `&amp;`

### 5.6 Más Ejemplos de Uso

#### Asignación simple

```php path=null start=null
<?php
$usuario_logueado = true;
$saludo = $usuario_logueado ? 'Bienvenido de nuevo' : 'Por favor, inicie sesión';
echo $saludo;
?>
```

#### Valores por defecto

```php path=null start=null
<?php
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : 'Invitado';
echo "Hola, $nombre";
?>
```

#### Operador ternario anidado (NO recomendado)

```php path=null start=null
<?php
$nota = 7;
$resultado = ($nota >= 9) ? 'Sobresaliente' 
           : (($nota >= 7) ? 'Notable' 
           : (($nota >= 5) ? 'Aprobado' : 'Suspenso'));
echo $resultado;
?>
```

⚠️ **Nota:** Los operadores ternarios anidados dificultan la lectura. En estos casos, es mejor usar `if-else` o `switch`.

#### En operaciones aritméticas

```php path=null start=null
<?php
$precio = 100;
$tiene_descuento = true;
$precio_final = $tiene_descuento ? $precio * 0.9 : $precio;
echo "Precio final: $precio_final€";
?>
```

#### En HTML dinámico

```php path=null start=null
<?php
$es_admin = false;
echo $es_admin ? '<a href="panel_admin.php">Panel Admin</a>' : '<p>Acceso denegado</p>';
?>
```

### 5.7 Comparación con Otras Estructuras

| Estructura | Uso recomendado | Legibilidad |
|------------|-----------------|-------------|
| **Operador ternario** | Asignaciones simples | Alta (si es simple) |
| **if-else** | Lógica con múltiples instrucciones | Alta |
| **switch** | Múltiples opciones basadas en un valor | Media-Alta |

### 5.8 Operador de Fusión de Null (Null Coalescing) - PHP 7+

En PHP 7+ existe el operador **`??`** (null coalescing) que simplifica el patrón común con `isset()`:

**Con operador ternario:**
```php path=null start=null
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : 'Invitado';
```

**Con operador de fusión de null:**
```php path=null start=null
$nombre = $_GET['nombre'] ?? 'Invitado';
```

**Ventajas:**
- Más conciso
- Menos propenso a errores
- Específicamente diseñado para valores por defecto

---

## Resumen - Operador Ternario

✅ El operador ternario `?:` es un condicional compacto  
✅ Sintaxis: `(condicion) ? valor_verdadero : valor_falso`  
✅ Alternativa a `if-else` para asignaciones simples  
✅ Muy útil en formularios para preservar valores  
✅ Usar `htmlspecialchars()` para sanitizar datos de formularios  
✅ NO usar para lógica compleja o extensa  
✅ Evitar anidar operadores ternarios (dificulta lectura)  
✅ En PHP 7+, considerar operador `??` para valores por defecto  
✅ Priorizar la legibilidad sobre la brevedad  
✅ Combinar con `isset()` para verificar existencia de variables

---
# Programación Orientada a Objetos con PHP - UD3

## 1. Introducción a la POO

### Características de la POO

- **Herencia (Inheritance)**: Crear una clase desde otra. Hereda comportamiento y características.

- **Abstracción (Abstraction)**: Externamente, la clase solo muestra los métodos (interfaz), no cómo se hacen las cosas.

- **Polimorfismo y Sobrecarga (Polymorphism and Overloading)**: Los métodos pueden tener diferentes comportamientos dependiendo de cómo se usen.

- **Encapsulación (Encapsulation)**: Los datos y el código que los usa están juntos.

### Conceptos básicos

**Properties (Atributos)**: Almacenan información sobre el estado del objeto al que pertenecen. Su valor puede diferir entre objetos de la misma clase.

**Methods (Métodos)**: Contienen código ejecutable y definen las acciones del objeto. Similar a una función, pueden recibir parámetros y devolver valores.

**Instance (Instancia)**: Tener una clase definida y crear un objeto de esa clase se llama instancia de la clase.

### Ventajas de la POO

- **Modularidad**: Permite dividir programas en partes más pequeñas e independientes. Estas partes pueden ser reutilizadas en otros programas.

- **Extensibilidad**: Para extender la funcionalidad de las clases, solo necesita modificarse su código.

- **Mantenimiento**: Gracias a la modularidad, el mantenimiento es más simple. Cada clase debe estar en un archivo diferente.

---

## 2. POO en PHP

### Historia de POO en PHP

- PHP no fue diseñado originalmente para POO.
- Las características de POO se introdujeron en PHP 3 y se mejoraron en PHP 4 y PHP 5.
- PHP ahora soporta todas las características de POO excepto **herencia múltiple** y **sobrecarga de métodos y operadores**.

### Clases

La declaración de una clase se hace usando la palabra clave `class` seguida del nombre de la clase y llaves `{}` que encierran las definiciones de propiedades y métodos.

```php path=null start=null
class Producto {
    private $codigo;
    public $nombre;
    public $PVP;
    
    public function muestra() {
        print "<p>" . $this->codigo . "</p>";
    }
}
```

**Buenas prácticas:**
- Los elementos dentro de la clase deben ordenarse: primero propiedades, luego métodos.
- Los nombres de clase deben comenzar con mayúscula.
- Las clases deben estar en su propio archivo, nombrado `ClassName.inc.php`.

### Instanciar objetos

Para crear una instancia de un objeto, se usa la palabra `new`:

```php path=null start=null
$miProducto = new Producto();
```

Antes de instanciar un objeto, la clase debe estar declarada:

```php path=null start=null
require_once('Producto.inc.php');
```

### Atributos

Para acceder a los atributos y métodos de una clase, se usa el operador `->`:

```php path=null start=null
$miProducto->nombre = 'Samsung Galaxy Note 7';
$miProducto->muestra();
```

#### Niveles de acceso

Dependiendo del nivel de acceso con el que se declara un atributo, puede accederse directamente o a través de un método:

- **public**: puede accederse directamente.
- **private**: solo puede accederse dentro de la clase o a través de un método de clase.
- **protected**: puede accederse desde la clase misma y sus subclases.

```php path=null start=null
class Producto {
    private $codigo;
    public $nombre;
    public $PVP;
}
```

#### Atributos privados

Los atributos privados dan más control sobre los valores que almacenan. Puede ser útil conocer el valor antes de almacenarlo.

```php path=null start=null
private $codigo;

public function setCodigo($nuevo_codigo) {
    if (noExisteCodigo($nuevo_codigo)) {
        $this->codigo = $nuevo_codigo;
        return true;
    }
    return false;
}

public function getCodigo() {
    return $this->codigo;
}
```

#### Métodos mágicos __set y __get

También puedes usar los métodos mágicos `__set` y `__get`:

```php path=null start=null
void __set(string name, mixed value)
mixed __get(mixed name)
```

Si se declaran en una clase, PHP los llamará cuando se intente acceder a un atributo que no existe o no es accesible (private).

```php path=null start=null
class Producto {
    private $nombre;
    private $precio;
    
    public function __set($propiedad, $valor) {
        $this->$propiedad = $valor;
    }
    
    public function __get($propiedad) {
        return $this->$propiedad;
    }
}

$consola = new Producto();
$consola->nombre = "PS5";  // Acceso al método mágico __set
echo $consola->nombre;     // Acceso al método mágico __get
```

### Constantes de clase

Las constantes de clase son comunes a todas las instancias de la clase. Se definen con `const`, su nombre usualmente en **MAYÚSCULAS**, no tiene el símbolo `$`, su valor siempre entre comillas y es público.

Para acceder:
- **Fuera de la clase**: nombre de la clase y operador de resolución de ámbito `::` → `Clase::CONSTANTE` o `$clase::CONSTANTE`
- **Dentro de la clase**: palabra reservada `self` seguida de `::` → `self::CONSTANTE`

```php path=null start=null
class Coche {
    const RUEDAS = '4';
    private $modelo;
    
    // Dentro de la clase
    public function mostrarRuedas() {
        return self::RUEDAS;
    }
}

// Fuera de la clase
echo Coche::RUEDAS;

$miCoche = new Coche();
echo $miCoche::RUEDAS;
```

### Atributos y métodos estáticos

Los atributos y métodos estáticos, también llamados atributos y métodos de clase, no dependen de una instancia del objeto. Dependen de la clase misma.

Se definen con la palabra `static`:

```php path=null start=null
class Producto {
    private static $cantidadProductos = 0;
    
    public static function nuevoProducto() {
        self::$cantidadProductos++;
    }
}

Producto::nuevoProducto();
```

**Características:**
- Los atributos estáticos almacenan información general sobre la clase (ej: número de objetos instanciados).
- Los métodos estáticos realizan tareas específicas sin necesitar crear un objeto.
- No se puede usar `$this` dentro de estos métodos.

### Objeto $this

Cada instancia de un objeto tiene una referencia a sí misma que se usa cuando se invoca un método de ese objeto. Esta referencia está almacenada en la variable `$this`, que solo es accesible desde los métodos del objeto mismo.

```php path=null start=null
class Producto {
    private $codigo;
    
    public function cambiarCodigo($cod) {
        $this->codigo = $cod;
    }
}
```

### Constructor

Los constructores se ejecutan cuando se crea el objeto. Deben llamarse `__construct`.

Solo puede haber un constructor por clase (PHP no soporta sobrecarga de métodos).

```php path=null start=null
class Producto {
    private static $num_productos = 0;
    private $codigo;
    
    public function __construct() {
        self::$num_productos++;
    }
}

$miProducto = new Producto();
```

El constructor puede recibir parámetros:

```php path=null start=null
class Producto {
    private $nombre;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }
}

$miProducto = new Producto('GALAXYS');
```

### Destructor

Se puede definir un método destructor `__destruct` incluido desde PHP5.

Un destructor permite definir las acciones que se ejecutarán cuando se elimine la instancia del objeto.

```php path=null start=null
class Producto {
    private static $cantidadProductos = 0;
    
    public function __construct() {
        self::$cantidadProductos++;
    }
    
    public function __destruct() {
        self::$cantidadProductos--;
    }
}
```

### Usar objetos

#### Verificar tipo de objeto

Puedes verificar de qué clase es un objeto con el operador `instanceof`:

```php path=null start=null
if ($miProducto instanceof Producto) {
    // ...
}
```

#### Funciones útiles

- `get_class`
- `class_exists`
- `get_declared_classes`
- `class_alias`
- `get_class_methods`
- `method_exists`
- `get_class_vars`
- `get_object_vars`
- `property_exists`

#### Copiar objetos

```php path=null start=null
$miProducto = new Producto();
$nuevoProducto = $miProducto;  // Esto NO crea una copia, solo una referencia
```

Para crear una copia real, usa la función `clone`:

```php path=null start=null
$nuevoProducto = clone($miProducto);
```

#### Comparar objetos

Usando los operadores `==` y `===`:

```php path=null start=null
$p = new Producto();
$p->nombre = 'Samsung Galaxy S';
$a = clone($p);
$pCopia = $p;

// $a == $p es true (son copias idénticas)
// $a === $p es false (son objetos diferentes)
// $pCopia === $p es true (son el mismo objeto)
```

### Convertir objeto a string

El método `__toString` indica cómo se comportará el objeto cuando se trate como string:

```php path=null start=null
class Producto {
    private $codigo;
    private $nombre;
    
    public function __toString() {
        return 'Codigo: ' . $this->codigo . '<br>Nombre: ' . $this->nombre;
    }
}

$miProducto = new Producto('Nintendo');
$miProducto->ponerNombre('Wii');

// Las siguientes instrucciones producen el mismo resultado
echo $miProducto->__toString();
echo $miProducto;
```

---

## 3. Herencia

La herencia permite definir clases basadas en otras existentes. Las nuevas clases se llaman **subclases** y las clases base se llaman **superclases**.

```php path=null start=null
class Producto {
    public $codigo;
    public $nombre;
    public $PVP;
    
    public function muestra() {
        echo $this->codigo;
    }
}

class Television extends Producto {
    public $pulgadas;
    public $tecnologia;
}

class Altavoz extends Producto {
    public $potencia;
    public $canales;
}
```

La palabra `extends` indica que la nueva clase está basada en la clase indicada pero también tendrá los atributos indicados en la subclase.

### Funciones útiles para herencia

- `get_parent_class`
- `is_subclass_of`

### Atributos protected

Desde una subclase no se puede acceder a una propiedad o método que es `private` en la superclase. Para ello debe definirse como `protected` en la superclase.

### Sobrescribir métodos

Aunque no hay sobrecarga de métodos, se permite sobrescribir un método en la subclase:

```php path=null start=null
class Television extends Producto {
    public $pulgadas;
    public $tecnologia;
    
    public function muestra() {
        print $this->pulgadas . ' pulgadas';
    }
}
```

### Llamar a métodos de la superclase

Se usa el operador de resolución de ámbito `::` con `parent`:

```php path=null start=null
parent::metodoElegido();
```

Ejemplo:

```php path=null start=null
class TV extends Producto {
    public $pulgadas;
    
    public function __construct($row) {
        parent::__construct($row);
        $this->pulgadas = $row['pulgadas'];
    }
}
```

### Clases y métodos finales

A veces no es interesante que las subclases puedan redefinir el comportamiento de los métodos, o crear subclases. Para esto se usa la palabra `final`:

```php path=null start=null
final class Producto {
    // No se pueden crear subclases
}

public final function ejemplo() {
    // No se puede sobrescribir este método
}
```

### Clases y métodos abstractos

`abstract` indica que esta clase no puede tener objetos instanciados, pero puede usarse como base para una subclase.

```php path=null start=null
abstract class Producto { 
    // ... 
}
```

Si un método se define `abstract` en una superclase, ese método no puede tener código en la superclase y las subclases están obligadas a definir dicho método:

```php path=null start=null
abstract public function prueba();
```

**Nota:** No se puede declarar una clase como `abstract` y `final` al mismo tiempo.

#### Ejemplo de clases abstractas

```php path=null start=null
abstract class Figura {
    protected $color;
    
    public function __set($name, $value) {
        if ($name == 'Color' && is_string($value) === true)
            $this->color = $value;
    }
    
    abstract public function Dibuja();
    abstract public function Area();
}

class Cuadrado extends Figura {
    public function Dibuja() {
        echo 'Dib Cuadrado ' . $this->color;
    }
    
    public function Area() {
        return 0;
    }
}

// Uso
$cuadrado = new Cuadrado();
$cuadrado->Color = 'Negro';  // Usa el __set de Figura
$cuadrado->Dibuja();
```

---

## 4. Interfaces

Una **interfaz** es como una clase vacía que solo contiene declaraciones de métodos vacíos sin código implementado. Se definen con la palabra `interface`. Se usa como plantilla para crear otras clases, de modo que estas clases deben tener definido todo el código para los métodos indicados en la interfaz.

Para que una clase siga esa plantilla, se usa la palabra `implements`:

```php path=null start=null
interface mostrarDatos {
    public function mostrar();
}

class Television extends Producto implements mostrarDatos {
    public function mostrar() {
        // Implementación obligatoria
    }
}
```

### Interfaces vs Clases Abstractas

**Clases abstractas:**
- Sus métodos pueden contener código.
- Si hay código común en varias subclases, se implementa en la clase abstracta.
- Pueden tener atributos.
- No permite herencia múltiple.

**Interfaces:**
- Los métodos proporcionados están vacíos.
- Si hay código común, debe implementarse en todas las clases que implementen la interfaz.
- No pueden tener atributos.
- Una clase puede implementar varias interfaces.

---

## 5. Traits

Los **traits** permiten reutilizar código, reduciendo las limitaciones de la herencia simple.

Son similares a las clases, pero no permiten extender clases, instanciarlas o implementar interfaces. Solo permiten agrupar funcionalidad.

```php path=null start=null
trait Hello {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait World {
    public function sayWorld() {
        echo 'World';
    }
}

class MyHelloWorld {
    use Hello, World;
    
    public function sayExclamationMark() {
        echo '!';
    }
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExclamationMark();
// Resultado: Hello World!
```

### Traits con herencia

```php path=null start=null
class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echo 'World!';
    }
}

class MyHelloWorld extends Base {
    use SayWorld;
}

$o = new MyHelloWorld();
$o->sayHello();
// Resultado: Hello World!
```

---

## Ejercicio de Herencia de Clases

### Diagrama UML

```
                    ┌─────────────────────┐
                    │      Soporte        │
                    ├─────────────────────┤
                    │ +titulo             │
                    │ #numero             │
                    │ -precio             │
                    ├─────────────────────┤
                    │ +getPrecio()        │
                    │ +getPrecioConIva()  │
                    │ +getNumero()        │
                    │ +muestraResumen()   │
                    └─────────────────────┘
                             △
              ┌──────────────┼──────────────┐
              │              │              │
     ┌────────┴────────┐  ┌──┴───────┐  ┌──┴────────────────┐
     │  CintaVideo     │  │   Dvd    │  │      Juego        │
     ├─────────────────┤  ├──────────┤  ├───────────────────┤
     │ -duracion       │  │ +idiomas │  │ +consola          │
     ├─────────────────┤  │ -formato │  │ -minNumJugadores  │
     │+muestraResumen()│  │ Pantalla │  │ -maxNumJugadores  │
     └─────────────────┘  ├──────────┤  ├───────────────────┤
                          │+muestra  │  │+muestraJugadores  │
                          │Resumen() │  │Posibles()         │
                          └──────────┘  │+muestraResumen()  │
                                        └───────────────────┘
```

### Clase Soporte

1. Crear el constructor
2. Crear setters y getters
3. Definir una constante privada llamada 'IVA' con valor 21%

**Código de prueba:**

```php path=null start=null
include "Soporte.php";

$soporte1 = new Soporte("Tenet", 22, 3); 
echo "<strong>" . $soporte1->titulo . "</strong>"; 
echo "<br>Precio: " . $soporte1->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros";
$soporte1->muestraResumen();
```

**Resultado esperado:**
```
Tenet
Precio: 3 euros
Precio IVA incluido: 3.63 euros
Tenet
3 € (IVA no incluido)
```

### Clase CintaVideo

Crear la clase que hereda de Soporte. Añadir el atributo duración y sobrescribir constructor y método muestraResumen.

**Resultado esperado:**
```
Los cazafantasmas
Precio: 3.5 euros
Precio IVA incluido: 4.24 euros
Película en VHS:
Los cazafantasmas
3.5 € (IVA no incluido)
Duración: 107 minutos
```

### Clase Dvd

Crear la clase que hereda de Soporte. Añadir atributos idiomas y formatoPantalla.

**Resultado esperado:**
```
Origen
Precio: 15 euros
Precio IVA incluido: 18.15 euros
Película en DVD:
Origen
15 € (IVA no incluido)
Idiomas: es,en,fr
Formato Pantalla: 16:9
```

### Clase Juego

Crear la clase que hereda de Soporte. Añadir atributos consola, minNumJugadores y maxNumJugadores.

Añadir método `muestraJugadoresPosibles()` que debe mostrar:
- 'Para un jugador'
- 'Para X jugadores'
- 'De X a Y jugadores'

**Resultado esperado:**
```
The Last of Us Part II
Precio: 49.99 euros
Precio IVA incluido: 60.49 euros
Juego para: PS4
The Last of Us Part II
49.99 € (IVA no incluido)
Para un jugador
```

---

## Resumen

- PHP soporta POO desde la versión 3, mejorada en versiones posteriores
- No soporta herencia múltiple ni sobrecarga de operadores
- Usa `->` para acceder a propiedades y métodos
- Usa `::` para elementos estáticos y constantes
- Los niveles de acceso son: public, private, protected
- `$this` referencia al objeto actual
- `self::` para elementos estáticos
- `parent::` para llamar métodos de la superclase
- Traits permiten reutilizar código sin herencia múltiple
- Interfaces definen contratos que las clases deben cumplir
- Clases abstractas pueden tener implementación parcial
# Database access from PHP (MySQL I)

## 1. Acceso a bases de datos desde PHP

### Aplicaciones web dinámicas
La mayoría de las aplicaciones web son **dinámicas**, es decir, las páginas cambian dependiendo de:
- Momento de acceso
- Estado de registro/login del usuario
- Datos consultados

El poder de las aplicaciones web dinámicas reside en el **acceso a una base de datos** que cambia, mostrando contenido diferente según estos factores.

### Soporte de DBMS en PHP
PHP soporta más de **15 DBMS** (Database Management Systems).

#### Evolución histórica:
- **Extensiones nativas**: Históricamente, el acceso a BD se hacía mediante extensiones específicas para cada DBMS
  - Cada DBMS requería su propia extensión instalada en el servidor
  - Cada extensión tenía sus propias funciones y objetos
  - **Problema**: No había compatibilidad entre extensiones

#### PDO (PHP Data Objects)
- Introducido en **PHP 5**
- Permite acceso a diferentes DBMS de la misma forma
- Misma sintaxis incluso si se cambia el DBMS de la aplicación

#### Comparación: Extensiones nativas vs PDO

**Extensiones nativas**:
- ✅ Mayor potencia
- ✅ En algunos casos, mayor velocidad

**PDO**:
- ✅ Conjunto común de funciones
- ✅ Permite cambiar el DBMS sin cambiar la aplicación

---

## 2. MySQL/MariaDB

### Características
- **DBMS relacional** de código abierto
- Licencia **GNU GPL** (también ofrece licencia comercial)
- Creación de **MariaDB** como fork cuando Sun Microsystems compró MySQL
- Usado en múltiples aplicaciones web con PHP y Apache
- **La M de AMP**, XAMPP, WAMPP, LAMPP, MAMPP

### Documentación
https://dev.mysql.com/doc/refman/8.4/en/

### Storage Engines (Motores de almacenamiento)

MySQL tiene varios motores de almacenamiento con diferentes características:

#### **InnoDB** (motor por defecto)
- Proporciona **integridad referencial**
- Soporta **transacciones**

#### **MyISAM**
- Muy rápido
- NO ofrece integridad referencial
- NO soporta transacciones

#### **Memory**
- Crea tablas cuyo contenido se almacena en memoria

### Character Set vs Collation

- **Character set**: Conjunto de símbolos y codificaciones
- **Collation**: Conjunto de reglas para comparar caracteres

#### Recomendaciones:
- **Character set recomendado**: `utf8mb4`
- **Collation recomendada**: `utf8mb4_0900_ai_ci`

```sql
SHOW COLLATION WHERE Charset = 'utf8mb4';
```

### phpMyAdmin

Herramienta de administración web para MySQL incluida en XAMPP.

**URL**: http://localhost/phpmyadmin

**Permite**:
- Crear bases de datos, tablas y relaciones
- Ejecutar sentencias SQL
- Gestionar usuarios y permisos

---

## 3. MySQLi (MySQL Improved)

### Características
- Extensión desarrollada para PHP 4.1.3+
- Incluida desde **PHP 5**
- Ofrece **interfaz dual de programación**

### Interfaz dual: Funciones vs Objetos

#### Uso de funciones:
```php
$conexion = mysqli_connect('localhost', 'usuario', 'contraseña', 'base_de_datos');
echo mysqli_get_server_info($conexion);
```

#### Uso de objetos:
```php
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');
print $conexion->server_info;
```

> **Nota**: Aunque es dual, la variable `$conexion` en ambos casos es un **objeto**.
> Usar notación de objetos produce código más corto y legible.

### Mejoras de MySQLi sobre mysql

- ✅ Interfaz orientada a objetos
- ✅ Soporte de transacciones
- ✅ Soporte de consultas preparadas
- ✅ Mejores opciones de depuración

### Configuración en php.ini

Opciones de configuración MySQLi:

```ini
mysqli.allow_persistent  → Permite conexiones persistentes
mysqli.default_port      → Puerto TCP por defecto
mysqli.reconnect         → Reconectar automáticamente si se pierde la conexión
mysqli.default_host      → Host por defecto (servidor)
mysqli.default_user      → Usuario por defecto
mysqli.default_pw        → Contraseña por defecto
```

---

## 4. MySQLi - Uso práctico

### Estableciendo conexiones

El primer paso es **establecer una conexión** al servidor MySQL. Todas las comunicaciones se hacen desde esa conexión.

Normalmente el servidor web y la BD están en el mismo host (`localhost` o `127.0.0.1`).

#### Constructor de mysqli

Puede recibir **6 parámetros** (normalmente se usan los primeros 4):

1. **Hostname** o IP del servidor MySQL
2. **Username** con permisos de conexión
3. **Password** del usuario
4. **Nombre de la base de datos**
5. Puerto del servidor MySQL
6. Socket o named pipe

#### Formas de conectar a la base de datos "tienda"

```php
// usando llamadas a función
$dwes = mysqli_connect('localhost', 'dwes', 'dwes', 'tienda');

// usando el constructor de clase
$dwes = new mysqli('localhost', 'dwes', 'dwes', 'tienda');

// método alternativo con connect()
$dwes = new mysqli();
$dwes->connect('localhost', 'dwes', 'dwes', 'tienda');
```

### Manejo de errores de conexión

Es importante **verificar que la conexión se estableció** antes de continuar.

#### Propiedades mysqli para errores:
- `connect_errno` → número de error o null
- `connect_error` → mensaje de error o null

#### Ejemplo de manejo de errores:

```php
@$dwes = new mysqli('localhost', 'dwes', 'dwes', 'tienda');

if ($dwes->connect_errno != null) {
    echo 'Error conectando a la base de datos: ';
    echo $dwes->connect_error;
    exit();
}
```

> El carácter `@` suprime los errores de ejecución de PHP en pantalla, evitando mostrar información al usuario.

### Cambio de base de datos

Si necesitas cambiar la BD sobre la que realizar operaciones:

```php
$dwes->select_db('otra_base_de_datos');
```

> El usuario debe tener permisos en la nueva BD.

---

## 5. Consultas SQL

### Tipos de consultas

#### **Control** (no devuelven datos)
- `UPDATE`
- `INSERT`
- `DELETE`

#### **Query** (devuelven datos)
- `SELECT`

### Ejecución de consultas

Método `query()`:

```php
$resultado = $dwes->query('DELETE FROM stock WHERE unidades=0;');
```

**Retorna**:
- Para UPDATE, INSERT, DELETE → `true` o `false`
- Para SELECT → objeto `mysqli_result`

### Comportamiento del método query()

Admite un parámetro opcional (constantes del sistema):

#### `MYSQLI_STORE_RESULT` (opción por defecto)
Los datos se recuperan todos juntos y se almacenan localmente.

```php
$resultado = $dwes->query('SELECT producto, unidades FROM stock;');
```

#### `MYSQLI_USE_RESULT`
Los datos se recuperan del servidor según se necesitan.

```php
$resultado = $dwes->query('SELECT producto, unidades FROM stock;', MYSQLI_USE_RESULT);
```

---

## 6. Consultas que NO devuelven datos (UPDATE, INSERT, DELETE)

Después de ejecutar una consulta de este tipo, se puede observar el **número de registros afectados** usando la propiedad `affected_rows`:

```php
$resultado = $dwes->query('DELETE FROM stock WHERE unidades=0');

if ($resultado) {
    echo 'Se han borrado '. $dwes->affected_rows .' registros.';
}
```

---

## 7. Consultas que DEVUELVEN datos (SELECT)

### Objeto mysqli_result

Si la consulta produce un error → devuelve `FALSE`

Si la consulta es correcta → devuelve un objeto `mysqli_result`

```php
$resultado = $dwes->query('SELECT producto, unidades FROM stock;');

if ($resultado === false) {
    // Manejo de error
}
```

### Verificar registros devueltos

```php
if ($resultado->num_rows == 0) {
    echo 'La consulta no ha devuelto resultados.';
}
```

### Liberar memoria

Los datos obtenidos se mantienen en memoria durante todo el script. Si se hacen varias SELECT, es importante liberar memoria:

```php
$resultado->free();
```

### Métodos para obtener resultados

#### `fetch_all()` - Obtener todos los registros

```php
$stock = $resultado->fetch_all(MYSQLI_NUM);   // array numérico
$stock = $resultado->fetch_all(MYSQLI_ASSOC); // array asociativo
$stock = $resultado->fetch_all(MYSQLI_BOTH);  // ambos (por defecto)
// igual a: $resultado->fetch_all();
```

#### `fetch_array()` - Obtener primera fila

```php
$stock = $resultado->fetch_array(MYSQLI_NUM);   // array numérico
$stock = $resultado->fetch_array(MYSQLI_ASSOC); // array asociativo
$stock = $resultado->fetch_array(MYSQLI_BOTH);  // ambos (por defecto)
```

**Ejemplo**:

```php
$consulta = 'SELECT producto, unidades FROM stock WHERE unidades<2';
$resultado = $dwes->query($consulta);
$stock = $resultado->fetch_array(); // Se obtiene el primer registro

$producto = $stock['producto']; // también $stock[0];
$unidades = $stock['unidades']; // también $stock[1];

echo 'Producto '. $producto .'('. $unidades .' unidades)<br>';
```

#### Métodos equivalentes

**`fetch_row()`** - Array enumerado:
```php
$stock = $resultado->fetch_row();
// equivale a:
$stock = $resultado->fetch_array(MYSQLI_NUM);
```

**`fetch_assoc()`** - Array asociativo:
```php
$stock = $resultado->fetch_assoc();
// equivale a:
$stock = $resultado->fetch_array(MYSQLI_ASSOC);
```

**`fetch_object()`** - Objeto:
```php
$stock = $resultado->fetch_object();
```

**Ejemplo con fetch_object()**:

```php
$consulta = 'SELECT producto, unidades FROM stock WHERE unidades<2';
$resultado = $dwes->query($consulta);

$stock = $resultado->fetch_object(); // retorna el objeto con sus propiedades

while ($stock != null) {
    echo 'Producto '. $stock->producto .'('. $stock->unidades .' unidades)<br>';
    $stock = $resultado->fetch_object();
}
```

---

## 8. Consultas preparadas

### ¿Qué son?

Las consultas preparadas permiten **acelerar el proceso** cuando se debe realizar la misma consulta varias veces.

Se almacenan en el servidor de BD y se ejecutan cuando sea necesario.

### Ventajas

✅ Mayor velocidad para consultas repetidas  
✅ **Previenen ataques de inyección SQL**  
✅ Separan código ejecutable de datos

### Desventaja

⚠️ Su uso no siempre es recomendado, puede sobrecargar el servidor

### Tipos de consultas preparadas

- **Estáticas**: Sin parámetros
- **Dinámicas**: Admiten parámetros

### Consultas preparadas estáticas

```php
$dwes = new mysqli('localhost', 'dwes', 'dwes', 'tienda');

$consulta = $dwes->stmt_init(); // inicializa y retorna mysqli_stmt
$consulta->prepare('INSERT INTO familia (cod, nombre) VALUES ("TABLET", "iPad");');
$consulta->execute();
$consulta->close();

$dwes->close();
```

### Consultas preparadas con bind_param()

#### Tipos de datos:
- `i` → integer
- `d` → float
- `s` → string
- `b` → contenido en formato binario (BLOB)

#### Ejemplo:

```php
$dwes = new mysqli('localhost', 'dwes', 'dwes', 'tienda');

$consulta = $dwes->stmt_init();
$consulta->prepare('INSERT INTO familia (cod, nombre) VALUES (?, ?);');

$cod_producto = "TABLET";
$nombre_producto = "iPad";

$consulta->bind_param('ss', $cod_producto, $nombre_producto);
$consulta->execute();
$consulta->close();

$dwes->close();
```

> ⚠️ **IMPORTANTE**: Con consultas preparadas **solo se pueden usar variables**, NO valores literales.

```php
// ✅ CORRECTO
$consulta->bind_param('ss', $cod_producto, $nombre_producto);

// ❌ INCORRECTO
$consulta->bind_param('ss', 'TABLET', 'iPAD');
```

### bind_result() para SELECT

```php
$dwes = new mysqli('localhost', 'dwes', 'dwes', 'tienda');

$consulta = $dwes->stmt_init();
$consulta->prepare('SELECT producto, unidades FROM stock WHERE unidades<2');
$consulta->execute();

$consulta->bind_result($producto, $unidades);

while($consulta->fetch()) {
    echo "Producto '. $producto .'('. $unidades .' unidades.<br>';
}

$consulta->close();
$dwes->close();
```

---

## 9. Transacciones

### ¿Qué son?

Las transacciones son un **conjunto de consultas que deben ejecutarse en bloque**.

- Si alguna consulta falla → se deshacen todas las anteriores
- **Todo o nada**

### Requisitos

El motor de almacenamiento de la tabla debe soportar transacciones → **InnoDB**

### Comportamiento por defecto con InnoDB

Cada consulta individual está incluida dentro de su propia transacción automática.

### Desactivar autocommit

```php
$dwes->autocommit(false);
```

Todas las consultas después de esta instrucción formarán parte de una transacción.

### Finalizar transacciones manualmente

#### `commit()` 
Todas las consultas se ejecutaron correctamente → guardar cambios

#### `rollback()`
Alguna consulta falló → deshacer cambios

### Ejemplo sin try-catch

```php
$todo_bien = true;
$dwes->autocommit(false); // inicio de transacción

$sql = 'UPDATE stock SET unidades=1 WHERE producto="3DSNG" AND tienda=1;';
$todo_bien = $dwes->query($sql);

if ($todo_bien) {
    $sql = 'INSERT INTO stock (producto, tienda, unidades) VALUES ("3DSNG", 3, 1);';
    $todo_bien = $dwes->query($sql);
}

if ($todo_bien) {
    $dwes->commit();
} else {
    $dwes->rollback();
}

$dwes->autocommit(true); // fin de transacción
```

### Uso de try-catch

PHP no lanza excepciones automáticamente, pero podemos usar bloques `try-catch` para crear transacciones con código más legible.

```php
$dwes->autocommit(false);

try {
    $sql = 'UPDATE stock SET unidades=1 WHERE producto="3DSNG" AND tienda=1;';
    if(!$dwes->query($sql))
        throw new Exception('Error update', 1);
    
    $sql = 'INSERT INTO stock (producto, tienda, unidades) VALUES ("3DSNG", 3, 1);';
    if(!$dwes->query($sql))
        throw new Exception('Error insert', 1);
    
    $dwes->commit();
}
catch (Exception $e) {
    $dwes->rollback();
    print_r($e);
}
```

### Versión simplificada con try-catch

```php
$dwes->autocommit(false);

try {
    $sql = 'UPDATE stock SET unidades=1 WHERE producto="3DSNG" AND tienda=1;';
    if(!$dwes->query($sql))
        throw new Exception('Error update', 1);
    
    $sql = 'INSERT INTO stock (producto, tienda, unidades) VALUES ("3DSNG", 3, 1);';
    if(!$dwes->query($sql))
        throw new Exception('Error insert', 1);
    
    $dwes->commit();
}
catch (Exception $e) {
    $dwes->rollback();
    print_r($e);
}
```

---

## Ejercicio práctico: Tienda Virtual

### Configuración inicial

1. **Crear base de datos "tienda"** usando phpMyAdmin
   - Volcar estructura: `crear_db_tienda.sql`
   - El script crea el usuario: `dwes` con contraseña: `dwes`
   - Volcar datos: `datos_tienda.sql`

2. **Crear virtualhost "store"** (store.local)
   - Carpeta: `htdocs/store`

### Funcionalidad

#### index.php (o main.php)
- Mostrar lista de productos
- Cada producto es un enlace a `stock.php`

#### stock.php
- Recibe el ID del producto
- Muestra el stock del producto en cada tienda
- Permite **modificar la cantidad de stock**
- Los datos se envían al mismo `stock.php`

### Implementación de actualización de stock

- Crear consulta preparada para actualizar unidades
- Ejecutar la consulta tantas veces como tiendas existan
- **Usar transacción** para actualizar las unidades

---

## Resumen de conceptos clave

### Conexión
```php
$dwes = new mysqli('localhost', 'usuario', 'password', 'basedatos');
```

### Consultas sin retorno
```php
$dwes->query('UPDATE ...');
echo $dwes->affected_rows;
```

### Consultas con retorno
```php
$resultado = $dwes->query('SELECT ...');
while($fila = $resultado->fetch_assoc()) {
    // procesar fila
}
```

### Consultas preparadas
```php
$stmt = $dwes->stmt_init();
$stmt->prepare('SELECT * FROM tabla WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
```

### Transacciones
```php
$dwes->autocommit(false);
try {
    // consultas
    $dwes->commit();
} catch (Exception $e) {
    $dwes->rollback();
}
```

---

# Database access from PHP (MySQL II)

## 1. PHP Data Objects (PDO)

### ¿Qué es PDO?

PDO es una **clase que ofrece un conjunto de propiedades y métodos** para realizar operaciones sobre bases de datos.

- Un objeto PDO (instancia de la clase) representa una **conexión a la base de datos**
- Ofrece una **capa de abstracción de acceso a datos**
- Permite usar los mismos mecanismos para realizar consultas **independientemente de la base de datos utilizada**

### Ventajas de PDO sobre MySQLi

#### MySQLi
- ✅ Buena opción para trabajar con bases de datos MySQL
- ❌ Si se cambia el DBMS en el futuro, se debe reprogramar gran parte del código

#### PDO
- ✅ Capa de abstracción que permite cambiar de DBMS sin reprogramar
- ✅ Mismos métodos y funciones independientemente del motor de base de datos
- ⚠️ Es necesario evaluar si es posible que se cambie el DBMS en el futuro

---

## 2. Establecer conexión con PDO

### Constructor de PDO

Se debe instanciar un objeto PDO usando su **constructor**.

#### Parámetros del constructor:

1. **DSN (Data Source Name)** [OBLIGATORIO]: Cadena de texto que indica el driver y parámetros específicos
2. **Usuario** con permisos en la base de datos
3. **Contraseña** del usuario
4. **Opciones de conexión** (array)

### Sintaxis básica

```php
$dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'dwes');
```

### Componentes del DSN

El DSN se compone de:

#### PDO Driver
El driver específico para el DBMS (mysql, pgsql, sqlite, etc.)

#### Cadena de conexión PDO
Incluye:
- **host**: nombre del servidor o IP
- **port**: puerto TCP del servidor (opcional)
- **dbname**: nombre de la base de datos
- **unix_socket**: socket MySQL en sistemas UNIX (no se usa si se especifica 'port')

#### Ejemplos de DSN:

```php
// Con host y puerto
mysql:host=hostname;port=3309;dbname=dbname

// Con unix socket
mysql:unix_socket=/tmp/mysql.sock;dbname=dbname
```

---

## 3. Opciones de conexión

### Configurar codificación UTF-8

Ejemplo típico para usar codificación UTF-8 en todos los datos transmitidos:

```php
$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'dwes', $opc);
```

### Manejo de excepciones

El constructor de PDO **lanza una excepción en caso de error**:

```php
$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try {
    $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'dwes', $opc);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}
```

---

## 4. Métodos getAttribute y setAttribute

### getAttribute() - Obtener información

Permite obtener información del estado de la conexión:

```php
$version = $dwes->getAttribute(PDO::ATTR_SERVER_VERSION);
echo 'Versión: '. $version;
```

### setAttribute() - Modificar parámetros

Permite modificar parámetros de la conexión:

```php
// Configurar nombres de campos en mayúsculas
$estado = $dwes->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
```

---

## 5. Consultas que NO devuelven datos (INSERT, DELETE, UPDATE)

### Diferencias con MySQLi

- En **MySQLi**: todas las consultas se ejecutan igual
- En **PDO**: hay que diferenciar si la consulta devuelve datos o no

### Método exec()

Para consultas INSERT, DELETE y UPDATE se usa el método `exec()`, que **retorna el número de filas afectadas**:

```php
$registros = $dwes->exec('DELETE FROM stock WHERE unidades=0;');
echo 'Se han borrado .' $registros .' registros';
```

---

## 6. Consultas que SÍ devuelven datos (SELECT)

### Método query()

Para ejecutar consultas SELECT se usa el método `query()`.

**Retorna**: un objeto de la clase `PDOStatement`

```php
$resultado = $dwes->query('SELECT producto, unidades FROM stock;');
```

### Método fetch() - Acceder a los datos

El método `fetch()` retorna:
- El **siguiente registro** si existe
- `false` si no hay más registros

```php
while ($registro = $resultado->fetch()) {
    echo 'Producto '. $registro['producto'];
    echo ' ('. $registro['unidades'] .' unidades)<br>';
}
```

### Modos de fetch()

Por defecto, `fetch()` retorna un array con **claves numéricas y asociativas**.

Se puede cambiar con un parámetro opcional:

- **PDO::FETCH_BOTH** - Array con índices numéricos y asociativos (por defecto)
- **PDO::FETCH_ASSOC** - Array asociativo
- **PDO::FETCH_NUM** - Array numérico
- **PDO::FETCH_OBJECT** - Objeto con propiedades

#### Ejemplo:

```php
while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    // instrucciones
}
```

---

## 7. Consultas preparadas con PDO

### Consultas preparadas que NO devuelven datos

Hay **dos opciones** para vincular parámetros:

#### Opción 1: Marcadores posicionales (?)

```php
$dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'dwes');
$cod_producto = "TABLET";
$nombre_producto = "Tablet PC";

$consulta = $dwes->prepare('INSERT INTO familia (cod, nombre) VALUES (?, ?);');
$consulta->bindParam(1, $cod_producto);
$consulta->bindParam(2, $nombre_producto);
$consulta->execute();
```

#### Opción 2: Marcadores con nombre (:nombre)

```php
$dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'dwes');
$cod_producto = "TABLET";
$nombre_producto = "Tablet PC";

$consulta = $dwes->prepare('INSERT INTO familia (cod, nombre) VALUES (:cod, :nombre);');
$consulta->bindParam(':cod', $cod_producto);
$consulta->bindParam(':nombre', $nombre_producto);
$consulta->execute();
```

### Consultas preparadas que SÍ devuelven datos

```php
$dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'dwes');

$consulta = $dwes->prepare('SELECT nombre, precio FROM productos WHERE precio>:prec');
$consulta->bindParam(':prec', $prec);
$consulta->execute(); // Devuelve true/false según se ejecute con éxito o no

while(($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) != null) {
    echo $resultado['nombre'] .'(pvp: '. $resultado['precio'] .')<br>';
}
```

---

## 8. Transacciones en PDO

### Estructura básica

```php
$ok = true;

$dwes->beginTransaction(); // Retorna true o false según cambie el modo o no

if($dwes->exec($consulta1) == 0)
    $ok = false;
    
if($dwes->exec($consulta2) == 0)
    $ok = false;
    
// ...

if($dwes->exec($consultaN) == 0)
    $ok = false;

if ($ok)
    $dwes->commit();   // Si todo fue bien, confirmar los cambios
else
    $dwes->rollback(); // Si no, revertirlos

// Después de commit o rollback, el DBMS retorna al modo autocommit
```

### Métodos de transacción:

- **beginTransaction()** - Inicia la transacción
- **commit()** - Confirma los cambios si todo salió bien
- **rollback()** - Revierte los cambios si hubo algún error

---

## 9. Redirecciones en PHP

### Función header()

Las redirecciones en PHP se realizan con el comando `header()`:

```php
header('Location: http://discografia.local/index.php');
header('Location: '.$nuevaURL.php);
```

### Consideraciones importantes

⚠️ **Header debe ser llamado ANTES de enviar cualquier salida**

⚠️ **Añadir `die` o `exit`** para asegurar que el código posterior no se ejecute:

```php
<?php
header("Location: http://www.example.com/"); 
exit;
?>
```

---

## 10. Ejercicio práctico: Discografía

### Configuración inicial

1. **Crear virtualhost** `discografia.local`
   - Directorio raíz: `htdocs/discografia`

2. **Crear base de datos** `discografia`
   - Usuario: `discografia` con permisos en la BD

### Esquema de la base de datos

#### Tabla Álbum
- código: entero(7) vnn
- título: cadena(50) vnn
- discográfica: cadena(25) vnn
- formato: **enum** vnn
- fechaLanzamiento: fecha
- fechaCompra: fecha
- precio: numérico(5,2)
- **C.P. (código)** - Clave primaria

#### Tabla Canción
- título: cadena(50) vnn
- álbum: entero(7) vnn
- posición: entero(2)
- duración: tiempo
- género: **enum**
- **C.P. (título, álbum)** - Clave primaria compuesta
- **C.Aj. (álbum -> Álbum.codigo)** - Clave ajena

#### Valores enum:

**formato**:
- vinilo
- cd
- dvd
- mp3

**género**:
- Clásica
- BSO
- Blues
- Electrónica
- Jazz
- Metal
- Pop
- Rock

### Funcionalidad requerida

#### index.php
- Mostrar lista de todos los álbumes de la base de datos
- Cada álbum debe ser un enlace a `album.php`
- Opción para **añadir un nuevo disco** → `albumnuevo.php`
- Opción para **buscar canciones** → `canciones.php`

#### album.php
- Recibe el código del álbum como parámetro
- Muestra **todas las canciones del álbum**
- Muestra **toda la información del álbum**
- Dos opciones adicionales:
  1. **Añadir canciones** → `cancionnueva.php`
  2. **Borrar álbum y canciones** → `borraralbum.php`

#### cancionnueva.php
- Formulario para ingresar canciones
- En el encabezado debe informar a qué álbum se está añadiendo la canción
- El mismo archivo recibe la información del formulario
- Guarda los datos en la base de datos
- Después de guardar: informa del éxito y muestra el formulario nuevamente

#### borraralbum.php
- Borra el disco y todas sus canciones
- **Usar una transacción**
- Si hay error: retornar a la página del disco e informar del error
- Si se completa correctamente: retornar a la página principal informando de la eliminación

#### albumnuevo.php
- Formulario para insertar discos
- El mismo archivo recibe la información del formulario
- Guarda los datos en la base de datos
- Después de guardar: redirigir a la página principal e informar que el disco se creó correctamente
- Si ocurre error: informar en la misma página `albumnuevo.php`

#### canciones.php
- Formulario que permite buscar canciones
- Texto a buscar: campo de entrada
- Buscar en:
  - Títulos de canción (radio button)
  - Nombres de álbum (radio button)
  - Ambos campos (radio button)
- Género musical: selector desplegable
- El mismo archivo recibe la información del formulario
- Muestra las canciones encontradas

### Requisitos técnicos

✅ **Todas las conexiones a la base de datos con PDO**

✅ **Manejar todas las excepciones**

✅ **Reportar todos los errores**

---

## Resumen PDO vs MySQLi

| Característica | MySQLi | PDO |
|----------------|--------|-----|
| **Soporte de BD** | Solo MySQL | Múltiples DBMS |
| **Abstracción** | No | Sí |
| **Conexión** | `new mysqli()` | `new PDO()` |
| **Consultas sin datos** | `query()` retorna true/false | `exec()` retorna filas afectadas |
| **Consultas con datos** | `query()` retorna mysqli_result | `query()` retorna PDOStatement |
| **Obtener resultados** | `fetch_assoc()`, `fetch_object()` | `fetch(PDO::FETCH_ASSOC)` |
| **Consultas preparadas** | `stmt_init()`, `prepare()` | `prepare()` |
| **Parámetros** | `bind_param('ss', $v1, $v2)` | `bindParam(':nombre', $var)` |
| **Transacciones** | `autocommit(false)`, `commit()`, `rollback()` | `beginTransaction()`, `commit()`, `rollback()` |
| **Excepciones** | No por defecto | Sí en el constructor |
```
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

Perfecto, Alex. Aquí tienes los apuntes de la unidad 6 (Subida y gestión de archivos) con la misma estructura clara y detallada que los de la unidad 5:

---

# 📁 Subida y gestión de archivos – UD 6 DWES

## 1. Subida de archivos al servidor

### Requisitos del formulario

- Método de envío: `POST`
- Atributo obligatorio: `enctype="multipart/form-data"`
- El servidor tiene un **límite de tamaño** configurado
- Los archivos se almacenan en un **directorio temporal** y se eliminan al finalizar el script

### Ejemplo de formulario

```html
<form action="subida.php" method="post" enctype="multipart/form-data">
  Selecciona el archivo a subir:
  <input type="file" name="archivo" id="archivo">
  <input type="submit" value="Enviar">
</form>
```

- Para subir varios archivos: se necesita un campo `input` por cada archivo

### Configurar tamaño máximo

- En `php.ini`:
  ```ini
  upload_max_filesize = 2M
  ```
- En el formulario:
  ```html
  <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
  ```

⚠️ El valor de `MAX_FILE_SIZE` no puede superar el de `upload_max_filesize`

---

## 2. Acceso a archivos subidos

### Superglobal $_FILES

- Contiene un array por cada archivo subido
- Cada elemento incluye:
  - `tmp_name`: ruta temporal en el servidor
  - `name`: nombre original del archivo
  - `size`: tamaño en bytes
  - `type`: tipo MIME
  - `error`: código de error (`UPLOAD_ERR_OK` si fue exitoso)

### Ejemplo de acceso

```php
echo $_FILES['archivo']['tmp_name'];
```

---

## 3. Problemas comunes

- Sin permisos en `upload_tmp_dir`
- `memory_limit` menor que `upload_max_filesize`
- `max_execution_time` demasiado bajo
- `post_max_size` menor que `upload_max_filesize`

---

## 4. Seguridad

### Validar errores

```php
switch ($_FILES['upfile']['error']) {
  case UPLOAD_ERR_OK:
    break;
  case UPLOAD_ERR_NO_FILE:
    throw new RuntimeException('No file sent.');
  case UPLOAD_ERR_INI_SIZE:
  case UPLOAD_ERR_FORM_SIZE:
    throw new RuntimeException('Exceeded filesize limit.');
  default:
    throw new RuntimeException('Unknown errors.');
}
```

### Validar tipo MIME

```php
if ($_FILES['imagen']['type'] != 'image/gif') {
  echo 'Error: No se trata de un fichero GIF.';
  exit();
}
```

### Validar con finfo

```php
$finfo = new finfo(FILEINFO_MIME_TYPE);
$ext = array_search(
  $finfo->file($_FILES['upfile']['tmp_name']),
  ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'],
  true
);
if ($ext === false) {
  throw new RuntimeException('Invalid file format.');
}
```

### Verificar subida real

```php
if (is_uploaded_file($_FILES['archivo_usuario']['tmp_name'])) {
  echo "Archivo " . $_FILES['archivo_usuario']['name'] . " subido con éxito.\n";
  readfile($_FILES['archivo_usuario']['tmp_name']);
} else {
  echo "Posible ataque: " . $_FILES['archivo_usuario']['tmp_name'];
}
```

### Mover archivo

```php
$uploads_dir = '/uploads';
foreach ($_FILES["pictures"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
    $name = basename($_FILES["pictures"]["name"][$key]);
    move_uploaded_file($tmp_name, "$uploads_dir/$name");
  }
}
```

---

## 5. Funciones del sistema de archivos

Funciones útiles para trabajar con archivos:

- `delete`
- `realpath(__FILE__)`
- `dirname`
- `is_dir`
- `rename`
- `mkdir`
- `rmdir`

---

## 6. Procesamiento de imágenes

### Modificaciones posibles

- Añadir marca de agua
- Crear versiones con:
  - `imagescale`
  - `imagecopyresized`

📌 Se pueden aplicar tanto al archivo temporal como al definitivo

---

## 7. Almacenamiento en base de datos

### Guardar como BLOB

- Se pueden guardar archivos como datos binarios en la base de datos

### Desventajas

- Consultas lentas
- Difícil recuperación
- Baja compatibilidad entre SGBD
- Sobrecarga del servidor

### Ventajas

- Mayor seguridad
- Útil si no hay permisos en el sistema de archivos

✅ Lo habitual es guardar archivos en directorios

---

## Ejercicio práctico: Registro de usuario con imagen

### Requisitos

1. Formulario de registro con imagen de perfil
2. Página de perfil para usuario autenticado
3. Validaciones:
   - Tipo permitido: `png` o `jpg`
   - Tamaño máximo: `360x480px`
4. Guardar dos versiones:
   - `idUserBig.png` (360x480px)
   - `idUserSmall.png` (72x96px)
5. Directorio de imágenes: `/img/users/$username`
6. Guardar rutas en campos separados en la tabla `users`
