<?php
require_once '../models/Usuario.php';
require_once '../models/Psicologo.php';
    function getUsuarioByName(string $nombre)
    {
        $usuarios = Usuario::findByName($nombre);
        return $usuarios;
    }

    function getUsuarioByEmail(string $email)
    {
        $usuario = Usuario::findByEmail($email);
        return $usuario;
    }

    function generarStringRandom($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function guardarArchivo($archivo, $idPsicologo)
    {
        $directorio = '../uploads/avatar/';
        if (!empty($archivo['name'])) {
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $nombreArchivo = $idPsicologo . '_' . generarStringRandom() . '_' . '.' . $extension;
            $rutaArchivo = $directorio . $nombreArchivo;
            move_uploaded_file($archivo['tmp_name'], $rutaArchivo);
            return $nombreArchivo;
        }
        return null;
    }

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
        session_start();
        
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'] ?? null;
        $avatar = $_FILES['avatar'];
        $contrasena = $_POST['contrasena'] ?? null;
        

        
        $usuario = Usuario::findByEmail($email);
        if ($usuario) {
            
            
            
            if (isset($avatar) && !empty($avatar['name'])) {
                $nombreArchivo = guardarArchivo($avatar, $usuario['id']);
                $avatar = $nombreArchivo;
            }
            Usuario::update($email ?: $usuario->email, $nombre, $contrasena, $telefono, $usuario['sexo'], $avatar);
            header('Location: /MyPsiqueTFG/app/views/dashboard/perfil.php?user_id=' . $usuario['id']);
            exit();
        } else {
            echo "Usuario no encontrado.";
        }
    }
