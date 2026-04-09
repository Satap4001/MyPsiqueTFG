<?php

    include_once '../models/Publicacion.php';
    include_once '../models/Usuario.php';
    include_once '../models/Psicologo.php';
    

    function obtenerPublicaciones($idPsicologo) {
        return Publicacion::findByPsicologoId($idPsicologo);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        session_start();

        $filtros = [
            'psicologo'   => $_GET['Psicologo'] ?? null,
            'titulo'      => $_GET['Titulo'] ?? null,
            'rangoPrecio' => $_GET['rangoPrecio'] ?? null,
            'descripcion' => $_GET['Descripcion'] ?? null
        ];

        if ($filtros['psicologo'] || $filtros['titulo'] || $filtros['rangoPrecio'] || $filtros['descripcion']) {
        $publicaciones = Publicacion::search($filtros);
        }     else {
            $publicaciones = Publicacion::getAll();
        }
        header('Content-Type: application/json');
        echo json_encode($publicaciones);
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        function generarStringRandom($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        function guardarArchivo($archivo, $numVeces, $idPsicologo) {
            $directorio = '../uploads/';
            if (!empty($archivo['name'])) {
                $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $nombreArchivo = $idPsicologo . '_' . generarStringRandom() . '_' . $numVeces . '.' . $extension;
                $rutaArchivo = $directorio . $nombreArchivo;
                move_uploaded_file($archivo['tmp_name'], $rutaArchivo);
                return $nombreArchivo;
            }
            return null;
        }
        
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['contenido'];
        
        $id_psicologo = Psicologo::findByUserId($_POST['user_id'])['id'];

        $imagen1 = $_FILES['imagen1']['name'] ?? null;
        $imagen2 = $_FILES['imagen2']['name'] ?? null;
        $imagen3 = $_FILES['imagen3']['name'] ?? null;

        $archivos = [$imagen1, $imagen2, $imagen3];

        for ($i = 0; $i < count($archivos); $i++) {
            if ($archivos[$i] !== null) {
                $nombreArchivo = guardarArchivo($_FILES['imagen' . ($i + 1)], $i + 1, $id_psicologo);
                ${'codigoImagen' . ($i + 1)} = $nombreArchivo;
            }
        }

        
        $publicacion = new Publicacion($id_psicologo, $titulo, $descripcion, date('Y-m-d H:i:s'), $codigoImagen1, $codigoImagen2, $codigoImagen3, 0);
        $publicacion->insert();
        
        header('Location: ../views/psicologos/buscar.php');
        exit;
       
    }


?>