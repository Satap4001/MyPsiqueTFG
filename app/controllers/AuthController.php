<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Psicologo.php';







function registrarUsuario() {

    

    
    

    if (Usuario::findByEmail($_POST['email']) !== null) {
        header('Location: /app/views/auth/register.php?error=email_exists');
        exit();
    }

    $nombre           = $_POST['nombre'];
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $sexo             = $_POST['sexo'] ?? null;
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_alta       = date('Y-m-d H:i:s');
    $tipo_usuario     = $_POST['tipo_usuario'];  // 'paciente' o 'psicologo'

    $usuario = new Usuario($nombre, $email, $password, $fecha_alta, $tipo_usuario, null, $sexo, $fecha_nacimiento);
    $usuario->insert();

    
    if ($tipo_usuario === 'paciente') {
        registrarPaciente($email);
    } elseif ($tipo_usuario === 'psicologo') {
        registrarPsicologo($email);   
    }

    header('Location: /MyPsiqueTFG/public/index.php'); 
    exit();
}

function registrarPaciente(string $email): void {
    $usuario_id = Usuario::returnIdByEmail($email);
    $_SESSION['user_id'] = $usuario_id;
    $_SESSION['tipo'] = 'paciente';
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['email'] = $email;
    $paciente = new Paciente($usuario_id);
    $paciente->insert();
}


function registrarPsicologo(string $email): void {
    $usuario_id = Usuario::returnIdByEmail($email);

    $especialidad = $_POST['especialidad'];
    $nacionalidad = $_POST['nacionalidad'];
    $psicologo = new Psicologo($usuario_id, $nacionalidad, $especialidad);
    $_SESSION['user_id'] = $usuario_id;
    $_SESSION['tipo'] = 'psicologo';
    $_SESSION['nombre'] = $_POST['nombre']; 
    $_SESSION['email'] = $email;
    $_SESSION['telefono'] = $_POST['telefono'];
    $psicologo->insert();
}

function loginUsuario(): void {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $usuario = Usuario::findByEmail($email);
    

    if ($password && password_verify($password, $usuario['contrasena'])) {
        session_start();
        $_SESSION['user_id']   = $usuario['id'];
        $_SESSION['tipo']      = $usuario['tipo'];
        $_SESSION['nombre']    = $usuario['nombre'];
        $_SESSION['email']     = $usuario['email']; 
        if ($usuario['tipo'] === 'psicologo') {
            
            $_SESSION['telefono'] = $_POST['telefono'];
        }
        header('Location: /MyPsiqueTFG/public/index.php');
    } else {
        header('Location: /MyPsiqueTFG/app/views/auth/login.php?error=credenciales');
    }
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'registro') {
        registrarUsuario();
    } elseif ($accion === 'login') {
        loginUsuario();
    } elseif ($accion === 'obtenerDatos') {
        session_start();
        if (isset($_SESSION['email'])) {

            $datos = Usuario::returnIdByEmail($_SESSION['email']);            
        }
    } else {
    
        header('Location: /app/views/auth/register.php');
        exit();
    }
}
?>