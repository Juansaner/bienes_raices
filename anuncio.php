<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en venta junto al bosque</h1>

    <picture>
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$519,000,000</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p>4</p>
            </li>
        </ul>
        <p>Disfruta de la serenidad y la naturaleza en esta impresionante residencia ubicada frente al bosque. Esta magnífica propiedad ofrece una experiencia de vida única, fusionando la comodidad moderna con la tranquilidad del entorno natural. Desde el momento en que entras, serás recibido por una sensación de paz y calma, gracias a las vistas panorámicas del exuberante bosque que se extiende frente a la casa.

            Esta casa cuenta con amplios espacios diseñados para el entretenimiento y el relax. El área de estar principal, inundada de luz natural, ofrece un ambiente acogedor para reuniones familiares o sociales.</p>

        <p>Sin embargo, el verdadero oasis se encuentra al aire libre. Un jardín meticulosamente cuidado conduce a una impresionante piscina, donde podrás refrescarte y relajarte mientras disfrutas de las vistas al bosque. La terraza, perfectamente integrada en el paisaje, es el lugar ideal para disfrutar de cenas al aire libre o simplemente contemplar la belleza natural que te rodea.

            Con una ubicación privilegiada frente al bosque, esta casa ofrece la combinación perfecta de privacidad y conexión con la naturaleza. Experimenta el lujo de vivir en armonía con tu entorno en esta excepcional propiedad.</p>
    </div>
</main>

<?php
include './includes/templates/footer.php';
?>