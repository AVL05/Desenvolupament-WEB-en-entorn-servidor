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
