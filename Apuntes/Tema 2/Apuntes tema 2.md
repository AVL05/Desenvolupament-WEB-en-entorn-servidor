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
