<?php
    include_once '../../config/database.php';
    include_once '../models/Usuario.php';
    include_once '../models/Paciente.php';
    include_once '../models/Psicologo.php';

    function registrarUsuario(){
        
        
        if (Usuario::findByEmail($_POST['email']) === null) {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $tipo_usuario = $_POST['tipo_usuario'];

           
            $usuario = new Usuario(null, $nombre, $email, $password, date('Y-m-d H:i:s'), $tipo_usuario);
            $usuario->save();

            if($tipo_usuario === 'paciente') {
                registrarPaciente();
            } else if($tipo_usuario === 'psicologo') {
                registrarPsicologo();
            }

            
            header('Location: /public/index.php');
            exit();
        } 
    }

    function registrarPaciente() {
        $usuario_id = Usuario::findByEmail($_POST['email'])->getId();
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $paciente = new Paciente(null, $usuario_id, $fecha_nacimiento);
        $paciente->save();
    }

    function registrarPsicologo() {
        $usuario_id = Usuario::findByEmail($_POST['email'])->getId();
        $especialidad = $_POST['especialidad'];
        $psicologo = new Psicologo(null, $usuario_id, $especialidad);
        $psicologo->save();
    }

?>