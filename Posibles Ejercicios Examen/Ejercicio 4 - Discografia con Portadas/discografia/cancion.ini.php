<?php
    class Cancion{
        private $titulo;
        private $album;
        private $posicion;
        private $duracion;
        private $genero;

        public function __construct($titulo,$album,$posicion,$duracion,$genero){
            $this->titulo = $titulo;
            $this->album = $album;
            $this->posicion = $posicion;
            $this->duracion = $duracion;
            $this->genero = $genero;
        }

        public function getTitulo(){
            return $this->titulo;
        }
        public function setTitulo($titulo){
            $this->titulo= $titulo;
        }

        public function getAlbum(){
            return $this->album;
        }
        public function setAlbum($album){
            $this->album = $album;
        }

        public function getPosicion(){
            return $this->posicion;
        }
        public function setPosicion($posicion){
            $this->posicion = $posicion;
        }

        public function getDuracion(){
            return $this->duracion;
        }
        public function setDuracion($duracion){
            $this->duracion = $duracion;
        }

        public function getGenero(){
            return $this->genero;
        }
        public function setGenero($genero){
            $this->genero = $genero;
        }

        function registrarCancion($conexion){
            try{
                $stmt = $conexion->prepare('INSERT INTO discografia.cancion (titulo, album, posicion, duracion, genero) VALUES (:titulo, :album, :posicion, :duracion, :genero)');
                $pos = is_numeric($this->posicion) ? (int)$this->posicion : null;
                $stmt->bindParam(':titulo', $this->titulo);
                $stmt->bindParam(':album', $this->album);
                $stmt->bindParam(':posicion', $pos);
                $stmt->bindParam(':duracion', $this->duracion);
                $stmt->bindParam(':genero', $this->genero);
                $ok = $stmt->execute();
                if ($ok) {
                    echo'<h1 id="bien">Canción '.htmlspecialchars($this->titulo, ENT_QUOTES).' REGISTRADA!</h1>';
                } else {
                    throw new Exception('Error al ejecutar la consulta');
                }
            }catch(Exception $e){
                echo '<h1 id="mal">ERROR AL INSERTAR LA CANCIÓN!</h1>';
                echo $e->getMessage();
            }
        }
    }
?>