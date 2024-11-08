<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');

    if(!$db) {
        echo 'Error no se pudo conectar: ' . mysqli_connect_error();
        exit;
    } 

    return $db;
}

?>