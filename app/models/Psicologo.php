<?php 

class Psicologo {

    /*
    
        Psicologo va a tener  =

        id ( auto incrm ) 
        id_usuario ( de tabla Usuarios ) 
        nacionalidad ( formu ) 
        especialidad ( formu ) 


    */ 
    
    private $usuario_id;
    private $nacionalidad;
    private $especialidad;

    public function __construct($usuario_id, $nacionalidad, $especialidad) {
        
        $this->usuario_id = $usuario_id;
        $this->nacionalidad = $nacionalidad;
        $this->especialidad = $especialidad;
    }

    public function insert() {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO psicologos (usuario_id, nacionalidad, especialidad) VALUES (?, ?, ?)");
        $stmt->execute([$this->usuario_id, $this->nacionalidad, $this->especialidad]);
        
    }
}

?>