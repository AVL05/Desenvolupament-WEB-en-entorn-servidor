<?php
echo "=== EJERCICIO 1: Suma de dos números ===\n";

function sumarNumeros($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        throw new Exception("Error: Los parámetros deben ser números válidos");
    }
    
    return $a + $b;
}

try {
    $resultado = sumarNumeros(5, 3);
    echo "Resultado de la suma: $resultado\n";
} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage() . "\n";
}

try {
    $resultado = sumarNumeros("abc", 5);
    echo "Resultado de la suma: $resultado\n";
} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage() . "\n";
}

echo "\n";

echo "=== EJERCICIO 2: División con excepción personalizada ===\n";

class MiExcepcionPersonalizada extends Exception {
    public function mensajePersonalizado() {
        return "¡ATENCIÓN! Se ha producido un error personalizado: " . $this->getMessage();
    }
}

function dividirNumeros($dividendo, $divisor) {
    if (!is_numeric($dividendo) || !is_numeric($divisor)) {
        throw new MiExcepcionPersonalizada("Los parámetros deben ser números válidos");
    }

    if ($divisor == 0) {
        throw new MiExcepcionPersonalizada("No se puede dividir por cero");
    }
    
    return $dividendo / $divisor;
}

try {
    $resultado = dividirNumeros(10, 2);
    echo "Resultado de la división: $resultado\n";
} catch (MiExcepcionPersonalizada $e) {
    echo $e->mensajePersonalizado() . "\n";
}

try {
    $resultado = dividirNumeros(10, 0);
    echo "Resultado de la división: $resultado\n";
} catch (MiExcepcionPersonalizada $e) {
    echo $e->mensajePersonalizado() . "\n";
}

try {
    $resultado = dividirNumeros("texto", "otro_texto");
    echo "Resultado de la división: $resultado\n";
} catch (MiExcepcionPersonalizada $e) {
    echo $e->mensajePersonalizado() . "\n";
}

echo "\n=== Fin de los ejercicios ===\n";
?>