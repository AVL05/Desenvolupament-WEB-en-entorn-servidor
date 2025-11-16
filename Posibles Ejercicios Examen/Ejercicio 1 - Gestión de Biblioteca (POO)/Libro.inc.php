<?php
require_once('Publicacion.inc.php');

// Clase Libro que hereda de Publicacion
class Libro extends Publicacion {
    private $autor;
    private $numPaginas;

    // Constructor
    public function __construct($codigo, $titulo, $anioPublicacion, $autor, $numPaginas) {
        parent::__construct($codigo, $titulo, $anioPublicacion);
        $this->autor = $autor;
        $this->numPaginas = $numPaginas;
    }

    // Getters
    public function getAutor() {
        return $this->autor;
    }

    public function getNumPaginas() {
        return $this->numPaginas;
    }

    // Setters
    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setNumPaginas($numPaginas) {
        $this->numPaginas = $numPaginas;
    }

    // Implementación del método abstracto
    public function getTipo() {
        return 'Libro';
    }

    // Sobrescribir __toString
    public function __toString() {
        return parent::__toString() . "<br>Autor: {$this->autor}<br>Páginas: {$this->numPaginas}";
    }
}
?>
