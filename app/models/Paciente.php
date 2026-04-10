<?php

class Paciente {
    
    private $usuario_id;
    

    public function __construct($usuario_id) {
        $this->usuario_id = $usuario_id;
        
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO pacientes (id_usuario) VALUES (?)");
        $stmt->execute([$this->usuario_id]);
    }

    public function returnIdByEmail($email) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }

    
}

?>