<?php 
include_once '../../config/database.php';
class Psicologo {

    /*
    
        Psicologo va a tener  =

        id ( auto incrm ) 
        id_usuario ( de tabla Usuarios ) 
        nacionalidad ( formu ) 
        especialidad ( formu ) 


    */ 
    
    private $usuario_id;
    private $nacionalidad;
    private $especialidad;

    public function __construct($usuario_id, $nacionalidad, $especialidad) {
        
        $this->usuario_id = $usuario_id;
        $this->nacionalidad = $nacionalidad;
        $this->especialidad = $especialidad;
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO psicologos (id_usuario, nacionalidad, especialidad) VALUES (?, ?, ?)");
        $stmt->execute([$this->usuario_id, $this->nacionalidad, $this->especialidad]);
        
    }

    public function update($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("UPDATE psicologos SET id_usuario = ?, nacionalidad = ?, especialidad = ? WHERE id = ?");
        $stmt->execute([$this->usuario_id, $this->nacionalidad, $this->especialidad, $id]);
    }

    public static function delete($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("DELETE FROM psicologos WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function getAll() {
        $pdo = connectDB();
        $stmt = $pdo->query("SELECT * FROM psicologos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findByUserId($user_id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM psicologos WHERE id_usuario = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>