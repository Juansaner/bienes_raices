<?php
//Si la variable no está definida, inicia sesión 
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="Logotipo de bienes raíces">
                </a>

                <div class="menu-mobile">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 6l16 0" />
                        <path d="M4 12l16 0" />
                        <path d="M4 18l16 0" />
                    </svg>
                </div>

                <nav class="navegacion">
                    <div class="close-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#333333" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="navegacion-menu">
                        <div class="navegacion-enlaces">
                            <a href="/bienesraices/nosotros.php">Nosotros</a>
                            <a href="/bienesraices/anuncios.php">Anuncios</a>
                            <a href="/bienesraices/blog.php">Blog</a>
                            <a href="/bienesraices/contacto.php">Contacto</a>
                            <?php if (!$auth): ?>
                                <a href="/bienesraices/login.php">Login</a>
                            <?php endif; ?>
                            <?php if ($auth): ?>
                                <a href="/bienesraices/admin/index.php">Administrar</a>
                                <a href="/bienesraices/cerrar-sesion.php">Cerrar sesión</a>
                            <?php endif; ?>
                        </div>
                        <div class="navegacion-dark-mode">
                            <img class="dark-mode-boton" src="/bienesraices/build/img/dark-mode.svg" alt="Icono de dark mode">
                            <p id="dark-mode-texto">Modo oscuro</p>
                        </div>
                    </div>
                </nav>
            </div> <!--- .barra -->

            <?php if ($inicio) { ?>
                <h1>Venta de casas y apartamentos exclusivos de lujo</h1>
            <?php } ?>
        </div>
    </header>