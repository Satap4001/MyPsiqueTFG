<?php 
    include_once __DIR__ . '/../../config/database.php';
class Usuario {

    private $email;
    private $nombre;
    private $contrasena;
    private $fecha_alta;
    private $telefono_contacto;
    private $sexo;
    private $fecha_nacimiento;
    private $tipo; // 'paciente' o 'psicologo'
    private $fecha_modificacion;
    private $avatar;

    public function __construct($nombre, $email, $contrasena, $fecha_alta, $tipo, $telefono_contacto = null, $sexo = null, $fecha_nacimiento = null, $fecha_modificacion = null, $avatar = null) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $this->fecha_alta = $fecha_alta;
        $this->tipo = $tipo;
        $this->telefono_contacto = $telefono_contacto;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_modificacion = $fecha_modificacion;
        $this->avatar = $avatar;
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, contrasena, fecha_alta, tipo, telefono_contacto, sexo, fecha_nacimiento, fecha_modificacion, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->nombre, $this->email, $this->contrasena, $this->fecha_alta, $this->tipo, $this->telefono_contacto, $this->sexo, $this->fecha_nacimiento, $this->fecha_modificacion, $this->avatar]);
    }

    public static function findByEmail($email) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        if ($row) {
            return $row; 
        }
        return null;
    }

    public static function findById($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        if ($row) {
            return $row; 
        }
        return null;
    }

    public static function findByName($nombre) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre LIKE ?");
        $stmt->execute(["%$nombre%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   

    public static function returnIdByEmail($email) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }

    static public function update($email, $nombre, $contrasena, $telefono_contacto, $sexo, $avatar) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, contrasena = ?, fecha_modificacion = ?, telefono_contacto = ?, sexo = ?, avatar = ? WHERE email = ?");
        $stmt->execute([$nombre, $email, password_hash($contrasena, PASSWORD_DEFAULT), date('Y-m-d H:i:s'), $telefono_contacto, $sexo, $avatar, $email]);
    }

    public static function delete($email) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
    }
    

}

?>