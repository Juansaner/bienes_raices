<?php
require 'includes/app.php';
incluirTemplate('header', $inicio = true);
?>

<main class="contenedor seccion">
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
</main>

<section class="seccion contenedor">
    <h2>Inmuebles en venta</h2>

    <?php 
    $limite = 3;
    include 'includes/templates/anuncios.php'; 
    ?>

    <div class="alinear-derecha">
        <a href="anuncios.html" class="btn-azul">Ver todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo.</p>
    <a href="contacto.html" class="boton-azul">Contáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin.</span></p>

                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.</p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin.</span></p>

                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.</p>
                </a>
            </div>
        </article>
    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Juan Pablo Sandoval</p>
        </div>
    </section>
</div>

<?php
incluirTemplate('footer');
?>