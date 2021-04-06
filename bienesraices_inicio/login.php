<?php

// Importar conexion
require 'includes/config/database.php';
$db =  conectarDB();

$errores = [];

// Autenticar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitizacion de datos
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
        $errores[] = "El email es obligatorio o no es valido"; // y acompano con un required en campos htmml
        # Verifico por frontend y backend
    }
    if(!$password) {
        $errores[] = "El password es obligatorio";
    }

    // Si ta todo bien veo si puede iniciar sesion o no
    if(empty($errores)) {

        // Reviso si existe el usuario
        $query = "SELECT * FROM usuarios WHERE email = '${email}';";
        $resultado = mysqli_query($db, $query); //leo los resultados de la db si existe el usuario o no
        
        if($resultado->num_rows){
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto o no
            $auth = password_verify($password , $usuario['password']); // si coloco el pass correcto lo toma

            if($auth) { #debo poner un session start en el archivo a acceder con este usuario
                # Usuario autenticado
                session_start();

                # Llenar arreglo de sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');

            } else {
                $errores[] = 'El password es incorrecto';
            }
        } else {
            $errores[] = "El Usuario no existe.";
        }
    }
}


// Header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu password" required>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>