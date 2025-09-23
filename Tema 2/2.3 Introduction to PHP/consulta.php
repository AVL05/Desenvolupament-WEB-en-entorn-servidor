<?php
// Función para limpiar datos de entrada
function limpiarDato($dato) {
    return htmlspecialchars(strip_tags(trim($dato)));
}

// Función para formatear la fecha
function formatearFecha($fecha) {
    $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
    return $fechaObj ? $fechaObj->format('d/m/Y') : $fecha;
}

// Verificar si se han enviado datos por POST
$datosEnviados = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Recibida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .datos-consulta {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
        }
        .campo {
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-radius: 4px;
            border: 1px solid #e9ecef;
        }
        .etiqueta {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            min-width: 150px;
        }
        .valor {
            color: #212529;
            margin-left: 10px;
        }
        .servicios-lista {
            background-color: #e3f2fd;
            padding: 10px;
            border-radius: 4px;
            margin-top: 5px;
        }
        .servicios-lista ul {
            margin: 0;
            padding-left: 20px;
        }
        .mensaje-texto {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #ffeaa7;
            margin-top: 10px;
            font-style: italic;
        }
        .volver-btn {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }
        .volver-btn:hover {
            background-color: #5a6268;
            text-decoration: none;
            color: white;
        }
        .no-datos {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            margin: 40px 0;
        }
        .exito {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Consulta Recibida</h1>
        </header>
        
        <main>
            <?php if ($datosEnviados): ?>
                <div class="exito">
                    <strong>¡Consulta recibida correctamente!</strong><br>
                    Procesaremos su solicitud a la brevedad posible.
                </div>
                
                <div class="datos-consulta">
                    <h2 style="color: #007bff; margin-top: 0;">Datos de la Consulta</h2>
                    
                    <div class="campo">
                        <span class="etiqueta">Nombre:</span>
                        <span class="valor"><?php echo limpiarDato($_POST['nombre'] ?? 'No proporcionado'); ?></span>
                    </div>
                    
                    <div class="campo">
                        <span class="etiqueta">Email:</span>
                        <span class="valor"><?php echo limpiarDato($_POST['email'] ?? 'No proporcionado'); ?></span>
                    </div>
                    
                    <div class="campo">
                        <span class="etiqueta">Fecha de consulta:</span>
                        <span class="valor"><?php echo isset($_POST['fecha_consulta']) ? formatearFecha($_POST['fecha_consulta']) : 'No proporcionada'; ?></span>
                    </div>
                    
                    <div class="campo">
                        <span class="etiqueta">Asunto:</span>
                        <span class="valor">
                            <?php 
                            $asuntos = [
                                'informacion' => 'Información general',
                                'soporte' => 'Soporte técnico', 
                                'ventas' => 'Ventas',
                                'sugerencias' => 'Sugerencias'
                            ];
                            $asunto = $_POST['asunto'] ?? '';
                            echo $asuntos[$asunto] ?? 'No seleccionado';
                            ?>
                        </span>
                    </div>
                    
                    <div class="campo">
                        <span class="etiqueta">Servicios de interés:</span>
                        <div class="valor">
                            <?php 
                            if (isset($_POST['servicios']) && is_array($_POST['servicios']) && !empty($_POST['servicios'])):
                                $serviciosNombres = [
                                    'desarrollo_web' => 'Desarrollo Web',
                                    'aplicaciones_moviles' => 'Aplicaciones Móviles',
                                    'consultoria' => 'Consultoría IT',
                                    'mantenimiento' => 'Mantenimiento'
                                ];
                            ?>
                                <div class="servicios-lista">
                                    <ul>
                                        <?php foreach ($_POST['servicios'] as $servicio): ?>
                                            <li><?php echo $serviciosNombres[$servicio] ?? $servicio; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <em>Ningún servicio seleccionado</em>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="campo">
                        <span class="etiqueta">Preferencia de contacto:</span>
                        <span class="valor">
                            <?php 
                            $contactos = [
                                'telefono' => 'Teléfono',
                                'email' => 'Email',
                                'presencial' => 'Presencial'
                            ];
                            $contacto = $_POST['contacto'] ?? '';
                            echo $contactos[$contacto] ?? 'No seleccionado';
                            ?>
                        </span>
                    </div>
                    
                    <div class="campo">
                        <span class="etiqueta">Mensaje:</span>
                        <div class="mensaje-texto">
                            <?php echo nl2br(limpiarDato($_POST['mensaje'] ?? 'No se proporcionó mensaje')); ?>
                        </div>
                    </div>
                </div>
                
                <div style="text-align: center;">
                    <a href="formulario_consulta.html" class="volver-btn">← Volver al formulario</a>
                </div>
                
            <?php else: ?>
                <div class="no-datos">
                    <h2>No se han recibido datos</h2>
                    <p>No se han enviado datos desde el formulario.</p>
                    <a href="formulario_consulta.html" class="volver-btn">Ir al formulario de consulta</a>
                </div>
            <?php endif; ?>
        </main>
        
        <footer>
            <p style="text-align: center; margin-top: 30px; color: #666; border-top: 1px solid #e9ecef; padding-top: 20px;">
                © 2024 Sistema de Consultas - PHP Exercise<br>
                <small>Los datos han sido procesados exitosamente</small>
            </p>
        </footer>
    </div>
</body>
</html>