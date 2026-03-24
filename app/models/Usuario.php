<?php 
    include_once '../../config/database.php';
class Usuario {


    /*
    
        id (auto incrm ) 
        email (formu ) 
        nombre ( formu ) 
        contraseña ( formu ) 
        fecha_alta ( bbdd auto ) 
        avatar ( null )
        fecha_modificacion ( bbdd null ) 
        telefono_contacto  ( form ) 
        sexo ( formu ) 
        fecha_nacimiento ( formu ) 

    */ 

    private $email;
    private $nombre;
    private $password;
    private $created_at;
    private $telefono_contacto;
    private $sexo;
    private $fecha_nacimiento;
    private $tipo; // 'paciente' o 'psicologo'
    private $fecha_modificacion;
    private $avatar;

    public function __construct($nombre, $email, $password, $created_at, $tipo, $telefono_contacto = null, $sexo = null, $fecha_nacimiento = null, $fecha_modificacion = null, $avatar = null) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->created_at = $created_at;
        $this->tipo = $tipo;
        $this->telefono_contacto = $telefono_contacto;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_modificacion = $fecha_modificacion;
        $this->avatar = $avatar;
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, created_at, tipo, telefono_contacto, sexo, fecha_nacimiento, fecha_modificacion, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->nombre, $this->email, $this->password, $this->created_at, $this->tipo, $this->telefono_contacto, $this->sexo, $this->fecha_nacimiento, $this->fecha_modificacion, $this->avatar]);
    }

    public static function findByEmail($email) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Usuario($row['id'], $row['nombre'], $row['email'], $row['password'], $row['created_at'], $row['tipo'], $row['telefono_contacto'], $row['sexo'], $row['fecha_nacimiento'], $row['fecha_modificacion'], $row['avatar']);
        }
        return null;
    }

    public function findById($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Usuario($row['id'], $row['nombre'], $row['email'], $row['password'], $row['created_at'], $row['tipo'], $row['telefono_contacto'], $row['sexo'], $row['fecha_nacimiento'], $row['fecha_modificacion'], $row['avatar']);
        }
        return null;
    }

}

?>