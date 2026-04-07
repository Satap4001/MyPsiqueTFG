<?php 

include_once '../models/Sesion.php';

    function verifyDay($fecha) {
        return Sesion::findByDate($fecha);
    }


?>