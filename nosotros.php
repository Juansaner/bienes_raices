<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce sobre nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 años de experiencia
            </blockquote>

            <p>En UrbanLife nos enorgullece contar con una trayectoria sólida y una vasta experiencia en el mercado inmobiliario. Con más de 25 años de dedicación y compromiso, hemos sido líderes en la industria, brindando soluciones integrales y servicios de alta calidad a nuestros clientes. Nuestra empresa se ha ganado la confianza de miles de clientes gracias a nuestro enfoque personalizado, profesionalismo y ética de trabajo impecable. Desde nuestros inicios, nos hemos dedicado a superar las expectativas, ayudando a nuestros clientes a encontrar el hogar de sus sueños o a realizar inversiones inmobiliarias exitosas. Con un equipo altamente capacitado y una amplia red de contactos en el mercado, estamos preparados para guiarlo en cada paso del proceso, asegurando su satisfacción y éxito en cada transacción.</p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <div class="background-icono">
                <img src="build/img/icono1.png" alt="icono Seguridad" loading="lazy">
            </div>
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis explicabo itaque accusantium temporibus, repellat saepe recusandae rerum quo in assumenda aspernatur voluptatum dicta perferendis dolorem, qui praesentium incidunt aperiam odio.
            </p>
        </div> <!--.icono -->
        <div class="icono">
            <div class="background-icono">
                <img src="build/img/icono2.png" alt="icono precio" loading="lazy">
            </div>
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis explicabo itaque accusantium temporibus, repellat saepe recusandae rerum quo in assumenda aspernatur voluptatum dicta perferendis dolorem, qui praesentium incidunt aperiam odio.
            </p>
        </div> <!--.icono -->
        <div class="icono">
            <div class="background-icono">
                <img src="build/img/icono3.png" alt="icono tiempo" loading="lazy">
            </div>
            <h3>A tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis explicabo itaque accusantium temporibus, repellat saepe recusandae rerum quo in assumenda aspernatur voluptatum dicta perferendis dolorem, qui praesentium incidunt aperiam odio.
            </p>
        </div> <!--.icono -->
    </div>
</section>

<?php
incluirTemplate('footer');
?>