<?php

    define('TEMPLATES_URL',__DIR__. '/templates');
    define('FUNCIONES_URL', __DIR__.'funciones.php');
    define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado(): bool {
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /bienesraices/index.php');
    } 
    return true;
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapar / sanitizar HTML
function sanitizar($html) : string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

//Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo, $tipos);
}

function mostrarNostificaciones($codigo) {
    $mensaje = ' ';

    switch($codigo) {
        case 1: 
            $mensaje = 'Creado correctamente';
            break;
        case 2: 
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

