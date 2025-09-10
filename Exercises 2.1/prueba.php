<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once("cabecera.inc.php");
$cantidad = 3;
$precio = 1.6;

// Operaciones
$total = $cantidad * $precio;
echo "<p>Total: $total</p>";

// Casting
$totalEntero = $cantidad * (int)$precio;
echo "<p>Total con casting: $totalEntero</p>";
?>
<?php include("archivo.php"); 
include_once("otro.php"); 
require("prueba.inc.php"); 
 
require_once("inventado.php"); ?>
</body>
</html>