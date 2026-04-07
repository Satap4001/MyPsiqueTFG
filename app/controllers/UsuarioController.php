<?php 

    function getUsuarioByName(string $nombre) {
        $usuarios = Usuario::findByName($nombre);
        return $usuarios;
    }

    function getUsuarioByEmail(string $email) {
        $usuario = Usuario::findByEmail($email);
        return $usuario;
    }

?> 