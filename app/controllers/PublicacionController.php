<?php

    include_once '../models/Publicacion.php';
    include_once '../models/Usuario.php';
    include_once '../models/Psicologo.php';
    

    

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        session_start();
        $publicaciones = Publicacion::getAll();
        header('Content-Type: application/json');
        echo json_encode($publicaciones);
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['contenido'];
        
        $id_psicologo = Psicologo::findByUserId($_POST['user_id'])['id'];
        
        $publicacion = new Publicacion($id_psicologo, $titulo, $descripcion, date('Y-m-d H:i:s'), null, null, null, 0);
        
        if ($publicacion->insert()) {
            header('Location: /MyPsiqueTFG/app/views/psicologos/buscar.php');
            exit;
        } else {
            header('Location: /MyPsiqueTFG/app/views/psicologos/buscar.php');
            exit;

        }
    }


?>