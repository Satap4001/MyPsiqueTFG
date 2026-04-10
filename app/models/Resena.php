<?php 
    include_once __DIR__ . '/../../config/database.php';
    class Resena {
        private $id;
        private $usuario_id;
        private $psicologo_id;
        private $calificacion;
        private $descripcion;
        private $fecha_comentario;

        public function __construct($id, $usuario_id, $psicologo_id, $calificacion, $descripcion, $fecha_comentario) {
            $this->id = $id;
            $this->usuario_id = $usuario_id;
            $this->psicologo_id = $psicologo_id;
            $this->calificacion = $calificacion;
            $this->descripcion = $descripcion;
            $this->fecha_comentario = $fecha_comentario;
        }

        public static function findByPsicologoId($psicologo_id) {
            $pdo = connectDB();
            $query = "SELECT * FROM resenas WHERE psicologo_id = :psicologo_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':psicologo_id', $psicologo_id, PDO::PARAM_INT);
            $stmt->execute();
            $resenas = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resenas[] = new Resena(
                    $row['id'],
                    $row['usuario_id'],
                    $row['psicologo_id'],
                    $row['calificacion'],
                    $row['descripcion'],
                    $row['fecha_comentario']
                );
            }
            return $resenas;
        }

        public static function insert($usuario_id, $psicologo_id, $calificacion, $descripcion) {
            $pdo = connectDB();
            $query = "INSERT INTO resenas (usuario_id, psicologo_id, calificacion, descripcion, fecha_comentario) VALUES (:usuario_id, :psicologo_id, :calificacion, :descripcion, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':psicologo_id', $psicologo_id, PDO::PARAM_INT);
            $stmt->bindParam(':calificacion', $calificacion, PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            return $stmt->execute();
        }
        
    }

?>