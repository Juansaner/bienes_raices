<?php
require '../../includes/app.php';
use App\Propiedad;

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
$errores = [];

//Ejecuta el código después de que se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Sanitizar las entradas
    $titulo = mysqli_real_escape_string($db, filter_var(htmlspecialchars($_POST['titulo'])));
    $precio = mysqli_real_escape_string($db, filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT));
    $descripcion = mysqli_real_escape_string($db, filter_var(htmlspecialchars($_POST['descripcion'])));
    $habitaciones = mysqli_real_escape_string($db, filter_var($_POST['habitaciones'], FILTER_SANITIZE_NUMBER_INT));
    $wc = mysqli_real_escape_string($db, filter_var($_POST['wc'], FILTER_SANITIZE_NUMBER_INT));
    $estacionamiento = mysqli_real_escape_string($db, filter_var($_POST['estacionamiento'], FILTER_SANITIZE_NUMBER_INT));
    $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedores_id']);
    $creado = date('Y/m/d');

    //Asignar files en una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El número de baños es obligatorio";
    }

    if (!$estacionamiento) {
        $errores[] = "El número de lugares de estacionamiento es obligatorio";
    }

    if (!$vendedores_id) {
        $errores[] = "Elige un vendedor";
    }

    //Validar imagen por tamaño (1mb maximo)
    $medida = 1000 * 1000;

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    //Revisar que el array de errores esté vacío

    if (empty($errores)) {

        /**SUBIDA DE ARCHIVOS **/
        //Crear carpeta
        $carpetaImagenes = __DIR__.'../../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, 0755, true);
        }

        $nombreImagen = '';

        if ($imagen['name']) {
            //Eliminar imagen
            unlink($carpetaImagenes . $propiedad['imagen'] . ".jpg");

            //Generar nombre imagen
            $nombreImagen = md5(uniqid(rand(), true) );

            //Subir la imagen 
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");
        } else {
            $nombreImagen = $propiedad['imagen'];
        }

        //Insertar en la base de datos
        $query = "UPDATE propiedades SET titulo = '$titulo', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedores_id WHERE id = $id";

        $resultado = mysqli_query($db, $query);

        if (!$resultado) {
            die('Error en la consulta: ' . mysqli_error($db));
        }

        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /bienesraices/admin/index.php');
        }
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