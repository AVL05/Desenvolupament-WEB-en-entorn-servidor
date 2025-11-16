# Funcionalidad de Portadas de Álbumes

## Descripción
Se ha implementado la funcionalidad para que cada álbum tenga una portada siguiendo las directrices del documento **UD 6 File upload and management (1).pdf**.

## Cambios Realizados

### 1. Base de Datos
Se ha agregado el campo `portada` a la tabla `album`:

```sql
ALTER TABLE album 
ADD COLUMN portada VARCHAR(255) DEFAULT '' AFTER precio;
```

**Ejecutar el script:** `add_portada_field.sql`

### 2. Clase Album (`album.ini.php`)
- Agregada propiedad privada `$portada`
- Agregados métodos `getPortada()` y `setPortada()`
- Actualizado constructor para aceptar parámetro `$portada`
- Modificado método `registrarDisco()` para guardar la ruta de la portada

### 3. Formulario de Registro (`datos.ini.php` - función `formularioDisco()`)
- Agregado `enctype="multipart/form-data"` al formulario
- Agregado campo `<input type="file">` para subir la portada
- Agregado campo hidden `MAX_FILE_SIZE` para limitar tamaño de archivo
- Restricción de tipos de archivo: solo JPG y PNG mediante atributo `accept`

### 4. Procesamiento de Subida de Archivos
Implementada lógica de validación siguiendo el PDF:

#### Validaciones de Seguridad:
- ✅ Verificación de `$_FILES['portada']['error']` (UPLOAD_ERR_OK)
- ✅ Validación de tipo MIME usando `finfo(FILEINFO_MIME_TYPE)`
- ✅ Verificación con `is_uploaded_file()`
- ✅ Uso de `move_uploaded_file()` para mover el archivo de forma segura
- ✅ Solo se permiten tipos: `image/jpeg` y `image/png`

#### Manejo de Errores:
- Error de tamaño excedido (UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE)
- Tipo de archivo no permitido
- Posibles ataques de archivo

### 5. Almacenamiento
- **Directorio:** `img/portadas/`
- **Nombre de archivo:** `[titulo_album]_[timestamp].[extension]`
- La carpeta se crea automáticamente si no existe
- La ruta se guarda en la base de datos

### 6. Visualización de Portadas

#### Lista de Álbumes (`datosDiscografia()`)
- Nueva columna "Portada" en la tabla
- Muestra miniatura de 80x80px
- Texto "Sin portada" si no existe imagen

#### Detalle del Álbum (`datosDisco()`)
- Portada grande (máximo 300x300px) centrada arriba de los datos
- Bordes decorativos

## Instrucciones de Instalación

### Paso 1: Actualizar Base de Datos
Ejecuta el script SQL en tu base de datos MySQL:

```bash
mysql -u root -p discografia < add_portada_field.sql
```

O ejecuta manualmente desde phpMyAdmin o MySQL Workbench.

### Paso 2: Crear Directorio de Imágenes
El directorio `img/portadas/` se crea automáticamente, pero puedes crearlo manualmente:

```bash
mkdir -p img/portadas
chmod 777 img/portadas
```

### Paso 3: Verificar Configuración PHP
Asegúrate de que tu `php.ini` tiene configuraciones adecuadas:

```ini
upload_max_filesize = 2M
post_max_size = 3M
memory_limit = 128M
```

## Uso

### Crear Nuevo Álbum con Portada
1. Ve a "Nuevo disco"
2. Rellena los datos del álbum
3. Selecciona una imagen JPG o PNG para la portada
4. Haz clic en "Registrar"

### Ver Portadas
- **Lista principal:** Las portadas aparecen como miniaturas en la primera columna
- **Detalle del álbum:** La portada se muestra en grande arriba de los datos

## Notas Técnicas

### Tipos de Archivo Permitidos
- JPG/JPEG (`image/jpeg`)
- PNG (`image/png`)

### Tamaño Máximo
- 2 MB (configurable en el campo hidden MAX_FILE_SIZE)

### Seguridad
La implementación sigue las mejores prácticas del PDF:
1. Validación de tipo MIME real (no solo extensión)
2. Verificación de archivo subido correctamente
3. Uso de funciones seguras de PHP
4. Sanitización del nombre de archivo

### Estructura de Archivos
```
discografia/
├── album.ini.php (modificado)
├── datos.ini.php (modificado)
├── add_portada_field.sql (nuevo)
├── README_PORTADAS.md (nuevo)
└── img/
    └── portadas/ (se crea automáticamente)
        └── [archivos de portada]
```

## Problemas Comunes

### Error: "No se pudo subir la portada"
- Verifica permisos del directorio `img/portadas/` (debe ser 777 o 755)
- Verifica que el directorio existe

### Error: "Tipo de archivo no permitido"
- Solo se aceptan archivos JPG y PNG
- Verifica que el archivo no esté corrupto

### Las portadas no se muestran
- Verifica que la ruta en la BD es correcta
- Verifica que el archivo existe en `img/portadas/`
- Verifica permisos de lectura del archivo

## Referencias
- **Documento:** UD 6 File upload and management (1).pdf
- **Funciones PHP utilizadas:**
  - `$_FILES`
  - `finfo(FILEINFO_MIME_TYPE)`
  - `is_uploaded_file()`
  - `move_uploaded_file()`
  - `mkdir()`
  - `file_exists()`
