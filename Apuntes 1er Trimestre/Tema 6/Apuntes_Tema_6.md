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
