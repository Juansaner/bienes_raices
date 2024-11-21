<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /bienesraices/admin');
}

//Obtener los datos del vendedor
$vendedor = Vendedor::find($id);
debuguear($vendedor);

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Asignar los valores
    $args = $_POST['vendedor'];

    //Sincronizar objeto en memoria con los que el usuario ingresó
    $vendedor->sincronizar($args);

    //Validar
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
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
