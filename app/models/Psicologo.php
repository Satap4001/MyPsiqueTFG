<?php 

class Psicologo {
    private $id;
    private $usuario_id;
    private $especialidad;

    public function __construct($id, $usuario_id, $especialidad) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->especialidad = $especialidad;
    }

    // Getters y setters
    public function getId() {
        return $this->id;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    public function getEspecialidad() {
        return $this->especialidad;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function setEspecialidad($especialidad) {
        $this->especialidad = $especialidad;
    }

    public function save() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO psicologos (usuario_id, especialidad) VALUES (?, ?)");
        $stmt->execute([$this->usuario_id, $this->especialidad]);
        $this->id = $pdo->lastInsertId();
    }
}

?>