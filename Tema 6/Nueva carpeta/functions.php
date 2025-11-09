<?php
require_once 'config.php';

/**
 * Validar errores de subida de archivo
 */
function validateUploadError($error) {
    switch ($error) {
        case UPLOAD_ERR_OK:
            return true;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No se envió ningún archivo.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('El archivo excede el tamaño máximo permitido.');
        default:
            throw new RuntimeException('Error desconocido al subir el archivo.');
    }
}

/**
 * Validar tipo MIME del archivo
 */
function validateFileType($tmpName) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($tmpName);
    
    if (!in_array($mimeType, ALLOWED_TYPES)) {
        throw new RuntimeException('Tipo de archivo no permitido. Solo se permiten imágenes PNG o JPG.');
    }
    
    return $mimeType;
}

/**
 * Obtener extensión del archivo según MIME type
 */
function getExtensionFromMime($mimeType) {
    $mimeToExt = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png'
    ];
    
    return $mimeToExt[$mimeType] ?? 'jpg';
}

/**
 * Validar dimensiones de la imagen
 */
function validateImageDimensions($tmpName) {
    list($width, $height) = getimagesize($tmpName);
    
    if ($width > BIG_IMAGE_WIDTH || $height > BIG_IMAGE_HEIGHT) {
        throw new RuntimeException("La imagen excede el tamaño máximo permitido (" . BIG_IMAGE_WIDTH . "x" . BIG_IMAGE_HEIGHT . "px). Tamaño actual: {$width}x{$height}px");
    }
    
    return [$width, $height];
}

/**
 * Crear imagen desde archivo según tipo
 */
function createImageFromFile($filePath, $mimeType) {
    switch ($mimeType) {
        case 'image/jpeg':
            return imagecreatefromjpeg($filePath);
        case 'image/png':
            return imagecreatefrompng($filePath);
        default:
            throw new RuntimeException('Tipo de imagen no soportado.');
    }
}

/**
 * Guardar imagen según tipo
 */
function saveImage($image, $filePath, $mimeType) {
    switch ($mimeType) {
        case 'image/jpeg':
            return imagejpeg($image, $filePath, 90);
        case 'image/png':
            return imagepng($image, $filePath, 9);
        default:
            throw new RuntimeException('Tipo de imagen no soportado.');
    }
}

/**
 * Redimensionar imagen manteniendo proporción
 */
function resizeImage($sourceImage, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight) {
    // Calcular proporción
    $ratioOrig = $sourceWidth / $sourceHeight;
    $ratioTarget = $targetWidth / $targetHeight;
    
    if ($ratioTarget > $ratioOrig) {
        $newHeight = $targetHeight;
        $newWidth = $targetHeight * $ratioOrig;
    } else {
        $newWidth = $targetWidth;
        $newHeight = $targetWidth / $ratioOrig;
    }
    
    // Crear imagen de destino
    $targetImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // Preservar transparencia para PNG
    imagealphablending($targetImage, false);
    imagesavealpha($targetImage, true);
    
    // Redimensionar
    imagecopyresampled(
        $targetImage, $sourceImage,
        0, 0, 0, 0,
        $newWidth, $newHeight,
        $sourceWidth, $sourceHeight
    );
    
    return $targetImage;
}

/**
 * Procesar y guardar imagen subida
 */
function processUploadedImage($file, $username) {
    try {
        // Validar errores de subida
        validateUploadError($file['error']);
        
        // Verificar que el archivo fue realmente subido
        if (!is_uploaded_file($file['tmp_name'])) {
            throw new RuntimeException('Posible ataque de archivo subido.');
        }
        
        // Validar tipo de archivo
        $mimeType = validateFileType($file['tmp_name']);
        
        // Validar dimensiones
        list($width, $height) = validateImageDimensions($file['tmp_name']);
        
        // Obtener extensión
        $extension = getExtensionFromMime($mimeType);
        
        // Crear directorio del usuario si no existe
        $userDir = IMG_PATH . '/' . $username;
        if (!is_dir($userDir)) {
            if (!mkdir($userDir, 0755, true)) {
                throw new RuntimeException('No se pudo crear el directorio del usuario.');
            }
        }
        
        // Cargar imagen original
        $sourceImage = createImageFromFile($file['tmp_name'], $mimeType);
        
        if (!$sourceImage) {
            throw new RuntimeException('No se pudo cargar la imagen.');
        }
        
        // Crear versión grande (360x480)
        $bigImage = resizeImage($sourceImage, BIG_IMAGE_WIDTH, BIG_IMAGE_HEIGHT, $width, $height);
        $bigImageName = $username . 'Big.' . $extension;
        $bigImagePath = $userDir . '/' . $bigImageName;
        saveImage($bigImage, $bigImagePath, $mimeType);
        
        // Crear versión pequeña (72x96)
        $smallImage = resizeImage($sourceImage, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, $width, $height);
        $smallImageName = $username . 'Small.' . $extension;
        $smallImagePath = $userDir . '/' . $smallImageName;
        saveImage($smallImage, $smallImagePath, $mimeType);
        
        // Liberar memoria
        imagedestroy($sourceImage);
        imagedestroy($bigImage);
        imagedestroy($smallImage);
        
        // Retornar rutas relativas para guardar en BD
        return [
            'big' => IMG_URL . '/' . $username . '/' . $bigImageName,
            'small' => IMG_URL . '/' . $username . '/' . $smallImageName
        ];
        
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * Verificar si el usuario está logueado
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

/**
 * Redirigir si no está logueado
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

/**
 * Obtener usuario actual
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    $db = getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

/**
 * Escapar HTML
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
