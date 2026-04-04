<?php
include_once '../../config/database.php';
class Publicacion {
    private $idPsicologo;
    private $titulo;
    private $descripcion;
    private $codigoImagen1;
    private $codigoImagen2;
    private $codigoImagen3;
    private $likes;
    private $fecha_creacion;

    public function __construct($idPsicologo, $titulo, $descripcion, $fecha_creacion, $codigoImagen1, $codigoImagen2, $codigoImagen3, $likes) {
        
        $this->idPsicologo = $idPsicologo;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha_creacion = $fecha_creacion;
        $this->codigoImagen1 = $codigoImagen1;
        $this->codigoImagen2 = $codigoImagen2;
        $this->codigoImagen3 = $codigoImagen3;
        $this->likes = $likes;
        
    }

    public function getIdPsicologo() {
        return $this->idPsicologo;
    }

    public function insert(){
        $pdo = connectDB();
        $sql = "INSERT INTO publicaciones (idPsicologo, titulo, descripcion, fecha_creacion, codigoImagen1, codigoImagen2, codigoImagen3, likes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->idPsicologo, $this->titulo, $this->descripcion, $this->fecha_creacion, $this->codigoImagen1, $this->codigoImagen2, $this->codigoImagen3, $this->likes]);


    }

    public function update($id) {
        $pdo = connectDB();
        $sql = "UPDATE publicaciones SET idPsicologo = ?, titulo = ?, descripcion = ?, fecha_creacion = ?, codigoImagen1 = ?, codigoImagen2 = ?, codigoImagen3 = ?, likes = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->idPsicologo, $this->titulo, $this->descripcion, $this->fecha_creacion, $this->codigoImagen1, $this->codigoImagen2, $this->codigoImagen3, $this->likes, $id]);
    }

    public static function delete($id) {
        $pdo = connectDB();
        $sql = "DELETE FROM publicaciones WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public static function findById($id) {
        $pdo = connectDB();
        $sql = "SELECT * FROM publicaciones WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll() {
        $pdo = connectDB();
        $sql = "SELECT * FROM publicaciones ORDER BY fecha_creacion DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>