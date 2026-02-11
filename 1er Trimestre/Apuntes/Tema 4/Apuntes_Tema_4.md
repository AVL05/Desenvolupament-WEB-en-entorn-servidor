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
