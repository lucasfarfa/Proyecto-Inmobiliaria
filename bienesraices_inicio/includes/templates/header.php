<?php

    if(!isset($_SESSION)){ # si no existe la sesion
        session_start();
    } # sino quiere decir que la sesion ya esta arrancada

    $auth = $_SESSION['login'] ?? false; #si no esta autenticado auth es null, sino true
     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class="header <?php echo /*isset(*/$inicio/*)*/ ? 'inicio' : ''; ?>"> <!-- evaluo si inicio esta definnido, agrego clase inicio -->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logotipo de bienes raices">
                </a>


                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href=" nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?> <!-- agrego el boton cerrar sesion si auth esta com otrue -->
                            <a href="cerrar-sesion.php">Cerra Sesión</a>
                        <?php endif; ?>

                    </nav>
                </div>

            </div> <!-- .barra -->

            <?php echo $inicio ? "<h1>Venta de casas y departamentos de lujo.</h1>" : ''; ?>

            
        </div>
    </header>