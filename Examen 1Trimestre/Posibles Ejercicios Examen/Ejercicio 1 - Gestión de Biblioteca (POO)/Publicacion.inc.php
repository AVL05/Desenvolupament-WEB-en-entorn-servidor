<?php
// Clase abstracta Publicacion
abstract class Publicacion {
    private $codigo;
    private $titulo;
    private $anioPublicacion;
    private $prestado;

    // Constructor
    public function __construct($codigo, $titulo, $anioPublicacion) {
        $this->codigo = $codigo;
        $this->titulo = $titulo;
        $this->anioPublicacion = $anioPublicacion;
        $this->prestado = false;
    }

    // Getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAnioPublicacion() {
        return $this->anioPublicacion;
    }

    public function getPrestado() {
        return $this->prestado;
    }

    // Setters
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAnioPublicacion($anioPublicacion) {
        $this->anioPublicacion = $anioPublicacion;
    }

    public function setPrestado($prestado) {
        $this->prestado = $prestado;
    }

    // Método abstracto que deben implementar las subclases
    abstract public function getTipo();

    // Método prestar
    public function prestar() {
        if ($this->prestado) {
            throw new PublicacionYaPrestadaException("La publicación '{$this->titulo}' ya está prestada");
        }
        $this->prestado = true;
    }

    // Método devolver
    public function devolver() {
        $this->prestado = false;
    }

    // Método __toString
    public function __toString() {
        $estado = $this->prestado ? 'Prestado' : 'Disponible';
        return "Código: {$this->codigo}<br>" .
               "Título: {$this->titulo}<br>" .
               "Año: {$this->anioPublicacion}<br>" .
               "Estado: {$estado}<br>" .
               "Tipo: {$this->getTipo()}";
    }
}
?>
