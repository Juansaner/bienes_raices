<?php
require '../../includes/app.php';
use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

//Validar URL por ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /bienesraices/admin/index.php');
}

//Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//Consulta para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Ejecuta el código después de que se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar los atributos
    $args = $_POST['propiedad'];
    
    $propiedad->sincronizar($args);
    
    $errores = $propiedad->validar();

    //Generar nombre imagen
    $nombreImagen = md5(uniqid(rand(), true)). ".jpg";
    //Subida de archivos
    if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    //Revisar que el array de errores esté vacío
    if (empty($errores)) {
        //Almacenar la imagen
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        $propiedad->guardar();
    }
}
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-azul">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar propiedad" class="boton boton-azul">
    </form>
</main>

<?php
incluirTemplate('footer');
?>