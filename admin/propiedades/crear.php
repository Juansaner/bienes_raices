<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

//Verifica si está autenticado
estaAutenticado();


//Base de datos
$db = conectarDB();

$propiedad = new Propiedad();

//Consulta para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Ejecuta el código después de que se envía el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    /** CREA UNA NUEVA INSTANCIA */
    $propiedad = new Propiedad($_POST);

     /**SUBIDA DE ARCHIVOS **/
    
    //Generar nombre imagen
    $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

    //Setear la imagen
    //Realiza un resize a la imagen con intervention
    if($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }
    
    //Validar
    $errores = $propiedad->validar();

    //Revisar que el array de errores esté vacío
    if(empty($errores)) {
       
        //Crear la carpeta para subir imagenes
        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        
        //Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guarda en la base de datos
        $resultado = $propiedad->guardar();
        
        //Mensaje de éxito
        if ($resultado) {
            //Redireccionar al usuario
            header("Location: /bienesraices/admin/index.php?resultado=1");
        }
    }
    
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/bienesraices/admin/index.php" class="boton boton-azul">Volver</a>

    <?php foreach($errores as $error): ?>
     <div class="alerta error">
        <?php echo $error; ?>
     </div>   
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/bienesraices/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear propiedad" class="boton boton-azul">
    </form>
</main>

<?php
incluirTemplate('footer');
?>