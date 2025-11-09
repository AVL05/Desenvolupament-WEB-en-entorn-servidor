<?php
require_once 'config.php';
require_once 'functions.php';

// Requiere que el usuario esté logueado
requireLogin();

// Obtener datos del usuario actual
$user = getCurrentUser();

if (!$user) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - <?php echo e($user['username']); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .header {
            background: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 72px;
            height: 96px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid #667eea;
        }
        
        .user-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        
        .logout-btn {
            padding: 10px 20px;
            background: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .logout-btn:hover {
            background: #d32f2f;
        }
        
        .profile-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 800px;
            margin: 0 auto;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .profile-content {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }
        
        .profile-image {
            flex-shrink: 0;
        }
        
        .profile-image img {
            width: 360px;
            height: 480px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .profile-details {
            flex: 1;
        }
        
        .detail-item {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: bold;
            color: #667eea;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        
        .detail-value {
            font-size: 18px;
            color: #333;
            word-break: break-all;
        }
        
        .image-info {
            margin-top: 20px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
        }
        
        .image-info h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .image-info p {
            font-size: 12px;
            color: #888;
            margin: 5px 0;
        }
        
        @media (max-width: 768px) {
            .profile-content {
                flex-direction: column;
            }
            
            .profile-image img {
                width: 100%;
                height: auto;
                max-width: 360px;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header con imagen pequeña -->
    <div class="header">
        <div class="user-info">
            <?php if ($user['profile_image_small']): ?>
                <img src="<?php echo e($user['profile_image_small']); ?>" 
                     alt="Avatar de <?php echo e($user['username']); ?>" 
                     class="user-avatar">
            <?php endif; ?>
            <div>
                <div class="user-name">Bienvenido, <?php echo e($user['username']); ?>!</div>
            </div>
        </div>
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
    
    <!-- Contenido del perfil -->
    <div class="profile-container">
        <h1>Mi Perfil</h1>
        
        <div class="profile-content">
            <!-- Imagen grande de perfil -->
            <div class="profile-image">
                <?php if ($user['profile_image_big']): ?>
                    <img src="<?php echo e($user['profile_image_big']); ?>" 
                         alt="Foto de perfil de <?php echo e($user['username']); ?>">
                    
                    <div class="image-info">
                        <h3>Información de las imágenes</h3>
                        <p><strong>Imagen grande:</strong> 360x480px</p>
                        <p><strong>Imagen pequeña:</strong> 72x96px (mostrada en la cabecera)</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Detalles del perfil -->
            <div class="profile-details">
                <div class="detail-item">
                    <div class="detail-label">Nombre de Usuario</div>
                    <div class="detail-value"><?php echo e($user['username']); ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value"><?php echo e($user['email']); ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">ID de Usuario</div>
                    <div class="detail-value">#<?php echo e($user['id']); ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Fecha de Registro</div>
                    <div class="detail-value">
                        <?php 
                        $date = new DateTime($user['created_at']);
                        echo $date->format('d/m/Y H:i');
                        ?>
                    </div>
                </div>
                
                <?php if ($user['profile_image_big']): ?>
                <div class="detail-item">
                    <div class="detail-label">Ruta Imagen Grande</div>
                    <div class="detail-value" style="font-size: 12px; color: #888;">
                        <?php echo e($user['profile_image_big']); ?>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Ruta Imagen Pequeña</div>
                    <div class="detail-value" style="font-size: 12px; color: #888;">
                        <?php echo e($user['profile_image_small']); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
