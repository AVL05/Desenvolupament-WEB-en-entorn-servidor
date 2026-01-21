<?php

require_once('conexion.ini.php');

class Usuario {
    private $id;
    private $nombre;
    private $correo;
    private $contrasena;
    private $ruta_img;
    private $conexion;

    public function __construct() {
        try {
            $conn = new Conexion();
            $this->conexion = $conn->getConexion();
        } catch (Exception $e) {
            throw new Exception("Error al conectar: " . $e->getMessage());
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getRutaImg() {
        return $this->ruta_img;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setRutaImg($ruta_img) {
        $this->ruta_img = $ruta_img;
    }


    public function registrar($nombre, $correo, $contrasena, $ruta_img) {
        try {
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, ruta_img) VALUES (:nombre, :correo, :contrasena, :ruta_img)";
            $stmt = $this->conexion->prepare($sql);
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $contrasena_hash);
            $stmt->bindParam(':ruta_img', $ruta_img);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
        }
    }

    public function autenticar($correo, $contrasena) {
        try {
            $sql = "SELECT * FROM usuarios WHERE correo = :correo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                $this->id = $usuario['id'];
                $this->nombre = $usuario['nombre'];
                $this->correo = $usuario['correo'];
                $this->ruta_img = $usuario['ruta_img'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error al autenticar: " . $e->getMessage());
        }
    }

    public function obtenerPorId($id) {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario) {
                $this->id = $usuario['id'];
                $this->nombre = $usuario['nombre'];
                $this->correo = $usuario['correo'];
                $this->ruta_img = $usuario['ruta_img'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener usuario: " . $e->getMessage());
        }
    }

    public function actualizar($id, $nombre, $correo, $ruta_img, $contrasena = null) {
        try {
            if ($contrasena) {
                $sql = "UPDATE usuarios SET nombre = :nombre, correo = :correo, contrasena = :contrasena, ruta_img = :ruta_img WHERE id = :id";
                $stmt = $this->conexion->prepare($sql);
                $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
                $stmt->bindParam(':contrasena', $contrasena_hash);
            } else {
                $sql = "UPDATE usuarios SET nombre = :nombre, correo = :correo, ruta_img = :ruta_img WHERE id = :id";
                $stmt = $this->conexion->prepare($sql);
            }
            
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':ruta_img', $ruta_img);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar usuario: " . $e->getMessage());
        }
    }

    public function existeCorreo($correo) {
        try {
            $sql = "SELECT COUNT(*) as total FROM usuarios WHERE correo = :correo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] > 0;
        } catch (PDOException $e) {
            throw new Exception("Error al verificar correo: " . $e->getMessage());
        }
    }
}

?>
