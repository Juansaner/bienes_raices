<?php

$resultad = $_GET['resultado']?? null;
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de bienes raíces</h1>
    <?php if($resultado == 1): ?>
        <p class="alerta exito"> Anuncio creado correctamente </p>
     <?php endif; ?>   
    <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-azul">Nueva propiedad</a>
</main>

<?php
incluirTemplate('footer');
?>