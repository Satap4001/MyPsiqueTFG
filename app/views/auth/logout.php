<?php

    session_start();
    $_SESSION = [];
    session_destroy();
    header('Location: /MyPsiqueTFG/public/index.php');
    exit();

?>