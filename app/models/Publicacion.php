<?php

class Publicacion {
    private $idPsicologo;
    private $titulo;
    private $contenido;
    private $fecha_publicacion;
    private $usuario_id;

    public function __construct($titulo, $contenido, $fecha_publicacion, $usuario_id) {
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->usuario_id = $usuario_id;
    }

    public function insert() {
        // Aquí iría la lógica para insertar la publicación en la base de datos
    }

    public static function findById($id) {
        // Aquí iría la lógica para encontrar una publicación por su ID
    }

    public static function findAll() {
        // Aquí iría la lógica para obtener todas las publicaciones
    }
}

?>