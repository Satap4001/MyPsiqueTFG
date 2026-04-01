<?php

    include_once '../../models/Publicacion.php';

    // ... tu lógica de conexión y modelo

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Aquí debería estar tu función que obtiene todas las publicaciones:
        $publicaciones = Publicacion::getAll(); // O el método que uses

        // Devuelve como JSON
        header('Content-Type: application/json');
        echo json_encode($publicaciones);
        exit;
    }


?>