<?php 

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';
    
    //Conectarse a la BD
    $db = conectarDB();

    use App\Propiedad;

    Propiedad::setDB($db);