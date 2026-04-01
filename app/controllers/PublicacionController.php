<?php

    include_once '../../models/Publicacion.php';

    

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $publicaciones = Publicacion::getAll(); 

        
        header('Content-Type: application/json');
        echo json_encode($publicaciones);
        exit;
    }


?>