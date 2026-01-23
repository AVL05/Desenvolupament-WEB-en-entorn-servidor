<?php

require_once('conexion.ini.php');

class Tarea {
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha_creacion;
    private $fecha_modificacion;
    private $fecha_finalizacion;
    private $completada;
    private $id_usr_crea;
    private $id_usr_mod;
    private $id_usr_comp;
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

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function getFechaModificacion() {
        return $this->fecha_modificacion;
    }

    public function getFechaFinalizacion() {
        return $this->fecha_finalizacion;
    }

    public function getCompletada() {
        return $this->completada;
    }

    public function getIdUsrCrea() {
        return $this->id_usr_crea;
    }

    public function getIdUsrMod() {
        return $this->id_usr_mod;
    }

    public function getIdUsrComp() {
        return $this->id_usr_comp;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setCompletada($completada) {
        $this->completada = $completada;
    }


    public function crear($nombre, $descripcion, $id_usuario) {
        try {
            $sql = "INSERT INTO tareas (nombre, descripcion, id_usr_crea) VALUES (:nombre, :descripcion, :id_usuario)";
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_usuario', $id_usuario);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al crear tarea: " . $e->getMessage());
        }
    }

    public function listarTodas() {
        try {
            $sql = "SELECT t.*, 
                    u1.nombre as nombre_creador,
                    u2.nombre as nombre_modificador,
                    u3.nombre as nombre_completador
                    FROM tareas t
                    LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
                    LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
                    LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
                    ORDER BY t.fecha_creacion DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar tareas: " . $e->getMessage());
        }
    }

    public function obtenerPorId($id) {
        try {
            $sql = "SELECT * FROM tareas WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($tarea) {
                $this->id = $tarea['id'];
                $this->nombre = $tarea['nombre'];
                $this->descripcion = $tarea['descripcion'];
                $this->fecha_creacion = $tarea['fecha_creacion'];
                $this->fecha_modificacion = $tarea['fecha_modificacion'];
                $this->fecha_finalizacion = $tarea['fecha_finalizacion'];
                $this->completada = $tarea['completada'];
                $this->id_usr_crea = $tarea['id_usr_crea'];
                $this->id_usr_mod = $tarea['id_usr_mod'];
                $this->id_usr_comp = $tarea['id_usr_comp'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener tarea: " . $e->getMessage());
        }
    }

    public function actualizar($id, $nombre, $descripcion, $id_usuario) {
        try {
            $sql = "UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, 
                    fecha_modificacion = CURDATE(), id_usr_mod = :id_usuario 
                    WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_usuario', $id_usuario);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar tarea: " . $e->getMessage());
        }
    }

    public function completar($id, $id_usuario) {
        try {
            $sql = "UPDATE tareas SET completada = 1, fecha_finalizacion = CURDATE(), 
                    id_usr_comp = :id_usuario WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_usuario', $id_usuario);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al completar tarea: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM tareas WHERE id = :id AND completada = 0";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar tarea: " . $e->getMessage());
        }
    }

    public function buscarConFiltros($filtros = []) {
        try {
            $sql = "SELECT t.*, 
                    u1.nombre as nombre_creador,
                    u2.nombre as nombre_modificador,
                    u3.nombre as nombre_completador
                    FROM tareas t
                    LEFT JOIN usuarios u1 ON t.id_usr_crea = u1.id
                    LEFT JOIN usuarios u2 ON t.id_usr_mod = u2.id
                    LEFT JOIN usuarios u3 ON t.id_usr_comp = u3.id
                    WHERE 1=1";
            
            $parametros = [];
            
            if (!empty($filtros['termino'])) {
                $sql .= " AND (t.nombre LIKE :termino OR t.descripcion LIKE :termino)";
                $parametros[':termino'] = "%{$filtros['termino']}%";
            }
            
            if (isset($filtros['estado']) && $filtros['estado'] !== '') {
                $sql .= " AND t.completada = :estado";
                $parametros[':estado'] = $filtros['estado'];
            }
            
            if (!empty($filtros['fecha_desde'])) {
                $sql .= " AND DATE(t.fecha_creacion) >= :fecha_desde";
                $parametros[':fecha_desde'] = $filtros['fecha_desde'];
            }
            
            if (!empty($filtros['fecha_hasta'])) {
                $sql .= " AND DATE(t.fecha_creacion) <= :fecha_hasta";
                $parametros[':fecha_hasta'] = $filtros['fecha_hasta'];
            }
            
            $sql .= " ORDER BY t.fecha_creacion DESC";
            
            $stmt = $this->conexion->prepare($sql);
            
            foreach ($parametros as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al buscar tareas: " . $e->getMessage());
        }
    }
}

?>
