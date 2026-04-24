<?php 

include_once '../models/Sesion.php';
include_once '../models/Psicologo.php';
include_once '../models/Paciente.php';
include_once '../models/Usuario.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sesion = new Sesion(
            $_POST['psicologo_id'],
            $_POST['paciente_id'] ?? null,
            $_POST['fecha_inicio'],
            $_POST['fecha_fin'],
            $_POST['resumen'] ?? null,
            $_POST['titulo'] ?? null
        );

        if($sesion->insert()) {
            header('Location: /MyPsiqueTFG/dashboard/calendarioSesiones.php?id=' . $_POST['psicologo_id']);
            exit();
        } else {
            echo "Error al guardar la sesión.";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $sesiones = Sesion::findByPsicologo($_GET['id']);
        echo json_encode($sesiones);
    
    }
    
    elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        if($_GET['tipo'] == 'psicologo' ){

        } elseif ($_GET['tipo'] == 'paciente') {

        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parse_str(file_get_contents("php://input"), $data);
        if(isset($data['id'])) {
            Sesion::delete($data['id']);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        }
    }


?>