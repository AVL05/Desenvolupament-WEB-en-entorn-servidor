<?php
require_once('Publicacion.inc.php');

// Clase Revista que hereda de Publicacion
class Revista extends Publicacion {
    private $numero;
    private $mesPublicacion;

    // Constructor
    public function __construct($codigo, $titulo, $anioPublicacion, $numero, $mesPublicacion) {
        parent::__construct($codigo, $titulo, $anioPublicacion);
        $this->numero = $numero;
        $this->mesPublicacion = $mesPublicacion;
    }

    // Getters
    public function getNumero() {
        return $this->numero;
    }

    public function getMesPublicacion() {
        return $this->mesPublicacion;
    }

    // Setters
    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setMesPublicacion($mesPublicacion) {
        $this->mesPublicacion = $mesPublicacion;
    }

    // Implementación del método abstracto
    public function getTipo() {
        return 'Revista';
    }

    // Sobrescribir __toString
    public function __toString() {
        return parent::__toString() . "<br>Número: {$this->numero}<br>Mes: {$this->mesPublicacion}";
    }
}
?>
