<?php
require_once '../models/Usuario.php';
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

    function guardarArchivo($archivo, $numVeces, $idPsicologo)
    {
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

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'] ?? null;
        $avatar = $_FILES['avatar'];

        $usuario = Usuario::findById($id);
        if ($usuario) {
            
            if (isset($telefono)) {
                $usuario->telefono = $telefono;
            }
            if (isset($avatar) && !empty($avatar['name'])) {
                $numVeces = count(glob('../uploads/avatar/' . $id . '_*'));
                $nombreArchivo = guardarArchivo($avatar, $numVeces, $id);
                if ($nombreArchivo) {
                    $usuario->avatar = $nombreArchivo;
                }
            }
            Usuario::update($email ? $email : $usuario->email, $nombre, $contrasena, $telefono_contacto, $sexo, $avatar);
            header('Location: /MyPsiqueTFG/app/views/dashboard/perfil.php?user_id=' . $id);
            exit();
        } else {
            echo "Usuario no encontrado.";
        }
    }
