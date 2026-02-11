<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio POO PHP - Herencia de Clases</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .seccion { margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; }
        h2 { color: #333; }
        .resultado { background-color: #f9f9f9; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Ejercicio de Herencia de Clases en PHP</h1>
    
    <div class="seccion">
        <h2>1. Clase Soporte (Clase Base)</h2>
        <div class="resultado">
            <?php
            include "Soporte.php";
            
            echo "<h3>Prueba de la clase Soporte:</h3>";
            $soporte1 = new Soporte("Tenet", 22, 3);
            echo "<strong>" . $soporte1->titulo . "</strong>";
            echo "<br>Precio: " . $soporte1->getPrecio() . " euros";
            echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros";
            $soporte1->muestraResumen();
            ?>
        </div>
    </div>
    
    <div class="seccion">
        <h2>2. Clase CintaVideo (Hereda de Soporte)</h2>
        <div class="resultado">
            <?php
            include "CintaVideo.php";
            
            echo "<h3>Prueba de la clase CintaVideo:</h3>";
            $miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
            echo "<strong>" . $miCinta->titulo . "</strong>";
            echo "<br>Precio: " . $miCinta->getPrecio() . " euros";
            echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIVA() . " euros";
            $miCinta->muestraResumen();
            ?>
        </div>
    </div>
    
    <div class="seccion">
        <h2>3. Clase Dvd (Hereda de Soporte)</h2>
        <div class="resultado">
            <?php
            include "Dvd.php";
            
            echo "<h3>Prueba de la clase Dvd:</h3>";
            $miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
            echo "<strong>" . $miDvd->titulo . "</strong>";
            echo "<br>Precio: " . $miDvd->getPrecio() . " euros";
            echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIVA() . " euros";
            $miDvd->muestraResumen();
            ?>
        </div>
    </div>
    
    <div class="seccion">
        <h2>4. Clase Juego (Hereda de Soporte)</h2>
        <div class="resultado">
            <?php
            include "Juego.php";
            
            echo "<h3>Prueba de la clase Juego:</h3>";
            $miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
            echo "<strong>" . $miJuego->titulo . "</strong>";
            echo "<br>Precio: " . $miJuego->getPrecio() . " euros";
            echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIVA() . " euros";
            $miJuego->muestraResumen();
            
            echo "<br><h3>Ejemplos adicionales de muestraJugadoresPosibles():</h3>";
            
            // Juego para un jugador
            $juego1 = new Juego("Juego Single Player", 1, 20, "PC", 1, 1);
            echo "• " . $juego1->muestraJugadoresPosibles() . "<br>";
            
            // Juego para múltiples jugadores (mismo número)
            $juego2 = new Juego("Juego 4 Jugadores", 2, 25, "PS4", 4, 4);
            echo "• " . $juego2->muestraJugadoresPosibles() . "<br>";
            
            // Juego con rango de jugadores
            $juego3 = new Juego("Juego Multijugador", 3, 30, "Xbox", 2, 8);
            echo "• " . $juego3->muestraJugadoresPosibles() . "<br>";
            ?>
        </div>
    </div>
    
    <div class="seccion">
        <h2>5. Demostración de Polimorfismo</h2>
        <div class="resultado">
            <?php
            echo "<h3>Array de diferentes tipos de soporte:</h3>";
            
            $soportes = array(
                new Soporte("Producto Base", 100, 10),
                new CintaVideo("Película VHS", 101, 5, 90),
                new Dvd("Película DVD", 102, 12, "es,en", "16:9"),
                new Juego("Videojuego", 103, 25, "Nintendo", 1, 4)
            );
            
            foreach ($soportes as $soporte) {
                echo "<div style='border: 1px solid #ddd; margin: 5px; padding: 10px;'>";
                echo "<strong>Tipo: " . get_class($soporte) . "</strong>";
                $soporte->muestraResumen();
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>