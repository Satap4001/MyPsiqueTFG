<?php 
    
    include_once '../models/Psicologo.php';
    include_once '../models/Sesion.php';
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        // RECIBE EL ID DE USUARIO
        if (isset($_GET['id_psicologo'])){
            $id_psicologo = $_GET['id_psicologo'];
        }
        if (isset($_GET['Accion']) && $_GET['Accion'] === 'obtenerDiasMes' && isset($_GET['fecha']) && isset($_GET['id_psicologo'])) {
            $fecha = $_GET['fecha'];
            $sesiones = Sesion::findByPsicologoAndMonth($id_psicologo, $fecha);
            echo json_encode($sesiones);
            exit;
        } elseif (isset($_GET['Accion']) && $_GET['Accion'] === 'obtenerHorasDia' && isset($_GET['fecha']) && isset($_GET['id_psicologo'])) {
            $fecha = $_GET['fecha'];
            $sesiones = Sesion::findByPsicologoAndDay($id_psicologo, $fecha);
            echo json_encode($sesiones);
            exit;
        } else {
            exit;
        }
        
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id_psicologo = $data['id_psicologo'];
        $id_paciente = $data['id_paciente'];
        $fecha_sesion = $data['fecha_sesion'];
        $fecha_fin = $data['fecha_fin'];
        $resumen = $data['resumen'];
        $titulo = $data['titulo'];

        $sesion = new Sesion($id_psicologo, $fecha_sesion, $fecha_fin, $id_paciente, $resumen, $titulo);
        $sesion->insert();
        echo json_encode(['message' => 'Sesión creada correctamente']);
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id_psicologo = $data['id_psicologo'];
        $fecha_sesion = $data['fecha_sesion'];
        Sesion::delete($id_psicologo, $fecha_sesion);
        echo json_encode(['message' => 'Sesión eliminada correctamente']);
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $id_psicologo = $data['id_psicologo'];
        $id_paciente = $data['id_paciente'];
        $fecha_sesion = $data['fecha_sesion'];
        $fecha_fin = $data['fecha_fin'];
        $resumen = $data['resumen'];
        $titulo = $data['titulo'];

        Sesion::update($id, $id_psicologo, $id_paciente, $fecha_sesion, $fecha_fin, $resumen, $titulo);
        echo json_encode(['message' => 'Sesión actualizada correctamente']);
        exit;
    }

?>