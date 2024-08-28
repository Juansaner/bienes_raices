<?php

//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//Consulta para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
//Arreglo con mensajes de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedores_id = '';


//Ejecuta el código después de que se envía el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    //echo "<pre>";
    //var_dump($_FILES);
    //echo "</pre>";


    //Sanitizar las entradas
    $titulo = mysqli_real_escape_string( $db, filter_var(htmlspecialchars($_POST['titulo'])));
    $precio = mysqli_real_escape_string( $db, filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT));
    $descripcion = mysqli_real_escape_string( $db, filter_var(htmlspecialchars($_POST['descripcion'])));
    $habitaciones = mysqli_real_escape_string( $db, filter_var($_POST['habitaciones'], FILTER_SANITIZE_NUMBER_INT));
    $wc = mysqli_real_escape_string( $db, filter_var($_POST['wc'], FILTER_SANITIZE_NUMBER_INT));
    $estacionamiento = mysqli_real_escape_string( $db, filter_var($_POST['estacionamiento'], FILTER_SANITIZE_NUMBER_INT));
    $vendedores_id = mysqli_real_escape_string( $db, $_POST['vendedores_id']);
    $creado = date('Y/m/d');

    //Asignar files en una variable
    $imagen = $_FILES['imagen'];

    if(!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if(!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    
    if(strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    
    if(!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }

    if(!$wc) {
        $errores[] = "El número de baños es obligatorio";
    }

    if(!$estacionamiento) {
        $errores[] = "El número de lugares de estacionamiento es obligatorio";
    }

    if(!$vendedores_id) {
        $errores[] = "Elige un vendedor";
    }

    if(!$imagen['name'] || $imagen['error']) {
        $errores[] = "La imagen es obligatoria";
    }

    //Validar imagen por tamaño (1mb maximo)
    $medida = 1000 * 1000;
    
    if($imagen['size'] > $medida ){
        $errores[] = "La imagen es muy pesada";
    }

    //Revisar que el array de errores esté vacío

    if(empty($errores)) {

        /**SUBIDA DE ARCHIVOS **/

        //Crear carpeta
        $carpetaImagenes = __DIR__ . '../../../imagenes/';

        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        //Generar nombre imagen
        $nombreImagen = md5(uniqid(rand(), true));
        //Subir la imagen 
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes .$nombreImagen . '.jpg');
        


        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion','$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedores_id')";

        $resultado = mysqli_query($db, $query);

        if ($db) {
            //Redireccionar al usuario
            header("Location: /bienesraices/admin/index.php?resultado=1");
        }
    }
    
}

require '../../includes/funciones.php';
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
        <fieldset>
            <legend>Información general</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" ><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="">-- Seleccione --</option>
                <?php while($row = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedores_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'].' '.$row['apellido']; ?></option>
                    <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear propiedad" class="boton boton-azul">
    </form>
</main>

<?php
incluirTemplate('footer');
?>