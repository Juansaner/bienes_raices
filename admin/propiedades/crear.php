<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

//Verifica si está autenticado
estaAutenticado();

$propiedad = new Propiedad();

//Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Ejecuta el código después de que se envía el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    /** CREA UNA NUEVA INSTANCIA */
    $propiedad = new Propiedad($_POST['propiedad']);

     /**SUBIDA DE ARCHIVOS **/
    
    //Generar nombre imagen
    $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

    //Setear la imagen
    //Realiza un resize a la imagen con intervention
    if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
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
        $propiedad->guardar(); 
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