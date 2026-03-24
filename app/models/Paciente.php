<?php

class Paciente {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $telefono;
    private $fecha_nacimiento;

    public function __construct($id, $nombre, $email, $password, $telefono, $fecha_nacimiento) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    // Getters y setters para cada propiedad
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }
}

?>