<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">

        <h2>Inmuebles en venta</h2>

            <?php
            $limite = 6;
            include 'includes/templates/anuncios.php';
            ?>
        
</main>

<?php
incluirTemplate('footer');
?>