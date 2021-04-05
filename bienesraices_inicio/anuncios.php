<?php 
    require 'includes/funciones.php';
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion">

        <h2>Casas y deptos en venta</h2>

        <?php 
            $limite = 10; // asi  muestra sol o3 props
            include 'includes/templates/anuncios.php';
       ?>
    </main>

<?php incluirTemplate('footer'); ?>