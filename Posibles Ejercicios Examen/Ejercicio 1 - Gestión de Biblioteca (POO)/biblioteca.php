<?php
// ========================================
// EJERCICIO 1: GESTIÓN DE BIBLIOTECA (POO + MYSQL)
// ========================================

session_start();  // Iniciar sesión

// --- INCLUIR ARCHIVOS NECESARIOS ---
require_once('config.php');  // Conexión a BD
require_once('PublicacionYaPrestadaException.inc.php');  // Excepción personalizada
require_once('Libro.inc.php');  // Clase Libro
require_once('Revista.inc.php');  // Clase Revista

// --- CONECTAR A LA BASE DE DATOS ---
$db = getDBConnection('biblioteca_db');

// --- VARIABLES PARA MENSAJES ---
$errores = [];  // Array de errores
$exito = '';    // Mensaje de éxito

// ==========================================
// PROCESAR FORMULARIOS (MÉTODO POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // --- CASO 1: PRESTAR O DEVOLVER PUBLICACIÓN ---
    if (isset($_POST['accion']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        
        try {
            // --- CONSULTAR PUBLICACIÓN EN LA BD ---
            $stmt = $db->prepare("SELECT * FROM publicaciones WHERE id = ?");
            $stmt->execute([$id]);
            $publicacion_data = $stmt->fetch();
            
            if ($publicacion_data) {
                // --- CREAR OBJETO SEGÚN EL TIPO (POO) ---
                if ($publicacion_data['tipo'] == 'libro') {
                    $publicacion = new Libro(
                        $publicacion_data['codigo'],
                        $publicacion_data['titulo'],
                        $publicacion_data['anio_publicacion'],
                        $publicacion_data['autor'],
                        $publicacion_data['num_paginas']
                    );
                } else {
                    $publicacion = new Revista(
                        $publicacion_data['codigo'],
                        $publicacion_data['titulo'],
                        $publicacion_data['anio_publicacion'],
                        $publicacion_data['numero'],
                        $publicacion_data['mes_publicacion']
                    );
                }
                
                // Establecer estado de prestado
                if ($publicacion_data['prestado']) {
                    $publicacion->prestar(); // Marca como prestado sin lanzar excepción
                }
                
                // --- EJECUTAR ACCIÓN: PRESTAR O DEVOLVER ---
                if ($_POST['accion'] == 'prestar') {
                    if (!$publicacion_data['prestado']) {
                        $publicacion->prestar();  // Método POO
                        // Actualizar estado en BD
                        $stmt = $db->prepare("UPDATE publicaciones SET prestado = TRUE WHERE id = ?");
                        $stmt->execute([$id]);
                        $exito = 'Publicación prestada correctamente';
                    } else {
                        throw new PublicacionYaPrestadaException($publicacion_data['titulo']);
                    }
                } elseif ($_POST['accion'] == 'devolver') {
                    $publicacion->devolver();  // Método POO
                    // Actualizar estado en BD
                    $stmt = $db->prepare("UPDATE publicaciones SET prestado = FALSE WHERE id = ?");
                    $stmt->execute([$id]);
                    $exito = 'Publicación devuelta correctamente';
                }
            }
        } catch (PublicacionYaPrestadaException $e) {
            $errores[] = $e->errorMessage();
        } catch (Exception $e) {
            $errores[] = 'Error: ' . $e->getMessage();
        }
    }
    
    // --- CASO 2: REGISTRAR NUEVA PUBLICACIÓN ---
    elseif (isset($_POST['registrar'])) {
        
        // --- VALIDACIÓN DE CAMPOS OBLIGATORIOS ---
        if (empty($_POST['tipo'])) {
            $errores[] = 'Debe seleccionar el tipo de publicación';
        }
        
        if (empty($_POST['codigo'])) {
            $errores[] = 'El código es obligatorio';
        } elseif (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $_POST['codigo'])) {
            $errores[] = 'El código debe tener el formato: 3 letras mayúsculas + 4 dígitos (ej: LIB0001)';
        }
        
        if (empty($_POST['titulo'])) {
            $errores[] = 'El título es obligatorio';
        }
        
        if (empty($_POST['anio'])) {
            $errores[] = 'El año de publicación es obligatorio';
        } elseif (!is_numeric($_POST['anio']) || $_POST['anio'] < 1000 || $_POST['anio'] > date('Y')) {
            $errores[] = 'El año debe ser un número válido entre 1000 y ' . date('Y');
        }
        
        // Validar campos específicos según tipo
        if (isset($_POST['tipo'])) {
            if ($_POST['tipo'] == 'libro') {
                if (empty($_POST['autor'])) {
                    $errores[] = 'El autor es obligatorio para libros';
                }
                if (empty($_POST['numPaginas'])) {
                    $errores[] = 'El número de páginas es obligatorio para libros';
                } elseif (!is_numeric($_POST['numPaginas']) || $_POST['numPaginas'] <= 0) {
                    $errores[] = 'El número de páginas debe ser un número positivo';
                }
            } elseif ($_POST['tipo'] == 'revista') {
                if (empty($_POST['numero'])) {
                    $errores[] = 'El número es obligatorio para revistas';
                } elseif (!is_numeric($_POST['numero']) || $_POST['numero'] <= 0) {
                    $errores[] = 'El número debe ser un valor positivo';
                }
                if (empty($_POST['mes'])) {
                    $errores[] = 'El mes de publicación es obligatorio para revistas';
                }
            }
        }
        
        // --- SI NO HAY ERRORES, INSERTAR EN BD ---
        if (empty($errores)) {
            try {
                // Verificar código único
                $stmt = $db->prepare("SELECT id FROM publicaciones WHERE codigo = ?");
                $stmt->execute([$_POST['codigo']]);
                if ($stmt->fetch()) {
                    throw new Exception('El código ya existe en la base de datos');
                }
                
                // --- INSERT LIBRO EN BD ---
                if ($_POST['tipo'] == 'libro') {
                    $stmt = $db->prepare("
                        INSERT INTO publicaciones (codigo, titulo, anio_publicacion, tipo, autor, num_paginas)
                        VALUES (?, ?, ?, 'libro', ?, ?)
                    ");
                    $stmt->execute([
                        $_POST['codigo'],
                        $_POST['titulo'],
                        $_POST['anio'],
                        $_POST['autor'],
                        $_POST['numPaginas']
                    ]);
                // --- INSERT REVISTA EN BD ---
                } else {
                    $stmt = $db->prepare("
                        INSERT INTO publicaciones (codigo, titulo, anio_publicacion, tipo, numero, mes_publicacion)
                        VALUES (?, ?, ?, 'revista', ?, ?)
                    ");
                    $stmt->execute([
                        $_POST['codigo'],
                        $_POST['titulo'],
                        $_POST['anio'],
                        $_POST['numero'],
                        $_POST['mes']
                    ]);
                }
                
                $exito = 'Publicación registrada correctamente en la base de datos';
                
                // Limpiar el formulario
                $_POST = [];
                
            } catch (Exception $e) {
                $errores[] = 'Error al registrar la publicación: ' . $e->getMessage();
            }
        }
    }
}

// ==========================================
// CONSULTAR TODAS LAS PUBLICACIONES DE LA BD
// ==========================================
$stmt = $db->query("SELECT * FROM publicaciones ORDER BY fecha_creacion DESC");
$publicaciones_data = $stmt->fetchAll();  // Array de publicaciones
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Biblioteca (MySQL)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1, h2 {
            color: #333;
        }
        .badge-mysql {
            background-color: #00758f;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 10px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .radio-group {
            margin: 10px 0;
        }
        .radio-group label {
            display: inline;
            margin-right: 15px;
            font-weight: normal;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            border-left: 4px solid #c62828;
        }
        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            border-left: 4px solid #2e7d32;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn-prestar, .btn-devolver {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-prestar {
            background-color: #2196F3;
            color: white;
        }
        .btn-prestar:hover {
            background-color: #0b7dda;
        }
        .btn-devolver {
            background-color: #ff9800;
            color: white;
        }
        .btn-devolver:hover {
            background-color: #e68900;
        }
        .btn-prestar:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .campos-especificos {
            display: none;
        }
    </style>
    <script>
        function mostrarCampos() {
            const tipo = document.querySelector('input[name="tipo"]:checked');
            const camposLibro = document.getElementById('campos-libro');
            const camposRevista = document.getElementById('campos-revista');
            
            camposLibro.style.display = 'none';
            camposRevista.style.display = 'none';
            
            if (tipo) {
                if (tipo.value === 'libro') {
                    camposLibro.style.display = 'block';
                } else if (tipo.value === 'revista') {
                    camposRevista.style.display = 'block';
                }
            }
        }
    </script>
