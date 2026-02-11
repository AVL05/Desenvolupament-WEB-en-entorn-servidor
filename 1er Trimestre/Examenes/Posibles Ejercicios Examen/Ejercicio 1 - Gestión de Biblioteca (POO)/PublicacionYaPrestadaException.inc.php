<?php
// Excepción personalizada para publicaciones ya prestadas
class PublicacionYaPrestadaException extends Exception {
    public function errorMessage() {
        return '<b>Error:</b> ' . $this->getMessage();
    }
}
?>
