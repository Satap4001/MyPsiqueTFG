<?php 

class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $created_at;
    private $type; // 'paciente' o 'psicologo'

    public function __construct($id, $nombre, $email, $password, $created_at, $type) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->type = $type;
    }

    // Getters y setters
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

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getType() {
        return $this->type;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setType($type) {
        $this->type = $type;
    }

    

}

?>