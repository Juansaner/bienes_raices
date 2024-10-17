<?php 
    session_start();
//Arreglo vacio para cerrar sesión
    $_SESSION = [];
    
    header('Location: /bienesraices/index.php');
