<?php
include_once '../../config/database.php';
    class Conversacion {

        private $id;
        private $paciente_id;
        private $psicologo_id;

        public function __construct($id, $paciente_id, $psicologo_id) {
            $this->id = $id;
            $this->paciente_id = $paciente_id;
            $this->psicologo_id = $psicologo_id;
        }

        public static function findConversationByIds($paciente_id, $psicologo_id) {
            $pdo = connectDB();
            $stmt = $pdo->prepare("SELECT * FROM conversaciones WHERE id_paciente = ? AND id_psicologo = ?");
            $stmt->execute([$paciente_id, $psicologo_id]);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
            
        }

        public static function findConversationByUser($paciente_id, $psicologo_id) {
            $pdo = connectDB();
            $stmt = $pdo->prepare("SELECT * FROM conversaciones WHERE id_paciente = ? OR id_psicologo = ?");
            $stmt->execute([$paciente_id, $psicologo_id]);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        }

        public static function createConversation($paciente_id, $psicologo_id) {
            $pdo = connectDB();
            $stmt = $pdo->prepare("INSERT INTO conversaciones (id_paciente, id_psicologo) VALUES (?, ?)");
            $stmt->execute([$paciente_id, $psicologo_id]);
            return $pdo->lastInsertId();
        }
    }

?>