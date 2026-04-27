<?php 
    include_once '../../config/database.php';
class Sesion {

    private $id_psicologo;
    private $id_paciente;
    private $fecha_sesion;
    private $fecha_fin;
    private $resumen;
    private $titulo;

    public function __construct($id_psicologo, $fecha_sesion, $fecha_fin, $id_paciente = null, $resumen = null, $titulo = null) {
        $this->id_psicologo = $id_psicologo;
        $this->id_paciente = $id_paciente;
        $this->fecha_sesion = $fecha_sesion;
        $this->fecha_fin = $fecha_fin;
        $this->resumen = $resumen;
        $this->titulo = $titulo;
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO sesiones (id_psicologo, id_paciente, fecha_sesion, fecha_fin, resumen, titulo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->id_psicologo, $this->id_paciente, $this->fecha_sesion, $this->fecha_fin, $this->resumen, $this->titulo]);
    }

    public static function delete($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("DELETE FROM sesiones WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function update($id, $id_psicologo, $id_paciente, $fecha_sesion, $fecha_fin, $resumen, $titulo) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("UPDATE sesiones SET id_psicologo = ?, id_paciente = ?, fecha_sesion = ?, fecha_fin = ?, resumen = ?, titulo = ? WHERE id = ?");
        $stmt->execute([$id_psicologo, $id_paciente, $fecha_sesion, $fecha_fin, $resumen, $titulo, $id]);
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
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE DATE(fecha_sesion) = ?");
        $stmt->execute([$fecha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function findByPsicologoAndDay($id_psicologo, $fecha) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE id_psicologo = ? AND DATE(fecha_sesion) = ?");
        $stmt->execute([$id_psicologo, $fecha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function findByPsicologoAndMonth($id_psicologo, $fecha) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM sesiones WHERE id_psicologo = ? AND MONTH(fecha_sesion) = MONTH(?) AND YEAR(fecha_sesion) = YEAR(?)");
        $stmt->execute([$id_psicologo, $fecha, $fecha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

}