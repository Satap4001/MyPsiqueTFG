<?php 
    include_once '../../config/database.php';
class Sesion {

    private $id_psicologo;
    private $id_paciente;
    private $fecha_inicio;
    private $fecha_fin;
    private $resumen;
    private $titulo;

    public function __construct($id_psicologo, $id_paciente = null, $fecha_inicio, $fecha_fin, $resumen = null, $titulo = null) {
        $this->id_psicologo = $id_psicologo;
        $this->id_paciente = $id_paciente;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->resumen = $resumen;
        $this->titulo = $titulo;
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO sesiones (id_psicologo, id_paciente, fecha_inicio, fecha_fin, resumen, titulo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->id_psicologo, $this->id_paciente, $this->fecha_inicio, $this->fecha_fin, $this->resumen, $this->titulo]);
    }

    public static function delete($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("DELETE FROM sesiones WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function update($id, $id_psicologo, $id_paciente, $fecha, $descripcion) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("UPDATE sesiones SET id_psicologo = ?, id_paciente = ?, fecha = ?, descripcion = ? WHERE id = ?");
        $stmt->execute([$id_psicologo, $id_paciente, $fecha, $descripcion, $id]);
    }

    public static function findById($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        if ($row) {
            return $row; 
        }
        return null;
    }

    public static function findByPsicologo($id_psicologo) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE id_psicologo = ?");
        $stmt->execute([$id_psicologo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function findByPaciente($id_paciente) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function findByDate($fecha) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE fecha = ?");
        $stmt->execute([$fecha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

}