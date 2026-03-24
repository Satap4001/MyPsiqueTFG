<?php
    include_once '../../config/database.php';
    include_once '../models/Usuario.php';
    include_once '../models/Paciente.php';
    include_once '../models/Psicologo.php';

    function registrarUsuario(){

        /*
    
            id (auto incrm ) 
            email (formu ) 
            nombre ( formu ) 
            contraseña ( formu ) 
            fecha_alta ( bbdd auto ) 
            avatar ( null )
            fecha_modificacion ( bbdd null ) 
            telefono_contacto  ( form ) 
            sexo ( formu ) 
            fecha_nacimiento ( formu ) 

        */ 
        
        
        if (Usuario::findByEmail($_POST['email']) === null) {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $fecha_alta = date('Y-m-d H:i:s');
            $fecha_modificacion = null;
            $tipo_usuario = $_POST['tipo_usuario'];

           
            $usuario = new Usuario(null, $nombre, $email, $password, $fecha_alta, $tipo_usuario, null, null, $fecha_nacimiento, $fecha_modificacion );
            $usuario->insert();

            if($tipo_usuario === 'paciente') {
                registrarPaciente($email);
            } else if($tipo_usuario === 'psicologo') {
                registrarPsicologo($email);
            }

            
            header('Location: /public/index.php');
            exit();
        } 
    }

    function registrarPaciente($email) {
        $usuario = Usuario::findByEmail($email);
        $usuario_id = $usuario['id'];
        
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $paciente = new Paciente(null, $usuario_id, $fecha_nacimiento);
        $paciente->insert();
    }

    function registrarPsicologo() {
        $usuario_id = Usuario::findByEmail($_POST['email'])['id'];
        $especialidad = $_POST['especialidad'];
        $psicologo = new Psicologo(null, $usuario_id, $especialidad);
        $psicologo->insert();
    }

    function loginUsuario() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = Usuario::findByEmail($email);
        if ($usuario && password_verify($password, $usuario->password)) {
            session_start();
            $_SESSION['user_id'] = $usuario->id;
            header('Location: /public/index.php');
            exit();
        } else {
            header('Location: /app/views/auth/login.php?error=1');
            exit();
        }
    }

    if($_POST['accion'] === 'registro') {
        registrarUsuario();
    } else if($_POST['accion'] === 'login') {
        loginUsuario();
    }
    

?>