<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? $titulo_pagina : 'Catálogo de Productos'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header h1 {
            margin-bottom: 10px;
        }
        nav {
            background-color: #45a049;
            padding: 10px 0;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
        }
        nav a:hover {
            background-color: #3d8b40;
        }
        main {
            min-height: 500px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Catálogo de Productos</h1>
            <p>Sistema de gestión de inventario</p>
        </div>
    </header>
    <nav>
        <div class="container">
            <ul>
                <li><a href="catalogo.php">Catálogo</a></li>
            </ul>
        </div>
    </nav>
    <main class="container" style="padding: 30px 20px;">
