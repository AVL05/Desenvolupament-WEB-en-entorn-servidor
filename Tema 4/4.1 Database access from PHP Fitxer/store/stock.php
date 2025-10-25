<?php

$dwes = mysqli_connect('localhost', 'dwes', 'dwes', 'tienda');

$cod_producto = $_GET['cod'];

$consulta = "SELECT nombre_corto FROM producto WHERE cod='$cod_producto'";
$resultado = $dwes->query($consulta);
$producto = $resultado->fetch_assoc();

echo "<h1>Stock del producto: " . $producto['nombre_corto'] . "</h1>";

if (isset($_POST['actualizar'])) {
    $todo_bien = true;
    
    $dwes->autocommit(false);
    
    $unidades_central = $_POST['unidades_1'];
    $sql = "UPDATE stock SET unidades=$unidades_central WHERE producto='$cod_producto' AND tienda=1";
    $todo_bien = $dwes->query($sql);
    
    if ($todo_bien) {
        $unidades_sucursal = $_POST['unidades_2'];
        $sql = "UPDATE stock SET unidades=$unidades_sucursal WHERE producto='$cod_producto' AND tienda=2";
        $todo_bien = $dwes->query($sql);
    }
    
    if ($todo_bien) {
        $dwes->commit();
        echo "<p>Stock actualizado correctamente.</p>";
    } else {
        $dwes->rollback();
        echo "<p>Error al actualizar el stock.</p>";
    }
    
    $dwes->autocommit(true);
}

echo "<h2>Stock del producto en las tiendas:</h2>";

$consulta = "SELECT unidades FROM stock WHERE producto='$cod_producto' AND tienda=1";
$resultado = $dwes->query($consulta);
if ($resultado->num_rows > 0) {
    $stock_central = $resultado->fetch_assoc();
    $unidades_central = $stock_central['unidades'];
} else {
    $unidades_central = 0;
}

$consulta = "SELECT unidades FROM stock WHERE producto='$cod_producto' AND tienda=2";
$resultado = $dwes->query($consulta);
if ($resultado->num_rows > 0) {
    $stock_sucursal = $resultado->fetch_assoc();
    $unidades_sucursal = $stock_sucursal['unidades'];
} else {
    $unidades_sucursal = 0;
}

echo "<form method='POST'>";
echo "Tienda CENTRAL: <input type='number' name='unidades_1' value='$unidades_central'> unidades.<br><br>";
echo "Tienda SUCURSAL: <input type='number' name='unidades_2' value='$unidades_sucursal'> unidades.<br><br>";
echo "<input type='submit' name='actualizar' value='Actualizar'>";
echo "</form>";

echo "<p><a href='index.php'>Volver a la lista de productos</a></p>";

$dwes->close();

?>