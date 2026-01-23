<?php

class Conexion {
    private $host = 'localhost';
    private $dbname = 'tareas';
    private $usuario = 'usr_tareas';
    private $contrasena = 'usr_tareas';
    private $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->usuario,
                $this->contrasena
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion = null;
    }
}

?>