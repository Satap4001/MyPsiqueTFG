<?php
    include_once '../../config/database.php';
    include_once '../models/Usuario.php';
    include_once '../models/Paciente.php';

    function registrarPaciente(){

        $pdo = connectDB();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $telefono = $_POST['telefono'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];

            // Aquí deberías agregar la lógica para guardar el paciente en la base de datos
            // Por ejemplo, podrías usar PDO para insertar los datos en una tabla "pacientes"

            // Después de registrar al paciente, redirige a la página de inicio o a su perfil
            header('Location: /public/index.php');
            exit();
        } else {
            
        }
    }

?>