<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

if(empty($errores)) {

}

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar vendedor</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-azul">Volver</a>

    <?php foreach($errores as $error): ?>
     <div class="alerta error">
        <?php echo $error; ?>
     </div>   
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/bienesraices/admin/vendedores/actualizar.php">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Guardar cambios" class="boton boton-azul">
    </form>
</main>

<?php
incluirTemplate('footer');
?>
