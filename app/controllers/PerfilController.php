<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Psicologo.php';
require_once __DIR__ . '/../Models/Publicacion.php';

session_start();
header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'user_id requerido']);
    exit;
}

$usuario   = Usuario::findById((int)$user_id);
$psicologo = Psicologo::findByUserId((int)$user_id);

if (!$usuario) {
    http_response_code(404);
    echo json_encode(['error' => 'Usuario no encontrado']);
    exit;
}

$publicaciones = [];
if ($psicologo) {
    $publicaciones = Publicacion::findByPsicologoId($psicologo['id']);
}
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $usuario['id']) {
    $esPropietario = true;
} else {
    $esPropietario = false;
}

echo json_encode([
    'nombre'       => $usuario['nombre'],
    'email'        => $usuario['email'],
    'tipo'         => $usuario['tipo'],
    'avatar'       => $usuario['avatar'],
    'especialidad' => $psicologo['especialidad'] ?? null,
    'telefono'     => $usuario['telefono_contacto'] ?? null,
    'id'           => $psicologo['id'] ?? null,
    'esPropietario'=> $esPropietario,
    'publicaciones'=> $publicaciones
]);