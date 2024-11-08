<?php

require '../includes/funciones.php';
//Verifica si está autenticado
$auth = estaAutenticado();

if(!$auth) {
    header('Location: /bienesraices/index.php');
}

//Importar la conexión
require '../includes/config/database.php';
$db = conectarDB();
//Escribir el query 
$query = "SELECT * FROM propiedades";
//Consultar la BD
$resultadoConsulta = mysqli_query($db, $query);

//Muestra mensaje condicional 
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        //Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = $id";

        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen'] . '.jpg');
        //Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE id = '$id'";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('location: /bienesraices/admin/index.php?resultado=3');
        }
    }
}

//Incluye un template
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de bienes raíces</h1>
    <?php if (intval($resultado)  === 1): ?>
        <p class="alerta exito"> Anuncio creado correctamente </p>
    <?php elseif (intval($resultado)  === 2): ?>
        <p class="alerta exito"> Anuncio actualizado correctamente </p>
    <?php elseif (intval($resultado)  === 3): ?>
        <p class="alerta exito"> Anuncio eliminadocorrectamente </p>
    <?php endif; ?>
    
    <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-azul">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="/bienesraices/imagenes/<?php echo $propiedad['imagen'] . ".jpg"; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    <td>
                        <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-verde-block">Actualizar</a>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</main>

<?php

//Cerrar la conexión
mysqli_close($db);
incluirTemplate('footer');
?>