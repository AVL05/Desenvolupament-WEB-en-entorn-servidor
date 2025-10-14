<?php

$dwes = mysqli_connect('localhost', 'dwes', 'dwes', 'tienda');

echo "<h1>Lista de productos</h1>";
// Consulta para obtener productos
$consulta = "SELECT cod, nombre_corto FROM producto";
$resultado = $dwes->query($consulta);

if ($resultado) {
    if ($resultado->num_rows == 0) {
        echo "<p>La consulta no ha devuelto resultados.</p>";
    } else {
        echo "<ul>";
        while ($producto = $resultado->fetch_assoc()) {
            echo "<li><a href='stock.php?cod=" . urlencode($producto['cod']) . "'>" . 
                 htmlspecialchars($producto['nombre_corto']) . "</a></li>";
        }
        echo "</ul>";
        
        // Liberar memoria del resultado
        $resultado->free();
    }
} else {
    echo "<p>Error en la consulta: " . $dwes->error . "</p>";
}

$dwes->close();

?>
