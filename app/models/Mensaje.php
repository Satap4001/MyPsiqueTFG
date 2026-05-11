<?php 

    class Mensaje {
        private $id;
        private $contenido;
        private $fecha;
        private $usuario_id;

        public function __construct($id, $contenido, $fecha, $usuario_id) {
            $this->id = $id;
            $this->contenido = $contenido;
            $this->fecha = $fecha;
            $this->usuario_id = $usuario_id;
        }

        public function getId() {
            return $this->id;
        }

        public function getContenido() {
            return $this->contenido;
        }

        public function getFecha() {
            return $this->fecha;
        }

        public function getUsuarioId() {
            return $this->usuario_id;
        }

        public function getAllMessagesByConversationId($conversationId) {
            $pdo = connectDB();
            $stmt = $pdo->prepare("SELECT * FROM mensajes WHERE conversation_id = ?");
            $stmt->execute([$conversationId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>