</head>
<body>
    <h1>Gestión de Biblioteca <span class="badge-mysql">MySQL</span></h1>
    
    <?php if (!empty($errores)): ?>
        <div class="error">
            <strong>Errores encontrados:</strong>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <?php if ($exito): ?>
        <div class="success">
            <?php echo htmlspecialchars($exito); ?>
        </div>
    <?php endif; ?>
    
    <div class="form-container">
        <h2>Registrar Nueva Publicación</h2>
        <form method="post" action="#">
            <div class="form-group">
                <label>Tipo de Publicación:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="tipo" value="libro" 
                               onclick="mostrarCampos()"
                               <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'libro') ? 'checked' : ''; ?>>
                        Libro
                    </label>
                    <label>
                        <input type="radio" name="tipo" value="revista" 
                               onclick="mostrarCampos()"
                               <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'revista') ? 'checked' : ''; ?>>
                        Revista
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="codigo">Código (formato: LIB0001):</label>
                <input type="text" id="codigo" name="codigo" 
                       value="<?php echo isset($_POST['codigo']) ? htmlspecialchars($_POST['codigo']) : ''; ?>"
                       placeholder="Ej: LIB0001" required>
            </div>
            
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" 
                       value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : ''; ?>"
                       required>
            </div>
            
            <div class="form-group">
                <label for="anio">Año de Publicación:</label>
                <input type="number" id="anio" name="anio" 
                       value="<?php echo isset($_POST['anio']) ? htmlspecialchars($_POST['anio']) : ''; ?>"
                       min="1000" max="<?php echo date('Y'); ?>" required>
            </div>
            
            <!-- Campos específicos para Libro -->
            <div id="campos-libro" class="campos-especificos" 
                 style="<?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'libro') ? 'display:block;' : ''; ?>">
                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" 
                           value="<?php echo isset($_POST['autor']) ? htmlspecialchars($_POST['autor']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="numPaginas">Número de Páginas:</label>
                    <input type="number" id="numPaginas" name="numPaginas" 
                           value="<?php echo isset($_POST['numPaginas']) ? htmlspecialchars($_POST['numPaginas']) : ''; ?>"
                           min="1">
                </div>
            </div>
            
            <!-- Campos específicos para Revista -->
            <div id="campos-revista" class="campos-especificos"
                 style="<?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'revista') ? 'display:block;' : ''; ?>">
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="number" id="numero" name="numero" 
                           value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>"
                           min="1">
                </div>
                
                <div class="form-group">
                    <label for="mes">Mes de Publicación:</label>
                    <input type="text" id="mes" name="mes" 
                           value="<?php echo isset($_POST['mes']) ? htmlspecialchars($_POST['mes']) : ''; ?>"
                           placeholder="Ej: Enero">
                </div>
            </div>
            
            <button type="submit" name="registrar">Registrar Publicación</button>
        </form>
    </div>
    
    <h2>Publicaciones Registradas</h2>
    
    <?php if (empty($publicaciones_data)): ?>
        <p>No hay publicaciones registradas todavía.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($publicaciones_data as $pub): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pub['id']); ?></td>
                        <td><?php echo htmlspecialchars($pub['codigo']); ?></td>
                        <td><?php echo htmlspecialchars($pub['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($pub['anio_publicacion']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($pub['tipo'])); ?></td>
                        <td><?php echo $pub['prestado'] ? '<strong style="color:#c62828;">Prestado</strong>' : '<strong style="color:#2e7d32;">Disponible</strong>'; ?></td>
                        <td>
                            <?php 
                            if ($pub['tipo'] == 'libro') {
                                echo 'Autor: ' . htmlspecialchars($pub['autor']) . '<br>';
                                echo 'Páginas: ' . htmlspecialchars($pub['num_paginas']);
                            } else {
                                echo 'Número: ' . htmlspecialchars($pub['numero']) . '<br>';
                                echo 'Mes: ' . htmlspecialchars($pub['mes_publicacion']);
                            }
                            ?>
                        </td>
                        <td>
                            <form method="post" action="#" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $pub['id']; ?>">
                                <?php if (!$pub['prestado']): ?>
                                    <button type="submit" name="accion" value="prestar" class="btn-prestar">Prestar</button>
                                <?php else: ?>
                                    <button type="submit" name="accion" value="devolver" class="btn-devolver">Devolver</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
