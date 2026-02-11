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
