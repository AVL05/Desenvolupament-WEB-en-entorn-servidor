# Sistema de Registro de Usuarios con Gestión de Imágenes

Aplicación web PHP que permite el registro de usuarios con imagen de perfil, incluyendo validación y procesamiento automático de imágenes en dos tamaños.

## 📋 Características

- **Registro de usuarios** con imagen de perfil obligatoria
- **Validación de imágenes**:
  - Solo acepta PNG y JPG
  - Tamaño máximo: 360x480px
  - Verificación de tipo MIME
- **Procesamiento automático de imágenes**:
  - Versión grande: 360x480px (para página de perfil)
  - Versión pequeña: 72x96px (para cabecera)
  - Mantiene proporciones originales
- **Sistema de autenticación** con sesiones
- **Página de perfil** que muestra todos los datos del usuario
- **Almacenamiento seguro** en base de datos y sistema de archivos

## 🛠️ Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Extensión PHP GD (para procesamiento de imágenes)
- Servidor web (Apache, Nginx, etc.)

## 📦 Instalación

### 1. Configurar la base de datos

Ejecuta el script SQL para crear la base de datos y la tabla:

```bash
mysql -u root -p < database.sql
```

O importa manualmente el archivo `database.sql` desde phpMyAdmin.

### 2. Configurar conexión a la base de datos

Edita el archivo `config.php` y ajusta los parámetros de conexión:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'user_profiles_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Crear directorio de imágenes

Crea el directorio para almacenar las imágenes de usuario:

```bash
mkdir -p img/users
chmod 755 img/users
```

### 4. Configurar servidor web

Asegúrate de que el servidor web tenga permisos de escritura en el directorio `img/users/`.

## 📁 Estructura del proyecto

```
├── config.php              # Configuración y conexión a BD
├── functions.php           # Funciones auxiliares
├── database.sql            # Script SQL de creación de BD
├── index.php              # Página de inicio (redireccionamiento)
├── register.php           # Formulario de registro
├── login.php              # Formulario de login
├── profile.php            # Página de perfil del usuario
├── logout.php             # Cerrar sesión
├── img/
│   └── users/
│       └── [username]/    # Directorio por usuario
│           ├── [username]Big.png/jpg    # Imagen 360x480px
│           └── [username]Small.png/jpg  # Imagen 72x96px
└── README.md
```

## 🚀 Uso

### Registrar un nuevo usuario

1. Accede a `register.php`
2. Completa el formulario:
   - Nombre de usuario
   - Email
   - Contraseña
   - Imagen de perfil (PNG o JPG, máx. 360x480px)
3. Haz clic en "Registrarse"

### Iniciar sesión

1. Accede a `login.php`
2. Ingresa tu nombre de usuario y contraseña
3. Serás redirigido a tu página de perfil

### Ver perfil

Una vez autenticado, verás:
- Tu imagen de perfil en tamaño grande (360x480px) en la página de perfil
- Tu imagen de perfil en tamaño pequeño (72x96px) en la cabecera
- Todos tus datos: username, email, ID, fecha de registro
- Las rutas donde se almacenan tus imágenes

## 🔒 Seguridad

La aplicación implementa las siguientes medidas de seguridad:

- **Validación de tipo MIME** usando `finfo`
- **Verificación de archivo subido** con `is_uploaded_file()`
- **Movimiento seguro de archivos** con `move_uploaded_file()`
- **Hash de contraseñas** con `password_hash()` y `password_verify()`
- **Prepared statements** para prevenir SQL injection
- **Escapado de HTML** para prevenir XSS
- **Validación de dimensiones de imagen**
- **Protección de sesiones**

## 📝 Características del ejercicio implementadas

✅ Formulario de registro con imagen de perfil  
✅ Validación de tipo de imagen (PNG o JPG)  
✅ Validación de tamaño máximo (360x480px)  
✅ Creación de dos versiones de la imagen:
   - 360x480px para la página de perfil
   - 72x96px para mostrar junto al username
✅ Nombres de archivo: `idUserBig.png` y `idUserSmall.png` (usando username como id)  
✅ Directorio de almacenamiento: `/img/users/$username`  
✅ Rutas guardadas en campos separados de la base de datos  
✅ Página de login  
✅ Página de perfil con todos los datos del usuario

## ⚙️ Configuración avanzada

### Cambiar tamaños de imagen

Edita las constantes en `config.php`:

```php
define('BIG_IMAGE_WIDTH', 360);
define('BIG_IMAGE_HEIGHT', 480);
define('SMALL_IMAGE_WIDTH', 72);
define('SMALL_IMAGE_HEIGHT', 96);
```

### Cambiar tamaño máximo de archivo

Edita en `config.php`:

```php
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
```

Y también en `php.ini`:

```ini
upload_max_filesize = 5M
post_max_size = 6M
```

## 🐛 Solución de problemas

### Error: "No se pudo crear el directorio del usuario"

Verifica que el directorio `img/users` tiene permisos de escritura:

```bash
chmod 755 img/users
```

### Error: "Call to undefined function imagecreatefromjpeg()"

Instala la extensión GD de PHP:

```bash
# Ubuntu/Debian
sudo apt-get install php-gd

# CentOS/RHEL
sudo yum install php-gd
```

Reinicia el servidor web después de la instalación.

### Las imágenes no se muestran

Verifica que:
1. El directorio `img/users/` existe y tiene permisos correctos
2. Las rutas en la base de datos son correctas
3. El servidor web puede acceder a los archivos

## 📚 Funciones principales

### `processUploadedImage($file, $username)`
Procesa y guarda la imagen subida en dos tamaños diferentes.

### `validateFileType($tmpName)`
Valida que el archivo sea PNG o JPG usando el tipo MIME.

### `validateImageDimensions($tmpName)`
Verifica que la imagen no exceda el tamaño máximo permitido.

### `resizeImage($sourceImage, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight)`
Redimensiona una imagen manteniendo la proporción original.

## 👤 Autor

Ejercicio desarrollado para la asignatura DWES UD6 - File upload and management.

## 📄 Licencia

Este proyecto es de uso educativo.
