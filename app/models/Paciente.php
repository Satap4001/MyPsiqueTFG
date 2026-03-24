<?php

class Paciente {

    /*
            Paciente va a tener = 

        id ( auto incrm ) 
        id_usuario ( de tabla Usuarios ) 
     */
    
    private $usuario_id;
    

    public function __construct($usuario_id) {
        $this->usuario_id = $usuario_id;
        
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO pacientes (usuario_id) VALUES (?)");
        $stmt->execute([$this->usuario_id]);
    }

    

    
}

?>