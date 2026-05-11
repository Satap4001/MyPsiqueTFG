<?php 

require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Conversacion.php';
require_once __DIR__ . '/../Models/Mensaje.php';

session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['Accion'] === 'getConversations') {

        $usuario = $_SESSION['user_id'] ?? null;
        if ($_SESSION['tipo'] === 'paciente') {
            $paciente_id = $usuario;
            $psicologo_id = $_GET['psicologo_id'] ?? null;
        } else if ($_SESSION['tipo'] === 'psicologo') {
            $psicologo_id = $usuario;
            $paciente_id = $_GET['paciente_id'] ?? null;
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Tipo de usuario no válido']);
            exit;
        }

        if (!Conversacion::findConversationByIds((int)$paciente_id, (int)$psicologo_id)) {
            Conversacion::createConversation((int)$paciente_id, (int)$psicologo_id);
        }
        $conversaciones = Conversacion::findConversationByUser((int)$paciente_id, (int)$psicologo_id);
        
        echo json_encode($conversaciones);
        exit;
    }
    

    
}

?>