<?php 

function getUsuarioByName(string $nombre) {
    $usuarios = Usuario::findByName($nombre);
    return $usuarios;
}

?> 