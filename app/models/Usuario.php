<?php 
    include_once '../../config/database.php';
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $created_at;
    private $type; // 'paciente' o 'psicologo'

    public function __construct($id, $nombre, $email, $password, $created_at, $type) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->type = $type;
    }

    public function save() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, created_at, type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->nombre, $this->email, $this->password, $this->created_at, $this->type]);
        $this->id = $pdo->lastInsertId();
    }

    public static function findByEmail($email) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Usuario($row['id'], $row['nombre'], $row['email'], $row['password'], $row['created_at'], $row['type']);
        }
        return null;
    }

    public static function findById($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Usuario($row['id'], $row['nombre'], $row['email'], $row['password'], $row['created_at'], $row['type']);
        }
        return null;
    }

}

?>