<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Crea un nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);
    
    //Validar que no haya errores
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
}


incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Registrar vendedor</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-azul">Volver</a>

    <?php foreach($errores as $error): ?>
     <div class="alerta error">
        <?php echo $error; ?>
     </div>   
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/bienesraices/admin/vendedores/crear.php">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar vendedor" class="boton boton-azul">
    </form>
</main>

<?php
incluirTemplate('footer');
?>
