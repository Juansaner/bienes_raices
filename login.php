<?php

require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

//Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
        $errores[] = "El email es obligatorio";
    }

    if(!$password) {
        $errores[] = "El password es obligatorio";
    }

    if(empty($errores)) {
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);
        

        if($resultado->num_rows){
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            //Verificar si el password es correcto o no
            $auth = password_verify($password, $usuario['password']);
            if($auth){
                //El usuario está autenticado
            } else {
                $errores[] = 'El password es incorrecto';
            }
        }else {
            $errores[] = "El usuario no existe";
        }
    }
}

require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Iniciar sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>    

    <form class="formulario" method="POST">
        <fieldset>
            <legend>E-mail y password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="E-mail" id="email" >

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" id="password" >
        </fieldset>

        <input type="submit" value="Iniciar sesión" class="boton boton-azul">
    </form>
</main>

<?php
incluirTemplate('footer');
?>